<?php defined('ABSPATH') or die("No script kiddies please!");
/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 */
class NP_Social_Share_Counter_i18n {
	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'np-social-share-counter',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
			);

	}



}
