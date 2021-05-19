<?php

include("includes/conn.php");
if($_SESSION["user"]==false){
  header("location:login.php");
}
else{

$id=$_SESSION["user"];


$q2="SELECT * FROM `profile` WHERE p_id='$id' ";
$res2=mysqli_query($con,$q2);
$profile=mysqli_fetch_assoc($res2);

if(isset($_POST["submit"])){
 
  $name=$_POST["name"];
  $email=$_POST["email"];
  $edu=$_POST["education"];
  $loc=$_POST["location"];
  $exp=$_POST["exp"];
  $skills=$_POST["skills"];
  if(isset($_FILES["img"])){
    $img=$_FILES["img"]["name"];
    $tmp_img=$_FILES["img"]["tmp_name"];
    $folder="../dist/img/".$img;
    move_uploaded_file($tmp_img,$folder);
    $q="UPDATE `profile` 
    SET name='$name',email='$email',education='$edu',location='$loc',experience='$exp',skills='$skills',img='$img'
    WHERE p_id='$id' ";
    mysqli_query($con,$q);
    echo "<script> alert('Profile updated successfully');</script>";
    echo "<script> window.location='profile.php' ;</script>";
  }
  else{
    $q="UPDATE profile 
    SET name='$name',email='$email',education='$edu',location='$loc',experience='$exp',skills='$skills'
    WHERE p_id='$id' ";
    mysqli_query($con,$q);
    echo "<script> alert('Profile updated successfully');</script>";
    echo "<script> window.location='profile.php' ;</script>";
  }
}


?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin | User Profile</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
 
<?php
  include("includes/sidebar.php");
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="../dist/img/<?php echo $profile['img'];?>"
                       alt="<?php echo $profile['img'];?>">
                </div>

                <h3 class="profile-username text-center"><?php echo $profile['name'];?></h3>

                <p class="text-muted text-center">Software Engineer</p>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">About Me</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-book mr-1"></i> Education</strong>

                <p class="text-muted">
                <?php echo $profile['education'];?>
                </p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                <p class="text-muted"><?php echo $profile['location'];?></p>

                <hr>

                <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                <p class="text-muted">
                <?php echo $profile['skills'];?>
                </p>

                <hr>

                <strong><i class="far fa-file-alt mr-1"></i> Experinces</strong>

                <p class="text-muted"><?php echo $profile['experience'];?></p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              
              <div class="card-body">
                
                    <form id="form" action="profile.php" method="post" class="form-horizontal" enctype="multipart/form-data">
                      <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?php echo $profile['name'];?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $profile['email'];?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="education" class="col-sm-2 col-form-label">Education</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="education" id="education" placeholder="Education" value="<?php echo $profile['education'];?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="location" class="col-sm-2 col-form-label">Location</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="location" id="location" placeholder="Location" value="<?php echo $profile['location'];?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="exp" class="col-sm-2 col-form-label">Experience</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" name="exp" id="exp" placeholder="Experiences" value="<?php echo $profile['experience'];?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="skills" class="col-sm-2 col-form-label">Skills</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control"name="skills" id="skills" placeholder="Skills" value="<?php echo $profile['skills'];?>">
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
                          <div class="checkbox">
                            <label>
                              <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" name="submit" class="btn btn-danger">Update</button>
                        </div>
                      </div>
                    </form>
                 
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
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<script>
  
  $(document).ready(function(){
    $("#form").validate({
      rules:{
        name:{
          required:true
        },
        email:{
          required:true,
          email:true
        },
        education:{
          required:true
        },
        location:{
          required:true
        },
        exp:{
          required:true
        },
        skills:{
          required:true
        }
      },
      messages:{
        
        name:"**Please enter name!",
        email:{
          required:"**Please enter email!",
          email:"**Please enter valid email address"
        },
        education:"**Please enter your education!",
    
        location:"**Please enter location",

        exp:"**Please enter your experince!",

        skills:"**Please enter your skills!"
        

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
