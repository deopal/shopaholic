<?php
session_start();
$con=mysqli_connect('localhost','root');
mysqli_select_db($con,'test');


if(isset($_GET['action'])){
    if($_GET['action']=='delete'){
        $id=$_GET['id'];
        $q="DELETE FROM wishlist WHERE id='$id' ";
        mysqli_query($con,$q);
        echo "<script> window.location='wishlist.php' ;</script>";
    }

    if($_GET['action']=='add'){
        $user_id=$_SESSION["front-user"];
        $id=$_GET['id'];
        $q1="SELECT * FROM wishlist WHERE id='$id' ";
        $res1=mysqli_query($con,$q1);
        $wish=mysqli_fetch_assoc($res1);
        $pro_id=$wish['product'];
        $q3="SELECT * FROM cart WHERE product='$pro_id' AND user_id='$user_id' ";
        $res3=mysqli_query($con,$q3);
        $num3=mysqli_num_rows($res3);
        if($num3>0){
            echo "<script> alert('Product is already added to cart') ;</script>";
            echo "<script> window.location='wishlist.php' ;</script>";

        }
        else{
        $q1="DELETE FROM wishlist WHERE id='$id' ";
        mysqli_query($con,$q1);
        $q2="INSERT INTO cart(user_id,product,quantity) VALUES('$user_id','$pro_id',1) ";
        mysqli_query($con,$q2);
        echo "<script> alert('Product added to cart') ;</script>";
        echo "<script> window.location='wishlist.php' ;</script>";
    }
}
}
