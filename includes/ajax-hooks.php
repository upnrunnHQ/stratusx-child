<?php
add_action( 'wp_ajax_stratusx_child_get_performance_yearly_wise_data', 'stratusx_child_get_performance_yearly_wise_data' );
add_action( 'wp_ajax_nopriv_stratusx_child_get_performance_yearly_wise_data', 'stratusx_child_get_performance_yearly_wise_data' );
function stratusx_child_get_performance_yearly_wise_data() {
	global $wpdb; // this is how you get access to the database

	$whatever = intval( $_POST['whatever'] );

	$whatever += 10;

		echo $whatever;

	wp_die(); // this is required to terminate immediately and return a proper response
}
