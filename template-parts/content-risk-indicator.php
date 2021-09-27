<div class="risk_ind_main">
	<div class="risk_head_area">
		<div class="ri_head_inner">
			<span class="risk_num"><?php echo $args['totalRiskRate']; ?></span>
			<span class="risk_txt"><?php _e( 'مؤشر المخاطر لمدة 12 شهرا الماضية ', 'stratus-child' ); ?></span>
		</div>
		<div class="risk_info_icon exp_r_info">
			<a tabindex="0" role="button" data-placement="bottom" data-trigger="hover focus" data-toggle="tooltip"
				title="
				<p>
					<?php
					_e( 'يشير هذا الرقم إلى معدل نجاح تداولات المستخدم. وبالتالي فإن السعر يتراوح من -5 إلى 5 ، حيث يشير -5 إلى أن جميع التداولات ستخسر و +5 تشير إلى أن جميع التداولات مربحة.', 'stratusx-child' );
					?>
				</p>
				<p>
					<?php
					_e( 'يتم تحديد مؤشر المخاطر وفقًا لمعايير علمية تلخص سلوك صاحب الحساب في التداول والاستثمار وهذه المعايير هي:', 'stratusx-child' );
					?>
				</p>
				<p>
					<?php
					_e( '- توزيع الاستثمار على الأوراق المالية: يعتبر الاستثمار في ورقة مالية واحدة عالي الخطورة ، بينما توزيع الاستثمارات على أكثر من ورقة مالية يقلل من المخاطر.', 'stratusx-child' );
					?>
				</p>
				<p>
					<?php
					_e( '- توزيع الاستثمار على القطاعات: يعتبر الاستثمار في قطاع واحد عالي الخطورة ، بينما توزيع الاستثمارات على أكثر من قطاع يقلل من المخاطر.', 'stratusx-child' );
					?>
				</p>
				<p>
					<?php
					_e( '- جودة الأوراق المالية: سيتم تقسيم الأوراق المالية إلى ثلاثة أنواع ، منخفضة المخاطر: تحتوي على جميع الشركات الرابحة. مخاطرة متوسطة: تحتوي على شركات منخفضة الدخل خلال 12 شهرًا. عالية المخاطر: وتشمل الشركات التي بلغت خسائرها المتراكمة 20٪ أو أكثر من رأس مالها.', 'stratusx-child' );
					?>
				</p>
				<p>
					<?php
					_e( '- عدد التداولات الخاسرة مقارنة بالصفقات الرابحة.', 'stratusx-child' );
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
