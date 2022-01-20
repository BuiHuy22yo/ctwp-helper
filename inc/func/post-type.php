<?php
/**
 * Created by groot.
 * User: groot
 * Date: 1/20/2022
 * Time: 10:30 AM
 */


/** 
 * 
 */
if (!function_exists('ctwp_helper_create_postype_hoso')) {
    function ctwp_helper_create_postype_hoso()
    {
        $args = array(
            'labels' => array(
                'name' => esc_html__('Hồ Sơ', 'ctwp-helper'),
                'singular_name' => esc_html__('Hồ Sơ', 'ctwp-helper'),
                'add_new_item' => esc_html__('Add Hồ Sơ', 'ctwp-helper'),
                'add_new' => esc_html__('Add Hồ Sơ', 'ctwp-helper'),
            ),
            'public' => true,
            'has_archive' => false,
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'supports' => array('title'),
            'rewrite' => array(
                'slug' => 'hoso',
                'with_front' => true,
                'feeds' => true,
                'pages' => true,
            ),
        );

        register_post_type('hoso', $args);
    }

    add_action('init', 'ctwp_helper_create_postype_hoso');
}