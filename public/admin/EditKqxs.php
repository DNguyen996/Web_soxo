<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    $title = 'KQXS | '.$PNH->site('tenweb');
    CheckLogin();
    CheckAdmin();
    require_once("../../public/admin/Header.php");
    require_once("../../public/admin/Sidebar.php");
?>
<?php
if(isset($_GET['id']) && $getUser['level'] == 'admin')
{
    $row = $PNH->get_row(" SELECT * FROM `ketquaxs` WHERE `id` = '".check_string($_GET['id'])."'  ");
    if(!$row)
    {
        admin_msg_error("Người dùng này không tồn tại", BASE_URL(''), 500);
    }
}
else
{
    admin_msg_error("Liên kết không tồn tại", BASE_URL(''), 0);
}

if(isset($_POST['btnCongTien']) && isset($_POST['value']) && isset($row['username']) && $getUser['level'] == 'admin')
{
    $value = check_string($_POST['value']);
    $ghichu = check_string($_POST['ghichu']);
    if($value <= 0)
    {
        admin_msg_error("Vui lòng nhập số tiền hợp lệ", "", 2000);
    }
    $create = $PNH->insert("dongtien", [
        'sotientruoc' => $row['money'],
        'sotienthaydoi' => $value,
        'sotiensau' => $row['money'] + $value,
        'thoigian' => gettime(),
        'noidung' => 'Admin cộng tiền ('.$ghichu.')',
        'username' => $row['username']
    ]);
    if($create)
    {
        $PNH->cong("users", "money", $value, " `username` = '".$row['username']."' ");
        $PNH->cong("users", "total_money", $value, " `username` = '".$row['username']."' ");
        admin_msg_success("Cộng tiền thành công!", "", 2000);
    }
    else
    {
        admin_msg_error("Vui lòng liên hệ kỹ thuật Zalo 0964347258", "", 12000);
    }
    
}

if(isset($_POST['btnTruTien']) && isset($_POST['value']) && isset($row['username']) && $getUser['level'] == 'admin')
{
    $value = check_string($_POST['value']);
    $ghichu = check_string($_POST['ghichu']);
    if($value <= 0)
    {
        admin_msg_error("Vui lòng nhập số tiền hợp lệ", "", 2000);
    }
    $create = $PNH->insert("dongtien", [
        'sotientruoc' => $row['money'],
        'sotienthaydoi' => $value,
        'sotiensau' => $row['money'] - $value,
        'thoigian' => gettime(),
        'noidung' => 'Admin trừ tiền ('.$ghichu.')',
        'username' => $row['username']
    ]);
    if($create)
    {
        $PNH->tru("users", "money", $value, " `username` = '".$row['username']."' ");
        $PNH->tru("used_money", "money", $value, " `username` = '".$row['username']."' ");
        admin_msg_success("Trừ tiền thành công!", "", 2000);
    }
    else
    {
        admin_msg_error("Vui lòng liên hệ kỹ thuật Zalo 0964347258", "", 12000);
    }
    
}
if(isset($_POST['btnSaveUser']) && isset($_GET['id']) && $getUser['level'] == 'admin')
{
    if($PNH->site('status_demo') == 'ON')
    {
        admin_msg_error("Chức năng này không khả dụng trên trang web DEMO!", "", 2000);
    }
    $db = check_string($_POST['db']);
    $dai = check_string($_POST['dai']);
    $g1 = check_string($_POST['g1']);
    $g2 = check_string($_POST['g2']);
    $g3 = check_string($_POST['g3']);
    $g4 = check_string($_POST['g4']);
    $g5 = check_string($_POST['g5']);
    $g7 = check_string($_POST['g7']);
    $g6 = check_string($_POST['g6']);
    $g8 = check_string($_POST['g8']);
    $lastTwoCode = check_string($_POST['lastTwoCode']);
    $createdate = date('Y-m-d H:i:s',strtotime(check_string($_POST['createdate'])));
    $PNH->update("ketquaxs", array(
        'dai'         => $dai,
        'db'         => $db,
        'g1'   => $g1,
        'g2'      => $g2,
        'g3'           => $g3,
        'g4'         => $g4,
        'g5'     => $g5,
        'g6'         => $g6,
        'g7'         => $g7,
        'g8'        => $g8,
        'lastTwoCode'        => $lastTwoCode,
        'createdate'        => $createdate,
    ), " `id` = '".$row['id']."' ");
    admin_msg_success("Thay đổi thành công", "", 1000);
}
?>



<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chỉnh sửa KQXS</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">CHỈNH SỬA KQXS</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Đài</label>
                                <div class="col-sm-10">
                                    <div class="form-line">
                                        <select class="form-control " name="dai" required>
                                            <option value="<?=$row['dai'];?>"><?=$row['dai'];?></option>
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
                                        <input type="hidden"  name="id" value="<?=$row['id'];?>" >
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">db</label>
                                <div class="col-sm-10">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="db"
                                            value="<?=$row['db'];?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">g1</label>
                                <div class="col-sm-10">
                                    <div class="form-line">
                                        <input type="mail" class="form-control"  name="g1"
                                            value="<?=$row['g1'];?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">g2</label>
                                <div class="col-sm-10">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="g2"
                                            value="<?=$row['g2'];?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">g3</label>
                                <div class="col-sm-10">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="g3"
                                            value="<?=$row['g3'];?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">g4</label>
                                <div class="col-sm-10">
                                    <div class="form-line">
                                        <input type="text" class="form-control"  name="g4"
                                            value="<?=$row['g4'];?>" >
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">g5</label>
                                <div class="col-sm-10">
                                    <div class="form-line">
                                        <input type="text" class="form-control"  name="g5" value="<?=$row['g5'];?>" >
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">g6</label>
                                <div class="col-sm-10">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="g6" value="<?=$row['g6'];?>" >
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">g7</label>
                                <div class="col-sm-10">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="g7" value="<?=$row['g7'];?>" >
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">g8</label>
                                <div class="col-sm-10">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="g8" value="<?=$row['g8'];?>" >
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">lastTwoCode</label>
                                <div class="col-sm-10">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="lastTwoCode" value="<?=$row['lastTwoCode'];?>" >
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Ngày tạo</label>
                                <div class="col-sm-10">
                                   <div class="input-group date" id="reservationdate" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" name="createdate" value="<?=$row['createdate'];?>"  data-target="#reservationdate">
                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
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