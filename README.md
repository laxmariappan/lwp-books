# Plugin Structure

@see: https://engineering.hmn.md/standards/structure/#plugin-structure

## Description

This plugin adds a custom post type for books.

## Installation

1. Clone the repository into your `wp-content/plugins` directory
2. Activate the plugin via the WordPress admin interface
3. Use the `Books` custom post type to add books to your site
4. View the books at `/books/`
5. View a single book at `/books/{slug}/`
6. Click on the subscribe button to subscribe to the book
7. View the subscribers at `/wp-admin/admin.php?page=subscribers-list`

## Further Development

1. Fork the repository 
2. Create a new branch for your feature or changes
3. Create a new issue in the repository for the feature or changes
4. Create a pull request for your changes

## Improvements

> The following improvements can make your plugin development more efficient and maintainable.

1. Use classes for the plugin files.
2. Autoload classes using spl_autoload_register or PSR-4 autoloading.
3. Use WP PHPCS for coding standards.
4. Send an email to the site admin when a new subscriber is added.
5. Add a column to the books list table to show the number of subscribers.