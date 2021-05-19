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
    if($value=="on"){
        $value=="off";
        $q="UPDATE `products` SET status='1' WHERE p_id='$id' ";
        mysqli_query($con,$q);
    }
    else{
        $value=="on";
        $q="UPDATE `products` SET status='0' WHERE p_id='$id' ";
        mysqli_query($con,$q);
    }
    
    if($value=='off'){
    echo "Product is not available now";
    }
    if($value=='on'){
        echo "Product is available now";
    }
}
  }
?>