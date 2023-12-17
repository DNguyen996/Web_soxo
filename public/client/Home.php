<?php
require_once("../../config/config.php");
require_once("../../config/function.php");
$title = 'DASHBROAD | ' . $PNH->site('tenweb');
require_once("../../public/client/Header.php");
require_once("../../public/client/Sidebar.php");
CheckLogin();
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
    <style>
.error{
    background: #ff00004f;
}        
    </style>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="input-group date" id="reservationdate2" data-target-input="nearest">
                                            <input type="text" placeholder="Ngày" class="form-control datetimepicker-input" id="inputday" data-target="#reservationdate2" />
                                            <div class="input-group-append" data-target="#reservationdate2" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <?php
                                    $username = $_SESSION['username'];
                                    // if ($my_level == 'admin') {
                                    //     $report = $PNH->get_list(" SELECT username FROM `tyle` WHERE username != 'admin' ");
                                    // } else if ($my_level == 'daily') {
                                        $report = $PNH->get_list(" SELECT username FROM `tyle` WHERE ref_users = '$my_id' GROUP By username ");
                                    // } 
                                    if (!empty($report)) {
                                    ?>
                                        <select class="custom-select" id="username">
                                            <?php foreach ($report as $value) { ?>
                                                <option value="<?= $value['username']; ?>"><?= $value['username']; ?></option>
                                            <?php } ?>
                                        </select>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-2">
                                    <?php
                                    if (!empty($report)) {
                                    ?>
                                        <select class="custom-select" id="username2">
                                            <option value="">Khách 2</option>
                                            <?php foreach ($report as $value) { ?>
                                                <option value="<?= $value['username']; ?>"><?= $value['username']; ?></option>
                                            <?php } ?>
                                        </select>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-2">
                                    <select class="custom-select" id="choosemien">
                                        <option value="MN">MN</option>
                                        <option value="MT">MT</option>
                                        <option value="MB">MB</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" rows="10" id="content" placeholder="Vui lòng nhập thông tin.."></textarea>
                            </div>
                            <button type="button" id="btncheck" class="btn btn-primary">Kiểm tra</button>
                            <button type="button" id="btnsave" class="btn btn-success">Lưu</button>
                            <button type="button" id="btnclear" class="btn btn-danger">Xóa</button>
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
        $('#reservationdate2').datetimepicker({
            format: 'L'
        });
        $(document).on('click', '#btncheck', function(e) {
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
                        alert('Đã check');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        })
        function coloranthua (anthua){
            if(anthua < 0){
                string = 'color:red;font-weight:700';
            }else{
                string = 'color:green;font-weight:700';
            }
            return string;
        }
        function substring (string){
            string = string.toString();
            if (string == 0){
                string = 0;
            }else{
                string = string.substring(0, string.length - 2) + "." + string.substring(string.length - 2)
            }
            return string;
        }
        function switchname(a) {
            var name = '';
            switch (a) {
                case 'blo':
                    name = '2c';
                    break;
                case '18lo':
                    name = '2c';
                    break;
                case '17lo':
                    name = '3c';
                    break;
                case '17dao':
                    name = '3c';
                    break;
                case '17lod':
                    name = '3c';
                    break;
                case '7d':
                    name = '3c';
                    break;
                case '7lo':
                    name = '3c';
                    break;
                case '7lod':
                    name = '3c';
                    break;
                case '7dao':
                    name = '3c';
                    break;
                case 'xc':
                    name = 'xc';
                    break;
                case 'xd':
                    name = 'xc';
                    break;
                case 'xdao':
                    name = 'xc';
                    break;
                case 'dau':
                    name = 'dd';
                    break;
                case 'a':
                    name = 'dd';
                    break;
                case 'duoi':
                    name = 'dd';
                    break;
                case 'b':
                    name = 'dd';
                    break;
                case 'dd':
                    name = 'dd';
                    break;
                case 'ab':
                    name = 'dd';
                    break;
                default:
                    name = 'da';
            }
            return name;
        }
        $(document).on('click', '#btnsave', function(e) {
            content = $('#content').val();
            inputday = $('#inputday').val();
            username = $('#username').val();
            username2 = $('#username2').val();
            choosemien = $('#choosemien').val();
            if (content == '') {
                alert('Vui lòng nhập dữ liệu');
                return false;
            } else if (inputday == '') {
                alert('Vui lòng chọn ngày');
                return false;
            }
            $.ajax({
                url: "/assets/ajaxs/Saved.php",
                type: "post",
                dataType: "json",
                data: {
                    type: 'Saved',
                    inputday: inputday,
                    content: content,
                    usernamekh: username,
                    usernamekh2: username2,
                    choosemien: choosemien,
                },
                success: function(response) {
                    console.log(response);
                    if (response.status == 1) {
                        alert('Vui lòng kiểm tra lại đài');
                    }else
                    if (response.status == 0) {
                        alert('Đã lưu');
                    }
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
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        })
        $(document).on('click', '#btnclear', function(e) {
            $('#content').val('');
        });
    });
</script>
<?php
require_once("../../public/client/Footer.php");
?>