<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
<meta http-equiv="content-type" content="<?php bloginfo('html_type') ?>; charset=<?php bloginfo('charset') ?>" />
<title>
<?php
if (is_front_page()) {
bloginfo('description'); echo ' - '; bloginfo('name');
} else {
	if (function_exists('is_tag') && is_tag()) {
	single_tag_title('Tag Archive for &quot;'); echo '&quot; - ';
	} elseif (is_archive()) {
	wp_title(''); echo ' Archive - ';
	} elseif (is_search()) {
	echo 'Search for &quot;'.esc_html($s).'&quot; - ';
	} elseif ( !(is_404()) && (is_single()) || (is_page())) {
	wp_title(''); echo ' - ';
	} elseif (is_404()) {
	echo 'Not Found - ';
	} 
	bloginfo('name');
}
if ($paged > 1) {
echo ' - page '. $paged;
} ?>
</title>
<?php if(is_search()) { ?>
	<meta name="robots" content="noindex, nofollow" /> 
<?php }?>
<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />
<?php $options = get_option('tpBranches_options');
switch ($options['style']) {
	case 'burnt': ?>
		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri() . '/css/burnt.css'; ?>" />
		<?php break;
	case 'primary': ?>
		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri() . '/css/primary.css'; ?>" />
		<?php break;		
	case 'default':
		break;
} ?>
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri() . '/custom.css'; ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

<?php wp_head(); ?>
</head>

<body>
<div id="masthead">
	<?php if ( $options['logo'] ) { ?>
		<div id="logo">
		   <a href="<?php echo home_url(); ?>/" title="<?php bloginfo('name'); ?>"><img src="<?php echo $options['logo']; ?>" alt="<?php bloginfo('name'); ?>" /></a>
		</div>			
	<?php } ?>

	<div id="masthead-text">
		<h1><a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<h2 class="description"><?php bloginfo( 'description' ); ?></h2>	
	</div>
</div>
	
<div id="h_nav">
	<?php
	// the primary WP 3 menu is vertical at the top of the left sidebar
	// only show top level menus
	wp_nav_menu(array('menu_class' => 'sf-menu',
				'depth' => 1,
				));
	?>
</div>
