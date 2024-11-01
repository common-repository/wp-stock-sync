<?php

/**
 * @package           Wp_Stock_Sync
 *
 * @wordpress-plugin
 * Plugin Name:       WP Stock Sync
 * Author URI: 		  http://www.paypal.me/rob9095
 * Description:       A plugin for woocommerce that sums the variation stock and stores that value as the parent stock.
 * Version:           1.0.0
 * Author:            Robert Tucker
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-stock-sync
 * Domain Path:       /languages
 */

 
 
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp-stock-sync-activator.php
 */
function activate_wp_stock_sync() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-stock-sync-activator.php';
	Wp_Stock_Sync_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-stock-sync-deactivator.php
 */
function deactivate_wp_stock_sync() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-stock-sync-deactivator.php';
	Wp_Stock_Sync_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wp_stock_sync' );
register_deactivation_hook( __FILE__, 'deactivate_wp_stock_sync' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-stock-sync.php';


/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wp_stock_sync() {

	$plugin = new Wp_Stock_Sync();
	$plugin->run();

}
run_wp_stock_sync();


// Checks to see if sync is active adds neccesary filters if active
$options = get_option( 'wp-stock-sync' );
// Activatation Settings
$activate = $options['activate'];

if ( 1 == $activate ) {
// Filter for custom Total Qty Admin Column
add_filter( 'manage_posts_columns', 'add_qty_admin' );
// Action for custom Total Qty Admin Column
add_action( 'manage_posts_custom_column', 'admin_post_data_row', 10, 2);
// Action to run sum query on init
add_action('init', 'wp_stock_sync_update');
	
}
// Runs product sum query and populates on init
function wp_stock_sync_update() {
global $wpdb;
$args = array( 'post_type' => 'product');
$loop = new WP_Query( $args );
while ( $loop->have_posts() ) : $loop->the_post();
		$theid = get_the_ID();
		$product = new WC_Product($theid);
		$sku = get_post_meta($theid, '_sku', true );

 $query = "SELECT sum(meta_value)
                      FROM $wpdb->posts AS p, $wpdb->postmeta AS s
                      WHERE p.post_parent = %d
                      AND p.post_type = 'product_variation'
                      AND p.post_status = 'publish'
                      AND p.id = s.post_id
                      AND s.meta_key = '_stock'";
				
			$product_qty = $wpdb->get_var($wpdb->prepare($query,$theid));
			
			
			if ($product_qty > 0) {
	
			
				// update parent stock and stock status
				update_post_meta($theid, '_stock', (float)$product_qty);
				update_post_meta($theid, '_stock_status', 'instock');				
				
			
			} else {
			
				// update parent stock and stock status		
				update_post_meta($theid, '_stock', (float)$product_qty);
				update_post_meta($theid, '_stock_status', 'outofstock');
				
			}		
	endwhile;
	wp_reset_query();				  
}
	
// Adds Total Qty Admin Column to Products Page 
function add_qty_admin( $column ) {
        if (!isset($columns['total_qty']))
        $columns['total_qty'] = "Total Qty";
        return $columns;
}

// Runs product sum query and populates Total Qty Admin Column when Products Page is loaded
function admin_post_data_row($column_name, $post_id) {
    global $wpdb;
    switch($column_name) {
        case 'total_qty':
            $query = "SELECT sum(meta_value)
                      FROM $wpdb->posts AS p, $wpdb->postmeta AS s
                      WHERE p.post_parent = %d
                      AND p.post_type = 'product_variation'
                      AND p.post_status = 'publish'
                      AND p.id = s.post_id
                      AND s.meta_key = '_stock'";

            $product_qty = $wpdb->get_var($wpdb->prepare($query,$post_id));
			if ($product_qty > 0) {
			
				// update parent stock and stock status
				$args = array( 'post_type' => 'product',  'product_cat' => $key);
				$loop = new WP_Query( $args );
				while ( $loop->have_posts() ) : $loop->the_post(); 
				global $product;
				update_post_meta($post_id, '_stock', (float)$product_qty);
				update_post_meta($post_id, '_stock_status', 'instock');
				endwhile; 
				wp_reset_query();  

				echo $product_qty;					
				
			
			} else {
			
				// update parent stock and stock status	
				$args = array( 'post_type' => 'product',  'product_cat' => $key);
				$loop = new WP_Query( $args );
				while ( $loop->have_posts() ) : $loop->the_post(); 
				global $product; 
				update_post_meta($post_id, '_stock', (float)$product_qty);
				update_post_meta($post_id, '_stock_status', 'outofstock');
				endwhile; 
				wp_reset_query();
				
				echo "0";
			}
            break;
			default:
            break;
			
					  
    }

}

?>