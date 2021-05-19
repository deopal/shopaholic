<?php

include("../includes/conn.php");
if($_SESSION["user"]==false){
  header("location:../login.php");
}
else{

$q="SELECT * FROM `category` ";
$res=mysqli_query($con,$q);



?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin | Category</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
 
<?php
  include("../includes/sidebar.php");
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Category</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Categories</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              
              <div class="card-body">
               
              <table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Image</th>
      <th colspan="2" style="text-align:center" scope="col">Action</th>

    </tr>
  </thead>
  <tbody>
      <?php
      $i=1;
      while($cat=mysqli_fetch_assoc($res)){
          ?>
    <tr>
      <th scope="row"><?php echo $i;?></th>
      <td><?php echo $cat['name'];?></td>
      <td><?php echo $cat['title'];?></td>
      <td><?php echo $cat['description'];?></td>
      <td><img style="width:5rem ; height:4rem " src="../../dist/img/<?php echo $cat['img'];?>" alt="<?php echo $cat['title'];?>"></td>
      <td><a href="category-edit.php?action=edit&id=<?php echo $cat['c_id'];?>" class="btn btn-success">EDIT</a></td>
      <td><a href="category-edit.php?action=delete&id=<?php echo $cat['c_id'];?>" class="btn btn-danger" onclick="return confirm(' you want to delete?');">DELETE</a></td>

    </tr>
    <?php
    $i++;
      }
      ?>
  </tbody>
</table>
                 
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    
    <strong>Copyright &copy; 2021.</strong> All rights reserved.

  </footer>

  <!-- Control Sidebar -->
  
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>


</body>
</html>
<?php
}
?>
