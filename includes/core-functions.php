<?php
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
			$indicator_data['chartjs']['labels'][]   = $risk_item->month;
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

		set_transient( $transient_id, $response, HOUR_IN_SECONDS );

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

		curl_close( $curl );

		set_transient( $transient_id, $response, HOUR_IN_SECONDS );

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

		curl_close( $curl );

		set_transient( $transient_id, $response, HOUR_IN_SECONDS );

		return $response;
	} catch ( Exception $e ) {
		return [];
	}
}

function stratusx_child_get_get_graph_performance( $portfolio_id, $filter_year = 2021 ) {
	try {
		$transient_id      = "stratusx_child_get_graph_performance_{$portfolio_id}_{$filter_year}";
		$graph_performance = get_transient( $transient_id );
		if ( $graph_performance ) {
			// print_r( json_decode( $graph_performance ) );
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

		curl_close( $curl );

		set_transient( $transient_id, $response, HOUR_IN_SECONDS );

		return $response;
	} catch ( Exception $e ) {
		return [];
	}
}
