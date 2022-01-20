<?php

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

Class CTWP_Submenu_Page_HoSo extends CTWP_Submenu_Page
{

    /**
     * Request data
     *
     * @access public
     * @var array
     */
    public $request_data = array();


    /*
     * Method that initializes the class
     *
     */
    public function init()
    {
        $this->request_data = $_REQUEST;

        add_action('ctwp_submenu_page_enqueue_admin_scripts_' . $this->menu_slug, array($this, 'admin_scripts'));

        // Hook the output method to the parent's class action for output instead of overwriting the
        // output method
        add_action('ctwp_output_content_submenu_page_' . $this->menu_slug, array(
            $this,
            'output'
        ));

    }

    public function check_role()
    {

    }

    public function admin_scripts()
    {

    }

    /*
     * Method to output content in the custom page
     *
     */
    public function output()
    {

        ob_start();

        if (isset($_GET['type']) && $_GET['type'] == 'detail') {
            if (isset($_GET['action']) && $_GET['action'] == 'edit') {
                include_once CTWP_HELPER_DIR_PATH . '/custom-page/views/view-page-hoso-details-edit.php';
            } else if (isset($_GET['action']) && $_GET['action'] == 'xuly') {
                include_once CTWP_HELPER_DIR_PATH . '/custom-page/views/view-page-hoso-details-xuly.php';
            } else if (isset($_GET['action']) && $_GET['action'] == 'detail-log-hoso'){
				include_once CTWP_HELPER_DIR_PATH . '/custom-page/views/view-detail-log.php';
            }
            else{
				include_once CTWP_HELPER_DIR_PATH . '/custom-page/views/view-page-hoso-details.php';
			}
        } else if (isset($_GET['type']) && $_GET['type'] == 'create') {
            if (isset($_GET['action']) && $_GET['action'] == 'create') {
                include_once CTWP_HELPER_DIR_PATH . '/custom-page/views/view-hoso-create.php';
            } else {
                include_once CTWP_HELPER_DIR_PATH . '/custom-page/views/view-hoso-ttkh.php';
            }
        } else {
            include_once CTWP_HELPER_DIR_PATH . '/custom-page/views/view-hoso-list.php';
        }
        $subpage_content = ob_get_contents();

        ob_clean();

        echo apply_filters('ctwp_submenu_page_application_output', $subpage_content);
    }

}

$ctwp_submenu_page_hoso = new CTWP_Submenu_Page_HoSo(
    'quanly',
    __('Hồ Sơ', 'ctwp-helper'),
    __('Hồ Sơ', 'ctwp-helper'),
    'manage_options',
    'hoso');
$ctwp_submenu_page_hoso->init();



if (!function_exists('fff_application_app_generate_pagination')) {
    function fff_application_app_generate_pagination($count, $per_page, $base_url)
    {
        $html = array();
//        var_dump($base_url);

        if ($count / $per_page > 1) {
            $curent_page = isset($_GET['paged']) ? $_GET['paged'] : 1;
            $max_page = round($count / $per_page);

            if (round($count / $per_page) < round($count / $per_page, 1)) {
                $max_page = $max_page + 1;
            }

            $prev_page = $curent_page - 1;
            $next_page = $curent_page + 1;
            $last_link = $base_url . '&paged=' . $max_page;

            if ($next_page > $max_page) {
                $next_link = $last_link;
            } else {
                $next_link = $base_url . '&paged=' . $next_page;
            }

            if ($prev_page == 1) {
                $prev_link = $base_url;
            } else {
                $prev_link = $base_url . '&paged=' . $prev_page;
            }

            if ($curent_page == 1) {
                $html[] = '<span class="tablenav-pages-navspan button disabled" aria-hidden="true">«</span>';
                $html[] = '<span class="tablenav-pages-navspan button disabled" aria-hidden="true">‹</span>';
            } else {
                $html[] = '<a class="first-page button" href="' . esc_url($base_url) . '"><span class="screen-reader-text"></span><span aria-hidden="true">«</span></a>';
                $html[] = '<a class="prev-page button" href="' . esc_url($prev_link) . '"><span class="screen-reader-text"></span><span aria-hidden="true">‹</span></a>';
            }

            $html[] = '<span class="screen-reader-text">' . esc_html__('Current Page', 'fftrust-management') . '</span>';
            $html[] = '<span id="table-paging" class="paging-input">';
            $html[] = '<span class="tablenav-paging-text">' . $curent_page . esc_html__(' of ', 'fftrust-management') . ' <span class="total-pages">' . $max_page . '</span></span>';
            $html[] = '</span>';

            if (($curent_page) == $max_page) {
                $html[] = '<span class="tablenav-pages-navspan button disabled" aria-hidden="true">»</span>';
                $html[] = '<span class="tablenav-pages-navspan button disabled" aria-hidden="true">›</span>';
            } else {
                $html[] = '<a class="next-page button" href="' . esc_url($next_link) . '"><span class="screen-reader-text"></span><span aria-hidden="true">›</span></a>';
                $html[] = '<a class="last-page button" href="' . esc_url($last_link) . '"><span class="screen-reader-text"></span><span aria-hidden="true">»</span></a>';
            }
        }

        return implode(' ', $html);
    }
}

if (!function_exists('fff_trust_save_image')) {
    function fff_trust_save_image()
    {
        $file = $_FILES['main_image'];
        $file_return = wp_handle_upload($file, array('test_form' => false));

        if (isset($file_return['error']) || isset($file_return['upload_error_handler'])) {
            return false;
        } else {
            $filename = $file_return['file'];
            $attachment = array(
                'post_mime_type' => $file_return['type'],
                'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
                'post_content' => '',
                'post_status' => 'inherit',
                'guid' => $file_return['url']
            );

            $attachment_id = wp_insert_attachment($attachment, $file_return['url']);
            $attachment_data = wp_generate_attachment_metadata($attachment_id, $filename);
            wp_update_attachment_metadata($attachment_id, $attachment_data);

            if (0 < intval($attachment_id)) {
                echo json_encode($attachment_id);
                exit;
            }
        }
        return false;
    }

    add_action('wp_ajax_fff_trust_save_image', 'fff_trust_save_image');
    add_action('wp_ajax_nopriv_fff_trust_save_image', 'fff_trust_save_image');
}

if (!function_exists('fff_application_delete_app_ajax')) {
    function fff_application_delete_app_ajax()
    {
        $appids = $_POST['appid'];
        foreach ($appids as $appid) {
            wp_delete_post($appid);
            delete_post_meta($appid, 'trang_thai');
            delete_post_meta($appid, 'bm-ho-ten');
            delete_post_meta($appid, 'bm-so-cmt');
            delete_post_meta($appid, 'bm-so-hd-bh');
            delete_post_meta($appid, 'bm-ten-chu-hd');
            delete_post_meta($appid, 'bm-so-bh');
            delete_post_meta($appid, 'ngay_sinh');
            delete_post_meta($appid, 'bm-so-hd-bh');
            delete_post_meta($appid, 'bm-ten-chu-hd');
            if (!empty($custom_field = ctwp_get_option('custom_fields'))) {
                foreach ($custom_field as $field) {
                    $label_field = ctwp_get_value_in_array($field, 'label_field', 'Loại tài liệu');
                    $label_field_id = huy_vn_to_str($label_field);
                    delete_post_meta($appid, $label_field_id);
                }
            }
        }
        echo json_encode(1);
        exit;
    }

    add_action('wp_ajax_fff_application_delete_app_ajax', 'fff_application_delete_app_ajax');
    add_action('wp_ajax_nopriv_fff_application_delete_app_ajax', 'fff_application_delete_app_ajax');
}

if (!function_exists('ctwp_hepler_check_ttkh_ajax')) {
    function ctwp_hepler_check_ttkh_ajax()
    {
        if (empty($_POST["bm-so-bh"]) || empty($_POST["bm-so-cmt"])) {
            echo json_encode(98);
            exit;
        } else {
            $check = array(
                'post_type' => 'benhnhan',
                'orderby' => 'ID',
                'order' => 'DESC',
            );
            $check['meta_query'] = array(
                'relation' => 'AND',
                array(
                    'key' => 'bm-so-cmt',
                    'value' => $_POST["bm-so-cmt"],
                    'compare' => 'LIKE',
                ),
                array(
                    'key' => 'bm-so-bh',
                    'value' => $_POST["bm-so-bh"],
                    'compare' => '=',
                ),
            );
            $my_query = new WP_Query($check);
            if ($my_query->have_posts()) {
                while ($my_query->have_posts()) : $my_query->the_post();
                    $bnid = get_the_ID();
                endwhile;
            } else {
                echo json_encode(97);
                exit;
            }
            if ($bnid) {
                $bm_ho_ten = get_post_meta($bnid, 'bm-ho-ten', 'ctwp-helper');
            }

            if (trim($bm_ho_ten) == trim($_POST["bm-ho-ten"])) {
                echo json_encode(1);
                exit;
            } else if (empty($_POST["bm-ho-ten"])) {
                echo json_encode(95);
                exit;
            } else {
                echo json_encode(96);
                exit;
            }
        }
    }

    add_action('wp_ajax_ctwp_hepler_check_ttkh_ajax', 'ctwp_hepler_check_ttkh_ajax');
    add_action('wp_ajax_nopriv_ctwp_hepler_check_ttkh_ajax', 'ctwp_hepler_check_ttkh_ajax');
}

if (!function_exists('ctwp_hepler_create_application_be')) {
    function ctwp_hepler_create_application_be()
    {
        $numbers = [];
        try {
            if (!empty($custom_field = ctwp_get_option('custom_fields'))) {

                $flag = false;
                $a = 0;
                $b = 0;
                foreach ($custom_field as $key => $field) {
                    $select_type_field = ctwp_get_value_in_array($field, 'select_type_field');
                    $label_field = ctwp_get_value_in_array($field, 'label_field', 'Loại tài liệu');
                    $label_field_id = huy_vn_to_str($label_field);
                    $numbers[$key] = array($label_field, $_POST[$label_field_id]);
                    if ($select_type_field == 'number') {
                        $a++;
                        if ($_POST[$label_field_id] > 0 || empty($_POST[$label_field_id])) {
                            $b++;
                        }
                    }
                }
                if ($a == $b && $a != 0 && $b != 0) {
                    $flag = true;
                }
            } else {
                $flag = true;
            }
            if ($flag) {
                $my_post = array(
                    'post_title' => $_POST['bm-ho-ten'],
                    'post_status' => 'publish',
                    'post_type' => 'hoso'
                );
                $post_id = wp_insert_post($my_post);
                add_post_meta($post_id, 'trang_thai', '1');
                add_post_meta($post_id, 'bm-ho-ten', $_POST['bm-ho-ten']);
                add_post_meta($post_id, 'bm-so-cmt', $_POST['bm-so-cmt']);
                add_post_meta($post_id, 'bm-so-hd-bh', $_POST['bm-so-hd-bh']);
                add_post_meta($post_id, 'bm-ten-chu-hd', $_POST['bm-ten-chu-hd']);
                add_post_meta($post_id, 'bm-so-bh', $_POST['bm-so-bh']);
                add_post_meta($post_id, 'ngay_sinh', $_POST['ngay_sinh']);
                add_post_meta($post_id, 'bm-so-hd-bh', $_POST['bm-so-hd-bh']);
                add_post_meta($post_id, 'bm-ten-chu-hd', $_POST['bm-ten-chu-hd']);
                if (!empty($custom_field = ctwp_get_option('custom_fields'))) {
                    foreach ($custom_field as $field) {
                        $label_field = ctwp_get_value_in_array($field, 'label_field', 'Loại tài liệu');
                        $label_field_id = huy_vn_to_str($label_field);
                        if (!empty($_POST[$label_field_id])) {
                            add_post_meta($post_id, $label_field_id, $_POST[$label_field_id]);
                        }
                    }
                }
                echo json_encode(1);
                exit;
            } else {
                echo json_encode($numbers);
                exit;
            }
        } catch (Exception $ex) {
            echo json_encode(98);
            exit;
        }
    }

    add_action('wp_ajax_create_application_be', 'ctwp_hepler_create_application_be');
    add_action('wp_ajax_nopriv_create_application_be', 'ctwp_hepler_create_application_be');
}

if (!function_exists('ctwp_hepler_update_hoso')) {
    function ctwp_hepler_update_hoso()
    {
        $hosoid = $_POST['hosoid'];
        $numbers = [];
        try {
            if (!empty($custom_field = ctwp_get_option('custom_fields'))) {
                $flag = false;
                $a = 0;
                $b = 0;

                foreach ($custom_field as $key => $field) {
                    $select_type_field = ctwp_get_value_in_array($field, 'select_type_field');
                    $label_field = ctwp_get_value_in_array($field, 'label_field', 'Loại tài liệu');
                    $label_field_id = huy_vn_to_str($label_field);
                    $numbers[$key] = array($label_field, $_POST[$label_field_id]);
                    if ($select_type_field == 'number') {
                        $a++;
                        if (isset($_POST['so-tien-bh'])) {
                            if ($_POST[$label_field_id] > 0 && $_POST['so-tien-bh'] >= 0 && !empty($_POST['so-tien-bh']) || empty($_POST[$label_field_id])) {
                                $b++;
                            } else if (empty($_POST['so-tien-bh'])) {
                                echo json_encode(97);
                                exit;
                            } else if ($_POST['so-tien-bh'] < 0) {
                                echo json_encode(96);
                                exit;
                            }

                        } else {
                            if ($_POST[$label_field_id] > 0 || empty($_POST[$label_field_id])) {
                                $b++;
                            }
                        }
                    }
                }

                if ($a == $b && $a != 0 && $b != 0) {
                    $flag = true;
                }

            }
            if ($flag) {
                $my_post = array(
                    'post_title' => $_POST['bm-ho-ten'],
                    'post_status' => 'publish',
                    'post_type' => 'hoso',
                    'id' => $hosoid
                );
                wp_update_post($my_post);
                update_post_meta($hosoid, 'bm-ho-ten', $_POST['bm-ho-ten']);
                update_post_meta($hosoid, 'bm-so-cmt', $_POST['bm-so-cmt']);
                update_post_meta($hosoid, 'bm-so-hd-bh', $_POST['bm-so-hd-bh']);
                update_post_meta($hosoid, 'bm-ten-chu-hd', $_POST['bm-ten-chu-hd']);
                update_post_meta($hosoid, 'bm-so-bh', $_POST['bm-so-bh']);
                update_post_meta($hosoid, 'ngay_sinh', $_POST['ngay_sinh']);
                //log hoso
                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $get_current_user = wp_get_current_user();
                $id_user_log =  $get_current_user->display_name;
                //end log hoso
				//update trạng thái hồ sơ
				$get_current_user = wp_get_current_user();
				$get_role_current =  $get_current_user->roles[0];
				$trang_thai = get_post_meta($hosoid, 'trang_thai', true);
				if(($get_role_current == 'nv_benh_vien' && $trang_thai == 2)||$get_role_current == 'administrator'){
					update_post_meta($hosoid, 'trang_thai', 1);
					update_post_meta($hosoid, 'nguoi_xu_ly', get_current_user_id());
					update_post_meta($hosoid, 'ngay_xu_ly_hs', date("d/m/Y"));
				}


                $post_data = array(
                    'post_title' => '',
                    'post_content ' => '',	'post_status' => 'publish',
                    'post_type' => 'hoso-log',
                );
				$check_mn =$_POST['so-tien-bh'];
				$check_mn = str_replace(',','',$check_mn);
				$check_mn = str_replace(' ','',$check_mn);
                $post_log = wp_insert_post( $post_data );
                update_post_meta($post_log,'id_hoso_log',$hosoid);
                update_post_meta($post_log,'id_user_log',$id_user_log);
                update_post_meta($post_log,'time_log',date('Y/m/d H:i:s'));
                update_post_meta($post_log,'tien_bh_log',$check_mn);
				update_post_meta($post_log,'content_detail_log',$_POST['content-detail']);

                if (!empty($custom_field = ctwp_get_option('custom_fields'))) {
                    foreach ($custom_field as $field) {
                        $label_field = ctwp_get_value_in_array($field, 'label_field', 'Loại tài liệu');
                        $label_field_id = huy_vn_to_str($label_field);
                        $select_type_field = ctwp_get_value_in_array($field, 'select_type_field');
                        if ($select_type_field == 'file' || $select_type_field == 'image' ) {
                            if (!empty($_POST[$label_field_id])) {
                                update_post_meta($hosoid, $label_field_id, $_POST[$label_field_id]);
                            }
                        } else {
                            update_post_meta($hosoid, $label_field_id, $_POST[$label_field_id]);
                        }
                    }
                }
                if (!empty($_POST['trang_thai'])) {
                    update_post_meta($hosoid, 'trang_thai', $_POST['trang_thai']);
                }

                update_post_meta($hosoid, 'so_tien_bh', $check_mn);

                if (isset($_POST['content-detail'])) {
                    update_post_meta($hosoid, 'content_detail', $_POST['content-detail']);
                }

                if (isset($_POST['Download_KQ'])) {
                    update_post_meta($hosoid, 'Download_KQ', $_POST['Download_KQ']);
                }

                echo json_encode(1);
                exit;
            } else {
                echo json_encode($numbers);
                exit;
            }

        } catch (Exception $ex) {
            echo json_encode(98);
            exit;
        }
    }

    add_action('wp_ajax_update_hoso', 'ctwp_hepler_update_hoso');
    add_action('wp_ajax_nopriv_update_hoso', 'ctwp_hepler_update_hoso');
}
