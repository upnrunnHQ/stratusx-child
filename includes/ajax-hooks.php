<?php
add_action( 'wp_ajax_get_graph_performance_by_year', 'stratusx_child_get_graph_performance_by_year_via_ajax' );
add_action( 'wp_ajax_nopriv_get_graph_performance_by_year', 'stratusx_child_get_graph_performance_by_year_via_ajax' );
add_action( 'wp_ajax_get_cash_performance_by_year', 'stratusx_child_get_cash_performance_by_year_via_ajax' );
add_action( 'wp_ajax_nopriv_get_cash_performance_by_year', 'stratusx_child_get_cash_performance_by_year_via_ajax' );

add_action( 'wp_ajax_get_repeated_trades', 'stratusx_child_get_repeated_trades_via_ajax' );
add_action( 'wp_ajax_nopriv_get_repeated_trades', 'stratusx_child_get_repeated_trades_via_ajax' );
add_action( 'wp_ajax_get_filter_trade', 'stratusx_child_get_filter_trade_via_ajax' );
add_action( 'wp_ajax_nopriv_get_filter_trade', 'stratusx_child_get_filter_trade_via_ajax' );
add_action( 'wp_ajax_get_filter_trading_sectors_html', 'stratusx_child_get_trading_sectors_html_via_ajax' );
add_action( 'wp_ajax_nopriv_get_filter_trading_sectors_html', 'stratusx_child_get_trading_sectors_html_via_ajax' );

function stratusx_child_get_graph_performance_by_year_via_ajax() {
	$portfolio_id = isset( $_POST['portfolio_id'] ) ? sanitize_text_field( $_POST['portfolio_id'] ) : '';
	$filter_year  = isset( $_POST['filter_year'] ) ? absint( $_POST['filter_year'] ) : date( 'Y' );

	$performance_detail = stratusx_child_get_performance_detail( $portfolio_id, $filter_year );
	$performance_detail = $performance_detail->data[0];

	$yearly_data             = [];
	$performance_detail_html = '';

	$current_item_index = 1;
	$visible_months     = stratusx_child_get_visible_months();

	$current_year  = date( 'Y' );
	$current_month = date( 'n' );

	foreach ( $performance_detail->performance as $performance_item ) {
		if ( ( intval( $performance_item->year ) === intval( $current_year ) ) && ( intval( $performance_item->m ) > $current_month ) ) {
			continue;
		}

		$month     = convert_month_to_arabic( 'full_month', $performance_item->month );
		$num_class = intval( $performance_item->value ) < 0 ? 'per_num c_num_r' : 'per_num';

		if ( in_array( $performance_item->month, $visible_months, true ) ) {
			$performance_detail_html .= '<div class="monthly_per">';
		} else {
			$performance_detail_html .= '<div class="monthly_per" style="display: none;">';
		}

		$performance_detail_html .= '<h4 class="per_mon">' . $month . '</h4>';
		$performance_detail_html .= '<h4 class="' . $num_class . '">' . $performance_item->value . '%</h4>';
		$performance_detail_html .= '</div>';

		$yearly_data['graphPerformance']['labels'][] = $month;
		$yearly_data['graphPerformance']['data'][]   = $performance_item->value;

		$current_item_index++;
	}

	$yearly_data['portfolio_id']      = $portfolio_id;
	$yearly_data['performanceDetail'] = $performance_detail_html;

	$header_class = floatval( $performance_detail->totalPerformance ) < 0 ? 'totle_see_m negative' : 'totle_see_m';

	$yearly_data['totalPerformance'] = '
	<div class="' . $header_class . '">
		<h4 class="tot_txt">' .  __( 'المجموع: ', 'stratusx-child' ) . '<span>' . esc_html( $performance_detail->totalPerformance ) . '%</span></h4>
	</div>
	';

	wp_send_json_success( $yearly_data );
}

function stratusx_child_get_cash_performance_by_year_via_ajax() {
	$portfolio_id = isset( $_POST['portfolio_id'] ) ? sanitize_text_field( $_POST['portfolio_id'] ) : '';
	$filter_year  = isset( $_POST['filter_year'] ) ? absint( $_POST['filter_year'] ) : date( 'Y' );

	$graph_performance = json_decode( stratusx_child_get_graph_performance( $portfolio_id, $filter_year ) );
	$graph_performance = $graph_performance->data[0];

	$yearly_data                      = [];
	$yearly_data['performanceWidget'] = stratusx_child_get_graph_performance_widget( $graph_performance );
	$yearly_data['chartJS']           = stratusx_child_graph_performance_data_chartjs( $graph_performance );

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

		wp_send_json_success( $html );
	}

	wp_send_json_error();
}
