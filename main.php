<?php
/*
Plugin Name: 		CTWP Helper
Plugin URI:
Description:		Plugin support ctwp theme
Version: 			1.0.0
Author: 			Groot
Author URI:
*/

if (!defined('ABSPATH')) {
    return;
}

if (!class_exists('CTWP_Helper')) {
    class CTWP_Helper
    {
        public function __construct()
        {
            $this->define();
            $this->load_helper();
            $this->load_custom_page();

            add_action('admin_menu', array($this, 'add_menu_page'), 1);
            add_action('admin_menu', array($this, 'remove_submenu_page'));

            if (is_admin()) {
                add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts'));
            }

            if ($this->ctwp_is_plugin_active('elementor/elementor.php')) {

                add_action('elementor/frontend/after_register_styles', [$this, 'ctwp_elements_register_styles']);
                add_action('elementor/frontend/after_register_scripts', [$this, 'ctwp_elements_register_scripts']);
                add_action('elementor/frontend/after_enqueue_styles', [$this, 'ctwp_elements_enqueue_styles']);
                add_action('elementor/frontend/after_enqueue_scripts', [$this, 'ctwp_elements_enqueue_scripts']);
                add_action('elementor/elements/categories_registered', [$this, 'ctwp_add_elementor_widget_categories']);
                add_action('elementor/widgets/widgets_registered', [$this, 'ctwp_includes_widget_elements']);
//                add_action('wp_ajax_ctwp_product_tabs_by_taxonomy', array($this, 'ctwp_product_tabs_by_taxonomy'));
//                add_action('wp_ajax_nopriv_wp_ajax_ctwp_product_tabs_by_taxonomy', array($this, 'ctwp_product_tabs_by_taxonomy'));
            }
            $this->ctwp_include_function_plugins();
        }

        // define
        public function define()
        {
            define('CTWP_HELPER_DIR_PATH', plugin_dir_path(__FILE__));
            define('CTWP_HELPER_DIR_URL', plugin_dir_url(__FILE__));

            define('CTWP_OPTIONS', '_ctwp_options');
            define('CTWP_PJ_CUSTOM_USER_OPTIONS', '_ctwp_custom_user_options');
            define('CTWP_METABOX_BENHNHAN', '_ctwp_benhnhan_options');
            define('CTWP_METABOX_HOSO', '_ctwp_hoso_options');


            define('CTWP_ELEMENTS_VERSION', '1.0.0');
            define('CTWP_ELEMENTS_PATH', plugin_dir_path(__FILE__));
            define('CTWP_ELEMENTS_NAME', plugin_basename(__FILE__));
            define('CTWP_ELEMENTS_URL', plugin_dir_url(__FILE__));
        }

        // load helper.
        public function load_helper()
        {
            require_once CTWP_HELPER_DIR_PATH . '/inc/func/base.php';
            require_once CTWP_HELPER_DIR_PATH . '/inc/func/post-type.php';
            require_once CTWP_HELPER_DIR_PATH . '/inc/func/helpers.php';
            require_once CTWP_HELPER_DIR_PATH . '/inc/func/hooks.php';
            require_once CTWP_HELPER_DIR_PATH . '/inc/func/filter.php';
        }

        public function add_menu_page()
        {
            add_menu_page(
                esc_html__('Quản Lý', 'ctwp-helper'),
                esc_html__('Quản Lý', 'ctwp-helper'),
                'edit_posts',
                'quanly',
                array($this, 'callback_menu'),
                'dashicons-hammer'
            );
        }

        public function callback_menu()
        {

        }

        public function remove_submenu_page()
        {
            remove_submenu_page('quanly', 'quanly');
        }

        public function load_custom_page()
        {
            require_once CTWP_HELPER_DIR_PATH . '/custom-page/classes/class-database-structure.php';
            require_once CTWP_HELPER_DIR_PATH . '/custom-page/classes/class-submenu-page.php';
            require_once CTWP_HELPER_DIR_PATH . '/custom-page/classes/class-hoso.php';
        }

        public function enqueue_admin_scripts()
        {

            wp_enqueue_style('fa5', 'https://use.fontawesome.com/releases/v5.13.0/css/all.css', array(), '5.13.0', 'all');
            wp_enqueue_style('ctwp-lib-bootstrap', CTWP_HELPER_DIR_URL . 'assets/build/library/bootstrap/bootstrap.min.css', array(), false);
            wp_enqueue_style('ctwp-style-main', CTWP_HELPER_DIR_URL . 'assets/build/css/main.css', array(), false);


            wp_enqueue_script('ctwp-script-main', CTWP_HELPER_DIR_URL . '/assets/build/js/main.js', array('jquery'), false, true);
            wp_localize_script('ctwp-script-main', 'ctwp_script_main', array(
                'ajax_url' => admin_url('admin-ajax.php')
            ));

//            wp_enqueue_style('style-admin',CTWP_HELPER_DIR_URL.'assets/css/style-admin.css', false, "1.0.0");
        }


        public function ctwp_include_function_plugins()
        {

            if (!function_exists('is_plugin_active')) {
                require_once(ABSPATH . 'wp-admin/includes/plugin.php');
            }

            // require_once CTWP_ELEMENTS_PATH . 'inc/widgets/class-ctwp-widget-accordion.php';
            // require_once CTWP_ELEMENTS_PATH . 'inc/widgets/class-ctwp-widget-contact-advanced.php';
            // require_once CTWP_ELEMENTS_PATH . 'inc/widgets/class-ctwp-widget-recent-blog.php';
            // require_once CTWP_ELEMENTS_PATH . 'inc/widgets/class-ctwp-widget-social-advanced.php';
        }

        public function ctwp_includes_widget_elements()
        {
            require_once CTWP_ELEMENTS_PATH . 'inc/modules/testimonials-swiper.php';
        }

        public function ctwp_add_elementor_widget_categories($elements_manager)
        {

            $elements_manager->add_category(
                'ctwp-elements',
                [
                    'title' => __('Ctwp Elements', 'ctwp-elements'),
                    'icon' => 'fa fa-plug',
                ]
            );
        }

        public function ctwp_elements_register_styles()
        {
//            wp_register_style('ctwp-posts-elementor', CTWP_ELEMENTS_URL . 'assets/css/main.css', array(), '1.0.0', 'all');
            wp_register_style('ctwp-posts-elementor', CTWP_ELEMENTS_URL . 'assets/css/main.css', array(), '1.0.0', 'all');
        }

        public function ctwp_elements_register_scripts()
        {
            wp_register_script('ctwp-posts-elementor', CTWP_ELEMENTS_URL . 'assets/js/main.js', array('jquery', 'swiper'), '1.0.0', 'all');
        }

        public function ctwp_elements_enqueue_styles()
        {
            wp_enqueue_style('ctwp-posts-elementor');
        }

        public function ctwp_elements_enqueue_scripts()
        {
            wp_enqueue_script('ctwp-posts-elementor');
        }

        public function ctwp_is_plugin_active($plugin)
        {
            return in_array($plugin, (array)get_option('active_plugins', array()));
        }

        public function ctwp_product_tabs_by_taxonomy()
        {
            if (!empty($_POST)) {
                $taxonomy = $_POST['taxonomy'];
                $postID = $_POST['postID'];
                $elementID = $_POST['elementID'];
                $elementType = $_POST['elementType'];
                $get_settings = new \ThzelGetElementSettings($postID, $elementID, $elementType);
                $settings = $get_settings->get_settings();
                if ($elementType == 'ctwp-product-tabs-swiper') {
                    echo ctwp_template($settings, $taxonomy, true);
                } else {
                    echo ctwp_template($settings, $taxonomy, false);
                }

            }
            die();
        }
    }

    new CTWP_Helper();
}