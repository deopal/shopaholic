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
    $b_p=$_POST["s_p"];
    $discount=$_POST["discount"];
    $id=$_POST["id"];
    if(isset($_FILES["img"])){
    $img=$_FILES["img"]["name"];
    $tmp_img=$_FILES["img"]["tmp_name"];
    $folder="../../dist/img/".$img;
    move_uploaded_file($tmp_img,$folder);
    $q="UPDATE products 
    SET cat='$cat' ,sub_cat='$subcat', title='$title' , description='$desc' ,img='$img' , actual_price='$a_p' , buy_price='$b_p' , discount='$discount' 
    WHERE p_id='$id' ";
    $res1=mysqli_query($con,$q);
    echo $res1;
  }
    else{
    $q="UPDATE products 
    SET cat='$cat' ,sub_cat='$subcat', title='$title' , description='$desc' , actual_price='$a_p' , buy_price='$b_p' , discount='$discount'
    WHERE p_id='$id' ";
    $res1=mysqli_query($con,$q);
    echo $res1;
    }
    echo "<script>alert('Product updated successfully');</script>";
    echo "<script> window.location='product-view.php';</script>";
}

if(isset($_GET["action"])){
    if($_GET["action"]=="edit"){
        $id=$_GET["id"];
        $q1="SELECT * FROM `products` WHERE p_id='$id' ";
        $res=mysqli_query($con,$q1);
        $product=mysqli_fetch_assoc($res);

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
            <h1>Update product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Product</li>
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
               
                    <form id="form" action="product-edit.php" method="post" class="form-horizontal" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label for="cat_id" class="col-sm-2 col-form-label">Category</label>
                        <div class="col-sm-10">
                            <select name="cat_id" id="cat_id" class="form-control" onchange="getsubcat(this.value)">
                            <?php
                            $q2="SELECT * FROM `category` ";
                            $res2=mysqli_query($con,$q2);
                            $i=0;
    
                            while($category=mysqli_fetch_assoc($res2)){
                                if($category['c_id']===$product['cat']){
                                    $selected="selected";
                                    
                                }
                                else{
                                    $selected="";
                                }
                                ?>
                                <option value="<?php echo $category['c_id'];?>" <?php echo $selected;?> ><?php echo $category["name"]; ?></option>
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
                        <select name="subcat_id" id="subcat_id" class="form-control">
                            <?php
                            $cat_id=$product['cat'];
                            $q3="SELECT * FROM `sub-category` WHERE cat_id='$cat_id' ";
                            $res3=mysqli_query($con,$q3);
                            $i=0;
                            while($subcat=mysqli_fetch_assoc($res3)){
                              if($subcat['id']===$product['sub_cat']){
                                $selected="selected";
                            }
                            else{
                                $selected="";
                            }
                                ?>
                                <option value="<?php echo $subcat['id'];?>" <?php echo $selected;?> ><?php echo $subcat["name"]; ?></option>
                                <?php
                                $i++;
                            }
                            ?>
                            </select>
                          
                        </div>
                      </div>
                     
                      <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label">Title</label>
                        <div class="col-sm-10">
                          <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $product['p_id'];?>">
                          <input type="text" class="form-control" name="title" id="title" placeholder="Title" value="<?php echo $product['title'];?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="desc" class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="desc" id="desc" placeholder="Description"  value="<?php echo $product['description'];?>">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="a_p" class="col-sm-2 col-form-label">Actual price</label>
                        <div class="col-sm-10">
                          <input type="number" class="form-control" name="a_p" id="a_p" placeholder="Actual price" value="<?php echo $product['actual_price'];?>">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="discount" class="col-sm-2 col-form-label">Discount</label>
                        <div class="col-sm-10">
                          <input type="number" class="form-control" name="discount" id="discount" placeholder="Discount" value="<?php echo $product['discount'];?>">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="s_p" class="col-sm-2 col-form-label">Sell price</label>
                        <div class="col-sm-10">
                          <input type="number" class="form-control" name="s_p" id="s_p" placeholder="Sell price" value="<?php echo $product['buy_price'];?>">
                        </div>
                      </div>
                     
                      <div class="form-group row">
                        <label for="img" class="col-sm-2 col-form-label">Image</label>
                        <div class="col-sm-10">
                          <input type="file" class="form-control" name="img" id="img" >
                          <img style="width:4rem ;height:4rem" src="../../dist/img/<?php echo $product['img'];?>"  alt="<?php echo $product['img'];?>">
                        </div>
                        
                      </div>
                     
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" name="submit" class="btn btn-success">Update</button>
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
        type: 'POST',
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
    if($_GET['action']=='delete'){
        $id=$_GET["id"];
        $q="DELETE FROM `products` WHERE p_id='$id' ";
        mysqli_query($con,$q);
        echo "<script> window.location='product-view.php' ;</script>";
    }
}
}

?>