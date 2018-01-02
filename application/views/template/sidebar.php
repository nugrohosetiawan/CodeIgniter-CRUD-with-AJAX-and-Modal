<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url('assets/AdminLTE-2.0.5/dist/img/user2-160x160.jpg') ?>" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>Admin</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                    <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview">
                <a href="<?php echo site_url('admin') ?>">
                    <i class="fa fa-dashboard"></i> <span>Home</span> 
                </a>
               
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Destinasi Wisata</span>
                    <span class="label label-primary pull-right">4</span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo site_url('profile') ?>"><i class="fa fa-circle-o"></i> Kelola Lokasi</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Ditangguhkan</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Dilaporkan</a></li>
                   
                </ul>
            </li>
           
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-laptop"></i>
                    <span>Pengguna</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo site_url('pengguna') ?>"><i class="fa fa-circle-o"></i> Kelola User</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Private Chat</a></li>
                </ul>
            </li>
            
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-table"></i> <span>Master</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo site_url('kategori') ?>"><i class="fa fa-circle-o"></i> Kategori</a></li>
                    <li><a href="<?php echo site_url('lokasi');?>"><i class="fa fa-circle-o"></i> Lokasi</a></li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-calendar"></i> <span>Bookings</span>
                    <small class="label pull-right bg-red">3</small>
                </a>
            </li>
            
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-envelope"></i> <span>Comment</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> All</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Pending</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Aproved</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Spam</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Trash</a></li>
                    <li class="active"><a href="<?php echo site_url('blank') ?>"><i class="fa fa-circle-o"></i> Blank Page</a></li>
                </ul>
            </li>
            
            
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">