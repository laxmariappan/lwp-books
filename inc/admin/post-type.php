<?php
/**
 * Add a custom post type for books.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Register the book custom post type.
 * show_in_rest is set to true to enable the Gutenberg editor for the custom post type.
 * supports custom-fields to enable custom fields in the Gutenberg editor.
 * rewrite is set to 'books' to change the URL of the custom post type.
 * public is set to true to access the books content from the front end.
 */
add_action('init', 'book_post_type');
function book_post_type() {
    register_post_type('book',
        array(
            'labels'      => array(
                'name'          => __('Books', 'lwp-books'),
                'singular_name' => __('Book', 'lwp-books'),
                'add_new'       => __('Add New Book', 'lwp-books'),
                'add_new_item'  => __('Add New Book', 'lwp-books'),
                'new_item'      => __('New Book', 'lwp-books'),
                'edit_item'     => __('Edit Book', 'lwp-books'),
                'view_item'     => __('View Book', 'lwp-books'),
                'all_items'     => __('All Books', 'lwp-books'),
            ),
            'public'       => true,
            'has_archive'  => true,
            'show_in_rest' => true,
            'supports'     => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields' ),
            'rewrite'      => array( 'slug' => 'books' ),

        )
    );
}