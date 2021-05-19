<?php
include('includes/conn.php');

if(isset($_POST['submit'])){
  $name=$_POST["name"];
  $email=$_POST['email'];
  $pass1=$_POST['pass1'];
  $pass2=$_POST["pass2"];

  if($pass1===$pass2){
    $q1="SELECT * FROM `user-login` WHERE email='$email' ";
    $res1=mysqli_query($con,$q1);
    $num=mysqli_num_rows($res1);
    if($num>0){
      echo "<script> alert('Email already exists');</script>";
      echo "<script> window.location='register.php'</script>";
    }
    else{
  $q="INSERT INTO `user-login`(name,email,password) VALUES('$name','$email','$pass1') ";
  mysqli_query($con,$q);
  echo "<script> alert('You have been registered successfully');</script>";
  echo "<script> window.location='login.php'</script>";
  
}
}
else{
    echo "<script> alert('Your password did not match');</script>";
    echo "<script> window.location='register.php'</script>";

}
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Registration Page</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition">

<?php
include("includes/header.php");
?>

<div class="register-page">
<div class="register-box">
  
  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new membership</p>

      <form action="register.php" method="post">
        <div class="input-group mb-3">
          <input name="name" id="name" type="text" class="form-control" placeholder="Full name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input name="email" id="email" type="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input name="pass1" id="pass1" type="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input name="pass2" id="pass2" type="password" class="form-control" placeholder="Retype password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input name="country" id="country" type="text" class="form-control" placeholder="Country">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-globe"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input name="address" id="address" type="text" class="form-control" placeholder="Address">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-city"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input name="state" id="state" type="text" class="form-control" placeholder="state">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-globe"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input name="pin" id="pin" type="text" class="form-control" placeholder="Postal code">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-code"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input name="number" id="number" type="text" class="form-control" placeholder="Mobile No.">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phone"></span>
            </div>
          </div>
        </div>

        <div class="row">
          
          <!-- /.col -->
          <div class="col-12">
            <button name="submit" id="submit" type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      

      <a href="login.php" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
</div>
<!-- /.register-box -->

<?php
include("includes/footer.php");
?>

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<Script>
  $('.header__menu ul li.active').removeClass('active');
  </script>
</body>
</html>
