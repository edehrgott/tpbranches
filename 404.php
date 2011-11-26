<?php
/**
 * 404.php
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
		<h2><?php _e('Not Found', 'tpBranches'); ?></h2>
		<p><?php _e('Whoops! Whatever you are looking for cannot be found.', 'tpBranches'); ?></p>
		<p><?php _e('How about searching for what you were looking for?', 'tpBranches') ?></p>
		<?php get_search_form(); ?>
	</div> <!-- page content -->
	</div> <!-- container -->
	
	<?php get_footer(); ?>

