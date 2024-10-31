<?php defined('ABSPATH') or die("No script kiddies please!");
/**
 * The admin-specific functionality of the plugin.
 * @package    NP_Social_Share_Counter
 * @subpackage NP_Social_Share_Counter/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 */
require_once NPSSC_PATH . '/includes/class-np-social-share-counter-activator.php';
class NP_Social_Share_Counter_Admin {

  /**
   * The ID of this plugin.
   *
   * @since    1.0.0
   * @access   private
   * @var      string    $np_social_share_counter    The ID of this plugin.
   */
  private $np_social_share_counter;

  /**
   * The version of this plugin.
   *
   * @since    1.0.0
   * @access   private
   * @var      string    $version    The current version of this plugin.
   */
  private $version;

  /**
   * Initialize the class and set its properties.
   *
   * @since    1.0.0
   * @param      string    $np_social_share_counter       The name of this plugin.
   * @param      string    $version    The version of this plugin.
   */
  public function __construct( $np_social_share_counter, $version ) {

    $this->np_social_share_counter = $np_social_share_counter;
    //$this->npsc_settings = $npsc_settings;
    $this->version = $version;

  }

  /**
   * Register the stylesheets for the admin area.
   *
   * @since    1.0.0
   */
  public function enqueue_styles() {
        wp_enqueue_style( 'wp-jquery-ui-dialog' );
        wp_enqueue_style( $this->np_social_share_counter, plugin_dir_url( __FILE__ ) . 'css/np-social-share-counter-admin.css', array(), $this->version, 'all' );
        wp_enqueue_style('fontawesome-css',  plugin_dir_url( __FILE__ ) . 'css/font-awesome/font-awesome.min.css', false, $this->version);
      }


  /**
   * Register the JavaScript for the admin area.
   *
   * @since    1.0.0
   */
  public function enqueue_scripts() {
    wp_enqueue_script(array(
      'jquery',
      'jquery-ui-core',
      'jquery-ui-tabs',
      'jquery-ui-sortable',
      'wp-color-picker',
      'thickbox',
      'media-upload',
      'jquery-ui-droppable'
      ));
    wp_enqueue_script( 'jquery-ui-dialog' ); // jquery and jquery-ui should be dependencies, didn't check though...
    wp_enqueue_script( $this->np_social_share_counter, plugin_dir_url( __FILE__ ) . 'js/np-social-share-counter-admin.js', array('jquery', 'jquery-ui-tabs', 'jquery-ui-sortable', 'wp-color-picker', 'jquery-ui-core'), $this->version, true );
    
  }

  /**
   * Register the administration menu for this plugin into the WordPress Dashboard menu.
   *
   * @since    1.0.0
   */
  public function add_plugin_admin_menu() {
    $ms_page_title = apply_filters( 'np_social_share_counter_admin_page_title', __( 'NP Social Share Counter', 'np-social-share-counter' ) );
    $this->sliders_screen_hook_suffix = add_menu_page(
        __('NP Social Share <br/> Counter Settings'),// the page title
        __('NP Social Share <br/> Counter Settings'),//menu title
        'manage_options',//capability
        'np-social-share-counter',//menu slug/handle this is what you need!!!
        array( $this, 'np_social_share_counter_settings_page' ),//callback function
        'dashicons-share'//icon_url
        );
    }

    public function np_social_share_counter_settings_page() {
      include_once( NPC_SOCIAL_ADMIN_DIR . '/partials/class-np-social-share-counter-admin-settings.php' );

    }

   /*
   * Form Social Settings Submission
   */
   public function form_submit_action() {
    if(!empty($_POST) && wp_verify_nonce($_POST['npsc_nonce_field'],'npsc_nonce')){
      if(isset($_POST['submit_btn'])){
        include_once(NPC_SOCIAL_ADMIN_DIR.'/partials/npsc-save-settings.php');
      }else{
        global $activator;
        $npsc_settings = $activator->npsc_default_settings();
        update_option('npsc_settings', $npsc_settings);
        wp_redirect(admin_url().'admin.php?page=np-social-share-counter&reset_message=1');
        exit();
      }
    }
  }

    /*
    * Social Share shortcode Display
    * [npssc_share template='1' show_counter='1' totalcounter='1' media='facebook' animation="shake" position="share_top_mini"]
    */
    public function npssc_shortcode( $attr ) {
      ob_start();
      include(NPC_SOCIAL_PUB_DIR.'/partials/shortcodes/share-shortcode.php');
      $html = ob_get_contents();
      ob_get_clean();
      return $html;
    }

    /*
    * Social Share shortcode Display
    * [npssc_share_total_counter media='facebook,twitter' counter_format='c1 or c2 or c3']
    */
    public function npssc_share_tc_shortcode( $attr ) {
      ob_start();
      include(NPC_SOCIAL_PUB_DIR.'/partials/shortcodes/share-count-shortcode.php');
      $html = ob_get_contents();
      ob_get_clean();
      return $html;
    }


    /*
    * Social Share shortcode Display
    * [npssc_counter template='2' show_followers_counter='1' position='top_mini' total_counter=1
    media='facebook,twitter' icon_animation="shake" counter_format="comma_type" position="left"]
    */
    public function npssc_counter_shortcode( $attr ) {
      ob_start();
      include(NPC_SOCIAL_PUB_DIR.'/partials/shortcodes/counter-shortcode.php');
      $html = ob_get_contents();
      ob_get_clean();
      return $html;
    }


    /*
    * Add metabox to enable and disable
    */
    public function fn_enable_disable_share_metadata(){
      add_meta_box('npssc-metadata', 'NP Social Share Options', array($this, 're_callback'), '', 'side', 'core');
    }

    public function re_callback($post){
      wp_nonce_field('npssc_meta_values', 'npssc_meta_nonce');
      $npscc_content_share = get_post_meta($post->ID, 'npscc_content_share', true);
      ?>
    <label><?php _e('Disable Social Share In Content',  NPC_SOCIAL_TEXT_DOMAIN); ?>
    <input type="checkbox" value="1" name="npscc_content_share" <?php checked($npscc_content_share, true) ?>/>
    </label>
      <?php
    }

    public function save_metadata($post_id){
            // Check if our nonce is set.
            if (!isset($_POST['npssc_meta_nonce'])) {
                return;
            }
            // Verify that the nonce is valid.
            if (!wp_verify_nonce($_POST['npssc_meta_nonce'], 'npssc_meta_values')) {
                return;
            }

            // If this is an autosave, our form has not been submitted, so we don't want to do anything.
            if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
                return;
            }

            // Check the user's permissions.
            if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {

                if (!current_user_can('edit_page', $post_id)) {
                    return;
                }
            } else {

                if (!current_user_can('edit_post', $post_id)) {
                    return;
                }
            }
            $npscc_content_share = (isset($_POST['npscc_content_share']) && $_POST['npscc_content_share'] == true) ? true : false;
            update_post_meta($post_id, 'npscc_content_share', $npscc_content_share);

    }
  }
