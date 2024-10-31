<?php defined('ABSPATH') or die("No script kiddies please!");
/**
 * Posted Data
 * 
 */
$_POST = array_map( 'stripslashes_deep', $_POST );
$npsc_settings = NP_Social_Share_Counter_Loader::sanitize_array($_POST);
update_option('npsc_settings', $npsc_settings);
wp_redirect(admin_url().'admin.php?page=np-social-share-counter&message=1');
exit();