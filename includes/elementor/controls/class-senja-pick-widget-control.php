<?php

namespace Senja\Elementor\Controls;

/**
 * Elementor Senja Picket widget.

 *
 * @since 1.0.0
 */
class Senja_Pick_Widget_Control extends \Elementor\Base_Data_Control {

	/**
	 * Get emoji one area control type.
	 *
	 * Retrieve the control type, in this case `emojionearea`.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Control type.
	 */
	public function get_type() {
		return 'senja_pick_widget_control';
	}

	/**
	 * Enqueue control scripts and styles.
	 *
	 * Used to register and enqueue custom scripts and styles.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function enqueue() {

		wp_enqueue_script(
			'senja-integration',
			'https://static.senja.io/dist/integration.js',
			[],
			null,
			true
		);

		// Scripts
		wp_register_script( 'senja-control', trailingslashit( SENJA_PLUGIN_URL ) . 'build/senja-elementor.js', [ 'senja-integration' ], SENJA_VERSION );
		wp_enqueue_script( 'senja-control' );

		wp_enqueue_style( 'senja-control', trailingslashit( SENJA_PLUGIN_URL ) . 'build/senja-elementor.css', [], SENJA_VERSION, 'screen' );

	}


	protected function get_default_settings() {
		return [];
	}

	/**
	 * Render emoji one area control output in the editor.
	 *
	 * Used to generate the control HTML in the editor using Underscore JS
	 * template. The variables for the class are available using `data` JS
	 * object.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function content_template() {
		$control_uid = $this->get_control_uid();
		?>
		<div class="elementor-control-field">

			<# if ( data.label ) {#>
			<label for="<?php echo esc_attr( $control_uid ); ?>" class="elementor-control-title">{{{ data.label }}}</label>
			<# } #>

			<div class="elementor-control-input-wrapper elementor-control-dynamic-switcher-wrapper">
				<input type="text" id="<?php echo esc_attr( $control_uid ); ?>" class="elementor-control-tag-area" data-setting="{{ data.name }}" placeholder="{{ data.placeholder }}" />
			</div>

			<button id="<?php echo esc_attr( $control_uid ); ?>_button"  class="elementor-button" type="button">Pick a Widget</button>
		</div>

		<# if ( data.description ) { #>
			<div class="elementor-control-field-description">{{{ data.description }}}</div>
		<# } #>
		<?php
	}

}
