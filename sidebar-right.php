<?php
/**
 * sidebar-right.php
 *
 * @package      tpBranches
 * @author       Ed Ehrgott <ed@tekpals.com>
 * @copyright    Copyright (c) 2011, Ed Ehrgott
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
 */
?>

<div id="right_col">

    <div id="right-sidebar-primary">
	  <ul>
	  <?php
	  if ( is_active_sidebar( 'right-sidebar-primary' ) ) : dynamic_sidebar( 'right-sidebar-primary' );
	  else : //no primary sidebar so call a few widgets ?>
		<li id="search" class="widget-container widget_search">
		    <?php get_search_form(); ?>
		</li>		
		    <?php wp_list_categories(array(
			  'orderby' => 'name', 
			  'order' => 'ASC', 
			  'show_count' => 0, 
			  'title_li' => '<h3 class="widget-title">' . __('Categories', 'tpBranches' ) . '</h3>', // standard tpBranches sidebar title
		    )); ?>	
		<li id="archives" class="widget-container">
		    <h3 class="widget-title"><?php _e( 'Archives', 'tpBranches' ); ?></h3>
		    <ul>
			  <?php wp_get_archives( 'type=monthly' ); ?>
		    </ul>
		</li>
	  <?php endif; ?>
	  </ul>
	</div>

    <div id="right-sidebar-secondary">
	  <ul>
	  <?php
	  if ( is_active_sidebar( 'right-sidebar-secondary' ) ) : dynamic_sidebar( 'right-sidebar-secondary' );
	  // no default widgets for secondary
	  endif; ?>
	  </ul>
    </div>
    
    <?php wp_meta(); ?>
	
</div> <!-- right_col -->