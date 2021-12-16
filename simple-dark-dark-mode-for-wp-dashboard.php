<?php
/**
 * Plugin Name: Simple Dark Mode for WP Dashboard
 * Plugin URI: https://wordpress.org/plugins/simple-dark-mode-for-wp-dashboard/
 * Description: The simplest way to make your WordPress Dashboard dark
 * Author: Roni Laukkarinen
 * Author URI: https://github.com/ronilaukkarinen
 * Text Domain: dark-mode-dashboard
 * Version: 1.0.0
 *
 * @package dark-mode-dashboard
 */

if ( ! defined( 'ABSPATH' ) ) {
  die();
}

define( 'SIMPLE_DARK_MODE_DASHBOARD_VERSION', '1.0.0' );
define( 'SIMPLE_DARK_MODE_DASHBOARD_PLUGIN_PATH', plugin_dir_url( __FILE__ ) );

// Styles
function simple_dark_mode() {
  wp_enqueue_style(
    'dark-mode',
    SIMPLE_DARK_MODE_DASHBOARD_PLUGIN_PATH . '/assets/css/prod/dark-mode.css',
    [],
    filemtime( SIMPLE_DARK_MODE_DASHBOARD_PLUGIN_PATH . '/assets/css/prod/dark-mode.css' )
  );
}
add_action( 'admin_enqueue_scripts', 'simple_dark_mode' );
