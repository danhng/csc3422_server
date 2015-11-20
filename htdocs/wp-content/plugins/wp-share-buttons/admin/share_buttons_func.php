<?php
function showStyles()
{
    global $wpdb;
    $query = "SELECT *  from " . $wpdb->prefix . "huge_it_share_params ";
    $rows = $wpdb->get_results($query);
    $param_values = array();
    foreach ($rows as $row) {
        $key = $row->name;
        $value = $row->value;
        $param_values[$key] = $value;
    }
	$btnquery = "SELECT *  from " . $wpdb->prefix . "huge_it_share_params  where social='social' ";
    $btnrows = $wpdb->get_results($btnquery);
    $social_buttons = array();
    foreach ($btnrows as $btnrow) {
        $key = $btnrow->name;
        $value = $btnrow->value;
        $social_buttons[$key] = $value;
    }
    html_showStyles($social_buttons, $param_values);
}
function save_styles_options()
{
    global $wpdb;
    if (isset($_POST['params'])) {
      $params = $_POST['params'];
      foreach ($params as $key => $value) {
          $wpdb->update($wpdb->prefix . 'huge_it_share_params',
              array('value' => $value),
              array('name' => $key),
              array('%s')
          );
      }
      ?>
      <div class="updated"><p><strong><?php _e('Item Saved'); ?></strong></p></div>
      <?php
    }
}
?>