<?php

include("../includes/conn.php");
if($_SESSION["user"]==false){
  header("location:../login.php");
}
else{

$q="SELECT * FROM `products` WHERE status='0' ";
$res=mysqli_query($con,$q);



?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin | Products</title>
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
            <h1>Pending products</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Products</li>
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
          <div class="col-md-12">
            <div class="card">
              
              <div class="card-body">
               
              <table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Category</th>
      <th scope="col">sub-Category</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Actual price</th>
      <th scope="col">Buy price</th>
      <th scope="col">Discount</th>
      <th scope="col">Image</th>
      <th scope="col">Status</th>
      <th colspan="2" style="text-align:center" scope="col">Action</th>   


    </tr>
  </thead>
  <tbody>
      <?php
      $i=1;
      while($pro=mysqli_fetch_assoc($res)){
          $c_id=$pro['cat'];
          $q2="SELECT * FROM `category` WHERE c_id='$c_id' ";
          $res2=mysqli_query($con,$q2);
          $cat=mysqli_fetch_assoc($res2);
          $subcat_id=$pro['sub_cat'];
          $q3="SELECT * FROM `sub-category` WHERE id='$subcat_id' ";
          $res3=mysqli_query($con,$q3);
          $subcat=mysqli_fetch_assoc($res3);
          ?>
    <tr>
      <th scope="row"><?php echo $i;?></th>
      <td><?php echo $cat['name'];?></td>
      <td><?php echo $subcat['name'];?></td>
      <td><?php echo $pro['title'];?></td>
      <td><?php echo $pro['description'];?></td>
      <td><?php echo $pro['actual_price'];?></td>
      <td><?php echo $pro['buy_price'];?></td>
      <td><?php echo $pro['discount'];?></td>
      <td><img style="width:5rem ; height:4rem " src="../../dist/img/<?php echo $pro['img'];?>" alt="<?php echo $pro['title'];?>"></td>
      <td> <div class="custom-control custom-switch available">
            <input type="hidden" value="<?php echo $pro['p_id'];?>">
            <input type="checkbox" class="custom-control-input" name="available<?php echo $pro['p_id'];?>" id="available<?php echo $pro['p_id'];?>" <?php
                            if($pro['status']=="1")
                            {
                                echo "checked";
                            }
                            ?>>
            <label class="custom-control-label" for="available<?php echo $pro['p_id'];?>">Available</label>
          </div></td>
      <td><a href="product-edit.php?action=edit&id=<?php echo $pro['p_id'];?>" class="btn btn-success">EDIT</a></td>
      <td><a href="product-edit.php?action=delete&id=<?php echo $pro['p_id'];?>" class="btn btn-danger" onclick="return confirm(' you want to delete?');">DELETE</a></td>
      

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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<script>

var id;

$(document).on("click", ".available", function() {
 
  id=$(this).children(':hidden').val();

});

$(".available").find("input[type=checkbox]").on("change",function() {

    var status = $(this).prop('checked');

    if(status == true) {
        value = "on";
    }
    else{
        value = "off";
    }

   
    $.ajax({
        url: 'available.php',
        type: 'post',
        data: {"value":value , "id": id},
        cache:false,
        success: function(response) {
            alert(response); }
          });
    });



      
  </script>

</body>
</html>
<?php
}
?>
