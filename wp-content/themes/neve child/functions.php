<?php
// Action qui permet de charger des styles dans notre thème
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

function theme_enqueue_styles() {
    // Charger le style.css du thème parent Neve
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');

}
?>
