<?php defined('ABSPATH') or die("No script kiddies please!");
/**
* Fired during plugin activation.
*
* This class defines all code necessary to run during the plugin's activation.
*
* @since      1.0.0
* @package    NP_Counter
* @subpackage NP_Counter/includes
*/
class Np_Counter {
  
    public function get_fb_count($url){
        $json = wp_remote_get( $url, array( 'timeout' => 60 ) );
         if ( is_wp_error( $json ) || ( isset( $json['response']['code'] ) && 200 != $json['response']['code'] ) ) {
            $total = 0;
        } else {
            $parsed = json_decode( $json['body'], true );
            if ( isset( $parsed['fan_count'] ) ) {
                $count = intval( $parsed['fan_count'] );

                $total = $count;
            } else {
                $total = 0;
            }
        }
        return $total;

    }

    public function get_social_counts($value, $follower_count = true, $meta_tag, $u){
     $ptitle = get_the_title();
     $plink = get_the_permalink();
     $npsc_settings = get_option( 'npsc_settings' );
     $cache_period = (isset($npsc_settings['counter']['cache_period']) && $npsc_settings['counter']['cache_period'] != '')?intval($npsc_settings['counter']['cache_period']) * 60 * 60 : 24 * 60 * 60;
     $api_details = (isset($npsc_settings['counter']['icon_list']) && !empty($npsc_settings['counter']['icon_list']))?$npsc_settings['counter']['icon_list']:array();
     $default_count =(isset($api_details[$value]['dcount']) && $api_details[$value]['dcount'] !='')?intval($api_details[$value]['dcount']):0; 
    if($follower_count){
          $url = constant(strtoupper($value)."_FOLLOWER_COUNT_URL"); 
         if($value == "google" || $value == 'vk' || $value == 'behance'){
              $share_link_url = constant(strtoupper($value)."_COUNT_URL"); 
         }else{
              $share_link_url = '';
         }      
         $type = "counter"; 
    }else{
         $share_link_url = constant(strtoupper($value)."_SHARE_URL");
         if($value == "google"){
           $url = $plink;
         }
         else{
           $url = constant(strtoupper($value)."_SHARE_COUNT_URL");
           $url = str_replace('##', $plink ,$url);
         }
        
         $type = "share"; 
    }
     $data = array('url'=> $url,'count' => 0,'share_link_url' => '#');
        switch ($value) {
         case 'facebook':
         $page_id = (isset($api_details[$value]['page_id']) && $api_details[$value]['page_id'] !='')?esc_attr($api_details[$value]['page_id']):'';
         $facebook_appsecret = (isset($api_details[$value]['app_secret']) && $api_details[$value]['app_secret'] !='')?esc_attr($api_details[$value]['app_secret']):'';
         $facebook_appid = (isset($api_details[$value]['app_id']) && $api_details[$value]['app_id'] !='')?esc_attr($api_details[$value]['app_id']):'';
         $fb_count = get_transient('npssc_fb_count');
          if($follower_count){
                   if ($fb_count === false) {
                           if($facebook_appid == '' && $facebook_appsecret == ''){
                                  $url = constant(strtoupper($value)."_FOLLOWER_COUNT_URL2");
                            }
                       $cnt = $this->get_social_follower_count($url);
                       $count = $cnt['fan_count'];
                       $count = ($count==0)?$default_count:$count;
                       $data = array(
                             'count' => $count,
                             'url' => $url,
                             'share_link_url' => 'https://www.facebook.com/'.$page_id
                        );
                       set_transient('npssc_fb_count', $count, $cache_period);
                    }else {
                     $count = $fb_count;
                     $data = array(
                             'count' => $count,
                             'url' => $url,
                             'share_link_url' => 'https://www.facebook.com/'.$page_id
                        );
                     }
            }else{
                //share
              $fb_share_count = 'npssc_fb_share_count_'. md5($url);
              $fb_sc_transient = get_transient( $fb_share_count );
               if ($fb_sc_transient === false) {
                  $parsed = $this->get_social_follower_count($url);
                   $count = (isset($parsed['share']['share_count']))?intval($parsed['share']['share_count']):0;
                    set_transient('npssc_fb_share_count_'.$url, $count, $cache_period);
               }else{
                 $count = $fb_sc_transient;
               }
              
                $data = array(
                     'count' => $count,
                     'url' => $url,
                     'share_link_url' => $share_link_url
                  );
           }
         break;
         case 'twitter':
         $username = (isset($api_details[$value]['username']) && $api_details[$value]['username'] !='')?esc_attr($api_details[$value]['username']):'';
         $twitter_count = get_transient('npssc_tweets_count-'.$username);
         if($follower_count){
            //social counter here
            if ($twitter_count === false) {
                //if no transcient then set it.
                $followers_count = $this->get_social_follower_count($url);
                $cnt_followers = $followers_count[0]['followers_count'];
                $screen_name = $followers_count[0]['screen_name'];
                $count = ($cnt_followers == 0)?$default_count:$cnt_followers;
                $data = array(
                    'count' => $count,
                     'url' => $url,
                     'share_link_url' => 'https://twitter.com/'.$screen_name

                    );
                 set_transient('npssc_tweets_count-'.$username, $count, $cache_period);
            }else{
                //otherwise get transcient data
                 $count = $twitter_count;
                 $data = array(
                             'count' => $count,
                             'url' => $url,
                             'share_link_url' =>'https://twitter.com/'.$username
                  );
            }

         }else{
            //social share here
              $twitter_share_count = 'npssc_twitter_share_count_'. md5($url);
              $twitter_sc_transcient = get_transient( $twitter_share_count);
               if ($twitter_sc_transcient === false) {
                   $parsed = $this->get_social_follower_count($url);
                   $count = (isset($parsed['count']))?intval($parsed['count']):0;
                  set_transient($twitter_share_count, $count, $cache_period);
               }else{
                 $count = $twitter_sc_transcient;
               }
                $data = array(
                     'count' => $count,
                     'url' => $url,
                     'share_link_url' => $share_link_url
                  );

         }
         break;
         case 'linkedin':
         if($follower_count){
             $data = array(
                        'count' => $default_count,
                         'url' => $url,
                         'share_link_url' => $url
                        );
         }else{
            //share count
            $linkedin_transient = 'npssc_linkedin_sc_' . md5($url);
            $linkedin_sc_transcient = get_transient( $linkedin_transient );
            if ($linkedin_sc_transcient === false) {
                   $parsed = $this->get_social_follower_count($url);
                   $count = (isset($parsed['count']))?intval($parsed['count']):0;
                  set_transient($linkedin_transient, $count, $cache_period);
               }else{
                 $count = $linkedin_sc_transcient;
               }
                $data = array(
                     'count' => $count,
                     'url' => $url,
                     'share_link_url' => $share_link_url
                  );

         }
         break;
         case 'stumbleupon':
         if($follower_count){
          }else{
            //share count
            $stumbleupon_transient = 'npssc_stumbleupon_sc_' . md5($url);
            $stumbleupon_sc_transcient = get_transient( $stumbleupon_transient );
            if ($stumbleupon_sc_transcient === false) {
                 $parsed = $this->get_social_follower_count($url);
                 $count = (isset($parsed['result']['views']))?intval($parsed['result']['views']):0;
                 set_transient($stumbleupon_transient, $count, $cache_period);
            }else{
                 $count = $stumbleupon_sc_transcient;
             }
                $data = array(
                     'count' => $count,
                     'url' => $url,
                     'share_link_url' => $share_link_url
                  );
         }
         break;
         case 'google':
         if($follower_count){
            $google_transient = 'npssc_google_sc_' . md5($url);
            $google_sc_transcient = get_transient( $google_transient );
            if ($google_sc_transcient === false) {
            $parsed = $this->get_social_follower_count($url);
            $circledByCount = (isset($parsed['circledByCount']))?intval($parsed['circledByCount']):0;
            $count = (isset($circledByCount) && $circledByCount > 0)?$circledByCount:$default_count;
            set_transient($google_transient, $count, $cache_period);
            }else{
              $count = $google_sc_transcient;
            }
            $data = array(
                    'count' => $count,
                     'url' => $url,
                     'share_link_url' => constant(strtoupper($value)."_COUNT_URL")
                    );
          }else{
            //share count
            $google_share_cnt = 'googlesharecnt_' . md5($url);
            $google_share_transcient = get_transient($google_share_cnt);
            if($google_share_transcient === false){
               $count = $this->getGooglePlusShareCount($url);
               set_transient($google_share_cnt, $count, $cache_period);
            }else{
               $count = $google_share_transcient;
            }
          
            $data = array(
                     'count' => $count,
                     'url' => $url,
                     'share_link_url' => $share_link_url
                );
         }
         break;
         case 'whatsapp':
         if($follower_count){
         }else{
             //share count
            $data = array(
                     'count' => 0,
                     'url' => $url,
                     'share_link_url' => $share_link_url
            );
         }
         break;

         case 'pinterest':
         if($follower_count){
                $pinterest_cnt = 'npssc_pinterest_cnt_' . md5($url);
                $pinterest_transcient = get_transient($pinterest_cnt);
                if($pinterest_transcient === false){
                   $meta_data = get_meta_tags( $url );
                   $followers_cnt = (isset($meta_data['pinterestapp:followers'])?$meta_data['pinterestapp:followers']:0);
                   $count = (isset($followers_cnt) && $followers_cnt > 0)?$followers_cnt:$default_count;
                   set_transient($pinterest_cnt, $count, $cache_period);
                }else{
                  $count = $pinterest_transcient;
                }
                $data = array(
                     'count' => $count,
                     'url' => $url,
                     'share_link_url' => $url
                 );

         }else{
            //share done
                $pinterest_scnt = 'npssc_pinterest_share_cnt_' . md5($url);
                $pinterest_share_transcient = get_transient($pinterest_scnt);
                if($pinterest_share_transcient === false){
                   $connection = wp_remote_get($url, array( 'timeout' => 60 ) );

                    if (is_wp_error($connection)) {
                        $count = $default_count;
                    } else {
                        $str = json_decode($connection['body'], true);
                        $str = str_replace('receiveCount(', '', $str);
                        $str = str_replace(')', '', $str);
                        $str =  json_decode($str,true);
                        $count = (isset($str['count']) && $str['count'] > 0)?$str['count']:0;
                    }
                   
                    set_transient($pinterest_scnt, $count, $cache_period);
                }else{
                  $count = $pinterest_share_transcient;
                }
                $data = array(
                     'count' => $count,
                     'url' => $url,
                     'share_link_url' => $share_link_url
                 );

         }
         break;

         case 'instagram':
         if($follower_count){
          $instagram_username = (isset($api_details['instagram']['uname']) &&  $api_details['instagram']['uname'] !='')?esc_attr($api_details['instagram']['uname']):'';
          $instagram_count = get_transient('npssc_instagram_count-'.$instagram_username);
            if ($instagram_count === false) {
                $parsed = $this->get_social_follower_count($url);  
                $count = (isset($parsed['user']['followed_by']['count']))?$parsed['user']['followed_by']['count']:0;
                $count = ($count == 0)?$default_count:$count;
                $data = array(
                    'count' => $count,
                     'url' => $url,
                     'share_link_url' => 'https://instagram.com/'.$instagram_username

                    );
                 set_transient('npssc_instagram_count-'.$instagram_username, $count, $cache_period);
            }else{
                 $count = $instagram_count;
                 $data = array(
                             'count' => $count,
                             'url' => $url,
                             'share_link_url' =>'https://instagram.com/'.$instagram_username
                  );
            }
         }
         break;
         case 'tumblr':
         if($follower_count){
          $parsed = $this->get_social_follower_count($url);  

          $count = (isset($parsed['response']['blog']['likes'])?intval($parsed['response']['blog']['likes']):0);
          $count = ($count <= 0)?$default_count:$count;  
          $data = array(
                    'count' => $count,
                     'url' => $url,
                     'share_link_url' => $url,
                    );
        
          }else{
            //share count
            $count = 0;
            $data = array(
                     'count' => $count,
                     'url' => $url,
                     'share_link_url' => $share_link_url
                );
         }
         break;
         case 'vk':
         if($follower_count){
             $vk_fcnt = 'npssc_vk_follower_cnt_' . md5($url);
             $vk_followers_transcient = get_transient($vk_fcnt);
           if($vk_followers_transcient === false){
                  $connection = wp_remote_get($url, array( 'timeout' => 60 ) );

                    if (is_wp_error($connection)) {
                        $count = $default_count;
                    } else {
                         $parsed =  json_decode($connection['body'],true); 
                          $fcount = (isset($parsed['response']['count']) && $parsed['response']['count'] != '')?$parsed['response']['count']:0;
                         $count = (isset($fcount) && $fcount > 0)?$fcount:$default_count;
                    }
               set_transient($vk_fcnt, $count, $cache_period);
           }else{
             $count = $vk_followers_transcient;
           }
              $data = array(
                       'count' => $count,
                       'url' => $url,
                       'share_link_url' => $share_link_url
                  );
         
          }else{
            //share count
            $vk_cnt = 'npssc_vk_cnt_' . md5($url);
            $vk_transcient = get_transient($vk_cnt);
            if($vk_transcient === false){
                $parsed = $this->get_social_body_result($url);  
                $matches = array();
                preg_match('/^VK\.Share\.count\(\d, (\d+)\);$/i', $parsed, $matches);
                $count = isset($matches[1]) ? intval($matches[1]) : 0;
               set_transient($vk_cnt, $count, $cache_period);
            }else{
               $count = $vk_transcient; 
            }
            
            $data = array(
                     'count' => $count,
                     'url' => $url,
                     'share_link_url' => $share_link_url
            );

         }
         break;

          case 'behance':
         if($follower_count){
            $behance_username = (isset($api_details['behance']['user_name']) && $api_details['behance']['user_name'] !='')?esc_attr($api_details['behance']['user_name']):'';
            $behance_api_key = (isset($api_details['behance']['api_key']) && $api_details['behance']['api_key'] !='')?esc_attr($api_details['behance']['api_key']):'';
            $behance_cnt = 'npssc_behance_cnt_' .$behance_username;
            $behance_transcient = get_transient($behance_cnt);
            if($behance_username != '' && $behance_api_key != ''){
            if($behance_transcient === false){
               $connection = wp_remote_get($url, array( 'timeout' => 60 ) );
                if (is_wp_error($connection)) {
                        $count = $default_count;
                    } else {
                          $parsed =  json_decode($connection['body'],true); 
                         $fcount = $parsed['user']['stats']['followers'];
                      $count = (isset($fcount) && $fcount > 0)?$fcount:$default_count;
                    }
            
               set_transient($behance_cnt, $count, $cache_period);
            }else{
               $count = $behance_transcient;
            }
          }else{
             $count = $default_count;
          }
              $data = array(
                       'count' => $count,
                       'url' => $url,
                       'share_link_url' => $share_link_url
                  );
         
          }
         break;
         default:
         break;
       }
       return $data;
    }

    /**
    * GET SOCIAL DATA BY URL
    */
    public function get_social_follower_count($url) {   
          $count = 0;  
          $parsed = array();  
          $json = wp_remote_get( $url, array( 'timeout' => 60 ) );
            if(!isset($json->errors) && isset($json['body']) ) {
                $parsed =  json_decode($json['body'],true); 
            }     
            return $parsed;       
    }

    public function get_social_body_result($url) {     
           $args = array('timeout' => 10);
           $response = wp_remote_get($url, $args);
           $json_response = wp_remote_retrieve_body($response);
           return $json_response; 
    }

/**
* Get the total Google Plus Share Count
*/
public function getGooglePlusShareCount($url){
  $args = array(
            'method' => 'POST',
            'headers' => array(
                // setup content type to JSON 
                'Content-Type' => 'application/json'
            ),
            // setup POST options to Google API
            'body' => json_encode(array(
                'method' => 'pos.plusones.get',
                'id' => 'p',
                'method' => 'pos.plusones.get',
                'jsonrpc' => '2.0',
                'key' => 'p',
                'apiVersion' => 'v1',
                'params' => array(
                    'nolog'=>true,
                    'id'=> $url,
                    'source'=>'widget',
                    'userId'=>'@viewer',
                    'groupId'=>'@self'
                ) 
             )),
             // disable checking SSL sertificates               
            'sslverify'=>false
        );

     // retrieves JSON with HTTP POST method for current URL  
    $json_string = wp_remote_post("https://clients6.google.com/rpc", $args);
    if (is_wp_error($json_string)){
        // return zero if response is error                             
        return "0";             
    } else {        
        $json = json_decode($json_string['body'], true);                    
        // return count of Google +1 for requsted URL
        return intval( $json['result']['metadata']['globalCounts']['count'] ); 
    }

}

function print_r($var) {
    echo "<pre>";
    print_r($var);
    echo "</pre>";
}


public function getCount($url, $social_media, $follower_count = true, $meta_tag, $u) {
    if($meta_tag) {
        $meta_data = get_meta_tags( $url );
    } else {
        $json = wp_remote_get( $url, array( 'timeout' => 60 ) );
        // $this->print_r($json);
        if(!isset($json->errors) && isset($json['body']) ) {
            $parsed =  json_decode($json['body'],true);
          
        }
    }

    if(isset($json) || !empty($meta_data)) {
        $count = 0;
        switch ($social_media) {
            case 'facebook':
            if(!isset($parsed['error'])) {
                $share_count = (isset($parsed['share']['share_count']))?intval($parsed['share']['share_count']):0;
                $fan_count = (isset($parsed['fan_count']))?intval($parsed['fan_count']):0;
                $count = ($follower_count)?$fan_count:$share_count;
            } else {
                $count = 0;
            }
            break;

            case 'twitter':
            $share_count = (isset($parsed['count']))?intval($parsed['count']):0;
            $fan_count = (isset($parsed[0]['followers_count']))?intval($parsed[0]['followers_count']):0;
            $count = ($follower_count)?$fan_count:$share_count;
            break;

            case 'linkedin':
            $share_count = (isset($parsed['count']))?intval($parsed['count']):0;
            $fan_count = (isset($parsed[0]['followers_count']))?intval($parsed[0]['followers_count']):0;
            $count = ($follower_count)?$fan_count:$share_count;
            break;

            case 'google':
            $circledByCount = (isset($parsed['circledByCount']))?intval($parsed['circledByCount']):0;
            $count = ($follower_count)?$circledByCount:$this->getGooglePlusShareCount($u);
            break;

            case 'youtube':
            $subscriberCount = (isset($parsed['items'][0]['statistics']['subscriberCount']))?intval($parsed['items'][0]['statistics']['subscriberCount']):0;
            $count = ($follower_count)? $subscriberCount:'0';
            break;

            case 'vk':
            $share_count = (isset($parsed['response']['count']))?intval($parsed['response']['count']):0;
            $count = ($follower_count)?$share_count:'0';
            break;

            case 'instagram':
            $followed_by_count = (isset($parsed['user']['followed_by']['count']))?intval($parsed['user']['followed_by']['count']):0;
            $count = ($follower_count)?$followed_by_count:'0';
            break;

            case 'soundcloud':
            $followed_by_count = (isset($parsed['followings_count']))?intval($parsed['followings_count']):0;
            $count = ($follower_count)?$parsed['followings_count']:'0';
            break;

            case 'vimeo':
            $total = (isset($parsed['total']))?intval($parsed['total']):0;
            $count = ($follower_count)?$total:'0';
            break;

            case 'github':
            $followers = (isset($parsed['followers']))?intval($parsed['followers']):0;
            $count = ($follower_count)?$followers:'0';
            break;

            case 'stumbleupon':
            //$result_views = (isset($parsed['result']['views'])?$parsed['result']['views']):0;
            $count = ($follower_count)?0:((isset($parsed['result']['views']))?intval($parsed['result']['views']):0);
            break;

            case 'behance':
            $followers = (isset($parsed['user']['stats']['followers']))?intval($parsed['user']['stats']['followers']):0;
            $count = ($follower_count)?$followers:'';
            break;

            case 'pinterest':
            $followers = (isset($meta_data['pinterestapp:followers'])?intval($meta_data['pinterestapp:followers']):0);
            $count = ($follower_count)?$followers:'';

             if($follower_count) {
             $count = $followers;
             } else {
                $str = $json['body'];
                $str = str_replace('receiveCount(', '', $str);
                $str = str_replace(')', '', $str);
                $str =  json_decode($str,true);
                $count = $str['count'];
            }

            break;

            case 'tumblr':
            $likes = (isset($parsed['response']['blog']['likes'])?intval($parsed['response']['blog']['likes']):0);
            $count = ($follower_count)?$likes:'';
            break;

        default:
                # code...
        break;
    }

    return $count;
} else {
    return 0;
}
}
}
