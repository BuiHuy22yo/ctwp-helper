;(function ($, window, document, undefined) {
    'use strict';
    var FFA = window.FFA || {};

    FFA.HuyAppFormEditUpdateForm = function () {
        $('.app-edit-info-update-btn').on('click', function (el) {
            el.preventDefault();

            let $form = $('.app-form-update-info');
            let $this = $(this);
            let url = $this.attr('data-url');
            $.ajax({
                type: 'POST',
                url: ctwp_script.ajax_url,
                data: $form.serialize(),
                dataType: 'json',
                beforeSend: function () {
                },
                success: function (response) {
                    if ($.isArray(response)) {
                        response.forEach(function (entry) {
                            if (entry['1'] != null && parseInt(entry['1']) < 0) {
                                alert('Vui lòng nhập ' + entry['0'] + ' lớn hơn 0');
                            }
                        });
                    } else {
                        if (response == 1) {
                            alert('Cập Nhật Thành công ');
                            window.location.href = url;
                        } else if (response == 97) {
                            alert('Số tiền bảo hiểm không được để trống');
                        } else if (response == 96) {
                            alert('Vui lòng nhập số tiền bảo hiểm lớn hơn 0');
                        } else {
                            alert('Có lỗi xảy ra ');
                        }
                    }

                }
            });
        });
    };

    FFA.HuyDeleteApplication = function () {
        $('.delete-app').on('click', function () {
            var datacheck = [];
            let $this = $(this);
            let url = $this.attr('data-url');
            $('#tablehoso tbody tr td').each(function () {
                var checked = $(this).find('input').prop('checked');
                if (checked) {
                    datacheck.push($(this).find('input').val());
                }
            });

            if (datacheck == '') {
                alert('Vui lòng chọn hồ sơ để xóa');
            } else {
                if (confirm('Bạn có chắc muốn xóa hồ sơ')) {
                    let data = {
                        'action': 'fff_application_delete_app_ajax',
                        'appid': datacheck
                    };
                    $.ajax({
                        type: 'POST',
                        url: ctwp_script.ajax_url,
                        data: data,
                        dataType: 'json',
                        beforeSend: function () {
                        },
                        success: function (response) {
                            if (response == 1) {
                                alert('Xóa Hồ Sơ Thành Công');
                                window.location.href = url;
                            } else {
                                alert('Có lỗi xảy ra ');
                                console.log(response);
                            }
                        }
                    });
                }
            }
        });
    };

    FFA.HuyTrustCreateAddImage = function () {
        $('.trust-create-upload-image').on('click', function (el) {
            el.preventDefault();

            let fd = new FormData();
            let $this = $(this);
            let file_siblings = $this.siblings('.trust-create-file');
            let file_sibilings_val = $this.siblings('.trust-create-file-attachment');

            fd.append('main_image', file_siblings[0].files[0]);
            fd.append('action', 'fff_trust_save_image');

            let fileExtension = ['jpeg', 'jpg', 'png'];
            let filename = file_siblings.val();
            let extension = filename.replace(/^.*\./, '');

            if ($.inArray(extension, fileExtension) == -1) {
                alert('Vui lòng chọn ảnh');
                file_siblings.val('');
                return false;
            }


            $.ajax({
                type: 'POST',
                url: ctwp_script.ajax_url,
                data: fd,
                async: false,
                processData: false,
                contentType: false,
                beforeSend: function () {
                },
                success: function (response) {

                    if (response) {
                        alert('Cập nhật thành công');
                        file_sibilings_val.val(response);
                    } else {
                        alert('Có lỗi xảy ra');
                        console.log(response);
                    }
                }
            });
        });
    };

    FFA.HuyTrustCreateAddFile = function () {
        $('.trust-create-upload').on('click', function (el) {
            el.preventDefault();

            let fd = new FormData();
            let $this = $(this);
            let file_siblings = $this.siblings('.trust-create-file');
            let file_sibilings_val = $this.siblings('.trust-create-file-attachment');

            fd.append('main_image', file_siblings[0].files[0]);
            fd.append('action', 'fff_trust_save_image');

            let fileExtension = ['doc', 'docx', 'xls', 'xlsx', 'gif', 'bmp', 'pdf'];
            let filename = file_siblings.val();
            let extension = filename.replace(/^.*\./, '');

            if ($.inArray(extension, fileExtension) == -1) {
                alert('Vui lòng chọn file');
                file_siblings.val('');
                return false;
            }


            $.ajax({
                type: 'POST',
                url: ctwp_script.ajax_url,
                data: fd,
                async: false,
                processData: false,
                contentType: false,
                beforeSend: function () {
                },
                success: function (response) {

                    if (response) {
                        alert('Cập nhật thành công');
                        file_sibilings_val.val(response);
                    } else {
                        alert('Có lỗi xảy ra');
                        console.log(response);
                    }
                }
            });
        });
    };

    FFA.HuyCreateApplication = function () {
        $('.create-application-submit').on('click', function (el) {
            el.preventDefault();

            let $form = $('.create-application-form');
            let $this = $(this);
            let url = $this.attr('data-url');
            $.ajax({
                type: 'POST',
                url: ctwp_script.ajax_url,
                data: $form.serialize(),
                dataType: 'json',
                beforeSend: function () {
                },
                success: function (response) {
                    if ($.isArray(response)) {
                        response.forEach(function (entry) {
                            if (entry['1'] != null && parseInt(entry['1']) < 0) {
                                alert('Vui lòng nhập ' + entry['0'] + ' lớn hơn 0');
                            }
                        });
                    } else {
                        if (response == 1) {
                            alert('Thêm mới hồ sơ thành công');
                            window.location.href = url;
                        } else {
                            alert('Có lỗi xảy ra');
                        }

                    }
                }
            });
        })
    };

    FFA.HuyCheckttkh = function () {
        $('.check_ttkh').on('click', function (e) {
            e.preventDefault();

            var ho_ten = $('#check-bm-ho-ten').val();
            var so_cmt = $('#check-bm-so-cmt').val();
            var so_bh1 = $('#check-bm-so-bh').val();
            var so_bh = so_bh1.trim();
            var ngay_sinh = $('#check_ngay_sinh').val();
            let $this = $(this);
            let url = $this.attr('data-url');
            let url1 = $this.attr('data-url1');

            let data = {
                'action': 'ctwp_hepler_check_ttkh_ajax',
                'bm-so-bh': so_bh,
                'bm-so-cmt': so_cmt,
                'bm-ho-ten': ho_ten
            };

            $.ajax({
                type: 'POST',
                url: ctwp_script.ajax_url,
                data: data,
                dataType: 'json',
                beforeSend: function () {
                },
                success: function (response) {

                    if (response == 1) {

                        url += '&so_bh=' + so_bh + '&so_cmt=' + so_cmt + '&ngay_sinh=' + ngay_sinh;
                        window.location.href = url;
                    } else if (response == 98) {
                        window.location.href = url1;
                        alert('Vui lòng nhập thông tin khách hàng');
                    } else if (response == 96) {
                        // window.location.href = url1;
                        alert('Bạn đã nhập sai họ tên khách hàng');
                        url += '&so_bh=' + so_bh + '&so_cmt=' + so_cmt + '&ngay_sinh=' + ngay_sinh;
                        window.location.href = url;
                    } else if (response == 95) {
                        url += '&so_bh=' + so_bh + '&so_cmt=' + so_cmt + '&ngay_sinh=' + ngay_sinh;
                        window.location.href = url;
                    } else {
                        console.log(response);
                        alert('Thông tin khách hàng không đúng');
                        window.location.href = url1;
                    }
                }
            });
        });
    };

    FFA.HuyExportTT = function () {
        window.onload = function () {
            document.getElementById("download")
                .addEventListener("click", () => {
                    const invoice = this.document.getElementById("invoice");
                    var opt = {
                        margin: 1,
                        filename: 'Thông tin chi tiết hồ sơ.pdf',
                        image: {type: 'jpeg', quality: 0.98},
                        html2canvas: {scale: 2},
                        jsPDF: {unit: 'in', format: 'letter', orientation: 'portrait'}
                    };
                    html2pdf().from(invoice).set(opt).save();
                })
        }
    };

    FFA.HuyRemoveNameFile = function () {
        $('.hoso_d_none_name').on('click', function (e) {
            $(this).parent().find('.hoso_position_ab').addClass('d_none');
        });
    };

    FFA.HuyChangeText = function () {
        $('.select-file').on('click', function (e) {
            $(this).parent().find('.trust-create-file').click();
        });
    };


    FFA.Huyabc = function () {
        $('.trust-create-file').on('change', function (e) {
            $(this).parent().find('.txtfileName').val($(this)[0].files[0].name);
        });
    };

    $(document).ready(function () {
        FFA.HuyAppFormEditUpdateForm();
        FFA.HuyDeleteApplication();
        FFA.HuyTrustCreateAddImage();
        FFA.HuyTrustCreateAddFile();
        FFA.HuyCreateApplication();
        FFA.HuyCheckttkh();
        FFA.HuyExportTT();
        FFA.HuyRemoveNameFile();
        FFA.HuyChangeText();
        FFA.Huyabc();
    });
})(jQuery, window, document);