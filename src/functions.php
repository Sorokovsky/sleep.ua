<?php 
add_theme_support( 'menus' );
add_theme_support( 'post-thumbnails' );
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'style', get_template_directory_uri().'/css/style.min.css' );
    wp_enqueue_script( 'script', get_template_directory_uri().'/js/script.min.js', array(), false, true);
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function get_menu(string $name = "menu"): array {
    $args = array(
    'order'                  => 'ASC',
    'orderby'                => 'menu_order',
    'post_type'              => 'nav_menu_item',
    'post_status'            => 'publish',
    'output'                 => ARRAY_A,
    'output_key'             => 'menu_order',
    'nopaging'               => true,
    'update_post_term_cache' => false );
    $items = wp_get_nav_menu_items( $name, $args ); 
    return $items;
}