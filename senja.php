<?php
/**
 * Plugin Name:       Senja
 * Description:       Embed and display text and video testimonials and reviews with ease.
 * Requires at least: 5.6.0
 * Requires PHP:      7.0
 * Version:           1.1.1
 * Author:            senjahq
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       senja
 */

namespace Senja;

define( 'SENJA_PLUGIN_FILE', __FILE__ );
define( 'SENJA_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'SENJA_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'SENJA_VERSION', '1.1.1' );

require_once 'includes/class-plugin.php';

new Plugin();
