<?php defined('ABSPATH') or die("No script kiddies please!");?>
<div class="npsc-wrapper-content npsc-cgeneral-content">
  	<div class="npsc-row">
  		<div class="npsc-col-2">
  			<label for="ss_counter_enable"><?php _e('Social Share Counter Enable?',NPC_SOCIAL_TEXT_DOMAIN);?></label>
  		</div>
  		<div class="npsc-col-6">
  			<input type="checkbox" name="social_share[ss_counter_enable]" id="ss_counter_enable" 
        value="1" <?php if($ss_counter_enable == 1) echo "checked='checked'";?>/>
  		</div>
  	</div>

  	<div class="npsc-row">
  		<div class="npsc-col-2">
  			<label><?php _e('Counter Display Format:',NPC_SOCIAL_TEXT_DOMAIN);?></label>
  		</div>
  		<div class="npsc-col-6">
  			<select name="social_share[counter_display]">
  				<option value="c1" <?php if($sscounter_display == "c1") echo "selected='selected'";?>>1,200</option>
  				<option value="c2" <?php if($sscounter_display == "c2") echo "selected='selected'";?>>1K</option>
  				<option value="c3" <?php if($sscounter_display == "c3") echo "selected='selected'";?>>1200</option>
  			</select>
  		</div>
  	</div>
  	<div class="npsc-row">
  		<div class="npsc-col-2">
  			<label><?php _e('Link Options',NPC_SOCIAL_TEXT_DOMAIN);?></label>
  		</div>
  		<div class="npsc-col-6">
  			<select name="social_share[link_options]">s
  				<option value="new_window" <?php if($link_options == "new_window") echo "selected='selected'";?>><?php _e('Open In Same Window',NPC_SOCIAL_TEXT_DOMAIN);?></option>
  				<option value="tab_window" <?php if($link_options == "tab_window") echo "selected='selected'";?>><?php _e('Open In New Window/Tab',NPC_SOCIAL_TEXT_DOMAIN);?></option>
  			</select>
  		</div>
  	</div>
</div>
