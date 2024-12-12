<?php
/**
 * Add shortcode for displaying subscription form
 */

if( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Add a subscribe form with name and email on the single book page to allow users to submit the form.
 * Use the shortcode [book_subscribe_form] to display the form on the single book page.
 * The form contains name, email, and a hidden field to store the book CPT ID.
 */
add_shortcode( 'book_subscribe_form', 'book_subscribe_form' );
function book_subscribe_form() {
    ob_start();
    ?>
        <div class="lwp-subscription-form-wrapper">
            <button id="show-lwp-subscription-form">Subscribe Now</button>
            <form action="" method="post" class="lwp-subscription-form hidden">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" required>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
                <input type="hidden" name="book_id" value="<?php echo get_the_ID(); ?>">
                <?php wp_nonce_field('subscribe_form', 'subscribe_form_nonce'); ?>
                <input type="submit" value="Subscribe">
            </form>
        </div>
    <?php
    return ob_get_clean();
}

/**
 * Save the form data to the database.
 * Check if the form is submitted and the nonce is valid.
 * Sanitize the form data and insert it into the subscriber custom post type.
 */
add_action('init', 'save_book_subscribe_form_data');
function save_book_subscribe_form_data() {
    if (!isset($_POST['subscribe_form_nonce']) || !wp_verify_nonce($_POST['subscribe_form_nonce'], 'subscribe_form')) {
        return;
    }

    if (isset($_POST['name']) && isset($_POST['email'])) {
        $name = sanitize_text_field($_POST['name']);
        $email = sanitize_email($_POST['email']);
        $book_id = intval($_POST['book_id']);

        // Insert the form data into the custom table.
        global $wpdb;
        $table_name = $wpdb->prefix . 'subscribers';
        // check if insert works or not
        //  $wpdb->prepare()
        $wpdb->insert(
            $table_name,
            array(
                'name'    => $name,
                'email'   => $email,
                'book_id' => $book_id,
                'time'    => current_time('mysql'),
            )
        );

        // Get the inserted row ID.
        $row_id = $wpdb->insert_id;

        // Update the book post meta with the subscriber row ID.
        update_post_meta($book_id, 'subscriber_id', $row_id);

    }

    // Redirect to the same page after form submission.
    wp_safe_redirect(esc_url($_SERVER['REQUEST_URI']));
}

/**
 * Register scripts and styles for the subscription form.
 */
add_action('wp_enqueue_scripts', 'register_subscription_form_scripts');
function register_subscription_form_scripts() {
    // Change the version to time() to avoid cache during development.
    wp_register_style('lwp-form-style', LWP_BOOKS_PATH . 'assets/css/style.css', [], LWP_BOOKS_VERSION );
    wp_register_script('lwp-form-script', LWP_BOOKS_PATH . 'assets/js/script.js', [], LWP_BOOKS_VERSION, true );
}

/**
 * Load the stylesheet for the subscription form.
 */
add_action('wp_enqueue_scripts', 'load_subscription_form_styles');
function load_subscription_form_styles() {
   if( is_singular('book') ){
    wp_enqueue_style('lwp-form-style');
    wp_enqueue_script('lwp-form-script');
   }
}