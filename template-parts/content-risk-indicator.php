<div class="risk_ind_main">
	<div class="risk_head_area">
		<div class="ri_head_inner">
			<span class="risk_num"><?php echo $args['totalRiskRate']; ?></span>
			<span class="risk_txt"><?php _e( 'Risk indicator for the last 12 months', 'stratus-child' ); ?></span>
		</div>
		<div class="risk_info_icon exp_r_info">
			<a tabindex="0" role="button" data-trigger="hover focus" data-toggle="tooltip"
				title="
				<p>
					<?php
					_e( 'This number shows the risks of the wallet on a scale of of -5 to +5, where -5 is the highest risk and +5 the lowest risk.', 'stratusx-child' );
					?>
				</p>
				<p>
					<?php
					_e( 'The risk indicator is determined according to a scientific criteria that summarise the account holder behaviour in trading and investment these criteria are:', 'stratusx-child' );
					?>
				</p>
				<p>
					<?php
					_e( '- Distribution of investment on securities: Investment in a single security is considered high risk, while distribution of investments on more than one security reduces the risk.', 'stratusx-child' );
					?>
				</p>
				<p>
					<?php
					_e( '- Distribution of investment on sectors: Investment in one sector is considered high risk, while distribution of investments to more than one sector reduces risk.', 'stratusx-child' );
					?>
				</p>
				<p>
					<?php
					_e( '- Quality of securities: Securities will be divided into three types,Low Risk: Contains all profitable companies. Medium Risk: Contains low-making companies within 12 months. High Risk: Includes companies whose accumulated losses amounted to 20% or more of their capital.', 'stratusx-child' );
					?>
				</p>
				<p>
					<?php
					_e( '- Number of losing trades compared to winning trades.', 'stratusx-child' );
					?>
				</p>
				">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/info-black-e.png" alt="info">
			</a>
		</div>
	</div>
	<div class="risk_indicator_chart">
		<canvas id="lastmonthChart" data-chartjs="<?php echo esc_attr( json_encode( $args['chartjs'] ) ); ?>"></canvas>
	</div>
</div>
