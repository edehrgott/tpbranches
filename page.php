<?php
/**
 * page.php
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
			get_sidebar('right') ?> 
			
			<div id="page_content">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<h1><?php the_title(); ?></h1>
				<?php the_post_thumbnail('thumbnail', array('class' => 'alignleft')); ?>
				<?php the_content(__('Read more', 'tpBranches'));?>
				<!-- <?php trackback_rdf(); ?> -->
				
				<div class="page-link">
				    <?php wp_link_pages('before=<p>&after=</p>&next_or_number=number&pagelink=Page %'); ?>
				</div>
				
				<div class="edit-link">
				    <?php edit_post_link( __('Edit', 'tpBranches'), '<p>', '</p>' ); ?> 
				</div>
				
			<?php endwhile; else: ?>
			<p><?php _e('Sorry, no posts matched your criteria.', 'tpBranches'); ?></p><?php endif; ?>
			  
			<?php comments_template(); // Get wp-comments.php template ?>
			
			</div> <!-- page content -->
		</div> <!-- container -->
		
		<?php get_footer(); ?>