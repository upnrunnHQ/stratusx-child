<div class="user_p_heading">
	<h4>Performance</h4>
</div>
<div class="user_performance_main exp_performance_main" id="performance-1">
	<div class="user_totle_month usr_holding exp_totle_m">
		<div class="tot_perc">
			<?php echo stratusx_child_get_graph_performance_widget( $args['$graph_performance'] ); ?>
		</div>
	</div>
	<div class="g_yearly">
		<span class="g_loading" style="display:none;">Loading..</span>
		<select class="g_year_drp" data-portfolio-id="<?php echo esc_attr( $args['$portfolio_id'] ); ?>">
			<?php foreach ( $args['list_years'] as $year ) : ?>
				<option value="<?php echo $year; ?>"<?php echo ( intval( $year ) === intval( date( 'Y' ) ) ? ' selected' : '' ); ?>><?php echo $year; ?></option>
			<?php endforeach; ?>
		</select>
	</div>
	<div class="cashout_chart">
		<canvas id="CashChart" width="200" height="250" data-chartjs="<?php echo esc_attr( json_encode( $args['chartjs'] ) ); ?>"></canvas>
	</div>
</div>
