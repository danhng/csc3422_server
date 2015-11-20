<?php
function      html_showStyles($social_buttons, $param_values)
{
 global $wpdb;
	if(isset($_GET["addslide"]) && $_GET["addslide"]==  1){
	header('Location: admin.php?page=hugeit_share-buttonss_huge_it_share-buttons&id='.$row->id.'&task=apply');
	}
	
	if(isset($_GET["inputtype"]) && $_GET["inputtype"] !=''){
	header('Location: admin.php?page=hugeit_share-buttonss_huge_it_share-buttons&id='.$row->id.'&task=apply');
	}
?>
<div class="wrap">
	<?php $path_site2 = plugins_url("../images", __FILE__); ?>
		<div class="share-options-head">
		<div style="float: left;">
			<div><a href="http://huge-it.com/wordpress-share-buttons-user-manual/" target="_blank">User Manual</a></div>
			<div>This section allows you to configure the Share Buttons options. <a href="http://huge-it.com/wordpress-share-buttons-user-manual/" target="_blank">More...</a></div>
		</div>
		<div style="float: right;">
			<a class="header-logo-text" href="http://huge-it.com/share-buttons/" target="_blank">
				<div><img width="250px" src="<?php echo $path_site2; ?>/huge-it1.png" /></div>
				<div>Get the full version</div>
			</a>
		</div>
	</div>
	<div style="clear: both;"></div>
<form action="admin.php?page=huge_it_share_buttons&task=save" method="post" id="adminForm" name="adminForm">
	<div id="poststuff" >
		<div id="post-body" class="metabox-holder columns-2">
		<!-- Content -->
			<div id="post-body-content">
				<?php add_thickbox(); ?>
				
				<div id="post-body-heading">
					<h3>Share Buttons</h3>
				</div>
				<div id="options-block">
					<?php $path_site = plugins_url("/../images", __FILE__); ?>
				
					<!--
					<div>
						<h3>Buttons type</h3>
						<div>
							<label><input type="radio" value="toolbar" name="params[share_button_type]" <?php if($param_values['share_button_type'] == 'toolbar'){echo 'checked="checked"';} ?>>Toolbar</label>
							<label><input type="radio" value="counters" name="params[share_button_type]" <?php if($param_values['share_button_type'] == 'counters'){echo 'checked="checked"';} ?>>Counters</label>
						</div>
					</div>
					-->
					<div>
						<h3>Share Buttons Social Medias</h3>
						<ul id="socials-list">
							<li <?php if($param_values['share_facebook_button'] == 'on'){echo 'class="active"';} ?>>
								<label>
								<input type="hidden" name="params[share_facebook_button]" value="" />
								<input class="socials_0 text" type="checkbox" <?php if($param_values['share_facebook_button'] == 'on'){echo 'checked="checked"';} ?> name="params[share_facebook_button]" value="on" />Facebook</label>
							</li>
							<li <?php if($param_values['share_twitter_button'] == 'on'){echo 'class="active"';} ?>>
								<label>
								<input type="hidden" name="params[share_twitter_button]" value="" />
								<input  class="socials_1 text" type="checkbox" <?php if($param_values['share_twitter_button'] == 'on'){echo 'checked="checked"';} ?> name="params[share_twitter_button]" value="on" />Twitter</label>
							</li>
							<li <?php if($param_values['share_pinterest_button'] == 'on'){echo 'class="active"';} ?>>
								<input type="hidden" name="params[share_pinterest_button]" value="" />
								<label><input  class="socials_4 text" type="checkbox" <?php if($param_values['share_pinterest_button'] == 'on'){echo 'checked="checked"';} ?> name="params[share_pinterest_button]" value="on" />Pinterest</label>
							</li>
							<li <?php if($param_values['share_google_plus_button'] == 'on'){echo 'class="active"';} ?>>
								<input type="hidden" name="params[share_google_plus_button]" value="" />
								<label><input  class="socials_2 text" type="checkbox" <?php if($param_values['share_google_plus_button'] == 'on'){echo 'checked="checked"';} ?> name="params[share_google_plus_button]" value="on" />Google Plus</label>
							</li>
							<li <?php if($param_values['share_linkedin_button'] == 'on'){echo 'class="active"';} ?>>
								<input type="hidden" name="params[share_linkedin_button]" value="" />
								<label><input  class="socials_3 text" type="checkbox" <?php if($param_values['share_linkedin_button'] == 'on'){echo 'checked="checked"';} ?> name="params[share_linkedin_button]" value="on" />Linkedin</label>
							</li>
							<li <?php if($param_values['share_tumblr_button'] == 'on'){echo 'class="active"';} ?>>
								<input type="hidden" name="params[share_tumblr_button]" value="" />
								<label><input  class="socials_5 text" type="checkbox" <?php if($param_values['share_tumblr_button'] == 'on'){echo 'checked="checked"';} ?> name="params[share_tumblr_button]" value="on" />Tumblr</label>
							</li>
							<li <?php if($param_values['share_digg_button'] == 'on'){echo 'class="active"';} ?>>
								<input type="hidden" name="params[share_digg_button]" value="" />
								<label><input  class="socials_6 text" type="checkbox" <?php if($param_values['share_digg_button'] == 'on'){echo 'checked="checked"';} ?> name="params[share_digg_button]" value="on" />Digg</label>
							</li>
							<li <?php if($param_values['share_stumbleupon_button'] == 'on'){echo 'class="active"';} ?>>
								<input type="hidden" name="params[share_stumbleupon_button]" value="" />
								<label><input  class="socials_7 text" type="checkbox" <?php if($param_values['share_stumbleupon_button'] == 'on'){echo 'checked="checked"';} ?> name="params[share_stumbleupon_button]" value="on" />StumbleUpon</label>
							</li>
							<li <?php if($param_values['share_myspace_button'] == 'on'){echo 'class="active"';} ?>>
								<input type="hidden" name="params[share_myspace_button]" value="" />
								<label><input  class="socials_8 text" type="checkbox" <?php if($param_values['share_myspace_button'] == 'on'){echo 'checked="checked"';} ?> name="params[share_myspace_button]" value="on" />MySpace</label>
							</li>
							<!--<li>
								<input type="hidden" name="params[share_vkontakte_button]" value="off" >
								<label><input type="checkbox" <?php if($param_values['share_vkontakte_button'] == 'on'){echo 'checked="checked"';} ?> name="params[share_vkontakte_button]" value="on" >VKontakte</label>
							</li>
							<li>
								<input type="hidden" name="params[share_reddit_button]" value="off" >
								<label><input type="checkbox" <?php if($param_values['share_reddit_button'] == 'on'){echo 'checked="checked"';} ?> name="params[share_reddit_button]" value="on" >Reddit</label>
							</li>
							<li>
								<input type="hidden" name="params[share_bebo_button]" value="off" >
								<label><input type="checkbox" <?php if($param_values['share_bebo_button'] == 'on'){echo 'checked="checked"';} ?> name="params[share_bebo_button]" value="on" >Bebo</label>
							</li>
							<li>
								<input type="hidden" name="params[share_delicious_button]" value="off" >
								<label><input type="checkbox" <?php if($param_values['share_delicious_button'] == 'on'){echo 'checked="checked"';} ?> name="params[share_delicious_button]" value="on" >Delicious</label>
							</li>
							<li>
								<input type="hidden" name="params[share_odnoklassniki_button]" value="off" >
								<label><input type="checkbox" <?php if($param_values['share_odnoklassniki_button'] == 'on'){echo 'checked="checked"';} ?> name="params[share_odnoklassniki_button]" value="on" >Odnoklassniki</label>
							</li>
							<li>
								<input type="hidden" name="params[share_qzone_button]" value="off" >
								<label><input type="checkbox" <?php if($param_values['share_qzone_button'] == 'on'){echo 'checked="checked"';} ?> name="params[share_qzone_button]" value="on" >QZone</label>
							</li>
							<li>
								<input type="hidden" name="params[share_sina_weibo_button]" value="off" >
								<label><input type="checkbox" <?php if($param_values['share_sina_weibo_button'] == 'on'){echo 'checked="checked"';} ?> name="params[share_sina_weibo_button]" value="on" >Sina Weibo</label>
							</li>
							<li>
								<input type="hidden" name="params[share_renren_button]" value="off" >
								<label><input type="checkbox" <?php if($param_values['share_renren_button'] == 'on'){echo 'checked="checked"';} ?> name="params[share_renren_button]" value="on" >Renren</label>
							</li>
							<li>
								<input type="hidden" name="params[share_n4g_button]" value="off" >
								<label><input type="checkbox" <?php if($param_values['share_n4g_button'] == 'on'){echo 'checked="checked"';} ?> name="params[share_n4g_button]" value="on" >N4G</label>
							</li>-->

						</ul>
					</div>
					<div id="buttons_size_block">
						<h3>Share Buttons size</h3>
						<ul id="buttons_size_list">
							<li class="<?php if($param_values['huge_it_share_size'] == '40'){echo 'active';} ?> big"><input type="radio" value="40" name="params[huge_it_share_size]" <?php if($param_values['huge_it_share_size'] == '40'){echo 'checked="checked"';} ?>checked="checked" /></li>
							<li class="<?php if($param_values['huge_it_share_size'] == '30'){echo 'active';} ?> medium"><input type="radio" value="30" name="params[huge_it_share_size]" <?php if($param_values['huge_it_share_size'] == '30'){echo 'checked="checked"';} ?>></li>
							<li class="<?php if($param_values['huge_it_share_size'] == '20'){echo 'active';} ?> small"><input type="radio" value="20" name="params[huge_it_share_size]" <?php if($param_values['huge_it_share_size'] == '20'){echo 'checked="checked"';} ?>></li>
						</ul>
						<h4>
							<?php
								if($param_values['huge_it_share_size'] == '40'){
									echo 'Big';
								} 
								else if($param_values['huge_it_share_size'] == '30') {
									echo 'Medium';
								}
								else {
									echo 'Small';
								}
							?>
						</h4>
					</div>
					<div id="position_list_block">
						<h3>Button Position</h3>
						<ul id="position_list">
							<li class="<?php if($param_values['huge_it_share_button_position_post'] == 'left-top'){echo 'active';} ?> left-top"><input type="radio" value="left-top" id="share_title_top-left" name="params[huge_it_share_button_position_post]" <?php if($param_values['huge_it_share_button_position_post'] == 'left-top'){echo 'checked="checked"';} ?>></li>
							<li class="<?php if($param_values['huge_it_share_button_position_post'] == 'center-top'){echo 'active';} ?> center-top"><input type="radio" value="center-top" id="share_title_top-center" name="params[huge_it_share_button_position_post]" <?php if($param_values['huge_it_share_button_position_post'] == 'center-top'){echo 'checked="checked"';} ?>></li>
							<li class="<?php if($param_values['huge_it_share_button_position_post'] == 'right-top'){echo 'active';} ?> right-top"><input type="radio" value="right-top" id="share_title_top-right" name="params[huge_it_share_button_position_post]" <?php if($param_values['huge_it_share_button_position_post'] == 'right-top'){echo 'checked="checked"';} ?>></li>
							<li class="<?php if($param_values['huge_it_share_button_position_post'] == 'left-bottom'){echo 'active';} ?> left-bottom"><input type="radio" value="left-bottom" id="share_title_bottom-left" name="params[huge_it_share_button_position_post]" <?php if($param_values['huge_it_share_button_position_post'] == 'left-bottom'){echo 'checked="checked"';} ?>></li>
							<li class="<?php if($param_values['huge_it_share_button_position_post'] == 'center-bottom'){echo 'active';} ?> center-bottom"><input type="radio" value="center-bottom" id="share_title_bottom-center" name="params[huge_it_share_button_position_post]" <?php if($param_values['huge_it_share_button_position_post'] == 'center-bottom'){echo 'checked="checked"';} ?>></li>
							<li class="<?php if($param_values['huge_it_share_button_position_post'] == 'right-bottom'){echo 'active';} ?> right-bottom"><input type="radio" value="right-bottom" id="share_title_bottom-right" name="params[huge_it_share_button_position_post]" <?php if($param_values['huge_it_share_button_position_post'] == 'right-bottom'){echo 'checked="checked"';} ?>></li>
						</ul>
					</div>
					<div class="pro">
						<h3>Buttons style <span class="pro">PRO</span></h3>
						<ul id="styles_list">
							<li class="social_0 <?php if($param_values['share_button_icons_style'] == '0'){echo 'active';} ?>"><label><input type="radio" name="share_button_icons_style" <?php if($param_values['share_button_icons_style'] == '0'){echo 'checked="checked"';} ?> value="0" checked="checked" /><span></span></label></li>
							<li class="social_1 <?php if($param_values['share_button_icons_style'] == '1'){echo 'active';} ?>"><label><input type="radio" name="share_button_icons_style" <?php if($param_values['share_button_icons_style'] == '1'){echo 'checked="checked"';} ?> value="1" /></label></li>
							<li class="social_2 <?php if($param_values['share_button_icons_style'] == '2'){echo 'active';} ?>"><label><input type="radio" name="share_button_icons_style" <?php if($param_values['share_button_icons_style'] == '2'){echo 'checked="checked"';} ?> value="2" /></label></li>
							<li class="social_3 <?php if($param_values['share_button_icons_style'] == '3'){echo 'active';} ?>"><label><input type="radio" name="share_button_icons_style" <?php if($param_values['share_button_icons_style'] == '3'){echo 'checked="checked"';} ?> value="3" /></label></li>
							<li class="social_4 <?php if($param_values['share_button_icons_style'] == '4'){echo 'active';} ?>"><label><input type="radio" name="share_button_icons_style" <?php if($param_values['share_button_icons_style'] == '4'){echo 'checked="checked"';} ?> value="4" /></label></li>
							<li class="social_5 <?php if($param_values['share_button_icons_style'] == '5'){echo 'active';} ?>"><label><input type="radio" name="share_button_icons_style" <?php if($param_values['share_button_icons_style'] == '5'){echo 'checked="checked"';} ?> value="5" /></label></li>
							<li class="social_6 <?php if($param_values['share_button_icons_style'] == '6'){echo 'active';} ?>"><label><input type="radio" name="share_button_icons_style" <?php if($param_values['share_button_icons_style'] == '6'){echo 'checked="checked"';} ?> value="6" /></label></li>
							<li class="social_7 <?php if($param_values['share_button_icons_style'] == '7'){echo 'active';} ?>"><label><input type="radio" name="share_button_icons_style" <?php if($param_values['share_button_icons_style'] == '7'){echo 'checked="checked"';} ?> value="7" /></label></li>
							<li class="social_8 <?php if($param_values['share_button_icons_style'] == '8'){echo 'active';} ?>"><label><input type="radio" name="share_button_icons_style" <?php if($param_values['share_button_icons_style'] == '8'){echo 'checked="checked"';} ?> value="8" /></label></li>
							<li class="social_9 <?php if($param_values['share_button_icons_style'] == '9'){echo 'active';} ?>"><label><input type="radio" name="share_button_icons_style" <?php if($param_values['share_button_icons_style'] == '9'){echo 'checked="checked"';} ?> value="9" /></label></li>
							<li class="social_10 <?php if($param_values['share_button_icons_style'] == '10'){echo 'active';} ?>"><label><input type="radio" name="share_button_icons_style" <?php if($param_values['share_button_icons_style'] == '10'){echo 'checked="checked"';} ?> value="10" /></label></li>
						</ul>
					</div>
					<div class="other-options pro">
						<h3>Share Buttons Block <span class="pro">PRO</span></h3>
						<label><span>Block Has Background</span><input type="hidden" name="" value="" /><input  id="share_button_block_has_background" type="checkbox" name="" <?php if($param_values['share_button_block_has_background'] == 'on'){echo 'checked="checked"';} ?> value="on" /></label>
						<label><span>Block Background Color</span><input id="share_button_block_background_color" type="text" class="color" name="params[share_button_block_background_color]"  value="<?php echo $param_values['share_button_block_background_color']; ?>" /></label>
						<label><span>Block Border Size</span><input id="share_button_block_border_size" type="number" name=""  value="<?php echo $param_values['share_button_block_border_size']; ?>" /></label>
						<label><span>Block Border Color</span><input id="share_button_block_border_color" type="text" class="color" name=""  value="<?php echo $param_values['share_button_block_border_color']; ?>" /></label>
						<label><span>Block Border Radius</span><input id="share_button_block_border_radius" type="number" name=""  value="<?php echo $param_values['share_button_block_border_radius']; ?>" /></label>
						<label><span>Margin From Content</span><input id="share_button_margin_from_content" type="number" name=""  value="<?php echo $param_values['share_button_margin_from_content']; ?>" /></label>
					</div>
					<div class="other-options pro">
						<h3>Share Buttons Title <span class="pro">PRO</span></h3>
						<label><span>Title Text</span><input id="share_button_title_text" type="text" name=""  value="<?php echo $param_values['share_button_title_text']; ?>" /></label>
						<label><span>Title Position</span>
							<select id="share_button_title_position" name="">
								<option <?php if($param_values['share_button_title_position'] == 'left'){echo 'selected="selected"';} ?> value="left">Left</option>
								<option <?php if($param_values['share_button_title_position'] == 'right'){echo 'selected="selected"';} ?> value="right">Right</option>
								<option <?php if($param_values['share_button_title_position'] == 'top'){echo 'selected="selected"';} ?> value="top">Top</option>
							</select>
						</label>
						<label><span>Title Font Size</span><input id="share_button_title_font_size" type="number" name=""  value="<?php echo $param_values['share_button_title_font_size']; ?>" /></label>
						<label><span>Title Color</span><input id="share_button_title_color" type="text" class="color" name=""  value="<?php echo $param_values['share_button_title_color']; ?>" /></label>
						<label><span>Title Font Style(Family)</span>
							<select id="share_button_title_font_style_family" name="">
								<option <?php if($param_values['share_button_title_font_style_family'] == ''){echo 'selected="selected"';} ?> value="">Default</option>
								<option <?php if($param_values['share_button_title_font_style_family'] == 'Arial,Helvetica Neue,Helvetica,sans-serif'){echo 'selected="selected"';} ?> value="Arial,Helvetica Neue,Helvetica,sans-serif">Arial *</option>
								<option <?php if($param_values['share_button_title_font_style_family'] == 'Arial Black,Arial Bold,Arial,sans-serif'){echo 'selected="selected"';} ?> value="Arial Black,Arial Bold,Arial,sans-serif">Arial Black *</option>
								<option <?php if($param_values['share_button_title_font_style_family'] == 'Arial Narrow,Arial,Helvetica Neue,Helvetica,sans-serif'){echo 'selected="selected"';} ?> value="Arial Narrow,Arial,Helvetica Neue,Helvetica,sans-serif">Arial Narrow *</option>
								<option <?php if($param_values['share_button_title_font_style_family'] == 'Courier,Verdana,sans-serif'){echo 'selected="selected"';} ?> value="Courier,Verdana,sans-serif">Courier *</option>
								<option <?php if($param_values['share_button_title_font_style_family'] == 'Georgia,Times New Roman,Times,serif'){echo 'selected="selected"';} ?> value="Georgia,Times New Roman,Times,serif">Georgia *</option>
								<option <?php if($param_values['share_button_title_font_style_family'] == 'Times New Roman,Times,Georgia,serif'){echo 'selected="selected"';} ?> value="Times New Roman,Times,Georgia,serif">Times New Roman *</option>
								<option <?php if($param_values['share_button_title_font_style_family'] == 'Verdana,sans-serif'){echo 'selected="selected"';} ?> value="Verdana,sans-serif">Verdana *</option>
								<option <?php if($param_values['share_button_title_font_style_family'] == 'American Typewriter,Georgia,serif'){echo 'selected="selected"';} ?> value="American Typewriter,Georgia,serif">American Typewriter</option>
								<option <?php if($param_values['share_button_title_font_style_family'] == 'Bookman Old Style,Georgia,Times New Roman,Times,serif'){echo 'selected="selected"';} ?> value="Bookman Old Style,Georgia,Times New Roman,Times,serif">Bookman Old Style</option>
								<option <?php if($param_values['share_button_title_font_style_family'] == 'Calibri,Helvetica Neue,Helvetica,Arial,Verdana,sans-serif'){echo 'selected="selected"';} ?> value="Calibri,Helvetica Neue,Helvetica,Arial,Verdana,sans-serif">Calibri</option>
								<option <?php if($param_values['share_button_title_font_style_family'] == 'Cambria,Georgia,Times New Roman,Times,serif'){echo 'selected="selected"';} ?> value="Cambria,Georgia,Times New Roman,Times,serif">Cambria</option>
								<option <?php if($param_values['share_button_title_font_style_family'] == 'Candara,Verdana,sans-serif'){echo 'selected="selected"';} ?> value="Candara,Verdana,sans-serif">Candara</option>
								<option <?php if($param_values['share_button_title_font_style_family'] == 'Century Gothic,Apple Gothic,Verdana,sans-serif'){echo 'selected="selected"';} ?> value="Century Gothic,Apple Gothic,Verdana,sans-serif">Century Gothic</option>
								<option <?php if($param_values['share_button_title_font_style_family'] == 'Century Schoolbook,Georgia,Times New Roman,Times,serif'){echo 'selected="selected"';} ?> value="Century Schoolbook,Georgia,Times New Roman,Times,serif">Century Schoolbook</option>
								<option <?php if($param_values['share_button_title_font_style_family'] == 'Consolas,Andale Mono,Monaco,Courier,Courier New,Verdana,sans-serif'){echo 'selected="selected"';} ?> value="Consolas,Andale Mono,Monaco,Courier,Courier New,Verdana,sans-serif">Consolas</option>
								<option <?php if($param_values['share_button_title_font_style_family'] == 'Constantia,Georgia,Times New Roman,Times,serif'){echo 'selected="selected"';} ?> value="Constantia,Georgia,Times New Roman,Times,serif">Constantia</option>
								<option <?php if($param_values['share_button_title_font_style_family'] == 'Corbel,Lucida Grande,Lucida Sans Unicode,Arial,sans-serif'){echo 'selected="selected"';} ?> value="Corbel,Lucida Grande,Lucida Sans Unicode,Arial,sans-serif">Corbel</option>
								<option <?php if($param_values['share_button_title_font_style_family'] == 'Tahoma,Geneva,Verdana,sans-serif'){echo 'selected="selected"';} ?> value="Tahoma,Geneva,Verdana,sans-serif">Tahoma</option>
								<option <?php if($param_values['share_button_title_font_style_family'] == 'Rockwell, Arial Black, Arial Bold, Arial, sans-serif'){echo 'selected="selected"';} ?> value="Rockwell, Arial Black, Arial Bold, Arial, sans-serif">Rockwell</option>
						</select>
						</label>
					</div>
					<div class="other-options pro">
						<h3>Buttons Custom Styles <span class="pro">PRO</span></h3>
						<label><span>Margin Between Buttons</span><input id="share_button_margin_between_buttons" type="number" name="" value="<?php echo $param_values['share_button_margin_between_buttons']; ?>" /></label>
						<label><span>Buttons Has Background</span><input type="hidden" name="" value="" /><input  id="share_button_buttons_has_background" type="checkbox" name="params[share_button_buttons_has_background]" <?php if($param_values['share_button_buttons_has_background'] == 'on'){echo 'checked="checked"';} ?> value="on" /></label>
						<label><span>Buttons Background Padding</span><input id="share_button_buttons_background_padding"   type="number" name=""  value="<?php echo $param_values['share_button_buttons_background_padding']; ?>" /></label>
						<label><span>Buttons Background Color</span><input id="share_button_buttons_background_color" type="text" class="color" name=""  value="<?php echo $param_values['share_button_buttons_background_color']; ?>" /></label>
						<label><span>Buttons Border Size</span><input id="share_button_buttons_border_size" type="number" name=""  value="<?php echo $param_values['share_button_buttons_border_size']; ?>" /></label>
						<label><span>Buttons Border Style</span>
							<select id="share_button_buttons_border_style" name="share_button_buttons_border_style">
								<option <?php if($param_values['share_button_buttons_border_style'] == 'solid'){echo 'selected="selected"';} ?> value="solid">Standard</option>
								<option <?php if($param_values['share_button_buttons_border_style'] == 'dotted'){echo 'selected="selected"';} ?> value="dotted">Dotted</option>
								<option <?php if($param_values['share_button_buttons_border_style'] == 'double'){echo 'selected="selected"';} ?> value="double">Double</option>
								<option <?php if($param_values['share_button_buttons_border_style'] == 'ridge'){echo 'selected="selected"';} ?> value="ridge">Ridge</option>
							</select>
						</label>
						<label><span>Buttons Border Color</span><input id="share_button_buttons_border_color" type="text"  class="color" name=""  value="<?php echo $param_values['share_button_buttons_border_color']; ?>" /></label>
						<label><span>Buttons Border Radius</span><input id="share_button_buttons_border_radius" type="number"  name=""  value="<?php echo $param_values['share_button_buttons_border_radius']; ?>" /></label>
					</div>
				</div>
				
				
				<!--LIVE PREVIEW-->
				<div id="hugeit-share-buttons-preview-container">
					<div id="hugeit-share-buttons-preview-block">
						<section>
						<style>
							<?php 
								$size=$param_values['huge_it_share_size'];
								$style=$param_values['share_button_icons_style'];		

								$position=split('-',$param_values['huge_it_share_button_position_post']);
							?>
							.huge-it-share-buttons {
								border:<?php echo $param_values['share_button_block_border_size']; ?>px solid #<?php echo $param_values['share_button_block_border_color']; ?>;
								border-radius:<?php echo $param_values['share_button_block_border_radius']; ?>px;
								background:#<?php echo $param_values['share_button_block_background_color']; ?>;
								
								<?php if($position[0]=="left"){?> text-align:left; <?php }?>
								<?php if($position[0]=="right"){?> text-align:right; <?php }?>
								<?php if($position[0]=="center"){?> text-align:center; <?php }?>
							}
							
							#huge-it-share-buttons-top {margin-bottom:<?php echo $param_values['share_button_margin_from_content']; ?>px;}
							#huge-it-share-buttons-bottom {margin-top:<?php echo $param_values['share_button_margin_from_content']; ?>px;}
							
							#poststuff .huge-it-share-buttons h3 {
								font-size:<?php echo $param_values['share_button_title_font_size'];?>px ;
								font-family:<?php echo $param_values['share_button_title_font_style_family']; ?>;
								color:#<?php echo $param_values['share_button_title_color'];?>;
								
								<?php
									if($param_values['share_button_title_position'] == 'left'){ echo 'float:left;';} 
									else if($param_values['share_button_title_position'] == 'right'){ echo 'float:right;';}
									else {echo 'display:block;';}
								?>
								line-height:<?php echo $param_values['share_button_title_font_size'];?>px ;
								
									
								<?php if($position[0]=="left"){?> text-align:left; <?php }?>
								<?php if($position[0]=="right"){?> text-align:right; <?php }?>
								<?php if($position[0]=="center"){?> text-align:center; <?php }?>
							}
							
							
							.huge-it-share-buttons ul {	
								<?php if($position[0]=="left"){?> float:left; <?php }?>
								<?php if($position[0]=="right"){?> float:right; <?php }?>
								<?php if($position[0]=="center"){?> margin:0px auto !important;text-align:center; <?php }?>
							}
							
							.huge-it-share-buttons  ul li {
								margin-left:<?php echo $param_values['share_button_margin_between_buttons']; ?>px;
								margin-right:<?php echo $param_values['share_button_margin_between_buttons']; ?>px;
								padding:<?php echo $param_values['share_button_buttons_background_padding']; ?>px;
								border:<?php echo $param_values['share_button_buttons_border_size']; ?>px <?php echo $param_values['share_button_buttons_border_style']; ?> #<?php echo $param_values['share_button_buttons_border_color']; ?>;
								border-radius:<?php echo $param_values['share_button_buttons_border_radius']; ?>px;
								background-color:#<?php echo $param_values['share_button_buttons_background_color']; ?>;
							}
							
							.huge-it-share-buttons  ul li a {
								background-image:url(<?php echo $path_site;?>/buttons.<?php echo $size;?>.png);
								width:<?php echo $size;?>px;
								height:<?php echo $size;?>px;
							}
						</style>
						<div id="huge-it-share-buttons-top" class="huge-it-share-buttons <?php if($position[1]=="top"){echo 'active';}?> <?php if($param_values['share_button_block_has_background'] != 'on'){echo 'nobackground'; } ?>">
							<h3><?php echo $param_values['share_button_title_text']; ?></h3>
							<ul class="huge-it-share-buttons-list">							
								<?php foreach($social_buttons as $socials){?> 	
									<li class="<?php if($socials!='on'){echo 'none';} ?> <?php if($param_values['share_button_buttons_has_background'] != 'on'){echo 'nobackground'; } ?>" ><a href="#"  style="background-position: -<?php echo $size*$i; ?>px -<?php echo $size*$style;?>px "></a></li>
								<?php  $i++; } ?>
							</ul>
						
							<div class="clear"></div>
						</div>
						<h1>This is demo content</h1>
						<span class="date">25 March 2015</span>
						<div class="clear">
							<img src="<?php echo $path_site;?>/matt.jpg" class="blog-image" alt="Matt Mullenweg" />
							<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
						</div>
						<div id="huge-it-share-buttons-bottom" class="huge-it-share-buttons <?php if($position[1]=="bottom"){echo 'active';}?> <?php if($param_values['share_button_block_has_background'] != 'on'){echo 'nobackground'; } ?>">
							<h3><?php echo $param_values['share_button_title_text']; ?></h3>
							<ul class="huge-it-share-buttons-list">
								<?php foreach($social_buttons as $socials){?>
									<li class="<?php if($socials!='on'){echo 'none';} ?> <?php if($param_values['share_button_buttons_has_background'] != 'on'){echo 'nobackground'; } ?>" ><a href="#" style="background-position: -<?php echo $size*$i; ?>px -<?php echo $size*$style;?>px "></a></li>
								<?php $i++; } ?>
							</ul>
							<div class="clear"></div>
						</div>					
					</section>
					</div>
				</div>
			</div>
			<!-- SIDEBAR -->
			<div id="postbox-container-1" class="postbox-container">
				<div id="hugeit_share-buttons-unique-options" class="postbox">
					<h3 class="hndle"><span>Save Options</span></h3>
					<div id="major-publishing-actions">
						<div id="publishing-action">
							<a onclick="document.getElementById('adminForm').submit()" class="save-gallery-options button-primary">Save</a>
						</div>
						<div class="clear"></div>
					</div>
				</div>
				<div id="hugeit_share-buttons-shortcode-box" class="postbox shortcode ms-toggle">
					<h3 class="hndle"><span>Usage</span></h3>
					<div class="inside">
						<ul>
							<li rel="tab-1" class="selected">
								<h4>Shortcode</h4>
								<p>Copy &amp; paste the shortcode directly into any WordPress post or page.</p>
								<textarea class="full" readonly="readonly">[huge_it_share]</textarea>
							</li>
							<li rel="tab-2">
								<h4>Template Include</h4>
								<p>Copy &amp; paste this code into a template file to include the slideshow within your theme.</p>
								<textarea class="full" readonly="readonly">&lt;?php echo do_shortcode("[huge_it_share]"); ?&gt;</textarea>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<!-- END SIDEBAR -->
	</div>
	<input type="hidden" name="task" value="" />
</form>
</div>
<?php
}