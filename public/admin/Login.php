<?php 
require_once("../../config/config.php");
require_once("../../config/function.php");

if( !empty($_SESSION['username']) ){
   header("Location: /");
}

?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>ĐĂNG NHẬP</title>
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
      <link rel="stylesheet" href="<?=BASE_URL('template/');?>plugins/fontawesome-free/css/all.min.css">
      <link rel="stylesheet" href="<?=BASE_URL('template/');?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
      <link rel="stylesheet" href="<?=BASE_URL('template/');?>dist/css/adminlte.min.css">
      <link rel="stylesheet" href="<?=BASE_URL('template/');?>sweetalert2/default.css">
   </head>
   <body class="hold-transition login-page">
      <div class="login-box">
         <div class="login-logo">
            <b>ĐĂNG NHẬP</b>
         </div>
         <div class="card">
            <div class="card-body login-card-body">
               <form action="" method="post" id="loginform">
                   <div id="thongbao"></div>
                  <div class="input-group mb-3">
                     <input type="text" class="form-control" name="login" placeholder="Email đăng nhập">
                     <div class="input-group-append">
                        <div class="input-group-text">
                           <span class="fas fa-envelope"></span>
                        </div>
                     </div>
                  </div>
                  <div class="input-group mb-3">
                     <input type="password" class="form-control" name="password" placeholder="Mật khẩu">
                     <div class="input-group-append">
                        <div class="input-group-text">
                           <span class="fas fa-lock"></span>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-8">
                        <div class="icheck-primary">
                           <input type="checkbox" id="remember" name="rememberMe" >
                           <label for="remember">
                           Remember Me
                           </label>
                        </div>
                     </div>
                     <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block" id="btnLogin">Login</button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
      <script src="<?=BASE_URL('template/');?>plugins/jquery/jquery.min.js"></script>
      <script src="<?=BASE_URL('template/');?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="<?=BASE_URL('template/');?>dist/js/adminlte.js"></script>
      <script src="<?=BASE_URL('template/');?>sweetalert2/sweetalert2.js"></script>
<script type="text/javascript">
    $('body').on('submit', '#loginform', function(e) {
      e.preventDefault();
      var form = $(this).serializeArray();
      form.push({
        name: 'type',
        value: 'Login'
      });
      $.ajax({
        url: "<?= BASE_URL("/assets/ajaxs/AdminAuth.php"); ?>",
        method: "POST",
        data: form,
        beforeSend: function() {
            $('#btnLogin').html('Loading...').prop('disabled', true);
        },
        success: function(response) {
          $('#thongbao').html(response);
          $('#btnLogin').html('Login').prop('disabled', false);
        }
      });
    });
</script>      
   </body>
</html>