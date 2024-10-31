(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	 function pinIt()
		{
		  var e = document.createElement('script');
		  e.setAttribute('type','text/javascript');
		  e.setAttribute('charset','UTF-8');
		  e.setAttribute('src','https://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);
		  document.body.appendChild(e);
		}


	 $(document).ready(function () {
	 	$("a.npsc-popup_window").click(function () {
	 		if($(this).attr('title') == "Share on Pinterest"){
            pinIt();
	 		}else if($(this).attr('title') == "Share on Whatsapp" || $(this).attr('title') =="Share on Tumblr"){
	 			return false;
	 		}
	 		else{
	 		var left =  screen.width/2 - 700/2;
	 		var tops = screen.height/2 - 450/2;
	 		window.open($(this).data("url"),"mywindow","toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=yes,status=no,width=640,height=320, top="+tops+", left="+left);
	 		return false;
	
	 		}
	 	});

	 	$("a.npsc-tab_window").click(function () {
	 		window.open($(this).attr("href"));
	 		return false;
	 	});

	 })
	})( jQuery );
