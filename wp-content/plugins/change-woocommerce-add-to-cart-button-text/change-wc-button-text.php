<?php

/*
Plugin Name: Change WooCommerce Add to Cart Text
Plugin URI: https://wordpress.org/plugins/change-woocommerce-add-to-cart-button-text/
Description: This plugin helps you to change the "Add To Cart" button text to anything from a simple settings page available in wp-admin → Settings → Reading
Author: Rextheme
Author URI: http://rextheme.com/
Version: 1.3
*/

add_filter( 'woocommerce_loop_add_to_cart_link' , 'custom_woocommerce_product_add_to_cart_text' );
add_filter( 'woocommerce_product_single_add_to_cart_text', 'custom_woocommerce_product_add_to_cart_text' );
add_filter( 'woocommerce_booking_single_add_to_cart_text', 'custom_woocommerce_product_add_to_cart_text' );


/**
 * custom_woocommerce_template_loop_add_to_cart
*/
function custom_woocommerce_product_add_to_cart_text() {
	global $product;

	$product_type = $product->product_type;

	if (is_product ()) {
		switch ( $product_type ) {
			case 'external':
				echo __( $options = get_option( 'external_single_button_text', false ), 'wctext' );

			break;
			case 'grouped':
				echo __( $options = get_option( 'grouped_single_button_text', false ), 'wctext' );

			break;
			case 'simple':
				echo __( $options = get_option( 'grouped_single_button_text', false ), 'wctext' );

			break;
			case 'variable':
				echo __( $options = get_option( 'variable_single_button_text', false ), 'wctext' );

			break;
			default:
				return __( 'Read More', 'wctext' );
		}
	}
	else {
		switch ( $product_type ) {
			case 'external':
                $options = get_option( 'external_button_text', false );

                return sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s">'.__($options, 'wctext').'</a>',
                esc_url( $product->add_to_cart_url() ),
                esc_attr( isset( $quantity ) ? $quantity : 1 ),
                esc_attr( $product->get_id() ),
                esc_attr( $product->get_sku() ),
                esc_attr( isset( $class ) ? $class : 'button' ),
                $product->add_to_cart_text()
                );
			break;
			case 'grouped':
                $options = get_option( 'grouped_button_text', false );

                return sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="button product_type_simple add_to_cart_button ajax_add_to_cart">'.__($options, 'wctext').'</a>',
                esc_url( $product->add_to_cart_url() ),
                esc_attr( isset( $quantity ) ? $quantity : 1 ),
                esc_attr( $product->get_id() ),
                esc_attr( $product->get_sku() ),
                esc_attr( isset( $class ) ? $class : 'button' ),
                $product->add_to_cart_text()
                );
			break;
			case 'simple':
                $options = get_option( 'simple_button_text', false );

                return sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="button product_type_simple add_to_cart_button ajax_add_to_cart">'.__($options, 'wctext').'</a>',
                esc_url( $product->add_to_cart_url() ),
                esc_attr( isset( $quantity ) ? $quantity : 1 ),
                esc_attr( $product->get_id() ),
                esc_attr( $product->get_sku() ),
                esc_attr( isset( $class ) ? $class : 'button' ),
                $product->add_to_cart_text()
                );
			break;
			case 'variable':
                $options = get_option( 'variable_button_text', false );

                return sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s">'.__($options, 'wctext').'</a>',
                esc_url( $product->add_to_cart_url() ),
                esc_attr( isset( $quantity ) ? $quantity : 1 ),
                esc_attr( $product->get_id() ),
                esc_attr( $product->get_sku() ),
                esc_attr( isset( $class ) ? $class : 'button' ),
                $product->add_to_cart_text()
                );
			break;
			default:
				return __( 'Read More', 'wctext' );
		}
	}

}

include_once 'wctext-settings.php';

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'VARIATION_SWATCHES_FOR_WOOCOMMERCE_VERSION', '1.0.0' );
define( "REXVS_PLUGIN_DIR_URL", plugin_dir_url( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-variation-swatches-for-woocommerce-activator.php
 */
function activate_variation_swatches_for_woocommerce() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-rex-variation-swatches-for-woocommerce-activator.php';
	Variation_Swatches_For_Woocommerce_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-variation-swatches-for-woocommerce-deactivator.php
 */
function deactivate_variation_swatches_for_woocommerce() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-rex-variation-swatches-for-woocommerce-deactivator.php';
	Variation_Swatches_For_Woocommerce_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_variation_swatches_for_woocommerce' );
register_deactivation_hook( __FILE__, 'deactivate_variation_swatches_for_woocommerce' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-rex-variation-swatches-for-woocommerce.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_variation_swatches_for_woocommerce() {

    require_once plugin_dir_path( __FILE__ ) . 'admin/class-rexvs-dependency-check.php';
	$plugin = new Variation_Swatches_For_Woocommerce();
	$plugin->run();
    new Rexvs_Dependency_Check( 'woocommerce/woocommerce.php', __FILE__, '4.0.0', 'rexvs' );

}
run_variation_swatches_for_woocommerce();

/**
 * Initialize the plugin tracker
 *
 * @return void
 */
function appsero_init_tracker_variation_swatches_for_woocommerce() {

	if ( ! class_exists( 'Appsero\Client' ) ) {
		require_once __DIR__ . '/appsero/src/Client.php';
	}

	$client = new Appsero\Client( '454ebec6-6008-4065-b639-ba70ed7f9640', 'variation-swatches-for-woocommerce', __FILE__ );
	$client->insights()->init();
	$client->updater();

}

// appsero_init_tracker_variation_swatches_for_woocommerce();


/**
 * woocommerce_before_variations_form
 *
 */
function action_woocommerce_before_variations_form() {
    echo '<div class="rexvs-variations">
			<p id="variation_notice" style="display:none;">No variation available</p>
		';
};
add_action( 'woocommerce_before_variations_form', 'action_woocommerce_before_variations_form', 10, 0 );


/**
 * woocommerce_after_variations_form
 *
 */
function action_woocommerce_after_variations_form() {
    echo '</div>';
};

add_action( 'woocommerce_after_variations_form', 'action_woocommerce_after_variations_form', 10, 0 );


?>
