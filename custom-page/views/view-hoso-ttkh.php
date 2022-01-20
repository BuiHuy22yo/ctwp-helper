<?php
/**
 * Created by vagrant.
 * User: vagrant
 * Date: 5/21/2021
 * Time: 8:58 AM
 */
$get_current_user = wp_get_current_user();
$get_role_current =  $get_current_user->roles[0];
?>
<?php
	if($get_role_current != 'nv_bao_minh'){ ?>
		<div class="loading"><span></span></div>
		<div class="wrap">
			<div class="fft-management">
				<h1>
					<i class="fas fa-plus-square"></i>
					<?php echo esc_html__('Nhập thông tin khách hàng', 'ctwp-helper'); ?>
				</h1>
				<div class="pure-g fft-management-BackBtnBox">
					<form>
						<button class="pure-button pure-button-primary" type="submit">
							<i class="fas fa-angle-double-left"></i>
							<?php echo esc_html__('Quay Lại', 'ctwp-helper'); ?>
						</button>
						<input type="hidden" name="page" value="hoso"/>
					</form>
				</div>
				<form class="pure-form pure-form-aligned create-application-form " method="post">
					<div class="pure-g">
						<div class="pure-u-5-5">
							<table class="pure-table pure-table-bordered fft-management-StatusView">
								<tbody>
								<tr>
									<th style="width: 20%;">
										<?php echo esc_html__('Họ Tên', 'ctwp-helper'); ?>
									</th>
									<td>
										<input style="width: 100%;" type="text" id="check-bm-ho-ten" name="bm-ho-ten"  class=""  />
									</td>
									<th style="width: 20%;">
										<?php echo esc_html__('Ngày sinh', 'ctwp-helper'); ?>
									</th>
									<td>
										<input style="width: 100%;" type="date"  name="ngay_sinh" id="check_ngay_sinh" />
									</td>
								</tr>
								<tr>
									<th style="width: 20%;">
										<?php echo esc_html__('Số CCCD', 'ctwp-helper'); ?>
									</th>
									<td>
										<input style="width: 100%;" type="number"  id="check-bm-so-cmt" name="bm-so-cmt" min="1" />
									</td>
									<th style="width: 20%;">
										<?php echo esc_html__('Ảnh CCCD', 'ctwp-helper'); ?>
									</th>
									<td style="display:flex;">
										<input style="width: 100%;" type="file" class="trust-create-file"  accept="image/png, image/jpeg"/>
										<input type="hidden" name="anh_cccd" class="trust-create-file-attachment">
										<input type="submit" class="pure-button trust-create-upload-image" value="Save">
									</td>
								</tr>
								<tr>
									<th style="width: 20%;">
										<?php echo esc_html__('Số thẻ BH', 'ctwp-helper'); ?>
									</th>
									<td>
										<input style="width: 100%;" type="text"  name="bm-so-bh" id="check-bm-so-bh" />
									</td>
									<th style="width: 20%;">
										<?php echo esc_html__('Ảnh thẻ BH', 'ctwp-helper'); ?>
									</th>
									<td style="display: flex">
										<input style="width: 100%;" type="file" class="trust-create-file"  accept="image/png, image/jpeg"/>
										<input type="hidden" name="anh_the_bh" class="trust-create-file-attachment">
										<input type="submit" class="pure-button trust-create-upload-image" value="Save">
									</td>
								</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="fft-management-EditCancelBtnBox pure-g"style="justify-content: center">
						<button type="submit" style="margin-right: 20px;width: 95px" class="pure-button pure-button-primary ">
							<i class="fas fa-sync"></i>
							<?php echo esc_html__('Hủy', 'ctwp-helper'); ?></button>
						<input type="hidden" name="page" value="hoso"/>
						<input type="hidden" name="type" value="create"/>
						<button type="submit" class="pure-button pure-button-primary check_ttkh"
								data-url="<?php echo esc_url(admin_url('admin.php?page=hoso&type=create&action=create')); ?>"
								data-url1="<?php echo esc_url(admin_url('admin.php?page=hoso&type=create')); ?>">
							<?php echo esc_html__('Tiếp theo', 'ctwp-helper'); ?>
							<i class="fas fa-angle-double-right"></i>
						</button>

					</div>
				</form>
			</div>
		</div>
	<?php } else{ ?>
		<div id="error-page text-center">
			<div class="wp-die-message" style="text-align: center">
				<h1>Xin lỗi, bạn không được phép vào trang này.</h1>
			</div>
		</div>
	<?php }
?>
