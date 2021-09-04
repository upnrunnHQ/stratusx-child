<?php
include( get_stylesheet_directory() . '/includes/template-functions.php' );
include( get_stylesheet_directory() . '/includes/class-stratusx-child.php' );

add_action( 'wp_enqueue_scripts', 'enqueue_child_theme_style', 9999 );
add_action( 'wp_enqueue_scripts', 'expert_profile_js_css' );
add_filter( 'wf_pklist_alter_tax_inclusive_text', 'wf_pklist_remove_tax_text', 10, 3 );
add_action( 'wp_head', 'stratusx_child_remove_actions' );
add_action( 'woocommerce_after_shop_loop_item', 'stratusx_child_expert_details_button', 5 );
add_action( 'pre_get_posts', 'stratusx_child_product_query' );
add_filter( 'woocommerce_shortcode_products_query', 'stratusx_child_shortcode_products_query' );

if ( SITECOOKIEPATH != COOKIEPATH ) {
	setcookie( TEST_COOKIE, 'WP Cookie check', 0, SITECOOKIEPATH, COOKIE_DOMAIN );
}

function enqueue_child_theme_style() {
	wp_enqueue_style(
		'dtbwp_css_child',
		get_stylesheet_directory_uri() . '/style.css',
		array(
			'dtbwp_style',
		),
		1.0
	);
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

/**
 * Never worry about cache again!
 */
function expert_profile_js_css() {
	if ( is_product() || is_page_template( 'expert-details.php' ) ) {
		wp_enqueue_script( 'popper', get_stylesheet_directory_uri() . '/js/popper.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'bootstrap', get_stylesheet_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'chart-bundle', 'https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'chart', get_stylesheet_directory_uri() . '/js/chart.js/Chart.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'translate', get_stylesheet_directory_uri() . '/js/translate.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'main', get_stylesheet_directory_uri() . '/js/main.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'custom', get_stylesheet_directory_uri() . '/js/custom.js', array( 'jquery' ), '', true );

		wp_register_style( 'bootstrap', get_stylesheet_directory_uri() . '/css/bootstrap.min.css', false );
		wp_register_style( 'chart', get_stylesheet_directory_uri() . '/css/Chart.css', false );
		wp_register_style( 'font-awesome', get_stylesheet_directory_uri() . '/css/font-awesome.min.css', false );
		wp_register_style( 'gstatic', get_stylesheet_directory_uri() . 'https://fonts.gstatic.com', false );
		wp_register_style( 'googleapis', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap', false );
		wp_register_style( 'responsive', get_stylesheet_directory_uri() . '/css/responsive.css', false );
		wp_register_style( 'custom', get_stylesheet_directory_uri() . '/css/custom.css', false );

		// wp_enqueue_style( 'bootstrap' );
		wp_enqueue_style( 'chart' );
		wp_enqueue_style( 'font-awesome' );
		wp_enqueue_style( 'gstatic' );
		wp_enqueue_style( 'googleapis' );
		wp_enqueue_style( 'responsive' );
		wp_enqueue_style( 'custom' );
	}
}

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

	$portfolio_id = '';
	if ( 'expert' === $user_type ) {
		$portfolio_id = get_post_meta( $product_id, 'expert_analyst_details_portfolio-id', true );
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
	$arrData          = json_decode( stratusx_child_get_get_other_profile( $portfolio_id ) );
	$data             = $arrData->data;
	// print_r($data);
	?>
	<div class="anly_profile_main exp_pro_main">
		<div class="container-fluid">
			<?php
			if ( 'expert' === $user_type ) :
				?>
				<div class="anly_right_content exp_p_detail">
					<div class="anly_profile_img_main">
						<img src="<?php echo esc_url( $featured_img_url ); ?>" alt="" class="img-fluid anly_pro_pic">
					</div>
					<div class="anly_profile_content">
						<div class="anly_person_details">
							<div class="per_details">
								<h1 class="a_per_nm"><?php echo $data[0]->userName; ?></h1>
								<span class="a_per_id"><?php echo $data[0]->emailAddress; ?></span>
								<p class="exp_profit">Profit of Last Month: <spna class="exp_per"><?php echo $data[0]->profileProfit; ?>%</spna>
								</p>
								<div class="exp_part_btn">
									<a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="exp_partici_btn">Participation</a>
								</div>
							</div>

						</div>
					</div>
				</div>
				<?php
			else :
				$twitter_link  = isset( $analyst_details['data']['twitter_link'] ) ? $analyst_details['data']['twitter_link'] : '';
				$linkedin_link = isset( $analyst_details['data']['linkedin_link'] ) ? $analyst_details['data']['linkedin_link'] : '';
				$youtube_link  = isset( $analyst_details['data']['youtube_link'] ) ? $analyst_details['data']['youtube_link'] : '';
				$telegram_link = isset( $analyst_details['data']['telegram_link'] ) ? $analyst_details['data']['telegram_link'] : '';
				//print_r($analyst_details['data']['analyst']);
				?>
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
								<h3 class="usr_ab_type">Analyst Type: <?php analyst_expert_user_type( $user_type ); ?></h3>
							</div>
							<div class="anyl_participate">
								<a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="anly_partici_btn">Participation</a>
							</div>
						</div>
						<div class="prof_details_name">
							<div class="prof_nm_cont">
								<spna class="p_full_nm">Full Name</spna>
								<h3 class="full_name"><?php echo $analyst_details['data']['analyst']['name']; ?></h3>
							</div>
							<div class="prof_dt_cont">
								<spna class="p_full_nm">Join Date</spna>
								<?php
								$date      = date_create( $analyst_details['data']['created_at'] );
								$date_join = date_format( $date, 'd-m-Y' );
								?>
								<h3 class="full_name"><?php echo $date_join; ?></h3>
							</div>
						</div>
						<div class="user_about_section">
							<h3 class="usr_ab_name">About <?php echo $analyst_details['data']['analyst']['name']; ?></h3>
							<p class="usr_ab_content"><?php echo $analyst_details['data']['bio']; ?></p>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
	<!--  -->

	<?php
	if ( 'expert' === $user_type ) {
		if ( empty( $portfolio_id ) ) {
			return;
		}

		// API userInformation
		$arrData2 = json_decode( stratusx_child_get_get_user_information( $portfolio_id ) );
		$data2    = $arrData2->data;
		//API 3 graphInformation
		$arrdata3 = json_decode( stratusx_child_get_get_graph_performance( $portfolio_id ) );
		$data3    = $arrdata3->data;
		// print_r( $data2 );
		// print_r($data3);
		?>
		<!--  -->
		<div id="home">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-3">
						<div class="user_p_heading">
							<!-- <h4>Timeline</h4> -->
						</div>

						<div class="exp-add_info">
							<h4>Additional Info</h4>
							<a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/info-white-e.png" alt="info"></a>
						</div>
						<div class="addition_info_area exp_additon_info">

							<div class="trades_monthly exp_trades_monthly">
								<div class="add_cale">
									<a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/calendar-e.png" alt="calendar"></a>
									<a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/Path-1292.png" alt="info"></a>
								</div>
								<div class="a_trades-inner">
									<div class="a_week_trades">
										<h5 class="week_num"><?php echo $data2[0]->totalTradePerWeek; ?></h5>
										<h5 class="week_txt">Weekly trades</h5>
									</div>
									<div class="a_week_trades">
										<h5 class="week_num"><?php echo $data2[0]->totalTradePerMonth; ?></h5>
										<h5 class="week_txt">Monthly trades</h5>
									</div>
									<div class="a_week_trades">
										<h5 class="week_num"><?php echo $data2[0]->totalTradePerYear; ?></h5>
										<h5 class="week_txt">Yearly trades</h5>
									</div>
								</div>
							</div>
							<div class="trades_monthly exp_trades_monthly1">
								<div class="add_cale">
									<a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/bar-e.png" alt="calendar"></a>
									<a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/info-orange-e.png" alt="info"></a>
								</div>
								<div class="tra_days">
									<h4 class="days"><?php echo $data2[0]->avgHoldingTime; ?> Day</h4>
									<h5 class="avg_time">Average Holding Time</h5>
								</div>
							</div>
							<div class="trades_monthly exp_trades_monthly2">
								<div class="add_cale">
									<a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/user-e.png" alt="calendar"></a>
									<a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/info-green-e.png" alt="info"></a>
								</div>
								<div class="tra_days">
									<h4 class="days"><?php echo date( 'd-m-y', strtotime( $data2[0]->joiningDate ) ); ?></h4>
									<h5 class="avg_time">Active Since</h5>
								</div>
							</div>
							<div class="trades_monthly exp_trades_monthly3">
								<div class="add_cale">
									<a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/bar-purple-e.png" alt="calendar"></a>
									<a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/info-e.png" alt="info"></a>
								</div>
								<div class="max_profit">
									<div class="tra_days">
										<h4 class="days"><?php echo $data2[0]->maxProfitTrade; ?></h4>
										<h5 class="avg_time">Max Profit Trade</h5>
									</div>
									<div class="tra_days">
										<h4 class="days"><?php echo $data2[0]->maxLossTrade; ?></h4>
										<h5 class="avg_time">Min Profit Trade</h5>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="user_p_heading">
							<h4>Indication</h4>
						</div>
						<div class="exp_lone_area">
							<a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dollar-e.png" alt="doller" class="img-fluid"></a>
							<div class="exp_lone_inner">
								<div class="percentage_chart_main">
									<canvas id="percentChart" width="250" height="300"></canvas>
								</div>
								<div class="exp_cash_area">
									<div class="exp_percent">
										<h4>Cash Percentage</h4>
										<h3><?php echo $data2[0]->cashPercenage; ?>%</h3>
									</div>
									<div class="exp_percent exp_ln">
										<h4>Loan Percentage</h4>
										<h3><?php echo $data2[0]->loanPercenage; ?>%</h3>
									</div>
									<div class="exp_percent exp_stc">
										<h4>Stock Percentage</h4>
										<h3><?php echo $data2[0]->stockPercenage; ?>%</h3>
									</div>
									<div class="exp_percent exp_fnd">
										<h4>Fund Percentage</h4>
										<h3><?php echo $data2[0]->fundPercenage; ?>%</h3>
									</div>

								</div>
							</div>
						</div>
						<div class="risk_ind_main">
							<div class="risk_head_area">
								<div class="ri_head_inner">
									<span class="risk_num">-1.21</span>
									<span class="risk_txt">Risk indicator for the last 12 months</span>
								</div>
								<div class="risk_info_icon exp_r_info">
									<a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/info-black-e.png" alt="info"></a>
									<div class="g_yearly">
										<select class="g_year_drp" id="">
											<option value="">2021</option>
											<option value="">2022</option>
											<option value="">2023</option>
											<option value="">2024</option>
											<option value="">2025</option>
										</select>
									</div>
								</div>
							</div>
							<div class="risk_indicator_chart">
								<canvas id="lastmonthChart"></canvas>
							</div>
						</div>
						<div class="profit_score_main">
							<div class="profit_score_head">
								<div class="profit_icon">
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/profit-score.png" alt="">
									<h4 class="profit_txt"> Profit Score</h4>
								</div>
								<div class="g_yearly">
									<select class="g_year_drp" id="">
										<option value="">2021</option>
										<option value="">2022</option>
										<option value="">2023</option>
										<option value="">2024</option>
										<option value="">2025</option>
									</select>
								</div>
							</div>

							<div class="porfit_inner">
								<div class="pro_score daily_score exp_daily_score">
									<span class="score_percent"><?php echo $data2[0]->profitScore[0]->dailyScore; ?>%</span>
									<h4 class="score_txt">Daily</h4>
								</div>
								<div class="pro_score exp_pro_score">
									<span class="score_percent"><?php echo $data2[0]->profitScore[0]->monthlyScore; ?>%</span>
									<h4 class="score_txt">Monthly</h4>
								</div>
								<div class="pro_score exp_pro_score">
									<span class="score_percent"><?php echo $data2[0]->profitScore[0]->yearlyScore; ?>%</span>
									<h4 class="score_txt">Yearly</h4>
								</div>
							</div>
						</div>
						<div class="performance_main">
							<div class="performance_head_area">
								<div class="perfor_head_inner exp_perfor_head">
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/performance.png" alt="">
									<h4 class="performance_txt">Performance</h4>
								</div>
								<div class="risk_info_icon exp_risk_info">
									<a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/info.png" alt="info"></a>
									<div class="g_yearly">
										<select class="g_year_drp" id="">
											<option value="">2021</option>
											<option value="">2022</option>
											<option value="">2023</option>
											<option value="">2024</option>
											<option value="">2025</option>
										</select>
									</div>
								</div>
							</div>
							<h4 class="exp_total_per">Total performance cross the year.</h4>
							<div class="performance_chart">
								<canvas id="performancelineChart"></canvas>
							</div>
							<div class="user_totle_month exp_usr_mont">
								<div class="totle_see_m">
									<h4 class="tot_txt">Total: 25%</h4>
									<a href="#">See More</a>
								</div>
								<div class="tot_perc">
									<div class="monthly_per">
										<h4 class="per_mon">July</h4>
										<h4 class="per_num">+30.70%</h4>
									</div>
									<div class="monthly_per">
										<h4 class="per_mon">June</h4>
										<h4 class="per_num">+10.77%</h4>
									</div>
									<div class="monthly_per">
										<h4 class="per_mon">May</h4>
										<h4 class="per_num">+3.261</h4>
									</div>
								</div>
							</div>
						</div>
						<div class="trading_main_area exp-trading">
							<div class="trading_head">
								<div class="exp_trading_icon">
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/trading.png" alt="">
									<h4 class="trading_txt">Trading</h4>
								</div>
								<a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/info.png" alt="info"></a>
							</div>
							<div class="trading_totle">
								<div class="total_trading">
									<div class="tot_inner">
										<span class="to_num"><?php echo $data2[0]->totalTrade; ?></span>
										<p class="t_trade_txt">Total Trades</p>
									</div>
									<div class="tot_inner">
										<span class="to_num c_num_r">-0.06%</span>
										<p class="t_trade_txt">Avg. Profit</p>
									</div>
									<div class="tot_inner">
										<span class="to_num c_num_g">+15.67%</span>
										<p class="t_trade_txt">Avg. Loss</p>
									</div>
								</div>
								<div class="trading_filter">
									<a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/fliter.png" alt="filter"></a>
								</div>
							</div>

						</div>
						<div class="exp-trading-inner">
							<div class="trading_mains">
								<div class="tra_box exp_tra-box">
									<spna class="t_bx_num">5</spna>
									<p class="t_bx_txt">The longest trades</p>
								</div>
								<div class="tra_box exp_tra-box">
									<spna class="t_bx_num">3</spna>
									<p class="t_bx_txt">The shortest trades</p>
								</div>
							</div>
							<div class="trading_mains">
								<div class="tra_box c_bor_cgr exp_gr-bg">
									<spna class="t_bx_num c_num_g">30,000</spna>
									<p class="t_bx_txt c_num_g">Avg. of all profit</p>
								</div>
								<div class="tra_box exp_gr-bg">
									<spna class="t_bx_num c_num_g">12,000</spna>
									<p class="t_bx_txt c_num_g">Avg. of all loss</p>
								</div>
								<div class="tra_box exp_bg_rd">
									<spna class="t_bx_num c_num_r">5</spna>
									<p class="t_bx_txt c_num_r">Profitable trades</p>
								</div>
								<div class="tra_box c_bor_cred exp_bg_rd">
									<spna class="t_bx_num c_num_r">3</spna>
									<p class="t_bx_txt c_num_r">losing trades</p>
								</div>
								<div class="tra_box c_bor_cgr exp_gr-bg">
									<spna class="t_bx_num c_num_g">50%</spna>
									<p class="t_bx_txt c_num_g">Rate of profitable trades</p>
								</div>
								<div class="tra_box c_bor_cred exp_gr-bg">
									<spna class="t_bx_num c_num_g">30%</spna>
									<p class="t_bx_txt c_num_g">Rate of losing trades</p>
								</div>
								<div class="tra_box c_bor_cgr exp_bg_rd">
									<spna class="t_bx_num c_num_r">50%</spna>
									<p class="t_bx_txt c_num_r">Highest profit on deals</p>
								</div>
								<div class="tra_box c_bor_cred exp_bg_rd">
									<spna class="t_bx_num c_num_r">30%</spna>
									<p class="t_bx_txt c_num_r">Highest loss on deals</p>
								</div>
								<div class="tra_box c_bor_cred exp_gr-bg">
									<spna class="t_bx_num c_num_g ">5.80%</spna>
									<p class="t_bx_txt c_num_g">Avg profit/loss</p>
								</div>
								<div class="tra_box c_bor_cgr exp_gr-bg">
									<spna class="t_bx_num c_num_g">50%</spna>
									<p class="t_bx_txt c_num_g">Total profit</p>
								</div>
								<div class="tra_box c_bor_cred exp_bg_rd">
									<spna class="t_bx_num c_num_r">30%</spna>
									<p class="t_bx_txt c_num_r">Total loss</p>
								</div>
								<div class="tra_box c_bor_cgr exp_bg_rd">
									<spna class="t_bx_num c_num_r">120,900,00</spna>
									<p class="t_bx_txt c_num_r">Net profit/loss</p>
								</div>
							</div>
							<div class="material_progress_main exp-material-main">
								<div class="material_head">
									<a href="#" class="material_see">See More</a>
								</div>
								<div class="exp_progress_main">
									<p class="exp_material">Materials</p>
									<div class="progress">
										<div class="progress-bar-blue" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width:45%">
										</div>
										<span class="pro_percent">45%</span>
									</div>
								</div>
								<div class="exp_progress_main">
									<p class="exp_material">Transpotation</p>
									<div class="progress">
										<div class="progress-bar-red" role="progressbar" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100" style="width:15%">
										</div>
										<span class="pro_percent">15%</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="user_p_heading">
							<h4>Performance</h4>
						</div>
						<div class="user_performance_main exp_performance_main">
							<div class="user_totle_month usr_holding exp_totle_m">
								<div class="tot_perc">
									<h4 class="tot_txt per_month">6 Months</h4>
									<div class="monthly_per exp_monthly">
										<h4 class="per_mon">Holding Period Return</h4>
										<h4 class="per_num">+<?php echo $data3[0]->HPR; ?>%</h4>
									</div>
									<div class="monthly_per exp_monthly">
										<h4 class="per_mon">Standard Deviation</h4>
										<h4 class="per_num">+<?php echo $data3[0]->SD; ?>%</h4>
									</div>
									<div class="monthly_per exp_monthly">
										<h4 class="per_mon">Sharp Ratio</h4>
										<h4 class="per_num">+<?php echo $data3[0]->SR; ?></h4>
									</div>
								</div>
							</div>
							<div class="g_yearly">
								<select class="g_year_drp" id="">
									<option value="">2021</option>
									<option value="">2022</option>
									<option value="">2023</option>
									<option value="">2024</option>
									<option value="">2025</option>
								</select>
							</div>
							<div class="cashout_chart">
								<canvas id="CashChart" width="200" height="250"></canvas>
							</div>
						</div>
						<?php stratus_child_get_repeated_trades( $data2[0]->repeatedTrade ); ?>
					</div>
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
	}
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
function stratusx_child_expert_details_button() {
	global $product;

	printf(
		'<a href="%s" class="%s">%s</a>',
		get_the_permalink(),
		'button',
		__( 'View Details', 'stratusx-child' )
	);
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

function stratusx_child_get_get_user_information( $portfolio_id ) {
	try {
		$transient_id     = "stratusx_child_get_user_information_{$portfolio_id}";
		$user_information = get_transient( $transient_id );
		if ( $user_information ) {
			return $user_information;
		}

		$token    = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvYXBwc2ludm9kZXZsb3BtZW50LmNvbVwvZGF3dWwtbmV3LWJhY2tlbmRcL2FwaVwvbG9naW4iLCJpYXQiOjE2MjkzNjgxMTgsIm5iZiI6MTYyOTM2ODExOCwianRpIjoiQUxGaFpRc0xBemlZOWRFbiIsInN1YiI6MTc3NSwicHJ2IjoiODdlMGFmMWVmOWZkMTU4MTJmZGVjOTcxNTNhMTRlMGIwNDc1NDZhYSJ9.WdoSYu0AkDPF0R6vJ_6X8be39UNzAMkxC2wEXJ_JodA';
		$url2     = 'https://appsinvodevlopment.com/dawul-new-backend/api/userInformation';
		$fields   = array(
			'Portfolio_ID' => $portfolio_id,
			'token'        => $token,
			'is_web'       => 1,
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

function stratusx_child_get_get_graph_performance( $portfolio_id ) {
	try {
		$transient_id      = "stratusx_child_get_graph_performance_{$portfolio_id}";
		$graph_performance = get_transient( $transient_id );
		if ( $graph_performance ) {
			return $graph_performance;
		}

		$token     = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvYXBwc2ludm9kZXZsb3BtZW50LmNvbVwvZGF3dWwtbmV3LWJhY2tlbmRcL2FwaVwvbG9naW4iLCJpYXQiOjE2MjkzNjgxMTgsIm5iZiI6MTYyOTM2ODExOCwianRpIjoiQUxGaFpRc0xBemlZOWRFbiIsInN1YiI6MTc3NSwicHJ2IjoiODdlMGFmMWVmOWZkMTU4MTJmZGVjOTcxNTNhMTRlMGIwNDc1NDZhYSJ9.WdoSYu0AkDPF0R6vJ_6X8be39UNzAMkxC2wEXJ_JodA';
		$fields    = array(
			'Portfolio_ID' => $portfolio_id,
			'token'        => $token,
			'is_web'       => 1,
			'filterYear'   => 2021,
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
