(function($) {})(jQuery);
jQuery('document').ready(function($){


	jQuery('input[name="huge_it_share_button_active"],input[name="huge_it_share_button_position_post"],input[name="huge_it_share_size"]').on('change',function(){
		callAjax();
	});
	
	jQuery('#post_position_list li input, #post_buttons_size_block li input').on('click',function(){
		jQuery(this).parent().parent().find('.active').removeClass('active');
		jQuery(this).parent().addClass('active');
	});
	
	function callAjax() {
		var share_post_id=jQuery('#huge_it_share_post_block').attr('rel');
		//var share_button_type=jQuery('#huge_it_share_button_type_post').val();
		var share_position=jQuery('input[name="huge_it_share_button_position_post"]:checked').val();
		var share_size=jQuery('input[name="huge_it_share_size"]:checked').val();
		var share_active = '';
		if(jQuery('input[name="huge_it_share_button_active"]').is(':checked')){share_active = 'on';}
		else {share_active = 'off';}
		
		//alert(share_post_id+' '+share_button_type+' '+share_position+' '+share_size);
		//var share_medias='';
		//var share_button_style='';

		jQuery.post(ajax_object.ajax_url, {
			action: 'my_action',
			post: "sharebuttonspostsidebar",
			post_id:share_post_id,
			//buttons:buttons,
			//type:share_button_type,
			position:share_position,
			active:share_active,
			size:share_size
			
			}, function(response) {
			if(response.success){
				//alert('success');
				//alert("message: "+response.position);
				//alert("message: "+response.size);
				//alert("message: "+response.type);
				
				//jQuery('#huge_it_share_button_type_post').val(response.type);
				
				jQuery('input[name="huge_it_share_button_position_post"]').removeAttr('checked');
				jQuery('input[value="'+response.position+'"]').attr('checked', 'checked');
				
				jQuery('input[name="huge_it_share_size"]').removeAttr('checked');
				jQuery('input[value="'+response.size+'"]').attr('checked', 'checked');
				
				jQuery('input[name="huge_it_share_button_active"]').removeAttr('checked');
				jQuery('input[value="'+response.active+'"]').attr('checked', 'checked');
			}
			else {
			  alert("Something went wrong");
			}
		},"json");
		return false;
	}
});