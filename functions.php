<?php
/**
 * functions.php
 *
 * @package      tpBranches
 * @author       Ed Ehrgott <ed@tekpals.com>
 * @copyright    Copyright (c) 2011, Ed Ehrgott
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
 */

function tpBranches_scripts() {
     // load required scripts
	wp_register_script('superfish', get_template_directory_uri() . '/js/superfish.js' );
	wp_register_script('hoverIntent', get_template_directory_uri() . '/js/hoverIntent.js' );
	wp_register_script('cycle', get_stylesheet_directory_uri() . '/js/cycle.2.9996.js' );
	wp_register_script('easing', get_stylesheet_directory_uri() . '/js/jquery.easing.1.3.js' );
	wp_register_script('local', get_stylesheet_directory_uri() . '/js/local.js' );
	wp_enqueue_script('jquery');
	wp_enqueue_script('superfish');   
	wp_enqueue_script('hoverIntent');
	wp_enqueue_script('cycle');
	wp_enqueue_script('easing');
	wp_enqueue_script('local');	
}    
 
add_action('wp_enqueue_scripts', 'tpBranches_scripts');

	// widgetized areas
	register_sidebar( array(
		'name' => 'Right Home Page',
		'id' => 'right-home-sidebar',
		'description' => 'right home page sidebar widget area',
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => 'Right Sidebar Primary',
		'id' => 'right-sidebar-primary',
		'description' => 'right sidebar primary widget area',
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );	
	
	register_sidebar( array(
		'name' => 'Right Sidebar Secondary',
		'id' => 'right-sidebar-secondary',
		'description' => 'right sidebar secondary widget area',
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => 'Footer Left',
		'id' => 'footer-left',
		'description' => 'footer left widget area',
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
		
	register_sidebar( array(
		'name' => 'Footer Center',
		'id' => 'footer-center',
		'description' => 'footer center widget area',
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => 'Footer Right',
		'id' => 'footer-right',
		'description' => 'footer right widget area',
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );	

// navigation menu
function tpBranches_register_menus() {
	register_nav_menus(array('primary' => __('Menu', 'tpBranches')));
}

add_action( 'init', 'tpBranches_register_menus' );

add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'post-formats', array( 'aside', 'link', 'gallery', 'status', 'quote', 'image' ) );

load_theme_textdomain( 'tpBranches', TEMPLATEPATH . '/languages' );  //i18n

require_once ( get_template_directory() . '/theme-options.php' );

// for development only - comment out for prod
//add_action('wp_head', 'show_template');
//function show_template() {
//	global $template;
//	print_r($template);
//}

class Selective_Walker extends Walker_Nav_Menu {
    // extend native menu walker to get submenus from current selected menu
    // based on http://wordpress.stackexchange.com/questions/2802/display-a-portion-branch-of-the-menu-tree-using-wp-nav-menu
    function walk( $elements, $max_depth) {

        $args = array_slice(func_get_args(), 2);
        $output = '';

        if ($max_depth < -1) //invalid parameter
            return $output;

        if (empty($elements)) //nothing to walk
            return $output;

        $id_field = $this->db_fields['id'];
        $parent_field = $this->db_fields['parent'];

        // flat display
        if ( -1 == $max_depth ) {
            $empty_array = array();
            foreach ( $elements as $e )
                $this->display_element( $e, $empty_array, 1, 0, $args, $output );
            return $output;
        }

        /*
         * need to display in hierarchical order
         * separate elements into two buckets: top level and children elements
         * children_elements is two dimensional array, eg.
         * children_elements[10][] contains all sub-elements whose parent is 10.
         */
        $top_level_elements = array();
        $children_elements  = array();
        foreach ( $elements as $e) {
            if ( 0 == $e->$parent_field )
                $top_level_elements[] = $e;
            else
                $children_elements[ $e->$parent_field ][] = $e;
        }

        /*
         * when none of the elements is top level
         * assume the first one must be root of the sub elements
         */
        if ( empty($top_level_elements) ) {

            $first = array_slice( $elements, 0, 1 );
            $root = $first[0];

            $top_level_elements = array();
            $children_elements  = array();
            foreach ( $elements as $e) {
                if ( $root->$parent_field == $e->$parent_field )
                    $top_level_elements[] = $e;
                else
                    $children_elements[ $e->$parent_field ][] = $e;
            }
        }

        $current_element_markers = array( 'current-menu-item', 'current-menu-parent', 'current-menu-ancestor' );  //added by continent7
        foreach ( $top_level_elements as $e ){  
            // descend only on current tree
		  $descend_test = array_intersect( $current_element_markers, $e->classes );
            if ( !empty( $descend_test ) ) 
                $this->display_element( $e, $children_elements, 4, 0, $args, $output );
        }
	    
         return $output;
    }
}

function tpBranches_custom_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
	<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<div class="avatar">
				<?php echo get_avatar($comment,$size='64',$default='<path_to_url>' );?>
			</div>
			<div class="comment-meta commentmetadata">
				<?php _e('<cite class="fn">' . get_comment_author_link() . '</cite> says on: '); ?>
				<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s'), get_comment_date(), get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),' ','') ?>
			</div>			
			
		<?php if ($comment->comment_approved == '0') : ?>
			<em><?php _e('Your comment is awaiting moderation.', 'tpBranches'); ?></em>
		<?php endif; ?>

		<div class="comment-text">
			<?php comment_text(); ?>
		</div>
		<div class="reply">
			<?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
		</div>
	</div>
<?php }

?>