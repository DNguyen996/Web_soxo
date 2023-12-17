<?php
require_once("../../config/config.php");
require_once("../../config/function.php");
$title = $PNH->site('tenweb');
if( !empty(($_SESSION['username'])) ){
   header("Location: /");
}

require_once("../../public/client/Header.php");

?>
<div class="mobile">
   <div class="othertop">
      <a class="goback" href="<?=BASE_URL('Home');?>"><img src="/assets/storage/img/goback.png"></a>
      <div class="othertop-font">QUỸ PETROVIETNAM</div>
   </div>
   <div class="header-nbsp"></div>
   <style>
      .input_btn2 {
         float: left;
         display: block;
         background-color: #3582b3;
         text-align: center;
         height: .7rem;
         line-height: .7rem;
         font-size: .3rem;
         border-radius: 5px;
         width: 2rem;
         color: #fff;
         border: 1px solid #3582b3;
         margin-left: 20px;
      }
      .yuyan:hover {
         background-color: #3582b3;
      }
   </style>
   <div style="text-align: center;">
      <img src="/assets/storage/img/mlogo2.png" width="50%">
   </div>
   <div id="thongbao"></div>
   <div class="login_bg">
      <form action="" method="post" id="formlogin">
         <div class="input_text log">
            <label style="width:20%;">Tài khoản</label>
            <input style="width:79%;margin-left:1%;" type="text" name="sdt" placeholder="Vui lòng nhập số điện thoại" required>
         </div>
         <div class="input_text log">
            <label style="width:20%;">Mật khẩu</label>
            <input style="width:79%;margin-left:1%;" type="password" name="password" placeholder="Vui lòng nhập mật khẩu đăng nhập" required>
         </div>
         <div class="error_tips"></div>
         <input type="submit" name="btnlogin" class="input_btn" value="Đăng nhập">
         <p class="p2 re"><a href="<?=BASE_URL('Signup');?>">Đăng ký tài khoản</a></p>
         <p class="p1"><a href="forget.html">Quên mật mã?</a></p>
      </form>
   </div>
</div>
<?php require_once("../../public/client/Footer.php"); ?>