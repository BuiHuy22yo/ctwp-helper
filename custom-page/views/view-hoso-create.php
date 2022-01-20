<?php
$get_current_user = wp_get_current_user();
$get_role_current = $get_current_user->roles[0];
$bm_so_cmt = $_GET['so_cmt'];
$bm_so_bh = $_GET['so_bh'];
$ngay_sinh = $_GET['ngay_sinh'];

$args_my_query = array(
    'post_type' => 'benhnhan',
);

$args_my_query['meta_query'] = array(
    'relation' => 'AND',
    array(
        'key' => 'bm-so-cmt',
        'value' => $bm_so_cmt,
        'compare' => 'LIKE',
    ),
    array(
        'key' => 'bm-so-bh',
        'value' => $bm_so_bh,
        'compare' => 'LIKE',
    ),

);
$my_query = new WP_Query($args_my_query);
if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post();
    $bnid = get_the_ID();
endwhile; endif;
if ($bnid) {
    $bm_so_hd_bh = get_post_meta($bnid, 'bm-so-hd-bh', 'ctwp-helper');
    $bm_ten_chu_hd = get_post_meta($bnid, 'bm-ten-chu-hd', 'ctwp-helper');
    $bm_ho_ten = get_post_meta($bnid, 'bm-ho-ten', 'ctwp-helper');
}
?>
<?php
if ($get_role_current != 'nv_bao_minh') { ?>
    <div class="loading"><span></span></div
    <div class="wrap">
        <div class="fft-management">
            <h1>
                <i class="fas fa-plus-square"></i>
                <?php echo esc_html__('Khai báo/ Bổ sung hồ sơ', 'ctwp-helper'); ?>
            </h1>
            <div class="pure-g fft-management-BackBtnBox">
                <form>
                    <button class="pure-button pure-button-primary" type="submit">
                        <i class="fas fa-angle-double-left"></i>
                        <?php echo esc_html__('Quay Lại', 'ctwp-helper'); ?>
                    </button>
                    <input type="hidden" name="page" value="hoso"/>
                    <input type="hidden" name="type" value="create"/>
                </form>
            </div>
            <form class="pure-form pure-form-aligned create-application-form" method="post" style="text-align: left">
                <div class="pure-g">
                    <div class="pure-u-5-5">
                        <table class="pure-table pure-table-bordered fft-management-StatusView">
                            <tbody>
                            <tr>
                                <th style="width: 20%;">
                                    <?php echo esc_html__('Họ Tên', 'ctwp-helper'); ?>
                                </th>
                                <td>
                                    <input style="width: 100%;" type="text" name="bm-ho-ten" class=""
                                           value="<?php echo trim($bm_ho_ten); ?>" readonly/>
                                </td>
                                <th style="width: 20%;">
                                    <?php echo esc_html__('Ngày sinh', 'ctwp-helper'); ?>
                                </th>
                                <td>
                                    <input style="width: 100%;"
                                           type="<?php if (!empty($ngay_sinh)) {
                                               echo 'date';
                                           } else {
                                               echo 'text';
                                           } ?>" readonly name="ngay_sinh"
                                           value="<?php echo $ngay_sinh; ?>"/>
                                </td>
                            </tr>
                            <tr>
                                <th style="width: 20%;">
                                    <?php echo esc_html__('Số CCCD', 'ctwp-helper'); ?>
                                </th>
                                <td>
                                    <input style="width: 100%;" type="number" name="bm-so-cmt"
                                           value="<?php echo $bm_so_cmt; ?>" readonly/>
                                </td>
                                <th style="width: 20%;">
                                    <?php echo esc_html__('Số thẻ BH', 'ctwp-helper'); ?>
                                </th>
                                <td>
                                    <input style="width: 100%;" type="text" name="bm-so-bh"
                                           value="<?php echo trim($bm_so_bh); ?>" readonly/>
                                </td>
                            </tr>
                            <tr>
                                <th style="width: 20%;">
                                    <?php echo esc_html__('Số hợp đồng', 'ctwp-helper'); ?>
                                </th>
                                <td>
                                    <input style="width: 100%;" type="text" name="bm-so-hd-bh"
                                           value="<?php echo $bm_so_hd_bh; ?>" readonly/>
                                </td>
                                <th style="width: 20%;">
                                    <?php echo esc_html__('Tên chủ HĐ', 'ctwp-helper'); ?>
                                </th>
                                <td>
                                    <input style="width: 100%;" type="text" min="1" name="bm-ten-chu-hd"
                                           value="<?php echo $bm_ten_chu_hd; ?>" readonly/>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <table class="pure-table pure-table-bordered fft-management-StatusView">
                            <tbody>
                            <?php $custom_field = ctwp_get_option('custom_fields');
                            if (!empty($custom_field)) { ?>
                                <?php foreach ($custom_field as $field) {
                                    $label_field = ctwp_get_value_in_array($field, 'label_field', 'Loại tài liệu');
                                    $label_field_name = huy_vn_to_str($label_field) ?>
                                    <tr>
                                        <th style="width: 20%">
                                            <?php echo $label_field; ?>
                                        </th>
                                        <td>
                                            <?php $select_type_field = ctwp_get_value_in_array($field, 'select_type_field');
                                            if ($select_type_field == 'file') { ?>
                                                <input type="file" class="trust-create-file"
                                                       accept="application/pdf,application/vnd.ms-excel,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                                                <input type="hidden" name="<?php echo $label_field_name ?>"
                                                       class="trust-create-file-attachment">
                                                <input type="submit" class="pure-button trust-create-upload"
                                                       value="Save">
                                            <?php } else if ($select_type_field == 'text') { ?>
                                                <input style="width: 100%;" type="text" class="trust-create-file-text"
                                                       name="<?php echo $label_field_name ?>">
                                            <?php } else if ($select_type_field == 'textarea') { ?>
                                                <textarea style="width: 100%;" cols="100" rows="5"
                                                          class="trust-create-file-text"
                                                          name="<?php echo $label_field_name ?>"></textarea>
                                            <?php } else if ($select_type_field == 'date') { ?>
                                                <input type="date"
                                                       value="<?php echo isset($_GET['date']) ? esc_attr($_GET['date']) : ''; ?>"
                                                       class="datepicker" name="<?php echo $label_field_name ?>"
                                            <?php } else if ($select_type_field == 'image') { ?>
                                                <input type="file" class="trust-create-file"
                                                       accept="image/png, image/jpeg">
                                                <input type="hidden" name="<?php echo $label_field_name ?>"
                                                       class="trust-create-file-attachment">
                                                <input type="submit" class="pure-button trust-create-upload-image"
                                                       value="Save">
                                            <?php } else if ($select_type_field == 'number') { ?>
                                                <input type="number" class="trust-create-file-text"
                                                       name="<?php echo $label_field_name ?>" min="1">
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php }
                            } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="fft-management-EditCancelBtnBox pure-g " style="justify-content: center">
                    <button type="submit" style="margin-right: 20px;width: 112px"
                            class="pure-button pure-button-primary ">
                        <i class="fas fa-sync"></i>
                        <?php echo esc_html__('Hủy', 'ctwp-helper'); ?></button>
                    <button type="submit" class="pure-button pure-button-primary create-application-submit "
                            data-url="<?php echo esc_url(admin_url('admin.php?page=hoso')); ?>">
                        <i class="fas fa-save"></i>
                        <?php echo esc_html__(' Hoàn Thành', 'ctwp-helper'); ?>
                    </button>
                    <input type="hidden" name="action" value="create_application_be"/>

                </div>
            </form>
        </div>
    </div>
<?php } else { ?>
    <div id="error-page text-center">
        <div class="wp-die-message" style="text-align: center">
            <h1>Xin lỗi, bạn không được phép vào trang này.</h1>
        </div>
    </div>
<?php }
?>
