<?php
if (! defined('WP_DEBUG')) {
	die( 'Direct access forbidden.' );
}
add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
});

add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style('blocksy-child-style', get_stylesheet_uri());
});

// changing the letter k to m
function replace_k_with_m($var) {
    $letter = str_replace('k', 'm', $var);
    return $letter;
}

add_action('the_title', 'replace_k_with_m');


// adds a bit of text before a single product
add_action( 'woocommerce_before_single_product', 'finegap_add_text', 999);
function finegap_add_text() {
	
    global $product;
    $product_id = $product->get_id();

    $text = get_post_meta($product_id, '_price', true);

	echo $text . ' kr is the price of the product beneath.';
}

add_action( 'storefront_before_header', 'finegap_add_text', 99);


// removes the function above - uncomment this for it to function
//  remove_action('woocommerce_before_single_product','finegap_add_text', 999);


 
// // Trigger Holiday Mode - Uncomment to turn of shopability
//  add_action ('init', 'bbloomer_woocommerce_holiday_mode');


// // Disable Cart, Checkout, Add Cart
// function bbloomer_woocommerce_holiday_mode() {
//    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
//    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
//    remove_action( 'woocommerce_proceed_to_checkout', 'woocommerce_button_proceed_to_checkout', 20 );
//    remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );
//    add_action( 'woocommerce_before_main_content', 'bbloomer_wc_shop_disabled', 5 );
//    add_action( 'woocommerce_before_cart', 'bbloomer_wc_shop_disabled', 5 );
//    add_action( 'woocommerce_before_checkout_form', 'bbloomer_wc_shop_disabled', 5 );
// }
// // Show Holiday Notice
// function bbloomer_wc_shop_disabled() {
//         wc_print_notice( 'Our Online Shop is Closed Today :)', 'error');

// }




// Adds a p-tag above the 'woocommerce_before_shop_loop_item_title' that displayes X amount of items left in stock
// if the items are greater than 0 or 20 or less. 
function items_in_stock() {
  global $product;
  $stock_quantity = $product->get_stock_quantity();
  if ($stock_quantity > 0 && $stock_quantity <= 20) {
    echo '<p class="productCustomProductItems">' . sprintf( __( 'Only %s left in stock', 'woocommerce' ), $stock_quantity ) . '</p>';
  }
}
add_action('woocommerce_before_shop_loop_item_title', 'items_in_stock', 10);

// adda a new menu option in the admin panel - the menu itself doesnt do anything.
add_action( 'admin_menu', 'wp_test_add_menu_pages');
function wp_test_add_menu_pages() {
    add_menu_page( page_title: 'Page title', menu_title: 'Menu title', capability: 'manage_options', menu_slug: 'wptest');
}