<?php
/*
Plugin Name: Custom Plugin
Description: This plugin is setting for count of orders for that specific product,user can add a message for Gift category products in cart page.
Version:     1.0
Author:      Mayur Panchal
*/


/**
 * Add a column for count of product order
 */
add_filter('manage_edit-product_columns', 'misha_order_items_column');
function misha_order_items_column( $order_columns )
{
    $order_columns['count_orders'] = "count of order ";
    return $order_columns;
}
 
add_action('manage_product_posts_custom_column', 'misha_order_items_column_cnt');
function misha_order_items_column_cnt( $colname )
{

    global $wpdb,$product;;
    
    if($colname == 'count_orders' ) {
        
        $order_status = array( 'wc-completed' ); 
        $query = new WC_Order_Query(
            array(
            'limit' => -1,
            'orderby' => 'date',
            'order' => 'DESC',
            'return' => 'ids',
            ) 
        );
        $orders = $query->get_orders();
        $$CountofOrder = [];
        foreach ($orders as $key=>$val) {
             $order    = wc_get_order($orders[$key]);
             $items    = $order->get_items();
            foreach ( $items as $item ) {
                $product_id = $item->get_product_id();    
                //echo $item->get_quantity()."--".$product_id."<br>";
                $CountofOrder[$product_id] = $CountofOrder[$product_id] + $item->get_quantity();
            }    
        }
        echo $CountofOrder[$product->get_id()];        
    }
}


/**
 * Add a text field to Gift Category cart item
 */
function prefix_after_cart_item_name( $cart_item, $cart_item_key )
{
    
    $product = $cart_item['data'];
    //print_r($product);
    $hasGiftCategory = false;
    if (has_term('Gift', 'product_cat', $product->id) ) {
        $hasGiftCategory = true;
    }
    if($hasGiftCategory) {
        $notes = isset($cart_item['notes']) ? $cart_item['notes'] : '';
        printf(
            '<div><textarea class="%s" id="cart_notes_%s" data-cart-id="%s" placeholder="Write a Message here...">%s</textarea></div>',
            'prefix-cart-notes',
            $cart_item_key,
            $cart_item_key,
            $notes
        );
    }
}
add_action('woocommerce_after_cart_item_name', 'prefix_after_cart_item_name', 10, 2);
   
/**
 * Enqueue our JS file
 */
function prefix_enqueue_scripts()
{
    
    wp_register_script('prefix-script',  plugin_dir_url(__DIR__).'custom/update-cart-item-ajax.js', array( 'jquery-blockui' ), time(), true);
    wp_localize_script(
        'prefix-script',
        'prefix_vars',
        array(
        'ajaxurl' => admin_url('admin-ajax.php')
        )
    );
    wp_enqueue_script('prefix-script');
}
add_action('wp_enqueue_scripts', 'prefix_enqueue_scripts');


/**
 * Update cart item notes
 */
function prefix_update_cart_notes()
{
    // Do a nonce check
    if(! isset($_POST['security']) || ! wp_verify_nonce($_POST['security'], 'woocommerce-cart') ) {
        wp_send_json(array( 'nonce_fail' => 1 ));
        exit;
    }
    // Save the notes to the cart meta
    $cart = WC()->cart->cart_contents;
    $cart_id = $_POST['cart_id'];
    $notes = $_POST['notes'];
    $cart_item = $cart[$cart_id];
    $cart_item['notes'] = $notes;
    WC()->cart->cart_contents[$cart_id] = $cart_item;
    WC()->cart->set_session();
    wp_send_json(array( 'success' => 1 ));
    exit;
}
add_action('wp_ajax_prefix_update_cart_notes', 'prefix_update_cart_notes');
   
function prefix_checkout_create_order_line_item( $item, $cart_item_key, $values, $order )
{
    foreach( $item as $cart_item_key=>$cart_item ) {
        if(isset($cart_item['notes']) ) {
            $item->add_meta_data('notes', $cart_item['notes'], true);
        }
    }
}
add_action('woocommerce_checkout_create_order_line_item', 'prefix_checkout_create_order_line_item', 10, 4);
