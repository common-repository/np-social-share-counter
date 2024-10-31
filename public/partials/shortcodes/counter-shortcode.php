<?php defined('ABSPATH') or die("No script kiddies please!");
$plugin = new NP_Counter();
$npsc_settings = get_option( 'npsc_settings' );
$default_hide_counts = (isset($npsc_settings['counter']['hide_counts']) && $npsc_settings['counter']['hide_counts'] == '1')?'1':'0';
$hide_onmobile = (isset($npsc_settings['counter']['hide_on_mobile']) && $npsc_settings['counter']['hide_on_mobile'] == '1')?1:0;
$link_options = (isset($npsc_settings['counter']['link_options']) && $npsc_settings['counter']['link_options'] != '')?esc_attr($npsc_settings['counter']['link_options']):'popup_window';
$counter_template = (isset($npsc_settings['counter']['counter_template']) && $npsc_settings['counter']['counter_template'] != '')?esc_attr($npsc_settings['counter']['counter_template']):'template1';
$counter_format = (isset($npsc_settings['counter']['format']) && $npsc_settings['counter']['format'] != '')?esc_attr($npsc_settings['counter']['format']):'c1';
$counter_position = (isset($npsc_settings['counter']['counter_position']) && $npsc_settings['counter']['counter_position'] != '')?esc_attr($npsc_settings['counter']['counter_position']):'left';
$link_target = (isset($npsc_settings['counter']['link_target']) && $npsc_settings['counter']['link_target'] != '')?esc_attr($npsc_settings['counter']['link_target']):'_blank';

if( isset( $attr['template']) && $attr['template'] !=''){
    $template = 'npsc-counter-template'.$attr['template'];
}else{
    $template = 'npsc-counter-'.$counter_template;
}
if( isset( $attr['counter_format']) && $attr['counter_format'] !=''){
    $counter_format = $attr['counter_format'];
}else{
    $counter_format = $counter_format;
}

if( isset( $attr['position']) && $attr['position'] !=''){
    $counter_position = $attr['position'];
}else{
    $counter_position = $counter_position;
}
if( isset( $attr['show_followers_counter'])){
  if($attr['show_followers_counter'] =='1'){
    $counter_enable1 = 1;
    $counter_class = 'npsc-show-fcounter';
  }else{
    $counter_enable1 = 0;
    $counter_class = 'npsc-hide-fcounter';
  }
}else{
  if($default_hide_counts == 1){
        $counter_enable1 = '0';
        $counter_class ='npsc-hide-fscounter';
    }else{
       $counter_enable1 = '1';
       $counter_class = 'npsc-show-fscounter';
   }
}
if( isset( $attr['total_counter']) && $attr['total_counter'] =='1'){
    $total_counter_enable = $attr['total_counter'];
    $totcounter_class = 'npsc-show-total-counter';
}else{
    $total_counter_enable = '0';
    $totcounter_class = '';
}
if($hide_onmobile == 1){
    $hidemobile_responsive_class = "npsc-hide-onmobile";
}else{
    $hidemobile_responsive_class = "npsc-show-onmobile";
}
?>
<div class="npsc-social-counter-wrapper <?php echo esc_attr($template); ?> <?php echo esc_attr($counter_class);?> <?php echo esc_attr($totcounter_class);?> npsc-position-<?php echo esc_attr($counter_position);?> <?php echo esc_attr($hidemobile_responsive_class);?>">
    <div class="np-btn-count npbtn-background np-has-background share-count">
        <ul class="np-networks-btns-wrapper np-networks-btns-content">
            <?php
             $share_link['url'] = (get_permalink() != FALSE) ? get_permalink() : NP_Social_Share_Counter_Public::curPageURL();
            if(isset($attr['media'])) {
                $media = explode(',', $attr['media']);
            } else {
                $current_url = get_permalink();
                $profile_order = (isset($npsc_settings['counter']['profile_order']) && !empty($npsc_settings['counter']['profile_order']))?$npsc_settings['counter']['profile_order']:array();

                foreach ($profile_order as $key => $value) {
                    ?>
                        <?php
                        $media[] = $value;
                        ?>
                    <?php
                }
            }
           // $animation = (isset($npsc_settings['counter']['animation']) && $npsc_settings['counter']['animation'] != '')?esc_attr($npsc_settings['counter']['animation']):'pulse';
            $settings = array();
            $totalcount = 0;
            $content = '<div class="np-btn-count npbtn-background np-has-background npssc-'.$counter_template.'">
            <ul class="np-networks-btns-wrapper np-networks-btns-content">';
                foreach ($media as $key => $value) {
                    $value = trim($value);
                   if($value != 'posts' && $value != "tumblr"){
                    $dataa = $plugin->get_social_counts($value, $follower_count = true, $meta_tag = false,  '#');
                    $share_link_url = (isset($dataa['share_link_url']) && $dataa['share_link_url'] != '')?esc_url($dataa['share_link_url']):'#';
                    $view_url = (isset($dataa['url']) && $dataa['url'] != '')?esc_url($dataa['url']):'#';
                    if($value == "google"){
                        $share_link_url = $view_url;
                    }
                    $show_icon = (isset($npsc_settings['counter']['icon_list'][$value]['show_icon']) && $npsc_settings['counter']['icon_list'][$value]['show_icon'] == 1)?1:0;
                    $totcnt =  intval($totalcount) + intval($dataa['count']);
                    $number_format = NP_Social_Share_Counter_Public::displayNumberFormat($totcnt, $counter_format);
                    if($show_icon){ 
                    if($value == "facebook" || $value == "twitter" || $value == "google" || 
                        $value == "instagram" || $value == "vk" || $value == "linkedin"){
                        $follow_text = __('Follow',NPC_SOCIAL_TEXT_DOMAIN);
                    }else{
                        $follow_text = __('Subscribe',NPC_SOCIAL_TEXT_DOMAIN);
                    }
                    $content .= '<li>
                    <a rel="nofollow" href="'.esc_url($dataa['share_link_url']).'" class="np-network-btn np-'.esc_attr($value).' np-has-count np-first" target="'.esc_attr($link_target).'" title="'.esc_attr($follow_text).'">
                        <span class="np-network-label-wrapper">
                            <span class="np-network-label">
                                <i class="fa fa-'.esc_attr($value).'"></i> '.ucfirst(esc_attr($value)).'</span>';
                               if($counter_enable1 == 1){
                                $content .='<span class="np-network-count">'.esc_attr($number_format).'</span>';
                              }
                            $content .='</span>
                        </a>';
                      $content .= '</li>';
                    }
                 }
                }
                $content .= ' </ul></div>';
                echo $content;
            ?>
        </div>
    </ul>
</div>
