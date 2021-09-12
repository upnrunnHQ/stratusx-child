<div class="trading_main_area exp-trading">
	<div class="trading_head">
		<div class="exp_trading_icon">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/trading.png" alt="">
			<h4 class="trading_txt"><?php _e( 'Trading', 'stratusx-child' ); ?></h4>
		</div>
		<a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/info.png" alt="info"></a>
	</div>
	<div class="trading_totle">
		<?php
		get_template_part(
			'template-parts/content',
			'trading-total',
			[ 'user_information' => $args['user_information'] ]
		);
		?>
		<div class="trading_filter">
			<div class="dropdown">
				<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/fliter.png" alt="filter">
				</button>
				<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
					<?php foreach ( $args['filters'] as $key => $filter ) : ?>
						<li><button type="button" class="btn<?php echo ( 1 === $key + 1 ? ' active' : '' ); ?>" data-filter-type="<?php echo esc_attr( $key + 1 ); ?>"><?php echo $filter; ?></button></li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</div>
</div>
<div class="exp-trading-inner">
	<?php
	get_template_part(
		'template-parts/content',
		'trading-stats',
		[ 'user_information' => $args['user_information'] ]
	);
	?>
</div>
