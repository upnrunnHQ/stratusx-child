<?php
add_action( 'wp_ajax_get_graph_performance_by_year', 'stratusx_child_get_graph_performance_by_year_via_ajax' );
add_action( 'wp_ajax_nopriv_get_graph_performance_by_year', 'stratusx_child_get_graph_performance_by_year_via_ajax' );
add_action( 'wp_ajax_get_repeated_trades', 'stratusx_child_get_repeated_trades_via_ajax' );
add_action( 'wp_ajax_nopriv_get_repeated_trades', 'stratusx_child_get_repeated_trades_via_ajax' );
add_action( 'wp_ajax_get_filter_trade', 'stratusx_child_get_filter_trade_via_ajax' );
add_action( 'wp_ajax_nopriv_get_filter_trade', 'stratusx_child_get_filter_trade_via_ajax' );
add_action( 'wp_ajax_get_filter_trading_sectors_html', 'stratusx_child_get_trading_sectors_html_via_ajax' );
add_action( 'wp_ajax_nopriv_get_filter_trading_sectors_html', 'stratusx_child_get_trading_sectors_html_via_ajax' );

function stratusx_child_get_graph_performance_by_year_via_ajax() {
	$portfolio_id = isset( $_POST['portfolio_id'] ) ? sanitize_text_field( $_POST['portfolio_id'] ) : '';
	$filter_year  = isset( $_POST['filter_year'] ) ? absint( $_POST['filter_year'] ) : date( 'Y' );

	$graph_performance   = json_decode( stratusx_child_get_graph_performance( $portfolio_id, $filter_year ) );
	$graph_performance   = $graph_performance->data[0];
	$performance_chartjs = stratusx_child_graph_performance_data_chartjs( $graph_performance );

	$performance_detail = stratusx_child_get_performance_detail( $portfolio_id, $filter_year );
	$performance_detail = $performance_detail->data[0];

	$yearly_data             = [];
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

		$yearly_data['graphPerformance']['labels'][] = $performance_item->month;
		$yearly_data['graphPerformance']['data'][]   = $performance_item->value;

		$current_item_index++;
	}

	$yearly_data['portfolio_id']       = $portfolio_id;
	$yearly_data['performanceDetail']  = $performance_detail_html;
	$yearly_data['totalPerformance']   = sprintf( __( 'Total: %s', 'stratusx-child' ), $performance_detail->totalPerformance ) . '%';
	$yearly_data['performanceWidget']  = stratusx_child_get_graph_performance_widget( $graph_performance );
	$yearly_data['performanceChartjs'] = $performance_chartjs;

	wp_send_json_success( $yearly_data );
}

function stratusx_child_get_repeated_trades_via_ajax() {
	if ( ! isset( $_POST['portfolio_id'], $_POST['page'] ) ) {
		wp_send_json_error( new WP_Error( 'invalid', __( 'Invalid portfolio_id or page.', 'stratusx-child' ) ) );
	}

	$portfolio_id = sanitize_text_field( $_POST['portfolio_id'] );
	$page         = sanitize_text_field( $_POST['page'] );

	$repeated_trades = stratusx_child_get_repeated_trades( $portfolio_id, $page );
	$repeated_trades = $repeated_trades->data[0]->repeatedTrade;

	ob_start();
	get_template_part(
		'template-parts/content',
		'repeated-trades-list-items',
		[ 'repeated_trades' => $repeated_trades ]
	);
	$repeated_trades_html = ob_get_clean();

	wp_send_json_success( [ 'repeated_trades' => $repeated_trades_html ] );
}

function stratusx_child_get_filter_trade_via_ajax() {
	if ( ! isset( $_POST['portfolio_id'], $_POST['filter_type'] ) ) {
		wp_send_json_error( new WP_Error( 'invalid', __( 'Invalid portfolio_id or filter_type.', 'stratusx-child' ) ) );
	}

	$portfolio_id = sanitize_text_field( $_POST['portfolio_id'] );
	$filter_type  = sanitize_text_field( $_POST['filter_type'] );

	$filtered_trade = stratusx_child_get_filtered_trade( $portfolio_id, $filter_type );

	wp_send_json_success( [ 'filtered_trade' => $filtered_trade ] );
}

function stratusx_child_get_trading_sectors_html_via_ajax() {
	$sectors = isset( $_POST['sectors'] ) ? $_POST['sectors'] : array();

	$html = '';

	if ( $sectors ) {
		ob_start();

		get_template_part(
			'template-parts/content',
			'trading-sectors',
			array( 'sectors' => $sectors )
		);

		$html = ob_get_clean();
	}

	echo $html;
	exit;
}
