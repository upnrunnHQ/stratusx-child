<?php
add_action( 'wp_ajax_get_graph_performance_by_year', 'stratusx_child_get_graph_performance_by_year_via_ajax' );
add_action( 'wp_ajax_nopriv_get_graph_performance_by_year', 'stratusx_child_get_graph_performance_by_year_via_ajax' );

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

	$yearly_data['performanceDetail'] = $performance_detail_html;
	$yearly_data['totalPerformance']  = sprintf( __( 'Total: %s', 'stratusx-child' ), $performance_detail->totalPerformance ) . '%';

	wp_send_json_success( $yearly_data );
}
