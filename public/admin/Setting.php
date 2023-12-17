<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    $title = 'CẤU HÌNH | '.$PNH->site('tenweb');
    CheckLogin();
    CheckAdmin();
    require_once("../../public/admin/Header.php");
    require_once("../../public/admin/Sidebar.php");
?>
<?php
if(isset($_POST['btnSaveOption']) && $getUser['level'] == 'admin')
{
    if($PNH->site('status_demo') == 'ON')
    {
        admin_msg_error("Chức năng này không khả dụng trên trang web DEMO!", "", 2000);
    }
    foreach ($_POST as $key => $value)
    {
        if(!$PNH->get_row("SELECT * FROM `options` WHERE `name` = '$key' "))
        {
            $PNH->insert("options", [
                'name'  => $key,
                'value' => $value
            ]);
        }
        $PNH->update("options", array(
            'value' => $value
        ), " `name` = '$key' ");
    }
    admin_msg_success('Lưu thành công', '', 500);
}
?>


<style>

</style>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Cấu hình</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">CẤU HÌNH THÔNG TIN WEBSITE</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tên website</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="tenweb" value="<?=$PNH->site('tenweb');?>"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Mô tả website</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="mota" value="<?=$PNH->site('mota');?>"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Từ khóa tìm kiếm</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="tukhoa" value="<?=$PNH->site('tukhoa');?>"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Logo website</label>
                                <div class="col-sm-4">
                                    <div class="form-line">
                                        <input type="text" name="logo" value="<?=$PNH->site('logo');?>"
                                            class="form-control">
                                    </div>
                                    <i>Upload ảnh lên <a target="_blank" href="https://imgur.com/upload?beta">đây</a>, sau đó copy địa chỉ hình ảnh dán vào ô trên.</i>
                                </div>
                                <div class="col-sm-5">
                                    <img width="200px" src="<?=$PNH->site('logo');?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Favicon website</label>
                                <div class="col-sm-4">
                                    <div class="form-line">
                                        <input type="text" name="favicon" value="<?=$PNH->site('favicon');?>"
                                            class="form-control">
                                    </div>
                                    <i>Upload ảnh lên <a target="_blank" href="https://imgur.com/upload?beta">đây</a>, sau đó copy địa chỉ hình ảnh dán vào ô trên.</i>
                                </div>
                                <div class="col-sm-5">
                                    <img width="200px" src="<?=$PNH->site('favicon');?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Ảnh giới thiệu website</label>
                                <div class="col-sm-4">
                                    <div class="form-line">
                                        <input type="text" name="anhbia" value="<?=$PNH->site('anhbia');?>"
                                            class="form-control">
                                    </div>
                                    <i>Upload ảnh lên <a target="_blank" href="https://imgur.com/upload?beta">đây</a>, sau đó copy địa chỉ hình ảnh dán vào ô trên.</i>
                                </div>
                                <div class="col-sm-5">
                                    <img width="200px" src="<?=$PNH->site('anhbia');?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Gmail SMTP [<a href="https://www.youtube.com/watch?v=aiMScMCqMIg&list=PLylqe6Lzq69-TzmQ6kLzTg8ZkrxJxxtZm&index=4" target="_blank">HƯỚNG DẪN</a>]</label>
                                <div class="col-sm-9">
                                    <div class="row clearfix">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" placeholder="Nhập Email"
                                                        name="email" value="<?=$PNH->site('email');?>"
                                                        placeholder="col-sm-6" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" class="form-control"
                                                        placeholder="Nhập mật khẩu Email" name="pass_email"
                                                        value="<?=$PNH->site('pass_email');?>"
                                                        placeholder="col-sm-6" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Theme color</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input class="form-control" type="color"
                                            value="<?=$PNH->site('theme_color');?>" name="theme_color">
                                    </div>
                                    <i>Điều chỉnh màu của website.</i>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Theme Home Page</label>
                                <div class="col-sm-9">
                                    <select class="form-control show-tick" name="theme">
                                        <option value="<?=$PNH->site('theme');?>"><?=$PNH->site('theme');?>
                                        </option>
                                        <option value="Trafalgar">Trafalgar</option>
                                        <option value="JoBest">JoBest</option>
                                        <option value="">Tắt</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Fanpage</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="url" name="fanpage" value="<?=$PNH->site('fanpage');?>"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Thời gian xóa dữ liệu (tính bằng giây)</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="number" name="time_delete"
                                            value="<?=$PNH->site('time_delete');?>" class="form-control">
                                    </div>
                                    <i>Thời gian xóa dữ liệu đã mua, thời gian tính từ ngày thanh toán.</i>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">ON/OFF Panel bên phải</label>
                                <div class="col-sm-9">
                                    <select class="form-control show-tick" name="right_panel" required>
                                        <option value="<?=$PNH->site('right_panel');?>">
                                            <?=$PNH->site('right_panel');?>
                                        </option>
                                        <option value="ON">ON</option>
                                        <option value="OFF">OFF</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">ON/OFF hiển thị bảng giá trước khi login</label>
                                <div class="col-sm-9">
                                    <select class="form-control show-tick" name="display_list_login">
                                        <option value="<?=$PNH->site('display_list_login');?>"><?=$PNH->site('display_list_login');?>
                                        </option>
                                        <option value="ON">ON</option>
                                        <option value="OFF">OFF</option>
                                    </select>
                                    <i>Khi bạn chọn ON, bảng giá tài khoản đang bán sẽ hiện ra bên ngoài trang đăng nhập.</i>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">ON/OFF hiển thị tài nguyên đã bán</label>
                                <div class="col-sm-9">
                                    <select class="form-control show-tick" name="display_sold">
                                        <option value="<?=$PNH->site('display_sold');?>"><?=$PNH->site('display_sold');?>
                                        </option>
                                        <option value="ON">ON</option>
                                        <option value="OFF">OFF</option>
                                    </select>
                                    <i>Khi bạn chọn ON, tài nguyên đã bán sẽ hiến thị kế số lượng còn lại.</i>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">ON/OFF Tạo giao dịch ảo</label>
                                <div class="col-sm-9">
                                    <select class="form-control show-tick" name="stt_giaodichao" required>
                                        <option value="<?=$PNH->site('stt_giaodichao');?>">
                                            <?=$PNH->site('stt_giaodichao');?>
                                        </option>
                                        <option value="ON">ON</option>
                                        <option value="OFF">OFF</option>
                                    </select>
                                    <i>Hệ thống tự tạo giao dịch mua tài khoản ảo để tạo uy tín cho website.</i>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">ON/OFF Referral</label>
                                <div class="col-sm-9">
                                    <select class="form-control show-tick" name="status_ref" required>
                                        <option value="<?=$PNH->site('status_ref');?>">
                                            <?=$PNH->site('status_ref');?>
                                        </option>
                                        <option value="ON">ON</option>
                                        <option value="OFF">OFF</option>
                                    </select>
                                    <i>Nếu bạn chọn OFF, chức năng ctv giới thiệu liên kết ăn hoa hồng sẽ tắt.</i>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Hoa hồng Referral</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" placeholder="VD: 10" name="ck_ref" value="<?=$PNH->site('ck_ref');?>"
                                            class="form-control">
                                    </div>
                                    <i>Chiết khấu hoa hồng liên kết giới thiệu.</i>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">ON/OFF Top nạp tiền</label>
                                <div class="col-sm-9">
                                    <select class="form-control show-tick" name="status_top_nap" required>
                                        <option value="<?=$PNH->site('status_top_nap');?>">
                                            <?=$PNH->site('status_top_nap');?>
                                        </option>
                                        <option value="ON">ON</option>
                                        <option value="OFF">OFF</option>
                                    </select>
                                    <i>Nếu bạn chọn OFF, trang top nạp tiền sẽ bị ẩn.</i>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">ON/OFF Website</label>
                                <div class="col-sm-9">
                                    <select class="form-control show-tick" name="baotri" required>
                                        <option value="<?=$PNH->site('baotri');?>"><?=$PNH->site('baotri');?>
                                        </option>
                                        <option value="ON">ON</option>
                                        <option value="OFF">OFF</option>
                                    </select>
                                    <i>Khi chọn OFF website sẽ bật chế độ bảo trì.</i>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Type Password <i>(Vui lòng không thay đổi tránh
                                        hậu quả đáng tiếc)</i></label>
                                <div class="col-sm-9">
                                    <select class="form-control show-tick" name="TypePassword">
                                        <option value="<?=$PNH->site('TypePassword');?>">
                                            <?=$PNH->site('TypePassword');?>
                                        </option>
                                        <option value="md5">md5</option>
                                        <option value="sha1">sha1</option>
                                        <option value="">không mã hóa</option>
                                    </select>
                                    <i>Không tự ý thay đổi khi chưa có sự đồng ý của nhà phát triển/</i>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Chèn JavaScripts (Live Chat, Hiệu ứng website
                                    v.v)</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <textarea class="form-control" name="script"
                                            rows="6"><?=$PNH->site('script');?></textarea>
                                    </div>
                                    <i>Có thể chèn đoạn sciprt quảng cáo, live chat, css trang trí website...</i>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Thông báo</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <textarea class="textarea" name="thongbao"
                                            rows="6"><?=$PNH->site('thongbao');?></textarea>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Điều khoản sử dụng</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <textarea class="textarea" name="chinhsach"
                                            rows="6"><?=$PNH->site('chinhsach');?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Chế độ bảo hành</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <textarea class="textarea" name="chinhsach_baohanh"
                                            rows="6"><?=$PNH->site('chinhsach_baohanh');?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Liên hệ</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <textarea class="textarea" name="contact"
                                            rows="6"><?=$PNH->site('contact');?></textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="btnSaveOption" class="btn btn-primary btn-block">
                                <span>LƯU</span></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
$(function() {
    // Summernote
    $('.textarea').summernote()
})
</script>

<?php 
    require_once("../../public/admin/Footer.php");
?>