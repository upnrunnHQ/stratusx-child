<div class="trading_mains">
	<div class="tra_box exp_tra-box">
		<spna class="t_bx_num"><?php echo $args['user_information']->longestTrade; ?></spna>
		<p class="t_bx_txt"><?php _e( 'The longest trades', 'stratusx-child' ); ?></p>
	</div>
	<div class="tra_box exp_tra-box">
		<spna class="t_bx_num"><?php echo $args['user_information']->nearestTrade; ?></spna>
		<p class="t_bx_txt"><?php _e( 'The shortest trades', 'stratusx-child' ); ?></p>
	</div>
</div>
<div class="trading_mains">
	<div class="tra_box c_bor_cgr exp_gr-bg">
		<spna class="t_bx_num c_num_g"><?php echo $args['user_information']->avgWiningTrade; ?></spna>
		<p class="t_bx_txt c_num_g"><?php _e( 'Avg. of all profit', 'stratusx-child' ); ?></p>
	</div>
	<div class="tra_box exp_gr-bg">
		<spna class="t_bx_num c_num_g"><?php echo $args['user_information']->avgLosingTrade; ?></spna>
		<p class="t_bx_txt c_num_g"><?php _e( 'Avg. of all loss', 'stratusx-child' ); ?></p>
	</div>
	<div class="tra_box exp_bg_rd">
		<spna class="t_bx_num c_num_r"><?php echo $args['user_information']->winingTradeCount; ?></spna>
		<p class="t_bx_txt c_num_r"><?php _e( 'Profitable trades', 'stratusx-child' ); ?></p>
	</div>
	<div class="tra_box c_bor_cred exp_bg_rd">
		<spna class="t_bx_num c_num_r"><?php echo $args['user_information']->losingTradeCount; ?></spna>
		<p class="t_bx_txt c_num_r"><?php _e( 'Losing trades', 'stratusx-child' ); ?></p>
	</div>
	<div class="tra_box c_bor_cgr exp_gr-bg">
		<spna class="t_bx_num c_num_g"><?php echo $args['user_information']->winingTrade; ?>%</spna>
		<p class="t_bx_txt c_num_g"><?php _e( 'Rate of profitable trades', 'stratusx-child' ); ?></p>
	</div>
	<div class="tra_box c_bor_cred exp_gr-bg">
		<spna class="t_bx_num c_num_g"><?php echo $args['user_information']->losingTrade; ?>%</spna>
		<p class="t_bx_txt c_num_g"><?php _e( 'Rate of losing trades', 'stratusx-child' ); ?></p>
	</div>
	<div class="tra_box c_bor_cgr exp_bg_rd">
		<spna class="t_bx_num c_num_r"><?php echo $args['user_information']->maxWiningTrade; ?>%</spna>
		<p class="t_bx_txt c_num_r"><?php _e( 'Highest profit on deals', 'stratusx-child' ); ?></p>
	</div>
	<div class="tra_box c_bor_cred exp_bg_rd">
		<spna class="t_bx_num c_num_r"><?php echo $args['user_information']->maxLosingTrade; ?>%</spna>
		<p class="t_bx_txt c_num_r"><?php _e( 'Highest loss on deals', 'stratusx-child' ); ?></p>
	</div>
	<div class="tra_box c_bor_cred exp_gr-bg">
		<spna class="t_bx_num c_num_g "><?php echo $args['user_information']->avgProfitLoss; ?>%</spna>
		<p class="t_bx_txt c_num_g"><?php _e( 'Avg profit/loss', 'stratusx-child' ); ?></p>
	</div>
	<div class="tra_box c_bor_cgr exp_gr-bg">
		<spna class="t_bx_num c_num_g"><?php echo $args['user_information']->sumProfitTrade; ?>%</spna>
		<p class="t_bx_txt c_num_g"><?php _e( 'Total profit', 'stratusx-child' ); ?></p>
	</div>
	<div class="tra_box c_bor_cred exp_bg_rd">
		<spna class="t_bx_num c_num_r"><?php echo $args['user_information']->lossProfitTrade; ?>%</spna>
		<p class="t_bx_txt c_num_r"><?php _e( 'Total loss', 'stratusx-child' ); ?></p>
	</div>
	<div class="tra_box c_bor_cgr exp_bg_rd">
		<spna class="t_bx_num c_num_r"><?php echo $args['user_information']->netProfitLoss; ?></spna>
		<p class="t_bx_txt c_num_r"><?php _e( 'Net profit/loss', 'stratusx-child' ); ?></p>
	</div>
</div>
