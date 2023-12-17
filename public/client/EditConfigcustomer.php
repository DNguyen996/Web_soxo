<?php
require_once("../../config/config.php");
require_once("../../config/function.php");
$title = 'CHỈNH SỬA CẤU HÌNH KHÁCH | ' . $PNH->site('tenweb');
require_once("../../public/client/Header.php");
require_once("../../public/client/Sidebar.php");
CheckLogin();

    if( isset($_GET['username']) && $my_level == 'admin' )
    {
        $row = $PNH->get_list(" SELECT * FROM `tyle` WHERE `username` = '".$_GET['username']."'  ");
        $type = $PNH->get_row(" SELECT * FROM `type` WHERE `username` = '".$_GET['username']."' ");
        if(!$row)
        {
            admin_msg_error("Người dùng này không tồn tại", BASE_URL(''), 1000);
        }
    }elseif ( isset($_GET['username']) && $my_level == 'daily' ){
        $row = $PNH->get_list(" SELECT * FROM `tyle` WHERE `username` = '".$_GET['username']."' AND ref_users = '$my_id' ");
        $type = $PNH->get_row(" SELECT * FROM `type` WHERE `username` = '".$_GET['username']."' AND ref_users = '$my_id' ");
        if(!$row || !$type)
        {
            admin_msg_error("Người dùng này không tồn tại", BASE_URL(''), 1000);
        }
    }else {
        admin_msg_error("Liên kết không tồn tại", BASE_URL(''), 0);
    }

    if(isset($_POST['btnSaveUser']) && isset($_GET['username']) && ( $my_level == 'admin' || $my_level == 'daily' ) )
    {
        if($PNH->site('status_demo') == 'ON')
        {
            admin_msg_error("Chức năng này không khả dụng trên trang web DEMO!", "", 2000);
        }
        $tyle_id = $_POST['tyle_id'];
        $thuhaimn = isset($_POST['thuhaimn']) ? implode(',', $_POST['thuhaimn']) : ''; 
        $thubamn = isset($_POST['thubamn']) ? implode(',', $_POST['thubamn']) : '';
        $thutumn = isset($_POST['thutumn']) ? implode(',', $_POST['thutumn']) : '';
        $thunammn = isset($_POST['thunammn']) ? implode(',', $_POST['thunammn']) : ''; 
        $thusaumn = isset($_POST['thusaumn']) ? implode(',', $_POST['thusaumn']) : '';
        $thubaymn = isset($_POST['thubaymn']) ? implode(',', $_POST['thubaymn']) : ''; 
        $chunhatmn = isset($_POST['chunhatmn']) ? implode(',', $_POST['chunhatmn']) : ''; 
        $thuhaimt = isset($_POST['thuhaimt']) ? implode(',', $_POST['thuhaimt']) : ''; 
        $thubamt = isset($_POST['thubamt']) ? implode(',', $_POST['thubamt']) : ''; 
        $thutumt = isset($_POST['thutumt']) ? implode(',', $_POST['thutumt']) : ''; 
        $thunammt = isset($_POST['thunammt']) ? implode(',', $_POST['thunammt']) : ''; 
        $thusaumt = isset($_POST['thusaumt']) ? implode(',', $_POST['thusaumt']) : ''; 
        $thubaymt = isset($_POST['thubaymt']) ? implode(',', $_POST['thubaymt']) : ''; 
        $chunhatmt = isset($_POST['chunhatmt']) ? implode(',', $_POST['chunhatmt']) : ''; 
        $updatetyle = $update = $PNH->update("type", array(
            'thuhaimn'      => $thuhaimn,
            'thubamn'          => $thubamn,
            'thutumn'          => $thutumn,
            'thunammn'          => $thunammn,
            'thusaumn'          => $thusaumn,
            'thubaymn'          => $thubaymn,
            'chunhatmn'          => $chunhatmn,
             'thuhaimt'      => $thuhaimt,
            'thubamt'          => $thubamt,
            'thutumt'          => $thutumt,
            'thunammt'          => $thunammt,
            'thusaumt'          => $thusaumt,
            'thubaymt'          => $thubaymt,
            'chunhatmt'          => $chunhatmt,
        ), " `id` = '".$tyle_id."' ");
        $mb_id           = $_POST['mb_id'];
        $username        = $_POST['username'];
        $mb_27lo         = $_POST['mb_27lo'];
        $mb_price27lo    = $_POST['mb_price27lo'];
        $mb_23lo         = $_POST['mb_23lo'];
        $mb_price23lo    = $_POST['mb_price23lo'];
        $mb_23dao        = $_POST['mb_23dao'];
        $mb_price23dao   = $_POST['mb_price23dao'];
        $mb_da           = $_POST['mb_da'];
        $mb_priceda      = $_POST['mb_priceda'];
        $mb_dau          = $_POST['mb_dau'];
        $mb_pricedau     = $_POST['mb_pricedau'];
        $mb_duoi         = $_POST['mb_duoi'];
        $mb_priceduoi    = $_POST['mb_priceduoi'];
        $mb_dd           = $_POST['mb_dd'];
        $mb_pricedd      = $_POST['mb_pricedd'];
        $mb_xc           = $_POST['mb_xc'];
        $mb_pricexc      = $_POST['mb_pricexc'];
        $mb_xdao         = $_POST['mb_xdao'];
        $mb_pricexdao    = $_POST['mb_pricexdao'];
        $updatemb = $PNH->update("tyle", array(
            'username'      => $username,
            'blo'           => $mb_27lo,
            '27lo'          => $mb_27lo,
            'price27lo'          => $mb_price27lo,
            '23lo'          => $mb_23lo,
            'price23lo'          => $mb_price23lo,
            '23dao'         => $mb_23dao,
            '23d'           => $mb_23dao,
            'price23dao'           => $mb_price23dao,
            'da'            => $mb_da,
            'priceda'            => $mb_priceda,
            'dau'           => $mb_dau,
            'a'             => $mb_dau,
            'pricedau'             => $mb_pricedau,
            'duoi'          => $mb_duoi,
            'b'             => $mb_duoi,
            'priceduoi'             => $mb_priceduoi,
            'dd'            => $mb_dd,
            'ab'            => $mb_dd,
            'pricedd'            => $mb_pricedd,
            'xc'            => $mb_xc,
            'pricexc'            => $mb_pricexc,
            'xdao'          => $mb_xdao,
            'xd'            => $mb_xdao,
            'pricexdao'            => $mb_pricexdao,
        ), " `id` = '".$mb_id."' ");
        $mn_id           = $_POST['mn_id'];
        $mn_18lo         = $_POST['mn_18lo'];
        $mn_price18lo    = $_POST['mn_price18lo'];
        $mn_17lo         = $_POST['mn_17lo'];
        $mn_price17lo    = $_POST['mn_price17lo'];
        $mn_17dao        = $_POST['mn_17dao'];
        $mn_price17dao   = $_POST['mn_price17dao'];
        $mn_7lo          = $_POST['mn_7lo'];
        $mn_price7lo     = $_POST['mn_price7lo'];
        $mn_7lod         = $_POST['mn_7lod'];
        $mn_price7lod    = $_POST['mn_price7lod'];
        $mn_da           = $_POST['mn_da'];
        $mn_priceda      = $_POST['mn_priceda'];
        $mn_dau          = $_POST['mn_dau'];
        $mn_pricedau     = $_POST['mn_pricedau'];
        $mn_duoi         = $_POST['mn_duoi'];
        $mn_priceduoi    = $_POST['mn_priceduoi'];
        $mn_dd           = $_POST['mn_dd'];
        $mn_pricedd      = $_POST['mn_pricedd'];
        $mn_xc           = $_POST['mn_xc'];
        $mn_pricexc      = $_POST['mn_pricexc'];
        $mn_xdao         = $_POST['mn_xdao'];
        $mn_pricexdao    = $_POST['mn_pricexdao'];
        $updatemn = $PNH->update("tyle", array(
            'username'      => $username,
            '18lo'          => $mn_18lo,
            'blo'           => $mn_18lo,
            'price18lo'     => $mn_price18lo,
            '17lo'          => $mn_17lo,
            'price17lo'     => $mn_price17lo,
            '17dao'         => $mn_17dao,
            '17lod'         => $mn_17dao,
            '17d'           => $mn_17dao,
            'price17dao'    => $mn_price17dao,
            '7lo'           => $mn_7lo,
            'price7lo'      => $mn_price7lo,
            '7lod'          => $mn_7lod,
            '7dao'          => $mn_7lod,
            '7d'            => $mn_7lod,
            'price7lod'     => $mn_price7lod,
            'da'            => $mn_da,
            'priceda'       => $mn_priceda,
            'dau'           => $mn_dau,
            'a'             => $mn_dau,
            'pricedau'      => $mn_pricedau,
            'duoi'          => $mn_duoi,
            'b'             => $mn_duoi,
            'priceduoi'     => $mn_priceduoi,
            'dd'            => $mn_dd,
            'ab'            => $mn_dd,
            'pricedd'       => $mn_pricedd,
            'xc'            => $mn_xc,
            'pricexc'       => $mn_pricexc,
            'xdao'          => $mn_xdao,
            'xd'            => $mn_xdao,
            'pricexdao'     => $mn_pricexdao,
        ), " `id` = '".$mn_id."' ");
        $mt_id           = $_POST['mt_id'];
        $mt_18lo         = $_POST['mt_18lo'];
        $mt_price18lo    = $_POST['mt_price18lo'];
        $mt_17lo         = $_POST['mt_17lo'];
        $mt_price17lo    = $_POST['mt_price17lo'];
        $mt_17dao        = $_POST['mt_17dao'];
        $mt_price17dao   = $_POST['mt_price17dao'];
        $mt_7lo          = $_POST['mt_7lo'];
        $mt_price7lo     = $_POST['mt_price7lo'];
        $mt_7lod         = $_POST['mt_7lod'];
        $mt_price7lod    = $_POST['mt_price7lod'];
        $mt_da           = $_POST['mt_da'];
        $mt_priceda      = $_POST['mt_priceda'];
        $mt_dau          = $_POST['mt_dau'];
        $mt_pricedau     = $_POST['mt_pricedau'];
        $mt_duoi         = $_POST['mt_duoi'];
        $mt_priceduoi    = $_POST['mt_priceduoi'];
        $mt_dd           = $_POST['mt_dd'];
        $mt_pricedd      = $_POST['mt_pricedd'];
        $mt_xc           = $_POST['mt_xc'];
        $mt_pricexc      = $_POST['mt_pricexc'];
        $mt_xdao         = $_POST['mt_xdao'];
        $mt_pricexdao    = $_POST['mt_pricexdao'];
        $updatemt = $PNH->update("tyle", array(
            'username'      => $username,
            '18lo'          => $mt_18lo,
            'blo'           => $mt_18lo,
            'price18lo'     => $mt_price18lo,
            '17lo'          => $mt_17lo,
            'price17lo'     => $mt_price17lo,
            '17dao'         => $mt_17dao,
            '17lod'         => $mt_17dao,
            '17d'           => $mt_17dao,
            'price17dao'    => $mt_price17dao,
            '7lo'           => $mt_7lo,
            'price7lo'      => $mt_price7lo,
            '7lod'          => $mt_7lod,
            '7dao'          => $mt_7lod,
            '7d'            => $mn_7lod,
            'price7lod'     => $mt_price7lod,
            'da'            => $mt_da,
            'priceda'       => $mt_priceda,
            'dau'           => $mt_dau,
            'a'             => $mt_dau,
            'pricedau'      => $mt_pricedau,
            'duoi'          => $mt_duoi,
            'b'             => $mt_duoi,
            'priceduoi'     => $mt_priceduoi,
            'dd'            => $mt_dd,
            'ab'            => $mt_dd,
            'pricedd'       => $mt_pricedd,
            'xc'            => $mt_xc,
            'pricexc'       => $mt_pricexc,
            'xdao'          => $mt_xdao,
            'xd'            => $mt_xdao,
            'pricexdao'            => $mt_pricexdao,
        ), " `id` = '".$mt_id ."' ");
        if($updatetyle && $updatemt && $updatemn && $updatemb){
            admin_msg_success("Thay đổi cấu hình thành công", "/Configcustomer", 1000);
        }
        else{
            admin_msg_error("Vui lòng liên hệ admin", "", 1000);
        }
    }
    
?>

<div class="content-wrapper" style="min-height: 405px;">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> Cấu hình khách </h1>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="row">
            <div class="container">
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
                                <button class="btn btn-primary col-sm-2">Tên Khách</button>
                                <div class="col-sm-3">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="username" value="<?=$value['username'];?>">
                                    </div>
                                </div>
                                
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-12 col-form-label bg-success">MIỀN BẮC</label>
                            </div>
                            <div class="form-group row">
                                <button class="btn btn-secondary col-sm-1">2S-27lo</button>
                                <button class="btn col-sm-1">Giá</button>
                                <div class="col-sm-4">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="mb_price27lo" value="<?=$value['price27lo'];?>">
                                        <input type="hidden" name="mb_id" value="<?=$value['id'];?>" >
                                    </div>
                                </div>
                                <button class="btn col-sm-1">Trúng</button>
                                <div class="col-sm-4">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="mb_27lo" value="<?=$value['27lo'];?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <button class="btn btn-secondary col-sm-1">3S-23lo</button>
                                <button class="btn col-sm-1">Giá</button>
                                <div class="col-sm-4">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="mb_price23lo" value="<?=$value['price23lo'];?>">
                                    </div>
                                </div>
                                <button class="btn col-sm-1">Trúng</button>
                                <div class="col-sm-4">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="mb_23lo" value="<?=$value['23lo'];?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <button class="btn btn-secondary col-sm-1">3S-23 lô đảo</button>
                                <button class="btn col-sm-1">Giá</button>
                                <div class="col-sm-4">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="mb_price23dao" value="<?=$value['price23dao'];?>">
                                    </div>
                                </div>
                                <button class="btn col-sm-1">Trúng</button>
                                <div class="col-sm-4">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="mb_23dao" value="<?=$value['23dao'];?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <button class="btn btn-secondary col-sm-1">Đá</button>
                                <button class="btn col-sm-1">Giá</button>
                                <div class="col-sm-4">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="mb_priceda" value="<?=$value['priceda'];?>">
                                    </div>
                                </div>
                                <button class="btn col-sm-1">Trúng</button>
                                <div class="col-sm-4">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="mb_da" value="<?=$value['da'];?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <button class="btn btn-secondary col-sm-1">2S-đầu</button>
                                <button class="btn col-sm-1">Giá</button>
                                <div class="col-sm-4">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="mb_pricedau" value="<?=$value['pricedau'];?>">
                                    </div>
                                </div>
                                <button class="btn col-sm-1">Trúng</button>
                                <div class="col-sm-4">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="mb_dau" value="<?=$value['dau'];?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <button class="btn btn-secondary col-sm-1">2S-đuôi</button>
                                <button class="btn col-sm-1">Giá</button>
                                <div class="col-sm-4">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="mb_priceduoi" value="<?=$value['priceduoi'];?>">
                                    </div>
                                </div>
                                <button class="btn col-sm-1">Trúng</button>
                                <div class="col-sm-4">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="mb_duoi" value="<?=$value['duoi'];?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <button class="btn btn-secondary col-sm-1">2S-ĐĐ</button>
                                <button class="btn col-sm-1">Giá</button>
                                <div class="col-sm-4">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="mb_pricedd" value="<?=$value['pricedd'];?>">
                                    </div>
                                </div>
                                <button class="btn col-sm-1">Trúng</button>
                                <div class="col-sm-4">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="mb_dd" value="<?=$value['dd'];?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <button class="btn btn-secondary col-sm-1">Xiểu</button>
                                <button class="btn col-sm-1">Giá</button>
                                <div class="col-sm-4">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="mb_pricexc" value="<?=$value['pricexc'];?>">
                                    </div>
                                </div>
                                <button class="btn col-sm-1">Trúng</button>
                                <div class="col-sm-4">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="mb_xc" value="<?=$value['xc'];?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <button class="btn btn-secondary col-sm-1">Xiểu đảo</button>
                                <button class="btn col-sm-1">Giá</button>
                                <div class="col-sm-4">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="mb_pricexdao" value="<?=$value['pricexdao'];?>">
                                    </div>
                                </div>
                                <button class="btn col-sm-1">Trúng</button>
                                <div class="col-sm-4">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="mb_xdao" value="<?=$value['xdao'];?>">
                                    </div>
                                </div>
                            </div>
                            <?php }else if($value['dai'] == 'mn'){
                            ?>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-12 col-form-label bg-success">MIỀN NAM</label>
                                </div>
                                <div class="form-group row">
                                    <button class="btn btn-secondary col-sm-1">2S-18lo</button>
                                    <button class="btn col-sm-1">Giá</button>
                                    <div class="col-sm-4">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mn_price18lo" value="<?=$value['price18lo'];?>">
                                            <input type="hidden" name="mn_id" value="<?=$value['id'];?>" >
                                        </div>
                                    </div>
                                    <button class="btn col-sm-1">Trúng</button>
                                    <div class="col-sm-4">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mn_18lo" value="<?=$value['18lo'];?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <button class="btn btn-secondary col-sm-1">3S-17lo</button>
                                    <button class="btn col-sm-1">Giá</button>
                                    <div class="col-sm-4">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mn_price17lo" value="<?=$value['price17lo'];?>">
                                        </div>
                                    </div>
                                    <button class="btn col-sm-1">Trúng</button>
                                    <div class="col-sm-4">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mn_17lo" value="<?=$value['17lo'];?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <button class="btn btn-secondary col-sm-1">3S-17lo đảo</button>
                                    <button class="btn col-sm-1">Giá</button>
                                    <div class="col-sm-4">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mn_price17dao" value="<?=$value['price17dao'];?>">
                                        </div>
                                    </div>
                                    <button class="btn col-sm-1">Trúng</button>
                                    <div class="col-sm-4">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mn_17dao" value="<?=$value['17dao'];?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <button class="btn btn-secondary col-sm-1">3S-7lo</button>
                                    <button class="btn col-sm-1">Giá</button>
                                    <div class="col-sm-4">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mn_price7lo" value="<?=$value['price7lo'];?>">
                                        </div>
                                    </div>
                                    <button class="btn col-sm-1">Trúng</button>
                                    <div class="col-sm-4">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mn_7lo" value="<?=$value['7lo'];?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <button class="btn btn-secondary col-sm-1">3S-7lodao</button>
                                    <button class="btn col-sm-1">Giá</button>
                                    <div class="col-sm-4">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mn_price7lod" value="<?=$value['price7lod'];?>">
                                        </div>
                                    </div>
                                    <button class="btn col-sm-1">Trúng</button>
                                    <div class="col-sm-4">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mn_7lod" value="<?=$value['7lod'];?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <button class="btn btn-secondary col-sm-1">Đá</button>
                                    <button class="btn col-sm-1">Giá</button>
                                    <div class="col-sm-4">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mn_priceda" value="<?=$value['priceda'];?>">
                                        </div>
                                    </div>
                                    <button class="btn col-sm-1">Trúng</button>
                                    <div class="col-sm-4">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mn_da" value="<?=$value['da'];?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <button class="btn btn-secondary col-sm-1">2S-đầu </button>
                                    <button class="btn col-sm-1">Giá</button>
                                    <div class="col-sm-4">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mn_pricedau" value="<?=$value['pricedau'];?>">
                                        </div>
                                    </div>
                                    <button class="btn col-sm-1">Trúng</button>
                                    <div class="col-sm-4">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mn_dau" value="<?=$value['dau'];?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <button class="btn btn-secondary col-sm-1">2S-đuôi</button>
                                    <button class="btn col-sm-1">Giá</button>
                                    <div class="col-sm-4">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mn_priceduoi" value="<?=$value['priceduoi'];?>">
                                        </div>
                                    </div>
                                    <button class="btn col-sm-1">Trúng</button>
                                    <div class="col-sm-4">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mn_duoi" value="<?=$value['duoi'];?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <button class="btn btn-secondary col-sm-1">2S-ĐĐ</button>
                                    <button class="btn col-sm-1">Giá</button>
                                    <div class="col-sm-4">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mn_pricedd" value="<?=$value['pricedd'];?>">
                                        </div>
                                    </div>
                                    <button class="btn col-sm-1">Trúng</button>
                                    <div class="col-sm-4">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mn_dd" value="<?=$value['dd'];?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <button class="btn btn-secondary col-sm-1">Xiểu</button>
                                    <button class="btn col-sm-1">Giá</button>
                                    <div class="col-sm-4">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mn_pricexc" value="<?=$value['pricexc'];?>">
                                        </div>
                                    </div>
                                    <button class="btn col-sm-1">Trúng</button>
                                    <div class="col-sm-4">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mn_xc" value="<?=$value['xc'];?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <button class="btn btn-secondary col-sm-1">Xiểu đảo</button>
                                    <button class="btn col-sm-1">Giá</button>
                                    <div class="col-sm-4">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mn_pricexdao" value="<?=$value['pricexdao'];?>">
                                        </div>
                                    </div>
                                    <button class="btn col-sm-1">Trúng</button>
                                    <div class="col-sm-4">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mn_xdao" value="<?=$value['xdao'];?>">
                                        </div>
                                    </div>
                                </div>
                            <?php }else if($value['dai'] == 'mt'){
                            ?>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-12 col-form-label bg-success">MIỀN TRUNG</label>
                                </div>
                                <div class="form-group row">
                                    <button class="btn btn-secondary col-sm-1">2S-18lo</button>
                                    <button class="btn col-sm-1">Giá</button>
                                    <div class="col-sm-4">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mt_price18lo" value="<?= $value['price18lo']; ?>">
                                            <input type="hidden" name="mt_id" value="<?= $value['id']; ?>">
                                        </div>
                                    </div>
                                    <button class="btn col-sm-1">Trúng</button>
                                    <div class="col-sm-4">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mt_18lo" value="<?= $value['18lo']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <button class="btn btn-secondary col-sm-1">3S-17lo</button>
                                    <button class="btn col-sm-1">Giá</button>
                                    <div class="col-sm-4">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mt_price17lo" value="<?= $value['price17lo']; ?>">
                                        </div>
                                    </div>
                                    <button class="btn col-sm-1">Trúng</button>
                                    <div class="col-sm-4">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mt_17lo" value="<?= $value['17lo']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <button class="btn btn-secondary col-sm-1">3S-17lo đảo</button>
                                    <button class="btn col-sm-1">Giá</button>
                                    <div class="col-sm-4">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mt_price17dao" value="<?= $value['price17dao']; ?>">
                                        </div>
                                    </div>
                                    <button class="btn col-sm-1">Trúng</button>
                                    <div class="col-sm-4">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mt_17dao" value="<?= $value['17dao']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <button class="btn btn-secondary col-sm-1">3S-7lo</button>
                                    <button class="btn col-sm-1">Giá</button>
                                    <div class="col-sm-4">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mt_price7lo" value="<?= $value['price7lo']; ?>">
                                        </div>
                                    </div>
                                    <button class="btn col-sm-1">Trúng</button>
                                    <div class="col-sm-4">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mt_7lo" value="<?= $value['7lo']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <button class="btn btn-secondary col-sm-1">3S-7lodao</button>
                                    <button class="btn col-sm-1">Giá</button>
                                    <div class="col-sm-4">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mt_price7lod" value="<?= $value['price7lod']; ?>">
                                        </div>
                                    </div>
                                    <button class="btn col-sm-1">Trúng</button>
                                    <div class="col-sm-4">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mt_7lod" value="<?= $value['7lod']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <button class="btn btn-secondary col-sm-1">Đá</button>
                                    <button class="btn col-sm-1">Giá</button>
                                    <div class="col-sm-4">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mt_priceda" value="<?= $value['priceda']; ?>">
                                        </div>
                                    </div>
                                    <button class="btn col-sm-1">Trúng</button>
                                    <div class="col-sm-4">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mt_da" value="<?= $value['da']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <button class="btn btn-secondary col-sm-1">2S-đầu </button>
                                    <button class="btn col-sm-1">Giá</button>
                                    <div class="col-sm-4">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mt_pricedau" value="<?= $value['pricedau']; ?>">
                                        </div>
                                    </div>
                                    <button class="btn col-sm-1">Trúng</button>
                                    <div class="col-sm-4">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mt_dau" value="<?= $value['dau']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <button class="btn btn-secondary col-sm-1">2S-đuôi</button>
                                    <button class="btn col-sm-1">Giá</button>
                                    <div class="col-sm-4">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mt_priceduoi" value="<?= $value['priceduoi']; ?>">
                                        </div>
                                    </div>
                                    <button class="btn col-sm-1">Trúng</button>
                                    <div class="col-sm-4">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mt_duoi" value="<?= $value['duoi']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <button class="btn btn-secondary col-sm-1">2S-ĐĐ</button>
                                    <button class="btn col-sm-1">Giá</button>
                                    <div class="col-sm-4">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mt_pricedd" value="<?= $value['pricedd']; ?>">
                                        </div>
                                    </div>
                                    <button class="btn col-sm-1">Trúng</button>
                                    <div class="col-sm-4">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mt_dd" value="<?= $value['dd']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <button class="btn btn-secondary col-sm-1">Xiểu</button>
                                    <button class="btn col-sm-1">Giá</button>
                                    <div class="col-sm-4">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mt_pricexc" value="<?= $value['pricexc']; ?>">
                                        </div>
                                    </div>
                                    <button class="btn col-sm-1">Trúng</button>
                                    <div class="col-sm-4">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mt_xc" value="<?= $value['xc']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <button class="btn btn-secondary col-sm-1">Xiểu đảo</button>
                                    <button class="btn col-sm-1">Giá</button>
                                    <div class="col-sm-4">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mt_pricexdao" value="<?= $value['pricexdao']; ?>">
                                        </div>
                                    </div>
                                    <button class="btn col-sm-1">Trúng</button>
                                    <div class="col-sm-4">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mt_xdao" value="<?= $value['xdao']; ?>">
                                        </div>
                                    </div>
                                </div>
                            <?php }
                            } ?>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-12 col-form-label bg-success">Miền Nam</label>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-1 col-form-label">T2</label>
                                <div class="col-sm-5">
                                    <input type="hidden" name="tyle_id" value="<?=$type['id'];?>">
                                    <select class="select2" multiple="multiple" name="thuhaimn[]" data-placeholder="Chọn đài" style="width: 100%;">
                                        <?php 
                                        foreach (explode(',',$type['thuhaimn']) as $value){
                                            echo '<option value="'.$value.'" selected="">'.$value.'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <label for="inputEmail3" class="col-sm-1 col-form-label">T6</label>
                                <div class="col-sm-5">
                                    <select class="select2" multiple="multiple" name="thusaumn[]" data-placeholder="Chọn đài" style="width: 100%;">
                                        <?php 
                                        foreach (explode(',',$type['thusaumn']) as $value){
                                            echo '<option value="'.$value.'" selected="">'.$value.'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-1 col-form-label">T3</label>
                                <div class="col-sm-5">
                                    <select class="select2" multiple="multiple" name="thubamn[]" data-placeholder="Chọn đài" style="width: 100%;">
                                        <?php 
                                        foreach (explode(',',$type['thubamn']) as $value){
                                            echo '<option value="'.$value.'" selected="">'.$value.'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <label for="inputEmail3" class="col-sm-1 col-form-label">T7</label>
                                <div class="col-sm-5">
                                    <select class="select2" multiple="multiple" name="thubaymn[]" data-placeholder="Chọn đài" style="width: 100%;">
                                        <?php 
                                        foreach (explode(',',$type['thubaymn']) as $value){
                                            echo '<option value="'.$value.'" selected="">'.$value.'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-1 col-form-label">T4</label>
                                <div class="col-sm-5">
                                    <select class="select2" multiple="multiple" name="thutumn[]" data-placeholder="Chọn đài" style="width: 100%;">
                                        <?php 
                                        foreach (explode(',',$type['thutumn']) as $value){
                                            echo '<option value="'.$value.'" selected="">'.$value.'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <label for="inputEmail3" class="col-sm-1 col-form-label">CN</label>
                                <div class="col-sm-5">
                                    <select class="select2" multiple="multiple" name="chunhatmn[]" data-placeholder="Chọn đài" style="width: 100%;">
                                        <?php 
                                        foreach (explode(',',$type['chunhatmn']) as $value){
                                            echo '<option value="'.$value.'" selected="">'.$value.'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-1 col-form-label">T5</label>
                                <div class="col-sm-5">
                                    <select class="select2" multiple="multiple" name="thunammn[]" data-placeholder="Chọn đài" style="width: 100%;">
                                         <?php 
                                        foreach (explode(',',$type['thunammn']) as $value){
                                            echo '<option value="'.$value.'" selected="">'.$value.'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-12 col-form-label bg-success">Miền Trung</label>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-1 col-form-label">T2</label>
                                <div class="col-sm-5">
                                    <select class="select2" multiple="multiple" name="thuhaimt[]" data-placeholder="Chọn đài" style="width: 100%;">
                                         <?php 
                                        foreach (explode(',',$type['thuhaimt']) as $value){
                                            echo '<option value="'.$value.'" selected="">'.$value.'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <label for="inputEmail3" class="col-sm-1 col-form-label">T6</label>
                                <div class="col-sm-5">
                                    <select class="select2" multiple="multiple" name="thusaumt[]" data-placeholder="Chọn đài" style="width: 100%;">
                                        <?php 
                                        foreach (explode(',',$type['thusaumt']) as $value){
                                            echo '<option value="'.$value.'" selected="">'.$value.'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-1 col-form-label">T3</label>
                                <div class="col-sm-5">
                                    <select class="select2" multiple="multiple" name="thubamt[]" data-placeholder="Chọn đài" style="width: 100%;">
                                         <?php 
                                        foreach (explode(',',$type['thubamt']) as $value){
                                            echo '<option value="'.$value.'" selected="">'.$value.'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <label for="inputEmail3" class="col-sm-1 col-form-label">T7</label>
                                <div class="col-sm-5">
                                    <select class="select2" multiple="multiple" name="thubaymt[]" data-placeholder="Chọn đài" style="width: 100%;">
                                         <?php 
                                        foreach (explode(',',$type['thubaymt']) as $value){
                                            echo '<option value="'.$value.'" selected="">'.$value.'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-1 col-form-label">T4</label>
                                <div class="col-sm-5">
                                    <select class="select2" multiple="multiple" name="thutumt[]" data-placeholder="Chọn đài" style="width: 100%;">
                                         <?php 
                                        foreach (explode(',',$type['thutumt']) as $value){
                                            echo '<option value="'.$value.'" selected="">'.$value.'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <label for="inputEmail3" class="col-sm-1 col-form-label">CN</label>
                                <div class="col-sm-5">
                                    <select class="select2" multiple="multiple" name="chunhatmt[]" data-placeholder="Chọn đài" style="width: 100%;">
                                         <?php 
                                        foreach (explode(',',$type['chunhatmt']) as $value){
                                            echo '<option value="'.$value.'" selected="">'.$value.'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-1 col-form-label">T5</label>
                                <div class="col-sm-5">
                                    <select class="select2" multiple="multiple" name="thunammt[]" data-placeholder="Chọn đài" style="width: 100%;">
                                        <?php 
                                        foreach (explode(',',$type['thunammt']) as $value){
                                            echo '<option value="'.$value.'" selected="">'.$value.'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" name="btnSaveUser" class="btn btn-primary btn-block waves-effect">
                                <span>LƯU</span>
                            </button>
                            <a type="button" href="<?=BASE_URL('Configcustomer');?>"
                                class="btn btn-danger btn-block waves-effect">
                                <span>TRỞ LẠI</span>
                            </a>
                        </form>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </section>
</div>

<?php
require_once("../../public/client/Footer.php");
?>    