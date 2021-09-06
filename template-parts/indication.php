<div class="user_p_heading">
	<h4><?php _e( 'Indication', 'stratus-child' ); ?></h4>
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
				<h3><?php echo $args['cashPercenage']; ?>%</h3>
			</div>
			<div class="exp_percent exp_ln">
				<h4>Loan Percentage</h4>
				<h3><?php echo $args['loanPercenage']; ?>%</h3>
			</div>
			<div class="exp_percent exp_stc">
				<h4>Stock Percentage</h4>
				<h3><?php echo $args['stockPercenage']; ?>%</h3>
			</div>
		</div>
	</div>
</div>
