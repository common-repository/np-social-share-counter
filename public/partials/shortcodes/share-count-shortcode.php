<?php defined('ABSPATH') or die("No script kiddies please!");
$npsc_settings = get_option( 'npsc_settings' );
$plugin = new NP_Counter();
$ss_counter_enable = (isset($npsc_settings['social_share']['ss_counter_enable']) && $npsc_settings['social_share']['ss_counter_enable'] == '1')?'1':'0';
$display_share_counter_type = (isset($npsc_settings['social_share']['counter_display']) && $npsc_settings['social_share']['counter_display'] != '')?esc_attr($npsc_settings['social_share']['counter_display']):'c1';
?>
<?php if($ss_counter_enable){
	if(isset($attr['custom_share_link']) && $attr['custom_share_link'] !=''){
		$share_link['url'] = esc_url($attr['custom_share_link']);
	}else{
		$share_link['url'] = (get_permalink() != FALSE) ? get_permalink() : NP_Social_Share_Counter_Public::curPageURL();
	}
	if( isset( $attr['counter_format']) && $attr['counter_format'] !=''){
		$counter_format = $attr['counter_format'];
	}else{
		$counter_format = $display_share_counter_type;
	}

	if(isset($attr['media'])) {
		$media = explode(',', $attr['media']);
	} else {

		$current_url = get_permalink();
        $social_share_porder = (isset($npsc_settings['social_share']['profile_order']) && !empty($npsc_settings['social_share']['profile_order']))?$npsc_settings['social_share']['profile_order']:array();

		foreach ($social_share_porder as $key => $value) {
			?>
			<div>
				<?php
				$media[] = $value;
				?>
			</div>
			<?php
		}
	}

	$tot_count = 0;
	if(isset($media) && !empty($media)):
		foreach ($media as $key => $value) {
			switch (trim($value)) {
				case 'facebook':
				$url = 'https://www.facebook.com/sharer.php?u='.get_permalink();
				break;

				case 'twitter':
				$url = 'https://twitter.com/intent/tweet?url='.get_permalink().'&text='.get_the_title().'&via=npsocialmedia&hashtags=='.get_the_title();
				break;

				case 'vk':
				$url = 'http://vk.com/share.php?url='.get_permalink();
				break;

				case 'google':
				$url = 'https://plus.google.com/share?url='.get_permalink();
				break;

				case 'tumblr':
				$url = 'https://www.tumblr.com/widgets/share/tool?canonicalUrl='.get_permalink();
				break;

				case 'linkedin':
				$url = 'https://www.linkedin.com/shareArticle?url='.get_permalink().'&title='.get_the_title();
				break;

				case 'whatsapp':
				$url = 'whatsapp://send?text='.$current_url;
				break;

				case 'stumbleupon':
				$url = '';
				break;

				case 'instagram':
				$url = '';
				break;


				case 'pinterest':
				$url = get_permalink();
				break;


				default:
						# code...
				break;
			}

			//$cnt =  $plugin->get_count($value,'share_count', $share_link);
			$dataarray = $plugin->get_social_counts($value, $follower_count = false, $meta_tag = false,$share_link);
			$cntt  = $dataarray['count'];
			$tot_count += $cntt;

		}
		endif;

		$total_share_count = NP_Social_Share_Counter_Public::displayNumberFormat($tot_count, $display_share_counter_type);
		echo $total_share_count;
	}
