<?php defined('ABSPATH') or die("No script kiddies please!");?>
<div class="npsc-wrapper-content npsc-cgeneral-content">
            <div class="npsc-row">
			 	<div class="npsc-col-2">
			 		<label for="hide_onmobile"><?php _e('Hide On Mobile','np-social-share-counter');?></label>
			 	</div>
			    <div class="npsc-col-6">
			 	  <input type="checkbox" name="counter[hide_on_mobile]" id="hide_onmobile" value="1" <?php if($hide_onmobile == 1) echo "checked='checked'";?>/>
			 	</div>
			 </div>

			 <div class="npsc-row">
			 	<div class="npsc-col-2">
			 		<label for="hide_counts"><?php _e('Hide the (fan/followers) counts','np-social-share-counter');?></label>
			 	</div>
			    <div class="npsc-col-6">
			 	  <input type="checkbox" name="counter[hide_counts]" id="hide_counts" value="1" <?php if($hide_counts == 1) echo "checked='checked'";?>/>
			 	</div>
			 </div>

			  <div class="npsc-row">
			 	<div class="npsc-col-2">
			 		<label><?php _e('Cache Period','np-social-share-counter');?></label>
			 	</div>
			    <div class="npsc-col-6">
			 	  <input type="number" name="counter[cache_period]" id="cache_period" value="<?php echo intval($cache_period)?>"/>
			 	</div>
			 </div>

			   <div class="npsc-row">
			 	<div class="npsc-col-2">
			 		<label><?php _e('Link Target','np-social-share-counter');?></label>
			 	</div>
			    <div class="npsc-col-6">
			 	 <select name="counter[link_target]">
			 	 	<option value="_blank" <?php selected( $link_target,'_blank'); ?>>_blank</option>
			 	 	<option value="_self" <?php selected( $link_target,'_self'); ?>>_self</option>
			 	 	<option value="_top" <?php selected( $link_target,'_top'); ?>>_top</option>
			 	 	<option value="_parent" <?php selected( $link_target,'_parent'); ?>>_parent</option>
			 	 </select>
			 	</div>
			 </div>
</div>