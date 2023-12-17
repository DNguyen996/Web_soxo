<?php
require_once("../../config/config.php");
require_once("../../config/function.php");
$title = 'DASHBROAD | ' . $PNH->site('tenweb');
require_once("../../public/client/Header.php");
require_once("../../public/client/Sidebar.php");
CheckLogin();

if( isset($_GET['id']) )
{
    $username = $_SESSION['username'];
    $row = $PNH->get_row(" SELECT * FROM `saved` WHERE `id` = '".check_string($_GET['id'])."'  ");
    if(!$row)
    {
        admin_msg_error("ID này không tồn tại", BASE_URL(''), 500);
    }
}
else
{
    admin_msg_error("Liên kết không tồn tại", BASE_URL(''), 0);
}

?>

<div class="content-wrapper" style="min-height: 405px;">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> Thông tin </h1>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="input-group date" id="reservationdate2" data-target-input="nearest">
                                            <input type="text" value="<?=date('m/d/Y',strtotime($row['ngaydanh']));?>" class="form-control datetimepicker-input" id="inputday" data-target="#reservationdate2" />
                                            <div class="input-group-append" data-target="#reservationdate2" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <select class="custom-select" id="username">
                                        <option value="<?=$row['username'];?>"><?=$row['username'];?></option>
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <select class="custom-select" id="choosemien">
                                        <option value="<?=$row['dai'];?>" ><?=$row['dai'];?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" rows="10" id="content" placeholder="Vui lòng nhập thông tin.."><?=$row['so'];?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <table class="table table-bordered" id="tabledetail">
                                <thead>
                                    <tr>
                                        <th>Đài</th>
                                        <th>Số</th>
                                        <th>Kiểu</th>
                                        <th>Đếm Số</th>
                                        <th>Điểm</th>
                                        <th>Xác(Thực)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Đài</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td><span class="badge bg-danger">0(0n)</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card card-success card-outline">
                        <div class="card-body">
                            <table class="table table-bordered" id="tablexacthuc">
                                <thead>
                                    <tr>
                                        <th>Kiểu</th>
                                        <th>Xác</th>
                                        <th>Thực</th>
                                        <th>Trúng | Thực</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>2 số</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td><span class="badge bg-danger">0(0n)</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="card-title m-0">Trúng</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered" id="tabletrungtrat">
                                <thead>
                                    <tr>
                                        <th>Đài</th>
                                        <th>Số</th>
                                        <th>Kiểu</th>
                                        <th>Thực (Xác)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Đài</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td><span class="badge bg-danger">0(0n)</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script type="text/javascript">
    $(document).ready(function() {
        // $('#reservationdate2').datetimepicker({
        //     format: 'L'
        // });
        function autocheck(){
            content = $('#content').val();
            inputday = $('#inputday').val();
            username = $('#username').val();
            choosemien = $('#choosemien').val();
            if (content == '') {
                alert('Vui lòng nhập dữ liệu');
                return false;
            } else if (inputday == '') {
                alert('Vui lòng chọn ngày');
                return false;
            }
            $.ajax({
                url: "/assets/ajaxs/Check.php",
                type: "post",
                dataType: "json",
                data: {
                    type: 'Checkso',
                    inputday: inputday,
                    content: content,
                    usernamekh: username,
                    choosemien: choosemien,
                },
                success: function(response) {
                    console.log(response);
                    if (response.status == 0) {
                        alert(response.content);
                    } else {
                        let res = response.content.map(function(elem) {
                                return `<tr class="`+elem.status+`">
                              <td>` + elem.dai + `</td>
                              <td>` + elem.so + `</td>
                              <td>` + elem.kieu + `</td>
                              <td>` + elem.demso + `</td>
                              <td>` + elem.diem + `</td>
                              <td><span class="badge bg-danger">` + elem.xac + `(` + elem.xac * elem.gia + `)</span></td>
                          </tr>`;
                        });
                        $('#tabledetail tbody').empty().append(res);
                        let tablexacthuc = response.data.map(function(elem) {
                            if (elem.totaldiemtrung == '0'){
                                return `<tr>
                                 <td>` + elem.kieu + `</td>
                                 <td>` + elem.stringxac + `</td>
                                 <td>` + substring(elem.stringthuc) + `</td>
                                 <td><span class="badge bg-danger">0(0)</span></td>
                              </tr>`;
                            }else{
                                 return `<tr>
                                 <td>` + elem.kieu + `</td>
                                 <td>` + elem.stringxac + `</td>
                                 <td>` + substring(elem.stringthuc) + `</td>
                                 <td><span class="badge bg-danger">` + elem.stringtrung + `(` + elem.totaldiemtrung + `)</span></td>
                              </tr>`;
                            }
                        });
                        $('#tablexacthuc tbody').empty().append(tablexacthuc).append(`<tr>
                             <td></td>
                             <td id="totalxac">`+response.totalxac+`</td>
                             <td id="totalthuc">`+substring(response.totalthuc)+`</td>
                             <td id="totaltrungthuc">`+response.totaltrung+`</td>
                          </tr><tr>
                             <td></td>
                             <td></td>
                             <td>Ăn/ Thua</td>
                             <td id="totalanthua" style="`+coloranthua(response.anthua)+`">`+response.anthua+`</td>
                          </tr>`);
                        let contenttrungtrat = ''
                        let tabletrungtrat = response.content.map(function(elem) {
                            if (elem.sotrung != ''){
                                var arr = elem.sotrung.split(' ');
                                $.each( arr, function( index, value ) {
                                    if(value != '' && elem.kieu != 'da' ){
                                        value.split(",").map(function(item) {
                                            contenttrungtrat += `<tr>
                                                <td>` + elem.dai + `</td>
                                                <td>` + item + `</td>
                                                <td>` + elem.kieu + `</td>
                                                <td><span class="badge bg-danger">` + (elem.diem * elem.thuc) + `(` + elem.diem + `)</span></td>
                                            </tr>`;
                                        });                                    
                                    }else if( value != '' ){
                                    contenttrungtrat += `<tr>
                                                <td>` + elem.dai + `</td>
                                                <td>` + value + `</td>
                                                <td>` + elem.kieu + `</td>
                                                <td><span class="badge bg-danger">` + (elem.diem * elem.thuc) + `(` + elem.diem + `)</span></td>
                                            </tr>`;    
                                    }
                                });
                                return contenttrungtrat;
                            }
                        });
                        $('#tabletrungtrat tbody').empty().append(contenttrungtrat);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }
        setTimeout(autocheck, 1000);
        function substring (string){
            string = string.toString();
            if (string == 0){
                string = 0;
            }else{
                string = string.substring(0, string.length - 2) + "." + string.substring(string.length - 2)
            }
            return string;
        }
        function coloranthua (anthua){
            if(anthua < 0){
                string = 'color:red;font-weight:700';
            }else{
                string = 'color:green;font-weight:700';
            }
            return string;
        }
    });
</script>
<?php
require_once("../../public/client/Footer.php");
?>