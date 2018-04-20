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
		echo $entry_id;
	}
		
	wp_die();

}

//Gravity Forms API Submissions