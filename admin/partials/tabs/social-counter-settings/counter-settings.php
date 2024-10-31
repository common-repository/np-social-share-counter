<?php defined('ABSPATH') or die("No script kiddies please!");
$default_counter_order  = array(
  '0' => 'facebook',
  '1' => 'twitter',
  '2' => 'linkedin',
  '3' => 'instagram',
  '4' => 'google',
  '6' => 'vk',
  '7' => 'behance'
  );
$profile_corder = (isset($npsc_data['counter']['profile_order']))?$npsc_data['counter']['profile_order']:$default_counter_order;
?>
<div class="npsc-wrapper-content npsc-counter-order-settings">
 <?php 
 foreach ($profile_corder as $key => $value) {
// $custom_text = isset($npsc_data['counter']['icon_list'][$value]['custom_text'])?$npsc_data['counter']['icon_list'][$value]['custom_text']:'';
$share_show_cicon = (isset($npsc_data['counter']['icon_list'][$value]['show_icon']) && $npsc_data['counter']['icon_list'][$value]['show_icon'] == 1)?1:0;
if($value != "posts" && $value != "tumblr"  && $value != "whatsapp"){ ?>
   <fieldset>
     <legend>
      <span class="npsc-sortable" title="<?php _e('Sort',NPC_SOCIAL_TEXT_DOMAIN);?>"><i class="fa fa-arrows"></i></span>
      <input type="checkbox" name="counter[icon_list][<?php echo esc_attr($value);?>][show_icon]" value="1" <?php if($share_show_cicon == 1) echo "checked='checked'";?> title="<?php _e('Show/Hide',NPC_SOCIAL_TEXT_DOMAIN);?>"/>
      <input type="hidden" name="counter[profile_order][]" value="<?php echo esc_attr($value);?>">
      <span class="media-icon"><i class="fa fa-<?php echo esc_attr($value);?>"></i></span>
      <?php 
        if($value == "google"){
           _e(esc_attr(ucfirst($value)).' Plus', NPC_SOCIAL_TEXT_DOMAIN);
        }else{
          _e(esc_attr(ucfirst($value)), NPC_SOCIAL_TEXT_DOMAIN);
        }
      ?></legend>
      <?php switch ($value) {
       case 'facebook':
       ?>
       <div class="field-wrapper">
        <div class="npsc-field">
          <div class="npsc_field_wrap"><label><?php _e('Facebook Page ID/Page Name:',NPC_SOCIAL_TEXT_DOMAIN);?></label></div>
          <div class="npsc_input_wrap">
            <input type="text" name="counter[icon_list][facebook][page_id]" value="<?php echo (isset($npsc_data['counter']['icon_list']['facebook']['page_id']))?esc_attr($npsc_data['counter']['icon_list']['facebook']['page_id']):''; ?>">
          </div>
           <p class="description"><?php _e('Please enter the page ID or page name.For example: If your page url is https://www.facebook.com/example_name then your page ID is example_name.',NPC_SOCIAL_TEXT_DOMAIN);?>
          </p>
        </div>
        <div class="npsc-field">
          <div class="npsc_field_wrap"><label><?php _e('App ID:',NPC_SOCIAL_TEXT_DOMAIN);?></label></div>
          <div class="npsc_input_wrap">
            <input type="text" name="counter[icon_list][facebook][app_id]" value="<?php echo (isset($npsc_data['counter']['icon_list']['facebook']['app_id']))?esc_attr($npsc_data['counter']['icon_list']['facebook']['app_id']):''; ?>">
          </div>
          <p class="description">
          <?php _e('To get facebook app id please go to',NPC_SOCIAL_TEXT_DOMAIN);?>
          <a href="https://developers.facebook.com/ ">GET API KEY</a> 
          <?php _e('and create an app and get the App ID.',NPC_SOCIAL_TEXT_DOMAIN);?>
          </p>
        </div>
        <div class="npsc-field">
          <div class="npsc_field_wrap"><label><?php _e('App Secret:',NPC_SOCIAL_TEXT_DOMAIN);?></label></div>
          <div class="npsc_input_wrap"><input type="text" name="counter[icon_list][facebook][app_secret]" value="<?php echo (isset($npsc_data['counter']['icon_list']['facebook']['app_secret']))?esc_attr($npsc_data['counter']['icon_list']['facebook']['app_secret']):''; ?>"></div>
          <p class="description">
          <?php _e('To get Facebook App secret key please go to ',NPC_SOCIAL_TEXT_DOMAIN);?>
          <a href="https://developers.facebook.com/ ">GET API KEY</a>
          <?php _e('and create an app and get Facebook App secret key.',NPC_SOCIAL_TEXT_DOMAIN);?> 
          </p>
        
        </div>
         <div class="npsc-field">
          <div class="npsc_field_wrap"><label><?php _e('Default Count:',NPC_SOCIAL_TEXT_DOMAIN);?></label></div>
          <div class="npsc_input_wrap"><input type="text" name="counter[icon_list][facebook][dcount]" value="<?php echo (isset($npsc_data['counter']['icon_list']['facebook']['dcount']))?esc_attr(intval($npsc_data['counter']['icon_list']['facebook']['dcount'])):''; ?>"></div>
          <p class="description">
           <?php _e('Please enter the default count instead of 0 when API s are not available.',NPC_SOCIAL_TEXT_DOMAIN);?>
          </p>
        </div>
      </div>
      <?php
      break;
      case 'twitter':
      ?>
      <div class="field-wrapper">
        <div class="npsc-field">
          <div class="npsc_field_wrap"><label><?php _e('User Name:',NPC_SOCIAL_TEXT_DOMAIN);?> </label></div>
          <div class="npsc_input_wrap">
            <input type="text" name="counter[icon_list][twitter][username]" value="<?php echo (isset($npsc_data['counter']['icon_list']['twitter']['username']) && $npsc_data['counter']['icon_list']['twitter']['username'] != '')?esc_attr($npsc_data['counter']['icon_list']['twitter']['username']):''; ?>">
          </div>
          <p class="description">
            <?php _e('Please fill your twitter username here. For example:https://twitter.com/BBC then username is BBC.',NPC_SOCIAL_TEXT_DOMAIN);?>
          </p>
        </div>
         <div class="npsc-field">
          <div class="npsc_field_wrap"><label><?php _e('Default Count:',NPC_SOCIAL_TEXT_DOMAIN);?></label></div>
          <div class="npsc_input_wrap"><input type="text" name="counter[icon_list][twitter][dcount]" value="<?php echo (isset($npsc_data['counter']['icon_list']['twitter']['dcount']))?esc_attr(intval($npsc_data['counter']['icon_list']['twitter']['dcount'])):''; ?>"></div>
          <p class="description">
              <?php _e('Please enter the default count instead of 0 when API s are not available.',NPC_SOCIAL_TEXT_DOMAIN);?>
         </p>
        </div>
      </div>
      <?php
      break;
      case 'linkedin':
      ?>
      <div class="field-wrapper">
         <div class="npsc-field">
          <div class="npsc_field_wrap"><label> <?php _e('Profile Link:',NPC_SOCIAL_TEXT_DOMAIN);?></label></div>
          <div class="npsc_input_wrap">
           <input type="text" name="counter[icon_list][linkedin][profile_link]" value="<?php echo (isset($npsc_data['counter']['icon_list']['linkedin']['profile_link']))?esc_url($npsc_data['counter']['icon_list']['linkedin']['profile_link']):''; ?>">
         </div>
          <p class="description">
          <?php _e('Please enter your valid linkedin profile link url.',NPC_SOCIAL_TEXT_DOMAIN);?></p>
       </div>
     <div class="npsc-field">
          <div class="npsc_field_wrap"><label><?php _e('Default Count:',NPC_SOCIAL_TEXT_DOMAIN);?></label></div>
          <div class="npsc_input_wrap"><input type="text" name="counter[icon_list][linkedin][dcount]" value="<?php echo (isset($npsc_data['counter']['icon_list']['linkedin']['dcount']))?esc_attr(intval($npsc_data['counter']['icon_list']['linkedin']['dcount'])):''; ?>"></div>
       <p class="description">
<?php _e('Here Please enter the default count you want to display in the frontend since linkedin needs authentication and complicated mechanism to get the followers count. 
       So please use the default count for displaying the count in your site.',NPC_SOCIAL_TEXT_DOMAIN);?>
      </p>
     </div>
  </div>
  <?php
  break;
  case 'instagram':
  ?>
  <div class="field-wrapper">
   <div class="npsc-field">
    <div class="npsc_field_wrap"><label> <?php _e('Username:',NPC_SOCIAL_TEXT_DOMAIN);?></label></div>
    <div class="npsc_input_wrap">
     <input type="text" name="counter[icon_list][instagram][uname]" value="<?php echo (isset($npsc_data['counter']['icon_list']['instagram']['uname']))?esc_attr($npsc_data['counter']['icon_list']['instagram']['uname']):''; ?>">
   </div>
   <p class="description"><?php _e('Please fill your instagram username.',NPC_SOCIAL_TEXT_DOMAIN);?></p>
 </div>
 <div class="npsc-field">
          <div class="npsc_field_wrap"><label><?php _e('Default Count:',NPC_SOCIAL_TEXT_DOMAIN);?></label></div>
          <div class="npsc_input_wrap">
          <input type="text" name="counter[icon_list][instagram][dcount]" value="<?php echo (isset($npsc_data['counter']['icon_list']['instagram']['dcount']))?esc_attr(intval($npsc_data['counter']['icon_list']['instagram']['dcount'])):''; ?>"></div>
          <p class="description">
          <?php _e('Please enter the default count if there is no any followers count.',NPC_SOCIAL_TEXT_DOMAIN);?></p>
  </div>

</div>
<?php
break;
case 'google':
?>
<div class="field-wrapper">
  <div class="npsc-field">
    <div class="npsc_field_wrap"><label><?php _e('Google Plus Page Name or Profile ID:',NPC_SOCIAL_TEXT_DOMAIN);?>
    </label>
  </div>
  <div class="npsc_input_wrap">
    <input type="text" name="counter[icon_list][google][plus_profile_id]" value="<?php echo (isset($npsc_data['counter']['icon_list']['google']['plus_profile_id']))?esc_attr($npsc_data['counter']['icon_list']['google']['plus_profile_id']):''; ?>">
  </div>
</div>
<div class="npsc-field">
  <div class="npsc_field_wrap"><label><?php _e('API Key:',NPC_SOCIAL_TEXT_DOMAIN);?></label></div>
  <div class="npsc_input_wrap"> <input type="text" name="counter[icon_list][google][plus_api_key]" value="<?php echo (isset($npsc_data['counter']['icon_list']['google']['plus_api_key']))?esc_attr($npsc_data['counter']['icon_list']['google']['plus_api_key']):''; ?>"></div>
  <p class="description"><?php _e('Check instruction to get google plus api key :',NPC_SOCIAL_TEXT_DOMAIN);?>

  <a class="open-my-dialog"><?php _e('Follow Steps Here',NPC_SOCIAL_TEXT_DOMAIN);?>
  </a>
  </p>
</div>
 <div class="npsc-field">
          <div class="npsc_field_wrap"><label><?php _e('Default Count:',NPC_SOCIAL_TEXT_DOMAIN);?></label></div>
          <div class="npsc_input_wrap"><input type="text" name="counter[icon_list][google][dcount]" 
          value="<?php echo (isset($npsc_data['counter']['icon_list']['google']['dcount']))?esc_attr(intval($npsc_data['counter']['icon_list']['google']['dcount'])):''; ?>"></div>
  <p class="description">Please enter the default count to show on frontend.</p>
  </div>
</div>
<!-- The modal / dialog box, hidden somewhere near the footer -->
<div id="nwpsc-my-dialog" class="hidden" style="max-width:800px">
<h4>To get your API Key, please go to 
<a href="https://console.developers.google.com/project" target="_blank">GET GOOGLE API KEY</a> and now follow below steps:</h4>
 <ul>
   <li>1. Click to create project.</li>
   <li>2. Fill project name then new app dashboard will be created.</li>
   <li>3. Simply enable Google+ API by clicking on it.</li>
   <li>4. Simply enable Google+ API by clicking on it.</li>
   <li>5. Click on Browser key , copy browser key and paste in required Google API key of our plugin's google plus api key field.</li>
 </ul>
</div>
<?php
break;
case 'pinterest':
?>
<div class="field-wrapper">
 <div class="npsc-field">
  <div class="npsc_field_wrap"><label><?php _e('User Name:',NPC_SOCIAL_TEXT_DOMAIN);?></label></div>
  <div class="npsc_input_wrap">
    <input type="text" name="counter[icon_list][pinterest][username]" placeholder="trump" value="<?php echo (isset($npsc_data['counter']['icon_list']['pinterest']['username']))?esc_attr($npsc_data['counter']['icon_list']['pinterest']['username']):''; ?>">
  </div>
  <p class="description">
    <?php _e('Fill your pinterest profile name here.For example:http://www.pinterest.com/trump',NPC_SOCIAL_TEXT_DOMAIN);?>
  </p>
</div>
 <div class="npsc-field">
          <div class="npsc_field_wrap"><label><?php _e('Default Count:',NPC_SOCIAL_TEXT_DOMAIN);?></label></div>
          <div class="npsc_input_wrap"><input type="text" name="counter[icon_list][pinterest][dcount]" value="<?php echo (isset($npsc_data['counter']['icon_list']['pinterest']['dcount']))?esc_attr(intval($npsc_data['counter']['icon_list']['pinterest']['dcount'])):''; ?>"></div>
   <p class="description">
     <?php _e('Please enter the default count to show on frontend.',NPC_SOCIAL_TEXT_DOMAIN);?>
   </p>
</div>
</div>
<?php
break;
case 'vk':
?>
<div class="field-wrapper">
<div class="npsc-field">
 <div class="npsc_field_wrap"><label> <?php _e('Group ID:',NPC_SOCIAL_TEXT_DOMAIN);?></label></div>
 <div class="npsc_input_wrap"><input type="text" name="counter[icon_list][vk][user_id]" value="<?php echo (isset($npsc_data['counter']['icon_list']['vk']['user_id']))?esc_attr($npsc_data['counter']['icon_list']['vk']['user_id']):''; ?>"></div>
<p class="description">
<?php _e('Please enter your VK group ID.',NPC_SOCIAL_TEXT_DOMAIN);?></p>
</div>
 <div class="npsc-field">
          <div class="npsc_field_wrap"><label><?php _e('Default Count:',NPC_SOCIAL_TEXT_DOMAIN);?></label></div>
          <div class="npsc_input_wrap"><input type="text" name="counter[icon_list][vk][dcount]" value="<?php echo (isset($npsc_data['counter']['icon_list']['vk']['dcount']))?esc_attr(intval($npsc_data['counter']['icon_list']['vk']['dcount'])):''; ?>"></div>
 <p class="description">
 <?php _e('Please enter the default count to show on frontend when there is no API Key filled.',NPC_SOCIAL_TEXT_DOMAIN);?>
</p>
 </div>
</div>
<?php
break;
case 'behance':
?>
<div class="field-wrapper">
 <div class="npsc-field">
   <div class="npsc_field_wrap"><label><?php _e('Username:',NPC_SOCIAL_TEXT_DOMAIN);?> </label></div>
   <div class="npsc_input_wrap"> <input type="text" name="counter[icon_list][behance][user_name]" value="<?php echo (isset($npsc_data['counter']['icon_list']['behance']['user_name']))?esc_attr($npsc_data['counter']['icon_list']['behance']['user_name']):''; ?>"></div>
 <p class="description">
 <?php _e('Please enter your Behance Username.',NPC_SOCIAL_TEXT_DOMAIN);?></p>
 </div>
 <div class="npsc-field">
   <div class="npsc_field_wrap"><label><?php _e('API Key:',NPC_SOCIAL_TEXT_DOMAIN);?>  </label></div>
   <div class="npsc_input_wrap"><input type="text" name="counter[icon_list][behance][api_key]" value="<?php echo (isset($npsc_data['counter']['icon_list']['behance']['api_key']))?esc_attr($npsc_data['counter']['icon_list']['behance']['api_key']):''; ?>"></div>
 <p class="description"><?php _e('Please enter your Behance API Key.To get the API key please go to',NPC_SOCIAL_TEXT_DOMAIN);?>
  <a href="https://www.behance.net/dev/register" target="_blank">GET API KEY</a>
  <?php _e(' and register an app and get the API Key.',NPC_SOCIAL_TEXT_DOMAIN);?></p>
 </div>
  <div class="npsc-field">
          <div class="npsc_field_wrap"><label><?php _e('Default Count:',NPC_SOCIAL_TEXT_DOMAIN);?></label></div>
          <div class="npsc_input_wrap"><input type="text" name="counter[icon_list][behance][dcount]" value="<?php echo (isset($npsc_data['counter']['icon_list']['behance']['dcount']))?esc_attr(intval($npsc_data['counter']['icon_list']['behance']['dcount'])):''; ?>"></div>
        <p class="description">
         <?php _e('Please enter the default count to show on frontend and also when their is no username and API Key filled.',NPC_SOCIAL_TEXT_DOMAIN);?>
        </p>
        </div>
</div>
<?php
break;
?>
<?php
default:
break;
}
?>
</fieldset>
<?php  }
}
?>
</div>

