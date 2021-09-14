<?php
add_action( 'wp_enqueue_scripts', 'enqueue_child_theme_style', 9999 );
add_action( 'wp_enqueue_scripts', 'expert_profile_js_css' );

function enqueue_child_theme_style() {
	wp_enqueue_style(
		'dtbwp_css_child',
		get_stylesheet_directory_uri() . '/style.css',
		array(
			'dtbwp_style',
		),
		1.0
	);
}

/**
 * Never worry about cache again!
 */
function expert_profile_js_css() {
	if ( is_product() || is_page_template( 'expert-details.php' ) ) {
		wp_enqueue_script( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'chart-bundle', 'https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'chart', get_stylesheet_directory_uri() . '/js/chart.js/Chart.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'translate', get_stylesheet_directory_uri() . '/js/translate.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'main', get_stylesheet_directory_uri() . '/js/main.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'stratusx-child', get_stylesheet_directory_uri() . '/js/custom.js', array( 'jquery', 'bootstrap' ), '', true );

		wp_register_style( 'bootstrap', get_stylesheet_directory_uri() . '/css/bootstrap.min.css', false );
		wp_register_style( 'chart', get_stylesheet_directory_uri() . '/css/Chart.css', false );
		wp_register_style( 'font-awesome', get_stylesheet_directory_uri() . '/css/font-awesome.min.css', false );
		wp_register_style( 'gstatic', get_stylesheet_directory_uri() . 'https://fonts.gstatic.com', false );
		wp_register_style( 'googleapis', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap', false );
		wp_register_style( 'responsive', get_stylesheet_directory_uri() . '/css/responsive.css', false );
		wp_register_style( 'custom', get_stylesheet_directory_uri() . '/css/custom.css', false );

		// wp_enqueue_style( 'bootstrap' );
		wp_enqueue_style( 'chart' );
		wp_enqueue_style( 'font-awesome' );
		wp_enqueue_style( 'gstatic' );
		wp_enqueue_style( 'googleapis' );
		wp_enqueue_style( 'responsive' );
		wp_enqueue_style( 'custom' );
	}
}
