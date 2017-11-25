<?php
/**
 * The template for displaying the footer.
 *
 * Third party plugins that hijack the theme will call wp_footer() to get the footer template.
 * We use this to end our output buffer (started in header.php) and render into the view/page-plugin.twig template.
 *
 * If you're not using a plugin that requries this behavior (ones that do include Events Calendar Pro and
 * WooCommerce) you can delete this file and header.php
 *
 * @package  WordPress
 * @subpackage  WPTwigstrap
 * @since    WPTwigstrap 0.1
 */

$timber_context = $GLOBALS['timber_context'];
if ( ! isset( $timber_context ) ) {
	throw new \Exception( 'Timber context not set in footer.' );
}
$timber_context['content'] = ob_get_contents();
ob_end_clean();
$templates = array( 'page-plugin.twig' );
Timber::render( $templates, $timber_context );
