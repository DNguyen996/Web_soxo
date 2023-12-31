<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    $title = 'DASHBROAD | '.$PNH->site('tenweb');
    require_once("../../public/admin/Header.php");
    require_once("../../public/admin/Sidebar.php");
?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dashboard</h1>
                </div>
                
            </div>
        </div>
    </section>
    <section class="content">
        <div class="alert alert-warning">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            Nhằm tăng cường bảo mật, PNH khuyên bạn nên thường xuyên thay đổi mật khẩu Admin 7 ngày 1 lần và mật khẩu
            phải thật phức tạp.
        </div>
        <!--<?php if($PNH->num_rows(" SELECT * FROM `token` ") < 3){ ?>
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            Vui lòng thêm Token vào hệ thống để hệ thống check live BM được hoạt động chính xác.
        </div>
        <?php }?>-->
        <?php if($PNH->site('email') == '' || $PNH->site('pass_email') == ''){ ?>
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            Bạn chưa cập nhật SMTP cho website.
        </div>
        <?php }?>
        <div class="row">
            <div class="col-6 col-md-4 text-center">
                <input type="text" class="knob" id="getServerMemoryUsage" data-thickness="0.2" data-angleArc="250"
                    data-angleOffset="-125" value="0" data-width="120" data-height="120" data-fgColor="#00c0ef"
                    data-readonly="true">

                <div class="knob-label">Sử dụng RAM</div>
            </div>
            <div class="col-6 col-md-4 text-center">
                <input type="text" class="knob" id="getServerLoad" data-thickness="0.2" data-angleArc="250"
                    data-angleOffset="-125" value="0" data-width="120" data-height="120" data-fgColor="#dc3545"
                    data-readonly="true">

                <div class="knob-label">Sử dụng CPU</div>
            </div>
            <div class="col-6 col-md-4 text-center">
                <input type="text" class="knob" id="disk_free_space" data-thickness="0.2" data-angleArc="250"
                    data-angleOffset="-125" value="0" data-width="120" data-height="120" data-fgColor="#f39c12"
                    data-readonly="true">

                <div class="knob-label">Sử dụng DISK</div>
            </div>
            <section class="col-lg-6 connectedSortable pt-5">
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3 id="total_users"><?=$PNH->num_rows("SELECT * FROM `users` ");?></h3>
                                <p>Tổng thành viên</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3 id="total_money">
                                    <?=format_cash($PNH->get_row("SELECT SUM(`money`) FROM `users` ")['SUM(`money`)']);?>đ
                                </h3>
                                <p>Tổng số dư thành viên</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-money-bill-alt"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3 id="total_accounts">
                                    <?=format_cash($PNH->num_rows(" SELECT * FROM `taikhoan` WHERE `trangthai` = 'LIVE' AND `code` IS NULL "));?>
                                </h3>
                                <p>Tài khoản đang bán</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-store"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3 id="total_sold">
                                    <?=format_cash($PNH->num_rows(" SELECT * FROM `taikhoan` WHERE  `code` IS NOT NULL "));?>
                                </h3>
                                <p>Tài khoản đã bán</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="col-lg-6 connectedSortable pt-5">
                <div class="chart">
                    <canvas id="ChartNapTien"
                        style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </section>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-money-check-alt"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Doanh thu bán tài khoản trong tháng</span>
                        <span class="info-box-number">
                            <?=format_cash($PNH->get_row("SELECT SUM(`sotien`) FROM `orders` WHERE YEAR(thoigian) = ".date('Y')." AND MONTH(thoigian) = ".date('m')."  ")['SUM(`sotien`)']);?>
                            <small>đ</small>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-shopping-basket"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Tài khoản đã bán trong tháng</span>
                        <span class="info-box-number">
                            <?=format_cash($PNH->num_rows("SELECT * FROM `taikhoan` WHERE YEAR(thoigianmua) = ".date('Y')." AND MONTH(thoigianmua) = ".date('m')."  "));?>
                            <small>nick</small>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Thành viên đăng ký trong tháng</span>
                        <span class="info-box-number">
                            <?=format_cash($PNH->num_rows("SELECT * FROM `users` WHERE YEAR(createdate) = ".date('Y')." AND MONTH(createdate) = ".date('m')."  "));?>
                            <small>user</small>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-money-check-alt"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Tổng tiền nạp trong tháng</span>
                        <span class="info-box-number">
                            <?=format_cash(
                            $PNH->get_row("SELECT SUM(`amount`) FROM `bank_auto` WHERE YEAR(time) = ".date('Y')." AND MONTH(time) = ".date('m')." ")['SUM(`amount`)'] + 
                            $PNH->get_row("SELECT SUM(`amount`) FROM `momo` WHERE YEAR(time) = ".date('Y')." AND MONTH(time) = ".date('m')." ")['SUM(`amount`)'] +
                            $PNH->get_row("SELECT SUM(`thucnhan`) FROM `cards` WHERE `status` = 'thanhcong' AND YEAR(createdate) = ".date('Y')." AND MONTH(createdate) = ".date('m')." ")['SUM(`thucnhan`)']
                            
                            );?>
                            <small>đ</small>
                        </span>
                    </div>
                </div>
            </div>


            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-money-check-alt"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Doanh thu bán tài khoản trong tuần</span>
                        <span class="info-box-number">
                            <?=format_cash($PNH->get_row("SELECT SUM(`sotien`) FROM `orders` WHERE WEEK(thoigian, 1) = WEEK(CURDATE(), 1) ")['SUM(`sotien`)']);?>
                            <small>đ</small>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-shopping-basket"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Tài khoản đã bán trong tuần</span>
                        <span class="info-box-number">
                            <?=format_cash($PNH->num_rows("SELECT * FROM `taikhoan` WHERE WEEK(thoigianmua, 1) = WEEK(CURDATE(), 1)  "));?>
                            <small>nick</small>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Thành viên đăng ký trong tuần</span>
                        <span class="info-box-number">
                            <?=format_cash($PNH->num_rows("SELECT * FROM `users` WHERE WEEK(createdate, 1) = WEEK(CURDATE(), 1) "));?>
                            <small>user</small>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-money-check-alt"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Tổng tiền nạp trong tuần</span>
                        <span class="info-box-number">
                            <?=format_cash(
                            $PNH->get_row("SELECT SUM(`amount`) FROM `bank_auto` WHERE WEEK(time, 1) = WEEK(CURDATE(), 1) ")['SUM(`amount`)'] + 
                            $PNH->get_row("SELECT SUM(`amount`) FROM `momo` WHERE WEEK(time, 1) = WEEK(CURDATE(), 1) ")['SUM(`amount`)'] +
                            $PNH->get_row("SELECT SUM(`thucnhan`) FROM `cards` WHERE `status` = 'thanhcong' AND WEEK(createdate, 1) = WEEK(CURDATE(), 1) ")['SUM(`thucnhan`)']
                            
                            );?>
                            <small>đ</small>
                        </span>
                    </div>
                </div>
            </div>





            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-money-check-alt"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Doanh thu bán tài khoản hôm nay</span>
                        <span class="info-box-number"><b id="doanh_thu_ban_tai_khoan_hom_nay">
                                <?=format_cash($PNH->get_row("SELECT SUM(`sotien`) FROM `orders` WHERE `thoigian` >= DATE(NOW()) AND `thoigian` < DATE(NOW()) + INTERVAL 1 DAY ")['SUM(`sotien`)']);?>
                            </b> <small>đ</small>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-shopping-basket"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Tài khoản đã bán hôm nay</span>
                        <span class="info-box-number"><b id="tai_khoan_da_ban_hom_nay">
                                <?=format_cash($PNH->num_rows("SELECT * FROM `taikhoan` WHERE `thoigianmua` >= DATE(NOW()) AND `thoigianmua` < DATE(NOW()) + INTERVAL 1 DAY "));?>
                            </b> <small>nick</small>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Thành viên đăng ký hôm nay</span>
                        <span class="info-box-number">
                            <b id="thanh_vien_dang_ky_hom_nay"><?=format_cash($PNH->num_rows("SELECT * FROM `users` WHERE `createdate` >= DATE(NOW()) AND `createdate` < DATE(NOW()) + INTERVAL 1 DAY "));?>
                            </b><small>user</small>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-money-check-alt"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Tổng tiền nạp hôm nay</span>
                        <span class="info-box-number">
                            <b id="tong_tien_nap_hom_nay"> <?=format_cash(
                            $PNH->get_row("SELECT SUM(`amount`) FROM `bank_auto` WHERE `time` >= DATE(NOW()) AND `time` < DATE(NOW()) + INTERVAL 1 DAY ")['SUM(`amount`)'] + 
                            $PNH->get_row("SELECT SUM(`amount`) FROM `momo` WHERE `time` >= DATE(NOW()) AND `time` < DATE(NOW()) + INTERVAL 1 DAY ")['SUM(`amount`)'] +
                            $PNH->get_row("SELECT SUM(`thucnhan`) FROM `cards` WHERE `status` = 'thanhcong' AND `createdate` >= DATE(NOW()) AND `createdate` < DATE(NOW()) + INTERVAL 1 DAY ")['SUM(`thucnhan`)']
                            );?></b>
                            <small>đ</small>
                        </span>
                    </div>
                </div>
            </div>

           


            <section class="col-lg-12 connectedSortable pt-5">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">500 LỊCH SỬ DÒNG TIỀN GẦN ĐÂY</h3>
                        <div class="card-tools">
                            <button type="button" class="btn bg-success btn-sm" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn bg-warning btn-sm" data-card-widget="maximize"><i
                                    class="fas fa-expand"></i>
                            </button>
                            <button type="button" class="btn bg-danger btn-sm" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>USERNAME</th>
                                        <th>SỐ TIỀN TRƯỚC</th>
                                        <th>SỐ TIỀN THAY ĐỔI</th>
                                        <th>SỐ TIỀN HIỆN TẠI</th>
                                        <th>THỜI GIAN</th>
                                        <th>NỘI DUNG</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach($PNH->get_list(" SELECT * FROM `dongtien` ORDER BY id DESC LIMIT 500 ") as $row){
                                    ?>
                                    <tr>
                                        <td><?=$i++;?></td>
                                        <td><a
                                                href="<?=BASE_URL('Admin/User/Edit/'.$PNH->getUser($row['username'])['id']);?>"><?=$row['username'];?></a>
                                        </td>
                                        <td><?=format_cash($row['sotientruoc']);?></td>
                                        <td><?=format_cash($row['sotienthaydoi']);?></td>
                                        <td><?=format_cash($row['sotiensau']);?></td>
                                        <td><span class="badge badge-dark"><?=$row['thoigian'];?></span></td>
                                        <td><?=$row['noidung'];?></td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>STT</th>
                                        <th>USERNAME</th>
                                        <th>SỐ TIỀN TRƯỚC</th>
                                        <th>SỐ TIỀN THAY ĐỔI</th>
                                        <th>SỐ TIỀN HIỆN TẠI</th>
                                        <th>THỜI GIAN</th>
                                        <th>NỘI DUNG</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    </s>
                </div>
        </div>
    </section>
    <!-- /.content -->
</div>






<script>
$(function() {


    //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutChartCanvas = $('#ChartNapTien').get(0).getContext('2d')
    var donutData = {
        labels: [
            'Nạp tiền từ ngân hàng',
            'Nạp tiền từ ví momo',
            'Nạp tiền từ thẻ cào',
        ],
        datasets: [{
            data: [
                <?=$PNH->get_row("SELECT SUM(`amount`) FROM `bank_auto` ")['SUM(`amount`)'];?>,
                <?=$PNH->get_row("SELECT SUM(`amount`) FROM `momo` ")['SUM(`amount`)'];?>,
                <?=$PNH->get_row("SELECT SUM(`thucnhan`) FROM `cards` WHERE `status` = 'hoantat' ")['SUM(`thucnhan`)'];?>
            ],
            backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }]
    }
    var donutOptions = {
        maintainAspectRatio: false,
        responsive: true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(donutChartCanvas, {
        type: 'doughnut',
        data: donutData,
        options: donutOptions
    })

})
</script>


<!-- THUÊ CODE WEBSITE THEO YÊU CẦU VUI LÒNG LIÊN HỆ PNH | ZALO: 0964347258 | FB.COM/hau0199 -->
<script type="text/javascript">
$("#update").on("click", function() {
    $('#update').html(
        'Đang tải bản cập nhật <div class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div>'
    ).prop('disabled',
        true);
    Swal.fire({
        title: 'UPDATE',
        text: 'Đang tải bản cập nhật vui lòng đợi...',
        imageUrl: 'https://c.tenor.com/VLLJuwYmqkkAAAAM/error-wait.gif',
        imageWidth: 400,
        imageHeight: 200,
        imageAlt: 'Custom image',
    })
    $.ajax({
        url: "<?=BASE_URL("Update.php");?>",
        method: "POST",
        data: {
            type: 'update'
        },
        success: function(response) {
            $("#thongbao").html(response);
            $('#update').html(
                    'Cập nhật ngay')
                .prop('disabled', false);
        }
    });
});
</script>

<script type="text/javascript">
$(document).ready(function() {
    setTimeout(e => {
        showlog()
    }, 1000)
});
function showlog() {
    $('#modal-default').modal({
        keyboard: true,
        show: true
    });
}
</script>

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