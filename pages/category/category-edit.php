<?php
include("../includes/conn.php");
if($_SESSION["user"]==false){
  header("location:../login.php");
}
else{

if(isset($_POST["submit"])){
    $name=$_POST["name"];
    $title=$_POST["title"];
    $desc=$_POST["desc"];
    $id=$_POST["id"];
    if(isset($_FILES["img"])){
    $img=$_FILES["img"]["name"];
    $tmp_img=$_FILES["img"]["tmp_name"];
    $folder="../../dist/img/".$img;
    move_uploaded_file($tmp_img,$folder);
    $q="UPDATE `category` 
    SET name='$name' , title='$title' , description='$desc' ,img='$img' 
    WHERE c_id='$id' ";
    mysqli_query($con,$q);}
    else{
    $q="UPDATE `category` 
    SET name='$name' , title='$title' , description='$desc'
    WHERE c_id='$id' ";
    mysqli_query($con,$q);
    }
    echo "<script>alert('category updated successfully');</script>";
    echo "<script> window.location='category-view.php';</script>";
}

if(isset($_GET["action"])){
    if($_GET["action"]=="edit"){
        $id=$_GET["id"];
        $q1="SELECT * FROM category WHERE c_id='$id' ";
        $res=mysqli_query($con,$q1);
        $cat=mysqli_fetch_assoc($res);

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
            <h1>Update Category</h1>
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
               
                    <form id="form" action="category-edit.php" method="post" class="form-horizontal" enctype="multipart/form-data">
                      <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $cat['c_id'];?>">
                          <input type="text" class="form-control" name="name" id="name" placeholder="Name"  value="<?php echo $cat['name'];?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label">Title</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="title" id="title" placeholder="Title" value="<?php echo $cat['title'];?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="desc" class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="desc" id="desc" placeholder="Description"  value="<?php echo $cat['description'];?>">
                        </div>
                      </div>
                     
                      <div class="form-group row">
                        <label for="img" class="col-sm-2 col-form-label">Image</label>
                        <div class="col-sm-10">
                          <input type="file" class="form-control" name="img" id="img" >
                          <img style="width:4rem ;height:4rem" src="../../dist/img/<?php echo $cat['img'];?>"  alt="<?php echo $cat['img'];?>">
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
  $(document).ready(function(){
    $("#form").validate({
      rules:{
        name:{
          required:true
        },
        title:{
          required:true
        },
        desc:{
          required:true
        }
        
      },
      messages:{
        name:"**Please enter name!",
        
        title:"**Please enter title!",
    
        desc:"**Please enter description"
  

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
        $q="DELETE FROM `category` WHERE c_id='$id' ";
        mysqli_query($con,$q);
        echo "<script> window.location='category-view.php' ;</script>";
    }
}
}

?>