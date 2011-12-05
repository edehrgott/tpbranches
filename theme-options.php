<?php
/**
 * theme-options.php
 *
 * @package      tpBranches
 * @author       Ed Ehrgott <ed@tekpals.com>
 * @copyright    Copyright (c) 2011, Ed Ehrgott
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
 */

add_action( 'admin_init', 'tpBranches_options_init' );
add_action( 'admin_menu', 'tpBranches_options_add_page' );

/**
 * Create arrays for the style and xxx options
 */
$style_options = array(
	'burnt' => array(
		'value' =>	'burnt',
		'label' => __( 'Burnt', 'tpBranches' )
	),
	'primary' => array(
		'value' =>	'primary',
		'label' => __( 'Primary', 'tpBranches' )
	),
	'default' => array(
		'value' => 'default',
		'label' => __( 'Default', 'tpBranches' )
	)
);

/**
 * Init plugin options to white list our options
 */
function tpBranches_options_init(){
	register_setting( 'tpBranches_option_group', 'tpBranches_options', 'tpBranches_options_validate' );
}

/**
 * fix the edit_theme_options/manage_options bug using new WP 3.2 filter
 */
function tpBranches_get_options_page_cap() {
    return 'edit_theme_options';
}

add_filter( 'option_page_capability_tpBranches_options', 'tpBranches_get_options_page_cap' );

/**
 * Load the menu page
 */
function tpBranches_options_add_page() {
	add_theme_page( __( 'Theme Options', 'tpBranches' ), __( 'Theme Options', 'tpBranches' ), tpBranches_get_options_page_cap(), 'tpBranches_options', 'tpBranches_options_do_page' );
}

/**
 * Create the options page
 */
function tpBranches_options_do_page() {
	global $style_options;


	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false ;

	?>
	<div class="wrap">
		<?php screen_icon(); echo "<h2>" . get_current_theme() . __( ' Theme Options', 'tpBranches' ) . "</h2>"; ?>

		<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
		<div class="updated fade"><p><strong><?php _e( 'Options saved', 'tpBranches' ); ?></strong></p></div>
		<?php endif; ?>

		<form method="post" action="options.php">
			<?php settings_fields( 'tpBranches_option_group' ); ?>
			<?php $options = get_option( 'tpBranches_options' );
			
			//_e( '<p>tpBranches instructions go here.</p>', 'tpBranches' );
			?>
			<table class="form-table">
				
				<?php
				/**
				 * Select theme style
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Select a styling option', 'tpBranches' ); ?></th>
					<td>
						<select name="tpBranches_options[style]">
							<?php
								$selected = $options['style'];
								$p = '';
								$r = '';

								foreach ( $style_options as $option ) {
									$label = $option['label'];
									if ( $selected == $option['value'] ) // Make default first in list
										$p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
									else
										$r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
								}
								echo $p . $r;
							?>
						</select>
						<label class="description" for="tpBranches_options[style]"><?php _e( 'Select a styling option', 'tpBranches' ); ?></label>
					</td>
				</tr>

				<?php
				/**
				 * Use a custom logo?
				 */
				?>
				<tr valign="top"> <th scope="row"><?php _e( 'Use a logo in the page header?', 'tpBranches' ); ?></th>
					<td>
						<input id="tpBranches_options[logo]" class="regular-text" type="text" name="tpBranches_options[logo]" value="<?php esc_attr_e( $options['logo'] ); ?>" />
						<label class="description" for="tpBranches_options[logo]"><?php _e( 'Enter location of logo image. (recommend 100px height transparent png)', 'tpBranches' ); ?></label>
					</td>
				</tr>
			</table>

			<table class="form-table" style="background:#eeeeee; border:solid 1px #ccc; -moz-border-radius: 10px; -webkit-border-radius: 10px; overflow:hidden;">
				<?php
				/**
				 * Slideshow on home page template?
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Slideshow on home page template?', 'tpBranches' ); ?></th>
					<td>
						<input id="tpBranches_options[slideshow]" name="tpBranches_options[slideshow]" type="checkbox" value="1" <?php checked( '1', $options['slideshow'] ); ?> />
						<label class="description" for="tpBranches_options[slideshow]"><?php _e( 'Display a slideshow on the home page?', 'tpBranches' ); ?></label>
					</td>
				</tr>

				<?php
				/**
				 * Where are the slides?
				 */
				for ($i=1; $i<=5; $i++) { ?>					

					<tr valign="top"> <th scope="row"><?php _e( 'Location of slide' . $i, 'tpBranches' ); ?></th>
						<td>
							<input id="tpBranches_options[slide<?php echo $i; ?>]" class="regular-text" type="text" name="tpBranches_options[slide<?php echo $i; ?>]" value="<?php esc_attr_e( $options['slide' . $i] ); ?>" />
							<label class="description" for="tpBranches_options[slide<?php echo $i; ?>]"><?php _e( 'Enter here the location of slide ' . $i, 'tpBranches' ); ?></label>
						</td>
					</tr>
					<tr valign="top"> <th scope="row"><?php _e( 'Link for slide' . $i, 'tpBranches' ); ?></th>				
						<td>
							<input id="tpBranches_options[slideurl<?php echo $i; ?>]" class="regular-text" type="text" name="tpBranches_options[slideurl<?php echo $i; ?>]" value="<?php esc_attr_e( $options['slideurl' . $i] ); ?>" />
							<label class="description" for="tpBranches_options[slideurl<?php echo $i; ?>]"><?php _e( 'Enter here the url you want the visitor to be taken to when slide ' . $i . ' is clicked.', 'tpBranches' ); ?></label>
						</td>					
					</tr>
					</div>
				<?php } ?>
			</table>

			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e( 'Save Options', 'tpBranches' ); ?>" />
			</p>
		</form>
	</div>
	<?php
}

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function tpBranches_options_validate( $input ) {
	global $style_options;
	
	// The style option must actually be in the array of style options
	if ( ! array_key_exists( $input['style'], $style_options ) )
		$input['style'] = null;	

	// Our checkbox value is either 0 or 1
	if ( ! isset( $input['slideshow'] ) )
		$input['slideshow'] = null;
	$input['slideshow'] = ( $input['slideshow'] == 1 ? 1 : 0 );

	// Say our text option must be safe text with no HTML tags
	$input['logo'] = wp_filter_nohtml_kses( $input['logo'] );
	$input['slide1'] = wp_filter_nohtml_kses( $input['slide1'] );
	$input['slide2'] = wp_filter_nohtml_kses( $input['slide2'] );
	$input['slide3'] = wp_filter_nohtml_kses( $input['slide3'] );
	$input['slide4'] = wp_filter_nohtml_kses( $input['slide4'] );
	$input['slide5'] = wp_filter_nohtml_kses( $input['slide5'] );

	return $input;
}

// from http://themeshaper.com/2010/06/03/sample-theme-options/
// adapted from http://planetozh.com/blog/2009/05/handling-plugins-options-in-wordpress-28-with-register_setting/