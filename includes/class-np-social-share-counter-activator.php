<?php defined('ABSPATH') or die("No script kiddies please!");
/**
 * Fired during plugin activation
 * @package    NP_Social_Share_Counter
 * @subpackage NP_Social_Share_Counter/includes
 */
/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 */
if (!class_exists('NP_Social_Share_Counter_Activator')) {
class NP_Social_Share_Counter_Activator {
  /**
   * Short Description. (use period)
   *
   * Long Description.
   *
   * @since    1.0.0
   */
  public static function activate() {
            /**
             * Load Default Settings
             * */
            if (!get_option('npsc_settings')) {
              $npsc_settings = NP_Social_Share_Counter_Activator::npsc_default_settings();
              update_option('npsc_settings', $npsc_settings);
            }

          }
     /**
         * Returns Default Settings
         */
    public static function npsc_default_settings() {
      $npsc_settings = array(
        'counter' => array(
         'profile_order' => array(
          '0'=> 'facebook',
          '1'=> 'twitter',
          '2'=> 'google',
          '3'=> 'pinterest',
          '4'=> 'linkedin',
          '5'=> 'instagram',
          '6'=> 'whatsapp',
          '7'=> 'tumblr',
          '8'=> 'vk',
          '9'=> 'posts',
          ),
         'icon_list' => array(),
         'counter_template' => 'template1',
         'counter_position' => 'right',
         'animation' => '',
         'format' => 'c1',
         'place_to_display' => 'bottom_content',
         'hide_on_mobile' => '0',
         'hide_on_widget' => '0',
         'hide_counts' => '0',
         ),
        'social_share' => array(
         'ss_counter_enable' => '1',
         'counter_display' => 'c1',
         'link_options' => 'new_window',
         'share_position' => 'new_window',
         'link_options' => 'bottom_content',
         'icon_lists' => array(),
         'profile_order' => array(
          '0'=> 'facebook',
          '1'=> 'twitter',
          '2'=> 'google',
          '3'=> 'linkedin',
          '4'=> 'stumbleupon',
          '5'=> 'whatsapp',
          '6'=> 'tumblr',
          '7'=> 'vk'
          ),
         'share_template' => 'template1',
         'position' => 'share_left',
         'animation' => '',
         'button_styles' => 'icon_and_text_both'
         )
        );
      return $npsc_settings;
    }

  }
$GLOBALS['activator'] = new NP_Social_Share_Counter_Activator();
}
