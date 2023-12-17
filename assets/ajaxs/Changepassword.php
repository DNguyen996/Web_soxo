<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    
    if($_POST['type'] == 'Changepassword')
    {
      	$result     = array();
        $oldpwd     = TypePassword(check_string($_POST['password']));
        $pwd        = check_string($_POST['newpassword']);
        $repwd      = check_string($_POST['renewpassword']);
        if(empty($_SESSION['username']))
        {
            $result = array(
                'status' => 0,
                'title' => 'Cảnh báo',
                'content' => 'Vui lòng đăng nhập',
                'url'   => BASE_URL('Login'),
            );
            die (json_encode($result));
        }
        if(empty($oldpwd) || empty($pwd) || empty($repwd))
        {
            $result = array(
                'status' => 0,
                'title' => 'Cảnh báo',
                'content' => 'Vui lòng nhập mật khẩu',
                'url'   => BASE_URL(''),
            );
            die (json_encode($result));;
        }
        if($pwd != $repwd)
        {
            $result = array(
                'status' => 0,
                'title' => 'Cảnh báo',
                'content' => 'Mật khẩu không trùng nhau',
                'url'   => BASE_URL(''),
            );
            die (json_encode($result));
        }
        if(strlen($pwd) < 5)
        {
            $result = array(
                'status' => 0,
                'title' => 'Cảnh báo',
                'content' => 'Mật khẩu quá ngắn',
                'url'   => BASE_URL(''),
            );
          die (json_encode($result));
        }
        if(!$PNH->get_row(" SELECT * FROM `users` WHERE `password` = '$oldpwd' AND `username` = '".$_SESSION['username']."'  "))
        {
           $result = array(
                'status' => 0,
                'title' => 'Cảnh báo',
                'content' => 'Mật khẩu không đúng',
                'url'   => BASE_URL(''),
            );
          die (json_encode($result));
        }
        $PNH->update("users", [
            'password' => TypePassword($pwd)
        ], " `username` = '".$_SESSION['username']."' ");
        $result = array(
            'status' => 1,
            'title' => 'Thành công',
            'content' => 'Cập nhật mật khẩu thành công',
            'url'   => BASE_URL(''),
        );
        die (json_encode($result));
    }