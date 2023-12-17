<body class="layout-top-nav">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-dark">
            <div class="container">
                <a href="/" class="navbar-brand">
                    <img src="https://adminlte.io/themes/v3/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                    
                </a>
                <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <ul class="navbar-nav">
                        <?php if($my_level == 'admin'){ ?>
                        <li class="nav-item">
                            <a href="/Admin/Home" class="nav-link">Admin</a>
                        </li>
                        <?php } ?>
                        <li class="nav-item">
                            <a href="/" class="nav-link">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="/Saved" class="nav-link">Saved</a>
                        </li>
                        <li class="nav-item">
                            <a href="/Report" class="nav-link">Report</a>
                        </li>
                        <li class="nav-item">
                            <a href="/Configcustomer" class="nav-link">Cấu hình</a>
                        </li>
                    </ul>
                </div>
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    <!-- <li class="nav-item">
                        <a class="nav-link" >
                           <i class="fas fa-user"> <?=$_SESSION['username'];?></i>
                        </a>
                    </li> -->
                    <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle"><?=$_SESSION['username'];?></a>
                        <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="left: 0px; right: inherit;">
                            <li><a href="javascript:void(0)" id="popupchangpass" class="dropdown-item">Đổi mật khẩu</a></li>
                            <li><a href="javascript:void(0)" id="popupsettings" class="dropdown-item">Settings</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Logout" >
                           <i class="fas fa-sign-out-alt"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>