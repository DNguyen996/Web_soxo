<?php 
    require_once("../../config/config.php");
    require_once("../../config/function.php");

    if($_POST['type'] == 'Filterreport' )
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
                $report = $PNH->get_list(" SELECT * FROM `saved` WHERE DATE(createdate) >= '$formdate' AND DATE(createdate) <= '$todate'   $mien ");
            }else{
                $report = $PNH->get_list(" SELECT * FROM `saved` WHERE `username` = '$user' AND DATE(createdate) >= '$formdate' AND DATE(createdate) <= '$todate'   $mien ");
            }
        }elseif($my_level == 'daily'){
            if($user == 'All'){
                $report = $PNH->get_list(" SELECT * FROM `saved` WHERE `username` IN (SELECT username FROM `tyle` WHERE ref_users ='$my_id') AND DATE(createdate) >= '$formdate' AND DATE(createdate) <= '$todate'   $mien ");
            }else{
                $tableusers = $PNH->get_row(" SELECT username FROM `tyle` WHERE ref_users = '$my_id' AND `username` = '$user'   $mien ");
                if($tableusers){
                    $report = $PNH->get_list(" SELECT * FROM `saved` WHERE `username` = '$user' AND DATE(createdate) >= '$formdate' AND DATE(createdate) <= '$todate'   $mien ");
                }else{
                    $result['status'] = 'error';
                    die (json_encode($result));
                }
            }
        }
        // else{
        //     if($user == $_SESSION['username'] ){
        //         $report = $PNH->get_list(" SELECT * FROM `saved` WHERE `username` = '$user' AND DATE(createdate) >= '$formdate' AND DATE(createdate) <= '$todate'   $mien ");
        //     }else{
        //         $result['status'] = 'error';
        //         die (json_encode($result));                
        //     }
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
        $i = 1;
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
                $content .= '<tr>
                        <td width="30px">'.$i++.'</td>
                        <td>
                            <div><span class="borderusername">'.$username.'</span> | '.$value['dai'].'</div>
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
            }
            $result['status']       = 'success';
            $result['content']      = $content;
            $result['tongxachaic']  = $tongxachaic;
            $result['tongthuchaic'] = substring($tongthuchaic);
            $result['tongxacbac']   = $tongxacbac;
            $result['tongthucbac']  = substring($tongthucbac);
            $result['tongxacdd']    = $tongxacdd;
            $result['tongthucdd']   = substring($tongthucdd);
            $result['tongxacxc']    = $tongxacxc;
            $result['tongthucxc']   = substring($tongthucxc);
            $result['tongxacda']    = $tongxacda;
            $result['tongthucda']   = substring($tongthucda);
            $result['tongxac']      = $tongxac;
            $result['tongthuc']     = substring($tongthuc);
            $result['tonganthua']   = $tonganthua;
            $result['tongtrung']    = $tongtrung;
        }else{
            $result['status'] = 'error';
        }
        die (json_encode($result));
    }
    
    