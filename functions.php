<?php
require_once('src/Api/RestApiActions.php');

/**
 * Register and Enqueue Scripts.
 */
function sharks_register_scripts()
{
    wp_enqueue_script('jquery', get_stylesheet_directory_uri() . '/assets/js/jquery.min.js', ['jquery'], [], true);
    wp_enqueue_script('main-js', get_stylesheet_directory_uri() . '/assets/main.js', ['jquery'], [], true);
    wp_localize_script('main-js', 'variables',
        array(
            'ajax_url' => rest_url(),
        )
    );
}

add_action('init', 'sharks_register_scripts');
/**
 * Register and Enqueue Styles.
 */
function sharks_register_styles()
{
    wp_enqueue_style('reset-css', 'https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css');
    wp_enqueue_style('style-css', get_stylesheet_directory_uri() . '/assets/css/style.css');
}

add_action('init', 'sharks_register_styles');


add_action('init', 'cpt_cities');
function cpt_cities()
{
    register_post_type('cities', array(
        'labels' => array(
            'name' => 'Города',
            'singular_name' => 'Город',
            'add_new' => 'Добавить город',
            'edit_item' => 'Редактировать',
            'view_item' => 'Просмотреть',
            'menu_name' => 'Города'

        ),
        'public' => false,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array(
            // Slug should be plural and L10n ready.
            'slug' => _x('cities', 'CPT permalink slug', 'cities'),
            'with_front' => false,
        ),

        // Add support for the new block based editor (Gutenberg) by exposing this CPT via the REST API.
        'show_in_rest' => true,

        'capability_type' => 'post',
        'has_archive' => false,
        'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'custom-fields', 'page-attributes',)
    ));
}

add_action('init', 'rest_api_init');
add_action('rest_api_init', function () {
    new RestApiActions();
});