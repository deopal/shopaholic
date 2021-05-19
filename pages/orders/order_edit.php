<?php
include("../includes/conn.php");
if($_SESSION["user"]==false){
    header("location:../login.php");
  }
  else{
if(isset($_POST['value']))
{
    $value=$_POST['value'];
    $id=$_POST['id'];
    $q="UPDATE `orders` SET status='$value' WHERE id='$id' ";
    mysqli_query($con,$q);
    echo "Order status changed";

}

if(isset($_GET['action'])){
  if($_GET['action']=='delete'){
    $id=$_GET["id"];
    $q="DELETE FROM `orders` WHERE id='$id' ";
    mysqli_query($con,$q);
    echo "<script> window.location='orders.php' ;</script>";
}
}
  }
?>