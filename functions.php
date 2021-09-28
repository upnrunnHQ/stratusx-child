<?php
include( get_stylesheet_directory() . '/includes/core-functions.php' );
include( get_stylesheet_directory() . '/includes/scripts.php' );
include( get_stylesheet_directory() . '/includes/ajax-hooks.php' );
include( get_stylesheet_directory() . '/includes/template-functions.php' );
include( get_stylesheet_directory() . '/includes/class-stratusx-child.php' );

add_filter( 'wf_pklist_alter_tax_inclusive_text', 'wf_pklist_remove_tax_text', 10, 3 );
add_action( 'wp_head', 'stratusx_child_remove_actions' );
add_action( 'woocommerce_after_shop_loop_item', 'stratusx_child_expert_details_button', 5 );
add_action( 'pre_get_posts', 'stratusx_child_product_query' );
add_filter( 'woocommerce_shortcode_products_query', 'stratusx_child_shortcode_products_query' );

if ( SITECOOKIEPATH != COOKIEPATH ) {
	setcookie( TEST_COOKIE, 'WP Cookie check', 0, SITECOOKIEPATH, COOKIE_DOMAIN );
}

function wf_pklist_remove_tax_text( $incl_tax_text, $template_type, $order ) {
	if ( $template_type == 'invoice' ) {
		$incl_tax_text = '';
	}
	return $incl_tax_text;
}

function stratusx_child_product_query( $query ) {
	if ( ! is_admin() && $query->is_main_query() && is_post_type_archive( 'product' ) ) {
		$meta_query   = $query->get( 'meta_query' );
		$meta_query[] = [
			'key'   => 'expert_analyst_details_user-type',
			'value' => 'expert',
		];

		$query->set( 'meta_query', $meta_query );
	}
}

function stratusx_child_shortcode_products_query( $query_args ) {
	if ( is_page( 'analysts' ) ) {
		$query_args['meta_query'][] = [
			'key'   => 'expert_analyst_details_user-type',
			'value' => 'analyst',
		];
	}

	return $query_args;
}

// add_filter('woocommerce_show_page_title', 'bbloomer_hide_shop_page_title');

// function bbloomer_hide_shop_page_title($title) {
//    if (is_shop()) $title = false;
//    return $title;
// }

// add_filter( 'woocommerce_show_page_title', 'bbloomer_hide_shop_page_title' );

// function bbloomer_hide_shop_page_title( $title ) {
//    if ( is_shop() ) $title = false;
//    return $title;
// }

// add_filter( 'woocommerce_show_page_title', 'bbloomer_hide_cat_page_title' );

// function bbloomer_hide_cat_page_title( $title ) {
//    if ( is_product_category() ) $title = false;
//    return $title;
// }

// add_filter( 'woocommerce_show_page_title', '__return_null' );

function stratusx_child_remove_actions() {
	remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
	remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );

	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );

	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

	add_action( 'woocommerce_after_single_product_summary', 'stratusx_child_expert_details' );
}

function stratusx_child_expert_details() {
	global $product;

	$product_id = $product->get_id();
	$user_type  = get_post_meta( $product_id, 'expert_analyst_details_user-type', true );
	if ( empty( $user_type ) ) {
		return;
	}

	$current_year = date( 'Y' );
	$portfolio_id = '';

	if ( 'expert' === $user_type ) {
		$portfolio_id = get_post_meta( $product_id, 'expert_analyst_details_portfolio-id', true );
		// API userInformation
		$user_information = json_decode( stratusx_child_get_get_user_information( $portfolio_id, $current_year ) );
		$user_information = $user_information->data[0];

		//print_r($user_information);

		//API 3 graphInformation
		$graph_performance = json_decode( stratusx_child_get_graph_performance( $portfolio_id, $current_year ) );
		$graph_performance = $graph_performance->data[0];

		$performance_detail = stratusx_child_get_performance_detail( $portfolio_id, $current_year );

		// List of years.
		$list_years = stratusx_child_get_list_years( $user_information->startYear );
		// print_r( $user_information );
		// print_r( $graph_performance );
		// print_r( $performance_detail );
	} else {
		$analyst_id = get_post_meta( $product_id, 'expert_analyst_details_id', true );
		if ( ! empty( $analyst_id ) ) {
			$analyst_details = stratusx_child_get_analyst_details( $analyst_id );
			$analyst_details = json_decode( $analyst_details, true );
			if ( isset( $analyst_details['data']['analyst']['portfolio_id'] ) ) {
				$portfolio_id = $analyst_details['data']['analyst']['portfolio_id'];
			}
		}
	}

	$featured_img_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
	$other_profile    = json_decode( stratusx_child_get_get_other_profile( $portfolio_id ) );
	$other_profile    = $other_profile->data[0];
	// print_r($other_profile);
	?>
	<div class="anly_profile_main exp_pro_main">
		<div class="container-fluid">
			<?php if ( 'expert' === $user_type ) : ?>
				<div class="anly_right_content exp_p_detail">
					<div class="anly_profile_img_main">
						<img src="<?php echo esc_url( $featured_img_url ); ?>" alt="" class="img-fluid anly_pro_pic">
					</div>
					<div class="anly_profile_content">
						<div class="anly_person_details">
							<div class="per_details">
								<h1 class="a_per_nm"><?php echo $other_profile->userName; ?></h1>
								<span class="a_per_id"><?php echo $other_profile->emailAddress; ?></span>
								<p class="exp_profit">الأرباح لاخر شهر: <spna class="exp_per"><?php echo $other_profile->profileProfit; ?>%</spna>
								</p>
								<div class="exp_part_btn">
									<a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="exp_partici_btn">الاشتراك</a>
								</div>

								<div class="user_about_section">
									<h3 class="usr_ab_name"><?php printf( __( 'نبذة تعريفية عن %s', 'stratusx-child' ), $other_profile->userName ); ?></h3>
									<p class="usr_ab_content"><?php echo $user_information->aboutUs; ?></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php else : ?>
				<div class="anly_right_content">
					<div class="anly_profile_img_main">
						<img src="<?php echo esc_url( $featured_img_url ); ?>" alt="" class="img-fluid anly_pro_pic">
					</div>
					<div class="anly_profile_content">
						<div class="anly_person_details">
							<div class="per_details">
								<h1 class="a_per_nm"><?php echo $analyst_details['data']['analyst']['name']; ?></h1>
								<span class="a_per_id">@<?php echo $analyst_details['data']['analyst']['user_name']; ?></span>
								<?php $user_type = $analyst_details['data']['analyst']['user_type']; ?>
								<h3 class="usr_ab_type">نوع التحليل : <?php analyst_expert_user_type( $user_type ); ?></h3>
							</div>
							<div class="anyl_participate">
								<a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="anly_partici_btn">الاشتراك </a>
							</div>
						</div>
						<div class="prof_details_name">
							<div class="prof_nm_cont">
								<spna class="p_full_nm">الاسم كامل </spna>
								<h3 class="full_name"><?php echo $analyst_details['data']['analyst']['name']; ?></h3>
							</div>
							<div class="prof_dt_cont">
								<spna class="p_full_nm">تاريخ الانظمام</spna>
								<?php
								$date      = date_create( $analyst_details['data']['created_at'] );
								$date_join = date_format( $date, 'd-m-Y' );
								?>
								<h3 class="full_name"><?php echo $date_join; ?></h3>
							</div>
						</div>
						<div class="user_about_section">
							<h3 class="usr_ab_name">نبذة تعريفية عن <?php echo $analyst_details['data']['analyst']['name']; ?></h3>
							<p class="usr_ab_content"><?php echo $analyst_details['data']['bio']; ?></p>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>

	<?php if ( 'expert' === $user_type ) : ?>
		<div id="home">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-3">
						<div class="user_p_heading">
							<!-- <h4>Timeline</h4> -->
						</div>

						<div class="exp-add_info">
							<h4><?php _e( 'معلومات إضافية', 'stratusx-child' ); ?></h4>
							<a tabindex="0" role="button" data-toggle="tooltip" title="<?php _e( 'بيانات إحصائية عن آخر 12 شهر', 'stratusx-child' ); ?>">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/info-white-e.png" alt="info">
							</a>
						</div>
						<div class="addition_info_area exp_additon_info">

							<div class="trades_monthly exp_trades_monthly">
								<div class="add_cale">
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/calendar-e.png" alt="calendar">
								</div>
								<div class="a_trades-inner">
									<div class="a_week_trades">
										<h5 class="week_num"><?php echo $user_information->totalTradePerWeek; ?></h5>
										<h5 class="week_txt">الصفقات الاسبوعية </h5>
										<a tabindex="0" role="button" data-toggle="tooltip" title="<?php _e( 'ستظهر هنا عدد الصفقات السنوية', 'stratusx-child' ); ?>">
											<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/Path-1292.png" alt="info">
										</a>
									</div>
									<div class="a_week_trades">
										<h5 class="week_num"><?php echo $user_information->totalTradePerMonth; ?></h5>
										<h5 class="week_txt">الصفقات الشهرية </h5>
										<a tabindex="0" role="button" data-toggle="tooltip" title="<?php _e( 'ستظهر هنا عدد الصفقات السنوية', 'stratusx-child' ); ?>">
											<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/Path-1292.png" alt="info">
										</a>
									</div>
									<div class="a_week_trades">
										<h5 class="week_num"><?php echo $user_information->totalTradePerYear; ?></h5>
										<h5 class="week_txt">الصفقات السنوية </h5>
										<a tabindex="0" role="button" data-toggle="tooltip" title="<?php _e( 'ستظهر هنا عدد الصفقات السنوية', 'stratusx-child' ); ?>">
											<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/Path-1292.png" alt="info">
										</a>
									</div>
								</div>
							</div>
							<div class="trades_monthly exp_trades_monthly1">
								<div class="add_cale">
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/bar-e.png" alt="calendar">
									<a tabindex="0" role="button" data-toggle="tooltip" title="<?php _e( 'متوسط وقت الانتظار ', 'stratusx-child' ); ?>">
										<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/info-orange-e.png" alt="info">
									</a>
								</div>
								<div class="tra_days">
									<h4 class="days"><?php echo $user_information->avgHoldingTime; ?> يوم </h4>
									<h5 class="avg_time">متوسط وقت الانتظار </h5>
								</div>
							</div>
							<div class="trades_monthly exp_trades_monthly2">
								<div class="add_cale">
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/user-e.png" alt="calendar">
									<a tabindex="0" role="button" data-toggle="tooltip" title="<?php _e( 'تاريخ الانظمام', 'stratusx-child' ); ?>">
										<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/info-green-e.png" alt="info">
									</a>
								</div>
								<div class="tra_days">
									<h4 class="days"><?php echo date( 'd-m-y', strtotime( $user_information->joiningDate ) ); ?></h4>
									<h5 class="avg_time"><?php _e( 'نشط منذ ', 'stratusx-child' ); ?></h5>
								</div>
							</div>
							<div class="trades_monthly exp_trades_monthly3">
								<div class="add_cale">
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/bar-purple-e.png" alt="calendar">
									<a tabindex="0" role="button" data-toggle="tooltip" title="<?php _e( 'أعلى خسارة أو أدنى ربح للشهر الماضي', 'stratusx-child' ); ?>">
										<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/info-e.png" alt="info">
									</a>
								</div>
								<div class="max_profit">
									<div class="tra_days">
										<h4 class="days"><?php echo $user_information->maxProfitTrade; ?></h4>
										<h5 class="avg_time">اعلى ربح من الصفقات </h5>
									</div>
									<div class="tra_days">
										<h4 class="days"><?php echo $user_information->maxLossTrade; ?></h4>
										<h5 class="avg_time">اعلى خسارة من الصفقات </h5>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<?php
						get_template_part(
							'template-parts/content',
							'indication',
							[
								'labels' => [
									__( 'نسبة النقد ', 'stratus-child' ),
									__( 'نسبة التسهيلات ', 'stratus-child' ),
									__( 'نسبة الاسهم ', 'stratus-child' ),
									__( 'البحث عن النسبة المئوية', 'stratus-child' ),
								],
								'data'   => [
									$user_information->cashPercenage,
									$user_information->loanPercenage,
									$user_information->stockPercenage,
									$user_information->fundPercenage,
								],
							]
						);
						get_template_part(
							'template-parts/content',
							'risk-indicator',
							stratusx_child_get_risk_indicator_data( $user_information )
						);
						?>
						<div class="profit_score_main">
							<div class="profit_score_head">
								<div class="profit_icon">
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/profit-score.png" alt="">
									<h4 class="profit_txt"><?php _e( 'الأرباح ', 'stratus-child' ); ?></h4>
								</div>
							</div>

							<div class="porfit_inner">
								<div class="pro_score daily_score exp_daily_score" tabindex="0" role="button" data-toggle="tooltip" title="<?php _e( 'الربح / الخسارة لآخر يوم', 'stratusx-child' ); ?>">
									<span class="score_percent"><?php echo $user_information->profitScore[0]->dailyScore; ?>%</span>
									<h4 class="score_txt"><?php _e( 'اليومية ', 'stratus-child' ); ?></h4>
								</div>
								<div class="pro_score exp_pro_score" tabindex="0" role="button" data-toggle="tooltip" title="<?php _e( 'الربح / الخسارة لآخر 3 أشهر', 'stratusx-child' ); ?>">
									<span class="score_percent"><?php echo $user_information->profitScore[0]->monthlyScore; ?>%</span>
									<h4 class="score_txt"><?php _e( 'شهريا ', 'stratus-child' ); ?></h4>
								</div>
								<div class="pro_score exp_pro_score" tabindex="0" role="button" data-toggle="tooltip" title="<?php _e( 'الربح / الخسارة لآخر 12 شهرًا', 'stratusx-child' ); ?>">
									<span class="score_percent"><?php echo $user_information->profitScore[0]->yearlyScore; ?>%</span>
									<h4 class="score_txt"><?php _e( 'سنوي ', 'stratus-child' ); ?></h4>
								</div>
							</div>
						</div>
						<?php stratus_child_get_performance( $user_information->performance, $user_information->totalPerformance, $portfolio_id, $list_years ); ?>
						<?php
						get_template_part(
							'template-parts/content',
							'trading',
							[
								'user_information' => $user_information,
								'filters'          => stratusx_child_get_trading_filters(),
							]
						);
						?>
					</div>
					<div class="col-md-3">
						<?php
						$chartjs = stratusx_child_graph_performance_data_chartjs( $graph_performance );
						get_template_part(
							'template-parts/content',
							'performance',
							[
								'portfolio_id'      => $portfolio_id,
								'graph_performance' => $graph_performance,
								'list_years'        => $list_years,
								'chartjs'           => $chartjs,
							]
						);
						get_template_part(
							'template-parts/content',
							'repeated-trades',
							[
								'repeated_trades' => $user_information->repeatedTrade,
								'portfolio_id'    => $portfolio_id,
							]
						);
						?>
					</div>
				</div>
			</div>
		</div>

		<!-- Info Modal  -->
		<div class="modal fade" id="infoModal">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<h4 class="modal_info">Info</h4>
						<p class="info_content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni quibusdam
							animi qui, illo distinctio fuga deserunt, nobis minus suscipit aliquam fugiat, aspernatur
							voluptatum possimus repudiandae repellat autem explicabo iure. Accusamus odio officiis
							consequuntur dolorum libero voluptas ducimus voluptates, molestias in mollitia cumque.
							Reprehenderit ut minus mollitia similique aliquam? Nisi, deserunt?</p>
						<p class="info_content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni quibusdam
							animi qui, illo distinctio fuga deserunt, nobis minus suscipit aliquam fugiat, aspernatur
							voluptatum possimus repudiandae repellat autem explicabo iure. Accusamus odio officiis
							consequuntur dolorum libero voluptas ducimus voluptates, molestias in mollitia cumque.
							Reprehenderit ut minus mollitia similique aliquam? Nisi, deserunt?</p>
						<p class="info_content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni quibusdam
							animi qui, illo distinctio fuga deserunt, nobis minus suscipit aliquam fugiat, aspernatur
							voluptatum possimus repudiandae repellat autem explicabo iure. Accusamus odio officiis
							consequuntur dolorum libero voluptas ducimus voluptates, molestias in mollitia cumque.
							Reprehenderit ut minus mollitia similique aliquam? Nisi, deserunt?</p>
						<p class="info_content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni quibusdam
							animi qui, illo distinctio fuga deserunt, nobis minus suscipit aliquam fugiat, aspernatur
							voluptatum possimus repudiandae repellat autem explicabo iure. Accusamus odio officiis
							consequuntur dolorum libero voluptas ducimus voluptates, molestias in mollitia cumque.
							Reprehenderit ut minus mollitia similique aliquam? Nisi, deserunt?</p>
					</div>
				</div>
			</div>
		</div>
		<?php
	endif;
}

function convert_month_to_arabic( $full, $month ) {

	if ( $full == 'full_month' ) {

		$months = array(
			'January'   => 'يناير',
			'February'  => 'فبراير',
			'March'     => 'مارس',
			'April'     => 'أبريل',
			'May'       => 'مايو',
			'June'      => 'يونيو',
			'July'      => 'يوليو',
			'August'    => 'أغسطس',
			'September' => 'سبتمبر',
			'October'   => 'اكتوبر',
			'November'  => 'نوفمبر',
			'December'  => 'ديسمبر',
		);
	} else {
		$months = array(
			'Jan' => 'يناير',
			'Feb' => 'فبراير',
			'Mar' => 'مارس',
			'Apr' => 'أبريل',
			'May' => 'مايو',
			'Jun' => 'يونيو',
			'Jul' => 'يوليو',
			'Aug' => 'أغسطس',
			'Sep' => 'سبتمبر',
			'Oct' => 'اكتوبر',
			'Nov' => 'نوفمبر',
			'Dec' => 'ديسمبر',
		);
	}

	return  $months[ "$month" ];
}
