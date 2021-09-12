<div class="total_trading">
	<div class="tot_inner">
		<span class="to_num"><?php echo $args['user_information']->totalTrade; ?></span>
		<p class="t_trade_txt"><?php _e( 'Total Trades', 'stratusx-child' ); ?></p>
	</div>
	<div class="tot_inner">
		<span class="to_num c_num_r"><?php echo $args['user_information']->avgWiningTrade; ?>%</span>
		<p class="t_trade_txt"><?php _e( 'Avg. Profit', 'stratusx-child' ); ?></p>
	</div>
	<div class="tot_inner">
		<span class="to_num c_num_g"><?php echo $args['user_information']->avgLosingTrade; ?>%</span>
		<p class="t_trade_txt"><?php _e( 'Avg. Loss', 'stratusx-child' ); ?></p>
	</div>
</div>
