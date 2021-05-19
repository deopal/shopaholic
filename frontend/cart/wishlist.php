<?php
session_start();

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
                        <span>Wishlist</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Shop Cart Section Begin -->
    <section class="shop-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shop__cart__table">
                    <?php
                    $u_id=$_SESSION["front-user"];
                    $q="SELECT * FROM wishlist WHERE user_id='$u_id' ";
                    $res=mysqli_query($con,$q);
                    $num=mysqli_num_rows($res);
                    if($num==0){
                        ?>
                        <h3 style="text-align:center; color:red; text-decoration:underline">NO ITEMS IN WISHLIST</h3><br><br><br>
                        <?php
                    }
                    else{
                        ?>
                        <table>
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                
                                while($wish=mysqli_fetch_assoc($res)){
                                    $p_id=$wish['product'];
                                    $q1="SELECT * FROM products WHERE p_id='$p_id' ";
                                    $res1=mysqli_query($con,$q1);
                                    $pro=mysqli_fetch_assoc($res1);
                                    ?>
                                <tr>
                                    <td class="cart__product__item" style="display:flex ; flex-direction:column; width:60%; height:60%">
                                        <img src="../../dist/img/<?php echo $pro['img'];?>" alt="">
                                        <div class="cart__product__item__title"  style="text-transform:capitalize; text-align:center">
                                            <h6><?php echo $pro['title'];?></h6>
                                            <div class="rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="cart__price">&#8377 <?php echo $pro['buy_price'];?></td>
                                    
                                    <td ><a href="wish_edit.php?action=add&id=<?php echo $wish['id'];?>"><button class="btn btn-success">Add to cart</button></a></td>
                                    <td class="cart__close"><a href="wish_edit.php?action=delete&id=<?php echo $wish['id'];?>" onclick="return confirm(' you want to delete?');"><span class="icon_close"></span></a></td>
                                </tr>
                                <?php
                                }
                                ?>
                                
                            </tbody>
                        </table>
                        <?php
                    }
                    ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="cart__btn">
                        <a href="../shop.php">Continue Shopping</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Cart Section End -->

    <?php 
    include("../includes/footer.php");
    ?>
    <!-- Footer Section End -->

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
            $('#pages').addClass('active');


        </script>
</body>

</html>

<?php
}
?>
