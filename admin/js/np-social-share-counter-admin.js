(function( $ ) {
	$(document).ready(function () {

	/**
	 * All of the code for your admin-facing JavaScript source
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


	 $('li.nav-tab-title a').click(function(){
	 	var tab_id = $(this).attr('data-id');
	 	$('ul.npsc-nav-tab-wrapper li').removeClass('ntab-active');
	 	$('.npsc-tab-content').hide().removeClass('current');
	 	$(this).parent().addClass('ntab-active');
	 	$("#"+tab_id).fadeIn('300').addClass('current');
	 });

	  $('li.nav-tab2-title a').click(function(){
	 	var tab_id = $(this).attr('data-id');
	 	$('ul.npsc-nav-tab2-wrapper li').removeClass('ntab-active');
	 	$('.npsc-tab2-content').hide().removeClass('current');
	 	$(this).parent().addClass('ntab-active');
	 	$("#"+tab_id).fadeIn('300').addClass('current');
	 });


	 $('.traggable-social-icons').sortable();
	 $('.npsc-counter-order-settings').sortable();
	 $('.npsc-share-settings').sortable();

      $('.npsc-wrapper-content fieldset').on('click', function(e) {
		      	if($(e.target).is('input[type="checkbox"]')){
		            //e.preventDefault();
		            return;
		        }
			   $(this).toggleClass('active-toggle');
               $(this).find('.field-wrapper').slideToggle('slow');
	   }).on('click', 'div.field-wrapper', function(e) {
			    // clicked on descendant div
			  e.stopPropagation();
	   });

   
     $('#nssc_lite_tabs').tabs().addClass('ui-tabs-vertical ui-helper-clearfix');
     $('#nssc_lite_display_tabs').tabs().addClass('ui-tabs-vertical ui-helper-clearfix');

     // $('.hide_tmp').hide();
     
      //Social Counter Template Preview
     $('.counter_temp').on('change',function(){
         var ctmp = $(this).val();
         $('.npsc_template_design').hide();
         $('#counter_' + ctmp).show();
     });
      var counter_template_type = $('.counter_temp option:selected').val();
      $('.npsc_template_design').hide();
      $('#counter_'+counter_template_type).show();

     $('.counter_display_place').on('change',function(){
         var display_tmp = $(this).val();
         $('.npsc_counter_place_design').hide();
         $('#'+display_tmp).show();
     });
      var counter_display_type = $('.counter_display_place option:selected').val();
      $('.npsc_counter_place_design').hide();
      $('#'+counter_display_type).show();

      //Share Counter Template Preview
      $('.share_templates').on('change',function(){
         var stmp = $(this).val();
         $('.npsc_template_share_design').hide();
         $('#share_'+stmp).show();
     });
      var share_template_type = $('.share_templates option:selected').val();
      $('.npsc_template_share_design').hide();
      $('#share_'+share_template_type).show();

      $('.share_counter_display').on('change',function(){
         var sstmp = $(this).val();
         $('.npsc_social_place_design').hide();
         $('#'+sstmp).show();
     });
      var share_counter_display = $('.share_counter_display option:selected').val();
      $('.npsc_social_place_design').hide();
      $('#'+share_counter_display).show();

     // initalise the dialog
     $('#nwpsc-my-dialog').dialog({
	    title: 'HOW TO GET GOOGLE PLUS API KEY INSTRUCTIONS',
	    dialogClass: 'wp-dialog',
	    autoOpen: false,
	    draggable: false,
	    width: 'auto',
	    modal: true,
	    resizable: false,
	    closeOnEscape: true,
	    position: {
	      my: "center",
	      at: "center",
	      of: window
	    },
	    open: function () {
	      // close dialog by clicking the overlay behind it
	      $('.ui-widget-overlay').bind('click', function(){
	        $('#nwpsc-my-dialog').dialog('close');
	      })
	    },
	    create: function () {
	      // style fix for WordPress admin
	      $('.ui-dialog-titlebar-close').addClass('ui-button');
	    },
	  });
// bind a button or a link to open the dialog
  $('a.open-my-dialog').click(function(e) {
    e.preventDefault();
    $('#nwpsc-my-dialog').dialog('open');
  });

  });//$(function () end
})( jQuery );