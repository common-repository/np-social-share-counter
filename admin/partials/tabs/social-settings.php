<?php defined('ABSPATH') or die("No script kiddies please!");?>
<div id="nssc_lite_tabs">
    <div class="npsc-options-tabs-list">
        <ul>
            <li><a href="#tabs-1"><?php _e('Social Counter','np-social-share-counter');?></a></li>
            <li><a href="#tabs-2"><?php _e('Social Sharing Networks','np-social-share-counter');?></a></li>
            <li><a href="#tabs-3"><?php _e('How To Use','np-social-share-counter');?></a></li>
        </ul>
    </div>
    <div class="npsc-options-tabs-contents">
      <!-- social counter settings start-->
      <div id="tabs-1">
       <div class="npsc-tab-section">
        <ul class="npsc-nav-tab-wrapper">
            <li class="nav-tab-title  ntab-active">
                <a href="javascript:void(0);" class="npsc-nav-tab"
                data-id="general_settings"><?php _e('General Settings','np-social-share-counter');?></a>
            </li>
            <li class="nav-tab-title">
                <a href="javascript:void(0);" class="npsc-nav-tab ntab-active"
                data-id="social_settings"><?php _e('Counter Settings','np-social-share-counter');?></a>
            </li>
            <li class="nav-tab-title">
                <a href="javascript:void(0);" class="npsc-nav-tab"
                data-id="display_settings"><?php _e('Display Settings','np-social-share-counter');?></a>
            </li>
            
        </ul>
    </div>
    <div class="npsc-tab-content-wrapper clear">
        <div class="npsc-tab-content current" id="general_settings">
            <?php include_once(NPC_SOCIAL_ADMIN_DIR.'/partials/tabs/social-counter-settings/general-settings.php');?>
        </div>
        <div class="npsc-tab-content" id="social_settings">
            <?php include_once(NPC_SOCIAL_ADMIN_DIR.'/partials/tabs/social-counter-settings/counter-settings.php');?>
        </div>
        <div class="npsc-tab-content" id="display_settings">
            <?php include_once(NPC_SOCIAL_ADMIN_DIR.'/partials/tabs/social-counter-settings/display-settings.php');?>
        </div>
    </div>
</div>
<!-- social counter settings end -->

<!-- social sharing settings start -->
<div id="tabs-2">
   <div class="npsc-tab-section">
    <ul class="npsc-nav-tab2-wrapper">
        <li class="nav-tab2-title  ntab-active">
            <a href="javascript:void(0);" class="npsc-nav-tab"
            data-id="general_settings2"><?php _e('General Settings','np-social-share-counter');?></a>
        </li>
        <li class="nav-tab2-title">
            <a href="javascript:void(0);" class="npsc-nav-tab"
            data-id="share_settings"><?php _e('Share Settings','np-social-share-counter');?></a>
        </li>
        <li class="nav-tab2-title">
            <a href="javascript:void(0);" class="npsc-nav-tab ntab-active"
            data-id="social_settings2"><?php _e('Social Order Settings','np-social-share-counter');?></a>
        </li>
        <li class="nav-tab2-title">
            <a href="javascript:void(0);" class="npsc-nav-tab"
            data-id="display_settings2"><?php _e('Display Settings','np-social-share-counter');?></a>
        </li>

    </ul>
</div>
<div class="npsc-tab-content-wrapper clear">
    <div class="npsc-tab2-content current" id="general_settings2">
        <?php include_once(NPC_SOCIAL_ADMIN_DIR.'/partials/tabs/social-sharing-settings/general-settings.php');?>
    </div>
     <div class="npsc-tab2-content" id="share_settings">
        <?php include_once(NPC_SOCIAL_ADMIN_DIR.'/partials/tabs/social-sharing-settings/share-settings.php');?>
    </div>
    <div class="npsc-tab2-content" id="social_settings2">
        <?php include_once(NPC_SOCIAL_ADMIN_DIR.'/partials/tabs/social-sharing-settings/order-settings.php');?>
    </div>
    <div class="npsc-tab2-content" id="display_settings2">
        <?php include_once(NPC_SOCIAL_ADMIN_DIR.'/partials/tabs/social-sharing-settings/display-settings.php');?>
    </div>

</div>

</div>
 <div id="tabs-3">
       <div class="npsc-tab-section">
        <?php include_once(NPC_SOCIAL_ADMIN_DIR.'/partials/tabs/social-counter-settings/how-to-use.php');?>
       </div>
</div>
<!-- social sharing settings end -->
</div>
</div>
<div class="clear"></div>
