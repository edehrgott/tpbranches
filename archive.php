<?php
/**
 * archive.php
 *
 * @package      tpBranches
 * @author       Ed Ehrgott <ed@tekpals.com>
 * @copyright    Copyright (c) 2011, Ed Ehrgott
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
 */

get_header(); ?>

<div id="wrapper1">
	<div id="wrapper2">
	    <div id="container">

		<?php get_sidebar('left');
		get_sidebar('right'); ?> 				

			<div id="page_content">

				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<div <?php post_class(); ?>  id="post-<?php the_ID(); ?>">
					<div class="contentmeta">
						<h1><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title('','',0) ? the_title() : _e('Untitled Post', 'tpBranches'); ?> </a></h1>
						<p>Posted by <?php the_author(); ?> on <?php the_time('F j, Y'); ?><br />
						Posted in <?php the_category(' &bull; ') ?>&nbsp;<?php the_tags(' | ' . __('Tagged With: ', 'tpBranches'), ', ', ''); ?>
						<?php if ( comments_open() ) { ?>
							| <?php comments_popup_link( __('No Comments yet, please leave one', 'tpBranches'), __('1 Comment', 'tpBranches'), '% ' . __('Comments', 'tpBranches'));
						} ?></p>
					</div>					
					<?php the_post_thumbnail('thumbnail', array('class' => 'alignleft')); ?>
					<div class="post-content">
					  
					  <?php if ( 'gallery' == get_post_format( get_the_ID() ) ) : 
						    $images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );
						    if ( $images ) :
							    $total_images = count( $images );
							    $image = array_shift( $images );
							    $image_img_tag = wp_get_attachment_image( $image->ID, 'thumbnail' );
						    ?>

						    <figure class="gallery-thumb">
							    <a href="<?php the_permalink(); ?>"><?php echo $image_img_tag; ?></a>
						    </figure><!-- .gallery-thumb -->

						    <p><em><?php printf( _n( 'This gallery contains <a %1$s>%2$s image</a>.', 'This gallery contains <a %1$s>%2$s images</a>.', $total_images, 'tpBranches' ),
								    'href="' . esc_url( get_permalink() ) . '" title="' . sprintf( esc_attr__( 'Permalink to %s', 'tpBranches' ), the_title_attribute( 'echo=0' ) ) . '" rel="bookmark"',
								    number_format_i18n( $total_images )
							    ); ?></em></p>
						    <?php endif; ?>

				      <?php endif; ?>					  
					  
					<?php the_content(__('Read more', 'tpBranches')); ?>
					</div>
						
					<div class="postspace">
					</div>
						
					<!-- <?php trackback_rdf(); ?> -->
					<?php wp_link_pages('before=<p>&after=</p>&next_or_number=number&pagelink=Page %'); ?>
				      <?php edit_post_link( __('Edit', 'tpBranches'), '<p>', '</p>' ); ?> 					
				</div>	
				<?php endwhile; else: ?>
					
				<p><?php _e('Sorry, no posts matched your criteria.', 'tpBranches'); ?></p><?php endif; ?>
				<div class="pagenav">
					<p><?php posts_nav_link(); ?></p>
				</div>
					
             </div> <!-- page content -->
		</div> <!-- container -->
		
		<?php get_footer(); ?>