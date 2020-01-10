<?php
/**
 * Plugin Name: MDidentity
 * Plugin URI: http://www.mdidentity.com/
 * Description: Reputation marketing at its finest. As an MDidentity customer you are able to display your collected reviews from sources like Google, Healthgrades, Vitals and many more right on your website. Offering widgets for your Showcase, Read Our Reviews and Doctor Badges.
 * Version: 0.1
 * Author: Andrew Rost
 * Author URI: https://www.linkedin.com/in/andrewjrost
 */

include 'includes/mdidentity-builder.php';

include 'includes/mdidentity-settings.php';

add_action( 'admin_menu', 'mdidentity_admin_menu' );

function mdidentity_admin_menu() {
	$page_title = 'MDidentity Settings';
	$menu_title = 'MDidentity';
	$capability = 'manage_options';
	$menu_slug  = 'mdidentity-settings';
	$function   = 'mdidentity_settings';

	add_options_page( $page_title, $menu_title, $capability, $menu_slug, $function );
}



	function mdidentity_update_settings() {
		register_setting( 'mdidentity-settings', 'api_key' );
		register_setting( 'mdidentity-settings', 'star_color' );
		register_setting( 'mdidentity-settings', 'showcase_max_char' );


}

add_action('admin_init', 'mdidentity_update_settings');

add_filter( 'plugin_action_links', 'myplugin_plugin_action_links', 10, 2 );

function myplugin_plugin_action_links( $links, $file ) {
	static $this_plugin;

	if ( ! $this_plugin ) {
		$this_plugin = plugin_basename( __FILE__ );
	}

	if ( $file == $this_plugin ) {
		// The "page" query string value must be equal to the slug
		// of the Settings admin page we defined earlier, which in
		// this case equals "myplugin-settings".
		$settings_link = '<a href="' . get_bloginfo( 'wpurl' ) . '/wp-admin/options-general.php?page=mdidentity-settings">Settings</a>';
		array_unshift( $links, $settings_link );
	}

	return $links;
}

?>