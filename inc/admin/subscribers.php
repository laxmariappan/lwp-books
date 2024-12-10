<?php
/**
 * Subscribers page
 * Display the subscribers list in the admin panel
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Add a page to display the subscribers list from the custom table.
 */
add_action('admin_menu', 'subscribers_page');
function subscribers_page() {
    add_menu_page(
        'Subscribers List',
        'Subscribers',
        'manage_options',
        'subscribers-list',
        'subscribers_list_page'
    );
}

/**
 * Display the subscribers list from the custom table.
 * Uses the global $wpdb to query the custom table and display the subscribers list.
 */
function subscribers_list_page()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'subscribers';
    $subscribers = $wpdb->get_results("SELECT * FROM $table_name");

    echo '<div class="wrap">';
    echo '<h2>Subscribers List</h2>';
    echo '<table class="wp-list-table widefat fixed striped">';
    echo '<thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Book ID</th><th>Time</th></tr></thead>';
    echo '<tbody>';
    $row = '';
    foreach ($subscribers as $subscriber) {
        $book = get_post($subscriber->book_id); // To get book title.
        $link = get_edit_post_link($subscriber->book_id);
        $row .= <<<HTML
        
        <tr>
            <td>{$subscriber->id}</td>
            <td>{$subscriber->name}</td>
            <td>{$subscriber->email}</td>
            <td><a href={$link}>{$book->post_title}</a></td>
            <td>{$subscriber->time}</td>
        </tr>
        HTML;
    }
    echo $row;
    echo '</tbody>';
    echo '</table>';
    echo '</div>';
}
