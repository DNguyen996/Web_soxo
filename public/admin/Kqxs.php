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
if(isset($_GET['login']) && $getUser['level'] == 'admin')
{
    $username = check_string($_GET['login']);
    $_SESSION['username'] = $username;
    admin_msg_success("Đăng nhập tài khoản thành công !", BASE_URL(''), 2000);
}

if(isset($_POST['XoaChuyenMuc']) && $getUser['level'] == 'admin' )
{
    $id = check_string($_POST['id']);
    $row = $PNH->get_row("SELECT * FROM `ketquaxs` WHERE `id` = '$id' ");
    if(!$row)
    {
        msg_error2("ID cần xóa không tồn tại trong hệ thống !");
    }
    // GHI LOG
    $file = @fopen('../../logs/ketquaxs.txt', 'a');
    if ($file)
    {
        $data = "[LOG] Chuyên mục ".$row['title']." đã bị xóa khỏi hệ thống vào lúc ".gettime().PHP_EOL;
        fwrite($file, $data);
        fclose($file);
    }
    $PNH->remove("ketquaxs", " `id` = '$id' ");
    admin_msg_success("Xóa thành công !", "", 1000);
}
    
    
if(isset($_POST['btnaddnew']) && $getUser['level'] == 'admin' )
{
    if($PNH->site('status_demo') == 'ON')
    {
        admin_msg_warning("Chức năng này không khả dụng trên trang web DEMO!", "", 2000);
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
    $create = $PNH->insert("ketquaxs", array(
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
    ));
    if($create){
        admin_msg_success("Thêm thành công", '/Admin/Kqxs', 500);
    }else{
        admin_msg_error("Vui lòng liên hệ admin", BASE_URL('/Admin/Kqxs'), 500);
    }
}

if(isset($_POST['btnCongTien']) && isset($_POST['value']) && isset($row['username']) && $getUser['level'] == 'admin')
{
    $value = check_string($_POST['value']);
    $id = check_string($_POST['id']);
    $tranId = check_string($_POST['tranId']);
    if($value <= 0)
    {
        admin_msg_error("Vui lòng nhập số tiền hợp lệ", "", 2000);
    }
    if($PNH->num_rows(" SELECT * FROM `momo` WHERE `tranId` = '$tranId' ") != 0)
    {
        admin_msg_error("Mã giao dịch này đã được cộng tiền rồi !", "", 2000);
    } 
    $row = $PNH->get_row(" SELECT * FROM `users` WHERE `id` = '$id'  ");
    if(!$row)
    {
        admin_msg_error("Người dùng này không tồn tại", BASE_URL('/Admin/Users'), 500);
    }
    $create = $PNH->insert("momo", array(
        'tranId'        => $tranId,
        'username'      => $row['username'],
        'comment'       => '',
        'time'          => gettime(),
        'partnerId'     => '',
        'amount'        => $value,
        'partnerName'   => ''
    ));
    if($create)
    {
        $PNH->insert("dongtien", [
            'sotientruoc' => $row['money'],
            'sotienthaydoi' => $value,
            'sotiensau' => $row['money'] + $value,
            'thoigian' => gettime(),
            'noidung' => 'Admin cộng tiền ('.$ghichu.')',
            'username' => $row['username']
        ]);
        $PNH->cong("users", "money", $value, " `username` = '".$row['username']."' ");
        $PNH->cong("users", "total_money", $value, " `username` = '".$row['username']."' ");
        admin_msg_success("Cộng tiền thành công!", "", 2000);
    }
    else
    {
        admin_msg_error("Vui lòng liên hệ kỹ thuật Zalo 0964347258", "", 12000);
    }
    
}

?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>KQXS</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">KQXS</h3>
                        <div class="card-tools">
                            <a type="button" href="/Admin/AddKqxs" class="btn btn-primary"><i class="fas fa-plus"></i><span>ADD</span></a>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>ĐÀI</th>
                                        <th>DB</th>
                                        <th>g1</th>
                                        <th>g2</th>
                                        <th>g3</th>
                                        <th>NGÀY TẠO</th>
                                        <th>THAO TÁC</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach($PNH->get_list(" SELECT * FROM `ketquaxs` ORDER BY id DESC ") as $row){
                                    ?>
                                    <tr>
                                        <td><?=$row['id'];?></td>
                                        <td><?=$row['dai'];?></td>
                                        <td><?=$row['db'];?></td>
                                        <td><?=$row['g1'];?></td>
                                        <td><?=$row['g2'];?></td>
                                        <td><?=$row['g3'];?></td>
                                        <td><span class="badge badge-dark"><?=$row['createdate'];?></span></td>
                                        <td>
                                            <a type="button" href="<?=BASE_URL('Admin/Kqxs/Edit/');?><?=$row['id'];?>"
                                                class="btn btn-primary"><i class="fas fa-edit"></i>
                                                <span>EDIT</span></a>
                                            <button class="btn btn-danger btnDelete" id="XoaChuyenMuc" data-id="<?=$row['id'];?>"><i
                                                    class="fas fa-trash"></i>
                                                <span>DELETE</span>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">THÊM KQXS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Dai</label>
                        <div class="col-sm-8">
                            <div class="form-line">
                                <select class="form-control " name="dai" required>
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
                        <label class="col-sm-4 col-form-label">DB</label>
                        <div class="col-sm-8">
                            <div class="form-line">
                                <input type="text" class="form-control" name="db" >
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">g1</label>
                        <div class="col-sm-8">
                            <div class="form-line">
                                <input type="text" name="g1" class="form-control" >
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">g2</label>
                        <div class="col-sm-8">
                            <div class="form-line">
                                <input type="text" name="g2" class="form-control" >
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">g3</label>
                        <div class="col-sm-8">
                            <div class="form-line">
                                <input type="text" name="g3" class="form-control" >
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">g4</label>
                        <div class="col-sm-8">
                            <div class="form-line">
                                <input type="text" name="g4" class="form-control" >
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">g5</label>
                        <div class="col-sm-8">
                            <div class="form-line">
                                <input type="text" name="g5" class="form-control" >
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">g6</label>
                        <div class="col-sm-8">
                            <div class="form-line">
                                <input type="text" name="g6" class="form-control" >
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">g7</label>
                        <div class="col-sm-8">
                            <div class="form-line">
                                <input type="text" name="g7" class="form-control" >
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">g8</label>
                        <div class="col-sm-8">
                            <div class="form-line">
                                <input type="text" name="g8" class="form-control" >
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">lastTwoCode</label>
                        <div class="col-sm-8">
                            <div class="form-line">
                                <input type="text" name="lastTwoCode" class="form-control" >
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Ngày tạo</label>
                        <div class="col-sm-8">
                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" name="createdate"  data-target="#reservationdate">
                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="btnaddnew" class="btn btn-danger">Thêm Mới</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->

<script type="text/javascript">
$(".btnDelete").on("click", function() {
    Swal.fire({
        title: 'Xác nhận xóa kết quả',
        text: "Bạn có chắc chắn xóa kết quả này không ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'XÓA NGAY',
        cancelButtonText: 'HỦY'
    }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                url: "<?=BASE_URL("public/admin/Kqxs.php");?>",
                method: "POST",
                data: {
                    XoaChuyenMuc: true,
                    id: $(this).attr("data-id")
                },
                success: function(response) {
                    $("#thongbao").html(response);
                }
            });
        }
    })
});
</script>
<script>
$(function() {
    $('#addnew').on('click', function(e) {
        $("#staticBackdrop").modal();
        return false;
    });
    $("#datatable").DataTable({
        "responsive": true,
        "autoWidth": false,
    });
});
</script>



<?php 
    require_once("../../public/admin/Footer.php");
?>