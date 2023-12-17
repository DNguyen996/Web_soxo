<?php 
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    require_once('../../class/class.smtp.php');
    require_once('../../class/PHPMailerAutoload.php');
    require_once('../../class/class.phpmailer.php');
    require_once('../../class/Mobile_Detect.php');

    if($_POST['type'] == 'Checkso' )
    {
        $content    = $_POST['content'];
        $inputday   = $_POST['inputday'];
        $datenow    = date('Y-m-d', strtotime($inputday));
        $choosemien = $_POST['choosemien'];
        $content    = strtolower($content);
        $keywords_regex = "/\b(4d|3d|2d|mb|tp|dt|cm|tth|py|bt|vt|bl|dl|qna|dnai|ct|st|dan|kh|tn|ag|bdg|bd|qt|qb|vl|tv|gl|nt|la|bp|hg|qng|dan|tg|kg|ld|kt|dno)\b/";
        $parts      = preg_split($keywords_regex, $content, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
        // $arraydaimn   = array('4d','3d','2d','mb','tp','dt','cm','tth','py','bt','vt','bl','dl','qna','dnai','ct','st','dan','kh','tn','ag','qt','qb','vl','bdg','bd','tv','gl','nt','la','bp','hg','qng','dan','tg','kg','ld','kt','dno');
        $arraydaimn  = array('bt','tg','kg','ld','tp','la','bp','hg','vl','bdg','tv','tn','ag','dnai','ct','st','vt','bl');
        $arraydaimt  = array('kt','kh','tth','dan','qng','dno','gl','nt','bd','qt','qb','kh','dl','qna','py','dt','cm');
        $arraydaimb  = array('mb');
        $arraykieus  = array('18lo','blo','bdao','17lo','17dao','17lod','7lo','7lod','7dao','27lo','23lo','23dao','23d','dau','duoi','xdao','xd','dd','ab','xc','da','a','b');
        $result      = array();
        $kqchild     = array();
        $checkxd     = 0;
        if(empty($_SESSION['username']))
        {
            $result = array(
                'status'    => 0,
                'title'     => 'Cảnh báo',
                'content'   => 'Vui lòng đăng nhập',
                'url'       => BASE_URL('/Auth/Login'),
            );
            die (json_encode($result));
        }
        if( !empty($_POST['usernamekh']) ){
            $username = $_POST['usernamekh'];
        }else{
            $username = $_SESSION['username'];
        }
        if ( $parts ){
            foreach ($parts as $index => $part) {
                if (in_array($part, $arraydaimn) && $choosemien == 'MN') {
                    $ngay = strtolower(date("l",strtotime($datenow)));
                    $mien       = '';
                    if($part == '2d' || $part == '3d' || $part == '4d'){
                        $mien = $type[Getngaytypemn($ngay)];
                        preg_match_all('/\d+/', $part, $matches);
                        $numbers = intval($matches[0][0]);
                    }
                    if(!empty($mien)){
                        $allmien = explode(',',$mien);
                        $count   = count($allmien);
                        if($numbers >= $count){
                            
                        }else if($numbers < $count){
                            $allmien = array_slice($allmien, 0, $numbers);
                        }
                        foreach ($allmien as $valuemien){
                            $part = $valuemien;
                            if( Getvalueofdai($part, $datenow) == 'OK' ){
                                $string = $parts[$index + 1];
                                $string = explode(" ",$string);
                                foreach($string as $key => $value){
                                    foreach ($arraykieus as $key2 => $kieu) {
                                        $child = array();
                                        if (strpos($value, $kieu) !== false) {
                                            if($kieu == 'blo' && (strpos($string[$key-1], 'xd') !== false || strpos($string[$key-1], '7dao') !== false || strpos($string[$key-1], '17dao') !== false ) ){
                                                $checkxd = 1;
                                            }
                                            $sotien = str_replace(array($kieu, 'n'), array('', ''),$value);
                                            $stringso = '';
                                            for ($i = $key - 1; $i >= 0; $i--) { 
                                                if ($i > 1){
                                                    $i2 = $i - 1;
                                                }else{
                                                    $i2 = $i;
                                                }
                                                if ( strpos($string[$i], "n") == false && strpos($string[$i2], "n") !== false){
                                                    $stringso .= $string[$i] .' ';
                                                    break;
                                                }else if (strpos($string[$i], "n") == false) {
                                                    $stringso .= $string[$i] .' ';
                                                }
                                            }
                                            $gettendai  = gettendai($part);
                                            $mbmnmt     = gettylembmnmt($part);
                                            $gia        = getgia($kieu, $mbmnmt, $username);
                                            $thuc       = $PNH->get_row(" SELECT $kieu FROM `tyle` WHERE `dai` = '$mbmnmt' AND `username` = '$username' ")[$kieu];
                                            $trungtrat  = trungtrat($gettendai, trim($stringso," "), $kieu, $datenow, $sotien, $sotien, $checkxd);
                                            $checkxd    = 0;
                                            if( $trungtrat[1] > 0){
                                                $trangthai      = 'Trúng';
                                                $sltrung        = $trungtrat[0];
                                                $sotientrung    = $trungtrat[1];
                                                $sotrung        = $trungtrat[2];
                                                $stringso       = $trungtrat[3];
                                                $tienxac        = $trungtrat[4];
                                            }else{
                                                $trangthai      = 'Trật';
                                                $sltrung        = $trungtrat[0];
                                                $sotientrung    = $trungtrat[1];
                                                $sotrung        = $trungtrat[2];
                                                $stringso       = $trungtrat[3];
                                                $tienxac        = $trungtrat[4];
                                            }
                                            if( empty($sotientrung)) {
                                                $sotientrung = '0(0n)';
                                            }
                                            if($kieu == 'da'){
                                                $countso            = round(count(explode(" ",trim($stringso," "))) / 2);
                                                $chuoi = explode(' ',$stringso);
                                                $demvui = 0;
                                                $stringso = '';
                                                foreach( $chuoi as $value ){
                                                    if($demvui == 1){
                                                        $demvui = 0;
                                                        $stringso .= $value.' ';
                                                    }else{
                                                        $stringso .= $value.',';
                                                        $demvui += 1;
                                                    }
                                                }
                                                $stringso = trim($stringso,',');
                                            }else{
                                                $countso            = count(explode(" ",trim($stringso," ")));
                                            }
                                            $child['status']        = 'success';
                                            $child['dai']           = $part;
                                            $child['so']            = trim($stringso," ");
                                            $child['demso']         = $countso;
                                            $child['kieu']          = $kieu;
                                            $child['gia']           = $gia;
                                            $child['thuc']          = $thuc;
                                            $child['diem']          = $sotien;
                                            $child['xac']           = $sotien * $countso * $tienxac;
                                            $child['sotien']        = $sotientrung;
                                            $child['sotrung']       = trim($sotrung,",");
                                            $child['sltrung']       = $sltrung;
                                            $child['diemtrung']     = $sltrung * $sotien;
                                            $child['trangthai']     = $trangthai;
                                            array_push($kqchild, $child);
                                            $child = array();
                                            break;
                                        } 
                                    }
                                }
                            }else{
                                $string = $parts[$index + 1];
                                $string = explode(" ",$string);
                                foreach($string as $key => $value){
                                    foreach ($arraykieus as $key2 => $kieu) {
                                        $child = array();
                                        if (strpos($value, $kieu) !== false) {
                                            if( ($kieu == 'blo' && (strpos($string[$key-1], 'xd') !== false || strpos($string[$key-1], '7dao') !== false || strpos($string[$key-1], '17dao') !== false ))  || ($kieu == '27lo' && strpos($string[$key-1], '23dao') !== false) ){
                                                $checkxd = 1;
                                            }
                                            $sotien = str_replace(array($kieu, 'n'), array('', ''),$value);
                                            $stringso = '';
                                            for ($i = $key - 1; $i >= 0; $i--) { 
                                                if ($i > 1){
                                                    $i2 = $i - 1;
                                                }else{
                                                    $i2 = $i;
                                                }
                                                if ( strpos($string[$i], "n") == false && strpos($string[$i2], "n") !== false){
                                                    $stringso .= $string[$i] .' ';
                                                    break;
                                                }else if (strpos($string[$i], "n") == false) {
                                                    $stringso .= $string[$i] .' ';
                                                }
                                            }
                                            $gettendai  = gettendai($part);
                                            $mbmnmt     = gettylembmnmt($part);
                                            $gia        = getgia($kieu, $mbmnmt, $username);
                                            $thuc       = $PNH->get_row(" SELECT $kieu FROM `tyle` WHERE `dai` = '$mbmnmt' AND `username` = '$username' ")[$kieu];
                                            $trungtrat  = trungtrat($gettendai, trim($stringso," "), $kieu, $datenow, $sotien, $sotien, $checkxd);
                                            $checkxd    = 0;
                                            if( $trungtrat[1] > 0){
                                                $trangthai      = 'Trúng';
                                                $sltrung        = $trungtrat[0];
                                                $sotientrung    = $trungtrat[1];
                                                $sotrung        = $trungtrat[2];
                                                $stringso       = $trungtrat[3];
                                                $tienxac        = $trungtrat[4];
                                            }else{
                                                $trangthai      = 'Trật';
                                                $sltrung        = $trungtrat[0];
                                                $sotientrung    = $trungtrat[1];
                                                $sotrung        = $trungtrat[2];
                                                $stringso       = $trungtrat[3];
                                                $tienxac        = $trungtrat[4];
                                            }
                                            if ( $stringso == null ){
                                                for ($i = $key - 1; $i >= 0; $i--) { 
                                                    if ($i > 1){
                                                        $i2 = $i - 1;
                                                    }else{
                                                        $i2 = $i;
                                                    }
                                                    if ( strpos($string[$i], "n") == false && strpos($string[$i2], "n") !== false){
                                                        $stringso .= $string[$i] .' ';
                                                        break;
                                                    }else if (strpos($string[$i], "n") == false) {
                                                        $stringso .= $string[$i] .' ';
                                                    }
                                                }
                                            }
                                            if( empty($sotientrung)) {
                                                $sotientrung = '0(0n)';
                                            }
                                            if($kieu == 'da'){
                                                $countso            = round(count(explode(" ",trim($stringso," "))) / 2);
                                                $chuoi = explode(' ',$stringso);
                                                $demvui = 0;
                                                $stringso = '';
                                                foreach( $chuoi as $value ){
                                                    if($demvui == 1){
                                                        $demvui = 0;
                                                        $stringso .= $value.' ';
                                                    }else{
                                                        $stringso .= $value.',';
                                                        $demvui += 1;
                                                    }
                                                }
                                                $stringso = trim($stringso,',');
                                            }else{
                                                $countso            = count(explode(" ",trim($stringso," ")));
                                            }
                                            $child['status']        = 'error';
                                            $child['dai']           = $part;
                                            $child['so']            = trim($stringso," ");
                                            $child['demso']         = $countso;
                                            $child['kieu']          = $kieu;
                                            $child['gia']           = $gia;
                                            $child['thuc']          = $thuc;
                                            $child['diem']          = $sotien;
                                            $child['xac']           = $sotien * $countso * $tienxac;
                                            $child['sotien']        = $sotientrung;
                                            $child['sotrung']       = trim($sotrung,",");
                                            $child['sltrung']       = $sltrung;
                                            $child['diemtrung']     = $sltrung * $sotien;
                                            $child['trangthai']     = $trangthai;
                                            array_push($kqchild, $child);
                                            $child = array();
                                            break;
                                        } 
                                    }
                                }
                                // $child['status'] = 'error';
                            }
                        }
                    }else{
                        $string = $parts[$index + 1];
                        $string = explode(" ",$string);
                        foreach($string as $key => $value){
                            foreach ($arraykieus as $key2 => $kieu) {
                                $child = array();
                                if (strpos($value, $kieu) !== false) {
                                    if( ($kieu == 'blo' && (strpos($string[$key-1], 'xd') !== false || strpos($string[$key-1], '7dao') !== false || strpos($string[$key-1], '17dao') !== false ))  || ($kieu == '27lo' && strpos($string[$key-1], '23dao') !== false) ){
                                        $checkxd = 1;
                                    }
                                    $sotien = str_replace(array($kieu, 'n'), array('', ''),$value);
                                    $stringso = '';
                                    for ($i = $key - 1; $i >= 0; $i--) { 
                                        if ($i > 1){
                                            $i2 = $i - 1;
                                        }else{
                                            $i2 = $i;
                                        }
                                        if ( strpos($string[$i], "n") == false && strpos($string[$i2], "n") !== false){
                                            $stringso .= $string[$i] .' ';
                                            break;
                                        }else if (strpos($string[$i], "n") == false) {
                                            $stringso .= $string[$i] .' ';
                                        }
                                    }
                                    $gettendai  = gettendai($part);
                                    $mbmnmt     = gettylembmnmt($part);
                                    $gia        = getgia($kieu, $mbmnmt, $username);
                                    $thuc       = $PNH->get_row(" SELECT $kieu FROM `tyle` WHERE `dai` = '$mbmnmt' AND `username` = '$username' ")[$kieu];
                                    $trungtrat  = trungtrat($gettendai, trim($stringso," "), $kieu, $datenow, $sotien, $sotien, $checkxd);
                                    $checkxd    = 0;
                                    if( $trungtrat[1] > 0){
                                        $trangthai      = 'Trúng';
                                        $sltrung        = $trungtrat[0];
                                        $sotientrung    = $trungtrat[1];
                                        $sotrung        = $trungtrat[2];
                                        $stringso       = $trungtrat[3];
                                        $tienxac        = $trungtrat[4];
                                    }else{
                                        $trangthai      = 'Trật';
                                        $sltrung        = $trungtrat[0];
                                        $sotientrung    = $trungtrat[1];
                                        $sotrung        = $trungtrat[2];
                                        $stringso       = $trungtrat[3];
                                        $tienxac        = $trungtrat[4];
                                    }
                                    if ( $stringso == null ){
                                        for ($i = $key - 1; $i >= 0; $i--) { 
                                            if ($i > 1){
                                                $i2 = $i - 1;
                                            }else{
                                                $i2 = $i;
                                            }
                                            if ( strpos($string[$i], "n") == false && strpos($string[$i2], "n") !== false){
                                                $stringso .= $string[$i] .' ';
                                                break;
                                            }else if (strpos($string[$i], "n") == false) {
                                                $stringso .= $string[$i] .' ';
                                            }
                                        }
                                    }
                                    if( empty($sotientrung)) {
                                        $sotientrung = '0(0n)';
                                    }
                                    if($kieu == 'da'){
                                        $countso            = round(count(explode(" ",trim($stringso," "))) / 2);
                                        $chuoi = explode(' ',$stringso);
                                        $demvui = 0;
                                        $stringso = '';
                                        foreach( $chuoi as $value ){
                                            if($demvui == 1){
                                                $demvui = 0;
                                                $stringso .= $value.' ';
                                            }else{
                                                $stringso .= $value.',';
                                                $demvui += 1;
                                            }
                                        }
                                        $stringso = trim($stringso,',');
                                    }else{
                                        $countso            = count(explode(" ",trim($stringso," ")));
                                    }
                                    $child['status']        = 'success';
                                    $child['dai']           = $part;
                                    $child['so']            = trim($stringso," ");
                                    $child['demso']         = $countso;
                                    $child['kieu']          = $kieu;
                                    $child['gia']           = $gia;
                                    $child['thuc']          = $thuc;
                                    $child['diem']          = $sotien;
                                    $child['xac']           = $sotien * $countso * $tienxac;
                                    $child['sotien']        = $sotientrung;
                                    $child['sotrung']       = trim($sotrung,",");
                                    $child['sltrung']       = $sltrung;
                                    $child['diemtrung']     = $sltrung * $sotien;
                                    $child['trangthai']     = $trangthai;
                                    array_push($kqchild, $child);
                                    $child = array();
                                    break;
                                } 
                            }
                        }
                    }
                }else if (in_array($part, $arraydaimt) && $choosemien == 'MT') {
                    $ngay = strtolower(date("l",strtotime($datenow)));
                    $mien       = '';
                    if($part == '2d' || $part == '3d' || $part == '4d'){
                        $mien = $type[Getngaytypemt($ngay)];
                        preg_match_all('/\d+/', $part, $matches);
                        $numbers = intval($matches[0][0]);
                    }
                    if(!empty($mien)){
                        $allmien = explode(',',$mien);
                        $count   = count($allmien);
                        if($numbers >= $count){
                            
                        }else if($numbers < $count){
                            $allmien = array_slice($allmien, 0, $numbers);
                        }
                        foreach ($allmien as $valuemien){
                            $part = $valuemien;
                            if( Getvalueofdai($part, $datenow) == 'OK' ){
                                $string = $parts[$index + 1];
                                $string = explode(" ",$string);
                                foreach($string as $key => $value){
                                    foreach ($arraykieus as $key2 => $kieu) {
                                        $child = array();
                                        if (strpos($value, $kieu) !== false) {
                                            if($kieu == 'blo' && (strpos($string[$key-1], 'xd') !== false || strpos($string[$key-1], '7dao') !== false || strpos($string[$key-1], '17dao') !== false ) ){
                                                $checkxd = 1;
                                            }
                                            $sotien = str_replace(array($kieu, 'n'), array('', ''),$value);
                                            $stringso = '';
                                            for ($i = $key - 1; $i >= 0; $i--) { 
                                                if ($i > 1){
                                                    $i2 = $i - 1;
                                                }else{
                                                    $i2 = $i;
                                                }
                                                if ( strpos($string[$i], "n") == false && strpos($string[$i2], "n") !== false){
                                                    $stringso .= $string[$i] .' ';
                                                    break;
                                                }else if (strpos($string[$i], "n") == false) {
                                                    $stringso .= $string[$i] .' ';
                                                }
                                            }
                                            $gettendai  = gettendai($part);
                                            $mbmnmt     = gettylembmnmt($part);
                                            $gia        = getgia($kieu, $mbmnmt, $username);
                                            $thuc       = $PNH->get_row(" SELECT $kieu FROM `tyle` WHERE `dai` = '$mbmnmt' AND `username` = '$username' ")[$kieu];
                                            $trungtrat  = trungtrat($gettendai, trim($stringso," "), $kieu, $datenow, $sotien, $sotien, $checkxd);
                                            $checkxd    = 0;
                                            if( $trungtrat[1] > 0){
                                                $trangthai      = 'Trúng';
                                                $sltrung        = $trungtrat[0];
                                                $sotientrung    = $trungtrat[1];
                                                $sotrung        = $trungtrat[2];
                                                $stringso       = $trungtrat[3];
                                                $tienxac        = $trungtrat[4];
                                            }else{
                                                $trangthai      = 'Trật';
                                                $sltrung        = $trungtrat[0];
                                                $sotientrung    = $trungtrat[1];
                                                $sotrung        = $trungtrat[2];
                                                $stringso       = $trungtrat[3];
                                                $tienxac        = $trungtrat[4];
                                            }
                                            if( empty($sotientrung)) {
                                                $sotientrung = '0(0n)';
                                            }
                                            if($kieu == 'da'){
                                                $countso            = round(count(explode(" ",trim($stringso," "))) / 2);
                                                $chuoi = explode(' ',$stringso);
                                                $demvui = 0;
                                                $stringso = '';
                                                foreach( $chuoi as $value ){
                                                    if($demvui == 1){
                                                        $demvui = 0;
                                                        $stringso .= $value.' ';
                                                    }else{
                                                        $stringso .= $value.',';
                                                        $demvui += 1;
                                                    }
                                                }
                                                $stringso = trim($stringso,',');
                                            }else{
                                                $countso            = count(explode(" ",trim($stringso," ")));
                                            }
                                            $child['status']        = 'success';
                                            $child['dai']           = $part;
                                            $child['so']            = trim($stringso," ");
                                            $child['demso']         = $countso;
                                            $child['kieu']          = $kieu;
                                            $child['gia']           = $gia;
                                            $child['thuc']          = $thuc;
                                            $child['diem']          = $sotien;
                                            $child['xac']           = $sotien * $countso * $tienxac;
                                            $child['sotien']        = $sotientrung;
                                            $child['sotrung']       = trim($sotrung,",");
                                            $child['sltrung']       = $sltrung;
                                            $child['diemtrung']     = $sltrung * $sotien;
                                            $child['trangthai']     = $trangthai;
                                            array_push($kqchild, $child);
                                            $child = array();
                                            break;
                                        } 
                                    }
                                }
                            }else{
                                $string = $parts[$index + 1];
                                $string = explode(" ",$string);
                                foreach($string as $key => $value){
                                    foreach ($arraykieus as $key2 => $kieu) {
                                        $child = array();
                                        if (strpos($value, $kieu) !== false) {
                                            if( ($kieu == 'blo' && (strpos($string[$key-1], 'xd') !== false || strpos($string[$key-1], '7dao') !== false || strpos($string[$key-1], '17dao') !== false ))  || ($kieu == '27lo' && strpos($string[$key-1], '23dao') !== false) ){
                                                $checkxd = 1;
                                            }
                                            $sotien = str_replace(array($kieu, 'n'), array('', ''),$value);
                                            $stringso = '';
                                            for ($i = $key - 1; $i >= 0; $i--) { 
                                                if ($i > 1){
                                                    $i2 = $i - 1;
                                                }else{
                                                    $i2 = $i;
                                                }
                                                if ( strpos($string[$i], "n") == false && strpos($string[$i2], "n") !== false){
                                                    $stringso .= $string[$i] .' ';
                                                    break;
                                                }else if (strpos($string[$i], "n") == false) {
                                                    $stringso .= $string[$i] .' ';
                                                }
                                            }
                                            $gettendai  = gettendai($part);
                                            $mbmnmt     = gettylembmnmt($part);
                                            $gia        = getgia($kieu, $mbmnmt, $username);
                                            $thuc       = $PNH->get_row(" SELECT $kieu FROM `tyle` WHERE `dai` = '$mbmnmt' AND `username` = '$username' ")[$kieu];
                                            $trungtrat  = trungtrat($gettendai, trim($stringso," "), $kieu, $datenow, $sotien, $sotien, $checkxd);
                                            $checkxd    = 0;
                                            if( $trungtrat[1] > 0){
                                                $trangthai      = 'Trúng';
                                                $sltrung        = $trungtrat[0];
                                                $sotientrung    = $trungtrat[1];
                                                $sotrung        = $trungtrat[2];
                                                $stringso       = $trungtrat[3];
                                                $tienxac        = $trungtrat[4];
                                            }else{
                                                $trangthai      = 'Trật';
                                                $sltrung        = $trungtrat[0];
                                                $sotientrung    = $trungtrat[1];
                                                $sotrung        = $trungtrat[2];
                                                $stringso       = $trungtrat[3];
                                                $tienxac        = $trungtrat[4];
                                            }
                                            if ( $stringso == null ){
                                                for ($i = $key - 1; $i >= 0; $i--) { 
                                                    if ($i > 1){
                                                        $i2 = $i - 1;
                                                    }else{
                                                        $i2 = $i;
                                                    }
                                                    if ( strpos($string[$i], "n") == false && strpos($string[$i2], "n") !== false){
                                                        $stringso .= $string[$i] .' ';
                                                        break;
                                                    }else if (strpos($string[$i], "n") == false) {
                                                        $stringso .= $string[$i] .' ';
                                                    }
                                                }
                                            }
                                            if( empty($sotientrung)) {
                                                $sotientrung = '0(0n)';
                                            }
                                            if($kieu == 'da'){
                                                $countso            = round(count(explode(" ",trim($stringso," "))) / 2);
                                                $chuoi = explode(' ',$stringso);
                                                $demvui = 0;
                                                $stringso = '';
                                                foreach( $chuoi as $value ){
                                                    if($demvui == 1){
                                                        $demvui = 0;
                                                        $stringso .= $value.' ';
                                                    }else{
                                                        $stringso .= $value.',';
                                                        $demvui += 1;
                                                    }
                                                }
                                                $stringso = trim($stringso,',');
                                            }else{
                                                $countso            = count(explode(" ",trim($stringso," ")));
                                            }
                                            $child['status']        = 'error';
                                            $child['dai']           = $part;
                                            $child['so']            = trim($stringso," ");
                                            $child['demso']         = $countso;
                                            $child['kieu']          = $kieu;
                                            $child['gia']           = $gia;
                                            $child['thuc']          = $thuc;
                                            $child['diem']          = $sotien;
                                            $child['xac']           = $sotien * $countso * $tienxac;
                                            $child['sotien']        = $sotientrung;
                                            $child['sotrung']       = trim($sotrung,",");
                                            $child['sltrung']       = $sltrung;
                                            $child['diemtrung']     = $sltrung * $sotien;
                                            $child['trangthai']     = $trangthai;
                                            array_push($kqchild, $child);
                                            $child = array();
                                            break;
                                        } 
                                    }
                                }
                                // $child['status'] = 'error';
                            }
                        }
                    }else{
                        $string = $parts[$index + 1];
                        $string = explode(" ",$string);
                        foreach($string as $key => $value){
                            foreach ($arraykieus as $key2 => $kieu) {
                                $child = array();
                                if (strpos($value, $kieu) !== false) {
                                    if( ($kieu == 'blo' && (strpos($string[$key-1], 'xd') !== false || strpos($string[$key-1], '7dao') !== false || strpos($string[$key-1], '17dao') !== false ))  || ($kieu == '27lo' && strpos($string[$key-1], '23dao') !== false) ){
                                        $checkxd = 1;
                                    }
                                    $sotien = str_replace(array($kieu, 'n'), array('', ''),$value);
                                    $stringso = '';
                                    for ($i = $key - 1; $i >= 0; $i--) { 
                                        if ($i > 1){
                                            $i2 = $i - 1;
                                        }else{
                                            $i2 = $i;
                                        }
                                        if ( strpos($string[$i], "n") == false && strpos($string[$i2], "n") !== false){
                                            $stringso .= $string[$i] .' ';
                                            break;
                                        }else if (strpos($string[$i], "n") == false) {
                                            $stringso .= $string[$i] .' ';
                                        }
                                    }
                                    $gettendai  = gettendai($part);
                                    $mbmnmt     = gettylembmnmt($part);
                                    $gia        = getgia($kieu, $mbmnmt, $username);
                                    $thuc       = $PNH->get_row(" SELECT $kieu FROM `tyle` WHERE `dai` = '$mbmnmt' AND `username` = '$username' ")[$kieu];
                                    $trungtrat  = trungtrat($gettendai, trim($stringso," "), $kieu, $datenow, $sotien, $sotien, $checkxd);
                                    $checkxd    = 0;
                                    if( $trungtrat[1] > 0){
                                        $trangthai      = 'Trúng';
                                        $sltrung        = $trungtrat[0];
                                        $sotientrung    = $trungtrat[1];
                                        $sotrung        = $trungtrat[2];
                                        $stringso       = $trungtrat[3];
                                        $tienxac        = $trungtrat[4];
                                    }else{
                                        $trangthai      = 'Trật';
                                        $sltrung        = $trungtrat[0];
                                        $sotientrung    = $trungtrat[1];
                                        $sotrung        = $trungtrat[2];
                                        $stringso       = $trungtrat[3];
                                        $tienxac        = $trungtrat[4];
                                    }
                                    if ( $stringso == null ){
                                        for ($i = $key - 1; $i >= 0; $i--) { 
                                            if ($i > 1){
                                                $i2 = $i - 1;
                                            }else{
                                                $i2 = $i;
                                            }
                                            if ( strpos($string[$i], "n") == false && strpos($string[$i2], "n") !== false){
                                                $stringso .= $string[$i] .' ';
                                                break;
                                            }else if (strpos($string[$i], "n") == false) {
                                                $stringso .= $string[$i] .' ';
                                            }
                                        }
                                    }
                                    if( empty($sotientrung)) {
                                        $sotientrung = '0(0n)';
                                    }
                                    if($kieu == 'da'){
                                        $countso            = round(count(explode(" ",trim($stringso," "))) / 2);
                                        $chuoi = explode(' ',$stringso);
                                        $demvui = 0;
                                        $stringso = '';
                                        foreach( $chuoi as $value ){
                                            if($demvui == 1){
                                                $demvui = 0;
                                                $stringso .= $value.' ';
                                            }else{
                                                $stringso .= $value.',';
                                                $demvui += 1;
                                            }
                                        }
                                        $stringso = trim($stringso,',');
                                    }else{
                                        $countso            = count(explode(" ",trim($stringso," ")));
                                    }
                                    $child['status']        = 'success';
                                    $child['dai']           = $part;
                                    $child['so']            = trim($stringso," ");
                                    $child['demso']         = $countso;
                                    $child['kieu']          = $kieu;
                                    $child['gia']           = $gia;
                                    $child['thuc']          = $thuc;
                                    $child['diem']          = $sotien;
                                    $child['xac']           = $sotien * $countso * $tienxac;
                                    $child['sotien']        = $sotientrung;
                                    $child['sotrung']       = trim($sotrung,",");
                                    $child['sltrung']       = $sltrung;
                                    $child['diemtrung']     = $sltrung * $sotien;
                                    $child['trangthai']     = $trangthai;
                                    array_push($kqchild, $child);
                                    $child = array();
                                    break;
                                } 
                            }
                        }
                    }
                }else if(in_array($part, $arraydaimb) && $choosemien == 'MB'){
                    $string = $parts[$index + 1];
                    $string = explode(" ",$string);
                    foreach($string as $key => $value){
                        foreach ($arraykieus as $kieu) {
                            $child = array();
                            if (strpos($value, $kieu) !== false) {
                                if($kieu == '27lo' && strpos($string[$key-1], '23dao') !== false  ){
                                    $checkxd = 1;
                                }
                                $sotien = str_replace(array($kieu, 'n'), array('', ''),$value);
                                $stringso = '';
                                for ($i = $key - 1; $i >= 0; $i--) { 
                                    if ($i > 1){
                                        $i2 = $i - 1;
                                    }else{
                                        $i2 = $i;
                                    }
                                    if ( strpos($string[$i], "n") == false && strpos($string[$i2], "n") !== false){
                                        $stringso .= $string[$i] .' ';
                                        break;
                                    }else if (strpos($string[$i], "n") == false) {
                                        $stringso .= $string[$i] .' ';
                                    }
                                }
                                $gettendai  = gettendai($part);
                                $mbmnmt     = gettylembmnmt($part);
                                $gia        = getgia($kieu, $mbmnmt, $username);
                                $thuc       = $PNH->get_row(" SELECT $kieu FROM `tyle` WHERE `dai` = '$mbmnmt' AND `username` = '$username' ")[$kieu];
                                $trungtrat  = trungtrat($gettendai, trim($stringso," "), $kieu, $datenow, $sotien, $thuc, $checkxd);
                                $checkxd    = 0;
                                if( $trungtrat[1] > 0){
                                    $trangthai      = 'Trúng';
                                    $sltrung        = $trungtrat[0];
                                    $sotientrung    = $trungtrat[1];
                                    $sotrung        = $trungtrat[2];
                                    $stringso       = $trungtrat[3];
                                    $tienxac        = $trungtrat[4];
                                }else{
                                    $trangthai      = 'Trật';
                                    $sltrung        = $trungtrat[0];
                                    $sotientrung    = $trungtrat[1];
                                    $sotrung        = $trungtrat[2];
                                    $stringso       = $trungtrat[3];
                                    $tienxac        = $trungtrat[4];
                                }
                                if( empty($sotientrung)) {
                                    $sotientrung = '0(0n)';
                                }
                                if($kieu == 'da'){
                                    $countso            = round(count(explode(" ",trim($stringso," "))) / 2);
                                    $chuoi = explode(' ',$stringso);
                                    $demvui = 0;
                                    $stringso = '';
                                    foreach( $chuoi as $value ){
                                        if($demvui == 1){
                                            $demvui = 0;
                                            $stringso .= $value.' ';
                                        }else{
                                            $stringso .= $value.',';
                                            $demvui += 1;
                                        }
                                    }
                                    $stringso = trim($stringso,',');
                                }else{
                                    $countso            = count(explode(" ",trim($stringso," ")));
                                }
                                $child['status']        = 'success';
                                $child['dai']           = $part;
                                $child['so']            = trim($stringso," ");
                                $child['demso']         = $countso;
                                $child['kieu']          = $kieu;
                                $child['gia']           = $gia;
                                $child['thuc']          = $thuc;
                                $child['diem']          = $sotien;
                                $child['xac']           = $sotien * $countso * $tienxac;
                                $child['sotien']        = $sotientrung;
                                $child['sotrung']       = trim($sotrung,",");
                                $child['sltrung']       = $sltrung;
                                $child['diemtrung']     = $sltrung * $sotien;
                                $child['trangthai']     = $trangthai;
                                array_push($kqchild, $child);
                                $child = array();
                                break;
                            } 
                        }
                    }
                }else{
                    if( in_array($part, $arraydaimn) || in_array($part, $arraydaimt) || in_array($part, $arraydaimb)){
                        $string = $parts[$index + 1];
                        $string = explode(" ",$string);
                        foreach($string as $key => $value){
                            foreach ($arraykieus as $key2 => $kieu) {
                                $child = array();
                                if (strpos($value, $kieu) !== false) {
                                    if( ($kieu == 'blo' && (strpos($string[$key-1], 'xd') !== false || strpos($string[$key-1], '7dao') !== false || strpos($string[$key-1], '17dao') !== false ))  || ($kieu == '27lo' && strpos($string[$key-1], '23dao') !== false) ){
                                        $checkxd = 1;
                                    }
                                    $sotien = str_replace(array($kieu, 'n'), array('', ''),$value);
                                    $stringso = '';
                                    for ($i = $key - 1; $i >= 0; $i--) { 
                                        if ($i > 1){
                                            $i2 = $i - 1;
                                        }else{
                                            $i2 = $i;
                                        }
                                        if ( strpos($string[$i], "n") == false && strpos($string[$i2], "n") !== false){
                                            $stringso .= $string[$i] .' ';
                                            break;
                                        }else if (strpos($string[$i], "n") == false) {
                                            $stringso .= $string[$i] .' ';
                                        }
                                    }
                                    $gettendai  = gettendai($part);
                                    $mbmnmt     = gettylembmnmt($part);
                                    $gia        = getgia($kieu, $mbmnmt, $username);
                                    $thuc       = $PNH->get_row(" SELECT $kieu FROM `tyle` WHERE `dai` = '$mbmnmt' AND `username` = '$username' ")[$kieu];
                                    $trungtrat  = trungtrat($gettendai, trim($stringso," "), $kieu, $datenow, $sotien, $sotien, $checkxd);
                                    $checkxd    = 0;
                                    if( $trungtrat[1] > 0){
                                        $trangthai      = 'Trúng';
                                        $sltrung        = $trungtrat[0];
                                        $sotientrung    = $trungtrat[1];
                                        $sotrung        = $trungtrat[2];
                                        $stringso       = $trungtrat[3];
                                        $tienxac        = $trungtrat[4];
                                    }else{
                                        $trangthai      = 'Trật';
                                        $sltrung        = $trungtrat[0];
                                        $sotientrung    = $trungtrat[1];
                                        $sotrung        = $trungtrat[2];
                                        $stringso       = $trungtrat[3];
                                        $tienxac        = $trungtrat[4];
                                    }
                                    if ( $stringso == null ){
                                        for ($i = $key - 1; $i >= 0; $i--) { 
                                            if ($i > 1){
                                                $i2 = $i - 1;
                                            }else{
                                                $i2 = $i;
                                            }
                                            if ( strpos($string[$i], "n") == false && strpos($string[$i2], "n") !== false){
                                                $stringso .= $string[$i] .' ';
                                                break;
                                            }else if (strpos($string[$i], "n") == false) {
                                                $stringso .= $string[$i] .' ';
                                            }
                                        }
                                    }
                                    if( empty($sotientrung)) {
                                        $sotientrung = '0(0n)';
                                    }
                                    if($kieu == 'da'){
                                        $countso            = round(count(explode(" ",trim($stringso," "))) / 2);
                                        $chuoi = explode(' ',$stringso);
                                        $demvui = 0;
                                        $stringso = '';
                                        foreach( $chuoi as $value ){
                                            if($demvui == 1){
                                                $demvui = 0;
                                                $stringso .= $value.' ';
                                            }else{
                                                $stringso .= $value.',';
                                                $demvui += 1;
                                            }
                                        }
                                        $stringso = trim($stringso,',');
                                    }else{
                                        $countso            = count(explode(" ",trim($stringso," ")));
                                    }
                                    $child['status']        = 'error';
                                    $child['dai']           = $part;
                                    $child['so']            = trim($stringso," ");
                                    $child['demso']         = $countso;
                                    $child['kieu']          = $kieu;
                                    $child['gia']           = $gia;
                                    $child['thuc']          = $thuc;
                                    $child['diem']          = $sotien;
                                    $child['xac']           = $sotien * $countso * $tienxac;
                                    $child['sotien']        = $sotientrung;
                                    $child['sotrung']       = trim($sotrung,",");
                                    $child['sltrung']       = $sltrung;
                                    $child['diemtrung']     = $sltrung * $sotien;
                                    $child['trangthai']     = $trangthai;
                                    array_push($kqchild, $child);
                                    $child = array();
                                    break;
                                } 
                            }
                        }
                    }
                }
            }
        }else{
            $child['status'] = 'error';
        }        
        // echo '<pre>';
        // print_r($kqchild);
        // echo '</pre>';
        $filltabletrungthuc         = filltabletrungthuc($kqchild);
        $result['data']             = $filltabletrungthuc[0];
        $result['haic']             = $filltabletrungthuc[1];
        $result['bac']              = $filltabletrungthuc[2];
        $result['xc']               = $filltabletrungthuc[3];
        $result['dd']               = $filltabletrungthuc[4];
        $result['da']               = $filltabletrungthuc[5];
        $result['totaltrung']       = $filltabletrungthuc[6];
        $result['totalxac']         = $filltabletrungthuc[7];
        $result['totalthuc']        = $filltabletrungthuc[8];
        $result['anthua']           = $result['totalthuc'] / 100 - $result['totaltrung'];
        $result['content']          = $kqchild;
        die (json_encode($result));
    }

    
    if($_POST['type'] == 'Saved' )
    {
        $content    = $_POST['content'];
        $inputday   = $_POST['inputday'];
        $datenow    = date('Y-m-d', strtotime($inputday));
        $choosemien = $_POST['choosemien'];
        $content    = strtolower($content);
        $keywords_regex = "/\b(4d|3d|2d|mb|tp|dt|cm|tth|py|bt|vt|bl|dl|qna|dnai|ct|st|dan|kh|tn|ag|bdg|bd|qt|qb|vl|tv|gl|nt|la|bp|hg|qng|dan|tg|kg|ld|kt|dno)\b/";
        $parts      = preg_split($keywords_regex, $content, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
        $arraydai   = array('4d','3d','2d','mb','tp','dt','cm','tth','py','bt','vt','bl','dl','qna','dnai','ct','st','dan','kh','tn','ag','qt','qb','vl','bdg','bd','tv','gl','nt','la','bp','hg','qng','dan','tg','kg','ld','kt','dno');
        $arraykieus = array('18lo','blo','bdao','17lo','17dao','17lod','7lo','7lod','7dao','27lo','23lo','23dao','23d','dau','duoi','xdao','xd','dd','ab','xc','da','a','b');
        $result     = array();
        $kqchild    = array();
        if(empty($_SESSION['username']))
        {
            $result = array(
                'status' => 0,
                'title' => 'Cảnh báo',
                'content' => 'Vui lòng đăng nhập',
                'url'   => BASE_URL('/Auth/Login'),
            );
            die (json_encode($result));
        }
        if( !empty(($_POST['usernamekh'])) ){
            $username = $_POST['usernamekh'];
        }else if( !empty($_POST['usernamekh2']) ){
            $username2 = $_POST['usernamekh2'];
        }else{
            $username = $_SESSION['username'];
        }
        if ( $parts ){
            foreach ($parts as $index => $part) {
                if (in_array($part, $arraydai)) {
                    $ngay = strtolower(date("l",strtotime($datenow)));
                    $mien       = '';
                    if($part == '2d' || $part == '3d' || $part == '4d'){
                        if($choosemien == 'MT'){
                            $mien = $type[Getngaytypemt($ngay)];
                        }else if($choosemien == 'MN'){
                            $mien = $type[Getngaytypemn($ngay)];
                        }
                        preg_match_all('/\d+/', $part, $matches);
                        $numbers = intval($matches[0][0]);
                    }
                    if(!empty($mien)){
                        $allmien = explode(',',$mien);
                        $count   = count($allmien);
                        if($numbers >= $count){
                            
                        }else if($numbers < $count){
                            $allmien = array_slice($allmien, 0, $numbers);
                        }
                        foreach ($allmien as $valuemien){
                            $part = $valuemien;
                            if( Getvalueofdai($part, $datenow) == 'OK' ){
                                $string = $parts[$index + 1];
                                $string = explode(" ",$string);
                                foreach($string as $key => $value){
                                    foreach ($arraykieus as $key2 => $kieu) {
                                        $child = array();
                                        if (strpos($value, $kieu) !== false) {
                                            if($kieu == 'blo' && (strpos($string[$key-1], 'xd') !== false || strpos($string[$key-1], '7dao') !== false || strpos($string[$key-1], '17dao') !== false ) ){
                                                $checkxd = 1;
                                            }
                                            $sotien = str_replace(array($kieu, 'n'), array('', ''),$value);
                                            $stringso = '';
                                            for ($i = $key - 1; $i >= 0; $i--) { 
                                                if ($i > 1){
                                                    $i2 = $i - 1;
                                                }else{
                                                    $i2 = $i;
                                                }
                                                if ( strpos($string[$i], "n") == false && strpos($string[$i2], "n") !== false){
                                                    $stringso .= $string[$i] .' ';
                                                    break;
                                                }else if (strpos($string[$i], "n") == false) {
                                                    $stringso .= $string[$i] .' ';
                                                }
                                            }
                                            $gettendai  = gettendai($part);
                                            $mbmnmt     = gettylembmnmt($part);
                                            $gia        = getgia($kieu, $mbmnmt, $username);
                                            $thuc       = $PNH->get_row(" SELECT $kieu FROM `tyle` WHERE `dai` = '$mbmnmt' AND `username` = '$username' ")[$kieu];
                                            $trungtrat  = trungtrat($gettendai, trim($stringso," "), $kieu, $datenow, $sotien, $sotien, $checkxd);
                                            $checkxd    = 0;
                                            if( $trungtrat[1] > 0){
                                                $trangthai      = 'Trúng';
                                                $sltrung        = $trungtrat[0];
                                                $sotientrung    = $trungtrat[1];
                                                $sotrung        = $trungtrat[2];
                                                $stringso       = $trungtrat[3];
                                                $tienxac        = $trungtrat[4];
                                            }else{
                                                $trangthai      = 'Trật';
                                                $sltrung        = $trungtrat[0];
                                                $sotientrung    = $trungtrat[1];
                                                $sotrung        = $trungtrat[2];
                                                $stringso       = $trungtrat[3];
                                                $tienxac        = $trungtrat[4];
                                            }
                                            if( empty($sotientrung)) {
                                                $sotientrung = '0(0n)';
                                            }
                                            if($kieu == 'da'){
                                                $countso            = round(count(explode(" ",trim($stringso," "))) / 2);
                                                $chuoi = explode(' ',$stringso);
                                                $demvui = 0;
                                                $stringso = '';
                                                foreach( $chuoi as $value ){
                                                    if($demvui == 1){
                                                        $demvui = 0;
                                                        $stringso .= $value.' ';
                                                    }else{
                                                        $stringso .= $value.',';
                                                        $demvui += 1;
                                                    }
                                                }
                                                $stringso = trim($stringso,',');
                                            }else{
                                                $countso            = count(explode(" ",trim($stringso," ")));
                                            }
                                            $child['status']        = 'success';
                                            $child['dai']           = $part;
                                            $child['so']            = trim($stringso," ");
                                            $child['demso']         = $countso;
                                            $child['kieu']          = $kieu;
                                            $child['gia']           = $gia;
                                            $child['thuc']          = $thuc;
                                            $child['diem']          = $sotien;
                                            $child['xac']           = $sotien * $countso * $tienxac;
                                            $child['sotien']        = $sotientrung;
                                            $child['sotrung']       = trim($sotrung,",");
                                            $child['sltrung']       = $sltrung;
                                            $child['diemtrung']     = $sltrung * $sotien;
                                            $child['trangthai']     = $trangthai;
                                            array_push($kqchild, $child);
                                            $child = array();
                                            break;
                                        } 
                                    }
                                }
                            }else {
                                $string = $parts[$index + 1];
                                $string = explode(" ",$string);
                                foreach($string as $key => $value){
                                    foreach ($arraykieus as $key2 => $kieu) {
                                        $child = array();
                                        if (strpos($value, $kieu) !== false) {
                                            if( ($kieu == 'blo' && (strpos($string[$key-1], 'xd') !== false || strpos($string[$key-1], '7dao') !== false || strpos($string[$key-1], '17dao') !== false ))  || ($kieu == '27lo' && strpos($string[$key-1], '23dao') !== false) ){
                                                $checkxd = 1;
                                            }
                                            $sotien = str_replace(array($kieu, 'n'), array('', ''),$value);
                                            $stringso = '';
                                            for ($i = $key - 1; $i >= 0; $i--) { 
                                                if ($i > 1){
                                                    $i2 = $i - 1;
                                                }else{
                                                    $i2 = $i;
                                                }
                                                if ( strpos($string[$i], "n") == false && strpos($string[$i2], "n") !== false){
                                                    $stringso .= $string[$i] .' ';
                                                    break;
                                                }else if (strpos($string[$i], "n") == false) {
                                                    $stringso .= $string[$i] .' ';
                                                }
                                            }
                                            $gettendai  = gettendai($part);
                                            $mbmnmt     = gettylembmnmt($part);
                                            $gia        = getgia($kieu, $mbmnmt, $username);
                                            $thuc       = $PNH->get_row(" SELECT $kieu FROM `tyle` WHERE `dai` = '$mbmnmt' AND `username` = '$username' ")[$kieu];
                                            $trungtrat  = trungtrat($gettendai, trim($stringso," "), $kieu, $datenow, $sotien, $sotien, $checkxd);
                                            $checkxd    = 0;
                                            if( $trungtrat[1] > 0){
                                                $trangthai      = 'Trúng';
                                                $sltrung        = $trungtrat[0];
                                                $sotientrung    = $trungtrat[1];
                                                $sotrung        = $trungtrat[2];
                                                $stringso       = $trungtrat[3];
                                                $tienxac        = $trungtrat[4];
                                            }else{
                                                $trangthai      = 'Trật';
                                                $sltrung        = $trungtrat[0];
                                                $sotientrung    = $trungtrat[1];
                                                $sotrung        = $trungtrat[2];
                                                $stringso       = $trungtrat[3];
                                                $tienxac        = $trungtrat[4];
                                            }
                                            if ( $stringso == null ){
                                                for ($i = $key - 1; $i >= 0; $i--) { 
                                                    if ($i > 1){
                                                        $i2 = $i - 1;
                                                    }else{
                                                        $i2 = $i;
                                                    }
                                                    if ( strpos($string[$i], "n") == false && strpos($string[$i2], "n") !== false){
                                                        $stringso .= $string[$i] .' ';
                                                        break;
                                                    }else if (strpos($string[$i], "n") == false) {
                                                        $stringso .= $string[$i] .' ';
                                                    }
                                                }
                                            }
                                            if( empty($sotientrung)) {
                                                $sotientrung = '0(0n)';
                                            }
                                            if($kieu == 'da'){
                                                $countso            = round(count(explode(" ",trim($stringso," "))) / 2);
                                                $chuoi = explode(' ',$stringso);
                                                $demvui = 0;
                                                $stringso = '';
                                                foreach( $chuoi as $value ){
                                                    if($demvui == 1){
                                                        $demvui = 0;
                                                        $stringso .= $value.' ';
                                                    }else{
                                                        $stringso .= $value.',';
                                                        $demvui += 1;
                                                    }
                                                }
                                                $stringso = trim($stringso,',');
                                            }else{
                                                $countso            = count(explode(" ",trim($stringso," ")));
                                            }
                                            $child['status']        = 'error';
                                            $child['dai']           = $part;
                                            $child['so']            = trim($stringso," ");
                                            $child['demso']         = $countso;
                                            $child['kieu']          = $kieu;
                                            $child['gia']           = $gia;
                                            $child['thuc']          = $thuc;
                                            $child['diem']          = $sotien;
                                            $child['xac']           = $sotien * $countso * $tienxac;
                                            $child['sotien']        = $sotientrung;
                                            $child['sotrung']       = trim($sotrung,",");
                                            $child['sltrung']       = $sltrung;
                                            $child['diemtrung']     = $sltrung * $sotien;
                                            $child['trangthai']     = $trangthai;
                                            array_push($kqchild, $child);
                                            $child = array();
                                            break;
                                        } 
                                    }
                                }
                                // $child['status'] = 'error';
                            }
                        }
                    }else if( $part == 'mb' ){
                        $string = $parts[$index + 1];
                        $string = explode(" ",$string);
                        foreach($string as $key => $value){
                            foreach ($arraykieus as $kieu) {
                                $child = array();
                                if (strpos($value, $kieu) !== false) {
                                    if($kieu == '27lo' && strpos($string[$key-1], '23dao') !== false  ){
                                        $checkxd = 1;
                                    }
                                    $sotien = str_replace(array($kieu, 'n'), array('', ''),$value);
                                    $stringso = '';
                                    for ($i = $key - 1; $i >= 0; $i--) { 
                                        if ($i > 1){
                                            $i2 = $i - 1;
                                        }else{
                                            $i2 = $i;
                                        }
                                        if ( strpos($string[$i], "n") == false && strpos($string[$i2], "n") !== false){
                                            $stringso .= $string[$i] .' ';
                                            break;
                                        }else if (strpos($string[$i], "n") == false) {
                                            $stringso .= $string[$i] .' ';
                                        }
                                    }
                                    $gettendai  = gettendai($part);
                                    $mbmnmt     = gettylembmnmt($part);
                                    $gia        = getgia($kieu, $mbmnmt, $username);
                                    $thuc       = $PNH->get_row(" SELECT $kieu FROM `tyle` WHERE `dai` = '$mbmnmt' AND `username` = '$username' ")[$kieu];
                                    $trungtrat  = trungtrat($gettendai, trim($stringso," "), $kieu, $datenow, $sotien, $thuc, $checkxd);
                                    $checkxd    = 0;
                                    if( $trungtrat[1] > 0){
                                        $trangthai      = 'Trúng';
                                        $sltrung        = $trungtrat[0];
                                        $sotientrung    = $trungtrat[1];
                                        $sotrung        = $trungtrat[2];
                                        $stringso       = $trungtrat[3];
                                        $tienxac        = $trungtrat[4];
                                    }else{
                                        $trangthai      = 'Trật';
                                        $sltrung        = $trungtrat[0];
                                        $sotientrung    = $trungtrat[1];
                                        $sotrung        = $trungtrat[2];
                                        $stringso       = $trungtrat[3];
                                        $tienxac        = $trungtrat[4];
                                    }
                                    if( empty($sotientrung)) {
                                        $sotientrung = '0(0n)';
                                    }
                                    if($kieu == 'da'){
                                        $countso            = round(count(explode(" ",trim($stringso," "))) / 2);
                                        $chuoi = explode(' ',$stringso);
                                        $demvui = 0;
                                        $stringso = '';
                                        foreach( $chuoi as $value ){
                                            if($demvui == 1){
                                                $demvui = 0;
                                                $stringso .= $value.' ';
                                            }else{
                                                $stringso .= $value.',';
                                                $demvui += 1;
                                            }
                                        }
                                        $stringso = trim($stringso,',');
                                    }else{
                                        $countso            = count(explode(" ",trim($stringso," ")));
                                    }
                                    $child['status']        = 'success';
                                    $child['dai']           = $part;
                                    $child['so']            = trim($stringso," ");
                                    $child['demso']         = $countso;
                                    $child['kieu']          = $kieu;
                                    $child['gia']           = $gia;
                                    $child['thuc']          = $thuc;
                                    $child['diem']          = $sotien;
                                    $child['xac']           = $sotien * $countso * $tienxac;
                                    $child['sotien']        = $sotientrung;
                                    $child['sotrung']       = trim($sotrung,",");
                                    $child['sltrung']       = $sltrung;
                                    $child['diemtrung']     = $sltrung * $sotien;
                                    $child['trangthai']     = $trangthai;
                                    array_push($kqchild, $child);
                                    $child = array();
                                    break;
                                } 
                            }
                        }
                    }else{
                        if( Getvalueofdai($part, $datenow) == 'OK' ){
                            $string = $parts[$index + 1];
                            $string = explode(" ",$string);
                            foreach($string as $key => $value){
                                foreach ($arraykieus as $key2 => $kieu) {
                                    $child = array();
                                    if (strpos($value, $kieu) !== false) {
                                        if($kieu == 'blo' && (strpos($string[$key-1], 'xd') !== false || strpos($string[$key-1], '7dao') !== false || strpos($string[$key-1], '17dao') !== false ) ){
                                            $checkxd = 1;
                                        }
                                        $sotien = str_replace(array($kieu, 'n'), array('', ''),$value);
                                        $stringso = '';
                                        for ($i = $key - 1; $i >= 0; $i--) { 
                                            if ($i > 1){
                                                $i2 = $i - 1;
                                            }else{
                                                $i2 = $i;
                                            }
                                            if ( strpos($string[$i], "n") == false && strpos($string[$i2], "n") !== false){
                                                $stringso .= $string[$i] .' ';
                                                break;
                                            }else if (strpos($string[$i], "n") == false) {
                                                $stringso .= $string[$i] .' ';
                                            }
                                        }
                                        $gettendai  = gettendai($part);
                                        $mbmnmt     = gettylembmnmt($part);
                                        $gia        = getgia($kieu, $mbmnmt, $username);
                                        $thuc       = $PNH->get_row(" SELECT $kieu FROM `tyle` WHERE `dai` = '$mbmnmt' AND `username` = '$username' ")[$kieu];
                                        $trungtrat  = trungtrat($gettendai, trim($stringso," "), $kieu, $datenow, $sotien, $sotien, $checkxd);
                                        $checkxd    = 0;
                                        if( $trungtrat[1] > 0){
                                            $trangthai      = 'Trúng';
                                            $sltrung        = $trungtrat[0];
                                            $sotientrung    = $trungtrat[1];
                                            $sotrung        = $trungtrat[2];
                                            $stringso       = $trungtrat[3];
                                            $tienxac        = $trungtrat[4];
                                        }else{
                                            $trangthai      = 'Trật';
                                            $sltrung        = $trungtrat[0];
                                            $sotientrung    = $trungtrat[1];
                                            $sotrung        = $trungtrat[2];
                                            $stringso       = $trungtrat[3];
                                            $tienxac        = $trungtrat[4];
                                        }
                                        if( empty($sotientrung)) {
                                            $sotientrung = '0(0n)';
                                        }
                                        if($kieu == 'da'){
                                            $countso            = round(count(explode(" ",trim($stringso," "))) / 2);
                                            $chuoi = explode(' ',$stringso);
                                            $demvui = 0;
                                            $stringso = '';
                                            foreach( $chuoi as $value ){
                                                if($demvui == 1){
                                                    $demvui = 0;
                                                    $stringso .= $value.' ';
                                                }else{
                                                    $stringso .= $value.',';
                                                    $demvui += 1;
                                                }
                                            }
                                            $stringso = trim($stringso,',');
                                        }else{
                                            $countso            = count(explode(" ",trim($stringso," ")));
                                        }
                                        $child['status']        = 'success';
                                        $child['dai']           = $part;
                                        $child['so']            = trim($stringso," ");
                                        $child['demso']         = $countso;
                                        $child['kieu']          = $kieu;
                                        $child['gia']           = $gia;
                                        $child['thuc']          = $thuc;
                                        $child['diem']          = $sotien;
                                        $child['xac']           = $sotien * $countso * $tienxac;
                                        $child['sotien']        = $sotientrung;
                                        $child['sotrung']       = trim($sotrung,",");
                                        $child['sltrung']       = $sltrung;
                                        $child['diemtrung']     = $sltrung * $sotien;
                                        $child['trangthai']     = $trangthai;
                                        array_push($kqchild, $child);
                                        $child = array();
                                        break;
                                    } 
                                }
                            }
                        }else if( $part == 'mb' ){
                            $string = $parts[$index + 1];
                            $string = explode(" ",$string);
                            foreach($string as $key => $value){
                                foreach ($arraykieus as $kieu) {
                                    $child = array();
                                    if (strpos($value, $kieu) !== false) {
                                        if($kieu == '27lo' && strpos($string[$key-1], '23dao') !== false  ){
                                            $checkxd = 1;
                                        }
                                        $sotien = str_replace(array($kieu, 'n'), array('', ''),$value);
                                        $stringso = '';
                                        for ($i = $key - 1; $i >= 0; $i--) { 
                                            if ($i > 1){
                                                $i2 = $i - 1;
                                            }else{
                                                $i2 = $i;
                                            }
                                            if ( strpos($string[$i], "n") == false && strpos($string[$i2], "n") !== false){
                                                $stringso .= $string[$i] .' ';
                                                break;
                                            }else if (strpos($string[$i], "n") == false) {
                                                $stringso .= $string[$i] .' ';
                                            }
                                        }
                                        $gettendai  = gettendai($part);
                                        $mbmnmt     = gettylembmnmt($part);
                                        $gia        = getgia($kieu, $mbmnmt, $username);
                                        $thuc       = $PNH->get_row(" SELECT $kieu FROM `tyle` WHERE `dai` = '$mbmnmt' AND `username` = '$username' ")[$kieu];
                                        $trungtrat  = trungtrat($gettendai, trim($stringso," "), $kieu, $datenow, $sotien, $thuc, $checkxd);
                                        $checkxd    = 0;
                                        if( $trungtrat[1] > 0){
                                            $trangthai      = 'Trúng';
                                            $sltrung        = $trungtrat[0];
                                            $sotientrung    = $trungtrat[1];
                                            $sotrung        = $trungtrat[2];
                                            $stringso       = $trungtrat[3];
                                            $tienxac        = $trungtrat[4];
                                        }else{
                                            $trangthai      = 'Trật';
                                            $sltrung        = $trungtrat[0];
                                            $sotientrung    = $trungtrat[1];
                                            $sotrung        = $trungtrat[2];
                                            $stringso       = $trungtrat[3];
                                            $tienxac        = $trungtrat[4];
                                        }
                                        if( empty($sotientrung)) {
                                            $sotientrung = '0(0n)';
                                        }
                                        if($kieu == 'da'){
                                            $countso            = round(count(explode(" ",trim($stringso," "))) / 2);
                                            $chuoi = explode(' ',$stringso);
                                            $demvui = 0;
                                            $stringso = '';
                                            foreach( $chuoi as $value ){
                                                if($demvui == 1){
                                                    $demvui = 0;
                                                    $stringso .= $value.' ';
                                                }else{
                                                    $stringso .= $value.',';
                                                    $demvui += 1;
                                                }
                                            }
                                            $stringso = trim($stringso,',');
                                        }else{
                                            $countso            = count(explode(" ",trim($stringso," ")));
                                        }
                                        $child['status']        = 'success';
                                        $child['dai']           = $part;
                                        $child['so']            = trim($stringso," ");
                                        $child['demso']         = $countso;
                                        $child['kieu']          = $kieu;
                                        $child['gia']           = $gia;
                                        $child['thuc']          = $thuc;
                                        $child['diem']          = $sotien;
                                        $child['xac']           = $sotien * $countso * $tienxac;
                                        $child['sotien']        = $sotientrung;
                                        $child['sotrung']       = trim($sotrung,",");
                                        $child['sltrung']       = $sltrung;
                                        $child['diemtrung']     = $sltrung * $sotien;
                                        $child['trangthai']     = $trangthai;
                                        array_push($kqchild, $child);
                                        $child = array();
                                        break;
                                    } 
                                }
                            }
                        }else{
                            $string = $parts[$index + 1];
                            $string = explode(" ",$string);
                            foreach($string as $key => $value){
                                foreach ($arraykieus as $key2 => $kieu) {
                                    $child = array();
                                    if (strpos($value, $kieu) !== false) {
                                        if( ($kieu == 'blo' && (strpos($string[$key-1], 'xd') !== false || strpos($string[$key-1], '7dao') !== false || strpos($string[$key-1], '17dao') !== false ))  || ($kieu == '27lo' && strpos($string[$key-1], '23dao') !== false) ){
                                            $checkxd = 1;
                                        }
                                        $sotien = str_replace(array($kieu, 'n'), array('', ''),$value);
                                        $stringso = '';
                                        for ($i = $key - 1; $i >= 0; $i--) { 
                                            if ($i > 1){
                                                $i2 = $i - 1;
                                            }else{
                                                $i2 = $i;
                                            }
                                            if ( strpos($string[$i], "n") == false && strpos($string[$i2], "n") !== false){
                                                $stringso .= $string[$i] .' ';
                                                break;
                                            }else if (strpos($string[$i], "n") == false) {
                                                $stringso .= $string[$i] .' ';
                                            }
                                        }
                                        $gettendai  = gettendai($part);
                                        $mbmnmt     = gettylembmnmt($part);
                                        $gia        = getgia($kieu, $mbmnmt, $username);
                                        $thuc       = $PNH->get_row(" SELECT $kieu FROM `tyle` WHERE `dai` = '$mbmnmt' AND `username` = '$username' ")[$kieu];
                                        $trungtrat  = trungtrat($gettendai, trim($stringso," "), $kieu, $datenow, $sotien, $sotien, $checkxd);
                                        $checkxd    = 0;
                                        if( $trungtrat[1] > 0){
                                            $trangthai      = 'Trúng';
                                            $sltrung        = $trungtrat[0];
                                            $sotientrung    = $trungtrat[1];
                                            $sotrung        = $trungtrat[2];
                                            $stringso       = $trungtrat[3];
                                            $tienxac        = $trungtrat[4];
                                        }else{
                                            $trangthai      = 'Trật';
                                            $sltrung        = $trungtrat[0];
                                            $sotientrung    = $trungtrat[1];
                                            $sotrung        = $trungtrat[2];
                                            $stringso       = $trungtrat[3];
                                            $tienxac        = $trungtrat[4];
                                        }
                                        if ( $stringso == null ){
                                            for ($i = $key - 1; $i >= 0; $i--) { 
                                                if ($i > 1){
                                                    $i2 = $i - 1;
                                                }else{
                                                    $i2 = $i;
                                                }
                                                if ( strpos($string[$i], "n") == false && strpos($string[$i2], "n") !== false){
                                                    $stringso .= $string[$i] .' ';
                                                    break;
                                                }else if (strpos($string[$i], "n") == false) {
                                                    $stringso .= $string[$i] .' ';
                                                }
                                            }
                                        }
                                        if( empty($sotientrung)) {
                                            $sotientrung = '0(0n)';
                                        }
                                        if($kieu == 'da'){
                                            $countso            = round(count(explode(" ",trim($stringso," "))) / 2);
                                            $chuoi = explode(' ',$stringso);
                                            $demvui = 0;
                                            $stringso = '';
                                            foreach( $chuoi as $value ){
                                                if($demvui == 1){
                                                    $demvui = 0;
                                                    $stringso .= $value.' ';
                                                }else{
                                                    $stringso .= $value.',';
                                                    $demvui += 1;
                                                }
                                            }
                                            $stringso = trim($stringso,',');
                                        }else{
                                            $countso            = count(explode(" ",trim($stringso," ")));
                                        }
                                        $child['status']        = 'error';
                                        $child['dai']           = $part;
                                        $child['so']            = trim($stringso," ");
                                        $child['demso']         = $countso;
                                        $child['kieu']          = $kieu;
                                        $child['gia']           = $gia;
                                        $child['thuc']          = $thuc;
                                        $child['diem']          = $sotien;
                                        $child['xac']           = $sotien * $countso * $tienxac;
                                        $child['sotien']        = $sotientrung;
                                        $child['sotrung']       = trim($sotrung,",");
                                        $child['sltrung']       = $sltrung;
                                        $child['diemtrung']     = $sltrung * $sotien;
                                        $child['trangthai']     = $trangthai;
                                        array_push($kqchild, $child);
                                        $child = array();
                                        break;
                                    } 
                                }
                            }
                            // $child['status'] = 'error';
                        }
                    }
                }
            }
        }else{
            $child['status'] = 'error';
        }        
        // echo '<pre>';
        // print_r($kqchild);
        // echo '</pre>';
        $filltabletrungthuc         = filltabletrungthuc($kqchild);
        $result['data']             = $filltabletrungthuc[0];
        $result['haic']             = $filltabletrungthuc[1];
        $result['bac']              = $filltabletrungthuc[2];
        $result['xc']               = $filltabletrungthuc[3];
        $result['dd']               = $filltabletrungthuc[4];
        $result['da']               = $filltabletrungthuc[5];
        $result['totaltrung']       = $filltabletrungthuc[6];
        $result['totalxac']         = $filltabletrungthuc[7];
        $result['totalthuc']        = $filltabletrungthuc[8];
        $result['anthua']           = $result['totalthuc'] - $result['totaltrung'];
        $result['content']          = $kqchild;
        foreach ($result['data'] as $value){
            if ($value['kieu'] =='2c'){
                $xachaic = $value['stringxac'];
                $thuchaic = $xachaic * $value['stringthuc'];
            }elseif ($value['kieu'] =='3c'){
                $xacbac = $value['stringxac'];
                $thucbac = $xacbac * $value['stringthuc'];
            }elseif ($value['kieu'] =='dd'){
                $xacdd = $value['stringxac'];
                $thucdd = $xacdd * $value['stringthuc'];
            }elseif ($value['kieu'] =='xc'){
                $xacxc = $value['stringxac'];
                $thucxc = $xacxc * $value['stringthuc'];
            }elseif ($value['kieu'] =='da'){
                $xacda = $value['stringxac'];
                $thucda = $xacda * $value['stringthuc'];
            }
        }
        $PNH->insert("saved", array(
            'username'          => $username,
            'so'                => $content,
            'haic'              => $result['haic'],
            'bac'               => $result['bac'],
            'xc'                => $result['xc'],
            'dd'                => $result['dd'],
            'da'                => $result['da'],
            'trung'             => $result['totaltrung'],
            'xachaic'           => $xachaic,
            'thuchaic'          => $thuchaic,
            'xacbac'            => $xacbac,
            'thucbac'           => $thucbac,
            'xacdd'             => $xacdd,
            'thucdd'            => $thucdd,
            'xacxc'             => $xacxc,
            'thucxc'            => $thucxc,
            'xacda'             => $xacda,
            'thucda'            => $thucda,
            'totalxac'          => $result['totalxac'],
            'totalthuc'         => $result['totalthuc'],
            'totalanthua'       => $result['anthua'],
            'ngaydanh'          => $datenow,
            'createdate'        => gettime(),
        ));
        if (!empty($username2)){
            $PNH->insert("saved", array(
                'username'          => $username2,
                'so'                => $content,
                'haic'              => $result['haic'],
                'bac'               => $result['bac'],
                'xc'                => $result['xc'],
                'dd'                => $result['dd'],
                'da'                => $result['da'],
                'trung'             => $result['totaltrung'],
                'xachaic'           => $xachaic,
                'thuchaic'          => $thuchaic,
                'xacbac'            => $xacbac,
                'thucbac'           => $thucbac,
                'xacdd'             => $xacdd,
                'thucdd'            => $thucdd,
                'xacxc'             => $xacxc,
                'thucxc'            => $thucxc,
                'xacda'             => $xacda,
                'thucda'            => $thucda,
                'totalxac'          => $result['totalxac'],
                'totalthuc'         => $result['totalthuc'],
                'totalanthua'       => $result['anthua'],
                'ngaydanh'          => $datenow,
                'createdate'        => gettime(),
            ));
        }
        die (json_encode($result));
    }
