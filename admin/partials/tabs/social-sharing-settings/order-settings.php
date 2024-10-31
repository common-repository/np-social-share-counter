<?php defined('ABSPATH') or die("No script kiddies please!");
$default_order  = array(
  '0' => 'facebook',
  '1' => 'twitter',
  '2' => 'linkedin',
  '3' => 'stumbleupon',
  '4' => 'google',
  '5' => 'tumblr',
  '6' => 'vk',
  '7' => 'whatsapp',
  '8' => 'pinterest'
  );
$profile_order = (isset($npsc_data['social_share']['profile_order']))?$npsc_data['social_share']['profile_order']:$default_order;
// $profile_order = $default_order;?>
<div class="npsc-wrapper-content npsc-share-settings">
 <?php foreach ($profile_order as $key => $value) {
   $custom_text = isset($npsc_data['social_share']['icon_lists'][$value]['custom_text'])?esc_attr($npsc_data['social_share']['icon_lists'][$value]['custom_text']):'';
   $share_show_icon = (isset($npsc_data['social_share']['icon_lists'][$value]['show_icon']) && $npsc_data['social_share']['icon_lists'][$value]['show_icon'] == 1)?1:0;
   ?>
   <fieldset>
     <legend>
      <span class="npsc-sortable" title="<?php _e('Sort',NPC_SOCIAL_TEXT_DOMAIN);?>"><i class="fa fa-arrows"></i></span>     
      <input type="checkbox" name="social_share[icon_lists][<?php echo esc_attr($value);?>][show_icon]" value="1" <?php if($share_show_icon == 1) echo "checked='checked'";?>/>
      <input type="hidden" name="social_share[profile_order][]" value="<?php echo $value;?>">
      <span class="media-icon"><i class="fa fa-<?php echo $value;?>"></i></span>
      <?php if($value == "google"){
        $txt = __('Google Plus',NPC_SOCIAL_TEXT_DOMAIN);
      }else{
        $txt = esc_attr(ucfirst($value));
      }
      _e($txt,NPC_SOCIAL_TEXT_DOMAIN);
      ?>
    </legend>
    <div class="field-wrapper">
      <div class="npsc-field">
        <div class="npsc_field_wrap"><label><?php _e('Custom '. esc_attr(ucfirst($value)) .' Text',NPC_SOCIAL_TEXT_DOMAIN);?></label></div>
        <div class="npsc_input_wrap"><input type="text" name="social_share[icon_lists][<?php echo esc_attr($value);?>][custom_text]"
          value="<?php echo $custom_text; ?>"
          placeholder="<?php echo ucfirst(esc_attr($txt));?>">
        </div>
      </div>
    </div>
  </fieldset>
  <?php  }
  ?>
</div>
