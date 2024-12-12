<?php
/**
 * Plugin Name: Books Custom Post Type v1.2
 * Plugin URI:
 * Description: A plugin to create a custom post type for books.
 * Version: 1.2
 * Text Domain: lwp-books
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

define( 'LWP_BOOKS_PATH', plugin_dir_url( __FILE__ ) );
const LWP_BOOKS_VERSION = '1.2';

/**
 * Create a custom table for subscribers
 * Column names: ID, Name, Email, Book ID
 * Update post meta of books cpt to store the row ID of the subscriber.
 * Let's use the register_activation_hook to create the database table when the plugin is activated.
 *
 * @see https://learn.wordpress.org/lesson/custom-database-tables/
 */

register_activation_hook( __FILE__, 'wp_learn_create_subscribers_table' );

function wp_learn_create_subscribers_table() {
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    $table_name = $wpdb->prefix . 'subscribers';

    $sql = "CREATE TABLE $table_name (
        id bigint(11) NOT NULL AUTO_INCREMENT,
        name varchar(100) NOT NULL,
        email varchar(100) NOT NULL,
        book_id mediumint(9) NOT NULL,
        time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
        PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}

/**
 * Load the plugin files.
 */
require_once plugin_dir_path( __FILE__ ) . 'inc/admin/taxonomy.php';
require_once plugin_dir_path( __FILE__ ) . 'inc/admin/post-type.php';
require_once plugin_dir_path( __FILE__ ) . 'inc/frontend/shortcode.php';
require_once plugin_dir_path( __FILE__ ) . 'inc/admin/subscribers.php';