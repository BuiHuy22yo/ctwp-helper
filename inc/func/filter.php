<?php
/**
 * Created by groot.
 * User: groot
 * Date: 1/20/2022
 * Time: 10:30 AM
 */

if(!function_exists('admin_add_body_classes')){
    add_filter('admin_body_class', 'admin_add_body_classes');
    function admin_add_body_classes($classes) {
        $classes .= 'ctwp-helper';
        return $classes;
    }
}