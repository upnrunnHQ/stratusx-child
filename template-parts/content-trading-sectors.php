<?php
/**
 * @var array $args
 */

$sectors = $args['sectors'];
$sectors = json_decode( json_encode( $sectors ) );
uasort( $sectors, 'stratusx_child_sort_by_percentage' );
?>

<?php if ( $sectors ) : ?>
	<?php
	$total_sectors = count( $sectors );
	$sector_colors = stratusx_child_get_trading_sectors_colors();
	$total_colors  = count( $sector_colors );
	$increment     = 0;
	$total         = 0;
	$loop_index    = 0;
	?>
	<div class="trading-sectors-bar">
		<div class="progress trading-progress-bar">
			<?php foreach ( $sectors as $index => $sector ) : ?>
				<?php
				if ( $increment >= $total_colors ) {
					$increment = 0;
				}

				$percentage = round( $sector->percentage, 1 );
				$color      = $sector_colors[ $increment ];
				$total      = $percentage + $total;

				if ( ( $index + 1 === $total_sectors ) && ( $total > 100 ) ) { // We adjust the width of the last bar only
					$remaining   = $total - 100;
					$_percentage = $percentage - $remaining;
				} else {
					$_percentage = $percentage;
				}

				$style = "width: {$_percentage}%; background-color: {$color};";
				if ( $loop_index >= 3 ) {
					$style .= 'display: none;';
				}
				?>
				<div
					class="progress-bar"
					role="progressbar"
					style="<?php echo esc_attr( $style ); ?>"
					aria-valuenow="<?php echo $_percentage; ?>"
					aria-valuemin="0"
					aria-valuemax="100"
				>
					<?php echo $percentage; ?>
				</div>
				<?php
				$increment++;
				$loop_index++;
				?>
			<?php endforeach; ?>
		</div>
	</div>

	<div class="trading-sectors">
		<?php
		$increment  = 0;
		$loop_index = 0;

		foreach ( $sectors as $sector ) :
			?>
			<?php
			if ( $increment >= $total_colors ) {
				$increment = 0;
			}

			$style = 'color: ' . $sector_colors[ $increment ] . ';';
			if ( $loop_index >= 3 ) {
				$style .= 'display: none;';
			}
			?>
			<div class="tra_sector" style="<?php echo esc_attr( $style ); ?>">
				<div class="tra_color" style="background-color: <?php echo esc_attr( $sector_colors[ $increment ] ); ?>;"></div>
				<div class="tra_sector_title"><?php echo esc_html( $sector->sector_name ); ?></div>
				<div class="tra_sector_percentage"><?php echo esc_html( $sector->percentage ); ?>%</div>
			</div>
			<?php
			$increment++;
			$loop_index++;
			?>
		<?php endforeach; ?>
	</div>
<?php endif; ?>
