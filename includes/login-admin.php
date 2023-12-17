<?php
/**
 * PATH: includes\login-admin.php
 */


if(isset($_SESSION['username']))
{
    $getUser = $PNH->get_row(" SELECT * FROM `users` WHERE `username` = '".$_SESSION['username']."' AND `level` = 'admin' ");
    if(!$getUser)
    {
        header("location:".BASE_URL('/'));
        exit();
    }
    if($getUser['banned'] != 0)
    {
        echo 'Tài khoản của bạn đã bị khóa bởi quản trị viên !';
        exit();
    }
    if($getUser['money'] < 0)
    {
        $PNH->update("users", array(
            'banned' => 1
        ), "username = '".$getUser['username']."' ");
        die('Tài khoản của bạn đã bị khóa tự động bởi hệ thống');
    }
}
else
{
    header("location:".BASE_URL('/'));
    exit();
}