<?php defined('ABSPATH') or die("No script kiddies please!");?>
<div class="npssc-how-to-use">
<h1>How To Use</h1>
<br/>
	<p>
	<strong>NP Social Share Counter </strong> is free WordPress Social Media Plugin which allows to share your site's content of page, post on social media such as Facebook, Twitter, LinkedIn, StumbleUpon, Google, Tumblr, VK, Whatapp and Pinterest. Also show your social account's fans, subscribers and followers number on your website.
	Encourage your site viewers to connect to your network. Increase your social media reach drastically by making your site social share friendly.

	Our plugin includes altogether 5 pre available templates for social share as well as counter. <br/><br/>
	<ol style="list-style:none;">
		<li>Template 1 : Flat Style</li>
		<li>Template 2 : Fancy Style</li>
		<li>Template 3 : Standard Style</li>
		<li>Template 4 : Round Style</li>
		<li>Template 5 : Small Sized Style</li>
	</ol>
    <br/>
	<h2>Social Share Shortcode</h2>
	<hr/>
	<p>
	Shortcodes : 
	<br/>For e.g., <br/>
	[npssc_share template="2" show_counter="1" position="share_top_mini" button_styles="button_text_only"]
	<br/><br/>
	<h3>Available Shortcodes:</h3><br/><br/>
	<ul style="list-style:none;border-bottom:none;">
		<li>1. template : Use this parameter to display social share icons with template as per your wish. Our plugin includes total 5 templates. Set template number on shortcode to display different template.<br/> For e.g.,[npssc_share template='1'] for template 1. [npssc_share template='2'] for template 2 and so on.
		  </li>
		<br/><br/>
		<li>2. show_counter: Use this parameter to display counter on share button. For example.,
		[npssc_share template='1' show_counter='1']</li> <br/> <br/>
		<li>button_styles:Use this parameter to change button styles to show either icon only, icon and text both or text only on social share button.
		<br/> [npssc_share template='1' button_styles="icon_and_text_both"] to display icon and text both, <br/> [npssc_share template='1' button_styles="button_icon_only"] to display icon only and <br/> [npssc_share template='1' button_styles="button_text_only"] to display text only
		</li> <br/> <br/>
		<li>3. position: Use this parameter to change share counter position.<br/> For example.,
		[npssc_share template='1' show_counter='1' position='share_left'] to display share counter on left position, <br/> [npssc_share template='1' show_counter='1' position='share_right'] to display share counter on right position, <br/>[npssc_share template='1' show_counter='1' position='share_top_mini'] to display share counter on top mini position and  <br/>[npssc_share template='1' show_counter='1' position='share_inside_button'] to display share counter inside button respectively.
		 </li><br/><br/>
		 <li>4. media: Use this parameter to display only specific social media share button.
		 <br/> For e.g., 
		 [npssc_share template='1' show_counter='1' media="facebook,twitter"] to display only facebook and twitter share buttons.</li>
	</ul>
   <b> To get the individual social share count, please use below shortcode</b>
   <br/>
    [npssc_share_total_counter template='3' media='facebook,twitter,linkedin,stumbleupon,google,tumblr,vk,whatsapp,pinterest' counter_format='c1 or c2 or c3']
    <br/> <br/>i.e ., 
	Note: Use social media value separated by "," .  <br/>For example [npssc_share_total_counter media="facebook,twitter" counter_format="c2"]
 <br/> <br/>
	<b>For Custom Share link: You can use custom share link also to fetch the share counts for custom url using below custom_share_link as parameter on shortcode as shown below:</b> <br/>
   [npssc_counter template='3' show_followers_counter='1' media='facebook,twitter' custom_share_link="https://--custom link here--"]
	</p>
	<br/>	
	<h2>Social Counter Shortcode</h2>
	<hr/>
	<p>
	<br/>For e.g., <br/>
	[npssc_counter template='1' show_followers_counter='1' counter_format="c1"]
	<br/><br/>
	<h3>Available Shortcodes:</h3><br/><br/>
	<ul style="list-style:none;border-bottom:none;">
		<li>1. template : Use this parameter to display social counter with 5 pre available template as per your wish. Our plugin includes total 5 templates. Set template number on shortcode to display different templates.<br/> For e.g.,[npssc_counter template='1'] for template 1. [npssc_counter template='2'] for template 2 and so on.
		  </li>
		<br/><br/>
		<li>2. counter_format: Use this parameter to change counter display format type. Our plugin includes 3 types of counter format. i.e c1 to display as number with comma (12,300) , c2 to display as 12.3K and c3 to display as number (12300 ).<br/> For example.,
		[npssc_counter template='1' counter_format='c2'] to display counter format in c2 i.e in 12.3k type.
		 </li><br/><br/>
		 <li>3. show_followers_counter: Use this parameter in order to hide fan/ followers count on social counter button.<br/><br/>
		 For eg., [npssc_counter template='1' show_followers_counter='1']
		 </li><br/><br/>
		<li>4. position: Use this parameter to change counter position.<br/> For example.,
		[npssc_counter template='1' show_followers_counter='1' position='left'] to display  counter on left position, <br/>[npssc_counter template='1' show_followers_counter='1' position='right'] to display counter on right position,<br/>[npssc_counter template='1' show_followers_counter='1' position='top_mini'] to display counter on top mini position and <br/> [npssc_counter template='1' show_followers_counter='1' position='inside_button'] to display counter inside button respectively.
		 </li><br/><br/>
	</ul>

	<b> To get the individual count, please use below shortcode: </b>
    <br/>
    [npssc_counter template='3' show_followers_counter='1' media='facebook,twitter,linkedin,instagram,google,vk,behance,pinterest']
    <br/> <br/>i.e ., 
	Note: Use social media value separated by "," .  <br/>For example [npssc_counter template='3' show_followers_counter='1' media='facebook,twitter'] to display only facebook and twitter counter.
	</p>
<br/><br/>
	<h3>Display Total Share Count Using below shortcode:</h3>
<br/>
	<p>[npssc_share_total_counter media='facebook,twitter' counter_format='c1 or c2 or c3']</p>
<br/><ul style="list-style:none;border-bottom:none;">
		<li>1. counter_format: Use this parameter to change counter display format type. Our plugin includes 3 types of counter format. i.e c1 to display as number with comma (12,300) , c2 to display as 12.3K and c3 to display as number (12300 ).<br/> For example.,
		[npssc_share_total_counter media="facebook,twitter" counter_format='c2'] to display counter format in c2 i.e in 12.3k type.
		 </li><br/><br/>
		 <li>2. media: Use this parameter to display only specific social media share total count.
		 <br/> For e.g., 
		 [npssc_share_total_counter media="facebook,twitter"] to display only facebook and twitter total share counts.</li>
	</ul>	
</p>
</div>