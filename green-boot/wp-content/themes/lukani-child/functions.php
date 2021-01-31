<?php
function lukani_child_enqueue_styles() {

    $parent_style = 'lukani-style'; // This is 'lukani-style' for the Lukani theme.

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'lukani_child_enqueue_styles' );
?>