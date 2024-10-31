<?php defined('ABSPATH') or die("No script kiddies please!");?>
<?php
$npsc_data = get_option('npsc_settings');
$hide_onmobile  =  (isset($npsc_data['counter']['hide_on_mobile']) && $npsc_data['counter']['hide_on_mobile'] == 1)?1:0;
$hide_counts  = (isset($npsc_data['counter']['hide_counts']) && $npsc_data['counter']['hide_counts'] == 1)?1:0;
$cache_period = (isset($npsc_data['counter']['cache_period']) && $npsc_data['counter']['cache_period'] != '')?intval($npsc_data['counter']['cache_period']):'24';
$link_target = (isset($npsc_data['counter']['link_target']) && $npsc_data['counter']['link_target'] != '')?esc_attr($npsc_data['counter']['link_target']):'_blank';
$counter_template  = (isset($npsc_data['counter']['counter_template']) && $npsc_data['counter']['counter_template'] != '')?esc_attr($npsc_data['counter']['counter_template']):'template1';
$counter_position  = (isset($npsc_data['counter']['counter_position']) && $npsc_data['counter']['counter_position'] != '')?esc_attr($npsc_data['counter']['counter_position']):'left';
$format  = (isset($npsc_data['counter']['format']) && $npsc_data['counter']['format'] != '')?esc_attr($npsc_data['counter']['format']):'c1';
//social share settings
$ss_counter_enable = (isset($npsc_data['social_share']['ss_counter_enable']) && $npsc_data['social_share']['ss_counter_enable'] == 1)?1:0;
$sscounter_display = (isset($npsc_data['social_share']['counter_display']) && $npsc_data['social_share']['counter_display'] != '')?esc_attr($npsc_data['social_share']['counter_display']):'c1';
$link_options = (isset($npsc_data['social_share']['link_options']) && $npsc_data['social_share']['link_options'] != '')?esc_attr($npsc_data['social_share']['link_options']):'popup_window';
$share_template = (isset($npsc_data['social_share']['share_template']) && $npsc_data['social_share']['share_template'] != '')?esc_attr($npsc_data['social_share']['share_template']):'template1';
$ssposition = (isset($npsc_data['social_share']['position']) && $npsc_data['social_share']['position'] != '')?esc_attr($npsc_data['social_share']['position']):'share_left';
$share_button_styles  = (isset($npsc_data['social_share']['button_styles']) && $npsc_data['social_share']['button_styles'] != '')?esc_attr($npsc_data['social_share']['button_styles']):'icon_and_text_both';
$share_position_for_content  = (isset($npsc_data['social_share']['share_position']) && $npsc_data['social_share']['share_position'] != '')?esc_attr($npsc_data['social_share']['share_position']):'top_content';
$share_on  = (isset($npsc_data['counter']['share_on']) && $npsc_data['counter']['share_on'] != '')?$npsc_data['counter']['share_on']:array();
?>
<div class="npsc-wrap" style="margin:10px 20px 0 2px;">
 <?php if(isset($_GET['message']) && $_GET['message'] == 1){?>
    <div class="npsc-message updated notice notice-success is-dismissible">
      <p><?php _e('Settings Saved Successfully.','np-social-share-counter');?></p>
    </div>
   <?php }else{
    if(isset($_GET['reset_message']) && $_GET['reset_message'] == 1){ ?>
    <div class="'npsc-message updated notice notice-success is-dismissible">
     <p><?php _e('Settings Reset Successfully.','np-social-share-counter');?></p>
    </div>
   <?php  } 
   }?>
   <div id="poststuff">
    <div id="post-body" class="metabox-holder columns-6">
      <!-- main content -->
      <div id="post-body-content">

        <div class="meta-box-sortables ui-sortable">


          <div class="npsc-navwrap postbox clearfix">
            <form method="post" action="<?php echo admin_url('admin-post.php');?>"
              class="npsc-settings-form">

              <?php include_once(NPC_SOCIAL_ADMIN_DIR.'/partials/class-np-social-share-counter-panel-head.php');?>
              <div class="clear"></div>
              <?php include_once(NPC_SOCIAL_ADMIN_DIR.'/partials/tabs/social-settings.php');?>
 
              <div class="npsc-form-header">

                <div class="npsc-top-header npsc-right">
                    <div class="btn_submit_form form-header-buttons">
                        <?php wp_nonce_field('npsc_nonce','npsc_nonce_field');?>
                        <input type="hidden" name="action" value="npsc_settings_action"/>
                        
                        <input type="submit" name="restore_btn" value="<?php _e('Reset Options',NPC_SOCIAL_TEXT_DOMAIN);?>" 
                        class="button-secondary button-large submit-button-reset fw-settings-form-reset-btn">
                        <i class="submit-button-separator"></i>
                        <input type="submit" name="submit_btn" value="<?php _e('Saves Changes',NPC_SOCIAL_TEXT_DOMAIN);?>" 
                        class="button-primary button-large submit-button-save">         
                    </div>

                </div>
                </div>
            </form>

          </div>
          <!-- .postbox -->
        </div>
      </div>
      <!-- post-body-content -->
    </div>
    <!-- #post-body .metabox-holder .columns-2 -->
    <br class="clear">
  </div>
  <!-- #poststuff -->
</div> <!-- .wrap -->










