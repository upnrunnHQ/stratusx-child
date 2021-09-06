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
					<?php foreach ( $args['year_options'] as $year_option ) : ?>
						<option value="<?php echo $year_option; ?>"><?php echo $year_option; ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>
	</div>
	<div class="risk_indicator_chart">
		<canvas id="lastmonthChart"></canvas>
	</div>
</div>
