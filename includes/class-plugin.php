<?php
/**
 * Main Plugin class.
 *
 * @package Senja
 */
namespace Senja;

use Senja\Elementor\Elementor;

/**
 * Main Plugin Class to register everything around Senja.
 */
class Plugin {

	/**
	 * Constructor Method.
	 */
	public function __construct() {
		spl_autoload_register( array( $this, 'load_class' ) );

		add_action( 'init', [ $this, 'register_block' ] );
		add_action( 'enqueue_block_editor_assets', [ $this, 'enqueue_editor_scripts'] );
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_front' ] );

		new Elementor();
		new Shortcode();
	}

	/**
	 * Enqueue scripts for the front.
	 * @return void
	 */
	public function enqueue_front() {
		global $post;

		// wp_register_script(
		// 	'senja-public',
		// 	'https://static.senja.io/dist/platform.js',
		// 	[],
		// 	null,
		// 	true
		// );

		// No post.
		if ( ! $post ) {
			return;
		}

		if ( ! has_block( 'senja/widget', $post ) && ! has_shortcode( $post->post_content, 'senja_widget' ) ) {
			return;
		}

		wp_enqueue_script( 'senja-public' );
	}

	/**
	 * Enqueue the Editor scripts required for the Senja Integration to work in editor.
	 *
	 * @return void
	 */
	public function enqueue_editor_scripts() {
		wp_enqueue_script(
			'senja-integration',
			'https://static.senja.io/dist/integration.js',
			[],
			null,
			true
		);

		// wp_enqueue_script(
		// 	'senja-platform',
		// 	'https://static.senja.io/dist/platform.js',
		// 	[],
		// 	null,
		// 	true
		// );

		wp_register_script( 'senja-editor', trailingslashit( SENJA_PLUGIN_URL ) . 'build/index.js', [], SENJA_VERSION, true );
		wp_register_style( 'senja-editor', trailingslashit( SENJA_PLUGIN_URL ) . 'build/index.css' );
	}

	/**
	 * Register Senja Block.
	 *
	 * @return void
	 */
	public function register_block() {
		//register_block_type( trailingslashit( SENJA_PLUGIN_DIR ) . 'build' );

		register_block_type( 'senja/widget', [
			'api_version' => 2,
			'title' => 'Senja',
			'category' => 'widgets',
			'attributes' => [
				'id' => [
					'type' => 'string'
				]
			],
			'textdomain' => 'senja',
			'keywords'   => [
				'testimonials',
				'reviews'
			],
			'description' => 'Block for Testimonial Widget.',
			'editor_script'   => 'senja-editor',
			'editor_style'    => 'senja-editor',
		] );
	}

	/**
	 * Load a class under the Senja namespace.
	 *
	 * @param string $class Namespaced class name.
	 *
	 * @return void
	 */
	public function load_class( $class ) {
		$parts = explode( '\\', $class );

		if ( 'Senja' !== $parts[0] ) {
			return;
		}

		unset( $parts[0] );
		$parts      = array_map( 'strtolower', $parts );
		$class_name = str_replace( '_', '-', array_pop( $parts ) );
		$path       = ( ! empty( $parts ) ? implode( '/', $parts ) . '/' : '' ) . 'class-' . $class_name . '.php';
		include_once $path;
	}
}
