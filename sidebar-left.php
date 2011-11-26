<?php
/**
 * sidebar-left.php
 *
 * @package      tpBranches
 * @author       Ed Ehrgott <ed@tekpals.com>
 * @copyright    Copyright (c) 2011, Ed Ehrgott
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
 */
?>

<div id="left_col">
	<div class="l_sub_menu">
	<?php if ( is_single() ) { // show menu for all blog posts on single post template - also addresses left padding issue
		$posts_page_id = get_option( 'page_for_posts' ); // posts page ID set in settings/reading, 0 if not set ?>
		<ul class="sf-vertical"><li><a href="<?php echo home_url(); ?>/?p=<?php echo $posts_page_id; ?>"><?php _e('All Posts', 'tpBranches'); ?></a></li></ul>
	<?php }
	if (is_404()) { ?>
		<img src="<?php echo get_template_directory_uri() . '/images/l-sidebar-spacer.png'; ?>" />
	<?php }
	if (is_archive()) { ?>
		<img src="<?php echo get_template_directory_uri() . '/images/l-sidebar-spacer.png'; ?>" />
	<?php }	
	// use extended menu walker for sub menus
	wp_nav_menu(array('menu_class' => 'sf-vertical',
				   'walker'=> new Selective_Walker() ) 
	); ?>
	
	</div>

</div>