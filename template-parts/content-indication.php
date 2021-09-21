<div class="user_p_heading">
	<h4><?php _e( 'مؤشرات ', 'stratus-child' ); ?></h4>
</div>
<div class="exp_lone_area">
	<a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dollar-e.png" alt="doller" class="img-fluid"></a>
	<div class="exp_lone_inner">
		<div class="percentage_chart_main">
			<canvas id="percentChart" width="250" height="300" data-chartjs="<?php echo esc_attr( json_encode( $args ) ); ?>"></canvas>
		</div>
		<div class="exp_cash_area">
			<div class="exp_percent">
				<h4><?php echo $args['labels'][0]; ?></h4>
				<h3><?php echo $args['data'][0]; ?>%</h3>
			</div>
			<div class="exp_percent exp_ln">
				<h4><?php echo $args['labels'][1]; ?></h4>
				<h3><?php echo $args['data'][1]; ?>%</h3>
			</div>
			<div class="exp_percent exp_stc">
				<h4><?php echo $args['labels'][2]; ?></h4>
				<h3><?php echo $args['data'][2]; ?>%</h3>
			</div>
		</div>
	</div>
</div>
