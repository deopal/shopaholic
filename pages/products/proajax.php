<?php
include("../includes/conn.php");

if(isset($_POST["id"])){
    $cat_id=$_POST["id"];
    $q="SELECT * FROM `sub-category` WHERE cat_id='$cat_id' ";
    $res=mysqli_query($con,$q);

    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
        <title>Document</title>
    </head>
    <body>
        
   
    <select name="subcat_id" id="subcat_id" class="form-control">
                            <?php
                            $i=0;
                            while($subcat=mysqli_fetch_assoc($res)){
                                ?>
                                <option value="<?php echo $subcat['id'];?>" ><?php echo $subcat["name"]; ?></option>
                                <?php
                                $i++;
                            }
                            ?>
                            </select>

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
echo "<script> document.getElementById('subcat_id').innerHTML ; </script>";
}
?>