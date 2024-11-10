<?php
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
function theme_enqueue_styles()
{
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/css/theme.css', array(), filemtime(get_stylesheet_directory() . '/css/theme.css'));
} 
function ajouter_lien_admin_pour_utilisateurs_connectes($items, $args) {
    if (is_user_logged_in() && $args->theme_location == 'primary') {
        // Crée le lien "Admin"
        $lien_admin = '<li class="menu-item lien-admin"><a href="' . admin_url() . '">Admin</a></li>';
        
        // Trouve la position du lien "Commander" et place le lien "Admin" avant
        $items_array = explode('</li>', $items); // Sépare le menu en items individuels
        foreach ($items_array as $key => $item) {
            if (strpos($item, 'Commander') !== false) {
                array_splice($items_array, $key, 0, $lien_admin); // Insère "Admin" avant "Commander"
                break;
            }
        }
        
        // Reconstruit le menu
        $items = implode('</li>', $items_array) . '</li>';
    }
    return $items;
}
add_filter('wp_nav_menu_items', 'ajouter_lien_admin_pour_utilisateurs_connectes', 10, 2);
