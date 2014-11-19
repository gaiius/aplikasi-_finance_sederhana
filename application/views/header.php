<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php if(!defined('BASEPATH')) exit('Akses langsung tidak di perkenankan');
$base_url = $this->config->item('base_url');


?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>AdminLTE | Data Tables</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="<?=$base_url?>public/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?=$base_url?>public/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?=$base_url?>public/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABLES -->
        <link href="<?=$base_url?>public/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?=$base_url?>public/css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>


    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <div class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                
            </div>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        
                        
                    
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?php echo $user;?><i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                             <?php   $bs=mysql_query("SELECT * FROM login where user='$user'");
                                $sbb=mysql_fetch_array($bs);?>
                                <li class="user-header bg-light-blue">
                                <?php if($sbb['foto'] == 'kosong'){?>
                                <img src="<?=$base_url?>foto/profile-unknown-male.png" class="img-circle" alt="User Image" />
                                <?php }else{?>
                                    <img src="<?=$base_url?>foto/<?php echo $sbb['foto'];?>" class="img-circle" alt="User Image" />
                                    <?php } ?>
                                    <p>
                                       <?php echo $user;?>
                                        <small> <?php echo $sbb['telp'];?></small>
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                <li class="user-body">
                                    <div class="col-xs-4 text-center">
                                        <a href="#"><?php echo $sbb['email'];?></a>
                                    </div>
                                  
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="<?=$base_url?>profile/edit_profile/<?php echo $user;?>/<?php echo $user;?>/<?php echo $pass;?>" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?=$base_url?>profile/logout/<?php echo $user;?>/<?php echo $pass;?>" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                                
                            </ul>
                            
                        </li>
                        <!----janedoe of--------------->
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                <h1 align="center">
                    <!-- search form -->
                   <?php echo $user;?>
                   </h1>
                   <hr>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                      <?php 
				                           $no=0;
					                        $qpo=mysql_query("SELECT * FROM menu   ");
					                        while ($menu=mysql_fetch_array($qpo)){ 
											$kode_id=$menu['id_menu'];
											$no++	
				                          ?>                          
                        
                          <li class="treeview">
                            <a href="#">
                                <i class="fa fa-laptop"></i>
                                <span><?php echo $menu['nama'];?></span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <?php 
				                           $no=0;
					                        $ch=mysql_query("SELECT * FROM sub_menu 
											                          join akses_user on
																	  sub_menu.id_sub=akses_user.url_kode
											where sub_menu.kode='$kode_id' and akses_user.nama_user='$user'");
					                        while ($menu_chile=mysql_fetch_array($ch)){ $no++	
				                          ?>
                                           <li><a href="<?=$base_url?><?php echo $menu_chile['url_menu']."/".$user."/".$pass;?>">
										   <?php echo $menu_chile['nama'];?></a>
                                           </li>
                               
                               <?php } ?>
                            </ul>
                        </li>
                        
                 <?php } ?>
                    
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
