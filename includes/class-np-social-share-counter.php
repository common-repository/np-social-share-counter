<?php defined('ABSPATH') or die("No script kiddies please!");
/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    NP_Social_Share_Counter
 * @subpackage NP_Social_Share_Counter/includes
 */
class NP_Social_Share_Counter {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      NP_Social_Share_Counter_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $np_social_share_counter    The string used to uniquely identify this plugin.
	 */
	protected $np_social_share_counter;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->np_social_share_counter = 'np-social-share-counter';
		$this->version = '1.0.0';

		$this->load_dependencies();
		$this->set_locale();

		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - NP_Social_Share_Counter_Loader. Orchestrates the hooks of the plugin.
	 * - NP_Social_Share_Counter_i18n. Defines internationalization functionality.
	 * - NP_Social_Share_Counter_Admin. Defines all hooks for the admin area.
	 * - NP_Social_Share_Counter_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-np-social-share-counter-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-np-social-share-counter-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-np-social-share-counter-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-np-social-share-counter-public.php';

		$this->loader = new NP_Social_Share_Counter_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the NP_Social_Share_Counter_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new NP_Social_Share_Counter_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {
		$plugin_admin = new NP_Social_Share_Counter_Admin( $this->get_np_social_share_counter(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'add_plugin_admin_menu' );
		//$this->loader->add_action('admin_init', $plugin_admin, 'admin_session_init'); //intializes session
		$this->loader->add_action('admin_post_npsc_settings_action', $plugin_admin, 'form_submit_action');
		$this->loader->add_shortcode( 'npssc_share', $plugin_admin, 'npssc_shortcode' );
		$this->loader->add_shortcode( 'npssc_counter', $plugin_admin, 'npssc_counter_shortcode' );
		$this->loader->add_shortcode( 'npssc_share_total_counter', $plugin_admin, 'npssc_share_tc_shortcode' );
		$this->loader->add_action('add_meta_boxes',  $plugin_admin, 'fn_enable_disable_share_metadata');
		$this->loader->add_action('save_post', $plugin_admin, 'save_metadata'); 

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$this->define_advanced_social_share_variables();
		$this->define_advanced_social_counter_variables();
		$plugin_public = new NP_Social_Share_Counter_Public( $this->get_np_social_share_counter(), $this->get_version() );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		$this->loader->add_filter(  "the_content", $plugin_public, "showSocialCountIcons" );
	}

	public function define_advanced_social_share_variables(){
			$npsc_settings = get_option( 'npsc_settings' );
			$api_details = (isset($npsc_settings['counter']['icon_list']) && !empty($npsc_settings['counter']['icon_list']))?$npsc_settings['counter']['icon_list']:array();
			$facebook_id = (isset($api_details['facebook']['page_id']) && $api_details['facebook']['page_id'] !='')?esc_attr($api_details['facebook']['page_id']):'';
			$facebook_appid = (isset($api_details['facebook']['app_id']) && $api_details['facebook']['app_id'] !='')?esc_attr($api_details['facebook']['app_id']):'';
			$facebook_appsecret = (isset($api_details['facebook']['app_secret']) && $api_details['facebook']['app_secret'] !='')?esc_attr($api_details['facebook']['app_secret']):'';
			$current_url = (get_permalink() != FALSE) ? get_permalink() : NP_Social_Share_Counter_Public::curPageURL();
			$current_title = '#title';
			$post_excerpt = '#excerpt';
			$fblink = "https://www.facebook.com/sharer/sharer.php?u=".$current_url;
			define("FACEBOOK_SHARE_URL", $fblink);
			$twitter_user = (isset($api_details['twitter']['username']) && $api_details['twitter']['username'] !='')?esc_attr($api_details['twitter']['username']):'';
			define("TWITTER_SHARE_URL", "https://twitter.com/intent/tweet?url=".$current_url."&text=".$current_title."&via=".$twitter_user);	
			$linkedin_link = "http://www.linkedin.com/shareArticle?mini=true&amp;title=".$current_title."&amp;url=".$current_url."&amp;summary=".$post_excerpt;		
			define("LINKEDIN_SHARE_URL", $linkedin_link);
			define("STUMBLEUPON_SHARE_URL", "http://www.stumbleupon.com/submit?url=".$current_url."&title=".$current_title);
			define("GOOGLE_SHARE_URL", "https://plus.google.com/share?url=".$current_url);
			$tumblrlink = "http://www.tumblr.com/share/link?url=".esc_url($current_url)."&name=".esc_attr($current_title);
			define("TUMBLR_SHARE_URL", $tumblrlink );
            define("VK_SHARE_URL", "http://vk.com/share.php?url=".$current_url); 
			$whatsapp_link = "whatsapp://send?text=Take%20a%20look%20at%20this%20awesome%20url:".$current_url;
			define("WHATSAPP_SHARE_URL", $whatsapp_link);
			$pinURL = 'http://pinterest.com/pin/create/button/?url=' . $current_url . '&description=' . $post_excerpt . '';
			define("PINTEREST_SHARE_URL",$pinURL);
            //share count
			define("FACEBOOK_SHARE_COUNT_URL", "http://graph.facebook.com/?id=".$current_url);
			define("TWITTER_SHARE_COUNT_URL", "http://public.newsharecounts.com/count.json?url=".$current_url);
			define("LINKEDIN_SHARE_COUNT_URL", "http://www.linkedin.com/countserv/count/share?url=".$current_url."&format=json");
			define("STUMBLEUPON_SHARE_COUNT_URL", " https://www.stumbleupon.com/services/1.01/badge.getinfo?url=".$current_url);
            define("TUMBLR_SHARE_COUNT_URL", "");
			define("VK_SHARE_COUNT_URL", "http://vk.com/share.php?act=count&url=".$current_url);
			define("WHATSAPP_SHARE_COUNT_URL", "");
			define("GOOGLE_SHARE_COUNT_URL","");
			define("PINTEREST_SHARE_COUNT_URL", "http://api.pinterest.com/v1/urls/count.json?&url=".$current_url);
	}

	public function define_advanced_social_counter_variables(){
			global $post;
			$npsc_settings = get_option( 'npsc_settings' );
			$api_details = (isset($npsc_settings['counter']['icon_list']) && !empty($npsc_settings['counter']['icon_list']))?$npsc_settings['counter']['icon_list']:array();
            /* Facebook DATA */
			$facebook_id = (isset($api_details['facebook']['page_id']) && $api_details['facebook']['page_id'] !='')?esc_attr($api_details['facebook']['page_id']):'';
			$facebook_appid = (isset($api_details['facebook']['app_id']) && $api_details['facebook']['app_id'] !='')?esc_attr($api_details['facebook']['app_id']):'';
			$facebook_appsecret = (isset($api_details['facebook']['app_secret']) && $api_details['facebook']['app_secret'] !='')?esc_attr($api_details['facebook']['app_secret']):'';
			define("FACEBOOK_FOLLOWER_COUNT_URL", "https://graph.facebook.com/".$facebook_id."?access_token=".$facebook_appid."|".$facebook_appsecret."&fields=fan_count");
		    $fb_url = 'https://www.facebook.com/' . $facebook_id;
            define("FACEBOOK_FOLLOWER_COUNT_URL2", $fb_url );
           /* Twitter DATA */
			$twitter_username = (isset($api_details['twitter']['username']) && $api_details['twitter']['username'] !='')?esc_attr($api_details['twitter']['username']):'';
			define("TWITTER_FOLLOWER_COUNT_URL", "https://cdn.syndication.twimg.com/widgets/followbutton/info.json?screen_names=".$twitter_username);
            $linkedin_url = (isset($api_details['linkedin']['profile_link']) && $api_details['linkedin']['profile_link'] !='')?esc_url($api_details['linkedin']['profile_link']):'';
			define("LINKEDIN_FOLLOWER_COUNT_URL", $linkedin_url);

			$google_apiKey = (isset($api_details['google']['plus_api_key']) && $api_details['google']['plus_api_key'] !='')?esc_attr($api_details['google']['plus_api_key']):''; 
			$google_id = ( isset($api_details['google']['plus_profile_id']) && $api_details['google']['plus_profile_id'] !='')?esc_attr($api_details['google']['plus_profile_id']):'';
			$social_profile_url = 'https://plus.google.com/' . $google_id;
			define("GOOGLE_FOLLOWER_COUNT_URL", "https://www.googleapis.com/plus/v1/people/".$google_id."?key=".$google_apiKey);
			define("GOOGLE_COUNT_URL", $social_profile_url);
			
			$instagram_username = (isset($api_details['instagram']['uname']) &&  $api_details['instagram']['uname'] !='')?esc_attr($api_details['instagram']['uname']):'';
			define("INSTAGRAM_FOLLOWER_COUNT_URL", "https://www.instagram.com/".$instagram_username."/?__a=1");

			$group_id = (isset($api_details['vk']['user_id']) && $api_details['vk']['user_id'] !='')?esc_attr($api_details['vk']['user_id']):''; 
			define("VK_FOLLOWER_COUNT_URL", "https://api.vk.com/method/groups.getMembers?group_id=".$group_id);
			define("VK_COUNT_URL", "http://vk.com/".$group_id);

			$behance_username = (isset($api_details['behance']['user_name']) && $api_details['behance']['user_name'] !='')?esc_attr($api_details['behance']['user_name']):'';
			$behance_apikey = (isset($api_details['behance']['api_key']) && $api_details['behance']['api_key'] !='')?esc_attr($api_details['behance']['api_key']):'';
			define("BEHANCE_FOLLOWER_COUNT_URL", "https://www.behance.net/v2/users/". $behance_username . "?api_key=" . $behance_apikey);
			define("BEHANCE_COUNT_URL", "https://www.behance.net/".$behance_username);

			$pinterest_username = (isset($api_details['pinterest']['username']) && $api_details['pinterest']['username'] !='')?esc_attr($api_details['pinterest']['username']):'';
			define("PINTEREST_FOLLOWER_COUNT_URL", "http://pinterest.com/".$pinterest_username);

			$tumblr_api_key =  (isset($api_details['tumblr']['client_id']) && $api_details['tumblr']['client_id'] !='')?esc_attr($api_details['tumblr']['client_id']):''; 
			
			$tumblr_blog_name =  (isset($api_details['tumblr']['username']) && $api_details['tumblr']['username'] !='')?esc_attr($api_details['tumblr']['username']):''; 
			define("TUMBLR_FOLLOWER_COUNT_URL", "http://api.tumblr.com/v2/blog/".$tumblr_blog_name."/info?api_key=".$tumblr_api_key);
			define("WHATSAPP_FOLLOWER_COUNT_URL","");
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_np_social_share_counter() {
		return $this->np_social_share_counter;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    NP_Social_Share_Counter_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
