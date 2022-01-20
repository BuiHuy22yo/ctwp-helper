<?php
/**
 * Created by vagrant.
 * User: vagrant
 * Date: 5/21/2021
 * Time: 8:58 AM
 */
$current_user_id = get_current_user_id();
$current_user_meta = get_user_meta($current_user_id, 'organization_admin', true);
$get_current_user = wp_get_current_user();
$get_role_current = $get_current_user->roles[0];
?>


<div class="loading"><span></span></div>
<div class="wrap">

    <div class="fft-management">
        <h1>
            <i class="fas fa-list-alt"></i>
            <?php echo esc_html__('Danh Sách Hồ Sơ', 'ctwp-helper'); ?>
        </h1>
        <div class="fft-management-FilterBox pure-g">
            <div class="grids-unit-bar pure-u-1">
                <form class="pure-form" method="post">
                    <fieldset>
                        <?php
                        if ($get_role_current != 'nv_benh_vien' && $get_role_current != 'nv_bao_minh') { ?>
                            <select name="benhvien" style="margin-right:15px;width: 15%;">
                                <option value=""><?php echo esc_html__('Bệnh viện', 'ctwp-helper'); ?></option>
                                <?php $organizations = ctwp_get_option('organization');
                                if (!empty($organizations)) { ?>
                                    <?php foreach ($organizations as $organization) { ?>
                                        <option placeholder="Bệnh viện" <?php echo (isset($_POST['benhvien']) && $_POST['benhvien'] == $organization['text']) ? 'selected' : ''; ?>>
                                            <?php echo $organization['text'] ?>
                                        </option>
                                    <?php }
                                } ?>
                            </select>
                        <?php }
                        ?>
                        <input style="margin-right:15px; width: 15%;" type="search" name="bm-ho-ten" id="cancelxx"
                               value="<?php echo $_POST["bm-ho-ten"] ?>"
                               placeholder="Tên khách hàng"/>
                        <input style="margin-right:15px;width: 15%;" type="search" id="cancelxx1"
                               value="<?php echo $_POST["bm-so-bh"] ?>" min="1" name="bm-so-bh"
                               placeholder="Số thẻ BH"/>
                        <select style="margin-right:15px;width: 15%;" name="trang_thai">
                            <option value=""><?php echo esc_html__('Trạng thái', 'ctwp-helper'); ?></option>

                            <option value="1"<?php echo (isset($_POST['trang_thai']) && $_POST['trang_thai'] == 1) ? 'selected' : ''; ?>>
                                <?php echo esc_html__('Tiếp nhận', 'ctwp-helper'); ?></option>

                            <option value="2"<?php echo (isset($_POST['trang_thai']) && $_POST['trang_thai'] == 2) ? 'selected' : ''; ?>>
                                <?php echo esc_html__('Bổ sung hồ sơ', 'ctwp-helper'); ?></option>

                            <option value="3"<?php echo (isset($_POST['trang_thai']) && $_POST['trang_thai'] == 3) ? 'selected' : ''; ?>>
                                <?php echo esc_html__('Đã duyệt', 'ctwp-helper'); ?></option>

                            <option value="4"<?php echo (isset($_POST['trang_thai']) && $_POST['trang_thai'] == 4) ? 'selected' : ''; ?>>
                                <?php echo esc_html__('Gửi hồ sơ giấy', 'ctwp-helper'); ?></option>

                            <option value="5"<?php echo (isset($_POST['trang_thai']) && $_POST['trang_thai'] == 5) ? 'selected' : ''; ?>>
                                <?php echo esc_html__('Yêu cầu b/s chứng từ', 'ctwp-helper'); ?></option>

                            <option value="6"<?php echo (isset($_POST['trang_thai']) && $_POST['trang_thai'] == 6) ? 'selected' : ''; ?>>
                                <?php echo esc_html__('Đã nhận đủ chứng từ', 'ctwp-helper'); ?></option>

                            <option value="7"<?php echo (isset($_POST['trang_thai']) && $_POST['trang_thai'] == 7) ? 'selected' : ''; ?>>
                                <?php echo esc_html__('Đã thanh toán', 'ctwp-helper'); ?></option>

                            <option value="99"<?php echo (isset($_POST['trang_thai']) && $_POST['trang_thai'] == 99) ? 'selected' : ''; ?>>
                                <?php echo esc_html__('Từ chối', 'ctwp-helper'); ?></option>

                        </select>
                        <select style="margin-right:15px;width: 15%; " name="nguoi_xu_ly"
                                style="width: 10%;margin: 0 10px;">
                            <option value="">Người xử lý</option>
                            <?php
                            $blogusers = get_users(array('fields' => array('display_name', 'id')));
                            foreach ($blogusers as $user) { ?>
                                <option
                                        value="<?php echo $user->id; ?>" <?php echo (isset($_POST['nguoi_xu_ly']) && $_POST['nguoi_xu_ly'] == $user->id) ? 'selected' : ''; ?>><?php echo $user->display_name ?></option>
                            <?php } ?>
                        </select>
                        <input class="pure-button pure-button-primary fas" type="submit"
                               value="<?php echo esc_html__('&#xf0b0; Tìm Kiếm', 'ctwp-helper'); ?>"/>
                        <input type="hidden" name="page" value="hoso"/>
                        <div style="margin-top: 10px;">
                            <label style="margin-right:15px;margin-left: 10.5%;"> <?php echo esc_html__('Từ ngày', 'ctwp-helper'); ?></label>
                            <input style="width: 15%;margin-right:20px;" placeholder="Từ ngày" type="date"
                                   name="tu_ngay" id="tu_ngay" value="<?php echo $_POST["tu_ngay"] ?>"/>
                            <label style="margin-right:15px;margin-left: 9.5%;"> <?php echo esc_html__('Đến ngày', 'ctwp-helper'); ?></label>
                            <input style="width: 15%;" placeholder="Đến ngày" type="date" name="den_ngay" id="den_ngay"
                                   value="<?php echo $_POST["den_ngay"] ?>"/>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
        <?php
        if ($get_role_current != 'nv_bao_minh') { ?>
            <div class="fft-management-CreateBtnBox pure-g">
                <form>
                    <input class="pure-button pure-button-primary fas" type="submit"
                           value="<?php echo esc_html__('&#xf055; Thêm Mới', 'ctwp-helper'); ?>"/>
                    <input type="hidden" name="page" value="hoso"/>
                    <input type="hidden" name="type" value="create"/>
                </form>
            </div>
        <?php }
        ?>
        <table class="pure-table fft-management-ListTable tableexportbm" id="tablehoso">
            <thead>
            <tr>
                <th>
                    <input type="checkbox" id="checkall" name="checkall" value="">
                </th>
                <th>
                    <?php echo esc_html__('Mã hồ sơ', 'ctwp-helper'); ?>
                </th>
                <th>
                    <?php echo esc_html__('Bệnh viện', 'ctwp-helper'); ?>
                </th>
                <th>
                    <?php echo esc_html__('Tên khách hàng', 'ctwp-helper'); ?>
                </th>
                <th>
                    <?php echo esc_html__('Số thẻ BH', 'ctwp-helper'); ?>
                </th>
                <th>
                    <?php echo esc_html__('Trạng thái', 'ctwp-helper'); ?>
                </th>
                <th>
                    <?php echo esc_html__('Ngày tạo', 'ctwp-helper'); ?>
                </th>
                <th>
                    <?php echo esc_html__('Ngày xử lý', 'ctwp-helper'); ?>
                </th>
                <th>
                    <?php echo esc_html__('Người xử lý', 'ctwp-helper'); ?>
                </th>

                <th class="_actionbtn">
                    <?php echo esc_html__('Thao Tác', 'ctwp-helper'); ?>
                </th>
            </tr>
            </thead>
            <tbody>
            <?php

            if ($get_role_current == 'administrator' || $get_role_current == 'quan_ly' || $get_role_current == 'nv_bao_minh') {
                $users['meta_query'] = array(
                    'relation' => 'AND',
                    array(
                        'key' => 'organization_admin',
                        'value' => $_POST["benhvien"],
                        'compare' => 'LIKE',
                    ),
                );
                $user_query = new WP_User_Query ($users);

                if (($user_query->get_results())) {
                    $id_user_author = array();
                    foreach ($user_query->get_results() as $user) {
                        $id_user_author[] = $user->ID;
                    }
                } else {
                    echo 'Không tìm thấy người dùng nào.';
                    exit();
                }
                $filter_default = array(
                    'relation' => 'AND',
                    array(
                        'key' => 'bm-ho-ten',
                        'value' => $_POST["bm-ho-ten"],
                        'compare' => 'LIKE',
                    ),
                    array(
                        'key' => 'bm-so-bh',
                        'value' => $_POST["bm-so-bh"],
                        'compare' => 'LIKE',
                    ),
                    array(
                        'key' => 'trang_thai',
                        'value' => $_POST["trang_thai"],
                        'compare' => 'LIKE',
                    ),
                );
                $filter_nxl = !empty($_POST["nguoi_xu_ly"]) ? $_POST["nguoi_xu_ly"] : '';
                if (!empty($filter_nxl)) {
                    $filter = array(
                        array(
                            'key' => 'nguoi_xu_ly',
                            'value' => $filter_nxl,
                            'compare' => 'LIKE',
                        )
                    );
                }
                $filter_default = !empty($filter) ? array_merge($filter_default, $filter) : $filter_default;
                $after = $_POST["tu_ngay"];
                $before = $_POST["den_ngay"];
                $max_num_pages = get_option('posts_per_page');
                $paged = isset($_GET['paged']) ? $_GET['paged'] : 1;
                $list = array(
                    'post_type' => 'hoso',
                    'paged' => $paged,
                    'posts_per_page' => $max_num_pages,
                    'author__in' => $id_user_author,
                    'date_query' => array(
                        'after' => $after,
                        'before' => $before,
                        'inclusive' => true,
                    ),
                    'meta_query' => $filter_default,
                );
            } else {
                $users['meta_query'] = array(
                    'relation' => 'AND',
                    array(
                        'key' => 'organization_admin',
                        'value' => $current_user_meta,
                        'compare' => 'LIKE',
                    ));
                $user_query = new WP_User_Query ($users);
                if (($user_query->get_results())) {
                    $id_user_author = array();
                    foreach ($user_query->get_results() as $user) {
                        $id_user_author[] = $user->ID;
                    }
                } else {
                    echo 'Không tìm thấy người dùng nào.';
                    exit();
                }
                $max_num_pages = get_option('posts_per_page');
                $paged = isset($_GET['paged']) ? $_GET['paged'] : 1;
                $list = array(
                    'post_type' => 'hoso',
                    'paged' => $paged,
                    'posts_per_page' => $max_num_pages,
                    'author__in' => $id_user_author
                );
                $list['meta_query'] = array(
                    'relation' => 'AND',
                    array(
                        'key' => 'bm-ho-ten',
                        'value' => $_POST["bm-ho-ten"],
                        'compare' => 'LIKE',
                    ),
                    array(
                        'key' => 'bm-so-bh',
                        'value' => $_POST["bm-so-bh"],
                        'compare' => 'LIKE',
                    ),
                    array(
                        'key' => 'trang_thai',
                        'value' => $_POST["trang_thai"],
                        'compare' => 'LIKE',
                    ),
                );
            }

            $total = 0;
            $stt_hs = 0;
            $my_query_list = new WP_Query($list);
            $total = $my_query_list->found_posts;
            if ($my_query_list->have_posts()) : while ($my_query_list->have_posts()) : $my_query_list->the_post();
                $stt_hs = $stt_hs + 1;
                ?>
                <tr>
                    <td>
                        <input type="checkbox" id="<?php echo $stt_hs ?>" name="checkiddr"
                               value="<?php echo get_the_ID() ?>">
                    </td>
                    <td style='mso-number-format:"\@"'>
                        <?php echo $id = get_the_ID() ?>
                    </td>
                    <td style='mso-number-format:"\@"'>
                        <?php $id_user = get_the_author_meta('ID');
                        echo $benhvien = get_user_meta($id_user, 'organization_admin', true)
                        ?>
                    </td>
                    <td style='mso-number-format:"\@"'>
                        <?php echo $ten_benh_nhan = get_post_meta(get_the_ID(), 'bm-ho-ten', true); ?>
                    </td>
                    <td style='mso-number-format:"\@"'>
                        <?php echo $so_the_BH = get_post_meta(get_the_ID(), 'bm-so-bh', true); ?>
                    </td>
                    <td style='mso-number-format:"\@"'>
                        <?php $trang_thai = get_post_meta(get_the_ID(), 'trang_thai', true);
                        if ($trang_thai == 1) {
                            echo esc_html__('Tiếp nhận');
                        } else if ($trang_thai == 2) {
                            echo esc_html__('Bổ sung hồ sơ');
                        } else if ($trang_thai == 3) {
                            echo esc_html__('Đã duyệt');
                        } else if ($trang_thai == 4) {
                            echo esc_html__('Gửi hồ sơ giấy');
                        } else if ($trang_thai == 5) {
                            echo esc_html__('Yêu cầu b/s chứng từ');
                        } else if ($trang_thai == 6) {
                            echo esc_html__('Đã nhận đủ chứng từ');
                        } else if ($trang_thai == 7) {
                            echo esc_html__('Đã thanh toán');
                        } else if ($trang_thai == 99) {
                            echo esc_html__('Từ chối');
                        }

                        ?>
                    </td>
                    <td style='mso-number-format:"\@"'>
                        <?php echo $ngay_tao = get_the_date() ?>
                    </td>
                    <td style='mso-number-format:"\@"'>
                        <?php
                        $ngay_xlhs = get_post_meta(get_the_ID(), 'ngay_xu_ly_hs', true);
                        if ($ngay_xlhs) {
                            echo $ngay_xlhs;
                        } ?>
                    </td>
                    <td style='mso-number-format:"\@"'>
                        <?php
                        $nxl = get_post_meta(get_the_ID(), 'nguoi_xu_ly', true);
                        if ($nxl) {
                            $user_info = get_userdata($nxl);
                            echo $user_info->user_login;
                        }
                        //						$id_user = get_the_author_meta('ID');
                        //                        echo $nguoi_xu_ly = get_user_meta($id_user, 'organization_admin', true)
                        ?>
                    </td>
                    <td>
                        <a target="_blank" href="<?php
                        $url = 'admin.php?page=hoso&type=detail&hosoid=' . $id;
                        echo admin_url($url); ?>">
                            <form>
                                <input class="pure-button pure-button-primary fas" type="submit" name=""
                                       value="<?php echo esc_html__('&#xf002; Xem', 'fftrust-management'); ?>"/>
                                <input type="hidden" name="page" value="hoso"/>
                                <input type="hidden" name="type" value="detail"/>
                                <input type="hidden" name="hosoid" value="<?php echo $id = get_the_ID() ?>"/>
                            </form>
                        </a>
                    </td>
                </tr>
            <?php endwhile;endif; ?>
            </tbody>
        </table>
            <div class="fft-management-EditCancelBtnBox pure-g update-bn-bottom">
				<?php
				if($get_role_current == 'administrator'){ ?>
                <button class="pure-button pure-button-active delete-app mg-right-vn" data-url="<?php echo esc_url(admin_url('admin.php?page=hoso')); ?>">
                    <i class="far fa-trash-alt"></i>
                    <?php echo esc_html__(' Xóa', 'ctwp-helper'); ?>
                </button>
				<?php }
				?>
                <button class="pure-button pure-button-active fas" id="stylebtn" type="button" onclick="fnExcelReport()"><?php echo esc_html__('&#xf0ab; Export', 'ctwp-helper'); ?></button>
            </div>

        <div class="fft-management-Pager tablenav bottom">
            <div class="tablenav-pages">
				<span class="displaying-num">
					<?php echo esc_attr($total) . esc_html__(' hồ sơ', 'fftrust-management'); ?>
				</span>
                <span class="pagination-links">
					<?php $current_url = admin_url('admin.php?page=hoso'); ?>
                    <?php echo fff_application_app_generate_pagination($total, $max_num_pages, $current_url); ?>
				</span>
            </div>
        </div>
    </div>
</div>


<script>
    function fnExcelReport() {
        var markedCheckbox = document.getElementsByName('checkiddr');
        var tt = [];
        for (var checkbox of markedCheckbox) {
            if (checkbox.checked)
                tt.push(checkbox.id);
        }
        if (tt.length == 0) {
            alert('Bạn chưa chọn dữ liệu để in');
        } else {
            var tab_text = "<table border='2px'><tr bgcolor='#87AFC6'>";
            var textRange;
            var j = 0;
            tab = document.getElementById('tablehoso'); // id of table

            tab_text = tab_text + tab.rows[0].innerHTML + "</tr>";
            for (j = 0; j < tt.length; j++) {
                m = tt[j];
                tab_text = tab_text + tab.rows[m].innerHTML + "</tr>";
            }
            tab_text = tab_text + "</table>";
            tab_text = tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
            tab_text = tab_text.replace(/<img[^>]*>/gi, ""); // remove if u want images in your table
            tab_text = tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params
            var ua = window.navigator.userAgent;
            var msie = ua.indexOf("MSIE ");

            if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
            {
                txtArea1.document.open("txt/html", "replace");
                txtArea1.document.write(tab_text);
                txtArea1.document.close();
                txtArea1.focus();
                sa = txtArea1.document.execCommand("SaveAs", true, "Member_Clinical_Profile.xlsx");
            } else {
                //new added by amit
                let a = $("<a />", {
                    href: 'data:application/vnd.ms-excel,' + encodeURIComponent(tab_text),
                    download: "Danh sách hồ sơ.xls"
                })
                    .appendTo("body")
                    .get(0)
                    .click();
            }
        }
    }
</script>