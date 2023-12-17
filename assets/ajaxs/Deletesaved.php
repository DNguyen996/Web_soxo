<?php 
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    
    if($_POST['type'] == 'Deletesaved' )
    {
        $user = check_string($_POST['username']);
        $mien = check_string($_POST['mien']);
        $ngay = check_string($_POST['ngay']);
        $ngay = explode(' - ',$ngay);
        $formdate   = date("Y-m-d", strtotime($ngay[0]));
        $todate     = date("Y-m-d", strtotime($ngay[1]));
        $result = array();
        if($mien == 'All'){
            $mien = '';
        }else{
            $mien = " AND dai = '".$mien."' ";
        }
        if($my_level == 'admin'){
            if($user == 'All'){
                $report = $PNH->remove("saved", " DATE(createdate) >= '$formdate' AND DATE(createdate) <= '$todate'  $mien ");
            }else{
                $report = $PNH->remove("saved", "  `username` = '$user' AND DATE(createdate) >= '$formdate' AND DATE(createdate) <= '$todate'  $mien ");
            }
        }else 
        if($my_level == 'daily'){
            if($user == 'All'){
                // $report = $PNH->get_row(" DELETE FROM `saved` WHERE `username` IN (SELECT username FROM `tyle` WHERE ref_users ='$my_id') AND  DATE(createdate) >= '$formdate' AND DATE(createdate) <= '$todate'   $mien ");
                
                $report = $PNH->remove("saved", " `username` IN (SELECT username FROM `tyle` WHERE ref_users ='$my_id') AND  DATE(createdate) >= '$formdate' AND DATE(createdate) <= '$todate'   $mien ");
            }else{
                // $tableusers = $PNH->get_row(" DELETE username FROM `users` WHERE ref = '$my_id' AND `username` = '$user'   $mien ");
                $tableusers = $PNH->remove("saved", " ref = '$my_id' AND `username` = '$user'   $mien ");
                if($tableusers){
                    $report = $PNH->remove("saved", " `username` = '$user' AND  DATE(createdate) >= '$formdate' AND DATE(createdate) <= '$todate'  $mien ");
                    // $report = $PNH->get_row(" DELETE FROM `saved` WHERE `username` = '$user' AND  DATE(createdate) >= '$formdate' AND DATE(createdate) <= '$todate'  $mien ");
                }else{
                    $result['status'] = 'error';
                    die (json_encode($result));
                }
            }
        }
        if($report){
            $result['status']  = 'success';
            $result['content'] = 'Xóa thành công!';
        }else{
            $result['status'] = 'error';
        }
        die (json_encode($result));
    }