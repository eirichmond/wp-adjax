<?php

/**
 * Enqueue and Localize the script matching the handle and passing any parameters to the script
 *
 * @return void
 */
function action_hook_load_scripts() {
	// load script
	wp_enqueue_script( 'script-handle', get_template_directory_uri() . '/js/the-script.js', array('jquery'), '', true );
	// in JavaScript, object properties are accessed as ajax_object.ajax_url, ajax_object.we_value
	wp_localize_script( 'script-handle', 'script_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'nextNonce' => wp_create_nonce( 'create-nonce' ) ) );
}
add_action( 'wp_enqueue_scripts', 'action_hook_load_scripts' );

/**
 * Create the function thats triggered by the script
 *
 * @return void
 */
function action_hook_function_name() {
    // Handle request then generate response using WP_Ajax_Response
    
    $nonce = $_POST['nextNonce'];
	if ( ! wp_verify_nonce( $nonce, 'create-nonce' ) ) {
		die ( 'Busted!' );
	}
	
	wp_send_json( 'action hook was fired correctly' );

    // Don't forget to stop execution afterward.
    wp_die();
}

add_action( 'wp_ajax_nopriv_action_hook_function_name', 'action_hook_function_name' );
add_action( 'wp_ajax_action_hook_function_name', 'action_hook_function_name' );

