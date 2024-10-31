<?php

namespace Senja;

class Shortcode {

	public function __construct() {
		add_action( 'init', array( $this, 'register' ) );
	}

	public function output( $atts ) {
		$atts = shortcode_atts(
			array(
				'id' => '',
			),
			$atts
		);

		if ( ! isset( $atts['id'] ) ) {
			return '';
		}

		if ( ! $atts['id'] ) {
			return '';
		}

		ob_start();
		?>
		<div class="senja-embed" data-lazyload=true data-id="<?php echo esc_attr( $atts['id'] ); ?>"></div>
		<script
				src="https://widget.senja.io/widget/<?php echo esc_attr( $atts['id'] ); ?>/platform.js"
				async="true"
				type="text/javascript"
			></script>
		<?php
		return ob_get_clean();
	}

	/**
	 * Register shortcodes.
	 *
	 * @return void
	 */
	public function register() {
		add_shortcode( 'senja_widget', array( $this, 'output' ) );
	}
}
