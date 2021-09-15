<?php
/**
 * @var array $args
 */

$response = $args['response'];
?>

<div class="trading_mains">
	<div class="tra_box exp_tra-box">
		<span class="t_bx_num trading-dynamic-value longestTrade"><?php echo esc_html( $response->longestTrade ); ?></span>
		<p class="t_bx_txt"><?php _e( 'The longest trades', 'stratusx-child' ); ?></p>
	</div>
	<div class="tra_box exp_tra-box">
		<span class="t_bx_num trading-dynamic-value nearestTrade"><?php echo esc_html( $response->nearestTrade ); ?></span>
		<p class="t_bx_txt"><?php _e( 'The shortest trades', 'stratusx-child' ); ?></p>
	</div>
</div>
<div class="trading_mains">
	<div class="tra_box c_bor_cgr exp_gr-bg">
		<span class="t_bx_num c_num_g trading-dynamic-value profitValue"><?php echo esc_html( $response->profitValue ); ?></span>
		<p class="t_bx_txt c_num_g"><?php _e( 'Avg. of all profit', 'stratusx-child' ); ?></p>
	</div>
	<div class="tra_box exp_gr-bg">
		<span class="t_bx_num c_num_g trading-dynamic-value losingValue"><?php echo esc_html( $response->losingValue ); ?></span>
		<p class="t_bx_txt c_num_g"><?php _e( 'Avg. of all loss', 'stratusx-child' ); ?></p>
	</div>
	<div class="tra_box exp_bg_rd">
		<span class="t_bx_num c_num_r trading-dynamic-value winingTradeCount"><?php echo esc_html( $response->winingTradeCount ); ?></span>
		<p class="t_bx_txt c_num_r"><?php _e( 'Profitable trades', 'stratusx-child' ); ?></p>
	</div>
	<div class="tra_box c_bor_cred exp_bg_rd">
		<span class="t_bx_num c_num_r trading-dynamic-value losingTradeCount"><?php echo esc_html( $response->losingTradeCount ); ?></span>
		<p class="t_bx_txt c_num_r"><?php _e( 'Losing trades', 'stratusx-child' ); ?></p>
	</div>
	<div class="tra_box c_bor_cgr exp_gr-bg">
		<span class="t_bx_num c_num_g trading-dynamic-value avgWiningTrade"><?php echo esc_html( $response->avgWiningTrade ); ?>%</span>
		<p class="t_bx_txt c_num_g"><?php _e( 'Rate of profitable trades', 'stratusx-child' ); ?></p>
	</div>
	<div class="tra_box c_bor_cred exp_gr-bg">
		<span class="t_bx_num c_num_g trading-dynamic-value avgLosingTrade"><?php echo esc_html( $response->avgLosingTrade ); ?>%</span>
		<p class="t_bx_txt c_num_g"><?php _e( 'Rate of losing trades', 'stratusx-child' ); ?></p>
	</div>
	<div class="tra_box c_bor_cgr exp_bg_rd">
		<span class="t_bx_num c_num_r trading-dynamic-value maxWiningTrade"><?php echo esc_html( $response->maxWiningTrade ); ?>%</span>
		<p class="t_bx_txt c_num_r"><?php _e( 'Highest profit on deals', 'stratusx-child' ); ?></p>
	</div>
	<div class="tra_box c_bor_cred exp_bg_rd">
		<span class="t_bx_num c_num_r trading-dynamic-value maxLosingTrade"><?php echo esc_html( $response->maxLosingTrade ); ?>%</span>
		<p class="t_bx_txt c_num_r"><?php _e( 'Highest loss on deals', 'stratusx-child' ); ?></p>
	</div>
	<div class="tra_box c_bor_cred exp_gr-bg">
		<span class="t_bx_num c_num_g trading-dynamic-value avgProfitLoss"><?php echo esc_html( $response->avgProfitLoss ); ?>%</span>
		<p class="t_bx_txt c_num_g"><?php _e( 'Avg profit/loss', 'stratusx-child' ); ?></p>
	</div>
	<div class="tra_box c_bor_cgr exp_gr-bg">
		<span class="t_bx_num c_num_g trading-dynamic-value sumProfitTrade"><?php echo esc_html( $response->sumProfitTrade ); ?>%</span>
		<p class="t_bx_txt c_num_g"><?php _e( 'Total profit', 'stratusx-child' ); ?></p>
	</div>
	<div class="tra_box c_bor_cred exp_bg_rd">
		<span class="t_bx_num c_num_r trading-dynamic-value lossProfitTrade"><?php echo esc_html( $response->lossProfitTrade ); ?>%</span>
		<p class="t_bx_txt c_num_r"><?php _e( 'Total loss', 'stratusx-child' ); ?></p>
	</div>
	<div class="tra_box c_bor_cgr exp_bg_rd">
		<span class="t_bx_num c_num_r trading-dynamic-value netProfitLoss"><?php echo esc_html( $response->netProfitLoss ); ?></span>
		<p class="t_bx_txt c_num_r"><?php _e( 'Net profit/loss', 'stratusx-child' ); ?></p>
	</div>
</div>

<div class="trading-sectors-wrapper">
    <?php
    // This is the container of the sector bar and sectors comes from ajax.
    get_template_part(
        'template-parts/content',
        'trading-sectors',
        array( 'sectors' => $response->tradingSector )
    );
    ?>
</div>
