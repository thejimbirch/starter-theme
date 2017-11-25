<?php
/**
 * The functions for the theme.
 *
 * @package  WordPress
 * @subpackage  WPTwigstrap
 * @since    WPTwigstrap 0.1
 */

/**
 * Check for Timber plugin.
 */
if ( ! class_exists( 'Timber' ) ) {
	add_action(
		'admin_notices', function() {
			echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a></p></div>';
		}
	);

	add_filter(
		'template_include', function( $template ) {
			return get_stylesheet_directory() . '/static/no-timber.html';
		}
	);

	return;
}

/**
 * Change Twig folder from views to templates.
 *
 * @var array
 */
Timber::$dirname = array( 'templates', 'views' );

/**
 * Import the WPTwigstrapSite class.
 */
include( 'classes/class-wptwigstrapsite.php' );
