<?php
function stratusx_child_expert_details_button() {
	global $product;

	printf(
		'<a href="%s" class="%s">%s</a>',
		get_the_permalink(),
		'button',
		__( 'View Details', 'stratusx-child' )
	);
}

function stratus_child_get_performance( $performance, $total_performance, $graph_performance, $portfolio_id, $list_years ) {
	$current_item_index = 1;
	$chartjs            = [];
	foreach ( $graph_performance->performance as $performance_item ) {
		$chartjs['labels'][] = $performance_item->month;
		$chartjs['data'][]   = $performance_item->value;
	}
	?>
	<div class="performance_main" id="performance-2">
		<div class="performance_head_area">
			<div class="perfor_head_inner exp_perfor_head">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/performance.png" alt="">
				<h4 class="performance_txt"><?php _e( 'Performance', 'stratusx-child' ); ?></h4>
			</div>
			<div class="risk_info_icon exp_risk_info">
				<a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/info.png" alt="info"></a>
				<div class="g_yearly">
					<span class="g_loading" style="display:none;">Loading..</span>
					<select class="g_year_drp" id="g_performance_drp" data-portfolio-id="<?php echo esc_attr( $portfolio_id ); ?>">
						<?php foreach ( $list_years as $year ) : ?>
							<option value="<?php echo $year; ?>" <?php echo ( intval( $year ) === intval( date( 'Y' ) ) ? ' selected' : '' ); ?>><?php echo $year; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
		</div>
		<h4 class="exp_total_per"><?php _e( 'Total performance cross the year.', 'stratusx-child' ); ?></h4>
		<div class="performance_chart">
			<canvas id="performancelineChart" data-chartjs="<?php echo esc_attr( json_encode( $chartjs ) ); ?>"></canvas>
		</div>
		<div class="user_totle_month exp_usr_mont">
			<div class="totle_see_m">
				<h4 class="tot_txt"><?php printf( __( 'Total: %s', 'stratusx-child' ), $total_performance ); ?>%</h4>
				<a href="#"><?php _e( 'See More', 'stratusx-child' ); ?></a>
			</div>
			<div class="tot_perc">
				<?php foreach ( $performance as $performance_item ) : ?>
					<div class="monthly_per"<?php echo ( $current_item_index <= 3 ? '' : ' style="display: none;"' ); ?>>
						<h4 class="per_mon"><?php echo $performance_item->month; ?></h4>
						<h4 class="per_num"><?php echo $performance_item->value; ?>%</h4>
					</div>
					<?php $current_item_index++; ?>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
	<?php
}

function stratusx_child_get_graph_performance_widget( $graph_performance ) {
	ob_start();
	?>
	<h4 class="tot_txt per_month">6 Months</h4>
	<div class="monthly_per exp_monthly">
		<h4 class="per_mon">Holding Period Return</h4>
		<h4 class="per_num">+<?php echo $graph_performance->HPR; ?>%</h4>
	</div>
	<div class="monthly_per exp_monthly">
		<h4 class="per_mon">Standard Deviation</h4>
		<h4 class="per_num">+<?php echo $graph_performance->SD; ?>%</h4>
	</div>
	<div class="monthly_per exp_monthly">
		<h4 class="per_mon">Sharp Ratio</h4>
		<h4 class="per_num">+<?php echo $graph_performance->SR; ?></h4>
	</div>
	<?php
	return ob_get_clean();
}
