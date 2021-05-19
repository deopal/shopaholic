<?php
session_start();
$con=mysqli_connect('localhost','root');
mysqli_select_db($con,'test');
if(!isset($_SESSION["front-user"])){
    header("location:../login.php");
}
else{
   

    if(isset($_POST['pay'])){
        $pay=$_POST['pay'];
        
        $a=array();
        
        $qc="SELECT * FROM cart ";
        $resc=mysqli_query($con,$qc);
        while($carts=mysqli_fetch_assoc($resc)){
            $pro_id=$carts['product'];
            array_push($a,$pro_id);
        }
        $product=implode(",",$a);
        $track_num= str_pad(mt_rand(1,99999999),8,'0',STR_PAD_LEFT);
        $user_id=$_SESSION["front-user"];
        $p="INSERT INTO orders(user_id,track_id,products,status,payment) VALUES('$user_id','$track_num','$product','0','$pay')";
        mysqli_query($con,$p);
        echo "order placed";
        
    }
}
   
?>