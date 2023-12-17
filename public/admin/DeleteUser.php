<?php
require_once("../../config/config.php");
require_once("../../config/function.php");
$title = 'Xóa User | '.$PNH->site('tenweb');
CheckAdmin();
?>
<?php require_once("../../public/admin/Header.php"); ?>
<?php
if(isset($_GET['id']))
{
    $id = $_GET['id'];
    $username = $PNH->get_row(" SELECT username FROM `users` WHERE `id` = '$id'  ")['username'];
    $row = $PNH->remove("users", " `id` = '".$id."' ");
    if(!$row)
    {
        header("Location: /Admin/Users");
        // admin_msg_error("User không tồn tại", BASE_URL('Admin/Users'), 500);
    }else{
        
        $row = $PNH->remove("type", " `username` = '".$username."' ");
        $row = $PNH->remove("saved", " `username` = '".$username."' ");
        $row = $PNH->remove("tyle", " `username` = '".$username."' ");
        header("Location: /Admin/Users");
    // 	admin_msg_success("Xóa thành công", BASE_URL('Admin/Users'), 1000);
    }
}
else
{
    // admin_msg_error("Liên kết không tồn tại", BASE_URL(''), 0);
    header("Location: /Admin/Users");
}
?>
<?php 
    require_once("../../public/admin/Footer.php");
?>