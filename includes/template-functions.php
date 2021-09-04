<?php
function stratus_child_get_repeated_trades( $repeated_trades ) {
	?>
	<div class="repeate_area">
		<div class="repeat_cont">
			<h4 class="repeat_txt">
				<?php _e( 'Repeated Trades', 'stratusx-child' ); ?>
			</h4>
			<a href="#">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/info.png" alt="info">
			</a>
		</div>
		<div class="repeat_see">
			<a href="#"><?php _e( 'See More', 'stratusx-child' ); ?></a>
		</div>
		<?php foreach ( $repeated_trades as $repeated_trade ) : ?>
			<div class="repeat_avg exp_avg">
				<div class="trade_ave">
					<p class="t_tra-txt">5% <span class="exp_trad">
						<?php printf( __( '(%s trades)', 'stratusx-child' ), $repeated_trade->total ); ?>
					</p>
					<h4 class="t_petro">
						<?php echo $repeated_trade->stock_name; ?>
					</h4>
				</div>
				<div class="t_avg_p">
					<div class="avg-pro">
						<p class="ave_txt exp_ave_txt">
							<?php _e( 'Avg. Profit', 'stratusx-child' ); ?>
						</p>
						<h4 class="pro_per exp_pro_per"><?php echo $repeated_trade->totalAvgProfit; ?>%</h4>
					</div>
					<div class="avg-pro">
						<p class="ave_txt exp_ave_txt">
							<?php _e( 'Avg. Loss', 'stratusx-child' ); ?>
						</p>
						<h4 class="pro_per exp_pro_per"><?php echo $repeated_trade->totalAvgLoss; ?>%</h4>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
	<?php
}

function stratus_child_get_performance( $performance, $total_performance ) {
	?>
	<div class="performance_main">
		<div class="performance_head_area">
			<div class="perfor_head_inner exp_perfor_head">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/performance.png" alt="">
				<h4 class="performance_txt"><?php _e( 'Performance', 'stratusx-child' ); ?></h4>
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
		<h4 class="exp_total_per"><?php _e( 'Total performance cross the year.', 'stratusx-child' ); ?></h4>
		<div class="performance_chart">
			<canvas id="performancelineChart"></canvas>
		</div>
		<div class="user_totle_month exp_usr_mont">
			<div class="totle_see_m">
				<h4 class="tot_txt"><?php printf( __( 'Total: 25%', 'stratusx-child' ), $total_performance ); ?></h4>
				<a href="#"><?php _e( 'See More', 'stratusx-child' ); ?></a>
			</div>
			<div class="tot_perc">
				<?php foreach ( $performance as $performance_item ) : ?>
					<div class="monthly_per">
						<h4 class="per_mon"><?php echo $performance_item->month; ?></h4>
						<h4 class="per_num"><?php echo $performance_item->value; ?>%</h4>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
	<?php
}
