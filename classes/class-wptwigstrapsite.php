<?php
/**
 * The classes for the theme.
 *
 * @package  WordPress
 * @subpackage  WPTwigstrap
 * @since    WPTwigstrap 0.1
 */

/**
 * Extend TimberSite to add functions to theme.
 */
class WPTwigstrapSite extends TimberSite {

	/**
	 * Add WordPress specific functions.
	 */
	function __construct() {
		add_theme_support( 'post-formats' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'menus' );
		add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
		add_filter( 'timber_context', array( $this, 'add_to_context' ) );
		add_filter( 'get_twig', array( $this, 'add_to_twig' ) );
		add_action( 'init', array( $this, 'register_post_types' ) );
		add_action( 'init', array( $this, 'register_taxonomies' ) );
		parent::__construct();
	}

	/**
	 * Register Custom Post types.
	 */
	function register_post_types() {
		// This is where you can register custom post types.
	}

	/**
	 * Register Custom Taxonomies.
	 */
	function register_taxonomies() {
		// This is where you can register custom taxonomies.
	}

	/**
	 * Add to Timber Context.
	 *
	 * @param string $context Timber context.
	 */
	function add_to_context( $context ) {
		$context['foo'] = 'bar';
		$context['stuff'] = 'I am a value set in your functions.php file';
		$context['notes'] = 'These values are available everytime you call Timber::get_context();';
		$context['menu'] = new TimberMenu();
		$context['site'] = $this;
		return $context;
	}

	/**
	 * Sets a variable.
	 *
	 * @param  string $text Sets myfoo.
	 * @return [type]       [description]
	 */
	function myfoo( $text ) {
		$text .= ' bar!';
		return $text;
	}

	/**
	 * This is where to add functions to twig.
	 *
	 * @param string $twig Add variable.
	 */
	function add_to_twig( $twig ) {
		$twig->addExtension( new Twig_Extension_StringLoader() );
		$twig->addFilter( 'myfoo', new Twig_SimpleFilter( 'myfoo', array( $this, 'myfoo' ) ) );
		return $twig;
	}
}

new WPTwigstrapSite();
