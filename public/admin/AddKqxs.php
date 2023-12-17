<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    $title = 'THÊM KQXS | '.$PNH->site('tenweb');
    CheckLogin();
    CheckAdmin();
    require_once("../../public/admin/Header.php");
    require_once("../../public/admin/Sidebar.php");
?>
<?php



if(isset($_POST['btnSaveUser']) &&  $getUser['level'] == 'admin')
{
    if($PNH->site('status_demo') == 'ON')
    {
        admin_msg_error("Chức năng này không khả dụng trên trang web DEMO!", "", 2000);
    }
    $db1    = check_string($_POST['db1']);
    $dai1   = check_string($_POST['dai1']);
    $g11    = check_string($_POST['g11']);
    $g21    = check_string($_POST['g21']);
    $g31    = check_string($_POST['g31']);
    $g41    = check_string($_POST['g41']);
    $g51    = check_string($_POST['g51']);
    $g71    = check_string($_POST['g71']);
    $g61    = check_string($_POST['g61']);
    $g81    = check_string($_POST['g81']);
    $lastTwoCode1 = check_string($_POST['lastTwoCode1']);
    $createdate = date('Y-m-d H:i:s',strtotime(check_string($_POST['createdate'])));

    
    $db2    = check_string($_POST['db2']);
    $dai2   = check_string($_POST['dai2']);
    $g12    = check_string($_POST['g12']);
    $g22    = check_string($_POST['g22']);
    $g32    = check_string($_POST['g32']);
    $g42    = check_string($_POST['g42']);
    $g52    = check_string($_POST['g52']);
    $g72    = check_string($_POST['g72']);
    $g62    = check_string($_POST['g62']);
    $g82    = check_string($_POST['g82']);
    $lastTwoCode2 = check_string($_POST['lastTwoCode2']);


    $db3    = check_string($_POST['db3']);
    $dai3   = check_string($_POST['dai3']);
    $g13    = check_string($_POST['g13']);
    $g23    = check_string($_POST['g23']);
    $g33    = check_string($_POST['g33']);
    $g43    = check_string($_POST['g43']);
    $g53    = check_string($_POST['g53']);
    $g73    = check_string($_POST['g73']);
    $g63    = check_string($_POST['g63']);
    $g83    = check_string($_POST['g83']);
    $lastTwoCode3 = check_string($_POST['lastTwoCode3']);


    $db4    = check_string($_POST['db4']);
    $dai4   = check_string($_POST['dai4']);
    $g14    = check_string($_POST['g14']);
    $g24    = check_string($_POST['g24']);
    $g34    = check_string($_POST['g34']);
    $g44    = check_string($_POST['g44']);
    $g54    = check_string($_POST['g54']);
    $g74    = check_string($_POST['g74']);
    $g64    = check_string($_POST['g64']);
    $g84    = check_string($_POST['g84']);
    $lastTwoCode4 = check_string($_POST['lastTwoCode4']);

    if( !empty($dai1) ){
        $PNH->insert("ketquaxs", array(
            'dai'           => $dai1,
            'db'            => $db1,
            'g1'            => $g11,
            'g2'            => $g21,
            'g3'            => $g31,
            'g4'            => $g41,
            'g5'            => $g51,
            'g6'            => $g61,
            'g7'            => $g71,
            'g8'            => $g81,
            'lastTwoCode'   => $lastTwoCode1,
            'createdate'    => $createdate,
        ));
    }
    if( !empty($dai2) ){
        $PNH->insert("ketquaxs", array(
            'dai'           => $dai2,
            'db'            => $db2,
            'g1'            => $g12,
            'g2'            => $g22,
            'g3'            => $g32,
            'g4'            => $g42,
            'g5'            => $g52,
            'g6'            => $g62,
            'g7'            => $g72,
            'g8'            => $g82,
            'lastTwoCode'   => $lastTwoCode2,
            'createdate'    => $createdate,
        ));
    }
    if( !empty($dai3) ){
        $PNH->insert("ketquaxs", array(
            'dai'           => $dai3,
            'db'            => $db3,
            'g1'            => $g13,
            'g2'            => $g23,
            'g3'            => $g33,
            'g4'            => $g43,
            'g5'            => $g53,
            'g6'            => $g63,
            'g7'            => $g73,
            'g8'            => $g83,
            'lastTwoCode'   => $lastTwoCode3,
            'createdate'    => $createdate,
        ));
    }
    if( !empty($dai4) ){
        $PNH->insert("ketquaxs", array(
            'dai'           => $dai4,
            'db'            => $db4,
            'g1'            => $g14,
            'g2'            => $g24,
            'g3'            => $g34,
            'g4'            => $g44,
            'g5'            => $g54,
            'g6'            => $g64,
            'g7'            => $g74,
            'g8'            => $g84,
            'lastTwoCode'   => $lastTwoCode4,
            'createdate'    => $createdate,
        ));
    }
    admin_msg_success("Thay đổi thành công", "", 1000);
}
?>



<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>THÊM KQXS</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">THÊM KQXS</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-1 col-form-label">Đài</label>
                                <div class="col-sm-2">
                                    <div class="form-line">
                                        <select class="form-control " name="dai1" required>
                                            <option value="Miền Bắc">Miền Bắc</option>
                                            <option value="Đồng Tháp">Đồng Tháp</option>
                                            <option value="Quảng Nam">Quảng Nam</option>
                                            <option value="Sóc Trăng">Sóc Trăng</option>
                                            <option value="Khánh Hòa">Khánh Hòa</option>
                                            <option value="Bình Định">Bình Định</option>
                                            <option value="Quảng Trị">Quảng Trị</option>
                                            <option value="Vĩnh Long">Vĩnh Long</option>
                                            <option value="Hậu Giang">Hậu Giang</option>
                                            <option value="Long An">Long An</option>
                                            <option value="Đắk Lắk">Đắk Lắk</option>
                                            <option value="Bến Tre">Bến Tre</option>
                                            <option value="Phú Yên">Phú Yên</option>
                                            <option value="Cần Thơ">Cần Thơ</option>
                                            <option value="Đà Nẵng">Đà Nẵng</option>
                                            <option value="Gia Lai">Gia Lai</option>
                                            <option value="Kon Tum">Kon Tum</option>
                                            <option value="Bạc Liêu">Bạc Liêu</option>
                                            <option value="Vũng Tàu">Vũng Tàu</option>
                                            <option value="Đồng Nai">Đồng Nai</option>
                                            <option value="Tây Ninh">Tây Ninh</option>
                                            <option value="An Giang">An Giang</option>
                                            <option value="Trà Vinh">Trà Vinh</option>
                                            <option value="Đắk Nông">Đắk Nông</option>
                                            <option value="Lâm Đồng">Đà Lạt</option>
                                            <option value="Thừa Thiên Huế">Thừa Thiên Huế</option>
                                            <option value="Cà Mau">Cà Mau</option>
                                            <option value="TP.HCM">TP.HCM</option>
                                            <option value="Bình Thuận">Bình Thuận</option>
                                            <option value="Quảng Bình">Quảng Bình</option>
                                            <option value="Bình Dương">Bình Dương</option>
                                            <option value="Ninh Thuận">Ninh Thuận</option>
                                            <option value="Bình Phước">Bình Phước</option>
                                            <option value="Quãng Ngãi">Quãng Ngãi</option>
                                            <option value="Tiền Giang">Tiền Giang</option>
                                            <option value="Kiên Giang">Kiên Giang</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-line">
                                        <select class="form-control " name="dai2" >
                                            <option value=""></option>
                                            <option value="Miền Bắc">Miền Bắc</option>
                                            <option value="Đồng Tháp">Đồng Tháp</option>
                                            <option value="Quảng Nam">Quảng Nam</option>
                                            <option value="Sóc Trăng">Sóc Trăng</option>
                                            <option value="Khánh Hòa">Khánh Hòa</option>
                                            <option value="Bình Định">Bình Định</option>
                                            <option value="Quảng Trị">Quảng Trị</option>
                                            <option value="Vĩnh Long">Vĩnh Long</option>
                                            <option value="Hậu Giang">Hậu Giang</option>
                                            <option value="Long An">Long An</option>
                                            <option value="Đắk Lắk">Đắk Lắk</option>
                                            <option value="Bến Tre">Bến Tre</option>
                                            <option value="Phú Yên">Phú Yên</option>
                                            <option value="Cần Thơ">Cần Thơ</option>
                                            <option value="Đà Nẵng">Đà Nẵng</option>
                                            <option value="Gia Lai">Gia Lai</option>
                                            <option value="Kon Tum">Kon Tum</option>
                                            <option value="Bạc Liêu">Bạc Liêu</option>
                                            <option value="Vũng Tàu">Vũng Tàu</option>
                                            <option value="Đồng Nai">Đồng Nai</option>
                                            <option value="Tây Ninh">Tây Ninh</option>
                                            <option value="An Giang">An Giang</option>
                                            <option value="Trà Vinh">Trà Vinh</option>
                                            <option value="Đắk Nông">Đắk Nông</option>
                                            <option value="Lâm Đồng">Lâm Đồng</option>
                                            <option value="Thừa Thiên Huế">Thừa Thiên Huế</option>
                                            <option value="Cà Mau">Cà Mau</option>
                                            <option value="TP.HCM">TP.HCM</option>
                                            <option value="Bình Thuận">Bình Thuận</option>
                                            <option value="Quảng Bình">Quảng Bình</option>
                                            <option value="Bình Dương">Bình Dương</option>
                                            <option value="Ninh Thuận">Ninh Thuận</option>
                                            <option value="Bình Phước">Bình Phước</option>
                                            <option value="Quãng Ngãi">Quãng Ngãi</option>
                                            <option value="Tiền Giang">Tiền Giang</option>
                                            <option value="Kiên Giang">Kiên Giang</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-line">
                                        <select class="form-control " name="dai3" >
                                            <option value=""></option>
                                            <option value="Miền Bắc">Miền Bắc</option>
                                            <option value="Đồng Tháp">Đồng Tháp</option>
                                            <option value="Quảng Nam">Quảng Nam</option>
                                            <option value="Sóc Trăng">Sóc Trăng</option>
                                            <option value="Khánh Hòa">Khánh Hòa</option>
                                            <option value="Bình Định">Bình Định</option>
                                            <option value="Quảng Trị">Quảng Trị</option>
                                            <option value="Vĩnh Long">Vĩnh Long</option>
                                            <option value="Hậu Giang">Hậu Giang</option>
                                            <option value="Long An">Long An</option>
                                            <option value="Đắk Lắk">Đắk Lắk</option>
                                            <option value="Bến Tre">Bến Tre</option>
                                            <option value="Phú Yên">Phú Yên</option>
                                            <option value="Cần Thơ">Cần Thơ</option>
                                            <option value="Đà Nẵng">Đà Nẵng</option>
                                            <option value="Gia Lai">Gia Lai</option>
                                            <option value="Kon Tum">Kon Tum</option>
                                            <option value="Bạc Liêu">Bạc Liêu</option>
                                            <option value="Vũng Tàu">Vũng Tàu</option>
                                            <option value="Đồng Nai">Đồng Nai</option>
                                            <option value="Tây Ninh">Tây Ninh</option>
                                            <option value="An Giang">An Giang</option>
                                            <option value="Trà Vinh">Trà Vinh</option>
                                            <option value="Đắk Nông">Đắk Nông</option>
                                            <option value="Lâm Đồng">Lâm Đồng</option>
                                            <option value="Thừa Thiên Huế">Thừa Thiên Huế</option>
                                            <option value="Cà Mau">Cà Mau</option>
                                            <option value="TP.HCM">TP.HCM</option>
                                            <option value="Bình Thuận">Bình Thuận</option>
                                            <option value="Quảng Bình">Quảng Bình</option>
                                            <option value="Bình Dương">Bình Dương</option>
                                            <option value="Ninh Thuận">Ninh Thuận</option>
                                            <option value="Bình Phước">Bình Phước</option>
                                            <option value="Quãng Ngãi">Quãng Ngãi</option>
                                            <option value="Tiền Giang">Tiền Giang</option>
                                            <option value="Kiên Giang">Kiên Giang</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-line">
                                        <select class="form-control " name="dai4" >
                                            <option value=""></option>
                                            <option value="Miền Bắc">Miền Bắc</option>
                                            <option value="Đồng Tháp">Đồng Tháp</option>
                                            <option value="Quảng Nam">Quảng Nam</option>
                                            <option value="Sóc Trăng">Sóc Trăng</option>
                                            <option value="Khánh Hòa">Khánh Hòa</option>
                                            <option value="Bình Định">Bình Định</option>
                                            <option value="Quảng Trị">Quảng Trị</option>
                                            <option value="Vĩnh Long">Vĩnh Long</option>
                                            <option value="Hậu Giang">Hậu Giang</option>
                                            <option value="Long An">Long An</option>
                                            <option value="Đắk Lắk">Đắk Lắk</option>
                                            <option value="Bến Tre">Bến Tre</option>
                                            <option value="Phú Yên">Phú Yên</option>
                                            <option value="Cần Thơ">Cần Thơ</option>
                                            <option value="Đà Nẵng">Đà Nẵng</option>
                                            <option value="Gia Lai">Gia Lai</option>
                                            <option value="Kon Tum">Kon Tum</option>
                                            <option value="Bạc Liêu">Bạc Liêu</option>
                                            <option value="Vũng Tàu">Vũng Tàu</option>
                                            <option value="Đồng Nai">Đồng Nai</option>
                                            <option value="Tây Ninh">Tây Ninh</option>
                                            <option value="An Giang">An Giang</option>
                                            <option value="Trà Vinh">Trà Vinh</option>
                                            <option value="Đắk Nông">Đắk Nông</option>
                                            <option value="Lâm Đồng">Lâm Đồng</option>
                                            <option value="Thừa Thiên Huế">Thừa Thiên Huế</option>
                                            <option value="Cà Mau">Cà Mau</option>
                                            <option value="TP.HCM">TP.HCM</option>
                                            <option value="Bình Thuận">Bình Thuận</option>
                                            <option value="Quảng Bình">Quảng Bình</option>
                                            <option value="Bình Dương">Bình Dương</option>
                                            <option value="Ninh Thuận">Ninh Thuận</option>
                                            <option value="Bình Phước">Bình Phước</option>
                                            <option value="Quãng Ngãi">Quãng Ngãi</option>
                                            <option value="Tiền Giang">Tiền Giang</option>
                                            <option value="Kiên Giang">Kiên Giang</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-1 col-form-label">Đặc biệt</label>
                                <div class="col-sm-2">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="db1" required>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="db2" >
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="db3" >
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="db4" >
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-1 col-form-label">Giải nhất</label>
                                <div class="col-sm-2">
                                    <div class="form-line">
                                        <input type="mail" class="form-control"  name="g11" required>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-line">
                                        <input type="mail" class="form-control"  name="g12" >
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-line">
                                        <input type="mail" class="form-control"  name="g13" >
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-line">
                                        <input type="mail" class="form-control"  name="g14" >
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-1 col-form-label">Giải nhì</label>
                                <div class="col-sm-2">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="g21" >
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="g22" >
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="g23" >
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="g24" >
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-1 col-form-label">Giải ba</label>
                                <div class="col-sm-2">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="g31" >
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="g32" >
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="g33" >
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="g34" >
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-1 col-form-label">Giải tư</label>
                                <div class="col-sm-2">
                                    <div class="form-line">
                                        <input type="text" class="form-control"  name="g41" >
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-line">
                                        <input type="text" class="form-control"  name="g42" >
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-line">
                                        <input type="text" class="form-control"  name="g43" >
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-line">
                                        <input type="text" class="form-control"  name="g44" >
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-1 col-form-label">Giải năm</label>
                                <div class="col-sm-2">
                                    <div class="form-line">
                                        <input type="text" class="form-control"  name="g51" >
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-line">
                                        <input type="text" class="form-control"  name="g52" >
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-line">
                                        <input type="text" class="form-control"  name="g53" >
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-line">
                                        <input type="text" class="form-control"  name="g54" >
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-1 col-form-label">Giải sáu</label>
                                <div class="col-sm-2">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="g61"  >
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="g62"  >
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="g63"  >
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="g64"  >
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-1 col-form-label">Giải bảy</label>
                                <div class="col-sm-2">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="g71"  >
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="g72"  >
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="g73"  >
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="g74"  >
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-1 col-form-label">Giải tám</label>
                                <div class="col-sm-2">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="g81"  >
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="g82"  >
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="g83"  >
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="g84"  >
                                    </div>
                                </div>  
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-1 col-form-label">Số Lô</label>
                                <div class="col-sm-2">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="lastTwoCode1"   >
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="lastTwoCode2"   >
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="lastTwoCode3"   >
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="lastTwoCode4"   >
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-1 col-form-label">Ngày tạo</label>
                                <div class="col-sm-3">
                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" name="createdate" value="<?=$row['createdate'];?>"  data-target="#reservationdate">
                                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                            <div class="input-group-text">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="btnSaveUser" class="btn btn-primary btn-block waves-effect">
                                <span>LƯU</span>
                            </button>
                            <a type="button" href="<?=BASE_URL('Admin/Kqxs');?>"
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