<?php 
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    require_once('../../class/class.smtp.php');
    require_once('../../class/PHPMailerAutoload.php');
    require_once('../../class/class.phpmailer.php');
    require_once('../../class/Mobile_Detect.php');

    if($_POST['type'] == 'Login' )
    {
        $login = check_string($_POST['login']);
        $password = TypePassword(check_string($_POST['password']));
        if(empty($login))
        {
            msg_error2(lang(10));
        }
        if(empty($password))
        {
            msg_error2(lang(11));
        }
        if($PNH->get_row(" SELECT * FROM `users` WHERE `username` = '$login' AND `banned` = '1' "))
        {
            msg_error2(lang(14));
        }
        if(!$PNH->get_row(" SELECT * FROM `users` WHERE `username` = '$login' AND `password` = '$password' "))
        {
            msg_error2(lang(13));
        }
        if($PNH->get_row(" SELECT * FROM `users` WHERE `username` = '$login' ")){
            $Mobile_Detect = new Mobile_Detect;
            $PNH->update("users", [
                'otp'       => NULL,
                'ip'        => myip(),
                'UserAgent' => $Mobile_Detect->getUserAgent()
            ], " `username` = '$login' ");
            $PNH->insert("logs", [
                'username'  => $login,
                'content'   => 'Thực hiện đăng nhập ('.$Mobile_Detect->getUserAgent().' IP '.myip().')',
                'createdate'=> gettime(),
                'time'      => time()
            ]);
            $row = $PNH->get_row(" SELECT * FROM `users` WHERE `username` = '$login' ");
            $_SESSION['username'] = $row['username'];
        }
        msg_success('Đăng nhập thành công ', BASE_URL(''), 0);
    }

	if($_POST['type'] == 'Saveper' )
    {
        if(empty($_SESSION['username']))
        {
            msg_error("Vui lòng đăng nhập ", BASE_URL(''), 2000);
        }
        foreach($_POST['qtv'] as $value){
          $qtv .= $value.',';
        }
      	$qtv = trim($qtv,",");
        foreach($_POST['TBPnd'] as $value){
          $TBPnd .= $value.',';
        }
      	$TBPnd = trim($TBPnd,",");
        foreach($_POST['TBPkd'] as $value){
          $TBPkd .= $value.',';
        }
      	$TBPkd = trim($TBPkd,",");
        foreach($_POST['btvnd'] as $value){
          $btvnd .= $value.',';
        }
      	$btvnd = trim($btvnd,",");
        foreach($_POST['nvkd'] as $value){
          $nvkd .= $value.',';
        }
      	$nvkd = trim($nvkd,",");
        foreach($_POST['cskh'] as $value){
          $cskh .= $value.',';
        }
      	$cskh = trim($cskh,",");
        foreach($_POST['hoso'] as $value){
          $hoso .= $value.',';
        }
      	$hoso = trim($hoso,",");      
       foreach($PNH->get_list(" SELECT * FROM `users` WHERE `level` != 'member' ") as $row){
			    $id = $row['id'];
         	if($row['level'] == 'Quản trị viên'){
              $PNH->update("users", [
                  'permi'       => $qtv,
              ], " `id` = '$id' ");
            }else if($row['level'] == 'TBP Nội dung'){
            $PNH->update("users", [
                  'permi'       => $TBPnd,
              ], " `id` = '$id' ");
            }else if($row['level'] == 'TBP Kinh doanh'){
            $PNH->update("users", [
                  'permi'       => $TBPkd,
              ], " `id` = '$id' ");
            }else if($row['level'] == 'Biên tập viên Nội dung'){
            $PNH->update("users", [
                  'permi'       => $btvnd,
              ], " `id` = '$id' ");
            }else if($row['level'] == 'Nhân viên Kinh doanh'){
            $PNH->update("users", [
                  'permi'       => $nvkd,
              ], " `id` = '$id' ");
            }else if($row['level'] == 'Chăm Sóc Khách Hàng'){
            $PNH->update("users", [
                  'permi'       => $cskh,
              ], " `id` = '$id' ");
            }else if($row['level'] == 'Hồ Sơ'){
            $PNH->update("users", [
                  'permi'       => $hoso,
              ], " `id` = '$id' ");
            }            
        }
        msg_success('Lưu thành công ', BASE_URL('Admin/Cskh/Permission'),500);
    }










