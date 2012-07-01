<?php if (isset($_POST['Submit'])) {

	// Required for all WordPress database manipulations
	global $wpdb;
 
	// Grabbing DB prefix and settings table names to variable
	$testimonials = $wpdb->prefix . "iq_testimonials";
	$iq_testimonials_settings = $wpdb->prefix . "iq_testimonials_settings";

/********************************
 * Testimonial Settings
 ********************************/	
	// Get values from post!
	$testimonial_options = array();
	$testimonial_options['admin_email'] = $_POST['admin_email'];
	$testimonial_options['date'] = $_POST['date'];
	$testimonial_options['max_widget_testimonials'] = $_POST['max_widget_testimonials'];
	$testimonial_options['max_page_testimonials'] = $_POST['max_page_testimonials'];
	$testimonial_options['max_image_width'] = $_POST['max_image_width'];
	$testimonial_options['max_image_height'] = $_POST['max_image_height'];
	$testimonial_options['randomize'] = $_POST['randomize'];
	$testimonial_options['form_name'] = $_POST['form_name'];
	$testimonial_options['form_email'] = $_POST['form_email'];
	$testimonial_options['form_location'] = $_POST['form_location'];
	$testimonial_options['form_website'] = $_POST['form_website'];
	$testimonial_options['name_field'] = $_POST['name_field'];
	$testimonial_options['email_field'] = $_POST['email_field'];
	$testimonial_options['location_field'] = $_POST['location_field'];
	$testimonial_options['website_field'] = $_POST['website_field'];
	$testimonial_options['image_field'] = $_POST['image_field'];
	$testimonial_options['dynamically_rotate'] = $_POST['dynamically_rotate'];
	$testimonial_options['rotation_speed'] = $_POST['rotation_speed'];
	$testimonial_options['fade_speed'] = $_POST['fade_speed'];

/********************************
 * General Update
 ********************************/	
	$sql1 = ("UPDATE $iq_testimonials_settings SET value='".$testimonial_options['admin_email']."' WHERE name='admin_email'");
	$sql2 = ("UPDATE $iq_testimonials_settings SET value='".$testimonial_options['date']."' WHERE name='date'");
	$sql3 = ("UPDATE $iq_testimonials_settings SET value='".$testimonial_options['max_page_testimonials']."' WHERE name='max_page_testimonials'");
	$sql4 = ("UPDATE $iq_testimonials_settings SET value='".$testimonial_options['max_widget_testimonials']."' WHERE name='max_widget_testimonials'");
	$sql5 = ("UPDATE $iq_testimonials_settings SET value='".$testimonial_options['max_image_width']."' WHERE name='max_image_width'");
	$sql6 = ("UPDATE $iq_testimonials_settings SET value='".$testimonial_options['max_image_height']."' WHERE name='max_image_height'");
	$sql7 = ("UPDATE $iq_testimonials_settings SET value='".$testimonial_options['randomize']."' WHERE name='randomize'");
	$sql8 = ("UPDATE $iq_testimonials_settings SET value='".$testimonial_options['form_name']."' WHERE name='form_name'");
	$sql9 = ("UPDATE $iq_testimonials_settings SET value='".$testimonial_options['form_email']."' WHERE name='form_email'");
	$sql10 = ("UPDATE $iq_testimonials_settings SET value='".$testimonial_options['form_location']."' WHERE name='form_location'");
	$sql11 = ("UPDATE $iq_testimonials_settings SET value='".$testimonial_options['form_website']."' WHERE name='form_website'");
	$sql12 = ("UPDATE $iq_testimonials_settings SET value='".$testimonial_options['name_field']."' WHERE name='name_field'");
	$sql13 = ("UPDATE $iq_testimonials_settings SET value='".$testimonial_options['email_field']."' WHERE name='email_field'");
	$sql14 = ("UPDATE $iq_testimonials_settings SET value='".$testimonial_options['location_field']."' WHERE name='location_field'");
	$sql15 = ("UPDATE $iq_testimonials_settings SET value='".$testimonial_options['website_field']."' WHERE name='website_field'");
	$sql16 = ("UPDATE $iq_testimonials_settings SET value='".$testimonial_options['image_field']."' WHERE name='image_field'");
	$sql17 = ("UPDATE $iq_testimonials_settings SET value='".$testimonial_options['dynamically_rotate']."' WHERE name='dynamically_rotate'");
	$sql18 = ("UPDATE $iq_testimonials_settings SET value='".$testimonial_options['rotation_speed']."' WHERE name='rotation_speed'");
	$sql19 = ("UPDATE $iq_testimonials_settings SET value='".$testimonial_options['fade_speed']."' WHERE name='fade_speed'");

	
	// Requiring WP upgrade and running SQL query
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql1);
	dbDelta($sql2);
	dbDelta($sql3);
	dbDelta($sql4);
	dbDelta($sql5);
	dbDelta($sql6);
	dbDelta($sql7);
	dbDelta($sql8);
	dbDelta($sql9);
	dbDelta($sql10);
	dbDelta($sql11);
	dbDelta($sql12);
	dbDelta($sql13);
	dbDelta($sql14);
	dbDelta($sql15);
	dbDelta($sql16);
	dbDelta($sql17);
	dbDelta($sql18);
	dbDelta($sql19);

?>

<div class="iq-testimonial-updated fade" id="message" style="background-color: rgb(255, 251, 204);"><p><?php echo __('Settings saved!', 'iq-testimonials' );  ?></p></div>

<?php } ?>

<?php if (isset($_POST['Reset'])) {

	// Required for all WordPress database manipulations
	global $wpdb;
	
	// Grabbing DB prefix and settings table names to variable
	$iq_testimonials_settings = $wpdb->prefix . "iq_testimonials_settings";
	
/********************************
 * Defining Default Testimonial Settings
 ********************************/
	$testimonial_options = array();
	$testimonial_options['admin_email'] = get_option('admin_email');
	$testimonial_options['date'] = 1;
	$testimonial_options['max_widget_testimonials'] = '1';
	$testimonial_options['max_page_testimonials'] = '15';
	$testimonial_options['max_image_width'] = '125';
	$testimonial_options['max_image_height'] = '125';
	$testimonial_options['randomize'] = 'true';
	$testimonial_options['form_name'] = 'true';
	$testimonial_options['form_email'] = 'true';
	$testimonial_options['form_location'] = '';
	$testimonial_options['form_website'] = '';
	$testimonial_options['name_field'] = '';
	$testimonial_options['email_field'] = '';
	$testimonial_options['location_field'] = '';
	$testimonial_options['website_field'] = '';
	$testimonial_options['dynamically_rotate'] = 'true';
	$testimonial_options['rotation_speed'] = '12000';
	$testimonial_options['fade_speed'] = '1000';
	
/********************************
 * Updating To Default Above
 ********************************/

	$sql1 = ("UPDATE $iq_testimonials_settings SET value='".$testimonial_options['admin_email']."' WHERE name='admin_email'");
	$sql2 = ("UPDATE $iq_testimonials_settings SET value='".$testimonial_options['date']."' WHERE name='date'");
	$sql3 = ("UPDATE $iq_testimonials_settings SET value='".$testimonial_options['max_widget_testimonials']."' WHERE name='max_widget_testimonials'");
	$sql4 = ("UPDATE $iq_testimonials_settings SET value='".$testimonial_options['max_page_testimonials']."' WHERE name='max_page_testimonials'");
	$sql5 = ("UPDATE $iq_testimonials_settings SET value='".$testimonial_options['max_image_width']."' WHERE name='max_image_width'");
	$sql6 = ("UPDATE $iq_testimonials_settings SET value='".$testimonial_options['max_image_height']."' WHERE name='max_image_height'");
	$sql7 = ("UPDATE $iq_testimonials_settings SET value='".$testimonial_options['randomize']."' WHERE name='randomize'");
	$sql8 = ("UPDATE $iq_testimonials_settings SET value='".$testimonial_options['form_name']."' WHERE name='form_name'");
	$sql9 = ("UPDATE $iq_testimonials_settings SET value='".$testimonial_options['form_email']."' WHERE name='form_email'");
	$sql10 = ("UPDATE $iq_testimonials_settings SET value='".$testimonial_options['form_location']."' WHERE name='form_location'");
	$sql11 = ("UPDATE $iq_testimonials_settings SET value='".$testimonial_options['form_website']."' WHERE name='form_website'");
	$sql12 = ("UPDATE $iq_testimonials_settings SET value='".$testimonial_options['name_field']."' WHERE name='name_field'");
	$sql13 = ("UPDATE $iq_testimonials_settings SET value='".$testimonial_options['email_field']."' WHERE name='email_field'");
	$sql14 = ("UPDATE $iq_testimonials_settings SET value='".$testimonial_options['location_field']."' WHERE name='location_field'");
	$sql15 = ("UPDATE $iq_testimonials_settings SET value='".$testimonial_options['website_field']."' WHERE name='website_field'");
	$sql16 = ("UPDATE $iq_testimonials_settings SET value='".$testimonial_options['website_field']."' WHERE name='image_field'");
	$sql17 = ("UPDATE $iq_testimonials_settings SET value='".$testimonial_options['dynamically_rotate']."' WHERE name='dynamically_rotate'");
	$sql18 = ("UPDATE $iq_testimonials_settings SET value='".$testimonial_options['rotation_speed']."' WHERE name='rotation_speed'");
	$sql19 = ("UPDATE $iq_testimonials_settings SET value='".$testimonial_options['fade_speed']."' WHERE name='fade_speed'");
	
	// Requiring WP upgrade and running SQL query
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql1);
	dbDelta($sql2);
	dbDelta($sql3);
	dbDelta($sql4);
	dbDelta($sql5);
	dbDelta($sql6);
	dbDelta($sql7);
	dbDelta($sql8);
	dbDelta($sql9);
	dbDelta($sql10);
	dbDelta($sql11);
	dbDelta($sql12);
	dbDelta($sql13);
	dbDelta($sql14);
	dbDelta($sql15);
	dbDelta($sql16);
	dbDelta($sql17);
	dbDelta($sql18);
	dbDelta($sql18);

?>

<div class="iq-testimonial-updated fade" id="message" style="background-color: rgb(255, 251, 204);"><p><?php echo __('Settings Reset!', 'iq-testimonials' ); ?></p></div>

<?php } ?>

<?php if (isset($_POST['Delete'])) {

	// Required for all WordPress database manipulations
	global $wpdb;
	
	// Grabbing DB prefix and settings table names to variable
	$testimonials = $wpdb->prefix . "iq_testimonials";
	$iq_testimonials_settings = $wpdb->prefix . "iq_testimonials_settings";
	
	// Deleting The Databases
	mysql_query("DROP table $testimonials");
	mysql_query("DROP table $iq_testimonials_settings");
	
?>

<div class="iq-testimonial-updated fade" id="message" style="background-color: rgb(255, 251, 204);"><p><?php echo __('Database Tables Deleted!', 'iq-testimonials' ); ?></p></div>

<?php } ?>

<?php

/********************************
 * Global Settings
 ********************************/
	// Required for all WordPress database manipulations
	global $wpdb;
 
	// Grabbing DB prefix and settings table names to variable
	$testimonials = $wpdb->prefix . "iq_testimonials";
	$iq_testimonials_settings = $wpdb->prefix . "iq_testimonials_settings";

/********************************
 * Testimonial Settings
 ********************************/

	// Are we going to display the testimonials on a certain page?
	$admin_email = $wpdb->get_row("SELECT value FROM $iq_testimonials_settings WHERE name='admin_email'", ARRAY_A);		
	$admin_email = $admin_email['value'];
	
	// Date
	$date = $wpdb->get_row("SELECT value FROM $iq_testimonials_settings WHERE name='date'", ARRAY_A);		
	$date = $date['value'];

	// Getting number of testimonials to display on the widget
	$max_widget_testimonials = $wpdb->get_row("SELECT value FROM $iq_testimonials_settings WHERE name='max_widget_testimonials'", ARRAY_A);		
	$max_widget_testimonials = $max_widget_testimonials['value'];
	
	// Getting max number of testimonials to display on testimonials page
	$max_page_testimonials = $wpdb->get_row("SELECT value FROM $iq_testimonials_settings WHERE name='max_page_testimonials'", ARRAY_A);		
	$max_page_testimonials = $max_page_testimonials['value'];
	
	// Getting max image width
	$max_image_width = $wpdb->get_row("SELECT value FROM $iq_testimonials_settings WHERE name='max_image_width'", ARRAY_A);		
	$max_image_width = $max_image_width['value'];
	
	// Getting max image height
	$max_image_height = $wpdb->get_row("SELECT value FROM $iq_testimonials_settings WHERE name='max_image_height'", ARRAY_A);		
	$max_image_height = $max_image_height['value'];
	
	// Getting randomize
	$randomize_testimonials = $wpdb->get_row("SELECT value FROM $iq_testimonials_settings WHERE name='randomize'", ARRAY_A);		
	$randomize_testimonials = $randomize_testimonials['value'];
	
		if ($randomize_testimonials == 'true') {
		$randomize_checked_state = 'CHECKED';
	}

	$form_name = $wpdb->get_row("SELECT value FROM $iq_testimonials_settings WHERE name='form_name'", ARRAY_A);		
	$form_name = $form_name['value'];
	
		if ($form_name == 'true') {
		$form_name_checked_state = 'CHECKED';
	}

	$form_email = $wpdb->get_row("SELECT value FROM $iq_testimonials_settings WHERE name='form_email'", ARRAY_A);		
	$form_email = $form_email['value'];
	
		if ($form_email == 'true') {
		$form_email_checked_state = 'CHECKED';
	}

	$form_location = $wpdb->get_row("SELECT value FROM $iq_testimonials_settings WHERE name='form_location'", ARRAY_A);		
	$form_location = $form_location['value'];
	
		if ($form_location == 'true') {
		$form_location_checked_state = 'CHECKED';
	}

	$form_website = $wpdb->get_row("SELECT value FROM $iq_testimonials_settings WHERE name='form_website'", ARRAY_A);		
	$form_website = $form_website['value'];
	
		if ($form_website == 'true') {
		$form_website_checked_state = 'CHECKED';
	}
	
	$name_field = $wpdb->get_row("SELECT value FROM $iq_testimonials_settings WHERE name='name_field'", ARRAY_A);		
	$name_field = $name_field['value'];
	
		if ($name_field == 'true') {
		$name_field_checked_state = 'CHECKED';
	}

	$email_field = $wpdb->get_row("SELECT value FROM $iq_testimonials_settings WHERE name='email_field'", ARRAY_A);		
	$email_field = $email_field['value'];
	
		if ($email_field == 'true') {
		$email_field_checked_state = 'CHECKED';
	}

	$location_field = $wpdb->get_row("SELECT value FROM $iq_testimonials_settings WHERE name='location_field'", ARRAY_A);		
	$location_field = $location_field['value'];
	
		if ($location_field == 'true') {
		$location_field_checked_state = 'CHECKED';
	}

	$website_field = $wpdb->get_row("SELECT value FROM $iq_testimonials_settings WHERE name='website_field'", ARRAY_A);		
	$website_field = $website_field['value'];
	
		if ($website_field == 'true') {
		$website_field_checked_state = 'CHECKED';
	}

	$image_field = $wpdb->get_row("SELECT value FROM $iq_testimonials_settings WHERE name='image_field'", ARRAY_A);		
	$image_field = $image_field['value'];
	
		if ($image_field == 'true') {
		$image_field_checked_state = 'CHECKED';
	}
	
	$dynamically_rotate = $wpdb->get_row("SELECT value FROM $iq_testimonials_settings WHERE name='dynamically_rotate'", ARRAY_A);		
	$dynamically_rotate = $dynamically_rotate['value'];
	
		if ($dynamically_rotate == 'true') {
		$dynamically_rotate_checked_state = 'CHECKED';
	}
	
	$rotation_speed = $wpdb->get_row("SELECT value FROM $iq_testimonials_settings WHERE name='rotation_speed'", ARRAY_A);		
	$rotation_speed = $rotation_speed['value'];
	
	$fade_speed = $wpdb->get_row("SELECT value FROM $iq_testimonials_settings WHERE name='fade_speed'", ARRAY_A);		
	$fade_speed = $fade_speed['value'];
	
?>

<div class="wrap">

<div id="icon-options-general" class="icon32"><br /></div>
<h2>IQ Testimonials Settings</h2>
<div class="settings-section-box">
<h4>Widget Settings</h4>
<form method="post" action="" id="settingsform">
<table class="form-table">
	<tr valign="top">
		<th scope="row"><label for="max_widget_testimonials"><span title="The maximum number of testimonials that should be displayed on the widget.">Max Number Of Testimonials Displayed</span></label></th>
		<td><input name="max_widget_testimonials" type="text" id="max_widget_testimonials" value='<?php echo $max_widget_testimonials; ?>' size="2" /></td>
	</tr>
	<tr valign="top">
		<th scope="row"><label for="form_website"><span title="Fades and cycles through the testimonials. Featured testimonials will show up first. Enabling this will override the max number of testimonials displayed.">Dynamically Rotate Testimonials</span></label></th>
		<td><input name="dynamically_rotate" type="checkbox" id="dynamically_rotate" value="true" <?php echo $dynamically_rotate_checked_state; ?> /></td>
	</tr>
	<tr valign="top">
		<th scope="row"><label for="rotation_speed"><span title="How fast do you want the testimonials to cycle in milliseconds">Rotation Speed</span></label></th>
		<td><input name="rotation_speed" type="text" id="rotation_speed" value='<?php echo $rotation_speed; ?>' size="2" /></td>
	</tr>
	<tr valign="top">
		<th scope="row"><label for="fade_speed"><span title="How long do you want the fade effect to take in milliseconds">Fade Speed</span></label></th>
		<td><input name="fade_speed" type="text" id="fade_speed" value='<?php echo $fade_speed; ?>' size="2" /></td>
	</tr>
</table>
</div>
<div class="settings-section-box">
<h4>Form Settings</h4>
<table class="form-table">
	<tr valign="top">
		<th scope="row"><label for="form_website"><span title="Require entrants name.">Require Name</span></label></th>
		<td><input name="form_name" type="checkbox" id="form_name" value="true" <?php echo $form_name_checked_state; ?> /></td>
	</tr>
	<tr valign="top">
		<th scope="row"><label for="form_email"><span title="Require entrants email.">Require EMail</span></label></th>
		<td><input name="form_email" type="checkbox" id="form_email" value="true" <?php echo $form_email_checked_state; ?> /></td>
	</tr>
	<tr valign="top">
		<th scope="row"><label for="form_location"><span title="Require entrants location.">Require Location</span></label></th>
		<td><input name="form_location" type="checkbox" id="form_location" value="true" <?php echo $form_location_checked_state; ?> /></td>
	</tr>
	<tr valign="top">
		<th scope="row"><label for="form_website"><span title="Require entrants website.">Require Website</span></label></th>
		<td><input name="form_website" type="checkbox" id="form_website" value="true" <?php echo $form_website_checked_state; ?> /></td>
	</tr>
	<tr valign="top">
		<th scope="row"><label for="name_field"><span title="Hide name field.">Hide Name Field</span></label></th>
		<td><input name="name_field" type="checkbox" id="name_field" value="true" <?php echo $name_field_checked_state; ?> /></td>
	</tr>
	<tr valign="top">
		<th scope="row"><label for="email_field"><span title="Hide email field.">Hide EMail Field</span></label></th>
		<td><input name="email_field" type="checkbox" id="email_field" value="true" <?php echo $email_field_checked_state; ?> /></td>
	</tr>
	<tr valign="top">
		<th scope="row"><label for="location_field"><span title="Hide location field.">Hide Location Field</span></label></th>
		<td><input name="location_field" type="checkbox" id="location_field" value="true" <?php echo $location_field_checked_state; ?> /></td>
	</tr>
	<tr valign="top">
		<th scope="row"><label for="website_field"><span title="Hide website field.">Hide Website Field</span></label></th>
		<td><input name="website_field" type="checkbox" id="website_field" value="true" <?php echo $website_field_checked_state; ?> /></td>
	</tr>
	<tr valign="top">
		<th scope="row"><label for="image_field"><span title="Hide image field.">Hide Image Field</span></label></th>
		<td><input name="image_field" type="checkbox" id="image_field" value="true" <?php echo $image_field_checked_state; ?> /></td>
	</tr>
</table>
</div>
<div class="settings-section-box">
<h4>Global Settings</h4>
<table class="form-table">
	<tr valign="top">
		<th scope="row"><label for="max_image_width"><span title="The maximum image width.">Max Image Width</span></label></th>
		<td><input name="max_image_width" type="text" id="max_image_width" value='<?php echo $max_image_width; ?>' size="2" /></td>
	</tr>
	<tr valign="top">
		<th scope="row"><label for="max_image_height"><span title="The maximum image height.">Max Image Height</span></label></th>
		<td><input name="max_image_height" type="text" id="max_image_height" value='<?php echo $max_image_height; ?>' size="2" /></td>
	</tr>
	<tr valign="top">
		<th scope="row"><label for="randomize"><span title="Randomize the testimonial order making sure to put featured testimonials at the top.">Randomize Testimonials</span></label></th>
		<td><input name="randomize" type="checkbox" id="randomize" value="true" <?php echo $randomize_checked_state; ?> /></td>
	</tr>
</table>
</div>
<div class="settings-section-box">
<h4>Page Settings</h4>
<table class="form-table">
	<tr valign="top">
		<th scope="row"><label for="max_page_testimonials"><span title="The maximum number of testimonials that should be displayed on the testimonials page.">Max Number Of Testimonials Displayed</span></label></th>
		<td><input name="max_page_testimonials" type="text" id="max_page_testimonials" value='<?php echo $max_page_testimonials; ?>' size="2" /></td>
	</tr>
</table>
</div>
<div class="settings-section-notification">
<h4>Notification Settings</h4>
<table class="form-table">
	<tr valign="top">
		<th scope="row"><label for="admin_email"><span title="The email you want to be contacted at when someone submits a testimonial using the public form.">Admin Email</span></label></th>
		<td><input name="admin_email" type="text" id="admin_email"  value='<?php echo $admin_email; ?>' class="regular-text" />
	</tr>
</table>
</div>

  <p class="submit">
    <input type="hidden" value="save" name="save" />
    <input type="submit" name="Submit" class="button-primary" value="Save Changes" /> | 
	<input type="submit" name="Reset" class="button-secondary" value="Reset Settings" onclick="if ( confirm('You are about to reset all settings. \n \'Cancel\' to stop, \'OK\' to reset.') ) { return true;}return false;" /> |
	<input type="submit" name="Delete" class="button-secondary" value="Uninstall Plugin" onclick="if ( confirm('You are about to UNINSTALL this plugin! This cannot be undone! \n \'Cancel\' to stop, \'OK\' to uninstall.') ) { return true;}return false;" />
  </p>
</form>

</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo get_option('siteurl') . '/wp-content/plugins/iq-testimonials/js/jquery.qtip.js'; ?>" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() 
{
   $('#settingsform span[title]').qtip({
      content: {
         text: false
      },
      style: 'light'
   });
   // $('#content a[href]').qtip();
});
</script>