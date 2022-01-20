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
			$this->load_library();
			$this->load_helper();
			$this->load_custom_page();

//			require_once CTWP_HELPER_DIR_PATH . 'vendor/autoload.php';

			add_action('init', array(__CLASS__, 'load_config'), 2);
			add_action('admin_menu', array($this, 'add_menu_page'), 1);
			add_action('admin_menu', array($this, 'remove_submenu_page'));

			if (is_admin()) {
				add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts'));
			}
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
		}

		// load library.
		public function load_library()
		{

		}

		// load config.
		public static function load_config()
		{

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
			wp_enqueue_style('fft_fontawesome-back-end', "https://use.fontawesome.com/releases/v5.12.0/css/all.css");
			wp_enqueue_style('ctwp_style_hoso', CTWP_HELPER_DIR_URL . 'assets/css/hoso.css', array(), false);


			wp_enqueue_script('hoso-script', CTWP_HELPER_DIR_URL . '/assets/js/hoso.js', array('jquery'), false, true);
			wp_localize_script('hoso-script', 'ctwp_script', array(
				'ajax_url'		=> admin_url('admin-ajax.php')
			));

//            wp_enqueue_style('style-admin',CTWP_HELPER_DIR_URL.'assets/css/style-admin.css', false, "1.0.0");
		}
	}

	new CTWP_Helper();
}