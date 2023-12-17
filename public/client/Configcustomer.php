<?php
require_once("../../config/config.php");
require_once("../../config/function.php");
$title = 'CẤU HÌNH KHÁCH | ' . $PNH->site('tenweb');
require_once("../../public/client/Header.php");
require_once("../../public/client/Sidebar.php");
CheckLogin();

if (isset($_POST['XoaThanhVien'])) {
    $id = check_string($_POST['id']);
    if( $my_level == 'admin' ){
        $row = $PNH->get_row("SELECT username FROM `tyle` WHERE `id` = '$id' ");
        if (!$row) {
            msg_error2("ID cần xóa không tồn tại trong hệ thống !");
        }
        $user = $row['username'];
        $file = @fopen('../../logs/XoaThanhVienDaily.txt', 'a');
        if ($file) {
            $data = "[LOG] Thành viên " . $user . " đã bị xóa khỏi hệ thống vào lúc " . gettime() . PHP_EOL;
            fwrite($file, $data);
            fclose($file);
        }
        $delete = $PNH->remove("tyle", " `username` = '$user' ");
        $delete = $PNH->remove("type", " `username` = '$user' ");
        if ($delete) {
            admin_msg_success("Xóa thành công !", "", 1000);
        } else {
            msg_error2("Vui lòng liên hệ Admin !");
        }
    }else{
        $row = $PNH->get_row("SELECT username FROM `tyle` WHERE `id` = '$id' AND ref_users = '$my_id'  ");
        if (!$row) {
            msg_error2("Bạn không có quyền xóa tài khoản này !");
        }
        $user = $row['username'];
        $file = @fopen('../../logs/XoaThanhVienDaily.txt', 'a');
        if ($file) {
            $data = "[LOG] Thành viên " . $user . " của đại lý ".$my_id." đã bị xóa khỏi hệ thống vào lúc " . gettime() . PHP_EOL;
            fwrite($file, $data);
            fclose($file);
        }
        $delete = $PNH->remove("tyle", " `username` = '$user' ");
        $delete = $PNH->remove("type", " `username` = '$user' ");
        if ($delete) {
            admin_msg_success("Xóa thành công !", "", 1000);
        } else {
            msg_error2("Vui lòng liên hệ Admin !");
        }
    }
}

if (isset($_POST['btnaddnew']) && ($getUser['level'] == 'admin' || $getUser['level'] == 'daily')) {
    if ($PNH->site('status_demo') == 'ON') {
        admin_msg_warning("Chức năng này không khả dụng trên trang web DEMO!", "", 2000);
    }
    $username = check_string($_POST['username']);
    $row = $PNH->get_row(" SELECT * FROM `users` WHERE `username` = '$username'  ");
    if ($row) {
        admin_msg_error("Người dùng này tồn tại", BASE_URL(''), 500);
    }
    $password = check_string($_POST['password']);
    $phone = check_string($_POST['phone']);
    $level = check_string($_POST['level']);
    $ref = check_string($_POST['ref']);
    if ($level != 'member' && $level != 'admin') {
        admin_msg_error("Vui lòng liên hệ admin", BASE_URL('/Configcustomer'), 500);
    }
    $create = $PNH->insert("users", array(
        'username'      => $username,
        'level'         => $level,
        'password'      => TypePassword($password),
        'phone'         => $phone,
        'ref'           => $ref,
        'createdate'    => gettime(),
    ));
    if ($create) {
        $PNH->insert("tyle", array(
            'username'      => $username,
            'dai'           => 'mt',
            'blo'           => 75,
            '18lo'          => 75,
            '17lo'          => 75,
            '17dao'         => 75,
            '17lod'         => 75,
            '17d'           => 75,
            '7lo'           => 75,
            '7lod'          => 75,
            '7dao'          => 75,
            '7d'            => 75,
            'da'            => 75,
            'dau'           => 75,
            'a'             => 75,
            'duoi'          => 75,
            'b'             => 75,
            'dd'            => 75,
            'ab'            => 75,
            'xc'            => 75,
            'xdao'          => 75,
            'xd'            => 75,
            'createdate'    => gettime(),
        ));
        $PNH->insert("tyle", array(
            'username'      => $username,
            'dai'           => 'mn',
            'blo'           => 75,
            '18lo'          => 75,
            '17lo'          => 75,
            '17dao'         => 75,
            '17lod'         => 75,
            '17d'           => 75,
            '7lo'           => 75,
            '7lod'          => 75,
            '7dao'          => 75,
            '7d'            => 75,
            'da'            => 75,
            'dau'           => 75,
            'a'             => 75,
            'duoi'          => 75,
            'b'             => 75,
            'dd'            => 75,
            'ab'            => 75,
            'xc'            => 75,
            'xdao'          => 75,
            'xd'            => 75,
            'createdate'    => gettime(),
        ));
        $PNH->insert("tyle", array(
            'username'      => $username,
            'dai'           => 'mb',
            'da'            => 75,
            'dau'           => 75,
            'a'             => 75,
            'duoi'          => 75,
            'b'             => 75,
            'dd'            => 75,
            'ab'            => 75,
            'xc'            => 75,
            'xdao'          => 75,
            'xd'            => 75,
            '27lo'          => 75,
            '23lo'          => 75,
            '23dao'         => 75,
            '23d'           => 75,
            'createdate'    => gettime(),
        ));
        admin_msg_success("Thêm thành công", '/Configcustomer', 500);
    } else {
        admin_msg_error("Vui lòng liên hệ admin", BASE_URL('/Configcustomer'), 500);
    }
}
?>
<div id="thongbao"></div>
<div class="content-wrapper" style="min-height: 405px;">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> Cấu hình </h1>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="row">
            <div class="container">
                <div class="col-lg-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">DANH SÁCH CẤU HÌNH </h3>
                            <div class="card-tools">
                                <a type="button" href="<?= BASE_URL('CreateConfigcustomer'); ?>" class="btn btn-primary"><span> Thêm mới</span></a>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>TÊN</th>
                                            <th>NGÀY TẠO</th>
                                            <th>THAO TÁC</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $username = $_SESSION['username'];
                                        // if ($my_level == 'admin') {
                                        //     $tyle = $PNH->get_list(" SELECT * FROM `tyle` GROUP BY username ORDER BY id DESC ");
                                        // } elseif ($my_level == 'daily') {
                                            $tyle = $PNH->get_list(" SELECT * FROM `tyle` WHERE ref_users = '$my_id' GROUP By username ORDER BY id DESC ");
                                        // }
                                        $i = 1;
                                        foreach ($tyle as $row) {
                                        ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $row['username']; ?></td>
                                                <td><span class="badge badge-dark"><?= $row['createdate']; ?></span></td>
                                                <td>
                                                    <a type="button" href="<?= BASE_URL('Configcustomer/Edit/'); ?><?= $row['username']; ?>" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                                    <button class="btn btn-danger btnDelete" data-id="<?= $row['id']; ?>"><i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </section>

</div>



<script>
    $(function() {
        $("#datatable").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
        $(document).on("click",".btnDelete", function() {
            Swal.fire({
                title: 'Xác nhận xóa thành viên',
                text: "Bạn có chắc chắn xóa thành viên này không ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'XÓA NGAY',
                cancelButtonText: 'HỦY'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= BASE_URL("public/client/Configcustomer.php"); ?>",
                        method: "POST",
                        data: {
                            XoaThanhVien: true,
                            id: $(this).attr("data-id")
                        },
                        success: function(response) {
                            $("#thongbao").html(response);
                        }
                    });
                }
            })
        });
    });
</script>
<?php
require_once("../../public/client/Footer.php");
?>