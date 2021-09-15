<?php
/**
 * @var array $args
 */

$response = $args['response'];
?>

<div class="total_trading">
	<div class="tot_inner">
		<span class="to_num trading-dynamic-value totalTrade"><?php echo esc_html( $response->totalTrade ); ?></span>
		<p class="t_trade_txt"><?php _e( 'Total Trades', 'stratusx-child' ); ?></p>
	</div>
	<div class="tot_inner">
		<span class="to_num c_num_r trading-dynamic-value winingTrade"><?php echo esc_html( $response->winingTrade ); ?>%</span>
		<p class="t_trade_txt"><?php _e( 'Avg. Profit', 'stratusx-child' ); ?></p>
	</div>
	<div class="tot_inner">
		<span class="to_num c_num_g trading-dynamic-value losingTrade"><?php echo esc_html( $response->losingTrade ); ?>%</span>
		<p class="t_trade_txt"><?php _e( 'Avg. Loss', 'stratusx-child' ); ?></p>
	</div>
</div>
