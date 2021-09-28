<?php
function stratusx_child_expert_details_button() {
	global $product;

	printf(
		'<a href="%s" class="%s">%s</a>',
		get_the_permalink(),
		'button',
		__( 'عرض التفاصيل', 'stratusx-child' )
	);
}

function stratus_child_get_performance( $performance, $total_performance, $portfolio_id, $list_years ) {
	$current_year  = date( 'Y' );
	$current_month = date( 'n' );
	$chartjs       = [];
	$header_class  = intval( $total_performance ) < 0 ? 'totle_see_m negative' : 'totle_see_m';

	foreach ( $performance as $performance_item ) {
		if ( ( intval( $performance_item->year ) === intval( $current_year ) ) && ( intval( $performance_item->m ) > $current_month ) ) {
			continue;
		}

		//$chartjs['labels'][] = substr( $performance_item->month, 0, 3 );
		$chartjs['labels'][] = convert_month_to_arabic( 'full_month', $performance_item->month );
		$chartjs['data'][]   = $performance_item->value;
	}

	$visible_months = stratusx_child_get_visible_months();
	?>
	<div class="performance_main" id="performance-2">
		<div class="performance_head_area">
			<div class="perfor_head_inner exp_perfor_head">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/performance.png" alt="">
				<h4 class="performance_txt"><?php _e( 'الاداء', 'stratusx-child' ); ?></h4>
			</div>
			<div class="risk_info_icon exp_risk_info">
				<a tabindex="0" role="button" data-toggle="tooltip" title="<?php _e( 'هنا تجد نمو المحفظة بحسب الأشهر، يمكنك اختيار السنة المطلوبة لمراجعة الأداء', 'stratusx-child' ); ?>">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/info.png" alt="info">
				</a>
				<div class="g_yearly">
					<span class="g_loading" style="display:none;">تحميل..</span>
					<select class="g_year_drp" id="g_performance_drp" data-portfolio-id="<?php echo esc_attr( $portfolio_id ); ?>">
						<?php foreach ( $list_years as $year ) : ?>
							<option value="<?php echo $year; ?>" <?php echo ( intval( $year ) === intval( date( 'Y' ) ) ? ' selected' : '' ); ?>><?php echo $year; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
		</div>
		<h4 class="exp_total_per"><?php _e( 'مجموع الاداء خلال السنة', 'stratusx-child' ); ?></h4>
		<div class="performance_chart">
			<canvas id="performancelineChart" data-chartjs="<?php echo esc_attr( json_encode( $chartjs ) ); ?>"></canvas>
		</div>
		<div class="user_totle_month exp_usr_mont">
			<div class="user_totle_month__header">
				<div class="<?php echo esc_attr( $header_class ); ?>">
					<h4 class="tot_txt"><?php echo __( 'المجموع: ', 'stratusx-child' ) . $total_performance; ?>%</h4>
				</div>
			</div>
			<div class="tot_perc">
				<?php
				foreach ( $performance as $performance_item ) :
					$num_class = intval( $performance_item->value ) < 0 ? 'per_num c_num_r' : 'per_num';
					?>
					<div class="monthly_per"<?php echo ( in_array( $performance_item->month, $visible_months, true ) ? '' : ' style="display: none;"' ); ?>>
						<h4 class="per_mon"><?php echo convert_month_to_arabic( 'full_month', $performance_item->month ); ?></h4>
						<h4 class="<?php echo esc_attr( $num_class ); ?>"><?php echo $performance_item->value; ?>%</h4>
					</div>
					<?php
				endforeach;
				?>
			</div>
			<button class="btn btn-primary" style="display: block;" type="button"><?php _e( 'مشاهدة المزيد  ', 'stratusx-child' ); ?></button>
		</div>
	</div>
	<?php
}

function stratusx_child_get_graph_performance_widget( $graph_performance ) {
	ob_start();
	?>
	<h4 class="tot_txt per_month">6 الشهور</h4>
	<div class="monthly_per exp_monthly">
		<h4 class="per_mon"> العائد من فترة الاحتفاظ بالاسهم </h4>
		<h4 class="per_num"><?php echo $graph_performance->HPR; ?>%</h4>
	</div>
	<div class="monthly_per exp_monthly">
		<h4 class="per_mon"> الانحراف المعياري </h4>
		<h4 class="per_num"><?php echo $graph_performance->SD; ?>%</h4>
	</div>
	<div class="monthly_per exp_monthly">
		<h4 class="per_mon">معامل شارب </h4>
		<h4 class="per_num"><?php echo $graph_performance->SR; ?></h4>
	</div>
	<?php
	return ob_get_clean();
}
