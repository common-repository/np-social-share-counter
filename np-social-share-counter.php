<?php defined('ABSPATH') or die("No script kiddies please!");
/*
  Plugin Name: NP Social Share Counter
  Plugin URI:  http://www.supazthemes.com/plugins/np-social-share-counter
  Description: A Free WordPress Plugin that allows to share website content (page, posts) on available social media such as Facebook, Twitter, Linkedin, GooglePlus, Pinterest and display your social accounts fans, subscribers and followers count on your website.
  Version:     1.0.0
  Author:      Supazthemes
  Author URI:  http://www.supazthemes.com/
  License:     GPL2 or later
  License URI: https://www.gnu.org/licenses/gpl-2.0.html
  Domain Path: /languages/
  Text Domain: np-social-share-counter
*/
define( 'NPC_SOCIAL_VERSION'       , '1.0.0' );
define( 'NPC_TITLE'                , 'NP Social Share Counter' );
define( 'NPC_SOCIAL_SLUG'          , 'np-social-share-counter' );
define( 'NPC_SOCIAL_TEXT_DOMAIN'   , 'np-social-share-counter' );
defined('NPSSC_PATH') or define('NPSSC_PATH', plugin_dir_path(__FILE__));
define( 'NPC_SOCIAL_DIR'           , dirname( dirname( plugin_dir_path( __FILE__ ) ) ) );
define( 'NPC_SOCIAL_URL'           , plugins_url( '', dirname( plugin_dir_path( __FILE__ ) ) ) );
define( 'NPC_SOCIAL_BASE_NAME'     , plugin_basename( NPC_SOCIAL_DIR ) . '/np-social-media.php' ); // master-slider/master-slider.php
if (!defined('NPC_IMAGE_DIR')) {
    define('NPC_IMAGE_DIR', plugin_dir_url(__FILE__));
}
define( 'NPC_SOCIAL_ADMIN_DIR'     , NPC_SOCIAL_DIR . '/plugins/np-social-share-counter/admin' );
define( 'NPC_SOCIAL_ADMIN_URL'     , NPC_SOCIAL_URL . '/admin' );
define( 'NPC_SOCIAL_INC_DIR'       , NPC_SOCIAL_DIR . '/includes' );
define( 'NPC_SOCIAL_INC_URL'       , NPC_SOCIAL_URL . '/includes' );
define( 'NPC_SOCIAL_PUB_DIR'       , NPC_SOCIAL_DIR . '/plugins/np-social-share-counter/public' );
define( 'NPC_SOCIAL_PUB_URL'       , NPC_SOCIAL_URL . '/public' );
define( 'NPC_SOCIAL_BLANK_IMG'            , NPC_SOCIAL_PUB_URL . '/assets/css/blank.gif' );
require plugin_dir_path( __FILE__ ) . 'includes/np-counter.php';
/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-np-social-share-counter-activator.php
 */
function activate_np_social_share_counter() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-np-social-share-counter-activator.php';
	NP_Social_Share_Counter_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-np-social-share-counter-deactivator.php
 */
function deactivate_np_social_share_counter() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-np-social-share-counter-deactivator.php';
	NP_Social_Share_Counter_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_np_social_share_counter' );
register_deactivation_hook( __FILE__, 'deactivate_np_social_share_counter' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-np-social-share-counter.php';


/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_np_social_share_counter() {

	$plugin = new NP_Social_Share_Counter();
	$plugin->run();

}
run_np_social_share_counter();
