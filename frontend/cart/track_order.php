<?php
session_start();
$con=mysqli_connect('localhost','root');
mysqli_select_db($con,'test');
if(!isset($_SESSION["front-user"])){
    header("location:../login.php");
}
else{
   
   
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ashion Template">
    <meta name="keywords" content="Ashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ashion | Template</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap"
    rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="track_order.css" >
    <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="../css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="../css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="../css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="../css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="../css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="../css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="../css/style.css" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <?php 
    include("../includes/header.php");
    ?>
    

    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="../index.php"><i class="fa fa-home"></i> Home</a>
                        <span>Track orders</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <div class="container">
        <?php
        $user_id=$_SESSION["front-user"];
         
    $q="SELECT * FROM orders WHERE user_id='$user_id' ORDER BY id DESC";
    $res=mysqli_query($con,$q);
        while($order=mysqli_fetch_assoc($res)){
            $status=$order['status'];
            $status_msg="Order confirmed";
            if($status==1){
                $status_msg="Picked by courier";
            }
            if($status==2){
                $status_msg="On the way";
            }
            if($status==3){
                $status_msg="Ready for pickup";
            }
            if($status==4){
                $status_msg="Product delivered";
            }
            ?>
    <article class="card" style="margin-bottom:20px" >
        <div class="card-body" >
            <h6>Order ID: <?php echo $order['track_id'];?></h6>
            <article class="card">
                <div class="card-body row">
                    <div class="col"> <strong>Estimated Delivery time:</strong> <br><script>document.write(new Date().toISOString().split('T')[0]);</script></div>
                    <div class="col"> <strong>Shipping BY:</strong> <br> BLUEDART, | <i class="fa fa-phone"></i> +1598675986 </div>
                    <div class="col"> <strong>Status:</strong> <br> <?php echo $status_msg;?> </div>
                    <div class="col"> <strong>Tracking #:</strong> <br> <?php echo $order['track_id'];?> </div>
                </div>
            </article>
            <div class="track" style="margin-bottom:80px">
                <?php
                $class1= $status >= 1 ? "step active" : "step";
                $class2= $status >=2 ? "step active" : "step";
                $class3= $status >=3 ? "step active" : "step";
                $class4= $status >=4 ? "step active" : "step";
                ?>
                <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Order confirmed</span> </div>
                <div class="<?php echo $class1;?>" > <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text">Picked by courier</span> </div>
                <div class="<?php echo $class2;?>" > <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> On the way </span> </div>
                <div class="<?php echo $class3;?>" > <span class="icon"> <i class="fa fa-gift"></i> </span> <span class="text">Ready for pickup</span> </div>
                <div class="<?php echo $class4;?>" > <span class="icon"> <i class="fa fa-check-square"></i> </span> <span class="text">Product delivered</span> </div>
            </div>
            <hr>
            <ul class="row">
            <?php
            $products=explode(",",$order['products']);
            foreach($products as $pro){
                $qp="SELECT * FROM products WHERE p_id=$pro";
                $resp=mysqli_query($con,$qp);
                $product=mysqli_fetch_assoc($resp);
            ?>

                <li class="col-md-4">
                    <figure class="itemside mb-3">
                        <div class="aside"><img src="../../dist/img/<?php echo $product['img'];?>" class="img-sm border"></div>
                        <figcaption class="info align-self-center">
                            <p class="title" ><?php echo $product['title'];?> </p> <span class="text-muted">&#8377 <?php echo $product['buy_price'];?></span>
                        </figcaption>
                    </figure>
                </li>
                <?php
            }
            ?>
                
            </ul>
            <hr>
            <a href="shop-cart.php" class="btn btn-warning" data-abc="true"> <i class="fa fa-chevron-left"></i> Back to orders</a>
        </div>
    </article>
    <?php
        }
        ?>
</div>
        <?php
        include("../includes/footer.php");
        ?>

        <!-- Search Begin -->
        <div class="search-model">
            <div class="h-100 d-flex align-items-center justify-content-center">
                <div class="search-close-switch">+</div>
                <form class="search-model-form">
                    <input type="text" id="search-input" placeholder="Search here.....">
                </form>
            </div>
        </div>
        <!-- Search End -->

        <!-- Js Plugins -->
        <script src="../js/jquery-3.3.1.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/jquery.magnific-popup.min.js"></script>
        <script src="../js/jquery-ui.min.js"></script>
        <script src="../js/mixitup.min.js"></script>
        <script src="../js/jquery.countdown.min.js"></script>
        <script src="../js/jquery.slicknav.js"></script>
        <script src="../js/owl.carousel.min.js"></script>
        <script src="../js/jquery.nicescroll.min.js"></script>
        <script src="../js/main.js"></script>

        <script>
            $('.header__menu ul li.active').removeClass('active');
            $('#orders').addClass('active');

            
        </script>
    </body>

    </html>

<?php
}
?>