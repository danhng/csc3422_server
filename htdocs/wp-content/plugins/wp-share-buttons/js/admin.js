jQuery(document).ready(function () {

	jQuery('.pro input').change(function(){
		alert('Oops. This option are disabled in free version please follow the link on the top to get pro version.');
		return false;
	})

	jQuery('#socials-list li input').click(function(){
		if(jQuery(this).is(':checked')){
			jQuery('#huge-it-share-buttons-bottom li').eq(jQuery('#socials-list li input.text').index(this)).each(function(){jQuery(this).removeClass('none');});
			jQuery('#huge-it-share-buttons-top li').eq(jQuery('#socials-list li input.text').index(this)).each(function(){jQuery(this).removeClass('none');});
		}else{
			jQuery('#huge-it-share-buttons-bottom li').eq(jQuery('#socials-list li input.text').index(this)).each(function(){jQuery(this).addClass('none');});
			jQuery('#huge-it-share-buttons-top li').eq(jQuery('#socials-list li input.text').index(this)).each(function(){jQuery(this).addClass('none');});
		}
	});

	jQuery('#buttons_size_list  input').click(function(){
		var thisval=jQuery(this).val();
		if(thisval=="20"){jQuery('#buttons_size_block  h4').html('Small');}
		else if(thisval=="30"){jQuery('#buttons_size_block  h4').html('Medium');}
		else{jQuery('#buttons_size_block  h4').html('Big');}
		jQuery(this).parents('ul').find('li.active').removeClass('active');
		jQuery(this).parents('li').addClass('active');
		var i=0;
		jQuery(".huge-it-share-buttons li a").each(function(){
			strleft=thisval*i;
			strtop=thisval*jQuery('#styles_list li input:checked').val();
			jQuery(this).removeClass('size20 size30 size40');
			jQuery(this).addClass('size'+thisval);
			jQuery(this).css({'background-position':'-'+strleft+'px -'+strtop+'px','width':thisval,'height':thisval});
			i++;
		});
	});
	
	jQuery('#position_list input').click(function(){
		jQuery(this).parents('ul').find('li.active').removeClass('active');
		jQuery(this).parents('li').addClass('active');
		
		var arr=jQuery(this).val().split('-');
		if(arr[1]=='top'){
			jQuery('#huge-it-share-buttons-bottom').removeClass('active');
			jQuery('#huge-it-share-buttons-top').addClass('active');
		}else{
			jQuery('#huge-it-share-buttons-top').removeClass('active');
			jQuery('#huge-it-share-buttons-bottom').addClass('active');
		}
		
		if(arr[0]=="left"){
			jQuery('.huge-it-share-buttons h3').css({'text-align':'left'});
			jQuery('.huge-it-share-buttons ul').css({'float':'left'});
		}else if(arr[0]=="right"){
			jQuery('.huge-it-share-buttons h3').css({'text-align':'right'});
			jQuery('.huge-it-share-buttons ul').css({'float':'right'});
		}else {
			jQuery('.huge-it-share-buttons h3').css({'text-align':'center'});
			jQuery('.huge-it-share-buttons ul').css({'margin':'0px auto','float':'none','text-align':'center'});
		}
	});
	
	/*
	jQuery('#styles_list  input').click(function(){
		jQuery('#styles_list li').removeClass('active');
		jQuery(this).parent().addClass('active');
		var thisval=jQuery(this).val();
		jQuery(this).parents('ul').find('li.active').removeClass('active');
		jQuery(this).parents('li').addClass('active');
		var j=0;
		jQuery(".huge-it-share-buttons li a").each(function(){
			strleft=jQuery('#buttons_size_list  li input:checked').val()*j;
			strtop=thisval*jQuery('#buttons_size_list li input:checked').val();
			jQuery(this).removeClass('size20 size30 size40');
			jQuery(this).addClass('size'+jQuery('#buttons_size_list li input:checked').val());
			jQuery(this).css({'background-position':'-'+strleft+'px -'+strtop+'px','width':jQuery('#buttons_size_list li input:checked').val(),'height':jQuery('#buttons_size_list li input:checked').val()});
			j++;
		});
	});
	
	
	
	jQuery('#share_button_title_text').change(function(){jQuery('.huge-it-share-buttons h3').html(jQuery(this).val());});
	jQuery('#share_button_title_font_size').change(function(){
		var size = jQuery(this).val()+"px";
		jQuery('.huge-it-share-buttons h3').css({'font-size':size,'line-height':size});
	});
	jQuery('#share_button_title_color').change(function(){var color='#'+jQuery(this).val();jQuery('.huge-it-share-buttons h3').css({'color':color});});
	jQuery('#share_button_title_font_style_family').change(function(){var font = jQuery(this).val();jQuery('.huge-it-share-buttons h3').css({'font-family':font});});
	
	jQuery('#share_button_title_position').change(function(){
		if(jQuery(this).val()=="left"){
			jQuery('.huge-it-share-buttons h3').css({'float':'left','width':'auto'});
		}else if(jQuery(this).val()=="right"){
			jQuery('.huge-it-share-buttons h3').css({'float':'right','width':'auto'});
		}
		else {
			jQuery('.huge-it-share-buttons h3').css({'float':'none','width':'100%'});
		}
	});
	
	
	jQuery('#share_button_margin_between_buttons').change(function(){
		var margin = jQuery(this).val()+"px";
		jQuery('.huge-it-share-buttons-list li').css({'margin-left':margin,'margin-right':margin});
	});
	
	jQuery('#share_button_buttons_has_background').change(function(){
		if(jQuery(this).is(':checked')){
			jQuery('.huge-it-share-buttons-list li').removeClass('nobackground');
		}else{
			jQuery('.huge-it-share-buttons-list li').addClass('nobackground');
		}
	});

	jQuery('#share_button_buttons_background_padding').change(function(){
		var padding = jQuery(this).val()+"px";
		jQuery('.huge-it-share-buttons-list li').css({'padding':padding});
	});
	
	jQuery('#share_button_buttons_background_color').change(function(){
		var backgroundcolor='#'+jQuery(this).val();
		jQuery('.huge-it-share-buttons-list li').css({'background-color':backgroundcolor});
	});
	
	jQuery('#share_button_buttons_border_size').change(function(){
		var bordersize = jQuery(this).val()+"px";
		jQuery('.huge-it-share-buttons-list li').css({'border-width':bordersize});
	});
	
	jQuery('#share_button_buttons_border_style').change(function(){
		jQuery('.huge-it-share-buttons-list li').css({'border-style':jQuery(this).val()});
	});
	
	jQuery('#share_button_buttons_border_color').change(function(){
		var bordercolor='#'+jQuery(this).val();
		jQuery('.huge-it-share-buttons-list li').css({'border-color':bordercolor});
	});

	
	jQuery('#share_button_buttons_border_radius').change(function(){
		var borderradius = jQuery(this).val()+"px";
		jQuery('.huge-it-share-buttons-list li').css({'border-radius':borderradius});
	});
	
	
	
	jQuery('#share_button_block_has_background').change(function(){
		if(jQuery(this).is(':checked')){
			jQuery('.huge-it-share-buttons').removeClass('nobackground');
		}else{
			jQuery('.huge-it-share-buttons').addClass('nobackground');
		}
	});
	
	
	jQuery('#share_button_block_background_color').change(function(){
		var backgroundcolor='#'+jQuery(this).val();
		jQuery('.huge-it-share-buttons ').css({'background-color':backgroundcolor});
	});
	
	
	jQuery('#share_button_block_border_size').change(function(){
		var bordersize = jQuery(this).val()+"px";
		jQuery('.huge-it-share-buttons').css({'border-width':bordersize});
	});
	
	jQuery('#share_button_block_border_color').change(function(){
		var bordercolor='#'+jQuery(this).val();
		jQuery('.huge-it-share-buttons').css({'border-color':bordercolor});
	});
	
	jQuery('#share_button_block_border_radius').change(function(){
		var borderradius = jQuery(this).val()+"px";
		jQuery('.huge-it-share-buttons').css({'border-radius':borderradius});
		
	});
	
	jQuery('#share_button_margin_from_content').change(function(){
		var margin = jQuery(this).val()+"px";
		jQuery('#huge-it-share-buttons-bottom').css({'margin-top':margin});
	});

	jQuery('#share_button_margin_from_content').change(function(){
		var margin = jQuery(this).val()+"px";
		jQuery('#huge-it-share-buttons-top').css({'margin-bottom':margin});
	});
	*/
	var el = jQuery('#hugeit-share-buttons-preview-container');
	var elpos_original = el.offset().top;
	jQuery(window).scroll(function(){
		var elpos = el.offset().top;
		var windowpos = jQuery(window).scrollTop();
		var finaldestination = windowpos;
		if(windowpos<elpos_original) {
			finaldestination = elpos_original;
			el.stop().css({'top':3});
		} else {
			el.stop().animate({'top':finaldestination-elpos_original+40},500);
		}
	});
	
	
	var strel = jQuery('#hugeit_share-buttons-unique-options');
	var strelpos_original = strel.offset().top;
	jQuery(window).scroll(function(){
		var elpos = strel.offset().top;
		var windowpos = jQuery(window).scrollTop();
		var finaldestination = windowpos;
		if(windowpos<strelpos_original) {
			finaldestination = strelpos_original;
			strel.stop().css({'top':3});
		} else {
			strel.stop().animate({'top':finaldestination-elpos_original+90},500);
		}
	});
});