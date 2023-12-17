<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    $title = 'QUẢN LÝ THÀNH VIÊN | '.$PNH->site('tenweb');
    CheckAdmin();
    CheckLogin();
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
if(isset($_POST['btnaddnew']) && $getUser['level'] == 'admin' )
{
    if($PNH->site('status_demo') == 'ON')
    {
        admin_msg_warning("Chức năng này không khả dụng trên trang web DEMO!", "", 2000);
    }
    $username = check_string($_POST['username']);
    $row = $PNH->get_row(" SELECT * FROM `users` WHERE `username` = '$username'  ");
    if($row){
        admin_msg_error("Người dùng này tồn tại", BASE_URL(''), 500);
    }
    $password = check_string($_POST['password']);
    $phone = check_string($_POST['phone']);
    $level = check_string($_POST['level']);
    $create = $PNH->insert("users", array(
        'username'      => $username,
        'level'         => $level,
        'password'      => TypePassword($password),
        'phone'         => $phone,
        'createdate'    => gettime(),
    ));
    if($create){
        $PNH->insert("tyle", array(
            'username'      => $username,
            'dai'           => 'mt',
            'blo'           => 75,
            '18lo'          => 75,
            '17lo'          => 75,
            '17dao'          => 75,
            '17lod'          => 75,
            '7lo'          => 75,
            '7lod'          => 75,
            '7dao'          => 75,
            'da'          => 75,
            'dau'          => 75,
            'a'          => 75,
            'duoi'          => 75,
            'b'          => 75,
            'dd'          => 75,
            'ab'          => 75,
            'xc'          => 75,
            'xdao'          => 75,
            'xd'          => 75,
            'createdate'    => gettime(),
        ));
        $PNH->insert("tyle", array(
            'username'      => $username,
            'dai'           => 'mn',
            'blo'           => 75,
            '18lo'          => 75,
            '17lo'          => 75,
            '17dao'          => 75,
            '17lod'          => 75,
            '7lo'          => 75,
            '7lod'          => 75,
            '7dao'          => 75,
            'da'          => 75,
            'dau'          => 75,
            'a'          => 75,
            'duoi'          => 75,
            'b'             => 75,
            'dd'          => 75,
            'ab'          => 75,
            'xc'          => 75,
            'xdao'          => 75,
            'xd'          => 75,
            'createdate'    => gettime(),
        ));
        $PNH->insert("tyle", array(
            'username'      => $username,
            'dai'           => 'mb',
            'da'          => 75,
            'dau'          => 75,
            'a'          => 75,
            'duoi'          => 75,
            'b'             => 75,
            'dd'          => 75,
            'ab'          => 75,
            'xc'          => 75,
            'xdao'          => 75,
            'xd'          => 75,
            '27lo'          => 75,
            '23lo'          => 75,
            '23dao'          => 75,
            '23d'          => 75,
            'createdate'    => gettime(),
        ));
        admin_msg_success("Thêm thành công", '/Admin/Users', 500);
    }else{
        admin_msg_error("Vui lòng liên hệ admin", BASE_URL('/Admin/Users'), 500);
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
                    <h1>Quản lý thành viên</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">DANH SÁCH THÀNH VIÊN</h3>
                        <div class="card-tools">
                            <button type="button" id="addnew" class="btn btn-primary"><i class="fas fa-plus"></i><span> ADD</span>
                            </button>
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
                                        <th>USERNAME</th>
                                        <th>PHONE</th>
                                        <th>CẤP ĐỘ</th>
                                        <th>TRẠNG THÁI</th>
                                        <th>NGÀY TẠO</th>
                                        <th>THAO TÁC</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach($PNH->get_list(" SELECT * FROM `users` WHERE `username` IS NOT NULL ORDER BY id DESC ") as $row){
                                    ?>
                                    <tr>
                                        <td><?=$row['id'];?></td>
                                        <td><?=$row['username'];?></td>
                                        <td><?=$row['phone'];?></td>
                                        <td><?=$row['level'];?></td>
                                        <td><?=checkbanned($row['banned']);?></td>
                                        <td><span class="badge badge-dark"><?=$row['createdate'];?></span></td>
                                        <td>
                                            <a type="button" href="<?=BASE_URL('Admin/User/Edit/');?><?=$row['id'];?>"
                                                class="btn btn-primary"><i class="fas fa-edit"></i>
                                                <span>EDIT</span></a>
                                                <a type="button" href="<?=BASE_URL('Admin/User/Delete/');?><?=$row['id'];?>"
                                                class="btn btn-danger"><i class="fas fa-trash"></i>
                                                <span>DELETE</span></a>
                                            <a type="button" href="<?=BASE_URL('public/admin/Users.php?login=');?><?=$row['username'];?>"
                                                class="btn btn-danger"><i class="fas fa-sign-in-alt"></i>
                                                <span>LOGIN</span></a>
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
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">THÊM USER</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Username</label>
                        <div class="col-sm-8">
                            <div class="form-line">
                                <input type="text" name="username" class="form-control" required>
                            </div>
                        </div>
                    </div>                    
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Mật khẩu</label>
                        <div class="col-sm-8">
                            <div class="form-line">
                                <input type="text" name="password" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Phone</label>
                        <div class="col-sm-8">
                            <div class="form-line">
                                <input type="text" name="phone" class="form-control" >
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Ref ID</label>
                        <div class="col-sm-8">
                            <div class="form-line">
                                <input type="text" name="ref" class="form-control" >
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Level</label>
                        <div class="col-sm-8">
                            <select class="custom-select" name="level">
                                <option value="daily">daily</option>
                            </select>
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