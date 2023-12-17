<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?=BASE_URL('');?>" class="nav-link">HOME</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?=BASE_URL('template/');?>dist/img/user2-160x160.jpg" class="img-circle elevation-2"
                            alt="PNH">
                    </div>
                    <div class="info">
                        <a href="<?=BASE_URL('Admin/Home');?>" class="d-block"><?=$getUser['username'];?></a>
                    </div>
                </div>
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item has-treeview menu-open">
                            <a href="<?=BASE_URL('Admin/Home');?>" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">QUẢN LÝ</li>
                        <li class="nav-item">
                            <a href="<?=BASE_URL('Admin/Users');?>" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Thành viên
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=BASE_URL('Admin/Saved');?>" class="nav-link">
                                <i class="nav-icon fas fa-shopping-cart"></i>
                                <p>
                                    Saved
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=BASE_URL('Admin/Report');?>" class="nav-link">
                                <i class="nav-icon fas fa-shopping-cart"></i>
                                <p>
                                    Report
                                </p>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="<?=BASE_URL('Admin/Kqxs');?>" class="nav-link">
                                <i class="nav-icon fas fa-shopping-cart"></i>
                                <p>
                                    Kết quả xổ số
                                </p>
                            </a>
                        </li>
                        
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>