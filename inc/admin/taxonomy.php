<?php
/**
 * Add a custom taxonomy for books.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Register the book_genre taxonomy for the book custom post type.
 * show_in_rest is set to true to enable the Gutenberg editor for the custom taxonomy.
 * hierarchical is set to true to create a hierarchical taxonomy.
 * show_admin_column is set to true to display the taxonomy in the admin column.
 */

add_action('init', 'book_taxonomy');
function book_taxonomy() {
    register_taxonomy(
        'book_genre',
        'book',
        array(
            'label'             => __('Genre'),
            'rewrite'           => array('slug' => 'genre'),
            'hierarchical'      => true,
            'show_admin_column' => true,
            'show_in_rest'      => true,
        )
    );
}
