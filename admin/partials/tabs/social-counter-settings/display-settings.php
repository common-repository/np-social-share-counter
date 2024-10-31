<?php defined('ABSPATH') or die("No script kiddies please!");?> 
<div class="npsc-wrapper-content">
  	<div class="npsc-row">
  		<div class="npsc-col-2">
  			<label><?php _e('Choose Templates',NPC_SOCIAL_TEXT_DOMAIN);?></label>
  		</div>
  		<div class="npsc-col-6">
  			<select name="counter[counter_template]" class="counter_temp">
  				<option value="template1" <?php if($counter_template  == "template1") echo "selected='selected'";?>>Flat Style</option>
  				<option value="template2" <?php if($counter_template  == "template2") echo "selected='selected'";?>>Fancy Style</option>
  				<option value="template3" <?php if($counter_template  == "template3") echo "selected='selected'";?>>Standard Style</option>
  				<option value="template4" <?php if($counter_template  == "template4") echo "selected='selected'";?>>Round Style</option>
  				<option value="template5" <?php if($counter_template  == "template5") echo "selected='selected'";?>>Small Sized Style</option>
  			</select>
  		</div>
  	</div>
  	<div class="npsc_hide_tc npsc-row">
  		<div id="counter_template1" class="npsc_template_design">
  			<img src="<?php echo NPC_IMAGE_DIR;?>admin/images/counter_preview/counter_template1.png"/>
  		</div>
  		<div id="counter_template2" class="npsc_template_design">
  			<img src="<?php echo NPC_IMAGE_DIR;?>admin/images/counter_preview/counter_template2.png"/>
  		</div>
  		<div id="counter_template3" class="npsc_template_design">
  			<img src="<?php echo NPC_IMAGE_DIR;?>admin/images/counter_preview/counter_template3.png"/>
  		</div>
  		<div id="counter_template4" class="npsc_template_design">
  			<img src="<?php echo NPC_IMAGE_DIR;?>admin/images/counter_preview/counter_template4.png"/>
  		</div>
  		<div id="counter_template5" class="npsc_template_design">
  			<img src="<?php echo NPC_IMAGE_DIR;?>admin/images/counter_preview/counter_template5.png"/>
  		</div>
  	</div>

  	<div class="npsc-row">
  		<div class="npsc-col-2">
  			<label><?php _e('Counter Position  ',NPC_SOCIAL_TEXT_DOMAIN);?></label>
  		</div>
  		<div class="npsc-col-6">
  			<select name="counter[counter_position]" class="counter_display_place">
  				<option value="left" <?php if($counter_position  == "left") echo "selected='selected'";?>>Left</option>
  				<option value="right" <?php if($counter_position  == "right") echo "selected='selected'";?>>Right</option>
  				<option value="top_mini" <?php if($counter_position  == "top_mini") echo "selected='selected'";?>>Top Mini</option>
  				<option value="inside_button" <?php if($counter_position  == "inside_button") echo "selected='selected'";?>>Inside Button</option>
  			</select>
  		</div>
  	</div>

  	<div class="npsc_hide_tc npsc-row">
  		<div id="left" class="npsc_counter_place_design">
  			<img src="<?php echo NPC_IMAGE_DIR;?>admin/images/counter_position/left_position.png"/>
  		</div>
  		<div id="right" class="npsc_counter_place_design">
  			<img src="<?php echo NPC_IMAGE_DIR;?>admin/images/counter_position/right_position.png"/>
  		</div>
  		<div id="top_mini" class="npsc_counter_place_design">
  			<img src="<?php echo NPC_IMAGE_DIR;?>admin/images/counter_position/top_mini_position.png"/>
  		</div>
  		<div id="inside_button" class="npsc_counter_place_design">
  			<img src="<?php echo NPC_IMAGE_DIR;?>admin/images/counter_position/inside_button_position.png"/>
  		</div>
  	</div>

  	<div class="npsc-row">
  		<div class="npsc-col-2">
  			<label><?php _e('Choose Format',NPC_SOCIAL_TEXT_DOMAIN);?></label>
  		</div>
  		<div class="npsc-col-6">
  			<select name="counter[format]">
  				<option value="c1" <?php if($format  == "c1") echo "selected='selected'";?>>12,300</option>
  				<option value="c2" <?php if($format  == "c2") echo "selected='selected'";?>>12.3K</option>
  				<option value="c3" <?php if($format  == "c3") echo "selected='selected'";?>>12300 </option>
  			</select>
  		</div>
  	</div>

  </div>
