<?php
/**
 * Plugin Name: Simple Dark Mode for WP Dashboard
 * Plugin URI: https://github.com/ronilaukkarinen/simple-dark-mode-for-wp-dashboard
 * Description: The simplest way to make your WordPress Dashboard dark. No settings, just activate the plugin and enjoy the darkness. Tries to follow the WordPress Coding Standards and best practices and be as straightforward as possible.
 * Author: Roni Laukkarinen
 * Author URI: https://github.com/ronilaukkarinen
 * Text Domain: dark-mode-dashboard
 * Version: 1.0.9
 *
 * @package dark-mode-dashboard
 */

if ( ! defined( 'ABSPATH' ) ) {
  die();
}

// Define versions
define( 'SIMPLE_DARK_MODE_DASHBOARD_VERSION', '1.0.9' );
define( 'SIMPLE_DARK_MODE_DASHBOARD_PLUGIN_PATH', plugin_dir_url( __FILE__ ) );

// Add styles to admin
function simple_dark_mode() {
  // Dequeue plugin styles if needed
  wp_dequeue_style( 'activitypub-admin' );

  wp_enqueue_style(
    'dark-mode',
    SIMPLE_DARK_MODE_DASHBOARD_PLUGIN_PATH . '/assets/css/prod/dark-mode.css',
    [],
    filemtime( SIMPLE_DARK_MODE_DASHBOARD_PLUGIN_PATH . '/assets/css/prod/dark-mode.css' )
  );
}
add_action( 'admin_enqueue_scripts', 'simple_dark_mode', 99999 );

// Plugin description when people click on View version details
add_filter( 'plugins_api', 'dark_mode_dashboard_plugin_view_version_details', 9999, 3 );

function dark_mode_dashboard_plugin_view_version_details( $res, $action, $args ) {
   if ( 'plugin_information' !== $action ) return $res;
   if ( 'whatever-plugin' !== $args->slug ) return $res;

   $res = new stdClass();
   $res->name = 'Simple Dark Mode for WP Dashboard';
   $res->slug = 'simple-dark-dark-mode-for-wp-dashboard';
   $res->path = 'simple-dark-dark-mode-for-wp-dashboard/simple-dark-dark-mode-for-wp-dashboard.php';
   $res->sections = array(
      'description' => 'The simplest way to make your WordPress Dashboard dark. No settings, just activate the plugin and enjoy the darkness. Tries to follow the WordPress Coding Standards and best practices and be as straightforward as possible.',
   );
   $changelog = bbloomer_whatever_plugin_request();
   $res->version = $changelog->latest_version;
   $res->download_link = $changelog->download_url;
   return $res;
}

// Update plugin from GitHub
add_filter( 'update_plugins_github.com', 'self_update', 10, 4 );

/**
 * Check for updates to this plugin
 *
 * @param array  $update   Array of update data.
 * @param array  $plugin_data Array of plugin data.
 * @param string $plugin_file Path to plugin file.
 * @param string $locales    Locale code.
 *
 * @return array|bool Array of update data or false if no update available.
 */
function self_update( $update, array $plugin_data, string $plugin_file, $locales ) {

	// Only check this plugin
	if ( 'simple-dark-mode-for-wp-dashboard/simple-dark-dark-mode-for-wp-dashboard.php' !== $plugin_file ) {
		return $update;
	}

	// Already completed update check elsewhere
	if ( ! empty( $update ) ) {
		return $update;
	}

	// Let's get the latest version number from GitHub
	$response = wp_remote_get(
		'https://api.github.com/repos/ronilaukkarinen/simple-dark-mode-for-wp-dashboard/releases/latest',
		array(
			'user-agent' => 'ronilaukkarinen',
		)
	);

	if ( is_wp_error( $response ) ) {
		return;
	} else {
		$output = json_decode( wp_remote_retrieve_body( $response ), true );
	}

	$new_version_number  = $output['tag_name'];
	$is_update_available = version_compare( $plugin_data['Version'], $new_version_number, '<' );

	if ( ! $is_update_available ) {
		return false;
	}

	$new_url     = $output['html_url'];
	$new_package = $output['assets'][0]['browser_download_url'];

  // Log updates to error log
	error_log( '$plugin_data: ' . print_r( $plugin_data, true ) ); // phpcs:ignore
	error_log( '$new_version_number: ' . $new_version_number ); // phpcs:ignore
	error_log( '$new_url: ' . $new_url ); // phpcs:ignore
	error_log( '$new_package: ' . $new_package ); // phpcs:ignore

	return array(
		'slug'    => $plugin_data['TextDomain'],
		'version' => $new_version_number,
		'url'     => $new_url,
		'package' => $new_package,
	);
}
