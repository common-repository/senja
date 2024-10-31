<?php
/**
 * Elementor Class to register everything around Elementor Integration.
 */
namespace Senja\Elementor;

use Senja\Elementor\Controls\Senja_Pick_Widget_Control;
use Senja\Elementor\Widgets\Senja_Widget;

/**
 * Class Elementor.
 */
class Elementor {

	/**
	 * Constructor method.
	 */
	public function __construct() {
		add_action( 'elementor/controls/register', [ $this, 'register_control' ] );
		add_action( 'elementor/widgets/register', [ $this, 'register_widget' ] );
	}

	/**
	 * Register Control.
	 *
	 * @since 1.0.0
	 * @param \Elementor\Controls_Manager $controls_manager Elementor controls manager.
	 * @return void
	 */
	public function register_control( $controls_manager ) {
		$controls_manager->register( new Senja_Pick_Widget_Control() );
	}

	/**
	 * Register Widget.
	 *
	 * @since 1.0.0
	 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
	 * @return void
	 */
	public function register_widget( $widgets_manager ) {

		$widgets_manager->register( new Senja_Widget() );

	}
}
