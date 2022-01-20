<?php
$nbcount_bn = get_option('posts_per_page');
$dembn = 0;
$stt_bn = 0;
$get_current_user = wp_get_current_user();
$get_role_current = $get_current_user->roles[0];
?>
<?php
if($get_role_current != 'nv_benh_vien'){ ?>
	<div class="benhvien-list">
		<div class="loading"><span></span></div>
		<div class="wrap">
			<div class="fft-management">
				<h1>
					<i class="fas fa-list-alt"></i>
					<?php echo esc_html__('Danh sách thay đổi hồ sơ', 'ctwp-helper'); ?>
				</h1>
				<div class="fft-management-FilterBox pure-g">
					<div class="grids-unit-bar pure-u-1">
						<form class="pure-form">
							<fieldset class="search-field-bn">
								<input type="search" name="id_hoso_log" id="cancelxx"
									   value="<?php echo isset($_GET['id_hoso_log']) ? esc_attr($_GET['id_hoso_log']) : ''; ?>"
									   placeholder="<?php echo esc_html__('Nhập ID hồ sơ', 'ctwp-helper'); ?>"/>
								<input class="pure-button pure-button-primary fas" type="submit"
									   value="<?php echo esc_html__('&#xf0b0; Tìm kiếm', 'ctwp-helper'); ?>"/>
								<input type="hidden" name="page" value="hoso_log"/>
							</fieldset>
						</form>
					</div>
				</div>
				<?php
					if($_GET['id_hoso_log']){ ?>
						<h1>
							<?php echo esc_html__('Thông tin hồ sơ', 'ctwp-helper'); ?>
						</h1>
						<table class="pure-table fft-management-ListTable table-change-hoso mg-bt-15" id="tabledata">
							<thead>
							<tr>
								<th>
									<?php echo esc_html__('Họ tên', 'ctwp-helper'); ?>
								</th>
								<th>
									<?php echo esc_html__('SCCCD', 'ctwp-helper'); ?>
								</th>
								<th>
									<?php echo esc_html__('Số HĐ', 'ctwp-helper'); ?>
								</th>
								<th>
									<?php echo esc_html__('Số thẻ BH', 'ctwp-helper'); ?>
								</th>
							</tr>
							</thead>
							<tbody>
								<tr>
										<td>
											<?php
											echo get_post_meta($_GET['id_hoso_log'], 'bm-ho-ten', true);
											?>
										</td>
										<td>
											<?php
											echo get_post_meta($_GET['id_hoso_log'], 'bm-so-cmt', true);
											?>
										</td>
										<td>
											<?php
											echo get_post_meta($_GET['id_hoso_log'], 'bm-so-hd-bh', true);
											?>
										</td>
										<td>
											<?php
											echo get_post_meta($_GET['id_hoso_log'], 'bm-so-bh', true);
											?>
										</td>
								</tr>
							</tbody>
						</table>
					<?php }
				?>
				<table class="pure-table fft-management-ListTable table-change-hoso" id="tabledata">
					<thead>
					<tr>
						<th>
							<?php echo esc_html__('ID hồ sơ', 'ctwp-helper'); ?>
						</th>
						<th>
							<?php echo esc_html__('Người thay đổi', 'ctwp-helper'); ?>
						</th>
						<th>
							<?php echo esc_html__('Thời gian thay đổi (Ngày giờ)', 'ctwp-helper'); ?>
						</th>
						<th>
							<?php echo esc_html__('Trạng thái', 'ctwp-helper'); ?>
						</th>
						<th>
							<?php echo esc_html__('Diễn giải chi tiết', 'ctwp-helper'); ?>
						</th>
						<th>
							<?php echo esc_html__('Số tiền phê duyệt BH', 'ctwp-helper'); ?>
						</th>
					</tr>
					</thead>
					<tbody>
					<?php
					$args_my_query = array(
						'post_type' => 'hoso-log',
						'orderby' => 'ID',
						'order' => 'DESC',
						'posts_per_page' => -1
					);
					$args_my_query['meta_query'] = array(
						'relation' => 'AND',
						array(
							'key' => 'id_hoso_log',
							'value' => $_GET['id_hoso_log'],
							'compare' => 'LIKE',

						),
					);
					$my_query = new WP_Query($args_my_query);
					if (isset($_GET['paged'])) {
						$stt1 = $_GET['paged'] * $nbcount_bn;
						$stt2 = ($_GET['paged'] - 1) * $nbcount_bn;
					} else {
						$stt1 = $nbcount_bn;
						$stt2 = 0;
					}
					if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post(); ?>
						<tr>
							<?php
							$dembn = $dembn + 1;
							if ($stt2 < $dembn && $dembn <= $stt1) { ?>
								<td>
									<?php echo get_post_meta(get_the_ID(), 'id_hoso_log', 'ctwp-helper'); ?>
								</td>
								<td>
									<?php echo get_post_meta(get_the_ID(), 'id_user_log', 'ctwp-helper'); ?>
								</td>
								<td>
									<?php echo date('d/m/Y H:i:s',strtotime(get_post_meta(get_the_ID(), 'time_log', 'ctwp-helper'))); ?>
								</td>
								<td>
									<?php $trang_thai = get_post_meta(get_post_meta(get_the_ID(), 'id_hoso_log', true), 'trang_thai', true);
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
									} ?>
								</td>
								<td>
									<?php echo $content_detail = get_post_meta(get_the_ID(), 'content_detail_log', true); ?>
								</td>
								<td>
									<?php $tien = get_post_meta(get_the_ID(), 'tien_bh_log', 'ctwp-helper');
									if($tien){
										echo number_format($tien,0,',',',');
									}
									?>
								</td>
							<?php }
							?>
						</tr>
						<?php $stt_bn = $stt_bn + 1;
					endwhile; endif;
					?>
					</tbody>
				</table>
				<div class="fft-management-Pager tablenav bottom">
					<div class="tablenav-pages tablenav-pages-mg">
				<span class="displaying-num">
					<?php echo esc_attr($stt_bn) . esc_html__(' items', 'ctwp-helper'); ?>
				</span>
						<span class="pagination-links">
					<?php $current_url = admin_url('admin.php?page=hoso_log'); ?>
					<?php echo fff_application_app_generate_pagination($stt_bn, $nbcount_bn, $current_url); ?>
				</span>
					</div>
				</div>
			</div>
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
