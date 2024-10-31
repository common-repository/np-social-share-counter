<?php defined('ABSPATH') or die("No script kiddies please!");?>
<div class="npsc-wrapper-content npsc-share-content">
  	<div class="npsc-row">
  		<div class="npsc-col-2">
  			<label><?php _e('Share Position',NPC_SOCIAL_TEXT_DOMAIN);?></label>
  		</div>
  		<div class="npsc-col-6">
  			<select name="social_share[share_position]" class="incontent_style">
  				<option value="top_content" <?php if($share_position_for_content  == "top_content") echo "selected='selected'";?>><?php _e('Top of the content',NPC_SOCIAL_TEXT_DOMAIN);?></option>
  				<option value="bottom_content" <?php if($share_position_for_content  == "bottom_content") echo "selected='selected'";?>><?php _e('Bottom of the content',NPC_SOCIAL_TEXT_DOMAIN);?></option>
  			</select>
  		</div>
  	</div>

  	<div class="npsc-row">
    	<div class="npsc-col-2">
    			<label><?php _e('Share Options',NPC_SOCIAL_TEXT_DOMAIN);?></label>
    		</div>
    		<div class="npsc-col-6">
    	    <p class="description">
          <?php _e('Please choose the options where you want to display social share:',NPC_SOCIAL_TEXT_DOMAIN);?></p>
      		<p>
      			<label for="posts">Posts</label>
      			<input type="checkbox" name="counter[share_on][]" id="posts" value="post" <?php if(in_array('post', $share_on)) echo "checked='checked'";?>/>
      		</p>
      		<p>
      			<label for="pages">Pages</label>
      			<input type="checkbox" name="counter[share_on][]" id="pages" value="page" <?php if(in_array('page', $share_on)) echo "checked='checked'";?>/>
      		</p>
      		<p>
      			<label for="front_page">Front Page</label>
      			<input type="checkbox" name="counter[share_on][]" id="front_page" value="front_page" <?php if(in_array('front_page', $share_on)) echo "checked='checked'";?>/>
      		</p>
    		</div>
  	</div>

  </div>