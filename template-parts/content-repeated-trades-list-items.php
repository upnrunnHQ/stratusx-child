<?php foreach ( $args['repeated_trades'] as $repeated_trade ) : ?>
	<div class="repeat_avg exp_avg">
		<div class="trade_ave">
			<p class="t_tra-txt">5% <span class="exp_trad">
				<?php printf( __( '(%s الصفقات )', 'stratusx-child' ), $repeated_trade->total ); ?>
			</p>
			<h4 class="t_petro">
				<?php echo $repeated_trade->stock_name; ?>
			</h4>
		</div>
		<div class="t_avg_p">
			<div class="avg-pro">
				<p class="ave_txt exp_ave_txt">
					<?php _e( 'متوسط نسبة الربح ', 'stratusx-child' ); ?>
				</p>
				<h4 class="pro_per exp_pro_per"><?php echo $repeated_trade->totalAvgProfit; ?>%</h4>
			</div>
			<div class="avg-pro">
				<p class="ave_txt exp_ave_txt">
					<?php _e( 'متوسط نسب الخسارة ', 'stratusx-child' ); ?>
				</p>
				<h4 class="pro_per exp_pro_per"><?php echo $repeated_trade->totalAvgLoss; ?>%</h4>
			</div>
		</div>
	</div>
<?php endforeach; ?>
