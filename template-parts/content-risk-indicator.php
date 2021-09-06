<div class="risk_ind_main">
	<div class="risk_head_area">
		<div class="ri_head_inner">
			<span class="risk_num"><?php echo $args['totalRiskRate']; ?></span>
			<span class="risk_txt"><?php _e( 'Risk indicator for the last 12 months', 'stratus-child' ); ?></span>
		</div>
		<div class="risk_info_icon exp_r_info">
			<a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/info-black-e.png" alt="info"></a>
		</div>
	</div>
	<div class="risk_indicator_chart">
		<canvas id="lastmonthChart" data-chartjs="<?php echo esc_attr( json_encode( $args['chartjs'] ) ); ?>"></canvas>
	</div>
</div>
