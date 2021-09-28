<?php
// stratusx_child_get_repeated_trades('DRY1037474', 1 )
?>
<div class="repeate_area">
	<div class="repeat_cont">
		<h4 class="repeat_txt">
			<?php _e( 'الصفقات المتكررة ', 'stratusx-child' ); ?>
		</h4>
		<a tabindex="0" role="button" data-toggle="tooltip" title="<?php _e( 'الأسهم التي تم تنفيذ عليها صفقات مكررة', 'stratusx-child' ); ?>">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/info.png" alt="info">
		</a>
	</div>
	
	<div id="repeated-trades" data-portfolio-id="<?php echo esc_attr( $args['portfolio_id'] ); ?>">
		<?php
		get_template_part(
			'template-parts/content',
			'repeated-trades-list-items',
			[ 'repeated_trades' => $args['repeated_trades'] ]
		);
		?>
	</div>
	<div class="repeat_see">
		<a href="#"><?php _e( 'مشاهدة المزيد ', 'stratusx-child' ); ?></a>
	</div>
</div>
