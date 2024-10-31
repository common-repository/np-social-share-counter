<?php defined('ABSPATH') or die("No script kiddies please!");
$plugin = new NP_Counter();
global $post;
$npsc_settings = get_option( 'npsc_settings' );
$ss_counter_enable = (isset($npsc_settings['social_share']['ss_counter_enable']) && $npsc_settings['social_share']['ss_counter_enable'] == '1')?'1':'0';
$link_options = (isset($npsc_settings['social_share']['link_options']) && $npsc_settings['social_share']['link_options'] != '')?esc_attr($npsc_settings['social_share']['link_options']):'popup_window';
$share_template = (isset($npsc_settings['social_share']['share_template']) && $npsc_settings['social_share']['share_template'] != '')?esc_attr($npsc_settings['social_share']['share_template']):'template1';
$share_counter_type = (isset($npsc_settings['social_share']['counter_display']) && $npsc_settings['social_share']['counter_display'] != '')?esc_attr($npsc_settings['social_share']['counter_display']):'c1';
$position = (isset($npsc_settings['social_share']['position']) && $npsc_settings['social_share']['position'] != '')?esc_attr($npsc_settings['social_share']['position']):'share_left';
$buttonstyles = (isset($npsc_settings['social_share']['button_styles']) && $npsc_settings['social_share']['button_styles'] != '')?esc_attr($npsc_settings['social_share']['button_styles']):'icon_and_text_both';

if( isset( $attr['button_styles']) && $attr['button_styles'] !=''){
	$button_styles = 'npsc_'.$attr['button_styles'];
}else{
	$button_styles = 'npsc_'.$buttonstyles;
}
if( isset( $attr['template']) && $attr['template'] !=''){
	$template = 'npsc-template'.$attr['template'];
}else{
	$template = 'npsc-'.$share_template;
}
if( isset( $attr['show_counter'])){
  if($attr['show_counter'] =='1'){
    $counter_enable = 1;
    $scounter_class = 'npsc-show-scounter';
  }else{
    $counter_enable = 0;
    $scounter_class = 'npsc-hide-scounter';
  }
}else{
   if($ss_counter_enable == 1){
		$counter_enable = '1';
		$scounter_class = 'npsc-show-scounter';
	}else{
		$counter_enable = '0';
		$scounter_class ='npsc-hide-scounter';
	}
}
if( isset( $attr['position']) && $attr['position'] !=''){
    $social_share_position = 'npsc-counter-position-'.$attr['position'];
}else{
    $social_share_position = 'npsc-counter-position-'.$position;
}

$current_id = $post->ID;
$current_title = $post->post_title;
$current_title= str_replace('+', '%20', urlencode($current_title));
$current_url = get_the_permalink();
$content=strip_shortcodes(strip_tags(get_the_content()));
if(strlen($content) >= 100){
	$excerpt= substr($content, 0, 100).'...';
	$excerpt = str_replace('+', '%20', urlencode($excerpt));
}else{
	$excerpt = $content;
	$excerpt = str_replace('+', '%20', urlencode($excerpt));
}
if($ss_counter_enable == 1){
?>
<div class="npsc-social-share-wrapper <?php echo $template; ?> <?php echo $button_styles;?> <?php echo $social_share_position;?> <?php echo $scounter_class;?>">
	<div class="np-btn-count  npbtn-background np-has-background share-count">
			<?php
			if(isset($attr['media'])) {
				$media = explode(',', $attr['media']);
			} else {

				$current_url = get_permalink();
                $counter_profile_order = (isset($npsc_settings['social_share']['profile_order']) && !empty($npsc_settings['social_share']['profile_order']))?$npsc_settings['social_share']['profile_order']:array();
				foreach ($counter_profile_order as $key => $value) {
					?>
						<?php
						$media[] = $value;
						?>
					<?php
				}
			}
          if(isset($media) && !empty($media)):?>
			<ul class="np-networks-btns-wrapper np-networks-btns-content">
			<?php
				foreach ($media as $key => $value) {
					$value = trim($value);
					$custom_text = isset($npsc_settings['social_share']['icon_lists'][$value]['custom_text'])?esc_attr($npsc_settings['social_share']['icon_lists'][$value]['custom_text']):'';
					$share_show_icon = (isset($npsc_settings['social_share']['icon_lists'][$value]['show_icon']) && $npsc_settings['social_share']['icon_lists'][$value]['show_icon'] == 1)?1:0;
					
				    $dataa = $plugin->get_social_counts($value, $follower_count = false, $meta_tag = false,'#');
				    $cnt = $dataa['count'];
				    $share_link_url = (isset($dataa['share_link_url']) && $dataa['share_link_url'] != '')?esc_attr($dataa['share_link_url']):'#';
					$count_number_format = NP_Social_Share_Counter_Public::displayNumberFormat($cnt, $share_counter_type);
                     if($link_options == "popup_window"){
                        $popup_class = "npsc-popup_window";
                        $target="_self";
                     }else if($link_options == "new_window"){
                     	$popup_class = '';
                     	$target="_blank";
                     }else{
                     	$popup_class = '';
                     	$target="_self";

                     }
              $share_link_url = str_replace('##', $current_url ,$share_link_url);
              $share_link_url = str_replace('#title', $current_title ,$share_link_url);
              $share_link_url = str_replace('#excerpt', $excerpt ,$share_link_url);
              if($share_show_icon) {?>
			  <li class="npssc-icon-wrap">
                  <?php  if($value == "pinterest"){?>
                    <a href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());" class="np-network-btn np-<?php echo $value;?> np-has-count np-first <?php echo $popup_class;?>">
                   <?php }else{ ?>
                   <a rel="nofollow" target="<?php echo esc_attr($target);?>" data-url="<?php echo esc_url($share_link_url);?>" 
                   href="<?php echo esc_attr($share_link_url);?>"
                    class="np-network-btn np-<?php echo $value;?> np-has-count np-first <?php echo $popup_class;?>" title="Share on <?php echo ucwords($value);?>">
                    <?php } ?>
						<span class="npssc-network-label-wrapper">
							<span class="npssc-network-label npssc-<?php echo esc_attr($button_styles);?>">
					   	   <?php if($button_styles == "npsc_button_icon_only"){?>
					   	    	<i class="fa fa-<?php echo $value;?>"></i>
							<?php }else if($button_styles == "npsc_button_text_only"){ 
								echo $value;
							}else{
								?>
								<i class="fa fa-<?php echo esc_attr($value);?>"></i>
								<?php echo esc_attr($custom_text);
							} ?>
					        </span>
					        <?php if($value !="tumblr" || $value !="whatsapp"){ 
					        	if($scounter_class == "npsc-show-scounter"){?>
					        <span class="npssc-network-count"><?php echo esc_attr($count_number_format);?></span>
					        <?php }
					        } ?>
					   </span>
				  </a>
			  </li>
		 	<?php
		 	   }
		 	} 
		 	?>
			</ul>
			<?php
            endif;
			?>
		</div>
</div>
<?php }
