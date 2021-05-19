<?php

include("../includes/conn.php");
if($_SESSION["user"]==false){
  header("location:../login.php");
}
else{

if(isset($_POST["submit"])){
  $cat=$_POST["cat_id"];
  $subcat=$_POST["subcat_id"];
  $title=$_POST["title"];
  $desc=$_POST["desc"];
  $a_p=$_POST["a_p"];
  $discount=$_POST["discount"];
  $b_p=$_POST["s_p"];
    $img=$_FILES["img"]["name"];
    $tmp_img=$_FILES["img"]["tmp_name"];
    $folder="../../dist/img/".$img;
    move_uploaded_file($tmp_img,$folder);
    $q="INSERT INTO products(cat,sub_cat,title,description,img,actual_price,buy_price,discount) VALUES('$cat','$subcat','$title','$desc','$img','$a_p','$b_p','$discount')";
    mysqli_query($con,$q);
    echo "<script> alert('Product added successfully');</script>";
    echo "<script> window.location='product-view.php' ;</script>";
  
}


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
            <h1>Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">products</li>
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
               
                    <form id="form" action="product-add.php" method="post" class="form-horizontal" enctype="multipart/form-data">
                      <div class="form-group row">
                        <label for="cat_id" class="col-sm-2 col-form-label">Category</label>
                        <div class="col-sm-10">
                            <select name="cat_id" id="cat_id" class="form-control" onchange="getsubcat(this.value)">
                            <?php
                            $q2="SELECT * FROM `category` ";
                            $res2=mysqli_query($con,$q2);
                            $i=0;
                            while($category=mysqli_fetch_assoc($res2)){
                                ?>
                                <option value="<?php echo $category['c_id'];?>" ><?php echo $category["name"]; ?></option>
                                <?php
                                $i++;
                            }
                            ?>
                            </select>
                          
                        </div>
                      </div>

                      <div class="form-group row" >
                        <label for="subcat_id" class="col-sm-2 col-form-label">Sub Category</label>
                        <div class="col-sm-10" id="subcat">
                            
                          
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label">Title</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="title" id="title" placeholder="Title" >
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="desc" class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="desc" id="desc" placeholder="Description" >
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="a_p" class="col-sm-2 col-form-label">Actual price</label>
                        <div class="col-sm-10">
                          <input type="number" class="form-control" name="a_p" id="a_p" placeholder="Actual price" >
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="discount" class="col-sm-2 col-form-label">Discount</label>
                        <div class="col-sm-10">
                          <input type="number" class="form-control" name="discount" id="discount" placeholder="Discount" >
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="s_p" class="col-sm-2 col-form-label">Sell price</label>
                        <div class="col-sm-10">
                          <input type="number" class="form-control" name="s_p" id="s_p" placeholder="Sell price" >
                        </div>
                      </div>
                     
                      <div class="form-group row">
                        <label for="img" class="col-sm-2 col-form-label">Image</label>
                        <div class="col-sm-10">
                          <input type="file" class="form-control" name="img" id="img" >
                        </div>
                      </div>
                     
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" name="submit" class="btn btn-success">Add</button>
                        </div>
                      </div>
                    </form>
                 
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
    
    <strong>Copyright &copy; 2021.</strong> All rights
    reserved.
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

  function getsubcat(category){
    $.ajax({
        url: 'proajax.php',
        type: 'post',
        data: { id: category},
        cache: false,
        success: function(response) {
            $('#subcat').html(response); }
    });
  };
  $(document).ready(function(){
   
    
   


      $("#discount").keyup(function(){
          if($("#a_p").val()==""){
            messages:{
                a_p:"**First enter actual price!"
            }
          }else{
              $("#s_p").val($("#a_p").val()-($("#a_p").val()*$("#discount").val()/100));
          }
      })
    $("#form").validate({
      rules:{
        
        title:{
          required:true
        },
        desc:{
          required:true
        },
        a_p:{
            required:true,
            number:true
        },
        discount:{
            required:true,
            number:true
        }
        
      },
      messages:{
        
        
        title:"**Please enter title!",
    
        desc:"**Please enter description",

        a_p:{
            required:"**Please enter actual price!",
            number:"**Please enter valid input!"
        },
        discount:{
            required:"**Please enter discount!",
            number:"**Please enter valid input!"
        }
  

      },
      submitHandler: function(form) {
      form.submit();
    }
    });
  });
  </script>

</body>
</html>
<?php
}
?>
