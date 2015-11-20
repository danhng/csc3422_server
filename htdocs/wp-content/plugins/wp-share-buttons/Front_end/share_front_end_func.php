<?php
function showPublishedshare_buttons_1($id)
{
	$haveshortcode = $id;
	global $wpdb;
	$query="SELECT * FROM ".$wpdb->prefix."huge_it_share_params";
    $rowspar = $wpdb->get_results($query);
    $param_values = array();
    foreach ($rowspar as $rowpar) {
        $key = $rowpar->name;
        $value = $rowpar->value;
        $param_values[$key] = $value;
    }
	$id = get_the_ID();
	$query=$wpdb->prepare("SELECT * FROM ".$wpdb->prefix."huge_it_share_params_posts where share_post_id = %s ", $id);
	$rowsposts = $wpdb->get_results($query);
	
	
	$btnquery = "SELECT *  from " . $wpdb->prefix . "huge_it_share_params  where social='social' ";
    $btnrows = $wpdb->get_results($btnquery);
	$social_buttons = array();
    foreach ($btnrows as $btnrow) {
        $key = $btnrow->name;
        $value = $btnrow->value;
        $social_buttons[$key] = $value;
    }
	$shareifquery = "SELECT * from " . $wpdb->prefix . "huge_it_share_params  where social='social' ";
	$shareifrows = $wpdb->get_results($shareifquery);
	return front_end_share_buttons($social_buttons, $param_values, $rowsposts, $shareifrows, $haveshortcode);
}
?>