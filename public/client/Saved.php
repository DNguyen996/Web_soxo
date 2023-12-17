<?php
require_once("../../config/config.php");
require_once("../../config/function.php");
$title = 'SAVED ' . $PNH->site('tenweb');
require_once("../../public/client/Header.php");
require_once("../../public/client/Sidebar.php");
CheckLogin();

if(isset($_POST['XoaSaved']) )
{
    $id     = check_string($_POST['id']);
    $username = $_SESSION['username'];
    $row = $PNH->get_row("SELECT * FROM `saved` WHERE `id` = '$id'  ");
    if(!$row)
    {
        msg_error2("ID cần xóa không tồn tại trong hệ thống !");
    }
    $file = @fopen('../../logs/XoaSaved.txt', 'a');
    if ($file)
    {
        $data = "[LOG] Đơn ".$row['id']." đã bị xóa khỏi hệ thống vào lúc ".gettime().PHP_EOL;
        fwrite($file, $data);
        fclose($file);
    }
    $remove = $PNH->remove("saved", " `id` = '$id' ");
    if($remove){
        admin_msg_success("Xóa thành công !", "", 1000);
    }else{
        admin_msg_warning("Vui lòng liên hệ Admin", "", 1000);
    }
}

?>

<div class="content-wrapper" style="min-height: 405px;">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> SAVED</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div>
                        <div class="form-group row">
                            <label class="col-sm-1 col-form-label">Tên</label>
                            <div class="col-sm-2">
                                <?php
                                $username = $_SESSION['username'];
                                // if ($my_level == 'admin') {
                                //     $report = $PNH->get_list(" SELECT username FROM `users` WHERE username != 'admin' ");
                                // } else if ($my_level == 'daily') {
                                //     $report = $PNH->get_list(" SELECT username FROM `users` WHERE users.ref = '$my_id' ");
                                // } 
                                $report = $PNH->get_list(" SELECT username FROM `tyle` WHERE ref_users = '$my_id' GROUP By username ");
                                if (!empty($report)) {
                                ?>
                                    <select class="custom-select" id="username">
                                        <option value="All">All</option>
                                        <?php foreach ($report as $value) { ?>
                                            <option value="<?= $value['username']; ?>"><?= $value['username']; ?></option>
                                        <?php } ?>
                                    </select>
                                <?php } ?>
                            </div>
                            <label class="col-sm-1 col-form-label">Ngày</label>
                            <div class="col-sm-3">
                                <div class="input-group" style="margin-bottom: 0; margin-top: 0;">
                                <div class="input-group-prepend">
                                <span class="input-group-text">
                                <i class="far fa-calendar-alt"></i>
                                </span>
                                </div>
                                <input type="text" class="form-control float-right" id="reservation">
                                </div>
                            </div>
                            <label class="col-sm-1 col-form-label">Miền</label>
                            <div class="col-sm-2">
                                <select class="custom-select" id="mien">
                                    <option value="All">All</option>
                                    <option value="MB">MB</option>
                                    <option value="MN">MN</option>
                                    <option value="MT">MT</option>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <button type="button" id="btncheckfilter" class="btn btn-primary"><i class="fas fa-plus"></i><span> Lọc</span>
                                </button>
                                <button type="button" id="btndeletesaved" class="btn btn-danger"><i class="fas fa-trash"></i><span> Xóa All</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">DANH SÁCH</h3>
                            <div class="card-tools">
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
                                            $report = $PNH->get_list(" SELECT * FROM `saved` WHERE `username` IN (SELECT username FROM `tyle` WHERE ref_users ='$my_id')  ");
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
        </div>
        <!-- /.row -->
    </section>
</div>

<script>
$(function() {
    $('#reservation').daterangepicker();
   
    $(document).on('click','#btndeletesaved', function(e) {
        const username  = $('#username').val();
        const ngay      = $('#reservation').val();
        const mien      = $('#mien').val();
        $.ajax({
            url: "/assets/ajaxs/Deletesaved.php",
            type: "post",
            dataType: "json",
            data: {
                type: 'Deletesaved',
                username: username,
                ngay: ngay,
                mien: mien,
            },
            success: function(response) {
                if(response.status == 'success'){
                    // $("#staticBackdrop").modal('hide');
                    alert(response.content);
                    location.reload();
                }else{
                    $('#datatable tbody').empty();
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });
    $(document).on('click','#btncheckfilter', function(e) {
        const username  = $('#username').val();
        const ngay      = $('#reservation').val();
        const mien      = $('#mien').val();
        $.ajax({
            url: "/assets/ajaxs/Filtersaved.php",
            type: "post",
            dataType: "json",
            data: {
                type: 'Filtersaved',
                username: username,
                ngay: ngay,
                mien: mien,
            },
            success: function(response) {
                if(response.status == 'success'){
                    $('#datatable tbody').empty().append(response.content);
                    $("#staticBackdrop").modal('hide');
                }else{
                    $('#datatable tbody').empty();
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });
    $(document).on('click','.btnDelete', function(e) {    
        Swal.fire({
            title: 'Xác nhận xóa đơn',
            text: "Bạn có chắc chắn xóa đơn này không ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'XÓA NGAY',
            cancelButtonText: 'HỦY'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?=BASE_URL("public/client/Saved.php");?>",
                    method: "POST",
                    data: {
                        XoaSaved: true,
                        id: $(this).attr("data-id")
                    },
                    success: function(response) {
                        $("#thongbao").html(response);
                    }
                });
            }
        })
    });
    // $("#datatable").DataTable({
    //     "responsive": true,
    //     "autoWidth": false,
    // });
});
</script>
<?php
require_once("../../public/client/Footer.php");
?>