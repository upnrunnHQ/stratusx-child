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

function stratus_child_get_trading( $data ) {
	?>
	<div class="trading_main_area exp-trading">
		<div class="trading_head">
			<div class="exp_trading_icon">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/trading.png" alt="">
				<h4 class="trading_txt">Trading</h4>
			</div>
			<a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/info.png" alt="info"></a>
		</div>
		<div class="trading_totle">
			<div class="total_trading">
				<div class="tot_inner">
					<span class="to_num"><?php echo $data2[0]->totalTrade; ?></span>
					<p class="t_trade_txt">Total Trades</p>
				</div>
				<div class="tot_inner">
					<span class="to_num c_num_r">-0.06%</span>
					<p class="t_trade_txt">Avg. Profit</p>
				</div>
				<div class="tot_inner">
					<span class="to_num c_num_g">+15.67%</span>
					<p class="t_trade_txt">Avg. Loss</p>
				</div>
			</div>
			<div class="trading_filter">
				<a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/fliter.png" alt="filter"></a>
			</div>
		</div>
	</div>
	<div class="exp-trading-inner">
		<div class="trading_mains">
			<div class="tra_box exp_tra-box">
				<spna class="t_bx_num">5</spna>
				<p class="t_bx_txt">The longest trades</p>
			</div>
			<div class="tra_box exp_tra-box">
				<spna class="t_bx_num">3</spna>
				<p class="t_bx_txt">The shortest trades</p>
			</div>
		</div>
		<div class="trading_mains">
			<div class="tra_box c_bor_cgr exp_gr-bg">
				<spna class="t_bx_num c_num_g">30,000</spna>
				<p class="t_bx_txt c_num_g">Avg. of all profit</p>
			</div>
			<div class="tra_box exp_gr-bg">
				<spna class="t_bx_num c_num_g">12,000</spna>
				<p class="t_bx_txt c_num_g">Avg. of all loss</p>
			</div>
			<div class="tra_box exp_bg_rd">
				<spna class="t_bx_num c_num_r">5</spna>
				<p class="t_bx_txt c_num_r">Profitable trades</p>
			</div>
			<div class="tra_box c_bor_cred exp_bg_rd">
				<spna class="t_bx_num c_num_r">3</spna>
				<p class="t_bx_txt c_num_r">losing trades</p>
			</div>
			<div class="tra_box c_bor_cgr exp_gr-bg">
				<spna class="t_bx_num c_num_g">50%</spna>
				<p class="t_bx_txt c_num_g">Rate of profitable trades</p>
			</div>
			<div class="tra_box c_bor_cred exp_gr-bg">
				<spna class="t_bx_num c_num_g">30%</spna>
				<p class="t_bx_txt c_num_g">Rate of losing trades</p>
			</div>
			<div class="tra_box c_bor_cgr exp_bg_rd">
				<spna class="t_bx_num c_num_r">50%</spna>
				<p class="t_bx_txt c_num_r">Highest profit on deals</p>
			</div>
			<div class="tra_box c_bor_cred exp_bg_rd">
				<spna class="t_bx_num c_num_r">30%</spna>
				<p class="t_bx_txt c_num_r">Highest loss on deals</p>
			</div>
			<div class="tra_box c_bor_cred exp_gr-bg">
				<spna class="t_bx_num c_num_g ">5.80%</spna>
				<p class="t_bx_txt c_num_g">Avg profit/loss</p>
			</div>
			<div class="tra_box c_bor_cgr exp_gr-bg">
				<spna class="t_bx_num c_num_g">50%</spna>
				<p class="t_bx_txt c_num_g">Total profit</p>
			</div>
			<div class="tra_box c_bor_cred exp_bg_rd">
				<spna class="t_bx_num c_num_r">30%</spna>
				<p class="t_bx_txt c_num_r">Total loss</p>
			</div>
			<div class="tra_box c_bor_cgr exp_bg_rd">
				<spna class="t_bx_num c_num_r">120,900,00</spna>
				<p class="t_bx_txt c_num_r">Net profit/loss</p>
			</div>
		</div>
		<div class="material_progress_main exp-material-main">
			<div class="material_head">
				<a href="#" class="material_see">See More</a>
			</div>
			<div class="exp_progress_main">
				<p class="exp_material">Materials</p>
				<div class="progress">
					<div class="progress-bar-blue" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width:45%">
					</div>
					<span class="pro_percent">45%</span>
				</div>
			</div>
			<div class="exp_progress_main">
				<p class="exp_material">Transpotation</p>
				<div class="progress">
					<div class="progress-bar-red" role="progressbar" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100" style="width:15%">
					</div>
					<span class="pro_percent">15%</span>
				</div>
			</div>
		</div>
	</div>
	<?php
}
