<?php
/**
 * @var array $args
 */

$sectors = $args['sectors'];

$sectors = json_decode(json_encode($sectors));
?>

<?php if ( $sectors ) : ?>
    <?php
    $total_sectors = count( $sectors );
	$sector_colors = stratusx_child_get_trading_sectors_colors();
	$total_colors  = count( $sector_colors );
	$increment     = 0;
	$total         = 0;
    ?>
    <div class="trading-sectors-bar">
        <div class="progress trading-progress-bar">
	        <?php foreach ( $sectors as $index => $sector ) : ?>
		        <?php
		        if ( $increment >= $total_colors ) {
			        $increment = 0;
		        }

		        $percentage = round( $sector->percentage );
		        $color      = $sector_colors[ $increment ];
		        $total      = $percentage + $total;

		        if ( $index + 1 === $total_sectors ) { // We adjust the width of the last bar only
			        if ( $total > 100 ) {
				        $remaining   = $total - 100;
				        $_percentage = $percentage - $remaining;
			        } else {
				        $_percentage = $percentage;
			        }
		        } else {
			        $_percentage = $percentage;
		        }
		        ?>
                <div
                    class="progress-bar"
                    role="progressbar"
                    style="width: <?php echo $_percentage; ?>%; background-color: <?php echo esc_attr( $color ); ?>;"
                    aria-valuenow="<?php echo $_percentage; ?>"
                    aria-valuemin="0"
                    aria-valuemax="100"
                ><?php echo $percentage; ?></div>
		        <?php $increment++; ?>
	        <?php endforeach; ?>
        </div>
    </div>

    <div class="trading-sectors">
        <?php foreach ( $sectors as $sector ) : ?>
            <?php
            if ( $increment >= $total_colors ) {
                $increment = 0;
            }
            ?>
            <div class="tra_sector" style="color: <?php echo esc_attr( $sector_colors[ $increment ] ); ?>;">
                <div class="tra_color" style="background-color: <?php echo esc_attr( $sector_colors[ $increment ] ); ?>;"></div>
                <div class="tra_sector_title"><?php echo esc_html( $sector->sector_name ); ?></div>
                <div class="tra_sector_percentage"><?php echo esc_html( $sector->percentage ); ?>%</div>
            </div>
            <?php $increment++; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
