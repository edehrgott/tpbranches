<?php
/**
 * sidebar-home.php
 *
 * @package      tpBranches
 * @author       Ed Ehrgott <ed@tekpals.com>
 * @copyright    Copyright (c) 2011, Ed Ehrgott
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
 */
?>

<div id="right_col">

    <div id="right-home-sidebar">
	  <ul>
	  <?php
	  if ( is_active_sidebar( 'right-home-sidebar' ) ) : dynamic_sidebar( 'right-home-sidebar' );
	  else : //no primary sidebar so show search & recent posts ?>
		<li id="search" class="widget-container widget_search">
		    <?php get_search_form(); ?>
		</li>	       
          <div id="recent_posts">
          <h3>Recent Blog Posts</h3>
          <?php $args = array( 'numberposts' => 5 );
          global $post;
          $recent_posts_array = get_posts( $args );
          foreach( $recent_posts_array as $post ) : setup_postdata($post); ?>
               <li class="recent_posts_item"><a href="<?php the_permalink(); ?>" class="recent_posts_title"><?php the_title(); ?></a><br />
               <div id="recent_posts_meta">
                  <p>By <?php the_author(); ?> on <?php the_time('j M Y'); ?><br />
               </div>
          <?php endforeach; ?>
          </div>       
	  <?php endif; ?>
	  </ul>
	</div>
    
    <?php wp_meta(); ?>
	
</div> <!-- right_col -->