<?php
add_action( 'wp_enqueue_scripts', 'enqueue_child_theme_style', 9999 );
function enqueue_child_theme_style() {
	wp_enqueue_style( 'dtbwp_css_child', get_stylesheet_directory_uri() . '/style.css', array(
		'dtbwp_style',
	), 1.0 );
}

add_filter('wf_pklist_alter_tax_inclusive_text','wf_pklist_remove_tax_text',10,3);
function wf_pklist_remove_tax_text($incl_tax_text, $template_type, $order)
{
	if($template_type=='invoice')
	{
		$incl_tax_text='';
	}
	return $incl_tax_text;
}

// add_filter('woocommerce_show_page_title', 'bbloomer_hide_shop_page_title');
 
// function bbloomer_hide_shop_page_title($title) {
//    if (is_shop()) $title = false;
//    return $title;
// }

// add_filter( 'woocommerce_show_page_title', 'bbloomer_hide_shop_page_title' );
 
// function bbloomer_hide_shop_page_title( $title ) {
//    if ( is_shop() ) $title = false;
//    return $title;
// }

// add_filter( 'woocommerce_show_page_title', 'bbloomer_hide_cat_page_title' );
 
// function bbloomer_hide_cat_page_title( $title ) {
//    if ( is_product_category() ) $title = false;
//    return $title;
// }

// add_filter( 'woocommerce_show_page_title', '__return_null' );

if ( SITECOOKIEPATH != COOKIEPATH ) {
    setcookie(TEST_COOKIE, 'WP Cookie check', 0, SITECOOKIEPATH, COOKIE_DOMAIN);
}

/**
 * Never worry about cache again!
 */
function expert_profile_js_css() {

    if ( is_page_template( 'expert-details.php' ) ) {

        wp_enqueue_script('popper_js', get_stylesheet_directory_uri() . '/js/popper.min.js', array('jquery'), '', true);
        wp_enqueue_script('bootstrap_js', get_stylesheet_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '', true);
        wp_enqueue_script('chart_bundle', "https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.js", array('jquery'), '', true);
        wp_enqueue_script('chart_min', get_stylesheet_directory_uri() . '/js/chart.js/Chart.min.js', array('jquery'), '', true);
        wp_enqueue_script('translate_js', get_stylesheet_directory_uri() . '/js/translate.js', array('jquery'), '', true);
        wp_enqueue_script('main_js', get_stylesheet_directory_uri() . '/js/main.js', array('jquery'), '', true);
        wp_enqueue_script('custom_js', get_stylesheet_directory_uri() . '/js/custom.js', array('jquery'), '', true);


        wp_register_style('bootstrap', get_stylesheet_directory_uri() . '/css/bootstrap.min.css', false);
        wp_enqueue_style('bootstrap');
        wp_register_style('chart_css', get_stylesheet_directory_uri() . '/css/Chart.css', false);
        wp_enqueue_style('chart_css');
        wp_register_style('font-awesome', get_stylesheet_directory_uri() . '/css/font-awesome.min.css', false);
        wp_enqueue_style('font-awesome');
        wp_register_style('gstatic', get_stylesheet_directory_uri() . 'https://fonts.gstatic.com', false);
        wp_enqueue_style('gstatic');
        wp_register_style('googleapis', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap', false);
        wp_enqueue_style('googleapis');
        wp_register_style('responsive_css', get_stylesheet_directory_uri() . '/css/responsive.css', false);
        wp_enqueue_style('responsive_css');
        wp_register_style('custom_css', get_stylesheet_directory_uri() . '/css/custom.css', false);
        wp_enqueue_style('custom_css');
    }
}
add_action('wp_enqueue_scripts', 'expert_profile_js_css');