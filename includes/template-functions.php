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
	$current_item_index = 1;
	$chartjs            = [];
	foreach ( $performance as $performance_item ) {
		$chartjs['labels'][] = substr( $performance_item->month, 0, 3 );
		$chartjs['data'][]   = $performance_item->value;
	}
	?>
	<div class="performance_main" id="performance-2">
		<div class="performance_head_area">
			<div class="perfor_head_inner exp_perfor_head">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/performance.png" alt="">
				<h4 class="performance_txt"><?php _e( 'الاداء', 'stratusx-child' ); ?></h4>
			</div>
			<div class="risk_info_icon exp_risk_info">
				<a tabindex="0" role="button" data-toggle="tooltip" title="<?php _e( 'ستجد هنا نمو المحفظة حسب الشهر ، اختر السنة المطلوبة لمراجعة الأداء.', 'stratusx-child' ); ?>">
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
			<div class="totle_see_m">
				<h4 class="tot_txt"><?php printf( __( 'المجموع: %s', 'stratusx-child' ), $total_performance ); ?>%</h4>
				<a href="#"><?php _e( 'مشاهدة المزيد ', 'stratusx-child' ); ?></a>
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
	<h4 class="tot_txt per_month">6 الشهور</h4>
	<div class="monthly_per exp_monthly">
		<h4 class="per_mon">العائد من فترة الاحتفاظ بالاسهم</h4>
		<h4 class="per_num">+<?php echo $graph_performance->HPR; ?>%</h4>
	</div>
	<div class="monthly_per exp_monthly">
		<h4 class="per_mon">الانحراف المعياري </h4>
		<h4 class="per_num">+<?php echo $graph_performance->SD; ?>%</h4>
	</div>
	<div class="monthly_per exp_monthly">
		<h4 class="per_mon">معامل شارب </h4>
		<h4 class="per_num">+<?php echo $graph_performance->SR; ?></h4>
	</div>
	<?php
	return ob_get_clean();
}
