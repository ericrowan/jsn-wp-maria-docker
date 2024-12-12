<?php
// Enqueue styles
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

    // Enqueue Inter font from Google Fonts
    wp_enqueue_style( 'inter-font', 'https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap', array(), null );

    // Enqueue Tailwind/Shadcn output CSS (if built)
    if ( file_exists( get_stylesheet_directory() . '/dist/output.css' ) ) {
        wp_enqueue_style( 'tailwind-output', get_stylesheet_directory_uri() . '/dist/output.css', array(), filemtime( get_stylesheet_directory() . '/dist/output.css' ) );
    }
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

// Enqueue the theme's style.css if it exists
function my_theme_enqueue_main_style() {
    $style_path = get_stylesheet_directory() . '/style.css';
    if ( file_exists( $style_path ) ) {
        wp_enqueue_style( 'my-theme-style', get_stylesheet_directory_uri() . '/style.css', array(), filemtime( $style_path ) );
    }
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_main_style' );