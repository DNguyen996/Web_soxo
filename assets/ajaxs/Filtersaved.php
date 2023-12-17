<?php 
    require_once("../../config/config.php");
    require_once("../../config/function.php");

    if($_POST['type'] == 'Filtersaved' )
    {
        $user = check_string($_POST['username']);
        $mien = check_string($_POST['mien']);
        $ngay = check_string($_POST['ngay']);
        $ngay = explode(' - ',$ngay);
        $formdate = date("Y-m-d", strtotime($ngay[0]));
        $todate = date("Y-m-d", strtotime($ngay[1]));
        $result = array();
        if($mien == 'All'){
            $mien = '';
        }else{
            $mien = " AND dai = '$mien' ";
        }
        if($my_level == 'admin'){
            if($user == 'All'){
                $report = $PNH->get_list(" SELECT * FROM `saved` WHERE DATE(createdate) >= '$formdate' AND DATE(createdate) <= '$todate'  $mien ");
            }else{
                $report = $PNH->get_list(" SELECT * FROM `saved` WHERE `username` = '$user' AND DATE(createdate) >= '$formdate' AND DATE(createdate) <= '$todate'  $mien ");
            }
        }else if($my_level == 'daily'){
            if($user == 'All'){
                $report = $PNH->get_list(" SELECT * FROM `saved` WHERE `username` IN (SELECT username FROM `tyle` WHERE ref_users ='$my_id') AND  DATE(createdate) >= '$formdate' AND DATE(createdate) <= '$todate'   $mien ");
            }else{
                $tableusers = $PNH->get_row(" SELECT username FROM `tyle` WHERE ref_users = '$my_id' AND `username` = '$user'   $mien ");
                if($tableusers){
                    $report = $PNH->get_list(" SELECT * FROM `saved` WHERE `username` = '$user' AND  DATE(createdate) >= '$formdate' AND DATE(createdate) <= '$todate'  $mien ");
                }else{
                    $result['status'] = 'error';
                    die (json_encode($result));
                }
            }
        }
        $content = '';
        $i = 1;
        if($report){
            foreach($report as $key => $value){
                $content .= '<tr>
                <td>'.$i++.'</td>
                <td style="width:30%">
                    <div>'.$value['username'].' | '.$value['dai'].'</div>
                    <div>'.substr($value['so'],0,30).'...</div>
                    <div><span class="badge badge-dark">'.date('d-m-Y',strtotime($value['createdate'])).'</span></div>
                </td>
                <td>
                    <div>2c: '.substring($value['thuchaic']).'</div>
                    <div>dd: '.substring($value['thucdd']).'</div>
                    <div>da: '.substring($value['thucda']).'</div>
                </td>
                <td>
                    <div>3c: '.substring($value['thucbac']).'</div>
                    <div>xc: '.substring($value['thucxc']).'</div>
                    <div>Tr: '.$value['trung'].'</div>
                </td>
                <td>
                    <a type="button" href="'.BASE_URL('Saved/').$value['id'].'"
                        class="btn btn-primary"><i class="fas fa-folder-open"></i></a>
                    <button class="btn btn-danger btnDelete" id="XoaSaved" data-id="'.$value['id'].'"><i
                        class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>';
            }    
            $result['status'] = 'success';
            $result['content'] = $content;
        }else{
            $result['status'] = 'error';
        }
        die (json_encode($result));
    }
    
    