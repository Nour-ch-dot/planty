<?php
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
function theme_enqueue_styles()
{
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/css/theme.css', array(), filemtime(get_stylesheet_directory() . '/css/theme.css'));
} 
function ajouter_liens_menu($items, $args) {
    if ($args->theme_location == 'primary') {
        // Ajoute le bouton "Commander" pour tout le monde
        $lien_commander = '<li class="menu-item lien-commander"><a href="/commander">Commander</a></li>';
        $items_array = explode('</li>', $items); 
       
        // Ajoute le lien "Admin" uniquement pour les utilisateurs connectés
        if (is_user_logged_in()) {
            $lien_admin = '<li class="menu-item lien-admin"><a href="' . admin_url() . '">Admin</a></li>';
            foreach ($items_array as $key => $item) {
                if (strpos($item, 'Commander') !== false) {
                    // Insère "Admin" juste avant "Commander"
                    array_splice($items_array, $key, 0, $lien_admin);
                    break;
                }
            }
        }
        
        $items = implode('</li>', $items_array) . '</li>'; 
    }
    return $items;
}
add_filter('wp_nav_menu_items', 'ajouter_liens_menu', 10, 2);
