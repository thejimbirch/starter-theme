<?php
/**
 * Tests for starter theme.
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

/**
 * Adds TestTimberStarterTheme class.
 */
class TestTimberStarterTheme extends WP_UnitTestCase {

	/**
	 * Loads functions.php.
	 */
	function setUp() {
		self::_setupStarterTheme();
		require_once( get_template_directory() . '/functions.php' );
	}

	/**
	 * Loads twentythirteen theme.
	 */
	function tearDown() {
		switch_theme( 'twentythirteen' );
	}

	/**
	 * Tests for Timber context site and foo bar, post-thumbnails.
	 */
	function testFunctionsPHP() {
		$context = Timber::get_context();
		$this->assertEquals( 'StarterSite', get_class( $context['site'] ) );
		$this->assertTrue( current_theme_supports( 'post-thumbnails' ) );
		$this->assertEquals( 'bar', $context['foo'] );
	}

	/**
	 * Tests for Timber file and markup.
	 */
	function testLoading() {
		$str = Timber::compile( 'tease.twig' );
		$this->assertStringStartsWith( '<article class="tease tease-" id="tease-">', $str );
		$this->assertStringEndsWith( '</article>', $str );
	}

	/**
	 * Tests for theme.
	 */
	static function _setupStarterTheme() {
		$dest = WP_CONTENT_DIR . '/themes/starter-theme/';
		$src = __DIR__ . '/../../starter-theme/';
		if ( is_dir( $src ) ) {
			self::_copyDirectory( $src, $dest );
			switch_theme( 'starter-theme' );
		} else {
			echo 'no its not';
		}
	}
}
