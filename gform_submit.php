<?php

add_action('wp_ajax_create_gf_entry', 'create_gf_entry');
add_action('wp_ajax_nopriv_create_gf_entry', 'create_gf_entry');

// Manually create entries and send notifications with Gravity Forms

function create_gf_entry(){

	$form_id = $_POST['form_id'];
	$submission = $_POST['submitted'];


	$entry = array(
		"form_id" => $form_id
	);
	$counter = 1;
	foreach($submission as $sub){		
		$entry[$counter] = sanitize_text_field($sub['value']);
		$counter++;
	}

	submit_gf_entry($entry);
}

function submit_gf_entry($entry){
	
	$entry_id = GFAPI::add_entry($entry);
	if(is_wp_error($entry_id)){
		echo 0;
	}
	else{
		send_notifications($form_id, $entry_id);
		echo $entry_id;
	}
		
	wp_die();

}


// send notifications
function send_notifications($form_id, $entry_id){

	// Get the array info for our forms and entries
	// that we need to send notifications for

	$form = RGFormsModel::get_form_meta($form_id);
	$entry = RGFormsModel::get_lead($entry_id);

	// Loop through all the notifications for the
	// form so we know which ones to send

	$notification_ids = array();

	foreach($form['notifications'] as $id => $info){

		array_push($notification_ids, $id);

	}

	// Send the notifications

	GFCommon::send_notifications($notification_ids, $form, $entry);

}

//Gravity Forms API Submissions