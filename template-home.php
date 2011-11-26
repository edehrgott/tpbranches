<?php
/**
 * Template Name: Home
 *
 * The home page template displays a responsive slideshow your page content
 * and a customzed home page right sidebar.
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
		get_sidebar('home'); ?> 				
				
		<div id="page_content">
			<?php $options = get_option('tpBranches_options');
			if ( $options['slideshow'] ) { ?>
			<div id="slideshow">
				<div class='slideshow'>
					<?php for ($i=1; $i<=5; $i++) {
						$cur_slide = 'slide' . $i;
						$cur_slideurl = 'slideurl' . $i;
						if ( $options[$cur_slide] ) { ?>
							<a href="<?php echo $options[$cur_slideurl]; ?>"><img class="fluidimage" src="<?php echo $options[$cur_slide]; ?>" alt="<?php echo $options[$cur_slideurl]; ?>" /></a>
						<?php }
					} ?>
				</div>
			</div>
			<?php } 
		
			if (have_posts()) : while (have_posts()) : the_post(); ?>
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
		
		<script type="text/javascript">
		/* script to control clickable image resizing
		 * adds timthumb to each slide in cycle when window size is reduced to reduce size of slides
		 * when window is resized larger process is reversed
		 * script assumes slides of 940x240px
		 */
		
		jQuery(document).ready(function() { 

		function imageresize() {
			var contentwidth = jQuery('#page_content').width();
			jQuery('.fluidimage').each(function(){ // cycle through each image in slideshow
				if(contentwidth < 960) { // small window
					var imgsrc = jQuery(this).attr('src');
					if (imgsrc.indexOf('timthumb.php') == -1) { // timthumb not found so add it to img src
						jQuery(this).attr('src', '<?php echo get_template_directory_uri(); ?>/timthumb.php?src=' + jQuery(this).attr('src') + '&w=500');
					};
					jQuery('#slideshow').css({
					   'height': '128px',
					   'width': '500px',
					});					
				} else { // big window
					var imgsrc = jQuery(this).attr('src');
					if (imgsrc.indexOf('timthumb.php') != -1) { // timthumb found so remove it from img src
						imgsrc = imgsrc.replace('<?php echo get_template_directory_uri(); ?>/timthumb.php?src=', '');
						imgsrc = imgsrc.replace('&w=500', '');						
						jQuery(this).attr('src', imgsrc);
					};
					jQuery('#slideshow').css({
					   'height': '240px',
					   'width': '940px',
					});						
				}
			});
		};
		  
		imageresize(); // triggers when document first loads    
		jQuery(window).bind("resize", function(){ // when browser resized
		   imageresize();
		});
		
		});
		</script>
		
		<?php get_footer(); ?>