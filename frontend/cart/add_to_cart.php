<?php
session_start();
if(isset($_SESSION["front-user"])){
$con=mysqli_connect('localhost','root');
mysqli_select_db($con,'test');



if(isset($_POST["id"])){
    $user_id=$_SESSION["front-user"];
    $id=$_POST['id'];
    $q="SELECT * FROM cart WHERE product='$id' AND user_id='$user_id'   ";
    $res=mysqli_query($con,$q);
    $num=mysqli_num_rows($res);
    if($num>0){
        echo "Product is already added to cart";
    }
    else{
        $q1="INSERT INTO cart(user_id,product,quantity) VALUES('$user_id','$id',1) ";
        $res1=mysqli_query($con,$q1);
        echo "Product added to cart";
    }
}


}


else{
    echo "Please log in first!";
}
