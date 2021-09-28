<?php
/**
 * @var array $args
 */

$portfolio_id = $args['user_information']->Portfolio_ID;
?>
<div class="trading_main_area exp-trading">
	<?php
	$filter_type = 3;
	// $filter_type = 6;
	$trade_data  = stratusx_child_get_filtered_trade( $portfolio_id, $filter_type );
	$response    = $trade_data->data[0];
	?>
	<div class="trading_head">
		<div class="exp_trading_icon">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/trading.png" alt="">
			<h4 class="trading_txt"><?php _e( 'الصفقات ', 'stratusx-child' ); ?></h4>
		</div>
		<a tabindex="0" role="button" data-toggle="tooltip" title="نظرة عامة على أداء المحفظة للشهر السابق. يمكنك تحديد أيقونة عامل التصفية لاختيار المدة البديلة">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/info.png" alt="info">
		</a>
	</div>
	<div class="trading_totle">
		<?php
		get_template_part(
			'template-parts/content',
			'trading-total',
			[ 'response' => $response ]
		);
		?>
		<div class="trading_filter">
			<span class="g_loading" style="display:none;"><?php esc_html_e( 'تحميل...', 'stratusx-child' ); ?></span>
			<div class="dropdown">
				<button class="btn btn-default dropdown-toggle" type="button" id="tradingFilterToggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/fliter.png" alt="filter">
				</button>
				<ul class="dropdown-menu tradingFilterDropdown" aria-labelledby="tradingFilterToggle" data-portfolio-id="<?php echo esc_attr( $portfolio_id ); ?>">
					<?php foreach ( $args['filters'] as $key => $filter ) : ?>
						<li><button type="button" class="btn<?php echo ( $filter_type === $key ? ' active' : '' ); ?>" data-filter-type="<?php echo esc_attr( $key ); ?>"><?php echo $filter; ?></button></li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</div>
</div>
<div class="exp-trading-inner" id="trading-sectors">
	<?php
	get_template_part(
		'template-parts/content',
		'trading-stats',
		[ 'response' => $response ]
	);
	?>

	<button class="btn btn-primary" style="<?php echo ( count( $response->tradingSector ) ? '' : 'display: none' ); ?>" type="button">
		مشاهدة المزيد
	</button>
</div>
