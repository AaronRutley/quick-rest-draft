<?php
/*
Plugin Name: Quick Rest Draft
Plugin URI: https://aaronrutley.com/
Description: Quick Rest Draft
Version: 0.0.1
Author: aaronrutley
Author URI: http://www.aaronrutley.com/
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

// Exit if plugin accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// Function that outputs the contents of the dashboard widget
function qrd_widget_function( $post, $callback_args ) {
	ob_start();?>


	<form id="quick_rest_draft">

		<div class="input-text-wrap" id="title-wrap">
			<label style="padding:0" for="title" id="title-prompt-text">Quick Draft Title</label>
			<input type="text" name="post_title" id="quick-rest-draft-title" autocomplete="off">
		</div>

		<div class="textarea-wrap" id="description-wrap">
			<label style="padding:0" for="quick-rest-draft-content" id="content-prompt-text">Quick Draft Content</label>
			<textarea name="content" id="quick-rest-draft-content" rows="10" cols="15" autocomplete="off"></textarea><grammarly-btn><div style="visibility: hidden; z-index: 2;" class="_9b5ef6-textarea_btn _9b5ef6-anonymous _9b5ef6-not_focused" data-grammarly-reactid=".0"><div class="_9b5ef6-transform_wrap" data-grammarly-reactid=".0.0"><div title="Protected by Grammarly" class="_9b5ef6-status" data-grammarly-reactid=".0.0.0">&nbsp;</div></div><span class="_9b5ef6-btn_text" data-grammarly-reactid=".0.1">Not signed in</span></div></grammarly-btn>
		</div>

		<p>
			<input type="submit" name="save" id="save-post" class="button button-primary" value="Save Quick Rest Draft">
			<br class="clear">
		</p>

	</form>

		<?php
		ob_end_flush();

}

// Function used in the action hook
function qrd_add_dashboard_widgets() {
	wp_add_dashboard_widget('qrp_dashboard_widget', 'Quick REST Draft', 'qrd_widget_function');
}

// Register the new dashboard widget with the 'wp_dashboard_setup' action
add_action('wp_dashboard_setup', 'qrd_add_dashboard_widgets' );


add_action( 'admin_enqueue_scripts', function() {

    // enqueue script
	wp_enqueue_script( 'quick_rest_draft', plugin_dir_url( __FILE__ ) . 'quick_rest_draft.js', array( 'jquery' ) );

    // localize script
	wp_localize_script( 'quick_rest_draft', 'QUICK_REST_DRAFT', array(
			'root' => esc_url_raw( rest_url() ),
			'nonce' => wp_create_nonce( 'wp_rest' ),
			'success' => __( 'Thanks for your quick rest post!', 'quick_rest_draft' ),
			'failure' => __( 'Your quick rest post could not be processed.', 'quick_rest_draft' ),
			'current_user_id' => get_current_user_id(),
		)
	);

});
