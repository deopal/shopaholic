<?php

include("../includes/conn.php");
if($_SESSION["user"]==false){
  header("location:../login.php");
}
else{

$q="SELECT * FROM `orders` ";
$res=mysqli_query($con,$q);



?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin | Orders</title>
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
            <h1>Orders</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Orders</li>
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
      <th scope="col">Track id</th>
      <th scope="col">Costumer</th>
      <th scope="col">Products</th>
      <th scope="col">Status</th>
      <th scope="col">Change status</th>
      <th scope="col">Action</th>


    </tr>
  </thead>
  <tbody>
      <?php
      $i=1;
      while($order=mysqli_fetch_assoc($res)){
        $products=explode(",",$order['products']);
        $a=array();
        foreach($products as $pro){
            $qp="SELECT * FROM products WHERE p_id=$pro";
            $resp=mysqli_query($con,$qp);
            $product=mysqli_fetch_assoc($resp);
            array_push($a,$product['title']);
        }
        $all_pro=implode(",",$a);
        $user_id=$order["user_id"];
        $qu="SELECT * FROM `user-login` WHERE l_id='$user_id' ";
        $resu=mysqli_query($con,$qu);
        $user=mysqli_fetch_assoc($resu);
          ?>
    <tr>
      <th scope="row"><?php echo $i;?></th>
      <td><?php echo $order['track_id'];?></td>
      <td style="text-transform: capitalize;"><?php echo $user['name'];?></td>
      <td><?php echo $all_pro;?></td>
      <?php
      $status=$order['status'];
      $status_msg="Order confirmed";
            if($status==1){
                $status_msg="Picked by courier";
            }
            if($status==2){
                $status_msg="On the way";
            }
            if($status==3){
                $status_msg="Ready for pickup";
            }
            if($status==4){
                $status_msg="Product delivered";
            }
            ?>

      <td><?php echo $status_msg;?></td>
      <td> <select name="status" class="status" id="<?php echo $order['id'];?>" class="form-control" >
          <option value="0">Order confirmed</option>
          <option value="1">Picked by courior</option>
          <option value="2">On the way</option>
          <option value="3">Ready for pickup</option>
          <option value="4">Product delivered</option>
      </td>
      <td><a href="order_edit.php?action=delete&id=<?php echo $order['id'];?>" class="btn btn-danger" onclick="return confirm(' you want to delete?');">DELETE</a></td>
      

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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>


$(".status").change(function() {
    var id=$(this).attr('id');
    var val=$(this).val();
   
    $.ajax({
        url: 'order_edit.php',
        type: 'post',
        data: {"value":val , "id": id},
        cache:false,
        success: function(response) {
            swal.fire({
            'text':response,
            confirmButtonText: `OK`,
            'icon':'success',
            'type':'success',
             timer:1500

     
        }).then(function(){
            window.location="orders.php";
        });
           }
          });
    });



      
  </script>

</body>
</html>
<?php
}
?>
