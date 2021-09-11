<?php
add_action( 'wp_ajax_get_graph_performance_by_year', 'stratusx_child_get_graph_performance_by_year_via_ajax' );
add_action( 'wp_ajax_nopriv_get_graph_performance_by_year', 'stratusx_child_get_graph_performance_by_year_via_ajax' );
add_action( 'wp_ajax_get_repeated_trades', 'stratusx_child_get_repeated_trades_via_ajax' );
add_action( 'wp_ajax_nopriv_get_repeated_trades', 'stratusx_child_get_repeated_trades_via_ajax' );


function stratusx_child_get_graph_performance_by_year_via_ajax() {
	$portfolio_id = isset( $_POST['portfolio_id'] ) ? sanitize_text_field( $_POST['portfolio_id'] ) : '';
	$filter_year  = isset( $_POST['filter_year'] ) ? absint( $_POST['filter_year'] ) : date( 'Y' );

	$graph_performance = json_decode( stratusx_child_get_graph_performance( $portfolio_id, $filter_year ) );
	$graph_performance = $graph_performance->data[0];

	$performance_detail = stratusx_child_get_performance_detail( $portfolio_id, $filter_year );
	$performance_detail = $performance_detail->data[0];

	$performance_detail_html = '';

	$current_item_index = 1;
	foreach ( $performance_detail->performance as $performance_item ) {
		if ( $current_item_index <= 3 ) {
			$performance_detail_html .= '<div class="monthly_per">';
		} else {
			$performance_detail_html .= '<div class="monthly_per" style="display: none;">';
		}

		$performance_detail_html .= '<h4 class="per_mon">' . $performance_item->month . '</h4>';
		$performance_detail_html .= '<h4 class="per_num">' . $performance_item->value . '%</h4>';
		$performance_detail_html .= '</div>';

		$current_item_index++;
	}

	$yearly_data = [];

	foreach ( $graph_performance->performance as $performance_item ) {
		$yearly_data['graphPerformance'][] = $performance_item->value;
	}

	$yearly_data['performanceDetail']  = $performance_detail_html;
	$yearly_data['totalPerformance']   = sprintf( __( 'Total: %s', 'stratusx-child' ), $performance_detail->totalPerformance ) . '%';
	$yearly_data['performanceWidget']  = stratusx_child_get_graph_performance_widget( $graph_performance );
	$yearly_data['$graph_performance'] = $graph_performance;

	wp_send_json_success( $yearly_data );
}

function stratusx_child_get_repeated_trades_via_ajax() {
	if ( ! isset( $_POST['portfolio_id'], $_POST['page'] ) ) {
		wp_send_json_error( new WP_Error( 'invalid', __( 'Invalid portfolio_id or page.', 'stratusx-child' ) ) );
	}

	$portfolio_id = sanitize_text_field( $_POST['portfolio_id'] );
	$page         = sanitize_text_field( $_POST['page'] );

	$repeated_trades = stratusx_child_get_repeated_trades( $portfolio_id, $page );

	wp_send_json_success( [ $repeated_trades ] );
}
