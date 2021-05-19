
<?php
$con=mysqli_connect('localhost','root');
mysqli_select_db($con,'test');
include("base-url.php");
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
    <link rel="stylesheet" href="<?php echo CSS;?>/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo CSS;?>/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo CSS;?>/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="<?php echo CSS;?>/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo CSS;?>/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="<?php echo CSS;?>/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo CSS;?>/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo CSS;?>/style.css" type="text/css">
</head>
<body>

<!-- Offcanvas Menu Begin -->
<div class="offcanvas-menu-overlay"></div>
<div class="offcanvas-menu-wrapper">
    <div class="offcanvas__close">+</div>
    <ul class="offcanvas__widget">
        <li><a href="<?php echo WISH; ?>"><span class="icon_heart_alt"></span>
        <?php
                            if(isset($_SESSION["front-user"])){
                            $user_id=$_SESSION["front-user"];
                            $q="SELECT * FROM wishlist WHERE user_id='$user_id' ";
                            $res=mysqli_query($con,$q);
                            $num=mysqli_num_rows($res);
                            ?>
                                <div class="tip"><?php echo $num; ?></div>
                                <?php
                            }
                            
                            ?>
        </a></li>
        <li><a href="<?php echo CART; ?>"><span class="icon_bag_alt"></span>
        <?php
                            if(isset($_SESSION["front-user"])){
                            $u_id=$_SESSION["front-user"];
                            $q="SELECT * FROM cart WHERE user_id='$u_id' ";
                            $res=mysqli_query($con,$q);
                            $num=mysqli_num_rows($res);
                            ?>
                                <div class="tip"><?php echo $num; ?></div>
                                <?php
                            }
                            
                            ?>
        </a></li>
    </ul>
    <div class="offcanvas__logo">
        <a href="<?php echo INDEX; ?>"><img src="<?php echo IMG; ?>/logo1.png" alt=""></a>
    </div>
    <?php
    if(!isset($_SESSION["front-user"])){
        ?>
    
    <div class="offcanvas__auth">
        <a href="<?php echo LOGIN; ?>">Login</a>
        <a href="<?php echo REG; ?>">Register</a>
    </div>
    <?php
    }
    else{
        $id=$_SESSION['front-user'];
        $q="SELECT * FROM `user-login` WHERE l_id='$id' ";
        $res=mysqli_query($con,$q);
        $user=mysqli_fetch_assoc($res);
        ?>
        <div class="offcanvas__auth">
        <a href="#" style = "text-transform:capitalize;"><?php echo $user["name"];?></a>
        </div>
        <?php
    }
    ?>
<div id="mobile-wrap">
    <div class="slicknav_menu">
        <a href="#" aria-haspopup="true" role="button" tabindex="0" class="slicknav_btn slicknav_collapsed" style="outline: none;">
        <span class="slicknav_menutxt">MENU</span><span class="slicknav_icon"><span class="slicknav_icon-bar"></span>
        <span class="slicknav_icon-bar"></span>
        <span class="slicknav_icon-bar"></span></span></a>
        <nav class="slicknav_nav slicknav_hidden " aria-hidden="true" role="menu" style="display: none;">
                        <ul>
                            <li class="active"><a href="<?php echo INDEX;?>" role="menuitem">Home</a></li>
                            <li><a href="<?php echo SHOP;?>" role="menuitem">Shop</a></li>
                            <li><a href="<?php echo CART;?>" role="menuitem">Shop Cart</a></li>
                            <li><a href="<?php echo WISH;?>" role="menuitem">Wishlist</a></li>
                            <li><a href="<?php echo CHECKOUT;?>" role="menuitem">Checkout</a></li>
                            <li><a href="<?php echo CONTACT;?>" role="menuitem">Contact</a></li>
                            <li><a href="<?php echo ORDERS;?>" role="menuitem">Orders</a></li>
                            <li><a href="<?php echo ADMIN;?>" role="menuitem">Admin Panel</a></li>
                        </ul>
                    </nav>
                </div>
                   
        
    </div>
    
    <?php
    if(isset($_SESSION["front-user"])){
        ?>
    <div class="offcanvas__auth">
    <a href="<?php echo LOGOUT;?>">Logout</a>
    </div>
    <?php
    }
    ?>
</div>
<!-- Offcanvas Menu End -->

<!-- Header Section Begin -->
<header class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-2 col-lg-2">
                    <div class="header__logo">
                        <a href="<?php echo INDEX;?>"><img src="<?php echo IMG; ?>/logo1.png" alt=""></a>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <nav class="header__menu">
                        <ul style="text-align:center">
                            <li class="active"  id="home"><a href="<?php echo INDEX;?>">Home</a></li>
                            
                            <li id="shop"><a href="<?php echo SHOP;?>">Shop</a></li>
                            <li id="pages"><a href="#">Pages</a>
                                <ul class="dropdown">
                                    <li><a href="<?php echo CART;?>">Shop Cart</a></li>
                                    <li><a href="<?php echo WISH;?>">Wishlist</a></li>
                                    <li><a href="<?php echo CHECKOUT;?>">Checkout</a></li>
                                    <li><a href="<?php echo ADMIN;?>"">Admin Panel</a></li>
                                </ul>
                            </li>
                            <li id="contact"><a href="<?php echo CONTACT;?>"">Contact</a></li>
                            <li id="orders"><a href="<?php echo ORDERS;?>"">Orders</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-xl-4 col-lg-4 ">
                    <div class="header__right">
                    <?php
                   
                    if(!isset($_SESSION["front-user"])){
                    ?>
                        <div class="header__right__auth">
                            <a href="login.php">Login</a>
                            <a href="register.php">Register</a>
                        </div>
                        <?php
                    }
                    else{
                        $id=$_SESSION['front-user'];
                        $q="SELECT * FROM `user-login` WHERE l_id='$id' ";
                        $res=mysqli_query($con,$q);
                        $user=mysqli_fetch_assoc($res);
                        ?>
                        <div class="header__right__auth">
                        <a href="#" style = "text-transform:capitalize;"><?php echo $user["name"];?></a>
                        </div>
                        <?php
                    }
                        ?>
                        
                        <ul class="header__right__widget">
                            <?php
                            if(isset($_SESSION["front-user"])){
                                ?>
                            <li><a href="<?php echo LOGOUT;?>">Logout</a></li>
                            <?php
                        }
                            ?>
                            <li id="wish"><a href="<?php echo WISH; ?>"><span class="icon_heart_alt"></span>
                            <?php
                            if(isset($_SESSION["front-user"])){
                            $user_id=$_SESSION["front-user"];
                            $q="SELECT * FROM wishlist WHERE user_id='$user_id' ";
                            $res=mysqli_query($con,$q);
                            $num=mysqli_num_rows($res);
                            ?>
                                <div class="tip"><?php echo $num; ?></div>
                                <?php
                            }
                            
                            ?>
                            </a></li>
                            <li id="cart"><a href="<?php echo CART; ?>"><span class="icon_bag_alt"></span>
                            <?php
                            if(isset($_SESSION["front-user"])){
                            $u_id=$_SESSION["front-user"];
                            $q="SELECT * FROM cart WHERE user_id='$u_id' ";
                            $res=mysqli_query($con,$q);
                            $num=mysqli_num_rows($res);
                            ?>
                                <div class="tip"><?php echo $num; ?></div>
                                <?php
                            }
                            
                            ?>
                            </a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="canvas__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <script src="<?php echo JS;?>/jquery-3.3.1.min.js"></script>
<script src="<?php echo JS;?>/bootstrap.min.js"></script>
<script src="<?php echo JS;?>/jquery.magnific-popup.min.js"></script>
<script src="<?php echo JS;?>/jquery-ui.min.js"></script>
<script src="<?php echo JS;?>/mixitup.min.js"></script>
<script src="<?php echo JS;?>/jquery.countdown.min.js"></script>
<script src="<?php echo JS;?>/jquery.slicknav.js"></script>
<script src="<?php echo JS;?>/owl.carousel.min.js"></script>
<script src="<?php echo JS;?>/jquery.nicescroll.min.js"></script>
<script src="<?php echo JS;?>/main.js"></script>


    
</body>
</html>