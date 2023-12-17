<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    
    if($_POST['type'] == 'Timedelete')
    {
      	$result         = array();
        $timedelete     = check_string($_POST['timedelete']);
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
        $PNH->update("users", [
            'timedelete' => $timedelete
        ], " `username` = '".$_SESSION['username']."' ");
        $result = array(
            'status' => 1,
            'title' => 'Thành công',
            'content' => 'Cập nhật thời gian xóa thành công',
            'url'   => BASE_URL(''),
        );
        die (json_encode($result));
    }