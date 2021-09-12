<?php
//wp_set_password('admin', 3 );
include( get_stylesheet_directory() . '/includes/core-functions.php' );
include( get_stylesheet_directory() . '/includes/ajax-hooks.php' );
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
		wp_enqueue_script( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'chart-bundle', 'https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'chart', get_stylesheet_directory_uri() . '/js/chart.js/Chart.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'translate', get_stylesheet_directory_uri() . '/js/translate.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'main', get_stylesheet_directory_uri() . '/js/main.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'stratusx-child', get_stylesheet_directory_uri() . '/js/custom.js', array( 'jquery', 'bootstrap' ), '', true );

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

	$current_year = date( 'Y' );
	$portfolio_id = '';

	if ( 'expert' === $user_type ) {
		$portfolio_id = get_post_meta( $product_id, 'expert_analyst_details_portfolio-id', true );
		// API userInformation
		$user_information = json_decode( stratusx_child_get_get_user_information( $portfolio_id, $current_year ) );
		$user_information = $user_information->data[0];

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
								<p class="exp_profit">Profit of Last Month: <spna class="exp_per"><?php echo $other_profile->profileProfit; ?>%</spna>
								</p>
								<div class="exp_part_btn">
									<a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="exp_partici_btn">Participation</a>
								</div>

								<div class="user_about_section">
									<h3 class="usr_ab_name"><?php printf( __( 'About %s', 'stratusx-child' ), $other_profile->userName ); ?></h3>
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

	<?php if ( 'expert' === $user_type ) : ?>
		<div id="home">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-3">
						<div class="user_p_heading">
							<!-- <h4>Timeline</h4> -->
						</div>

						<div class="exp-add_info">
							<h4><?php _e( 'Additional Info', 'stratusx-child' ); ?></h4>
							<a tabindex="0" role="button" data-toggle="tooltip" title="<?php _e( 'Statistics of the last 12 months', 'stratusx-child' ); ?>">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/info-white-e.png" alt="info">
							</a>
						</div>
						<div class="addition_info_area exp_additon_info">

							<div class="trades_monthly exp_trades_monthly">
								<div class="add_cale">
									<a href="#">
										<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/calendar-e.png" alt="calendar">
									</a>
									<a tabindex="0" role="button" data-toggle="tooltip" title="<?php _e( 'Number of yearly transactions', 'stratusx-child' ); ?>">
										<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/Path-1292.png" alt="info">
									</a>
								</div>
								<div class="a_trades-inner">
									<div class="a_week_trades">
										<h5 class="week_num"><?php echo $user_information->totalTradePerWeek; ?></h5>
										<h5 class="week_txt">Weekly trades</h5>
									</div>
									<div class="a_week_trades">
										<h5 class="week_num"><?php echo $user_information->totalTradePerMonth; ?></h5>
										<h5 class="week_txt">Monthly trades</h5>
									</div>
									<div class="a_week_trades">
										<h5 class="week_num"><?php echo $user_information->totalTradePerYear; ?></h5>
										<h5 class="week_txt">Yearly trades</h5>
									</div>
								</div>
							</div>
							<div class="trades_monthly exp_trades_monthly1">
								<div class="add_cale">
									<a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/bar-e.png" alt="calendar"></a>
									<a tabindex="0" role="button" data-toggle="tooltip" title="<?php _e( 'Average Holding Time', 'stratusx-child' ); ?>">
										<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/info-orange-e.png" alt="info">
									</a>
								</div>
								<div class="tra_days">
									<h4 class="days"><?php echo $user_information->avgHoldingTime; ?> Day</h4>
									<h5 class="avg_time">Average Holding Time</h5>
								</div>
							</div>
							<div class="trades_monthly exp_trades_monthly2">
								<div class="add_cale">
									<a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/user-e.png" alt="calendar"></a>
									<a tabindex="0" role="button" data-toggle="tooltip" title="<?php _e( 'Joining Date', 'stratusx-child' ); ?>">
										<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/info-green-e.png" alt="info">
									</a>
								</div>
								<div class="tra_days">
									<h4 class="days"><?php echo date( 'd-m-y', strtotime( $user_information->joiningDate ) ); ?></h4>
									<h5 class="avg_time"><?php _e( 'Active Since', 'stratusx-child' ); ?></h5>
								</div>
							</div>
							<div class="trades_monthly exp_trades_monthly3">
								<div class="add_cale">
									<a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/bar-purple-e.png" alt="calendar"></a>
									<a tabindex="0" role="button" data-toggle="tooltip" title="<?php _e( 'Highest loss or lowest profit for the last month', 'stratusx-child' ); ?>">
										<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/info-e.png" alt="info">
									</a>
								</div>
								<div class="max_profit">
									<div class="tra_days">
										<h4 class="days"><?php echo $user_information->maxProfitTrade; ?></h4>
										<h5 class="avg_time">Max Profit Trade</h5>
									</div>
									<div class="tra_days">
										<h4 class="days"><?php echo $user_information->maxLossTrade; ?></h4>
										<h5 class="avg_time">Min Profit Trade</h5>
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
									__( 'Cash Percentage', 'stratus-child' ),
									__( 'Loan Percentage', 'stratus-child' ),
									__( 'Stock Percentage', 'stratus-child' ),
								],
								'data'   => [
									$user_information->cashPercenage,
									$user_information->loanPercenage,
									$user_information->stockPercenage,
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
									<h4 class="profit_txt"><?php _e( 'Profit Score', 'stratus-child' ); ?></h4>
								</div>
							</div>

							<div class="porfit_inner">
								<div class="pro_score daily_score exp_daily_score">
									<span class="score_percent"><?php echo $user_information->profitScore[0]->dailyScore; ?>%</span>
									<h4 class="score_txt"><?php _e( 'Daily', 'stratus-child' ); ?></h4>
								</div>
								<div class="pro_score exp_pro_score">
									<span class="score_percent"><?php echo $user_information->profitScore[0]->monthlyScore; ?>%</span>
									<h4 class="score_txt"><?php _e( 'Monthly', 'stratus-child' ); ?></h4>
								</div>
								<div class="pro_score exp_pro_score">
									<span class="score_percent"><?php echo $user_information->profitScore[0]->yearlyScore; ?>%</span>
									<h4 class="score_txt"><?php _e( 'Yearly', 'stratus-child' ); ?></h4>
								</div>
							</div>
						</div>
						<?php stratus_child_get_performance( $user_information->performance, $user_information->totalPerformance, $graph_performance, $portfolio_id, $list_years ); ?>
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
						<div class="user_p_heading">
							<h4>Performance</h4>
						</div>
						<div class="user_performance_main exp_performance_main" id="performance-1">
							<div class="user_totle_month usr_holding exp_totle_m">
								<div class="tot_perc">
									<?php echo stratusx_child_get_graph_performance_widget( $graph_performance ); ?>
								</div>
							</div>
							<div class="g_yearly">
								<span class="g_loading" style="display:none;">Loading..</span>
								<select class="g_year_drp" data-portfolio-id="<?php echo esc_attr( $portfolio_id ); ?>">
									<?php foreach ( $list_years as $year ) : ?>
										<option value="<?php echo $year; ?>"<?php echo ( intval( $year ) === intval( date( 'Y' ) ) ? ' selected' : '' ); ?>><?php echo $year; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="cashout_chart">
								<canvas id="CashChart" width="200" height="250" data-chartjs="<?php echo esc_attr( json_encode( $chartjs ) ); ?>"></canvas>
							</div>
						</div>
						<?php
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
