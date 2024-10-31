<?php defined('ABSPATH') or die("No script kiddies please!");
/**
* The public-facing functionality of the plugin.
*
* Defines the plugin name, version, and two examples hooks for how to
* enqueue the admin-specific stylesheet and JavaScript.
*/
class NP_Social_Share_Counter_Public {

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
* @param      string    $np_social_share_counter       The name of the plugin.
* @param      string    $version    The version of this plugin.
*/
public function __construct( $np_social_share_counter, $version ) {

  $this->np_social_share_counter = $np_social_share_counter;
  $this->version = $version;

}

/**
* Register the stylesheets for the public-facing side of the site.
*
* @since    1.0.0
*/
public function enqueue_styles() {
wp_enqueue_style('npsc-animate',  plugin_dir_url( __FILE__ ) . 'css/animate.css', false, $this->version);
wp_enqueue_style( $this->np_social_share_counter, plugin_dir_url( __FILE__ ) . 'css/np-social-share-counter-public.css', array(), $this->version, 'all' );
wp_enqueue_style('npsc-fontawesome',  plugin_dir_url( __FILE__ ) . 'css/font-awesome/font-awesome.min.css', false, $this->version);
}

/**
* Register the JavaScript for the public-facing side of the site.
*
* @since    1.0.0
*/
public function enqueue_scripts() {
wp_enqueue_script( $this->np_social_share_counter, plugin_dir_url( __FILE__ ) . 'js/np-social-share-counter-public.js', array( 'jquery' ), $this->version, false );
wp_enqueue_script('npsc-pinit-js', '//assets.pinterest.com/js/pinit.js', false, null, true);
}

/**
 * [displayNumberFormat description]
 * @param  [type] $number [number to be formatted]
 * @return [type]         [description]
 */
public static function displayNumberFormat($number,$format) {
  if($format == 'c1') {
    $formatted = number_format((int)$number);

  } else if ( $format == 'c2' ) {
    $number = (0+str_replace(",","",$number));
    if(!is_numeric($number)) return false;
    if($number>1000000000000) return round(($number/1000000000000),1).'T';
    else if($number>1000000000) return round(($number/1000000000),1).'B';
    else if($number>1000000) return round(($number/1000000),1).'M';
    else if($number>1000) return round(($number/1000),1).'K';
    $formatted = number_format((int)$number);

  } else {
    $formatted = $number;
  }
  return $formatted;
}

 //returns the current page url
public static function curPageURL() {
  $pageURL = 'http';
  if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
    $pageURL .= "s";
  }
  $pageURL .= "://";
  if ($_SERVER["SERVER_PORT"] != "80") {
    $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
  } else {
    $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
  }
  return $pageURL;
}


/**
 * [showSocialCountIcons description]
 * @param  [type] $post_content [description]
 * @return [type]               [description]
 */
function showSocialCountIcons($content) {
  global $post;
  $post_content=$content;
  $title = get_the_title();
  $content=strip_shortcodes(strip_tags(get_the_content()));
  $npsc_data = get_option('npsc_settings');
  $shareposition = (isset($npsc_data['social_share']['share_position']) && $npsc_data['social_share']['share_position'] !='')?esc_attr($npsc_data['social_share']['share_position']):'top_content';
  $share_on = (isset($npsc_data['counter']['share_on']) && !empty($npsc_data['counter']['share_on']))?$npsc_data['counter']['share_on']:array();
   if(strlen($content) >= 100){
          $excerpt= substr($content, 0, 100).'...';
   }else{
          $excerpt = $content;
    }
     ob_start();
    include(NPC_SOCIAL_PUB_DIR.'/partials/shortcodes/share-shortcode.php');
    $html_content = ob_get_contents();
    ob_get_clean();
    
   $npscc_content_share = get_post_meta($post->ID, 'npscc_content_share', true);
    $single_post = in_array('post', $share_on);
     if($single_post && is_singular('post') && !is_front_page() ){
       $check_singular = true;
    }else{
       $check_singular = false;
     }
    $singe_page = in_array('page', $share_on);
    if($singe_page && is_page() && !is_front_page() ){
       $check_page = true;
    }else{
       $check_page = false;
     }
    $frontpage = in_array('front_page', $share_on);
     if(is_front_page() && $npscc_content_share != '1'  && $frontpage){
       $is_front_page = true;
    }else{
       $is_front_page = false;
     }


     if(empty($share_on)){
        return $post_content;
     }else{
        if( $npscc_content_share ==  1){
          //disable on this page or post content
        }else{
          //enable on this content
          if($check_singular ||  $check_page  || $is_front_page){
            if ($shareposition== 'bottom_content') {
                $post_content .= "<div class='npssc-social-share clearfix' >" . $html_content . "</div>";
            }else if ($shareposition== 'top_content') {
              $post_content =  "<div class='npssc-social-shar clearfix'>$html_content</div>" . $post_content;
            }
          }
        }
     }
      
      return $post_content;
    }
}
