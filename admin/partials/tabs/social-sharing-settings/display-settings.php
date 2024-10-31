<?php defined('ABSPATH') or die("No script kiddies please!");?> 
<div class="npsc-wrapper-content">
			 <div class="npsc-row">
			 	<div class="npsc-col-2">
			 		<label><?php _e('Choose Templates',NPC_SOCIAL_TEXT_DOMAIN);?></label>
			 	</div>
			    <div class="npsc-col-6">
			 	   <select name="social_share[share_template]" class="share_templates">
			 	   	<option value="template1" <?php if($share_template  == "template1") echo "selected='selected'";?>><?php _e('Flat Style',NPC_SOCIAL_TEXT_DOMAIN);?></option>
			 	   	<option value="template2" <?php if($share_template  == "template2") echo "selected='selected'";?>><?php _e('Fancy Style',NPC_SOCIAL_TEXT_DOMAIN);?></option>
			 	   	<option value="template3" <?php if($share_template  == "template3") echo "selected='selected'";?>><?php _e('Standard Style',NPC_SOCIAL_TEXT_DOMAIN);?></option>
			 	   	<option value="template4" <?php if($share_template  == "template4") echo "selected='selected'";?>><?php _e('Round Style',NPC_SOCIAL_TEXT_DOMAIN);?></option>
			 	   	<option value="template5" <?php if($share_template  == "template5") echo "selected='selected'";?>><?php _e('Small Sized Style',NPC_SOCIAL_TEXT_DOMAIN);?></option>
			 	   </select>
			 	</div>
			 </div>
			 <div class="npsc_hide_tc npsc-row">
			 	<div id="share_template1" class="npsc_template_share_design">
			 		<img src="<?php echo NPC_IMAGE_DIR;?>admin/images/social_share_preview/share_template1.png"/>
			 	</div>
			 	<div id="share_template2" class="npsc_template_share_design">
			 		<img src="<?php echo NPC_IMAGE_DIR;?>admin/images/social_share_preview/share_template2.png"/>
			 	</div>
			 	<div id="share_template3" class="npsc_template_share_design">
			 		<img src="<?php echo NPC_IMAGE_DIR;?>admin/images/social_share_preview/share_template3.png"/>
			 	</div>
			 	<div id="share_template4" class="npsc_template_share_design">
			 		<img src="<?php echo NPC_IMAGE_DIR;?>admin/images/social_share_preview/share_template4.png"/>
			 	</div>
			 	<div id="share_template5" class="npsc_template_share_design">
			 		<img src="<?php echo NPC_IMAGE_DIR;?>admin/images/social_share_preview/share_template5.png"/>
			 	</div>
			 </div>

			 <div class="npsc-row">
			 	<div class="npsc-col-2">
			 		<label><?php _e('Share Counter Position',NPC_SOCIAL_TEXT_DOMAIN);?></label>
			 	</div>
			 	
			    <div class="npsc-col-6">
			 	   <select name="social_share[position]" class="share_counter_display">
			 	   	<option value="share_left" <?php if($ssposition  == "share_left") echo "selected='selected'";?>><?php _e('Left',NPC_SOCIAL_TEXT_DOMAIN);?></option>
			 	   	<option value="share_right" <?php if($ssposition  == "share_right") echo "selected='selected'";?>><?php _e('Right',NPC_SOCIAL_TEXT_DOMAIN);?></option>
			 	   	<option value="share_top_mini" <?php if($ssposition  == "share_top_mini") echo "selected='selected'";?>><?php _e('Top Mini',NPC_SOCIAL_TEXT_DOMAIN);?></option>
			 	   	<option value="share_inside_button" <?php if($ssposition  == "share_inside_button") echo "selected='selected'";?>><?php _e('Inside Button',NPC_SOCIAL_TEXT_DOMAIN);?></option>
			 	   </select>
			 	</div>
			 </div>

			 <div class="npsc_hide_tc npsc-row">
			 	<div id="share_left" class="npsc_social_place_design">
			 		<img src="<?php echo NPC_IMAGE_DIR;?>admin/images/counter_position/left_position.png"/>
			 	</div>
			 	<div id="share_right" class="npsc_social_place_design">
			 		<img src="<?php echo NPC_IMAGE_DIR;?>admin/images/counter_position/right_position.png"/>
			 	</div>
			 	<div id="share_top_mini" class="npsc_social_place_design">
			 			<img src="<?php echo NPC_IMAGE_DIR;?>admin/images/counter_position/top_mini_position.png"/>
			 	</div>
			 	<div id="share_inside_button" class="npsc_social_place_design">
			 		<img src="<?php echo NPC_IMAGE_DIR;?>admin/images/counter_position/inside_button_position.png"/>
			 	</div>
			 </div>

			   <div class="npsc-row">
			 	<div class="npsc-col-2">
			 		<label><?php _e('Share Button Styles',NPC_SOCIAL_TEXT_DOMAIN);?></label>
			 	</div>
			    <div class="npsc-col-6">
			 	   <select name="social_share[button_styles]">
			 	   	<option value=""><?php _e('No Button Style',NPC_SOCIAL_TEXT_DOMAIN);?></option>
			 	   	<option value="button_icon_only" <?php if($share_button_styles  == "button_icon_only") echo "selected='selected'";?>><?php _e('BUTTON WITH ICON ONLY',NPC_SOCIAL_TEXT_DOMAIN);?></option>
			 	   	<option value="button_text_only" <?php if($share_button_styles  == "button_text_only") echo "selected='selected'";?>><?php _e('BUTTON WITH TEXT ONLY',NPC_SOCIAL_TEXT_DOMAIN);?></option>
			 	   	<option value="icon_and_text_both" <?php if($share_button_styles  == "icon_and_text_both") echo "selected='selected'";?>><?php _e('BUTTON WITH ICON & TEXT',NPC_SOCIAL_TEXT_DOMAIN);?></option>
			 	   </select>
			 	</div>
			 </div>
</div>