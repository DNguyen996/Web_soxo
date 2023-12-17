<?php
require_once("../../config/config.php");
require_once("../../config/function.php");
$title = 'REPORT ' . $PNH->site('tenweb');
require_once("../../public/client/Header.php");
require_once("../../public/client/Sidebar.php");
CheckLogin();

if(isset($_POST['XoaSaved']) )
{
    $id  = check_string($_POST['id']);
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
                    <h1 class="m-0"> Thông tin Report</h1>
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
                                <select class="custom-select" id="username">
                                    <option value="All">All</option>
                                    <?php 
                                    // $member = $PNH->get_list(" SELECT username FROM `tyle` WHERE ref_users ='$my_id' ");
                                    $member = $PNH->get_list(" SELECT username FROM `tyle` WHERE ref_users = '$my_id' GROUP By username ");
                                    if($member){
                                        foreach($member as $value){
                                            $us = $value['username'];
                                            echo '<option value="'.$us.'">'.$us.'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <label class="col-sm-1 col-form-label">Ngày</label>
                            <div class="col-sm-3">
                                <div class="input-group">
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
                                <button type="button" id="btnfilter" class="btn btn-primary"><i class="fas fa-plus"></i><span> Lọc</span>
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
                        <style>
                            #datatable tr td{text-align: center;}
                            /*#datatable td{padding:0px;border: 0.5px solid;vertical-align: inherit;}*/
                            /*#datatable tr th{border: 0.5px solid;}*/
                            .columnparent{display: flex;width: 100%;justify-content: space-around;flex-wrap: wrap;}
                            .columnparent .column5{width:20%}
                            .classtotal{display: flex;justify-content: space-around;flex-wrap: wrap;}
                            .classtotal .titlet{text-align:center;font-weight:700}
                            .borderusername{border: 1px solid #109cedc7;border-radius: 100%;padding: 5px;background: #109cedc7;color: #000;}
                            @media only screen and (max-width: 576px) {
                                .columnparent .column5{width:50%}
                            }
                        </style>
                        <div class="card-body">
                            <div class="classtotal">
                                <div>
                                    <div class="titlet">2C</div>
                                    <div id="div2c"></div>
                                </div>
                                <div>
                                    <div class="titlet">DD</div>
                                    <div id="divdd"></div>
                                </div>
                                <div>
                                    <div class="titlet">3C</div>
                                    <div id="div3c"></div>
                                </div>
                                <div>
                                    <div class="titlet">XC</div>
                                    <div id="divxc"></div>
                                </div>
                                <div>
                                    <div class="titlet">DA</div>
                                    <div id="divda"></div>
                                </div>
                            </div>
                            <div class="classtotal mb-2">
                                <div>
                                    <div class="titlet">XÁC</div>
                                    <div id="divxac"></div>
                                </div>
                                <div>
                                    <div class="titlet">THỰC</div>
                                    <div id="divthuc"></div>
                                </div>
                                <div>
                                    <div class="titlet">TRÚNG</div>
                                    <div id="divtrung"></div>
                                </div>
                                <div>
                                    <div class="titlet">ĂN | THUA</div>
                                    <div id="divanthua"></div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="datatable" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>THÔNG TIN</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        $today = date('Y-m-d');
                                        $username = $_SESSION['username'];
                                        if( $my_level == 'admin' ){
                                            $report = $PNH->get_list(" SELECT * FROM `saved`  ORDER BY id DESC ");
                                            // $report = $PNH->get_list(" SELECT * FROM `saved` WHERE DATE(createdate) = '$today' ORDER BY id DESC ");
                                        }else if( $my_level == 'daily' ){
                                            $report = $PNH->get_list(" SELECT * FROM `saved` WHERE `username` IN (SELECT username FROM `tyle` WHERE ref_users ='$my_id') AND DATE(createdate) = '$today' ");
                                        }
                                        // else{
                                        //     $report = $PNH->get_list(" SELECT * FROM `saved` WHERE `username` = '$username' AND DATE(createdate) = '$today' ");
                                        // }
                                        $tongxachaic    = 0;
                                        $tongthuchaic   = 0;
                                        $tongxacdd      = 0;
                                        $tongthucdd     = 0;
                                        $tongxacbac     = 0;
                                        $tongthucbac    = 0;
                                        $tongxacxc      = 0;
                                        $tongthucxc     = 0;
                                        $tongxacda      = 0;
                                        $tongthucda     = 0;
                                        $tongxacda      = 0;
                                        $tongxac        = 0;
                                        $tongthuc       = 0;
                                        $tonganthua     = 0;
                                        $tongtrung      = 0;
                                        $countreport    = count($report);
                                        if($report){
                                            foreach($report as $key => $value){
                                                $username       = $value['username'];
                                                $dai            = $value['dai'];
                                                $xachaic        = $value['xachaic'];
                                                $tongxachaic   += $xachaic;
                                                $thuchaic       = $value['thuchaic'];
                                                $tongthuchaic  += $thuchaic;
                                                $xacbac         = $value['xacbac'];
                                                $tongxacbac    += $xacbac;
                                                $thucbac        = $value['thucbac'];
                                                $tongthucbac   += $thucbac;
                                                $xacdd          = $value['xacdd'];
                                                $tongxacdd     += $xacdd;
                                                $thucdd         = $value['thucdd'];
                                                $tongthucdd    += $thucdd;
                                                $xacxc          = $value['xacxc'];
                                                $tongxacxc     += $xacxc;
                                                $thucxc         = $value['thucxc'];
                                                $tongthucxc     += $thucxc;
                                                $xacda          = $value['xacda'];
                                                $tongxacda     += $xacda;
                                                $thucda         = $value['thucda'];
                                                $tongthucda    += $thucda;
                                                $totalxac       = $value['totalxac'];
                                                $tongxac       += $totalxac;
                                                $totalthuc      = $value['totalthuc'];
                                                $tongthuc      += $totalthuc;
                                                $totalanthua    = $value['totalanthua'];
                                                $tonganthua    += $totalanthua;
                                                $trung          = $value['trung'];
                                                $tongtrung     += $trung;
                                                $ngaydanh       = date('d-m-Y',strtotime($value['ngaydanh']));
                                                $id             = $value['id'];
                                                echo '<tr>
                                                        <td width="30px">'.$i++.'</td>
                                                        <td>
                                                            <div><span class="borderusername">'.$username.'</span>  | '.$value['dai'].'</div>
                                                            <div>'.$ngaydanh.'</div>
                                                            <div>
                                                                <a type="button" href="/Saved/'.$id.'"
                                                                class="btn btn-primary"><i class="fas fa-folder-open"></i></a>
                                                                <button class="btn btn-danger btnDelete" id="XoaSaved" data-id="'.$id.'"><i
                                                                    class="fas fa-trash"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div style="font-weight: 700;">'.$dai.'</div>
                                                            <div class="columnparent">
                                                                <div class="column5">
                                                                    <div>2C</div>
                                                                    <div>'.$xachaic.'|'.substring($thuchaic).'</div>
                                                                    <div>Xác</div>
                                                                    <div>'.$totalxac.'</div>
                                                                </div>
                                                                <div class="column5">
                                                                    <div>DD</div>
                                                                    <div>'.$xacdd.'|'.substring($thucdd).'</div>
                                                                    <div>Thực</div>
                                                                    <div>'.substring($totalthuc).'</div>
                                                                </div>
                                                                <div class="column5">
                                                                    <div>3C</div>
                                                                    <div>'.$xacbac.'|'.substring($thucbac).'</div>
                                                                    <div>Trúng</div>
                                                                    <div>'.$trung.'</div>
                                                                </div>
                                                                <div class="column5">
                                                                    <div>XC</div>
                                                                    <div>'.$xacxc.'|'.substring($thucxc).'</div>
                                                                    <div>Ăn/ Thua</div>
                                                                    <div>'.coloranthua($totalanthua).'</div>
                                                                </div>
                                                                <div class="column5">
                                                                    <div>Da</div>
                                                                    <div>'.$xacda.'|'.substring($thucda).'</div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>';
                                            ?>
                                            <?php
                                                }
                                            }
                                        ?>
                                    </tbody>
                                    <input type="hidden" id="tongxachaic"   value="<?=$tongxachaic;?>">
                                    <input type="hidden" id="tongthuchaic"  value="<?=substring($tongthuchaic);?>">
                                    <input type="hidden" id="tongxacbac"    value="<?=$tongxacbac;?>">
                                    <input type="hidden" id="tongthucbac"   value="<?=substring($tongthucbac);?>">
                                    <input type="hidden" id="tongxacdd"     value="<?=$tongxacdd;?>">
                                    <input type="hidden" id="tongthucdd"    value="<?=substring($tongthucdd);?>">
                                    <input type="hidden" id="tongxacxc"     value="<?=$tongxacxc;?>">
                                    <input type="hidden" id="tongthucxc"    value="<?=substring($tongthucxc);?>">
                                    <input type="hidden" id="tongxacda"     value="<?=$tongxacda;?>">
                                    <input type="hidden" id="tongthucda"    value="<?=substring($tongthucda);?>">
                                    <input type="hidden" id="tongxac"       value="<?=$tongxac;?>">
                                    <input type="hidden" id="tongthuc"      value="<?=substring($tongthuc);?>">
                                    <input type="hidden" id="tonganthua"    value="<?=$tonganthua;?>">
                                    <input type="hidden" id="tongtrung"     value="<?=$tongtrung;?>">
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
$(document).ready(function() {
    $('#reservation').daterangepicker();
    setTimeout(function() {
        tongxachaic = $('#tongxachaic').val();
        tongthuchaic = $('#tongthuchaic').val();
        $('#div2c').text(tongxachaic+'|'+tongthuchaic);
        tongxacbac = $('#tongxacbac').val();
        tongthucbac = $('#tongthucbac').val();
        $('#div3c').text(tongxacbac+'|'+tongthucbac);
        tongxacdd = $('#tongxacdd').val();
        tongthucdd = $('#tongthucdd').val();
        $('#divdd').text(tongxacdd+'|'+tongthucdd);
        tongxacxc = $('#tongxacxc').val();
        tongthucxc = $('#tongthucxc').val();
        $('#divxc').text(tongxacxc+'|'+tongthucxc);
        tongxacda = $('#tongxacda').val();
        tongthucda = $('#tongthucda').val();
        $('#divda').text(tongxacda+'|'+tongthucda);
        $('#divxac').text($('#tongxac').val());
        $('#divthuc').text($('#tongthuc').val());
        $('#divanthua').text($('#tonganthua').val());
        coloranthua($('#tonganthua').val());
        $('#divtrung').text($('#tongtrung').val());
    }, 1000);
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
                    url: "<?=BASE_URL("public/client/Report.php");?>",
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
    $(document).on('click','#btnfilter', function(e) {
        const username  = $('#username').val();
        const ngay      = $('#reservation').val();
        const mien      = $('#mien').val();
        $('#datatable tbody').empty();
        $.ajax({
            url: "/assets/ajaxs/Filterreport.php",
            type: "post",
            dataType: "json",
            data: {
                type: 'Filterreport',
                username: username,
                ngay: ngay,
                mien: mien,
            },
            success: function(response) {
                console.log(response);
                if(response.status == 'success'){
                    $('#datatable tbody').empty().append(response.content);
                    $('#div2c').text(response.tongxachaic+'|'+response.tongthuchaic);
                    $('#div3c').text(response.tongxacbac+'|'+response.tongthucbac);
                    $('#divdd').text(response.tongxacdd+'|'+response.tongthucdd);
                    $('#divxc').text(response.tongxacxc+'|'+response.tongthucxc);
                    $('#divda').text(response.tongxacda+'|'+response.tongthucda);
                    $('#divxac').text(response.tongxac);
                    $('#divthuc').text(response.tongthuc);
                    $('#divanthua').text(response.tonganthua);
                    coloranthua(response.tonganthua);
                    $('#divtrung').text(response.tongtrung);
                }else{
                    $('#datatable tbody').empty();
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });
    function coloranthua(anthua){
        if(anthua < 0){
            $('#divanthua').css({
              'color': 'red' ,
              'font-weight': '700'
            });
        }else{
            $('#divanthua').css({
              'color': 'green' ,
              'font-weight': '700'
            });
        }
    }
    // $('#datatable').DataTable({
    //     "responsive": true,
    //     "autoWidth": false,
    // });
    // $('#datatable').append('<tfoot><tr><th colspan="7" rowspan="1">Total</th><th id="total_diem" rowspan="1" colspan="1"></th><th id="total_tien" rowspan="1" colspan="1"></th><th id="" rowspan="1" colspan="1"></th><th id="" rowspan="1" colspan="1"></th></tr></tfoot>');
    // var total = total2 = 0;
    // $('#datatable tbody tr').each(function(index){
    //     total = total + parseFloat($(this).find('td:eq(8)').text());
    //     $('#total_tien').text(total.toLocaleString());
    // })
    // $('#datatable tbody tr').each(function(index){
    //     total2 = total2 + parseFloat($(this).find('td:eq(7)').text());
    //     $('#total_diem').text(total2.toLocaleString());
    // })
});
</script>
<?php
require_once("../../public/client/Footer.php");
?>