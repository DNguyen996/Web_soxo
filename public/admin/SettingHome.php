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
                                <label class="col-sm-3 col-form-label">% Cổ Tức</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="cotuc" value="<?=$PNH->site('cotuc');?>"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                          	<div class="form-group row">
                                <label class="col-sm-3 col-form-label">% Phần trăm rút tiền</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="phantramruttien" value="<?=$PNH->site('phantramruttien');?>"
                                            class="form-control">
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