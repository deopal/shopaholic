<?php
session_start();
$con=mysqli_connect('localhost','root');
mysqli_select_db($con,'test');

if(isset($_GET['action'])){
    if($_GET['action']=='delete'){
        $id=$_GET['id'];
        $q="DELETE FROM cart WHERE id='$id' ";
        mysqli_query($con,$q);
        echo "<script> window.location='shop-cart.php' ;</script>";
    }
}

if(isset($_POST["value"])){
    $quan=$_POST["value"];
    if($quan==0){
        echo $quan;
    }
    else{
    $cart_id=$_POST["id"];
    $q1="UPDATE cart
    SET quantity='$quan'
    WHERE id='$cart_id' ";
    mysqli_query($con,$q1);
    echo $quan;}
}

?>