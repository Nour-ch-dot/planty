<?php
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
function theme_enqueue_styles()
{
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/css/theme.css', array(), filemtime(get_stylesheet_directory() . '/css/theme.css'));
} 
// CREER UN EMPLACEMENT POUR AFFICHER LE MENU
function header_menu()
{
    register_nav_menu('header', __('menu header'));
}
add_action('init', 'header_menu');


// AFFICHE LE MENU LORSQUE L'UTILISATEUR EST CONNECTE
function add_admin_link($items, $args)
{
    if (is_user_logged_in() && $args->theme_location == 'header') {
        $items .= '<li class="admin-menu"><a href="' . get_admin_url() . '">Admin</a></li>';
    }
    return $items;
}
add_filter('wp_nav_menu_items', 'add_admin_link', 10, 2);
