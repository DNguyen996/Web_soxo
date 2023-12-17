<?php 
    require_once("../../config/config.php");
    require_once("../../config/function.php");

    if($_POST['type'] == 'Saved' )
    {
        $content    = $_POST['content'];
        $inputday   = $_POST['inputday'];
        $datenow    = date('Y-m-d', strtotime($inputday));
        $choosemien = $_POST['choosemien'];
        $content    = strtolower($content);
        $keywords_regex = "/\b(4d|3d|2d|mb|tp|dt|cm|tth|py|bth|bt|vt|bl|dlk|qna|dn|dl|ct|st|kh|tn|ag|bdh|bd|qt|qb|vl|tv|gl|nt|la|bp|hg|qn|dan|tg|kg|kt|dno)\b/";
        $parts              = preg_split($keywords_regex, $content, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
        $arraydaimn         = array('bth','bt','tg','kg','dl','tp','la','bp','hg','vl','bd','tv','tn','ag','dn','ct','st','vt','bl','dt','cm');
        $arraydaimt         = array('kt','kh','tth','dan','qn','dno','gl','nt','bdh','qt','qb','kh','dlk','qna','py');
        $arraydaimb         = array('mb');
        $arraykieus         = array('18lo','blo','bdao','17dao','17lod','17lo','17d','7lod','7lo','7dao','7d','dau','duoi','xdao','xd','dd','ab','xc','da','a','b');
        $arraykieusmb       = array('23dao','23lo','blo','bdao','27lo','23d','dau','duoi','xdao','xd','dd','ab','xc','da','a','b');
        $arraykieusmnmtmb   = array('18lo','blo','bdao','17lod','17lo','17dao','17d','7lod','7lo','7dao','7d','27lo','23lo','23dao','23d','dau','duoi','xdao','xd','dd','ab','xc','da','a','b');
        $result         = array();
        $kqchild        = array();
        $error          = 0;
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
        if( !empty($_POST['usernamekh']) ){
            $username = $_POST['usernamekh'];
        }
        if( !empty($_POST['usernamekh2']) ){
            $username2 = $_POST['usernamekh2'];
        }
        $type       = $PNH->get_row(" SELECT * FROM `type` WHERE username = '$username' ");
        if ( $parts ){
            foreach ($parts as $index => $part) {
                if ((in_array($part, $arraydaimn) && $choosemien == 'MN') || (($part == '2d' || $part == '3d' || $part == '4d') && $choosemien == 'MN')) {
                    $dai = 'MN';
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
                                            if( ($kieu == 'blo' || $kieu == '18lo') && (strpos($string[$key-1], 'xd') !== false 
                                                || strpos($string[$key-1], 'xdao') !== false 
                                                || strpos($string[$key-1], '7dao') !== false 
                                                || strpos($string[$key-1], '7lod') !== false 
                                                || strpos($string[$key-1], '17dao') !== false 
                                                || strpos($string[$key-1], '17lod') !== false 
                                                || strpos($string[$key-1], '17d') !== false) ){
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
                                            if( (($kieu == 'blo' || $kieu == '18lo') && 
                                                ( strpos($string[$key-1], 'xdao') !== false 
                                                || strpos($string[$key-1], 'xd') !== false 
                                                || strpos($string[$key-1], '7dao') !== false 
                                                || strpos($string[$key-1], '7lod') !== false 
                                                || strpos($string[$key-1], '7d') !== false 
                                                || strpos($string[$key-1], '17dao') !== false 
                                                || strpos($string[$key-1], '17lod') !== false 
                                                || strpos($string[$key-1], '17d') !== false))  
                                                || (($kieu == '27lo' || $kieu == 'blo') && (strpos($string[$key-1], '23dao') !== false 
                                                || strpos($string[$key-1], '23d') !== false 
                                                || strpos($string[$key-1], 'xdao') !== false 
                                                || strpos($string[$key-1], 'xd') !== false )) ){
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
                                            $error                  = 1;
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
                        if( Getvalueofdai($part, $datenow) == 'OK' ){
                            $string = $parts[$index + 1];
                            $string = explode(" ",$string);
                            foreach($string as $key => $value){
                                foreach ($arraykieus as $key2 => $kieu) {
                                    $child = array();
                                    if (strpos($value, $kieu) !== false) {
                                        if( (($kieu == 'blo' || $kieu == '18lo') && 
                                                ( strpos($string[$key-1], 'xdao') !== false 
                                                || strpos($string[$key-1], 'xd') !== false 
                                                || strpos($string[$key-1], '7dao') !== false 
                                                || strpos($string[$key-1], '7lod') !== false 
                                                || strpos($string[$key-1], '7d') !== false 
                                                || strpos($string[$key-1], '17dao') !== false 
                                                || strpos($string[$key-1], '17lod') !== false 
                                                || strpos($string[$key-1], '17d') !== false))  
                                                || (($kieu == '27lo' || $kieu == 'blo') && (strpos($string[$key-1], '23dao') !== false 
                                                || strpos($string[$key-1], '23d') !== false 
                                                || strpos($string[$key-1], 'xdao') !== false 
                                                || strpos($string[$key-1], 'xd') !== false )) ){
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
                        }else{
                            $string = $parts[$index + 1];
                            $string = explode(" ",$string);
                            foreach($string as $key => $value){
                                foreach ($arraykieus as $key2 => $kieu) {
                                    $child = array();
                                    if (strpos($value, $kieu) !== false) {
                                        if( (($kieu == 'blo' || $kieu == '18lo') && 
                                                ( strpos($string[$key-1], 'xdao') !== false 
                                                || strpos($string[$key-1], 'xd') !== false 
                                                || strpos($string[$key-1], '7dao') !== false 
                                                || strpos($string[$key-1], '7lod') !== false 
                                                || strpos($string[$key-1], '7d') !== false 
                                                || strpos($string[$key-1], '17dao') !== false 
                                                || strpos($string[$key-1], '17lod') !== false 
                                                || strpos($string[$key-1], '17d') !== false))  
                                                || (($kieu == '27lo' || $kieu == 'blo') && (strpos($string[$key-1], '23dao') !== false 
                                                || strpos($string[$key-1], '23d') !== false 
                                                || strpos($string[$key-1], 'xdao') !== false 
                                                || strpos($string[$key-1], 'xd') !== false )) ){
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
                                        $error                  = 1;
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
                }else if ((in_array($part, $arraydaimt) && $choosemien == 'MT') || (($part == '2d' || $part == '3d' || $part == '4d') && $choosemien == 'MT')) {
                    $dai = 'MT';
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
                                            if( ($kieu == 'blo' || $kieu == '18lo') && (strpos($string[$key-1], 'xd') !== false 
                                                || strpos($string[$key-1], 'xdao') !== false 
                                                || strpos($string[$key-1], '7dao') !== false 
                                                || strpos($string[$key-1], '7lod') !== false 
                                                || strpos($string[$key-1], '7d') !== false 
                                                || strpos($string[$key-1], '17dao') !== false 
                                                || strpos($string[$key-1], '17lod') !== false 
                                                || strpos($string[$key-1], '17d') !== false) ){
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
                                            if( (($kieu == 'blo' || $kieu == '18lo') && 
                                                ( strpos($string[$key-1], 'xdao') !== false 
                                                || strpos($string[$key-1], 'xd') !== false 
                                                || strpos($string[$key-1], '7dao') !== false 
                                                || strpos($string[$key-1], '7lod') !== false
                                                || strpos($string[$key-1], '7d') !== false 
                                                || strpos($string[$key-1], '17dao') !== false 
                                                || strpos($string[$key-1], '17lod') !== false 
                                                || strpos($string[$key-1], '17d') !== false))  
                                                || (($kieu == '27lo' || $kieu == 'blo') && (strpos($string[$key-1], '23dao') !== false 
                                                || strpos($string[$key-1], '23d') !== false 
                                                || strpos($string[$key-1], 'xdao') !== false 
                                                || strpos($string[$key-1], 'xd') !== false )) ){
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
                                            $error                  = 1;
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
                        if( Getvalueofdai($part, $datenow) == 'OK' ){
                            $string = $parts[$index + 1];
                            $string = explode(" ",$string);
                            foreach($string as $key => $value){
                                foreach ($arraykieus as $key2 => $kieu) {
                                    $child = array();
                                    if (strpos($value, $kieu) !== false) {
                                        if( (($kieu == 'blo' || $kieu == '18lo') && 
                                                ( strpos($string[$key-1], 'xdao') !== false 
                                                || strpos($string[$key-1], 'xd') !== false 
                                                || strpos($string[$key-1], '7dao') !== false 
                                                || strpos($string[$key-1], '7lod') !== false 
                                                || strpos($string[$key-1], '7d') !== false 
                                                || strpos($string[$key-1], '17dao') !== false 
                                                || strpos($string[$key-1], '17lod') !== false 
                                                || strpos($string[$key-1], '17d') !== false))  
                                                || (($kieu == '27lo' || $kieu == 'blo') && (strpos($string[$key-1], '23dao') !== false 
                                                || strpos($string[$key-1], '23d') !== false 
                                                || strpos($string[$key-1], 'xdao') !== false 
                                                || strpos($string[$key-1], 'xd') !== false )) ){
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
                        }else{
                            $string = $parts[$index + 1];
                            $string = explode(" ",$string);
                            foreach($string as $key => $value){
                                foreach ($arraykieus as $key2 => $kieu) {
                                    $child = array();
                                    if (strpos($value, $kieu) !== false) {
                                        if( (($kieu == 'blo' || $kieu == '18lo') && 
                                                ( strpos($string[$key-1], 'xdao') !== false 
                                                || strpos($string[$key-1], 'xd') !== false 
                                                || strpos($string[$key-1], '7dao') !== false 
                                                || strpos($string[$key-1], '7lod') !== false 
                                                || strpos($string[$key-1], '7d') !== false 
                                                || strpos($string[$key-1], '17dao') !== false 
                                                || strpos($string[$key-1], '17lod') !== false 
                                                || strpos($string[$key-1], '17d') !== false))  
                                                || (($kieu == '27lo' || $kieu == 'blo') && (strpos($string[$key-1], '23dao') !== false 
                                                || strpos($string[$key-1], '23d') !== false 
                                                || strpos($string[$key-1], 'xdao') !== false 
                                                || strpos($string[$key-1], 'xd') !== false )) ){
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
                                        $error                  = 1;
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
                }else if(in_array($part, $arraydaimb) && $choosemien == 'MB'){
                    $dai = 'MB';
                    if( $part == '2d' || $part == '3d' || $part == '4d' ){
                        $error           = 1;
                        $child['status'] = 'error';
                    }else{
                        $string = $parts[$index + 1];
                        $string = explode(" ",$string);
                        foreach($string as $key => $value){
                            foreach ($arraykieusmb as $kieu) {
                                $child = array();
                                if (strpos($value, $kieu) !== false) {
                                    if(($kieu == '27lo' || $kieu == 'blo') && (strpos($string[$key-1], '23dao') !== false 
                                                || strpos($string[$key-1], '23d') !== false 
                                                || strpos($string[$key-1], 'xdao') !== false 
                                                || strpos($string[$key-1], 'xd') !== false ) ){
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
                                    if($kieu == 'blo'){
                                        $giakieu = '27lo';
                                    }else{
                                        $giakieu = $kieu;
                                    }
                                    $gia        = getgia($giakieu, $mbmnmt, $username);
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
                    }
                }else if($choosemien == 'MB' && ($part == '2d' || $part == '3d' || $part == '4d')){
                    $error           = 1;
                    $child['status'] = 'error';
                }
                else{
                    if( in_array($part, $arraydaimn) || in_array($part, $arraydaimt) || in_array($part, $arraydaimb)){
                        $string = $parts[$index + 1];
                        $string = explode(" ",$string);
                        foreach($string as $key => $value){
                            foreach ($arraykieusmnmtmb as $key2 => $kieu) {
                                $child = array();
                                if (strpos($value, $kieu) !== false) {
                                    if( (($kieu == 'blo' || $kieu == '18lo') && 
                                                ( strpos($string[$key-1], 'xdao') !== false 
                                                || strpos($string[$key-1], 'xd') !== false 
                                                || strpos($string[$key-1], '7dao') !== false 
                                                || strpos($string[$key-1], '7lod') !== false 
                                                || strpos($string[$key-1], '7d') !== false 
                                                || strpos($string[$key-1], '17dao') !== false 
                                                || strpos($string[$key-1], '17lod') !== false 
                                                || strpos($string[$key-1], '17d') !== false))  
                                                || (($kieu == '27lo' || $kieu == 'blo') && (strpos($string[$key-1], '23dao') !== false 
                                                || strpos($string[$key-1], '23d') !== false 
                                                || strpos($string[$key-1], 'xdao') !== false 
                                                || strpos($string[$key-1], 'xd') !== false )) ){
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
                                    $error                  = 1;
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
            $error           = 1;
            $child['status'] = 'error';
        }        
        // echo '<pre>';
        // print_r($error);
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
        if($result['totaltrung'] > 0){$trangthai = 'Trúng';}else{$trangthai = 'Trật';}
        $xachaic = $thuchaic = $xacbac = $thucbac = $xacdd = $thucdd = $xacxc = $thucxc = $xacda = $thucda = 0;
        foreach ($result['data'] as $value){
            if ($value['kieu'] =='2c'){
                $xachaic    = $value['stringxac'];
                $thuchaic   = $value['stringthuc'];
            }elseif ($value['kieu'] =='3c'){
                $xacbac     = $value['stringxac'];
                $thucbac    = $value['stringthuc'];
            }elseif ($value['kieu'] =='dd'){
                $xacdd      = $value['stringxac'];
                $thucdd     = $value['stringthuc'];
            }elseif ($value['kieu'] =='xc'){
                $xacxc      = $value['stringxac'];
                $thucxc     = $value['stringthuc'];
            }elseif ($value['kieu'] =='da'){
                $xacda      = $value['stringxac'];
                $thucda     = $value['stringthuc'];
            }
        }
        if($error == 1){
            $result['status']       = 1;
        }else{
            $create = $PNH->insert("saved", array(
                'username'          => $username,
                'dai'               => $dai,
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
                'trangthai'         => $trangthai,
                'ngaydanh'          => $datenow,
                'createdate'        => gettime(),
            ));
            if (!empty($username2)){
                $kqchild = array();
                $type       = $PNH->get_row(" SELECT * FROM `type` WHERE username = '$username2' ");
                if ( $parts ){
                    foreach ($parts as $index => $part) {
                        if ((in_array($part, $arraydaimn) && $choosemien == 'MN') || (($part == '2d' || $part == '3d' || $part == '4d') && $choosemien == 'MN')) {
                            $dai = 'MN';
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
                                                    if( ($kieu == 'blo' || $kieu == '18lo') && (strpos($string[$key-1], 'xd') !== false 
                                                        || strpos($string[$key-1], 'xdao') !== false 
                                                        || strpos($string[$key-1], '7dao') !== false 
                                                        || strpos($string[$key-1], '7lod') !== false 
                                                        || strpos($string[$key-1], '17dao') !== false 
                                                        || strpos($string[$key-1], '17lod') !== false 
                                                        || strpos($string[$key-1], '17d') !== false) ){
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
                                                    $thuc       = $PNH->get_row(" SELECT $kieu FROM `tyle` WHERE `dai` = '$mbmnmt' AND `username` = '$username2' ")[$kieu];
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
                                                    if( (($kieu == 'blo' || $kieu == '18lo') && 
                                                        ( strpos($string[$key-1], 'xdao') !== false 
                                                        || strpos($string[$key-1], 'xd') !== false 
                                                        || strpos($string[$key-1], '7dao') !== false 
                                                        || strpos($string[$key-1], '7lod') !== false 
                                                        || strpos($string[$key-1], '7d') !== false 
                                                        || strpos($string[$key-1], '17dao') !== false 
                                                        || strpos($string[$key-1], '17lod') !== false 
                                                        || strpos($string[$key-1], '17d') !== false))  
                                                        || (($kieu == '27lo' || $kieu == 'blo') && (strpos($string[$key-1], '23dao') !== false 
                                                        || strpos($string[$key-1], '23d') !== false 
                                                        || strpos($string[$key-1], 'xdao') !== false 
                                                        || strpos($string[$key-1], 'xd') !== false )) ){
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
                                                    $gia        = getgia($kieu, $mbmnmt, $username2);
                                                    $thuc       = $PNH->get_row(" SELECT $kieu FROM `tyle` WHERE `dai` = '$mbmnmt' AND `username` = '$username2' ")[$kieu];
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
                                                    $error                  = 1;
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
                                if( Getvalueofdai($part, $datenow) == 'OK' ){
                                    $string = $parts[$index + 1];
                                    $string = explode(" ",$string);
                                    foreach($string as $key => $value){
                                        foreach ($arraykieus as $key2 => $kieu) {
                                            $child = array();
                                            if (strpos($value, $kieu) !== false) {
                                                if( (($kieu == 'blo' || $kieu == '18lo') && 
                                                        ( strpos($string[$key-1], 'xdao') !== false 
                                                        || strpos($string[$key-1], 'xd') !== false 
                                                        || strpos($string[$key-1], '7dao') !== false 
                                                        || strpos($string[$key-1], '7lod') !== false 
                                                        || strpos($string[$key-1], '7d') !== false 
                                                        || strpos($string[$key-1], '17dao') !== false 
                                                        || strpos($string[$key-1], '17lod') !== false 
                                                        || strpos($string[$key-1], '17d') !== false))  
                                                        || (($kieu == '27lo' || $kieu == 'blo') && (strpos($string[$key-1], '23dao') !== false 
                                                        || strpos($string[$key-1], '23d') !== false 
                                                        || strpos($string[$key-1], 'xdao') !== false 
                                                        || strpos($string[$key-1], 'xd') !== false )) ){
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
                                                $gia        = getgia($kieu, $mbmnmt, $username2);
                                                $thuc       = $PNH->get_row(" SELECT $kieu FROM `tyle` WHERE `dai` = '$mbmnmt' AND `username` = '$username2' ")[$kieu];
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
                                }else{
                                    $string = $parts[$index + 1];
                                    $string = explode(" ",$string);
                                    foreach($string as $key => $value){
                                        foreach ($arraykieus as $key2 => $kieu) {
                                            $child = array();
                                            if (strpos($value, $kieu) !== false) {
                                                if( (($kieu == 'blo' || $kieu == '18lo') && 
                                                        ( strpos($string[$key-1], 'xdao') !== false 
                                                        || strpos($string[$key-1], 'xd') !== false 
                                                        || strpos($string[$key-1], '7dao') !== false 
                                                        || strpos($string[$key-1], '7lod') !== false 
                                                        || strpos($string[$key-1], '7d') !== false 
                                                        || strpos($string[$key-1], '17dao') !== false 
                                                        || strpos($string[$key-1], '17lod') !== false 
                                                        || strpos($string[$key-1], '17d') !== false))  
                                                        || (($kieu == '27lo' || $kieu == 'blo') && (strpos($string[$key-1], '23dao') !== false 
                                                        || strpos($string[$key-1], '23d') !== false 
                                                        || strpos($string[$key-1], 'xdao') !== false 
                                                        || strpos($string[$key-1], 'xd') !== false )) ){
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
                                                $gia        = getgia($kieu, $mbmnmt, $username2);
                                                $thuc       = $PNH->get_row(" SELECT $kieu FROM `tyle` WHERE `dai` = '$mbmnmt' AND `username` = '$username2' ")[$kieu];
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
                                                $error                  = 1;
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
                        }else if ((in_array($part, $arraydaimt) && $choosemien == 'MT') || (($part == '2d' || $part == '3d' || $part == '4d') && $choosemien == 'MT')) {
                            $dai = 'MT';
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
                                                    if( ($kieu == 'blo' || $kieu == '18lo') && (strpos($string[$key-1], 'xd') !== false 
                                                        || strpos($string[$key-1], 'xdao') !== false 
                                                        || strpos($string[$key-1], '7dao') !== false 
                                                        || strpos($string[$key-1], '7lod') !== false 
                                                        || strpos($string[$key-1], '7d') !== false 
                                                        || strpos($string[$key-1], '17dao') !== false 
                                                        || strpos($string[$key-1], '17lod') !== false 
                                                        || strpos($string[$key-1], '17d') !== false) ){
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
                                                    $gia        = getgia($kieu, $mbmnmt, $username2);
                                                    $thuc       = $PNH->get_row(" SELECT $kieu FROM `tyle` WHERE `dai` = '$mbmnmt' AND `username` = '$username2' ")[$kieu];
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
                                                    if( (($kieu == 'blo' || $kieu == '18lo') && 
                                                        ( strpos($string[$key-1], 'xdao') !== false 
                                                        || strpos($string[$key-1], 'xd') !== false 
                                                        || strpos($string[$key-1], '7dao') !== false 
                                                        || strpos($string[$key-1], '7lod') !== false
                                                        || strpos($string[$key-1], '7d') !== false 
                                                        || strpos($string[$key-1], '17dao') !== false 
                                                        || strpos($string[$key-1], '17lod') !== false 
                                                        || strpos($string[$key-1], '17d') !== false))  
                                                        || (($kieu == '27lo' || $kieu == 'blo') && (strpos($string[$key-1], '23dao') !== false 
                                                        || strpos($string[$key-1], '23d') !== false 
                                                        || strpos($string[$key-1], 'xdao') !== false 
                                                        || strpos($string[$key-1], 'xd') !== false )) ){
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
                                                    $gia        = getgia($kieu, $mbmnmt, $username2);
                                                    $thuc       = $PNH->get_row(" SELECT $kieu FROM `tyle` WHERE `dai` = '$mbmnmt' AND `username` = '$username2' ")[$kieu];
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
                                                    $error                  = 1;
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
                                if( Getvalueofdai($part, $datenow) == 'OK' ){
                                    $string = $parts[$index + 1];
                                    $string = explode(" ",$string);
                                    foreach($string as $key => $value){
                                        foreach ($arraykieus as $key2 => $kieu) {
                                            $child = array();
                                            if (strpos($value, $kieu) !== false) {
                                                if( (($kieu == 'blo' || $kieu == '18lo') && 
                                                        ( strpos($string[$key-1], 'xdao') !== false 
                                                        || strpos($string[$key-1], 'xd') !== false 
                                                        || strpos($string[$key-1], '7dao') !== false 
                                                        || strpos($string[$key-1], '7lod') !== false 
                                                        || strpos($string[$key-1], '7d') !== false 
                                                        || strpos($string[$key-1], '17dao') !== false 
                                                        || strpos($string[$key-1], '17lod') !== false 
                                                        || strpos($string[$key-1], '17d') !== false))  
                                                        || (($kieu == '27lo' || $kieu == 'blo') && (strpos($string[$key-1], '23dao') !== false 
                                                        || strpos($string[$key-1], '23d') !== false 
                                                        || strpos($string[$key-1], 'xdao') !== false 
                                                        || strpos($string[$key-1], 'xd') !== false )) ){
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
                                                $gia        = getgia($kieu, $mbmnmt, $username2);
                                                $thuc       = $PNH->get_row(" SELECT $kieu FROM `tyle` WHERE `dai` = '$mbmnmt' AND `username` = '$username2' ")[$kieu];
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
                                }else{
                                    $string = $parts[$index + 1];
                                    $string = explode(" ",$string);
                                    foreach($string as $key => $value){
                                        foreach ($arraykieus as $key2 => $kieu) {
                                            $child = array();
                                            if (strpos($value, $kieu) !== false) {
                                                if( (($kieu == 'blo' || $kieu == '18lo') && 
                                                        ( strpos($string[$key-1], 'xdao') !== false 
                                                        || strpos($string[$key-1], 'xd') !== false 
                                                        || strpos($string[$key-1], '7dao') !== false 
                                                        || strpos($string[$key-1], '7lod') !== false 
                                                        || strpos($string[$key-1], '7d') !== false 
                                                        || strpos($string[$key-1], '17dao') !== false 
                                                        || strpos($string[$key-1], '17lod') !== false 
                                                        || strpos($string[$key-1], '17d') !== false))  
                                                        || (($kieu == '27lo' || $kieu == 'blo') && (strpos($string[$key-1], '23dao') !== false 
                                                        || strpos($string[$key-1], '23d') !== false 
                                                        || strpos($string[$key-1], 'xdao') !== false 
                                                        || strpos($string[$key-1], 'xd') !== false )) ){
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
                                                $gia        = getgia($kieu, $mbmnmt, $username2);
                                                $thuc       = $PNH->get_row(" SELECT $kieu FROM `tyle` WHERE `dai` = '$mbmnmt' AND `username` = '$username2' ")[$kieu];
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
                                                $error                  = 1;
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
                        }else if(in_array($part, $arraydaimb) && $choosemien == 'MB'){
                            $dai = 'MB';
                            if( $part == '2d' || $part == '3d' || $part == '4d' ){
                                $error           = 1;
                                $child['status'] = 'error';
                            }else{
                                $string = $parts[$index + 1];
                                $string = explode(" ",$string);
                                foreach($string as $key => $value){
                                    foreach ($arraykieusmb as $kieu) {
                                        $child = array();
                                        if (strpos($value, $kieu) !== false) {
                                            if(($kieu == '27lo' || $kieu == 'blo') && (strpos($string[$key-1], '23dao') !== false 
                                                            || strpos($string[$key-1], '23d') !== false 
                                                            || strpos($string[$key-1], 'xdao') !== false 
                                                            || strpos($string[$key-1], 'xd') !== false ) ){
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
                                            $gia        = getgia($kieu, $mbmnmt, $username2);
                                            $thuc       = $PNH->get_row(" SELECT $kieu FROM `tyle` WHERE `dai` = '$mbmnmt' AND `username` = '$username2' ")[$kieu];
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
                            }
                        }else if($choosemien == 'MB' && ($part == '2d' || $part == '3d' || $part == '4d')){
                            $error           = 1;
                            $child['status'] = 'error';
                        }
                        else{
                            if( in_array($part, $arraydaimn) || in_array($part, $arraydaimt) || in_array($part, $arraydaimb)){
                                $string = $parts[$index + 1];
                                $string = explode(" ",$string);
                                foreach($string as $key => $value){
                                    foreach ($arraykieusmnmtmb as $key2 => $kieu) {
                                        $child = array();
                                        if (strpos($value, $kieu) !== false) {
                                           if( (($kieu == 'blo' || $kieu == '18lo') && 
                                                        ( strpos($string[$key-1], 'xdao') !== false 
                                                        || strpos($string[$key-1], 'xd') !== false 
                                                        || strpos($string[$key-1], '7dao') !== false 
                                                        || strpos($string[$key-1], '7lod') !== false 
                                                        || strpos($string[$key-1], '7d') !== false 
                                                        || strpos($string[$key-1], '17dao') !== false 
                                                        || strpos($string[$key-1], '17lod') !== false 
                                                        || strpos($string[$key-1], '17d') !== false))  
                                                        || (($kieu == '27lo' || $kieu == 'blo') && (strpos($string[$key-1], '23dao') !== false 
                                                        || strpos($string[$key-1], '23d') !== false 
                                                        || strpos($string[$key-1], 'xdao') !== false 
                                                        || strpos($string[$key-1], 'xd') !== false )) ){
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
                                            $gia        = getgia($kieu, $mbmnmt, $username2);
                                            $thuc       = $PNH->get_row(" SELECT $kieu FROM `tyle` WHERE `dai` = '$mbmnmt' AND `username` = '$username2' ")[$kieu];
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
                                            $error                  = 1;
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
                    $error           = 1;
                    $child['status'] = 'error';
                }        
                // echo '<pre>';
                // print_r($error);
                // echo '</pre>';
                $filltabletrungthuc         = filltabletrungthuc($kqchild);
                $result2['data']             = $filltabletrungthuc[0];
                $result2['haic']             = $filltabletrungthuc[1];
                $result2['bac']              = $filltabletrungthuc[2];
                $result2['xc']               = $filltabletrungthuc[3];
                $result2['dd']               = $filltabletrungthuc[4];
                $result2['da']               = $filltabletrungthuc[5];
                $result2['totaltrung']       = $filltabletrungthuc[6];
                $result2['totalxac']         = $filltabletrungthuc[7];
                $result2['totalthuc']        = $filltabletrungthuc[8];
                $result2['anthua']           = $result2['totalthuc'] / 100 - $result2['totaltrung'];
                $result2['content']          = $kqchild;
                if($result2['totaltrung'] > 0){$trangthai = 'Trúng';}else{$trangthai = 'Trật';}
                $xachaic2 = $thuchaic2 = $xacbac2 = $thucbac2 = $xacdd2 = $thucdd2 = $xacxc2 = $thucxc2 = $xacda2 = $thucda2 = 0;
                foreach ($result2['data'] as $value){
                    if ($value['kieu'] =='2c'){
                        $xachaic2    = $value['stringxac'];
                        $thuchaic2   = $value['stringthuc'];
                    }elseif ($value['kieu'] =='3c'){
                        $xacbac2     = $value['stringxac'];
                        $thucbac2    = $value['stringthuc'];
                    }elseif ($value['kieu'] =='dd'){
                        $xacdd2      = $value['stringxac'];
                        $thucdd2     = $value['stringthuc'];
                    }elseif ($value['kieu'] =='xc'){
                        $xacxc2      = $value['stringxac'];
                        $thucxc2     = $value['stringthuc'];
                    }elseif ($value['kieu'] =='da'){
                        $xacda2      = $value['stringxac'];
                        $thucda2     = $value['stringthuc'];
                    }
                }
                $PNH->insert("saved", array(
                    'username'          => $username2,
                    'dai'               => $dai,
                    'so'                => $content,
                    'haic'              => $result2['haic'],
                    'bac'               => $result2['bac'],
                    'xc'                => $result2['xc'],
                    'dd'                => $result2['dd'],
                    'da'                => $result2['da'],
                    'trung'             => $result2['totaltrung'],
                    'xachaic'           => $xachaic2,
                    'thuchaic'          => $thuchaic2,
                    'xacbac'            => $xacbac2,
                    'thucbac'           => $thucbac2,
                    'xacdd'             => $xacdd2,
                    'thucdd'            => $thucdd2,
                    'xacxc'             => $xacxc2,
                    'thucxc'            => $thucxc2,
                    'xacda'             => $xacda2,
                    'thucda'            => $thucda2,
                    'totalxac'          => $result2['totalxac'],
                    'totalthuc'         => $result2['totalthuc'],
                    'totalanthua'       => $result2['anthua'],
                    'trangthai'         => $trangthai,
                    'ngaydanh'          => $datenow,
                    'createdate'        => gettime(),
                ));
            }
            $result['status']       = 0;
        }
        die (json_encode($result));
    }
    
    
    
    
    
    
    
    
    
    