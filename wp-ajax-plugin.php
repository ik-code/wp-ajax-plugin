<?php
/**
 * Plugin Name: Simple WordPress AJAX Plugin
 * Plugin URI: http://wp.medi-com.info
 * Description: Simple WordPress AJAX Plugin
 * Version: 1.0.0
 * Author: Ihor Khaletskyi
 * Author URI: http://wp.medi-com.info
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: wp-ajax
 * Domain Path: /languages/
 *
 * @author Ihor Khaletskyi <ihor.khaletskyi@gmail.com>
 * @copyright Copyright (c) 2021, Ihor Khaletskyi
**/
if ( ! defined( 'WPINC' ) ) { die; }


/* 1. REGISTER SHORTCODE
------------------------------------------ */

/* Init Hook */
add_action( 'init', 'my_wp_ajax_plugin_init', 10 );

/**
 * Init Hook to Register Shortcode.
 * @since 1.0.0
 */
function my_wp_ajax_plugin_init(){

	/* Register Shortcode */
	add_shortcode( 'wp-ajax', 'my_wp_ajax_shortcode_callback' );

}

/**
 * Shortcode Callback
 * Just display empty div. The content will be added via AJAX.
 */
function my_wp_ajax_shortcode_callback(){

	/* Enqueue JS only if this shortcode loaded. */
	wp_enqueue_script( 'my-wp-ajax-script' );

	/* Output empty div. */
	return '<div id="wp-ajax"></div>';
}


/* 2. REGISTER SCRIPT
------------------------------------------ */

/* Enqueue Script */
add_action( 'wp_enqueue_scripts', 'my_wp_ajax_scripts' );

/**
 * Scripts
 */
function my_wp_ajax_scripts(){

	/* Plugin DIR URL */
	$url = trailingslashit( plugin_dir_url( __FILE__ ) );

	/* JS + Localize */
	wp_register_script( 'my-wp-ajax-script', $url . "assets/script.js", array( 'jquery' ), '1.0.0', true );
	wp_localize_script( 'my-wp-ajax-script', 'ajax_url', admin_url( 'admin-ajax.php' ) );
}


/* 3. AJAX CALLBACK
------------------------------------------ */

/* AJAX action callback */
add_action( 'wp_ajax_ik_ajax', 'my_wp_ajax_callback' );
add_action( 'wp_ajax_nopriv_ik_ajax', 'my_wp_ajax_callback' );


/**
 * Ajax Callback
 */
function my_wp_ajax_callback(){
	$first_name = isset( $_POST['first_name'] ) ? $_POST['first_name'] : 'N/A';
	$last_name = isset( $_POST['last_name'] ) ? $_POST['last_name'] : 'N/A';
	?>
    <h2 style="color: red">WP-AJAX Plugin works</h2>
	<p style="color: red">Hello. Your first name is <?php echo strip_tags( $first_name ); ?>.</p>
	<p style="color: red">And your last name is <?php echo strip_tags( $last_name ); ?>.</p>
	<?php
	wp_die(); // required. to end AJAX request.
}

