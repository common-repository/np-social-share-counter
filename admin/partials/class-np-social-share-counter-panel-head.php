<?php defined('ABSPATH') or die("No script kiddies please!");?>     
<div class="npsc-form-header">
<div class="npsc-top-header">
    <h2><?php echo NPC_TITLE;?>  <a href="http://supazthemes.com/" target="_blank">
    <small>by Supaz Themes</small></a></h2>
</div>
<div class="npsc-top-header  npsc-right">
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
