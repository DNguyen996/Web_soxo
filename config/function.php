<?php
$PNH = new PNH;
$MEMO_PREFIX        = $PNH->site('noidung_naptien');
$site_gmail_momo    = $PNH->site('email');
$site_pass_momo     = $PNH->site('pass_email');

$config = [
    'version'   => '1.1.0',
    'ip_server' => '127.0.0.1',
];
function get_real_ip(){
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
			  $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
			  $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
	}
	$client  = @$_SERVER['HTTP_CLIENT_IP'];
	$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
	$remote  = $_SERVER['REMOTE_ADDR'];

	if(filter_var($client, FILTER_VALIDATE_IP)) { $ip = $client; }
	elseif(filter_var($forward, FILTER_VALIDATE_IP)) { $ip = $forward; }
	else { $ip = $remote; }

	return $ip;
}

function substring ($string){
    $string = strval($string);
    if ($string == 0){
        $string = 0;
    }else{
        $string = substr($string, 0, strlen($string)-2) . "." .substr($string, -2);
    }
    return $string;
}

function checkbanned($banned){
    if($banned == 0){
        $banned = '<span class="badge badge-success">Active</span>';
    }else{
        $banned = '<span class="badge badge-danger">Banned</span>';
    }
    return $banned;
}
function coloranthua($anthua){
    if($anthua < 0){
        $anthua = '<span style="color:red;font-weight:700">'.$anthua.'</span>';
    }else{
        $anthua = '<span style="color:green;font-weight:700">'.$anthua.'</span>';
    }
    return $anthua;
}
function convertname($a) {
    switch ($a) {
        case 'blo':
            $name = '2c';
            break;
        case '17lo':
            $name = '3c';
            break;
        case 'xc':
            $name = 'xc';
            break;
        case 'dd':
            $name = 'dd';
            break;
        default:
            $name = 'da';
    }
    return $name;
}
function changekieusame( $name ){
    switch ($name) {
        case '27lo':
            $name = 'blo';
            break;
        case '23lo':
            $name = '17lo';
            break;
        case '23dao':
            $name = '17lo';
            break;
        case '23d':
            $name = '17lo';
            break;
        case '18lo':
            $name = 'blo';
            break;
        case 'bdao':
            $name = 'blo';
            break;
        case '17dao':
            $name = '17lo';
            break;
        case '17lod':
            $name = '17lo';
            break;
        case '17d':
            $name = '17lo';
            break;
        case '7lod':
            $name = '17lo';
            break;
        case '7dao':
            $name = '17lo';
            break;
        case '7d':
            $name = '17lo';
            break;
        case '7lo':
            $name = '17lo';
            break;
        case 'xdao':
            $name = 'xc';
            break;
        case 'xd':
            $name = 'xc';
            break;
        case 'dau':
            $name = 'dd';
            break;
        case 'duoi':
            $name = 'dd';
            break;
        case 'ab':
            $name = 'dd';
            break;
        case 'a':
            $name = 'dd';
            break;
        case 'b':
            $name = 'dd';
            break;
        default:
            $name;
            break;
    }
    return $name;
}
function sortByKieu($a, $b) {
    return strcmp($a["kieu"], $b["kieu"]);
}
function filltabletrungthuc($input){
    $stringkieu         = '';
    $stringxac          = 0;
    $stringgia          = 0;
    $stringthuc         = 0;
    $stringtrung        = 0;
    $stringdiemtrung    = 0;
    $haic               = 0;
    $bac                = 0;
    $dd                 = 0;
    $xc                 = 0;
    $da                 = 0;
    $totalxac           = 0;
    $totalgia           = 0;
    $totalthuc          = 0;
    $totaltrung         = 0;
    $totaldiemtrung     = 0;
    $resulttrung = $resulttrat = $kq = array();
    if (!empty($input)){
        foreach($input as $value){
            $trangthai = $value['trangthai'];
            if($trangthai == 'Trúng'){
                $child['kieu']          = changekieusame($value['kieu']);
                $child['xac']           = $value['xac'];
                $child['gia']           = $value['gia'];
                $child['thuc']          = $value['thuc'];
                $child['diem']          = $value['diem'];
                $child['sotien']        = $value['sotien'];
                $child['diemtrung']     = $value['diemtrung'];
                array_push($resulttrung, $child);
                $child = array();
            }else{
                $childtrat['kieu']          = changekieusame($value['kieu']);
                $childtrat['xac']           = $value['xac'];
                $childtrat['gia']           = $value['gia'];
                $childtrat['thuc']          = $value['thuc'];
                $childtrat['diem']          = $value['diem'];
                $childtrat['sotien']        = 0;
                $childtrat['diemtrung']     = 0;
                array_push($resulttrung, $childtrat);
                $childtrat = array();
            }
        }
    }
    
    usort($resulttrung, "sortByKieu");
    // echo '<pre>';
    // print_r($resulttrung); 
    if( !empty($resulttrung) ){
        $length = count($resulttrung);
        foreach($resulttrung as $key => $value){
            $kieu         = changekieusame($value['kieu']);
            $xac          = $value['xac'];
            $gia          = $value['gia'];
            $thuc         = $value['thuc'];
            $diem         = $value['diem'];
            $sotien       = $value['sotien'];
            $diemtrung    = $value['diemtrung'];
            if($key == 0){
                $stringkieu      = $kieu;
                $stringxac       = intval($xac);
                $stringgia       = intval($gia);
                $stringthuc      = intval($xac) * intval($gia);
                $stringtrung     += intval($diemtrung) * intval($thuc);
                $totalxac        += intval($xac);
                $totalthuc       += intval($xac) * intval($gia);
                $totaltrung      += intval($diemtrung) * intval($thuc);
                // $totaltrung      += intval($sotien);
                $totaldiemtrung  = intval($diemtrung);
                if( $length - 1 == $key ){
                    $kieu                   = convertname($kieu);
                    $nd['kieu']             = $kieu;
                    $nd['stringxac']        = $stringxac;
                    $nd['stringgia']        = $stringgia;
                    $nd['stringthuc']       = $stringthuc;
                    $nd['stringtrung']      = $stringtrung;
                    $nd['totaldiemtrung']   = $totaldiemtrung;
                    if( $kieu == '2c' ){
                        $haic = $stringtrung;
                    }elseif ( $kieu == '3c' ){
                        $bac = $stringtrung;
                    }elseif ( $kieu == 'xc' ) {
                        $xc = $stringtrung;
                    }elseif ( $kieu == 'dd' ) {
                        $dd = $stringtrung;
                    }elseif ( $kieu == 'da' ) {
                        $da = $stringtrung;
                    }
                    array_push($kq, $nd);
                    $nd = array();
                }
            }else if($stringkieu != $kieu){
                $stringkieu             = convertname($stringkieu);
                $nd['kieu']             = $stringkieu;
                $nd['stringxac']        = $stringxac;
                $nd['stringgia']        = $stringgia;
                $nd['stringthuc']       = $stringthuc;
                $nd['stringtrung']      = $stringtrung;
                $nd['totaldiemtrung']   = $totaldiemtrung;
                if( $stringkieu == '2c' ){
                    $haic = $stringtrung;
                }elseif ( $stringkieu == '3c' ){
                    $bac = $stringtrung;
                }elseif ( $stringkieu == 'xc' ) {
                    $xc = $stringtrung;
                }elseif ( $stringkieu == 'dd' ) {
                    $dd = $stringtrung;
                }elseif ( $stringkieu == 'da' ) {
                    $da = $stringtrung;
                }
                array_push($kq, $nd);
                $nd = array();
                $stringxac          = 0;
                $stringthuc         = 0;
                $stringtrung        = 0;
                $stringkieu         = $kieu;
                $stringxac          = intval($xac);
                $stringgia          = intval($gia);
                $stringthuc         = intval($xac) * intval($gia);
                $stringtrung        += intval($diemtrung) * intval($thuc);
                $totalxac           += intval($xac);
                $totalthuc          += intval($xac) * intval($gia);
                $totaltrung         += intval($diemtrung) * intval($thuc);
                // $totaltrung         += intval($sotien);
                $totaldiemtrung     = intval($diemtrung);
                if( $length - 1 == $key ){
                    $kieu                   = convertname($kieu);
                    $nd['kieu']             = $kieu;
                    $nd['stringxac']        = $stringxac;
                    $nd['stringgia']        = $stringgia;
                    $nd['stringthuc']       = $stringthuc;
                    $nd['stringtrung']      = $stringtrung;
                    $nd['totaldiemtrung']   = $totaldiemtrung;
                    if( $kieu == '2c' ){
                        $haic = $stringtrung;
                    }elseif ( $kieu == '3c' ){
                        $bac = $stringtrung;
                    }elseif ( $kieu == 'xc' ) {
                        $xc = $stringtrung;
                    }elseif ( $kieu == 'dd' ) {
                        $dd = $stringtrung;
                    }elseif ( $kieu == 'da' ) {
                        $da = $stringtrung;
                    }
                    array_push($kq, $nd);
                    $nd = array();
                }
            }else if( $stringkieu == $kieu ){
                $stringxac          += intval($xac);
                $stringgia          = intval($gia);
                $stringthuc         += intval($xac) * intval($gia);
                $stringtrung        += intval($diemtrung) * intval($thuc);
                $totalxac           += intval($xac);
                $totalthuc          += intval($xac) * intval($gia);
                $totaltrung         += intval($diemtrung) * intval($thuc);
                // $totaltrung         += intval($sotien);
                $totaldiemtrung     += intval($diemtrung);
                if( $length - 1 == $key ){
                    $kieu                   = convertname($kieu);
                    $nd['kieu']             = $kieu;
                    $nd['stringxac']        = $stringxac;
                    $nd['stringgia']        = $stringgia;
                    $nd['stringthuc']       = $stringthuc;
                    $nd['stringtrung']      = $stringtrung;
                    $nd['totaldiemtrung']   = $totaldiemtrung;
                    if( $kieu == '2c' ){
                        $haic = $stringtrung;
                    }elseif ( $kieu == '3c' ){
                        $bac = $stringtrung;
                    }elseif ( $kieu == 'xc' ) {
                        $xc = $stringtrung;
                    }elseif ( $kieu == 'dd' ) {
                        $dd = $stringtrung;
                    }elseif ( $kieu == 'da' ) {
                        $da = $stringtrung;
                    }
                    array_push($kq, $nd);
                    $nd = array();
                }
            }
        }
    }
    return [$kq, $haic, $bac, $xc, $dd, $da, $totaltrung, $totalxac, $totalthuc];
}

function daocap($content){
    // var_dump($content);
    $length = count($content);
    $result = array();
    // if ($length == 3){
    //     $pos1 = $content[0];
    //     $pos2 = $content[1];
    //     $pos3 = $content[2];
    //     $vt1 = $pos1.' '.$pos2;
    //     $vt2 = $pos2.' '.$pos3;
    //     $vt3 = $pos1.' '.$pos3;
    //     $flexiple = array($vt1, $vt2, $vt3);
    //     foreach ($flexiple as $value) {
    //         if( in_array( $value ,$result ) ){
    //         }else{
    //             array_push($result, $value);
    //         }
    //     }
    // }else if($length == 4){
    //     $pos1 = $content[0];
    //     $pos2 = $content[1];
    //     $pos3 = $content[2];
    //     $pos4 = $content[3];
    //     $vt1 = $pos1.' '.$pos2;
    //     $vt2 = $pos1.' '.$pos3;
    //     $vt3 = $pos1.' '.$pos4;
    //     $vt4 = $pos2.' '.$pos3;
    //     $vt5 = $pos2.' '.$pos4;
    //     $vt6 = $pos3.' '.$pos4;
    //     $flexiple = array($vt1, $vt2, $vt3, $vt4, $vt5, $vt6);
    //     foreach ($flexiple as $value) {
    //         if( in_array( $value ,$result ) ){
    //         }else{
    //             array_push($result, $value);
    //         }
    //     }
    // }else if($length == 5){
    //     $pos1 = $content[0];
    //     $pos2 = $content[1];
    //     $pos3 = $content[2];
    //     $pos4 = $content[3];
    //     $pos5 = $content[4];
    //     $vt1  = $pos1.' '.$pos2;
    //     $vt2  = $pos1.' '.$pos3;
    //     $vt3  = $pos1.' '.$pos4;
    //     $vt4  = $pos2.' '.$pos3;
    //     $vt5  = $pos2.' '.$pos4;
    //     $vt6  = $pos3.' '.$pos4;
    //     $vt7  = $pos3.' '.$pos5;
    //     $vt8  = $pos1.' '.$pos5;
    //     $vt9  = $pos2.' '.$pos5;
    //     $vt10 = $pos4.' '.$pos5;
    //     $flexiple = array($vt1, $vt2, $vt3, $vt4, $vt5, $vt6, $vt7, $vt8, $vt9, $vt10);
    //     foreach ($flexiple as $value) {
    //         if( in_array( $value ,$result ) ){
    //         }else{
    //             array_push($result, $value);
    //         }
    //     }
    // }else if($length == 6){
    //     $pos1 = $content[0];
    //     $pos2 = $content[1];
    //     $pos3 = $content[2];
    //     $pos4 = $content[3];
    //     $pos5 = $content[4];
    //     $pos6 = $content[5];
    //     $vt1  = $pos1.' '.$pos2;
    //     $vt2  = $pos1.' '.$pos3;
    //     $vt3  = $pos1.' '.$pos4;
    //     $vt4  = $pos1.' '.$pos5;
    //     $vt5  = $pos1.' '.$pos6;
    //     $vt5  = $pos2.' '.$pos3;
    //     $vt6  = $pos2.' '.$pos4;
    //     $vt7  = $pos2.' '.$pos5;
    //     $vt8  = $pos2.' '.$pos6;
    //     $vt9  = $pos3.' '.$pos4;
    //     $vt10  = $pos3.' '.$pos5;
    //     $vt11  = $pos3.' '.$pos6;
    //     $vt12  = $pos4.' '.$pos5;
    //     $vt13  = $pos4.' '.$pos6;
    //     $flexiple = array($vt1, $vt2, $vt3, $vt4, $vt5, $vt6, $vt7, $vt8, $vt9, $vt10, $vt11, $vt12, $vt13);
    //     foreach ($flexiple as $value) {
    //         if( in_array( $value ,$result ) ){
    //         }else{
    //             array_push($result, $value);
    //         }
    //     }
    // }else if($length == 7){
    //     $pos1 = $content[0];
    //     $pos2 = $content[1];
    //     $pos3 = $content[2];
    //     $pos4 = $content[3];
    //     $pos5 = $content[4];
    //     $pos6 = $content[5];
    //     $pos7 = $content[6];
    //     $vt1  = $pos1.' '.$pos2;
    //     $vt2  = $pos1.' '.$pos3;
    //     $vt3  = $pos1.' '.$pos4;
    //     $vt4  = $pos1.' '.$pos5;
    //     $vt5  = $pos1.' '.$pos6;
    //     $vt6  = $pos1.' '.$pos7;
    //     $vt7  = $pos2.' '.$pos3;
    //     $vt8  = $pos2.' '.$pos4;
    //     $vt9  = $pos2.' '.$pos5;
    //     $vt10  = $pos2.' '.$pos6;
    //     $vt11  = $pos2.' '.$pos7;
    //     $vt12  = $pos3.' '.$pos4;
    //     $vt13  = $pos3.' '.$pos5;
    //     $vt14  = $pos3.' '.$pos6;
    //     $vt15  = $pos3.' '.$pos7;
    //     $vt16  = $pos4.' '.$pos5;
    //     $vt17  = $pos4.' '.$pos6;
    //     $vt18  = $pos4.' '.$pos7;
    //     $vt19  = $pos5.' '.$pos6;
    //     $vt20  = $pos5.' '.$pos7;
    //     $vt21  = $pos6.' '.$pos7;
    //     $flexiple = array($vt1, $vt2, $vt3, $vt4, $vt5, $vt6, $vt7, $vt8, $vt9, $vt10, $vt11, $vt12, $vt13, $vt14, $vt15, $vt16, $vt17, $vt18, $vt19, $vt20, $vt21);
    //     foreach ($flexiple as $value) {
    //         if( in_array( $value ,$result ) ){
    //         }else{
    //             array_push($result, $value);
    //         }
    //     }
    // }else if($length == 8){
    //     $pos1 = $content[0];
    //     $pos2 = $content[1];
    //     $pos3 = $content[2];
    //     $pos4 = $content[3];
    //     $pos5 = $content[4];
    //     $pos6 = $content[5];
    //     $pos7 = $content[6];
    //     $pos8 = $content[7];
    //     $vt1  = $pos1.' '.$pos2;
    //     $vt2  = $pos1.' '.$pos3;
    //     $vt3  = $pos1.' '.$pos4;
    //     $vt4  = $pos1.' '.$pos5;
    //     $vt5  = $pos1.' '.$pos6;
    //     $vt6  = $pos1.' '.$pos7;
    //     $vt7  = $pos1.' '.$pos8;
    //     $vt8  = $pos2.' '.$pos3;
    //     $vt9  = $pos2.' '.$pos4;
    //     $vt10  = $pos2.' '.$pos5;
    //     $vt11  = $pos2.' '.$pos6;
    //     $vt12  = $pos2.' '.$pos7;
    //     $vt13  = $pos2.' '.$pos8;
    //     $vt14  = $pos3.' '.$pos4;
    //     $vt15  = $pos3.' '.$pos5;
    //     $vt16  = $pos3.' '.$pos6;
    //     $vt17  = $pos3.' '.$pos7;
    //     $vt18  = $pos3.' '.$pos8;
    //     $vt19  = $pos4.' '.$pos5;
    //     $vt20  = $pos4.' '.$pos6;
    //     $vt21  = $pos4.' '.$pos7;
    //     $vt22  = $pos4.' '.$pos8;
    //     $vt22  = $pos5.' '.$pos6;
    //     $vt23  = $pos5.' '.$pos7;
    //     $vt24  = $pos5.' '.$pos8;
    //     $vt25  = $pos6.' '.$pos7;
    //     $vt26  = $pos6.' '.$pos8;
    //     $vt27  = $pos7.' '.$pos8;
    //     $flexiple = array($vt1, $vt2, $vt3, $vt4, $vt5, $vt6, $vt7, $vt8, $vt9, $vt10, $vt11, $vt12, $vt13, $vt14, $vt15, $vt16, $vt17, $vt18, $vt19, $vt20, $vt21, $vt22
    //     , $vt23, $vt24, $vt25, $vt26, $vt27);
    //     foreach ($flexiple as $value) {
    //         if( in_array( $value ,$result ) ){
    //         }else{
    //             array_push($result, $value);
    //         }
    //     }
    // }else{
        // $numbers = explode(" ", $content);
        if (count($content) >= 1) {
            for ($i = 0; $i < count($content); $i++) {
                for ($j = $i + 1; $j < count($content); $j++) {
                    $value = $content[$i] . ' ' . $content[$j];
                    array_push($result, $value);
                }
            }
        }
    // }
    return $result;
    die();
}

function daodonvi($content){
    $length = strlen($content);
    $result = array();
    $count = 0;
    if ($length == 3){
        $pos1 = substr($content,0,1);
        $pos2 = substr($content,1,1);
        $pos3 = substr($content,2,1);
        $vt1 = $pos1.$pos2.$pos3;
        $vt2 = $pos1.$pos3.$pos2;
        $vt3 = $pos3.$pos1.$pos2;
        $vt4 = $pos3.$pos2.$pos1;
        $vt5 = $pos2.$pos3.$pos1;
        $vt6 = $pos2.$pos1.$pos3;
        $flexiple = array($vt1, $vt2, $vt3, $vt4, $vt5, $vt6);
        foreach ($flexiple as $value) {
            if( in_array( $value ,$result ) ){
            }else{
                array_push($result, $value);
                $count += 1;
            }
        }
    }else if ($length == 2){
        $pos1 = substr($content,0,1);
        $pos2 = substr($content,1,1);
        $vt1 = $pos1.$pos2;
        $vt2 = $pos2.$pos1;
        $flexiple = array($vt1, $vt2);
        foreach ($flexiple as $value) {
            if( in_array( $value ,$result ) ){
            }else{
                array_push($result, $value);
                $count += 1;
            }
        }
    }
    return [$result, $count];
    die();
}

function trungtrat($dai, $so, $kieu, $ngay, $sotien, $mbmnmt, $checkxd){
    global $PNH;
    $ketquaxs = $PNH->get_row(" SELECT * FROM `ketquaxs` WHERE dai = '$dai' AND DATE_FORMAT(createdate, '%Y-%m-%d') = '$ngay' ");
    $so = explode(' ',$so);
    $totaltien = 0;
    $sotrung = '';
    $total = 0;
    $count = 0;
    $socantim = '';
    if( $ketquaxs && $dai != 'Miền Bắc' ){
        if ($kieu == 'da'){
            $tinhtien = $sotien * 2 * 18 * $mbmnmt;
            $lastTwoCode = $ketquaxs['lastTwoCode'];
            $length = count($so);
            if( $length == 1 ){
                // foreach($so as $value){
                //     if (strpos($lastTwoCode, $value) !== false) {
                //         $count += 1;
                //         $total += 1;
                //         $totaltien += $tinhtien * 1;
                //         $sotrung .= $value.',';
                //     }
                //     $socantim .= $value.' ';
                // }
            }else if( $length == 2 ){
                $daysotrung = '';
                foreach($so as $value){
                    if (strpos($lastTwoCode, $value) !== false) {
                        $count += 1;
                        $daysotrung .= $value.',';
                    }
                    if($count >= 2){
                        $total += 1;
                        $totaltien += $tinhtien;
                        $sotrung .= $daysotrung;
                    }
                    $socantim .= $value.' ';
                }
            }else{
                $daocap = daocap($so);
                switch ($length) {
                    case 3:
                        $tienkh = 3;
                        break;
                    case 4:
                        $tienkh = 6;
                        break;
                    case 5:
                        $tienkh = 10;
                        break;
                    default:
                        $tienkh = 1;
                        break;
                }
                $daysotrung = '';
                foreach($daocap as $valuedaodonvi){
                    $count = 0;
                    $countlengvalue = count(explode(" ",$valuedaodonvi));
                    $demcount = 0;
                    foreach (explode(" ",$valuedaodonvi) as $value) {
                        if( $countlengvalue - 1 == $demcount){
                            $count = 0;
                            $daysotrung = '';
                        }else if (strpos($lastTwoCode, $value) !== false) {
                            $count += 1;
                            $daysotrung .= $value.',';
                        }else if (strpos($lastTwoCode, $value) == false) {
                            $count = 0;
                            $daysotrung = '';
                            $demcount +=1;
                        }else{
                            $demcount +=1;
                        }
                        if($count >= 2){
                            $total += 1;
                            $totaltien += $tinhtien * $tienkh;
                            $sotrung .= trim($daysotrung,',').' ';
                            $daysotrung = '';
                        }
                        $socantim .= $value.' ';
                    }
                }
            }
            $values = [$total, $totaltien, $sotrung, $socantim, 36];
            return $values;
        }else if ( $kieu == '18lo' || $kieu == 'blo'){
            $tinhtien = $sotien * 18 * $mbmnmt;
            $g8 = $ketquaxs['g8'];
            $g7 = substr($ketquaxs['g7'],1,2);
            $g6 = explode(',',$ketquaxs['g6']);
            $g5 = substr($ketquaxs['g5'],2,2);
            $g4 = explode(',',$ketquaxs['g4']);
            $g3 = explode(',',$ketquaxs['g3']);
            $g2 = substr($ketquaxs['g2'],3,2);
            $g1 = substr($ketquaxs['g1'],3,2);
            $db = substr($ketquaxs['db'],4,2);
            foreach ($so  as $value2) {
                if($checkxd == 1){
                    $daodonvi = daodonvi($value2);
                    foreach($daodonvi[0] as $value){
                        $value = substr($value,-2);
                        if($value == $g8){
                            $sotrung .= $value.',';
                            $totaltien += $tinhtien;
                            $count += 1;
                        } 
                        if($value == $g7){
                            $sotrung .= $value.',';
                            $totaltien += $tinhtien;
                            $count += 1;
                        } 
                        if($value == $g5){
                            $sotrung .= $value.',';
                            $totaltien += $tinhtien;
                            $count += 1;
                        } 
                        if($value == $g2){
                            $sotrung .= $value.',';
                            $totaltien += $tinhtien;
                            $count += 1;
                        }
                        if($value == $g1){
                            $sotrung .= $value.',';
                            $totaltien += $tinhtien;
                            $count += 1;
                        }
                        if($value == $db){
                            $sotrung .= $value.',';
                            $totaltien += $tinhtien;
                            $count += 1;
                        }
                        if( !empty($g6) ){
                            foreach($g6 as $value2){
                                $sog6 = substr($value2,2,2);
                                if($value == $sog6){
                                    $sotrung .= $value.',';
                                    $totaltien += $tinhtien;
                                    $count += 1;
                                }
                            }
                        }
                        if( !empty($g4) ){
                            foreach($g4 as $value3){
                                $sog4 = substr($value3,3,2);
                                if($value == $sog4){
                                    $sotrung .= $value.',';
                                    $totaltien += $tinhtien;
                                    $count += 1;
                                }
                            }
                        } 
                        if( !empty($g3) ){
                            foreach($g3 as $value4){
                                $sog3 = substr($value4,3,2);
                                
                                if($value == $sog3){
                                    $sotrung .= $value.',';
                                    $totaltien += $tinhtien;
                                    $count += 1;
                                }
                            }
                        }
                        $socantim .= $value.' ';
                    }
                }else{
                    $value = substr($value2,-2);
                    if($value == $g8){
                        $sotrung .= $value.',';
                        $totaltien += $tinhtien;
                        $count += 1;
                    } 
                    if($value == $g7){
                        $sotrung .= $value.',';
                        $totaltien += $tinhtien;
                        $count += 1;
                    } 
                    if($value == $g5){
                        $sotrung .= $value.',';
                        $totaltien += $tinhtien;
                        $count += 1;
                    } 
                    if($value == $g2){
                        $sotrung .= $value.',';
                        $totaltien += $tinhtien;
                        $count += 1;
                    }
                    if($value == $g1){
                        $sotrung .= $value.',';
                        $totaltien += $tinhtien;
                        $count += 1;
                    }
                    if($value == $db){
                        $sotrung .= $value.',';
                        $totaltien += $tinhtien;
                        $count += 1;
                    }
                    if( !empty($g6) ){
                        foreach($g6 as $value2){
                            $sog6 = substr($value2,2,2);
                            if($value == $sog6){
                                $sotrung .= $value.',';
                                $totaltien += $tinhtien;
                                $count += 1;
                            }
                        }
                    }
                    if( !empty($g4) ){
                        foreach($g4 as $value3){
                            $sog4 = substr($value3,3,2);
                            if($value == $sog4){
                                $sotrung .= $value.',';
                                $totaltien += $tinhtien;
                                $count += 1;
                            }
                        }
                    } 
                    if( !empty($g3) ){
                        foreach($g3 as $value4){
                            $sog3 = substr($value4,3,2);
                            if($value == $sog3){
                                $sotrung .= $value.',';
                                $totaltien += $tinhtien;
                                $count += 1;
                            }
                        }
                    }
                    $socantim .= $value.' ';
                }
            }
            $values = [$count, $totaltien, $sotrung, $socantim, 18];
            return $values;
        }else if ( $kieu == 'bdao' ){
            $tinhtien = $sotien * 18 * $mbmnmt;
            $g8 = $ketquaxs['g8'];
            $g7 = substr($ketquaxs['g7'],1,2);
            $g6 = explode(',',$ketquaxs['g6']);
            $g5 = substr($ketquaxs['g5'],2,2);
            $g4 = explode(',',$ketquaxs['g4']);
            $g3 = explode(',',$ketquaxs['g3']);
            $g2 = substr($ketquaxs['g2'],3,2);
            $g1 = substr($ketquaxs['g1'],3,2);
            $db = substr($ketquaxs['db'],4,2);
            foreach ($so  as $value) {
                $value = substr($value,-2);
                if($value == $g8){
                    $sotrung .= $value.',';
                    $totaltien += $tinhtien;
                    $count += 1;
                } 
                if($value == $g7){
                    $sotrung .= $value.',';
                    $totaltien += $tinhtien;
                    $count += 1;
                } 
                if($value == $g5){
                    $sotrung .= $value.',';
                    $totaltien += $tinhtien;
                    $count += 1;
                } 
                if($value == $g2){
                    $sotrung .= $value.',';
                    $totaltien += $tinhtien;
                    $count += 1;
                }
                if($value == $g1){
                    $sotrung .= $value.',';
                    $totaltien += $tinhtien;
                    $count += 1;
                }
                if($value == $db){
                    $sotrung .= $value.',';
                    $totaltien += $tinhtien;
                    $count += 1;
                }
                if( !empty($g6) ){
                    foreach($g6 as $value2){
                        $sog6 = substr($value2,2,2);
                        if($value == $sog6){
                            $sotrung .= $value.',';
                            $totaltien += $tinhtien;
                            $count += 1;
                        }
                    }
                }
                if( !empty($g4) ){
                    foreach($g4 as $value3){
                        $sog4 = substr($value3,3,2);
                        if($value == $sog4){
                            $sotrung .= $value.',';
                            $totaltien += $tinhtien;
                            $count += 1;
                        }
                    }
                } 
                if( !empty($g3) ){
                    foreach($g3 as $value4){
                        $sog3 = substr($value4,3,2);
                        if($value == $sog3){
                            $sotrung .= $value.',';
                            $totaltien += $tinhtien;
                            $count += 1;
                        }
                    }
                }
                $socantim .= $value.' ';
            }
            $values = [$count, $totaltien, $sotrung, $socantim, 18];
            return $values;
        }else if ( $kieu == '17lo' ){
            $tinhtien = $sotien * 17 * $mbmnmt;
            $g7 = $ketquaxs['g7'];
            $g6 = explode(',',$ketquaxs['g6']);
            $g5 = substr($ketquaxs['g5'],1,3);
            $g4 = explode(',',$ketquaxs['g4']);
            $g3 = explode(',',$ketquaxs['g3']);
            $g2 = substr($ketquaxs['g2'],2,3);
            $g1 = substr($ketquaxs['g1'],2,3);
            $db = substr($ketquaxs['db'],3,3);
            foreach ($so  as $value) {
                if($value == $g7){
                    $sotrung .= $value.',';
                    $totaltien += $tinhtien;
                    $count += 1;
                }
                if($value == $g5){
                    $sotrung .= $value.',';
                    $totaltien += $tinhtien;
                    $count += 1;
                }
                if($value == $g2){
                    $sotrung .= $value.',';
                    $totaltien += $tinhtien;
                    $count += 1;
                }
                if($value == $g1){
                    $sotrung .= $value.',';
                    $totaltien += $tinhtien;
                    $count += 1;
                }
                if($value == $db){
                    $sotrung .= $value.',';
                    $totaltien += $tinhtien;
                    $count += 1;
                }
                if( !empty($g6) ){
                    foreach($g6 as $value6){
                        $sog6 = substr($value6,1,3);
                        if($value == $sog6){
                            $sotrung .= $value.',';
                            $totaltien += $tinhtien;
                            $count += 1;
                        }
                    }
                }
                if( !empty($g4) ){
                    foreach($g4 as $value4){
                        $sog4 = substr($value4,2,3);
                        if($value == $sog4){
                            $sotrung .= $value.',';
                            $totaltien += $tinhtien;
                            $count += 1;
                        }
                    }
                }
                if( !empty($g3) ){
                    foreach($g3 as $value3){
                        $sog3 = substr($value3,2,3);
                        if($value == $sog3){
                            $sotrung .= $value.',';
                            $totaltien += $tinhtien;
                            $count += 1;
                        }
                    }
                }
                $socantim .= $value.' ';
            }
            $values = [$count, $totaltien, $sotrung, $socantim, 17];
            return $values;
        }else if ( $kieu == '17dao' || $kieu == '17lod' || $kieu == '17d' ){
            $tinhtien = $sotien * 17 * $mbmnmt;
            $g7 = $ketquaxs['g7'];
            $g6 = explode(',',$ketquaxs['g6']);
            $g5 = substr($ketquaxs['g5'],1,3);
            $g4 = explode(',',$ketquaxs['g4']);
            $g3 = explode(',',$ketquaxs['g3']);
            $g2 = substr($ketquaxs['g2'],2,3);
            $g1 = substr($ketquaxs['g1'],2,3);
            $db = substr($ketquaxs['db'],3,3);
            foreach($so as $value){
                $daodonvi = daodonvi($value);
                $tienkh = $daodonvi[1];
                foreach($daodonvi[0] as $valuedaodonvi){
                    if($valuedaodonvi == $g7){
                        $sotrung .= $valuedaodonvi.',';
                        $totaltien += $tinhtien * $tienkh;
                        $count += 1;
                    }
                    if($valuedaodonvi == $g5){
                        $sotrung .= $valuedaodonvi.',';
                        $totaltien += $tinhtien * $tienkh;
                        $count += 1;
                    }
                    if($valuedaodonvi == $g2){
                        $sotrung .= $valuedaodonvi.',';
                        $totaltien += $tinhtien * $tienkh;
                        $count += 1;
                    }
                    if($valuedaodonvi == $g1){
                        $sotrung .= $valuedaodonvi.',';
                        $totaltien += $tinhtien * $tienkh;
                        $count += 1;
                    }
                    if($valuedaodonvi == $db){
                        $sotrung .= $valuedaodonvi.',';
                        $totaltien += $tinhtien * $tienkh;
                        $count += 1;
                    }
                    if( !empty($g6) ){
                        foreach($g6 as $value6){
                            $sog6 = substr($value6,1,3);
                            if($valuedaodonvi == $sog6){
                                $sotrung .= $valuedaodonvi.',';
                                $totaltien += $tinhtien * $tienkh;
                                $count += 1;
                            }
                        }
                    }
                    if( !empty($g4) ){
                        foreach($g4 as $value4){
                            $sog4 = substr($value4,2,3);
                            if($valuedaodonvi == $sog4){
                                $sotrung .= $valuedaodonvi.',';
                                $totaltien += $tinhtien * $tienkh;
                                $count += 1;
                            }
                        }
                    }
                    if( !empty($g3) ){
                        foreach($g3 as $value3){
                            $sog3 = substr($value3,2,3);
                            if($valuedaodonvi == $sog3){
                                $sotrung .= $valuedaodonvi.',';
                                $totaltien += $tinhtien * $tienkh;
                                $count += 1;
                            }
                        }
                    }
                    $socantim .= $valuedaodonvi.' ';
                }
            }
            $values = [$count, $totaltien, $sotrung, $socantim, 17];
            return $values;
        }else if ( $kieu == '7lo' ){
            $tinhtien = $sotien * 7 * $mbmnmt;
            $g7 = $ketquaxs['g7'];
            $g6 = explode(',',$ketquaxs['g6']);
            $g5 = substr($ketquaxs['g5'],1,3);
            $g4 = explode(',',$ketquaxs['g4']);
            $db = substr($ketquaxs['db'],3,3);
            foreach ($so  as $value) {
                if($value == $g7){
                    $sotrung .= $value.',';
                    $totaltien += $tinhtien;
                    $count += 1;
                }
                if($value == $g5){
                    $sotrung .= $value.',';
                    $totaltien += $tinhtien;
                    $count += 1;
                }
                if($value == $db){
                    $sotrung .= $value.',';
                    $totaltien += $tinhtien;
                    $count += 1;
                }
                if( !empty($g6) ){
                    foreach($g6 as $value6){
                        $sog6 = substr($value6,1,3);
                        if($value == $sog6){
                            $sotrung .= $value.',';
                            $totaltien += $tinhtien;
                            $count += 1;
                        }
                    }
                }
                if( !empty($g4) ){
                    foreach($g4 as $key => $value4){
                        if($key == 0){
                            $sog4 = substr($value4,2,3);
                            if($value == $sog4){
                                $sotrung .= $value.',';
                                $totaltien += $tinhtien;
                                $count += 1;
                            }
                        }
                    }
                }
                $socantim .= $value.' ';
            }
            $values = [$count, $totaltien, $sotrung, $socantim, 7];
            return $values;
        }else if ( $kieu == '7lod' || $kieu == '7dao' || $kieu == '7d' ){
            $tinhtien = $sotien * 7 * $mbmnmt;
            $g7 = $ketquaxs['g7'];
            $g6 = explode(',',$ketquaxs['g6']);
            $g5 = substr($ketquaxs['g5'],1,3);
            $g4 = explode(',',$ketquaxs['g4']);
            $db = substr($ketquaxs['db'],3,3);           
            foreach ($so  as $value) {
                $daodonvi = daodonvi($value);
                $tienkh = $daodonvi[1];
                foreach($daodonvi[0] as $valuedaodonvi){
                    if($valuedaodonvi == $g7){
                        $sotrung .= $valuedaodonvi.',';
                        $totaltien += $tinhtien * $tienkh;
                        $count += 1;
                    }
                    if($valuedaodonvi == $g5){
                        $sotrung .= $valuedaodonvi.',';
                        $totaltien += $tinhtien * $tienkh;
                        $count += 1;
                    }
                    if($valuedaodonvi == $db){
                        $sotrung .= $valuedaodonvi.',';
                        $totaltien += $tinhtien * $tienkh;
                        $count += 1;
                    }
                    if( !empty($g6) ){
                        foreach($g6 as $value6){
                            $sog6 = substr($value6,1,3);
                            if($valuedaodonvi == $sog6){
                                $sotrung .= $valuedaodonvi.',';
                                $totaltien += $tinhtien * $tienkh;
                                $count += 1;
                            }
                        }
                    }
                    if( !empty($g4) ){
                        foreach($g4 as $key => $value4){
                            if($key == 0){
                                $sog4 = substr($value4,2,3);
                                if($valuedaodonvi == $sog4){
                                    $sotrung .= $valuedaodonvi.',';
                                    $totaltien += $tinhtien * $tienkh;
                                    $count += 1;
                                }
                            }
                        }
                    }
                    $socantim .= $valuedaodonvi.' ';
                }
            }
            $values = [$count, $totaltien, $sotrung, $socantim, 7];
            return $values;
        }else if ( $kieu == 'dau' || $kieu == 'a' ){
            $tinhtien = $sotien * $mbmnmt;
            $g8 = $ketquaxs['g8'];
            foreach ($so  as $value) {
                if($value == $g8){
                    $sotrung .= $value.',';
                    $totaltien += $tinhtien;
                    $count += 1;
                }
                $socantim .= $value.' ';
            }
            $values = [$count, $totaltien, $sotrung, $socantim, 1];
            return $values;
        }else if ( $kieu == 'duoi' || $kieu == 'b' ){
            $tinhtien = $sotien * $mbmnmt;
            $db = substr($ketquaxs['db'],4,2);
            foreach ($so  as $value) {
                if($value == $db){
                    $sotrung .= $value.',';
                    $totaltien += $tinhtien;
                    $count += 1;
                }
                $socantim .= $value.' ';
            }
            $values = [$count, $totaltien, $sotrung, $socantim, 1];
            return $values;
        }else if ( $kieu == 'dd' || $kieu == 'ab' ){
            $tinhtien = $sotien * 2 * $mbmnmt;
            $g8 = $ketquaxs['g8'];
            $db = substr($ketquaxs['db'],4,2);
            foreach ($so  as $value) {
                if($value == $g8){
                    $sotrung .= $value.',';
                    $totaltien += $tinhtien;
                    $count += 1;
                }
                if($value == $db){
                    $sotrung .= $value.',';
                    $totaltien += $tinhtien;
                    $count += 1;
                }
                $socantim .= $value.' ';
            }
            $values = [$count, $totaltien, $sotrung, $socantim, 2];
            return $values;
        }else if ( $kieu == 'xc' ){
            $tinhtien = $sotien * 2 * $mbmnmt;
            $g7 = $ketquaxs['g7'];
            $db = substr($ketquaxs['db'],3,3);
            foreach ($so  as $value) {
                if($value == $g7){
                    $sotrung .= $value.',';
                    $totaltien += $tinhtien;
                    $count += 1;
                }
                if($value == $db){
                    $sotrung .= $value.',';
                    $totaltien += $tinhtien;
                    $count += 1;
                }
                $socantim .= $value.' ';
            }
            $values = [$count, $totaltien, $sotrung, $socantim, 2];
            return $values;
        }else if ( $kieu == 'xdao' || $kieu == 'xd' ){
            $tinhtien = $sotien * 2 * $mbmnmt;
            $g7 = $ketquaxs['g7'];
            $db = substr($ketquaxs['db'],3,3);
            foreach ($so  as $value) {
                $daodonvi = daodonvi($value);
                $tienkh = $daodonvi[1];
                foreach($daodonvi[0] as $valuedaodonvi){
                    if($valuedaodonvi == $g7){
                        $sotrung .= $valuedaodonvi.',';
                        $totaltien += $tinhtien * $tienkh;
                        $count += 1;
                    }
                    if($valuedaodonvi == $db){
                        $sotrung .= $valuedaodonvi.',';
                        $totaltien += $tinhtien * $tienkh;
                        $count += 1;
                    }
                    $socantim .= $valuedaodonvi.' ';
                }
            }
            $values = [$count, $totaltien, $sotrung, $socantim, 2];
            return $values;
        }
    }else if( $ketquaxs && $dai == 'Miền Bắc'){
        if( $kieu == '27lo' || $kieu == 'blo' ){
            $tinhtien = $sotien * 27 * $mbmnmt;
            $db = substr($ketquaxs['db'],3,2);
            $g7 = explode(',',$ketquaxs['g7']);
            $g6 = explode(',',$ketquaxs['g6']);
            $g5 = explode(',',$ketquaxs['g5']);
            $g4 = explode(',',$ketquaxs['g4']);
            $g3 = explode(',',$ketquaxs['g3']);
            $g2 = explode(',',$ketquaxs['g2']);
            $g1 = substr($ketquaxs['g1'],3,2);
            foreach ($so  as $value2) {
                if($checkxd == 1){
                    $daodonvi = daodonvi($value2);
                    foreach($daodonvi[0] as $value){
                        $value = substr($value,-2);
                        if($value == $db){
                            $sotrung .= $value.',';
                            $totaltien += $tinhtien;
                            $count += 1;
                        }
                        if($value == $g1){
                            $sotrung .= $value.',';
                            $totaltien += $tinhtien;
                            $count += 1;
                        }
                        if( !empty($g2) ){
                            foreach($g2 as $value2){
                                $sog2 = substr($value2,3,2);
                                if($value == $sog2){
                                    $sotrung .= $value.',';
                                    $totaltien += $tinhtien;
                                    $count += 1;
                                }
                            }
                        }
                        if( !empty($g3) ){
                            foreach($g3 as $value3){
                                $sog3 = substr($value3,3,2);
                                if($value == $sog3){
                                    $sotrung .= $value.',';
                                    $totaltien += $tinhtien;
                                    $count += 1;
                                }
                            }
                        }
                        if( !empty($g4) ){
                            foreach($g4 as $value4){
                                $sog4 = substr($value4,2,2);
                                if($value == $sog4){
                                    $sotrung .= $value.',';
                                    $totaltien += $tinhtien;
                                    $count += 1;
                                }
                            }
                        }
                        if( !empty($g5) ){
                            foreach($g5 as $value5){
                                $sog5 = substr($value5,2,2);
                                if($value == $sog5){
                                    $sotrung .= $value.',';
                                    $totaltien += $tinhtien;
                                    $count += 1;
                                }
                            }
                        }
                        if( !empty($g6) ){
                            foreach($g6 as $value6){
                                $sog6 = substr($value6,1,2);
                                if($value == $sog6){
                                    $sotrung .= $value.',';
                                    $totaltien += $tinhtien;
                                    $count += 1;
                                }
                            }
                        }
                        if( !empty($g7) ){
                            foreach($g7 as $value7){
                                if($value == $value7){
                                    $sotrung .= $value.',';
                                    $totaltien += $tinhtien;
                                    $count += 1;
                                }
                            }
                        }
                        $socantim .= $value.' ';
                    }
                }else{
                    $value = substr($value2,-2);
                    if($value == $db){
                        $sotrung .= $value.',';
                        $totaltien += $tinhtien;
                        $count += 1;
                    }
                    if($value == $g1){
                        $sotrung .= $value.',';
                        $totaltien += $tinhtien;
                        $count += 1;
                    }
                    if( !empty($g2) ){
                        foreach($g2 as $value2){
                            $sog2 = substr($value2,3,2);
                            if($value == $sog2){
                                $sotrung .= $value.',';
                                $totaltien += $tinhtien;
                                $count += 1;
                            }
                        }
                    }
                    if( !empty($g3) ){
                        foreach($g3 as $value3){
                            $sog3 = substr($value3,3,2);
                            if($value == $sog3){
                                $sotrung .= $value.',';
                                $totaltien += $tinhtien;
                                $count += 1;
                            }
                        }
                    }
                    if( !empty($g4) ){
                        foreach($g4 as $value4){
                            $sog4 = substr($value4,2,2);
                            if($value == $sog4){
                                $sotrung .= $value.',';
                                $totaltien += $tinhtien;
                                $count += 1;
                            }
                        }
                    }
                    if( !empty($g5) ){
                        foreach($g5 as $value5){
                            $sog5 = substr($value5,2,2);
                            if($value == $sog5){
                                $sotrung .= $value.',';
                                $totaltien += $tinhtien;
                                $count += 1;
                            }
                        }
                    }
                    if( !empty($g6) ){
                        foreach($g6 as $value6){
                            $sog6 = substr($value6,1,2);
                            if($value == $sog6){
                                $sotrung .= $value.',';
                                $totaltien += $tinhtien;
                                $count += 1;
                            }
                        }
                    }
                    if( !empty($g7) ){
                        foreach($g7 as $value7){
                            if($value == $value7){
                                $sotrung .= $value.',';
                                $totaltien += $tinhtien;
                                $count += 1;
                            }
                        }
                    }
                    $socantim .= $value.' ';
                }
            }
            $values = [$count, $totaltien, $sotrung, $socantim, 27];
            return $values;
        }else if( $kieu == '23lo' ){
            $tinhtien = $sotien * 23 * $mbmnmt;
            $db = substr($ketquaxs['db'],2,3);
            $g6 = explode(',',$ketquaxs['g6']);
            $g5 = explode(',',$ketquaxs['g5']);
            $g4 = explode(',',$ketquaxs['g4']);
            $g3 = explode(',',$ketquaxs['g3']);
            $g2 = explode(',',$ketquaxs['g2']);
            $g1 = substr($ketquaxs['g1'],2,3);
            foreach ($so  as $value) {
                if($value == $db){
                    $sotrung .= $value.',';
                    $totaltien += $tinhtien;
                    $count += 1;
                }
                if($value == $g1){
                    $sotrung .= $value.',';
                    $totaltien += $tinhtien;
                    $count += 1;
                }
                if( !empty($g2) ){
                    foreach($g2 as $value2){
                        $sog2 = substr($value2,2,3);
                        if($value == $sog2){
                            $sotrung .= $value.',';
                            $totaltien += $tinhtien;
                            $count += 1;
                        }
                    }
                }
                if( !empty($g3) ){
                    foreach($g3 as $value3){
                        $sog3 = substr($value3,2,3);
                        if($value == $sog3){
                            $sotrung .= $value.',';
                            $totaltien += $tinhtien;
                            $count += 1;
                        }
                    }
                }
                if( !empty($g4) ){
                    foreach($g4 as $value4){
                        $sog4 = substr($value4,1,3);
                        if($value == $sog4){
                            $sotrung .= $value.',';
                            $totaltien += $tinhtien;
                            $count += 1;
                        }
                    }
                }
                if( !empty($g5) ){
                    foreach($g5 as $value5){
                        $sog5 = substr($value5,1,3);
                        if($value == $sog5){
                            $sotrung .= $value.',';
                            $totaltien += $tinhtien;
                            $count += 1;
                        }
                    }
                }
                if( !empty($g6) ){
                    foreach($g6 as $value6){
                        if($value == $value6){
                            $sotrung .= $value.',';
                            $totaltien += $tinhtien;
                            $count += 1;
                        }
                    }
                }
                $socantim .= $value.' ';
            }
            $values = [$count, $totaltien, $sotrung, $socantim, 23];
            return $values;
        }else if( $kieu == '23dao' || $kieu == '23d' ){
            $tinhtien = $sotien * 23 * $mbmnmt;
            $db = substr($ketquaxs['db'],2,3);
            $g6 = explode(',',$ketquaxs['g6']);
            $g5 = explode(',',$ketquaxs['g5']);
            $g4 = explode(',',$ketquaxs['g4']);
            $g3 = explode(',',$ketquaxs['g3']);
            $g2 = explode(',',$ketquaxs['g2']);
            $g1 = substr($ketquaxs['g1'],2,3);
            $socantim = '';
            foreach ($so  as $value) {
                $daodonvi = daodonvi($value);
                $tienkh = $daodonvi[1];
                foreach($daodonvi[0] as $valuedaodonvi){
                    if($valuedaodonvi == $db){
                        $sotrung .= $valuedaodonvi.',';
                        $totaltien += $tinhtien * $tienkh;
                        $count += 1;
                    }
                    if($valuedaodonvi == $g1){
                        $sotrung .= $valuedaodonvi.',';
                        $totaltien += $tinhtien * $tienkh;
                        $count += 1;
                    }
                    if( !empty($g2) ){
                        foreach($g2 as $value2){
                            $sog2 = substr($value2,2,3);
                            if($valuedaodonvi == $sog2){
                                $sotrung .= $valuedaodonvi.',';
                                $totaltien += $tinhtien * $tienkh;
                                $count += 1;
                            }
                        }
                    }
                    if( !empty($g3) ){
                        foreach($g3 as $value3){
                            $sog3 = substr($value3,2,3);
                            if($valuedaodonvi == $sog3){
                                $sotrung .= $valuedaodonvi.',';
                                $totaltien += $tinhtien * $tienkh;
                                $count += 1;
                            }
                        }
                    }
                    if( !empty($g4) ){
                        foreach($g4 as $value4){
                            $sog4 = substr($value4,1,3);
                            if($valuedaodonvi == $sog4){
                                $sotrung .= $valuedaodonvi.',';
                                $totaltien += $tinhtien * $tienkh;
                                $count += 1;
                            }
                        }
                    }
                    if( !empty($g5) ){
                        foreach($g5 as $value5){
                            $sog5 = substr($value5,1,3);
                            if($valuedaodonvi == $sog5){
                                $sotrung .= $valuedaodonvi.',';
                                $totaltien += $tinhtien * $tienkh;
                                $count += 1;
                            }
                        }
                    }
                    if( !empty($g6) ){
                        foreach($g6 as $value6){
                            if($valuedaodonvi == $value6){
                                $sotrung .= $valuedaodonvi.',';
                                $totaltien += $tinhtien * $tienkh;
                                $count += 1;
                            }
                        }
                    }
                    $socantim .= $valuedaodonvi.' ';
                }
            }
            $values = [$count, $totaltien, $sotrung, $socantim, 23];
            return $values;
        }else if( $kieu == 'da' ){
            $tinhtien = $sotien * 2 * 27 * $mbmnmt;
            $lastTwoCode = $ketquaxs['lastTwoCode'];
            $length = count($so);
            if( $length == 1 ){
                // foreach($so as $value){
                //     if (strpos($lastTwoCode, $value) !== false) {
                //         $count += 1;
                //         $total += 1;
                //         $totaltien += $tinhtien * 1;
                //         $sotrung .= $value.',';
                //     }
                // }
            }else if( $length == 2 ){
                $daysotrung = '';
                foreach($so as $value){
                    if (strpos($lastTwoCode, $value) !== false) {
                        $count += 1;
                        $daysotrung .= $value.',';
                    }
                    if($count >= 2){
                        $total += 1;
                        $totaltien += $tinhtien * 2;
                        $sotrung .= $daysotrung;
                    }
                    $socantim .= $value.' ';
                }
            }else{
                $daocap = daocap($so);
                switch ($length) {
                    case 3:
                        $tienkh = 3;
                        break;
                    case 4:
                        $tienkh = 6;
                        break;
                    case 5:
                        $tienkh = 10;
                        break;
                    default:
                        $tienkh = 1;
                        break;
                }
                $daysotrung = '';
                foreach($daocap as $valuedaodonvi){
                    $count = 0;
                    $countlengvalue = count(explode(" ",$valuedaodonvi));
                    $demcount = 0;
                    foreach (explode(" ",$valuedaodonvi) as $value) {
                        if( $countlengvalue - 1 == $demcount){
                            $count = 0;
                            $daysotrung = '';
                        }else if (strpos($lastTwoCode, $value) !== false) {
                            $count += 1;
                            $daysotrung .= $value.',';
                        }else if (strpos($lastTwoCode, $value) == false) {
                            $count = 0;
                            $daysotrung = '';
                            $demcount +=1;
                        }else{
                            $demcount +=1;
                        }
                        if($count >= 2){
                            $total += 1;
                            $totaltien += $tinhtien * $tienkh;
                            $sotrung .= trim($daysotrung,',').' ';
                            $daysotrung = '';
                        }
                        $socantim .= $value.' ';
                    }
                }
            }
            $values = [$total, $totaltien, $sotrung, $socantim, 54];
            return $values;
        }else if( $kieu == 'dau' || $kieu == 'a' ){
            $tinhtien = $sotien * $mbmnmt;
            $g7 = explode(',',$ketquaxs['g7']);
            foreach ($so  as $value) {
                foreach($g7 as $value7){
                    if($value == $value7){
                        $sotrung .= $value.',';
                        $totaltien += $tinhtien;
                        $count += 1;
                    }
                }
                $socantim .= $value.' ';
            }
            $values = [$count, $totaltien, $sotrung, $socantim, 4];
            return $values;
        }else if( $kieu == 'duoi' || $kieu == 'b' ){
            $tinhtien = $sotien * $mbmnmt;
            $db = substr($ketquaxs['db'],3,2);
            foreach ($so  as $value) {
                if($value == $db){
                    $sotrung .= $value.',';
                    $totaltien += $tinhtien;
                    $count += 1;
                }
                $socantim .= $value.' ';
            }
            $values = [$count, $totaltien, $sotrung, $socantim, 1];
            return $values;
        }else if( $kieu == 'dd' || $kieu == 'ab' ){
            $tinhtien = $sotien * 5 * $mbmnmt;
            $db = substr($ketquaxs['db'],3,2);
            $g7 = explode(',',$ketquaxs['g7']);
            foreach ($so  as $value) {
                if($value == $db){
                    $sotrung .= $value.',';
                    $totaltien += $tinhtien;
                    $count += 1;
                }
                if( !empty($g7) ){
                    foreach($g7 as $value7){
                        if($value == $value7){
                            $sotrung .= $value.',';
                            $totaltien += $tinhtien;
                            $count += 1;
                        }
                    }
                }
                $socantim .= $value.' ';
            }
            $values = [$count, $totaltien, $sotrung, $socantim, 5];
            return $values;
        }else if( $kieu == 'xc' ){
            $tinhtien = $sotien * 4 * $mbmnmt;
            $db = substr($ketquaxs['db'],2,3);
            $g6 = explode(',',$ketquaxs['g6']);
            foreach ($so  as $value) {
                if($value == $db){
                    $sotrung .= $value.',';
                    $totaltien += $tinhtien;
                    $count += 1;
                }
                if( !empty($g6) ){
                    foreach($g6 as $value6){
                        if($value == $value6){
                            $sotrung .= $value.',';
                            $totaltien += $tinhtien;
                            $count += 1;
                        }
                    }
                }
                $socantim .= $value.' ';
            }
            $values = [$count, $totaltien, $sotrung, $socantim, 4];
            return $values;
        }else if( $kieu == 'xdao' || $kieu == 'xd' ){
            $tinhtien = $sotien * 4 * $mbmnmt;
            $db = substr($ketquaxs['db'],2,3);
            $g6 = explode(',',$ketquaxs['g6']);
            $socantim = '';
            foreach ($so  as $value) {
                $daodonvi = daodonvi($value);
                $tienkh = $daodonvi[1];
                foreach($daodonvi[0] as $valuedaodonvi){
                    if($valuedaodonvi == $db){
                        $sotrung .= $valuedaodonvi.',';
                        $totaltien += $tinhtien * $tienkh;
                        $count += 1;
                    }
                    if( !empty($g6) ){
                        foreach($g6 as $value6){
                            if($valuedaodonvi == $value6){
                                $sotrung .= $valuedaodonvi.',';
                                $totaltien += $tinhtien * $tienkh;
                                $count += 1;
                            }
                        }
                    }
                    $socantim .= $valuedaodonvi.' ';
                }
            }
            $values = [$count, $totaltien, $sotrung, $socantim, 4];
            return $values;
        }else{
            return [0, 0, 0, 0, 0];
        }
    }
}

function getgia($kieu, $mbmnmt, $username){
    global $PNH;
    $tyle = $PNH->get_row(" SELECT * FROM `tyle` WHERE `dai` = '$mbmnmt' AND `username` = '$username' ");
    switch ($kieu) {
        case 'blo':
            $gia = $tyle['price18lo'];
            break;
        case '18lo':
            $gia = $tyle['price18lo'];
            break;
        case '17dao':
            $gia = $tyle['price17dao'];
            break;
        case '17lod':
            $gia = $tyle['price17dao'];
            break;
        case '17d':
            $gia = $tyle['price17dao'];
            break;
        case '17lo':
            $gia = $tyle['price17lo'];
            break;
        case '7lod':
            $gia = $tyle['price7lod'];
            break;
        case '7lo':
            $gia = $tyle['price7lo'];
            break;
        case '7dao':
            $gia = $tyle['price7lod'];
            break;
        case '7d':
            $gia = $tyle['price7lod'];
            break;
        case 'da':
            $gia = $tyle['priceda'];
            break;
        case 'dd':
            $gia = $tyle['pricedd'];
            break;
        case 'ab':
            $gia = $tyle['pricedd'];
            break;
        case 'dau':
            $gia = $tyle['pricedau'];
            break;
        case 'a':
            $gia = $tyle['pricedau'];
            break;
        case 'duoi':
            $gia = $tyle['priceduoi'];
            break;
        case 'b':
            $gia = $tyle['priceduoi'];
            break;
        case 'xc':
            $gia = $tyle['pricexc'];
            break;
        case 'xdao':
            $gia = $tyle['pricexdao'];
            break;
        case 'xd':
            $gia = $tyle['pricexdao'];
            break;
        case '27lo':
            $gia = $tyle['price27lo'];
            break;
        case '23lo':
            $gia = $tyle['price23lo'];
            break;
        case '23dao':
            $gia = $tyle['price23dao'];
            break;
        case '23d':
            $gia = $tyle['price23dao'];
            break;
        default:
            $gia = 0;
            break;
    }
    return $gia;
}

function gettylembmnmt($dai){
    $content = '';
    if($dai == 'bth' || $dai == 'bt' || $dai == 'tg' || $dai == 'kg' || $dai == 'dl' || $dai == 'tp' || $dai == 'la' || $dai == 'bp' || $dai == 'hg' || $dai == 'vl' || $dai == 'bd' || $dai == 'tv' ||
    $dai == 'tn' || $dai == 'ag' || $dai == 'dn' || $dai == 'ct' || $dai == 'st' || $dai == 'vt' || $dai == 'bl' ){
        $content = 'mn';
    }elseif( $dai == 'kt' || $dai == 'kh' || $dai == 'tth' || $dai == 'dan' || $dai == 'qn' || $dai == 'dno' || $dai == 'gl' || $dai == 'nt' || $dai == 'bdh' || $dai == 'qt' || $dai == 'qb' ||
    $dai == 'kh' || $dai == 'dlk' || $dai == 'qna' || $dai == 'py' || $dai == 'dt' || $dai == 'cm'){
        $content = 'mt';
    }else{
        $content = 'mb';
    }
    return $content;
}
function gettendai($dai){
    switch ($dai) {
        case 'tp':
            $dai = 'TP.HCM';
            break;
        case 'dt':
            $dai = 'Đồng Tháp';
            break;
        case 'la':
            $dai = 'Long An';
            break;
        case 'tn':
            $dai = 'Tây Ninh';
            break;
        case 'cm':
            $dai = 'Cà Mau';
            break;
        case 'qna':
            $dai = 'Quảng Nam';
            break;
        case 'dlk':
            $dai = 'Đắk Lắk';
            break;
        case 'bl':
            $dai = 'Bạc Liêu';
            break;
        case 'bth':
            $dai = 'Bình Thuận';
            break;
        case 'vt':
            $dai = 'Vũng Tàu';
            break;
        case 'bt':
            $dai = 'Bến Tre';
            break;
        case 'tth':
            $dai = 'Thừa Thiên Huế';
            break;
        case 'py':
            $dai = 'Phú Yên';
            break;
        case 'dn':
            $dai = 'Đồng Nai';
            break;
        case 'ct':
            $dai = 'Cần Thơ';
            break;
        case 'st':
            $dai = 'Sóc Trăng';
            break;
        case 'dan':
            $dai = 'Đà Nẵng';
            break;
        case 'kh':
            $dai = 'Khánh Hòa';
            break;
        case 'ag':
            $dai = 'An Giang';
            break;
        case 'qt':
            $dai = 'Quảng Trị';
            break;
        case 'qb':
            $dai = 'Quảng Bình';
            break;
        case 'vl':
            $dai = 'Vĩnh Long';
            break;
        case 'bdh':
            $dai = 'Bình Định';
            break;
        case 'bd':
            $dai = 'Bình Dương';
            break;
        case 'tv':
            $dai = 'Trà Vinh';
            break;
        case 'gl':
            $dai = 'Gia Lai';
            break;
        case 'nt':
            $dai = 'Ninh Thuận';
            break;
        case 'bp':
            $dai = 'Bình Phước';
            break;
        case 'hg':
            $dai = 'Hậu Giang';
            break;
        case 'qn':
            $dai = 'Quãng Ngãi';
            break;
        case 'dno':
            $dai = 'Đắk Nông';
            break;
        case 'tg':
            $dai = 'Tiền Giang';
            break;
        case 'kg':
            $dai = 'Kiên Giang';
            break;
        case 'dl':
            $dai = 'Lâm Đồng';
            break;
        case 'kt':
            $dai = 'Kon Tum';
            break;
        case 'mb':
            $dai = 'Miền Bắc';
            break;
        default:
            $dai = 'error';
            break;
    }
    return $dai;
}
function Getngaytypemn($ngay){
    switch ($ngay) {
        case 'monday':
            $result = 'thuhaimn';
            break;
        case 'tuesday':
            $result = 'thubamn';
            break;
        case 'wednesday':
            $result = 'thutumn';
            break;
        case 'thursday':
            $result = 'thunammn';
            break;
        case 'friday':
            $result = 'thusaumn';
            break;
        case 'saturday':
            $result = 'thubaymn';
            break;
        case 'sunday':
            $result = 'chunhatmn';
            break;
        default:
            $result = 'error';
            break;    
    }
    return $result;
}
function Getngaytypemt($ngay){
    switch ($ngay) {
        case 'monday':
            $result = 'thuhaimt';
            break;
        case 'tuesday':
            $result = 'thubamt';
            break;
        case 'wednesday':
            $result = 'thutumt';
            break;
        case 'thursday':
            $result = 'thunammt';
            break;
        case 'friday':
            $result = 'thusaumt';
            break;
        case 'saturday':
            $result = 'thubaymt';
            break;
        case 'sunday':
            $result = 'chunhatmt';
            break;
        default:
            $result = 'error';
            break;    
    }
    return $result;
}
function Getvalueofdai($dai, $ngay){
    $thu = "";
    if( $dai == 'tp'){ 
        $thu = array("monday","saturday"); 
    }else if( $dai == 'tth'){ 
        $thu = array("monday","sunday"); 
    }else if( $dai == 'dan'){ 
        $thu = array("wednesday","saturday"); 
    }else if( $dai == 'kh'){ 
        $thu = array("wednesday","sunday"); 
    }else if ($dai == 'dt' || $dai == 'cm' || $dai == 'py' ){
        $thu = array("monday");
    }else if( $dai == 'bt' || $dai == 'vt' || $dai == 'bl' || $dai == 'dlk' || $dai == 'qna' ){
        $thu = array("tuesday");
    }else if( $dai == 'dn' || $dai == 'ct' || $dai == 'st' ){
        $thu = array("wednesday");
    }else if( $dai == 'tn' || $dai == 'ag' || $dai == 'bth' || $dai == 'bdh' || $dai == 'qt' || $dai == 'qb' ){
        $thu = array("thursday");
    }else if( $dai == 'vl' || $dai == 'bd' || $dai == 'tv' || $dai == 'gl' || $dai == 'nt' ){
        $thu = array("friday");
    }else if( $dai == 'la' || $dai == 'bp' || $dai == 'hg' || $dai == 'qn' || $dai == 'dno' ){
        $thu = array("saturday"); 
    }else if( $dai == 'tg' || $dai == 'kg' || $dai == 'dl' || $dai == 'kt' ){
        $thu = array("sunday"); 
    }
    $ngay = strtolower(date("l",strtotime($ngay)));
    if (in_array($ngay, $thu)){
        return 'OK';
    }else{
        return 'NG';
    }
}
function GetthungayMBMN($dai){
    $timedai = "";
    if( $dai == 'TP.HCM' || $dai == 'Đồng Tháp' || $dai == 'Cà Mau' || $dai == 'Thừa Thiên Huế' || $dai == 'Phú Yên'){
        $timedai = "1"; //monday
    }else
    if( $dai == 'Bến Tre' || $dai == 'Vũng Tàu' || $dai == 'Bạc Liêu' || $dai == 'Đắk Lắk' || $dai == 'Quảng Nam' ){
        $timedai = "2";
    }else
    if( $dai == 'Đồng Nai' || $dai == 'Cần Thơ' || $dai == 'Sóc Trăng' || $dai == 'Đà Nẵng' || $dai == 'Khánh Hòa' ){
        $timedai = "3";
    }  else     
    if( $dai == 'Tây Ninh' || $dai == 'An Giang' || $dai == 'Bình Thuận' || $dai == 'Bình Định' || $dai == 'Quảng Trị' || $dai == 'Quảng Bình' ){
        $timedai = "4";
    } else
    if( $dai == 'Vĩnh Long' || $dai == 'Bình Dương' || $dai == 'Trà Vinh' || $dai == 'Gia Lai' || $dai == 'Ninh Thuận' ){
        $timedai = "5";
    } else
    if( $dai == 'TP.HCM' || $dai == 'Long An' || $dai == 'Bình Phước' || $dai == 'Hậu Giang' || $dai == 'Đà Nẵng' || $dai == 'Quãng Ngãi' || $dai == 'Đắk Nông'){
        $timedai = "6"; //saturday
    }else
    if( $dai == 'Tiền Giang' || $dai == 'Kiên Giang' || $dai == 'Lâm Đồng' || $dai == 'Kon Tum' || $dai == 'Khánh Hòa' || $dai == 'Thừa Thiên Huế' ){
        $timedai = "0"; //Sunday
    }
    return $timedai;
}
function getthungay($weekday){
    $today = strtolower($weekday);
    $result = "";
    switch ($today) {
        case $today == 'monday':
            $result = 'Thứ hai';
            break;
        case $today == 'tuesday':
            $result = 'Thứ ba';
            break;
        case $today == 'wednesday':
            $result = 'Thứ tư';
            break;
        case $today == 'thursday':
            $result = 'Thứ năm';
            break;
        case $today == 'friday':
            $result = 'Thứ sáu';
            break;
        case $today == 'saturday':
            $result = 'Thứ bảy';
            break;
        case $today == 'sunday':
            $result = 'Chủ nhật';
            break;
        default:
            break;
    }
    return $result;
}

function insert_options($name, $value)
{
    global $PNH;
    if(!$PNH->get_row("SELECT * FROM `options` WHERE `name` = '$name' "))
    {
        $PNH->insert("options", [
            'name'  => $name,
            'value' => $value
        ]);
    }
}
function insert_lang($id, $vn, $en)
{
    global $PNH;
    if(!$PNH->get_row("SELECT * FROM `lang` WHERE `id` = '$id' "))
    {
        $PNH->insert("lang", [
            'id'    => $id,
            'vn'    => $vn,
            'en'    => $en
        ]);
    }
}
function create_slug($string)
{
    $search = array(
        '#(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)#',
        '#(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)#',
        '#(ì|í|ị|ỉ|ĩ)#',
        '#(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)#',
        '#(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)#',
        '#(ỳ|ý|ỵ|ỷ|ỹ)#',
        '#(đ)#',
        '#(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)#',
        '#(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)#',
        '#(Ì|Í|Ị|Ỉ|Ĩ)#',
        '#(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)#',
        '#(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)#',
        '#(Ỳ|Ý|Ỵ|Ỷ|Ỹ)#',
        '#(Đ)#',
        "/[^a-zA-Z0-9\-\_]/",
    );
    $replace = array(
        'a',
        'e',
        'i',
        'o',
        'u',
        'y',
        'd',
        'A',
        'E',
        'I',
        'O',
        'U',
        'Y',
        'D',
        '-',
    );
    $string = preg_replace($search, $replace, $string);
    $string = preg_replace('/(-)+/', '-', $string);
    $string = strtolower($string);
    return $string;
}
function convert_name($str) {
    $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
    $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
    $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
    $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
    $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
    $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str); 
    $str = preg_replace("/(đ)/", 'd', $str);
    $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
    $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
    $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
    $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
    $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
    $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
    $str = preg_replace("/(Đ)/", 'D', $str);
    $str = preg_replace("/(\“|\”|\‘|\’|\,|\!|\&|\;|\@|\#|\%|\~|\`|\=|\_|\'|\]|\[|\}|\{|\)|\(|\+|\^)/", '-', $str);
    $str = preg_replace("/( )/", '-', $str);
    return $str;
}
function generate_license($suffix = null) {
    // Default tokens contain no "ambiguous" characters: 1,i,0,o
    if(isset($suffix)){
        // Fewer segments if appending suffix
        $num_segments = 3;
        $segment_chars = 6;
    }else{
        $num_segments = 4;
        $segment_chars = 5;
    }
    $tokens = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
    $license_string = '';
    // Build Default License String
    for ($i = 0; $i < $num_segments; $i++) {
        $segment = '';
        for ($j = 0; $j < $segment_chars; $j++) {
            $segment .= $tokens[rand(0, strlen($tokens)-1)];
        }
        $license_string .= $segment;
        if ($i < ($num_segments - 1)) {
            $license_string .= '-';
        }
    }
    // If provided, convert Suffix
    if(isset($suffix)){
        if(is_numeric($suffix)) {   // Userid provided
            $license_string .= '-'.strtoupper(base_convert($suffix,10,36));
        }else{
            $long = sprintf("%u\n", ip2long($suffix),true);
            if($suffix === long2ip($long) ) {
                $license_string .= '-'.strtoupper(base_convert($long,10,36));
            }else{
                $license_string .= '-'.strtoupper(str_ireplace(' ','-',$suffix));
            }
        }
    }
    return $license_string;
}
function format_currency($amount)
{
    if(isset($_SESSION['lang']))
    {
        if($_SESSION['lang'] == 'en')
        {
            return '$'.number_format($amount / 23000, 2, '.', '');
        }
        else
        {
            return format_cash($amount, 'đ');
        }
    }
    else
    {
        return format_cash($amount, 'đ');
    }
}
function lang($id)
{   
    global $PNH;
    if(isset($_SESSION['lang']))
    {
        if($_SESSION['lang'] == 'en')
        {
            return $PNH->get_row("SELECT * FROM `lang` WHERE `id` = '$id' ")['en'];
        }
        else
        {
            return $PNH->get_row("SELECT * FROM `lang` WHERE `id` = '$id' ")['vn'];
        }
    }
    else
    {
        return $PNH->get_row("SELECT * FROM `lang` WHERE `id` = '$id' ")['vn'];
    }
}
function format_date($time){
    return date("H:i:s d/m/Y", $time);
}
function current_weekdaymb() {
    $weekday = date("l");
    $datedd = date('d-m-Y H:i:s');
    $timestamp = strtotime($datedd);  
    $fromdate = date('H:i:s', $timestamp);
    if($fromdate > '17:15:00'){
        $t = strtotime('+1 day', time());
        $weekday = date("l", $t);
    }
    $weekday = strtolower($weekday);
    switch($weekday) {
        case 'monday':
            $weekday = 'monday';
            break;
        case 'tuesday':
            $weekday = 'tuesday';
            break;
        case 'wednesday':
            $weekday = 'wednesday';
            break;
        case 'thursday':
            $weekday = 'thursday';
            break;
        case 'friday':
            $weekday = 'friday';
            break;
        case 'saturday':
            $weekday = 'saturday';
            break;
        default:
            $weekday = 'sunday';
            break;
    }
    return $weekday;
}
function current_weekdaymnam() {
    $weekday = date("l");
    $datedd = date('d-m-Y H:i:s');
    $timestamp = strtotime($datedd);  
    $fromdate = date('H:i:s', $timestamp);
    if($fromdate > '16:15:00'){
        $t = strtotime('+1 day', time());
        $weekday = date("l", $t);
    }
    $weekday = strtolower($weekday);
    switch($weekday) {
        case 'monday':
            $weekday = 'monday';
            break;
        case 'tuesday':
            $weekday = 'tuesday';
            break;
        case 'wednesday':
            $weekday = 'wednesday';
            break;
        case 'thursday':
            $weekday = 'thursday';
            break;
        case 'friday':
            $weekday = 'friday';
            break;
        case 'saturday':
            $weekday = 'saturday';
            break;
        default:
            $weekday = 'sunday';
            break;
    }
    return $weekday;
}

function current_weekhoantra($t) {
    $dag = date("l", $t);
    $weekday = strtolower($dag);
    switch($weekday) {
        case 'monday':
            $weekday = 'Thứ Hai';
            break;
        case 'tuesday':
            $weekday = 'Thứ Ba';
            break;
        case 'wednesday':
            $weekday = 'Thứ Tư';
            break;
        case 'thursday':
            $weekday = 'Thứ Năm';
            break;
        case 'friday':
            $weekday = 'Thứ Sáu';
            break;
        case 'saturday':
            $weekday = 'Thứ Bảy';
            break;
        default:
            $weekday = 'Chủ Nhật';
            break;
    }
    return $weekday;
}
function curl_getxs($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $data = curl_exec($ch);
    
    curl_close($ch);
    return $data;
}




function sendCSM($mail_nhan,$ten_nhan,$chu_de,$noi_dung,$bcc)
{
    global $site_gmail_momo, $site_pass_momo;
        // PHPMailer Modify
        $mail = new PHPMailer();
        $mail->SMTPDebug = 0;
        $mail->Debugoutput = "html";
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $site_gmail_momo; // GMAIL STMP
        $mail->Password = $site_pass_momo; // PASS STMP
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->setFrom($site_gmail_momo, $bcc);
        $mail->addAddress($mail_nhan, $ten_nhan);
        $mail->addReplyTo($site_gmail_momo, $bcc);
        $mail->isHTML(true);
        $mail->Subject = $chu_de;
        $mail->Body    = $noi_dung;
        $mail->CharSet = 'UTF-8';
        $send = $mail->send();
        return $send;
}
function parse_order_id($des)
{
    global $MEMO_PREFIX;
    $re = '/'.$MEMO_PREFIX.'\d+/im';
    preg_match_all($re, $des, $matches, PREG_SET_ORDER, 0);
    if (count($matches) == 0 )
        return null;
    // Print the entire match result
    $orderCode = $matches[0][0];
    $prefixLength = strlen($MEMO_PREFIX);
    $orderId = intval(substr($orderCode, $prefixLength ));
    return $orderId ;
}


function BASE_URL($url)
{
    global $base_url;
    return $base_url.$url;
}
function gettime()
{
    return date('Y/m/d H:i:s', time());
}
function check_string($data)
{
    return trim(htmlspecialchars(addslashes($data)));
    //return str_replace(array('<',"'",'>','?','/',"\\",'--','eval(','<php'),array('','','','','','','','',''),htmlspecialchars(addslashes(strip_tags($data))));
}

function format_cash($number, $suffix = '') {
    return number_format($number, 0, ',', '.') . "{$suffix}";
}
function curl_get($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($ch);
    
    curl_close($ch);
    return $data;
}
function random($string, $int)
{  
    return substr(str_shuffle($string), 0, $int);
}
function pheptru($int1, $int2)
{
    return $int1 - $int2;
}
function phepcong($int1, $int2)
{
    return $int1 + $int2;
}
function phepnhan($int1, $int2)
{
    return $int1 * $int2;
}
function phepchia($int1, $int2)
{
    return $int1 / $int2;
}
function check_img($img)
{
    $filename = $_FILES[$img]['name'];
    $ext = explode(".", $filename);
    $ext = end($ext);
    $valid_ext = array("png","jpeg","jpg","PNG","JPEG","JPG","gif","GIF");
    if(in_array($ext, $valid_ext))
    {
        return true;
    }
}
/*
function msg_success2($text)
{
    return die('<div class="alert alert-success alert-dismissible error-messages">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>'.$text.'</div>');
}
function msg_error2($text)
{
    return die('<div class="alert alert-danger alert-dismissible error-messages">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>'.$text.'</div>');
}
function msg_warning2($text)
{
    return die('<div class="alert alert-warning alert-dismissible error-messages">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>'.$text.'</div>');
}
function msg_success($text, $url, $time)
{
    return die('<div class="alert alert-success alert-dismissible error-messages">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>'.$text.'</div><script type="text/javascript">setTimeout(function(){ location.href = "'.$url.'" },'.$time.');</script>');
}
function msg_error($text, $url, $time)
{
    return die('<div class="alert alert-danger alert-dismissible error-messages">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>'.$text.'</div><script type="text/javascript">setTimeout(function(){ location.href = "'.$url.'" },'.$time.');</script>');
}
function msg_warning($text, $url, $time)
{
    return die('<div class="alert alert-warning alert-dismissible error-messages">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>'.$text.'</div><script type="text/javascript">setTimeout(function(){ location.href = "'.$url.'" },'.$time.');</script>');
}
*/
function msg_success3($text, $url)
{
    return die('<script type="text/javascript">Swal.fire({icon: "error",title: "Thất bại",text: "'.$text.'",footer: `<a href="'.$url.'">Ấn vào đây để liên hệ CSKH!</a>`});</script>');
}
function msg_success2($text)
{
    return die('<script type="text/javascript">Swal.fire("'.lang(96).'", "'.$text.'","success");</script>');
}
function msg_error2($text)
{
    return die('<script type="text/javascript">Swal.fire("'.lang(95).'", "'.$text.'","error");</script>');
}
function msg_warning2($text)
{
    return die('<script type="text/javascript">Swal.fire("'.lang(97).'", "'.$text.'","warning");</script>');
}
function msg_success($text, $url, $time)
{
    return die('<script type="text/javascript">Swal.fire("'.lang(96).'", "'.$text.'","success");
    setTimeout(function(){ location.href = "'.$url.'" },'.$time.');</script>');
}
function msg_error($text, $url, $time)
{
    return die('<script type="text/javascript">Swal.fire("'.lang(95).'", "'.$text.'","error");
    setTimeout(function(){ location.href = "'.$url.'" },'.$time.');</script>');
}
function msg_warning($text, $url, $time)
{
    return die('<script type="text/javascript">Swal.fire("'.lang(97).'", "'.$text.'","warning");
    setTimeout(function(){ location.href = "'.$url.'" },'.$time.');</script>');
}

function admin_msg_success($text, $url, $time)
{
    return die('<script type="text/javascript">Swal.fire("'.lang(96).'", "'.$text.'","success");
    setTimeout(function(){ location.href = "'.$url.'" },'.$time.');</script>');
}
function admin_msg_error($text, $url, $time)
{
    return die('<script type="text/javascript">Swal.fire("'.lang(95).'", "'.$text.'","error");
    setTimeout(function(){ location.href = "'.$url.'" },'.$time.');</script>');
}
function admin_msg_warning($text, $url, $time)
{
    return die('<script type="text/javascript">Swal.fire("'.lang(97).'", "'.$text.'","warning");
    setTimeout(function(){ location.href = "'.$url.'" },'.$time.');</script>');
}
function display_banned($data)
{
    if ($data == 1)
    {
        $show = '<span class="badge badge-danger">Banned</span>';
    }
    else if ($data == 0)
    {
        $show = '<span class="badge badge-success">Hoạt động</span>';
    }
    return $show;
}
function display_loaithe($data)
{
    if ($data == 0)
    {
        $show = '<span class="label label-warning">Bảo trì</span>';
    }
    else 
    {
        $show = '<span class="label label-success">Hoạt động</span>';
    }
    return $show;
}
function display_ruttien($data)
{
    if ($data == 'xuly')
    {
        $show = '<span class="label label-info">Đang xử lý</span>';
    }
    else if ($data == 'hoantat')
    {
        $show = '<span class="label label-success">Đã thanh toán</span>';
    }
    else if ($data == 'huy')
    {
        $show = '<span class="label label-danger">Hủy</span>';
    }
    return $show;
}
function XoaDauCach($text)
{
    return trim(preg_replace('/\s+/',' ', $text));
}
function display($data)
{
    if ($data == 'HIDE')
    {
        $show = '<span class="badge badge-danger">ẨN</span>';
    }
    else if ($data == 'SHOW')
    {
        $show = '<span class="badge badge-success">HIỂN THỊ</span>';
    }
    return $show;
}
function status($data)
{
    if ($data == 'xuly'){
        $show = '<span class="label label-info">Đang xử lý</span>';
    }
    else if ($data == 'hoantat'){
        $show = '<span class="label label-success">Hoàn tất</span>';
    }
    else if ($data == 'thanhcong'){
        $show = '<span class="label label-success">Thành công</span>';
    }
    else if ($data == 'success'){
        $show = '<span class="label label-success">Success</span>';
    }
    else if ($data == 'thatbai'){
        $show = '<span class="label label-danger">Thất bại</span>';
    }
    else if ($data == 'error'){
        $show = '<span class="label label-danger">Error</span>';
    }
    else if ($data == 'loi'){
        $show = '<span class="label label-danger">Lỗi</span>';
    }
    else if ($data == 'huy'){
        $show = '<span class="label label-danger">Hủy</span>';
    }
    else if ($data == 'dangnap'){
        $show = '<span class="label label-warning">Đang đợi nạp</span>';
    }
    else if ($data == 2){
        $show = '<span class="label label-success">Hoàn tất</span>';
    }
    else if ($data == 1){
        $show = '<span class="label label-info">Đang xử lý</span>';
    }
    else{
        $show = '<span class="label label-warning">Khác</span>';
    }
    return $show;
}
function getHeader(){
    $headers = array();
    $copy_server = array(
        'CONTENT_TYPE'   => 'Content-Type',
        'CONTENT_LENGTH' => 'Content-Length',
        'CONTENT_MD5'    => 'Content-Md5',
    );
    foreach ($_SERVER as $key => $value) {
        if (substr($key, 0, 5) === 'HTTP_') {
            $key = substr($key, 5);
            if (!isset($copy_server[$key]) || !isset($_SERVER[$key])) {
                $key = str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', $key))));
                $headers[$key] = $value;
            }
        } elseif (isset($copy_server[$key])) {
            $headers[$copy_server[$key]] = $value;
        }
    }
    if (!isset($headers['Authorization'])) {
        if (isset($_SERVER['REDIRECT_HTTP_AUTHORIZATION'])) {
            $headers['Authorization'] = $_SERVER['REDIRECT_HTTP_AUTHORIZATION'];
        } elseif (isset($_SERVER['PHP_AUTH_USER'])) {
            $basic_pass = isset($_SERVER['PHP_AUTH_PW']) ? $_SERVER['PHP_AUTH_PW'] : '';
            $headers['Authorization'] = 'Basic ' . base64_encode($_SERVER['PHP_AUTH_USER'] . ':' . $basic_pass);
        } elseif (isset($_SERVER['PHP_AUTH_DIGEST'])) {
            $headers['Authorization'] = $_SERVER['PHP_AUTH_DIGEST'];
        }
    }
    return $headers;
}

function check_username($data)
{
    if (preg_match('/^[a-zA-Z0-9_-]{3,16}$/', $data, $matches))
    {
        return True;
    }
    else
    {
        return False;
    }
}
function check_email($data)
{
    if (preg_match('/^.+@.+$/', $data, $matches))
    {
        return True;
    }
    else
    {
        return False;
    }
}
function check_phone($data)
{
    if (preg_match('/^\+?(\d.*){3,}$/', $data, $matches))
    {
        return True;
    }
    else
    {
        return False;
    }
}
function check_url($url)
{
    $c = curl_init();
    curl_setopt($c, CURLOPT_URL, $url);
    curl_setopt($c, CURLOPT_HEADER, 1);
    curl_setopt($c, CURLOPT_NOBODY, 1);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($c, CURLOPT_FRESH_CONNECT, 1);
    if(!curl_exec($c))
    {
        return false;
    }
    else
    {
        return true;
    }
}
function check_zip($img)
{
    $filename = $_FILES[$img]['name'];
    $ext = explode(".", $filename);
    $ext = end($ext);
    $valid_ext = array("zip","ZIP");
    if(in_array($ext, $valid_ext))
    {
        return true;
    }
}
function TypePassword($string)
{
    global $PNH;
    if($PNH->site('TypePassword') == 'md5')
    {
        return md5($string);
    }
    else if($PNH->site('TypePassword') == 'sha1')
    {
        return sha1($string);
    }
    else if($PNH->site('TypePassword') == '')
    {
        return $string;
    }
    else
    {
        return md5($string);
    }
}
function phantrang($url, $start, $total, $kmess)
{
    $out[] = '<nav aria-label="Page navigation example"><ul class="pagination pagination-lg">';
    $neighbors = 2;
    if ($start >= $total) $start = max(0, $total - (($total % $kmess) == 0 ? $kmess : ($total % $kmess)));
    else $start = max(0, (int)$start - ((int)$start % (int)$kmess));
    $base_link = '<li class="page-item"><a class="page-link" href="' . strtr($url, array('%' => '%%')) . 'page=%d' . '">%s</a></li>';
    $out[] = $start == 0 ? '' : sprintf($base_link, $start / $kmess, '<i class="fa fa-chevron-circle-left" aria-hidden="true"></i>');
    if ($start > $kmess * $neighbors) $out[] = sprintf($base_link, 1, '1');
    if ($start > $kmess * ($neighbors + 1)) $out[] = '<li class="page-item"><a class="page-link">...</a></li>';
    for ($nCont = $neighbors;$nCont >= 1;$nCont--) if ($start >= $kmess * $nCont) {
        $tmpStart = $start - $kmess * $nCont;
        $out[] = sprintf($base_link, $tmpStart / $kmess + 1, $tmpStart / $kmess + 1);
    }
    $out[] = '<li class="page-item active"><a class="page-link">' . ($start / $kmess + 1) . '</a></li>';
    $tmpMaxPages = (int)(($total - 1) / $kmess) * $kmess;
    for ($nCont = 1;$nCont <= $neighbors;$nCont++) if ($start + $kmess * $nCont <= $tmpMaxPages) {
        $tmpStart = $start + $kmess * $nCont;
        $out[] = sprintf($base_link, $tmpStart / $kmess + 1, $tmpStart / $kmess + 1);
    }
    if ($start + $kmess * ($neighbors + 1) < $tmpMaxPages) $out[] = '<li class="page-item"><a class="page-link">...</a></li>';
    if ($start + $kmess * $neighbors < $tmpMaxPages) $out[] = sprintf($base_link, $tmpMaxPages / $kmess + 1, $tmpMaxPages / $kmess + 1);
    if ($start + $kmess < $total)
    {
        $display_page = ($start + $kmess) > $total ? $total : ($start / $kmess + 2);
        $out[] = sprintf($base_link, $display_page, '<i class="fa fa-chevron-circle-right" aria-hidden="true"></i>
        ');
    }
    $out[] = '</ul></nav>';
    return implode('', $out);
}
function myip()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))     
    {  
        $ip_address = $_SERVER['HTTP_CLIENT_IP'];  
    }  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))    
    {  
        $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];  
    }  
    else  
    {  
        $ip_address = $_SERVER['REMOTE_ADDR'];  
    }
    return $ip_address;
}
function timeAgo($time_ago)
{
    $time_ago   = date("Y-m-d H:i:s", $time_ago);
    $time_ago   = strtotime($time_ago);
    $cur_time   = time();
    $time_elapsed   = $cur_time - $time_ago;
    $seconds    = $time_elapsed ;
    $minutes    = round($time_elapsed / 60 );
    $hours      = round($time_elapsed / 3600);
    $days       = round($time_elapsed / 86400 );
    $weeks      = round($time_elapsed / 604800);
    $months     = round($time_elapsed / 2600640 );
    $years      = round($time_elapsed / 31207680 );
    // Seconds
    if($seconds <= 60)
    {
        return "$seconds giây trước";
    }
    //Minutes
    else if($minutes <= 60)
    {
        return "$minutes phút trước";
    }
    //Hours
    else if($hours <= 24)
    {
        return "$hours tiếng trước";
    }
    //Days
    else if($days <= 7)
    {
        if($days == 1)
        {
            return "Hôm qua";
        }
        else
        {
            return "$days ngày trước";
        }
    }
    //Weeks
    else if($weeks <= 4.3)
    {
        return "$weeks tuần trước";
    }
    //Months
    else if($months <=12)
    {
        return "$months tháng trước";
    }
    //Years
    else
    {
        return "$years năm trước";
    }
}
function dirToArray($dir) {
  
    $result = array();
 
    $cdir = scandir($dir);
    foreach ($cdir as $key => $value)
    {
       if (!in_array($value,array(".","..")))
       {
          if (is_dir($dir . DIRECTORY_SEPARATOR . $value))
          {
             $result[$value] = dirToArray($dir . DIRECTORY_SEPARATOR . $value);
          }
          else
          {
             $result[] = $value;
          }
       }
    }
   
    return $result;
 }

 function realFileSize($path)
{
    if (!file_exists($path))
        return false;

    $size = filesize($path);
   
    if (!($file = fopen($path, 'rb')))
        return false;
   
    if ($size >= 0)
    {//Check if it really is a small file (< 2 GB)
        if (fseek($file, 0, SEEK_END) === 0)
        {//It really is a small file
            fclose($file);
            return $size;
        }
    }
   
    //Quickly jump the first 2 GB with fseek. After that fseek is not working on 32 bit php (it uses int internally)
    $size = PHP_INT_MAX - 1;
    if (fseek($file, PHP_INT_MAX - 1) !== 0)
    {
        fclose($file);
        return false;
    }
   
    $length = 1024 * 1024;
    while (!feof($file))
    {//Read the file until end
        $read = fread($file, $length);
        $size = bcadd($size, $length);
    }
    $size = bcsub($size, $length);
    $size = bcadd($size, strlen($read));
   
    fclose($file);
    return $size;
}
function FileSizeConvert($bytes)
{
    $bytes = floatval($bytes);
        $arBytes = array(
            0 => array(
                "UNIT" => "TB",
                "VALUE" => pow(1024, 4)
            ),
            1 => array(
                "UNIT" => "GB",
                "VALUE" => pow(1024, 3)
            ),
            2 => array(
                "UNIT" => "MB",
                "VALUE" => pow(1024, 2)
            ),
            3 => array(
                "UNIT" => "KB",
                "VALUE" => 1024
            ),
            4 => array(
                "UNIT" => "B",
                "VALUE" => 1
            ),
        );

    foreach($arBytes as $arItem)
    {
        if($bytes >= $arItem["VALUE"])
        {
            $result = $bytes / $arItem["VALUE"];
            $result = str_replace(".", "," , strval(round($result, 2)))." ".$arItem["UNIT"];
            break;
        }
    }
    //return $result;
}
function GetCorrectMTime($filePath)
{

    $time = filemtime($filePath);

    $isDST = (date('I', $time) == 1);
    $systemDST = (date('I') == 1);

    $adjustment = 0;

    if($isDST == false && $systemDST == true)
        $adjustment = 3600;
   
    else if($isDST == true && $systemDST == false)
        $adjustment = -3600;

    else
        $adjustment = 0;

    return ($time + $adjustment);
}
function DownloadFile($file) { // $file = include path
    if(file_exists($file)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.basename($file));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        ob_clean();
        flush();
        readfile($file);
        exit;
    }
}
