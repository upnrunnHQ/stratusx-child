<?php
function stratus_child_get_repeated_trades() {
	?>
	<div class="repeate_area">
		<div class="repeat_cont">
			<h4 class="repeat_txt">Repeated Trades</h4>
			<a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/info.png" alt="info"></a>
		</div>
		<div class="repeat_see">
			<a href="#"> See More</a>
		</div>
		<div class="repeat_avg exp_avg">
			<div class="trade_ave">
				<p class="t_tra-txt">5% <span class="exp_trad"> (9 trades)</span></p>
				<h4 class="t_petro">Bahri</h4>
			</div>
			<div class="t_avg_p">
				<div class="avg-pro">
					<p class="ave_txt exp_ave_txt">Avg. Profit</p>
					<h4 class="pro_per exp_pro_per">9%</h4>
				</div>
				<div class="avg-pro">
					<p class="ave_txt exp_ave_txt">Avg. Profit</p>
					<h4 class="pro_per exp_pro_per">1%</h4>
				</div>
			</div>
		</div>
		<div class="repeat_avg exp_avg_avg">
			<div class="trade_ave">
				<p class="t_tra-txt">23% <span class="exp_trad"> (4 trades)</span></p>
				<h4 class="t_petro">Petro Rabigh</h4>
			</div>
			<div class="t_avg_p">
				<div class="avg-pro">
					<p class="ave_txt exp_ave_txt">Avg. Profit</p>
					<h4 class="pro_per exp_pro_per">9%</h4>
				</div>
				<div class="avg-pro">
					<p class="ave_txt exp_ave_txt">Avg. Profit</p>
					<h4 class="pro_per exp_pro_per">1%</h4>
				</div>
			</div>
		</div>
	</div>
	<?php
}
