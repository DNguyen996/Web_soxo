<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    $title = 'QUẢN LÝ SAVED | '.$PNH->site('tenweb');
    CheckLogin();
    CheckAdmin();
    require_once("../../public/admin/Header.php");
    require_once("../../public/admin/Sidebar.php");
?>

<?php


?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản lý Saved</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">DANH SÁCH Saved</h3>
                        <div class="card-tools">
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
                                            <th>THÔNG TIN</th>
                                            <th></th>
                                            <th></th>
                                            <th>HÀNH ĐỘNG</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        $username = $_SESSION['username'];
                                        if( $my_level == 'admin' ){
                                            $report = $PNH->get_list(" SELECT * FROM `saved`  ORDER BY id DESC ");
                                        }else if( $my_level == 'daily' ){
                                            $report = $PNH->get_list(" SELECT * FROM `saved` WHERE `username` IN (SELECT username FROM `tyle` WHERE ref_users ='$my_id') AND trangthai = 'Trúng' ");
                                        }
                                        // else{
                                        //     $report = $PNH->get_list(" SELECT * FROM `saved` WHERE `username` = '$username' ORDER BY id DESC ");
                                        // }
                                        foreach($report as $row){
                                        ?>
                                        <tr>
                                            <td><?=$i++;?></td>
                                            <td style="width:30%">
                                                <div><?=$row['username'];?> | <?=$row['dai'];?></div>
                                                <div><?=substr($row['so'],0,30);?>...</div>
                                                <div><span class="badge badge-dark"><?=date('d-m-Y',strtotime($row['createdate']));?></span></div>
                                            </td>
                                            <td>
                                                <div>2c: <?=substring($row['thuchaic']);?></div>
                                                <div>dd: <?=substring($row['thucdd']);?></div>
                                                <div>da: <?=substring($row['thucda']);?></div>
                                            </td>
                                            <td>
                                                <div>3c: <?=substring($row['thucbac']);?></div>
                                                <div>xc: <?=substring($row['thucxc']);?></div>
                                                <div>Tr: <?=$row['trung'];?></div>
                                            </td>
                                            <td>
                                                <a type="button" href="<?=BASE_URL('Saved/');?><?=$row['id'];?>"
                                                    class="btn btn-primary"><i class="fas fa-folder-open"></i></a>
                                                <button class="btn btn-danger btnDelete" id="XoaSaved" data-id="<?=$row['id'];?>"><i
                                                    class="fas fa-trash"></i>
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
                                <input type="text" name="phone" class="form-control" required>
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