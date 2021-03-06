<?php
/*------------------------------------------------------------------------------
Settings Page for a custom field.  This requires that the custom field type 
implements the get_settings_page() function.
------------------------------------------------------------------------------*/
if ( ! defined('CCTM_PATH')) exit('No direct script access allowed');
if (!current_user_can('administrator')) exit('Admins only.');

$data 				= array();
$data['page_title']	= sprintf( __('Settings for Custom Field %s', CCTM_TXTDOMAIN), '');
$data['menu'] 		= sprintf('<a href="'.get_admin_url(false,'admin.php').'?page=cctm_settings&a=settings" class="button">%s</a>', __('Back', CCTM_TXTDOMAIN) );
$data['msg']		= self::get_flash();

CCTM::include_form_element_class($field_type);

if (!empty(CCTM::$errors)) {
	$data['content'] = CCTM::format_errors();
}
else {

	$field_type_name = CCTM::classname_prefix.$field_type;
	$FieldObj = new $field_type_name();
	$data['page_title']	= sprintf( __('Settings for Custom Field %s', CCTM_TXTDOMAIN), '<em>'.$FieldObj->get_name().'</em>' );
	// It's all up to the field to implement this sensibly.
	$data['content'] = $FieldObj->get_settings_page(); 
}
print CCTM::load_view('templates/default.php', $data);

/*EOF*/