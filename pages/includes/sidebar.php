<?php

$con=mysqli_connect('localhost','root');
mysqli_select_db($con,'test');
include("baseurl.php");

$id=$_SESSION["user"];
$i_s="SELECT * FROM profile WHERE p_id='$id' ";
$res_s=mysqli_query($con,$i_s);
$pro=mysqli_fetch_assoc($res_s);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo PLUGIN;?>/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo DIST; ?>/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <title>Admin | User Profile</title>

</head>
<body>

<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo INDEX;?>" class="nav-link">Home</a>
      </li>
      
    </ul>

  </nav>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo INDEX; ?>" class="brand-link">
      <img src="<?php echo DIST ;?>/img/AdminLTELogo.png"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo DIST; ?>/img/<?php echo $pro['img'];?>" class="img-circle elevation-2" alt="<?php echo $pro['img'];?>">
        </div>
        <div class="info">
          <a href="#" class="d-block" style="text-transform: capitalize;"><?php echo $pro['name'];?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo INDEX; ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php echo USER_PANEL; ?>" class="nav-link">
                  <i class="far fa-user nav-icon"></i>
                  <p>User Panel</p>
                </a>
              </li>
              
            </ul>
          </li>
          
          
          <li class="nav-item has-treeview ">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Account settings
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
             
              <li class="nav-item">
                <a href="<?php echo PROFILE; ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Profile</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo LOGOUT; ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Logout</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview ">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Category
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
             
              <li class="nav-item">
                <a href="<?php echo CAT; ?>/category-add.php" class="nav-link">
                  <i class="fa fa-plus nav-icon"></i>
                  <p>Add category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo CAT; ?>/category-view.php" class="nav-link">
                  <i class="fa fa-eye nav-icon"></i>
                  <p>View categories</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-list-alt"></i>
              <p>
                Sub Category
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
             
              <li class="nav-item">
                <a href="<?php echo SUBCAT; ?>/sub-category-add.php" class="nav-link">
                  <i class="fa fa-plus nav-icon"></i>
                  <p>Add sub category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo SUBCAT; ?>/sub-category-view.php" class="nav-link">
                  <i class="fa fa-eye nav-icon"></i>
                  <p>View sub categories</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview ">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-gift"></i>
              <p>
                Products
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
             
              <li class="nav-item">
                <a href="<?php echo PRODUCTS; ?>/product-add.php" class="nav-link">
                  <i class="fa fa-plus nav-icon"></i>
                  <p>Add product</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo PRODUCTS; ?>/product-view.php" class="nav-link">
                  <i class="fa fa-eye nav-icon"></i>
                  <p>View products</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo PRODUCTS; ?>/pending-product.php" class="nav-link">
                  <i class="fa fa-exclamation-triangle nav-icon"></i>
                  <p>Pending products</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo PRODUCTS; ?>/available-product.php" class="nav-link">
                  <i class="fa fa-thumbs-up nav-icon"></i>
                  <p>Approved products</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview ">
            <a href="<?php echo ORDERS; ?>" class="nav-link">
              <i class="nav-icon fas fa-receipt"></i>
              <p>
                Orders
              </p>
            </a>
          </li>

          <li class="nav-item has-treeview ">
            <a href="<?php echo USERS; ?>" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Users
              </p>
            </a>
          </li>

          <li class="nav-item has-treeview ">
            <a href="<?php echo MSG; ?>" class="nav-link">
              <i class="nav-icon fas fa-envelope"></i>
              <p>
                Messages
              </p>
            </a>
          </li>
         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
</body>
</html>