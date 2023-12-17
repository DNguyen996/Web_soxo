<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    $title = 'CHỈNH SỬA CẤU HÌNH KHÁCH | '.$PNH->site('tenweb');
    CheckLogin();
    CheckAdmin();
    require_once("../../public/admin/Header.php");
    require_once("../../public/admin/Sidebar.php");

    if(isset($_GET['username']) && $getUser['level'] == 'admin')
    {
        $row = $PNH->get_list(" SELECT * FROM `tyle` WHERE `username` = '".$_GET['username']."'  ");
        if(!$row)
        {
            admin_msg_error("Người dùng này không tồn tại", BASE_URL(''), 500);
        }
    }
    else
    {
        admin_msg_error("Liên kết không tồn tại", BASE_URL(''), 0);
    }

    if(isset($_POST['btnSaveUser']) && isset($_GET['username']) && $getUser['level'] == 'admin')
    {
        if($PNH->site('status_demo') == 'ON')
        {
            admin_msg_error("Chức năng này không khả dụng trên trang web DEMO!", "", 2000);
        }
        $mb_id      = $_POST['mb_id'];
        $mb_27lo    = $_POST['mb_27lo'];
        $mb_23lo    = $_POST['mb_23lo'];
        $mb_23dao   = $_POST['mb_23dao'];
        $mb_da      = $_POST['mb_da'];
        $mb_dau     = $_POST['mb_dau'];
        $mb_duoi    = $_POST['mb_duoi'];
        $mb_dd      = $_POST['mb_dd'];
        $mb_xc      = $_POST['mb_xc'];
        $mb_xdao    = $_POST['mb_xdao'];
        $PNH->update("tyle", array(
            '27lo'      => $mb_27lo,
            '23lo'      => $mb_23lo,
            '23dao'     => $mb_23dao,
            '23d'       => $mb_23dao,
            'da'        => $mb_da,
            'dau'       => $mb_dau,
            'a'         => $mb_dau,
            'duoi'      => $mb_duoi,
            'b'         => $mb_duoi,
            'dd'        => $mb_dd,
            'ab'        => $mb_dd,
            'xc'        => $mb_xc,
            'xdao'      => $mb_xdao,
            'xd'        => $mb_xdao,
        ), " `id` = '".$mb_id."' ");
        $mn_id      = $_POST['mn_id'];
        $mn_18lo    = $_POST['mn_18lo'];
        $mn_17lo    = $_POST['mn_17lo'];
        $mn_17dao   = $_POST['mn_17dao'];
        $mn_7lo     = $_POST['mn_7lo'];
        $mn_7lod    = $_POST['mn_7lod'];
        $mn_da      = $_POST['mn_da'];
        $mn_dau     = $_POST['mn_dau'];
        $mn_duoi    = $_POST['mn_duoi'];
        $mn_dd      = $_POST['mn_dd'];
        $mn_xc      = $_POST['mn_xc'];
        $mn_xdao    = $_POST['mn_xdao'];
        $PNH->update("tyle", array(
            '18lo'      => $mn_18lo,
            'blo'       => $mn_18lo,
            '17lo'      => $mn_17lo,
            '17dao'     => $mn_17dao,
            '17lod'     => $mn_17dao,
            '7lo'       => $mn_7lo,
            '7lod'      => $mn_7lod,
            '7dao'      => $mn_7lod,
            'da'        => $mn_da,
            'dau'       => $mn_dau,
            'a'         => $mn_dau,
            'duoi'      => $mn_duoi,
            'b'         => $mn_duoi,
            'dd'        => $mn_dd,
            'ab'        => $mn_dd,
            'xc'        => $mn_xc,
            'xdao'      => $mn_xdao,
            'xd'        => $mn_xdao,
        ), " `id` = '".$mn_id."' ");
        $mt_id      = $_POST['mt_id'];
        $mt_18lo    = $_POST['mt_18lo'];
        $mt_17lo    = $_POST['mt_17lo'];
        $mt_17dao   = $_POST['mt_17dao'];
        $mt_7lo     = $_POST['mt_7lo'];
        $mt_7lod    = $_POST['mt_7lod'];
        $mt_da      = $_POST['mt_da'];
        $mt_dau     = $_POST['mt_dau'];
        $mt_duoi    = $_POST['mt_duoi'];
        $mt_dd      = $_POST['mt_dd'];
        $mt_xc      = $_POST['mt_xc'];
        $mt_xdao    = $_POST['mt_xdao'];
        $PNH->update("tyle", array(
            '18lo'      => $mt_18lo,
            'blo'       => $mt_18lo,
            '17lo'      => $mt_17lo,
            '17dao'     => $mt_17dao,
            '17lod'     => $mt_17dao,
            '7lo'       => $mt_7lo,
            '7lod'      => $mt_7lod,
            '7dao'      => $mt_7lod,
            'da'        => $mt_da,
            'dau'       => $mt_dau,
            'a'         => $mt_dau,
            'duoi'      => $mt_duoi,
            'b'         => $mt_duoi,
            'dd'        => $mt_dd,
            'ab'        => $mt_dd,
            'xc'        => $mt_xc,
            'xdao'      => $mt_xdao,
            'xd'        => $mt_xdao,
        ), " `id` = '".$mt_id ."' ");
        admin_msg_success("Thay đổi user thành công", "", 1000);
    }
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chỉnh sửa cấu hình khách</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">CHỈNH SỬA CẤU HÌNH KHÁCH</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <?php 
                            foreach($row as $value){
                                if($value['dai'] == 'mb'){
                            ?>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-12 col-form-label">MIỀN BẮC</label>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-1 col-form-label">2 số 27lo</label>
                                <div class="col-sm-2">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="mb_27lo" value="<?=$value['27lo'];?>" >
                                        <input type="hidden" name="mb_id" value="<?=$value['id'];?>" >
                                    </div>
                                </div>
                                <label for="inputEmail3" class="col-sm-1 col-form-label">3 số 23lo</label>
                                <div class="col-sm-2">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="mb_23lo" value="<?=$value['23lo'];?>" >
                                    </div>
                                </div>
                                <label for="inputEmail3" class="col-sm-1 col-form-label">3 số 23 lô đảo</label>
                                <div class="col-sm-2">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="mb_23dao" value="<?=$value['23dao'];?>" >
                                    </div>
                                </div>
                                <label for="inputEmail3" class="col-sm-1 col-form-label">đá</label>
                                <div class="col-sm-2">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="mb_da" value="<?=$value['da'];?>" >
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-1 col-form-label">2 số đầu</label>
                                <div class="col-sm-2">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="mb_dau" value="<?=$value['dau'];?>" >
                                    </div>
                                </div>
                                <label for="inputEmail3" class="col-sm-1 col-form-label">2 số đuôi</label>
                                <div class="col-sm-2">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="mb_duoi" value="<?=$value['duoi'];?>" >
                                    </div>
                                </div>
                                <label for="inputEmail3" class="col-sm-1 col-form-label">2 số ĐĐ</label>
                                <div class="col-sm-2">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="mb_dd" value="<?=$value['dd'];?>" >
                                    </div>
                                </div>
                                <label for="inputEmail3" class="col-sm-1 col-form-label">Xiểu</label>
                                <div class="col-sm-2">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="mb_xc" value="<?=$value['xc'];?>" >
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-1 col-form-label">Xiểu đảo</label>
                                <div class="col-sm-2">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="mb_xdao" value="<?=$value['xdao'];?>" >
                                    </div>
                                </div>
                            </div>
                            <?php }else if($value['dai'] == 'mn'){
                            ?>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-12 col-form-label">MIỀN NAM</label>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-1 col-form-label">2 số 18lo</label>
                                    <div class="col-sm-2">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mn_18lo" value="<?=$value['18lo'];?>" >
                                            <input type="hidden" name="mn_id" value="<?=$value['id'];?>" >
                                        </div>
                                    </div>
                                    <label for="inputEmail3" class="col-sm-1 col-form-label">3 số 17lo</label>
                                    <div class="col-sm-2">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mn_17lo" value="<?=$value['17lo'];?>" >
                                        </div>
                                    </div>
                                    <label for="inputEmail3" class="col-sm-1 col-form-label">3 số 17lo đảo</label>
                                    <div class="col-sm-2">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mn_17dao" value="<?=$value['17dao'];?>" >
                                        </div>
                                    </div>
                                    <label for="inputEmail3" class="col-sm-1 col-form-label">3 số 7lo</label>
                                    <div class="col-sm-2">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mn_7lo" value="<?=$value['7lo'];?>" >
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-1 col-form-label">3 số 7lo đảo đơn vị</label>
                                    <div class="col-sm-2">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mn_7lod" value="<?=$value['7lod'];?>" >
                                        </div>
                                    </div>
                                    <label for="inputEmail3" class="col-sm-1 col-form-label">đá</label>
                                    <div class="col-sm-2">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mn_da" value="<?=$value['da'];?>" >
                                        </div>
                                    </div>
                                    <label for="inputEmail3" class="col-sm-1 col-form-label">2 số đầu </label>
                                    <div class="col-sm-2">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mn_dau" value="<?=$value['dau'];?>" >
                                        </div>
                                    </div>
                                    <label for="inputEmail3" class="col-sm-1 col-form-label">2 số đuôi</label>
                                    <div class="col-sm-2">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mn_duoi" value="<?=$value['duoi'];?>" >
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-1 col-form-label">2 số ĐĐ</label>
                                    <div class="col-sm-2">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mn_dd" value="<?=$value['dd'];?>" >
                                        </div>
                                    </div>
                                    <label for="inputEmail3" class="col-sm-1 col-form-label">Xiểu</label>
                                    <div class="col-sm-2">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mn_xc" value="<?=$value['xc'];?>" >
                                        </div>
                                    </div>
                                    <label for="inputEmail3" class="col-sm-1 col-form-label">Xiểu đảo</label>
                                    <div class="col-sm-2">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mn_xdao" value="<?=$value['xdao'];?>" >
                                        </div>
                                    </div>
                                </div>
                            <?php }else if($value['dai'] == 'mt'){
                            ?>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-12 col-form-label">MIỀN TRUNG</label>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-1 col-form-label">2 số 18lo</label>
                                    <div class="col-sm-2">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mt_18lo" value="<?=$value['18lo'];?>" >
                                            <input type="hidden" name="mt_id" value="<?=$value['id'];?>" >
                                        </div>
                                    </div>
                                    <label for="inputEmail3" class="col-sm-1 col-form-label">3 số 17lo</label>
                                    <div class="col-sm-2">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mt_17lo" value="<?=$value['17lo'];?>" >
                                        </div>
                                    </div>
                                    <label for="inputEmail3" class="col-sm-1 col-form-label">3 số 17lo đảo</label>
                                    <div class="col-sm-2">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mt_17dao" value="<?=$value['17dao'];?>" >
                                        </div>
                                    </div>
                                    <label for="inputEmail3" class="col-sm-1 col-form-label">3 số 7lo</label>
                                    <div class="col-sm-2">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mt_7lo" value="<?=$value['7lo'];?>" >
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-1 col-form-label">3 số 7lo đảo đơn vị</label>
                                    <div class="col-sm-2">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mt_7lod" value="<?=$value['7lod'];?>" >
                                        </div>
                                    </div>
                                    <label for="inputEmail3" class="col-sm-1 col-form-label">đá</label>
                                    <div class="col-sm-2">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mt_da" value="<?=$value['da'];?>" >
                                        </div>
                                    </div>
                                    <label for="inputEmail3" class="col-sm-1 col-form-label">2 số đầu </label>
                                    <div class="col-sm-2">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mt_dau" value="<?=$value['dau'];?>" >
                                        </div>
                                    </div>
                                    <label for="inputEmail3" class="col-sm-1 col-form-label">2 số đuôi</label>
                                    <div class="col-sm-2">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mt_duoi" value="<?=$value['duoi'];?>" >
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-1 col-form-label">2 số ĐĐ</label>
                                    <div class="col-sm-2">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mt_dd" value="<?=$value['dd'];?>" >
                                        </div>
                                    </div>
                                    <label for="inputEmail3" class="col-sm-1 col-form-label">Xiểu</label>
                                    <div class="col-sm-2">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mt_xc" value="<?=$value['xc'];?>" >
                                        </div>
                                    </div>
                                    <label for="inputEmail3" class="col-sm-1 col-form-label">Xiểu đảo</label>
                                    <div class="col-sm-2">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mt_xdao" value="<?=$value['xdao'];?>" >
                                        </div>
                                    </div>
                                </div>
                            <?php }
                            } ?>
                            <button type="submit" name="btnSaveUser" class="btn btn-primary btn-block waves-effect">
                                <span>LƯU</span>
                            </button>
                            <a type="button" href="<?=BASE_URL('Admin/Users');?>"
                                class="btn btn-danger btn-block waves-effect">
                                <span>TRỞ LẠI</span>
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>



<script>
$(function() {
    $("#datatable").DataTable({
        "responsive": true,
        "autoWidth": false,
    });
});
</script>






<?php 
    require_once("../../public/admin/Footer.php");
?>    