<?php
// stratusx_child_get_repeated_trades('DRY1037474', 1 )
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
	<div id="repeated-trades">
		<?php
		get_template_part(
			'template-parts/content',
			'repeated-trades-list-items',
			[ 'repeated_trades' => $args['repeated_trades'] ]
		);
		?>
	</div>
</div>
