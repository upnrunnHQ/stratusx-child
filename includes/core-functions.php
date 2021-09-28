<?php
function stratusx_child_get_list_years( $start_year = 2019 ) {
	$list_years   = [];
	$current_year = date( 'Y' );
	for ( $i = $current_year; $i >= $start_year; $i-- ) {
		$list_years[] = $i;
	}

	return $list_years;
}

function stratusx_child_graph_performance_data_chartjs( $graph_performance ) {
	$labels   = [];
	$datasets = [];

	$unfiltered_datasets = [];
	$background_colors   = [
		'Graph' => '#316EA5',
		'CO'    => '#E00B05',
		'CI'    => '#15F20D',
		'D'     => '#42A4E5',
	];

	$current_year  = date( 'Y' );
	$current_month = date( 'n' );

	foreach ( $graph_performance->performance as $performance ) {
		if ( ( intval( $performance->year ) === intval( $current_year ) ) && ( intval( $performance->m ) > $current_month ) ) {
			continue;
		}

		//$labels[] = substr( $performance->month, 0, 3 );
		$labels[] = convert_month_to_arabic( 'short_month', $performance->month );

		$unfiltered_datasets['Graph'][] = $performance->value;
		$unfiltered_datasets['CO'][]    = $performance->CO;
		$unfiltered_datasets['CI'][]    = $performance->CI;
		$unfiltered_datasets['D'][]     = $performance->D;
	}

	foreach ( $unfiltered_datasets as $key => $value ) {
		$dataset = [
			'label' => $key,
			'data'  => $value,
		];

		if ( 'Graph' === $key ) {
			$dataset['type']        = 'line';
			$dataset['borderColor'] = $background_colors[ $key ];
			$dataset['fill']        = false;
		} else {
			$dataset['type']            = 'bar';
			$dataset['backgroundColor'] = $background_colors[ $key ];
		}

		$datasets[] = $dataset;
	}

	return [
		'labels'   => $labels,
		'datasets' => $datasets,
	];
}

function stratusx_child_get_risk_indicator_data( $user_information ) {
	$indicator_data = [
		'chartjs'       => [
			'labels'   => [],
			'datasets' => [],
		],
		'totalRiskRate' => $user_information->totalRiskRate,
	];

	if ( isset( $user_information->riskPrevious12Month ) ) {
		foreach ( $user_information->riskPrevious12Month as $risk_item ) {
			//$indicator_data['chartjs']['labels'][]   = substr( $risk_item->month, 0, 3 );
			$indicator_data['chartjs']['labels'][] = convert_month_to_arabic( 'full_month', $risk_item->month );

			$indicator_data['chartjs']['datasets'][] = $risk_item->value;
		}
	}

	return $indicator_data;
}

function analyst_expert_user_type( $type_id ) {
	switch ( $type_id ) {
		case 1:
			echo 'Technical';
			break;
		case 2:
			echo 'Financial';
			break;
		case 3:
			echo 'Technical and financial';
			break;
		default:
			echo 'Other';
	}
}
function stratusx_child_get_analyst_details( $analyst_id ) {

	try {
		$transient_id    = "stratusx_child_get_analyst_details_{$analyst_id}";
		$analyst_details = get_transient( $transient_id );
		if ( $analyst_details ) {
			return $analyst_details;
		}

		$curl = curl_init();

		curl_setopt_array(
			$curl,
			array(
				CURLOPT_URL            => "https://appsinvodevlopment.com/dawul-new-backend/api/analyst/details?analyst_id={$analyst_id}&languageType=1&token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvYXBwc2ludm9kZXZsb3BtZW50LmNvbVwvZGF3dWwtbmV3LWJhY2tlbmRcL2FwaVwvbG9naW4iLCJpYXQiOjE2MjkzNjgxMTgsIm5iZiI6MTYyOTM2ODExOCwianRpIjoiQUxGaFpRc0xBemlZOWRFbiIsInN1YiI6MTc3NSwicHJ2IjoiODdlMGFmMWVmOWZkMTU4MTJmZGVjOTcxNTNhMTRlMGIwNDc1NDZhYSJ9.WdoSYu0AkDPF0R6vJ_6X8be39UNzAMkxC2wEXJ_JodA&deviceToken=f_KjDyF9r_g:APA91bFVmQivW26s6zxE54SZDnssRGJMO3JxLY3XNEvgaxnfGeBeJWhJLMoZPgTTcPL1efAc5HixZIsAeCvVVy4gRkTfmf0QfQV-pbynJRL1i1tlR2PngzxLYdP0x4PYFsy1NCZH1NOf&is_web=1",
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING       => '',
				CURLOPT_MAXREDIRS      => 10,
				CURLOPT_TIMEOUT        => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST  => 'GET',
			)
		);

		$response = curl_exec( $curl );

		curl_close( $curl );

		set_transient( $transient_id, $response, 24 * HOUR_IN_SECONDS );

		return $response;
	} catch ( Exception $e ) {
		return [];
	}
}

function stratusx_child_get_get_other_profile( $portfolio_id ) {

	try {
		$transient_id  = "stratusx_child_get_get_other_profile_{$portfolio_id}";
		$other_profile = get_transient( $transient_id );
		if ( $other_profile ) {
			// print_r( json_decode( $other_profile ) );
			return $other_profile;
		}

		$token   = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvYXBwc2ludm9kZXZsb3BtZW50LmNvbVwvZGF3dWwtbmV3LWJhY2tlbmRcL2FwaVwvbG9naW4iLCJpYXQiOjE2MjkzNjgxMTgsIm5iZiI6MTYyOTM2ODExOCwianRpIjoiQUxGaFpRc0xBemlZOWRFbiIsInN1YiI6MTc3NSwicHJ2IjoiODdlMGFmMWVmOWZkMTU4MTJmZGVjOTcxNTNhMTRlMGIwNDc1NDZhYSJ9.WdoSYu0AkDPF0R6vJ_6X8be39UNzAMkxC2wEXJ_JodA';
		$url     = 'https://appsinvodevlopment.com/dawul-new-backend/api/getOtherProfile';
		$fields  = array(
			'Portfolio_ID' => $portfolio_id,
			'token'        => $token,
			'is_web'       => 1,
		);
		$headr   = array();
		$headr[] = 'Content-type: application/json';
		$headr[] = 'Authorization: ' . $token;
		$ch      = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $url );
		curl_setopt( $ch, CURLOPT_POST, true );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, $headr );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );
		// Execute post
		$response = curl_exec( $ch );

		curl_close( $ch );

		set_transient( $transient_id, $response, 24 * HOUR_IN_SECONDS );

		return $response;
	} catch ( Exception $e ) {
		return [];
	}
}

function stratusx_child_get_get_user_information( $portfolio_id, $filter_year = 2021 ) {
	try {
		$transient_id     = "stratusx_child_get_user_information_{$portfolio_id}_{$filter_year}";
		$user_information = get_transient( $transient_id );
		if ( $user_information ) {
			// print_r( json_decode( $user_information ) );
			return $user_information;
		}

		$token    = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvYXBwc2ludm9kZXZsb3BtZW50LmNvbVwvZGF3dWwtbmV3LWJhY2tlbmRcL2FwaVwvbG9naW4iLCJpYXQiOjE2MjkzNjgxMTgsIm5iZiI6MTYyOTM2ODExOCwianRpIjoiQUxGaFpRc0xBemlZOWRFbiIsInN1YiI6MTc3NSwicHJ2IjoiODdlMGFmMWVmOWZkMTU4MTJmZGVjOTcxNTNhMTRlMGIwNDc1NDZhYSJ9.WdoSYu0AkDPF0R6vJ_6X8be39UNzAMkxC2wEXJ_JodA';
		$url2     = 'https://appsinvodevlopment.com/dawul-new-backend/api/userInformation';
		$fields   = array(
			'Portfolio_ID' => $portfolio_id,
			'token'        => $token,
			'is_web'       => 1,
			'filterYear'   => $filter_year,
		);
		$header   = array();
		$header[] = 'Content-type: application/json';
		$header[] = 'Authorization: ' . $token;
		$ch       = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $url2 );
		curl_setopt( $ch, CURLOPT_POST, true );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, $header );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );
		// Execute post
		$response = curl_exec( $ch );

		curl_close( $ch );

		set_transient( $transient_id, $response, 24 * HOUR_IN_SECONDS );

		return $response;
	} catch ( Exception $e ) {
		return [];
	}
}

function stratusx_child_get_graph_performance( $portfolio_id, $filter_year = 2021 ) {
	try {
		$transient_id      = "stratusx_child_get_graph_performance_{$portfolio_id}_{$filter_year}";
		$graph_performance = get_transient( $transient_id );
		if ( $graph_performance ) {
			return $graph_performance;
		}

		$token     = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvYXBwc2ludm9kZXZsb3BtZW50LmNvbVwvZGF3dWwtbmV3LWJhY2tlbmRcL2FwaVwvbG9naW4iLCJpYXQiOjE2MjkzNjgxMTgsIm5iZiI6MTYyOTM2ODExOCwianRpIjoiQUxGaFpRc0xBemlZOWRFbiIsInN1YiI6MTc3NSwicHJ2IjoiODdlMGFmMWVmOWZkMTU4MTJmZGVjOTcxNTNhMTRlMGIwNDc1NDZhYSJ9.WdoSYu0AkDPF0R6vJ_6X8be39UNzAMkxC2wEXJ_JodA';
		$fields    = array(
			'Portfolio_ID' => $portfolio_id,
			'token'        => $token,
			'is_web'       => 1,
			'filterYear'   => $filter_year,
		);
		$url3      = 'https://appsinvodevlopment.com/dawul-new-backend/api/graphPerformance';
		$headers   = array();
		$headers[] = 'Content-type: application/json';
		$headers[] = 'Authorization: ' . $token;
		$ch        = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $url3 );
		curl_setopt( $ch, CURLOPT_POST, true );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );
		// Execute post
		$response = curl_exec( $ch );

		curl_close( $ch );

		set_transient( $transient_id, $response, 24 * HOUR_IN_SECONDS );

		return $response;
	} catch ( Exception $e ) {
		return [];
	}
}

function stratusx_child_get_performance_detail( $portfolio_id, $created_date ) {
	$transient_id       = "stratusx_child_get_performance_detail_{$portfolio_id}_{$created_date}";
	$performance_detail = get_transient( $transient_id );
	if ( $performance_detail ) {
		return $performance_detail;
	}

	try {
		$curl = curl_init();

		curl_setopt_array(
			$curl,
			array(
				CURLOPT_URL            => 'https://appsinvodevlopment.com/dawul-new-backend/api/performanceDetail',
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING       => '',
				CURLOPT_MAXREDIRS      => 10,
				CURLOPT_TIMEOUT        => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST  => 'POST',
				CURLOPT_POSTFIELDS     => array(
					'Portfolio_ID' => $portfolio_id,
					'token'        => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvYXBwc2ludm9kZXZsb3BtZW50LmNvbVwvZGF3dWwtbmV3LWJhY2tlbmRcL2FwaVwvbG9naW4iLCJpYXQiOjE2MjkzNjgxMTgsIm5iZiI6MTYyOTM2ODExOCwianRpIjoiQUxGaFpRc0xBemlZOWRFbiIsInN1YiI6MTc3NSwicHJ2IjoiODdlMGFmMWVmOWZkMTU4MTJmZGVjOTcxNTNhMTRlMGIwNDc1NDZhYSJ9.WdoSYu0AkDPF0R6vJ_6X8be39UNzAMkxC2wEXJ_JodA',
					'is_web'       => '1',
					'createdDate'  => $created_date,
				),
			)
		);

		$response = curl_exec( $curl );
		$response = json_decode( $response );
		set_transient( $transient_id, $response, 24 * HOUR_IN_SECONDS );
		curl_close( $curl );

		return $response;
	} catch ( Exception $e ) {
		return [];
	}
}

function stratusx_child_get_repeated_trades( $portfolio_id, $page_id ) {
	$transient_id   = "stratusx_child_get_repeated_trade_{$portfolio_id}_{$page_id}";
	$repeated_trade = get_transient( $transient_id );
	if ( $repeated_trade ) {
		return $repeated_trade;
	}

	$response = stratusx_child_get_curl_response(
		'https://appsinvodevlopment.com/dawul-new-backend/api/repeatedTrade',
		[
			'Portfolio_ID' => $portfolio_id,
			'page'         => $page_id,
		]
	);

	set_transient( $transient_id, $response, 24 * HOUR_IN_SECONDS );

	return $response;
}

function stratusx_child_get_filtered_trade( $portfolio_id, $filter_type ) {
	$transient_id = "stratusx_child_get_filter_trade_{$portfolio_id}_{$filter_type}";
	$filter_trade = get_transient( $transient_id );
	if ( $filter_trade ) {
		return $filter_trade;
	}

	$response = stratusx_child_get_curl_response(
		'https://appsinvodevlopment.com/dawul-new-backend/api/filterTrade',
		[
			'Portfolio_ID' => $portfolio_id,
			'filterType'   => $filter_type,
		]
	);

	set_transient( $transient_id, $response, 24 * HOUR_IN_SECONDS );

	return $response;
}

function stratusx_child_get_curl_response( $url, $postfields ) {
	try {
		$curl = curl_init();

		curl_setopt_array(
			$curl,
			array(
				CURLOPT_URL            => $url,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING       => '',
				CURLOPT_MAXREDIRS      => 10,
				CURLOPT_TIMEOUT        => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST  => 'POST',
				CURLOPT_POSTFIELDS     => array_merge(
					[
						'token'  => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvYXBwc2ludm9kZXZsb3BtZW50LmNvbVwvZGF3dWwtbmV3LWJhY2tlbmRcL2FwaVwvbG9naW4iLCJpYXQiOjE2MjkzNjgxMTgsIm5iZiI6MTYyOTM2ODExOCwianRpIjoiQUxGaFpRc0xBemlZOWRFbiIsInN1YiI6MTc3NSwicHJ2IjoiODdlMGFmMWVmOWZkMTU4MTJmZGVjOTcxNTNhMTRlMGIwNDc1NDZhYSJ9.WdoSYu0AkDPF0R6vJ_6X8be39UNzAMkxC2wEXJ_JodA',
						'is_web' => '1',
					],
					$postfields
				),
			)
		);

		$response = curl_exec( $curl );
		$response = json_decode( $response );
		curl_close( $curl );

		return $response;
	} catch ( Exception $e ) {
		return [];
	}
}

function stratusx_child_get_trading_filters() {
	return [
		1 => __( 'يوما ما', 'stratusx-child' ),
		2 => __( 'اسبوع واحد', 'stratusx-child' ),
		3 => __( 'شهر', 'stratusx-child' ),
		4 => __( 'ثلاث شهور', 'stratusx-child' ),
		5 => __( 'ستة أشهر', 'stratusx-child' ),
		6 => __( 'الفترة كلها', 'stratusx-child' ),
	];
}

function stratusx_child_get_trading_sectors_colors() {
	return [
		'#2b75ba',
		'#f00017',
		'#dc961f',
	];
}

function stratusx_child_get_visible_months() {
	return [
		date( 'F', strtotime( '0 month' ) ),
		date( 'F', strtotime( '-1 month' ) ),
		date( 'F', strtotime( '-2 month' ) ),
	];
}
