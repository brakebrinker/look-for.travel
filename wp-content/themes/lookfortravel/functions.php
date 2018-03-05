<?php 

function enqueue_styles() {
    wp_enqueue_style( 'whitesquare-style', get_stylesheet_uri(), array('style'));
    wp_enqueue_style( 'style', get_template_directory_uri() . '/css/lookfortravel.css');
    wp_enqueue_style( 'style');
}
add_action('wp_enqueue_scripts', 'enqueue_styles');

function enqueue_scripts () {
    wp_localize_script('jquery', 'lookfortravel', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
    ));
    wp_register_script('main', get_template_directory_uri() . '/js/main.js');
    wp_enqueue_script('main');
    wp_register_script('uikit', get_template_directory_uri() . '/uikit/js/uikit.min.js');
    wp_enqueue_script('uikit');
    wp_register_script('lodash', 'https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.4/lodash.min.js');
    wp_enqueue_script('lodash');
}
add_action('wp_enqueue_scripts', 'enqueue_scripts');

// WP-postrating use PNG images instead of GIF images
function custom_rating_image_extension() {
    return 'png';
}
add_filter( 'wp_postratings_image_extension', 'custom_rating_image_extension' );

// theme content file require
require get_parent_theme_file_path( '/theme-functions.php' );

// Область виджетов в Footer
register_sidebar(array(
    'name' => __('Виджеты в Footer'),
    'id' => 'foot-widget-area',
    'description' => __('Виджеты в Footer здесь должны быть социальные кнопки'),
    'before_widget' => '<div class="uk-flex-center uk-grid" uk-margin>',
    'after_widget' => '</div>',
    'before_title' => '',
    'after_title' => '',
));

// Включение в настройках Логотипа
add_theme_support( 'custom-logo' );

