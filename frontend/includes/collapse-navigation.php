<?php
$con=mysqli_connect('localhost','root');
mysqli_select_db($con,'frontend');
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
        <li><span class="icon_search search-switch"></span></li>
        <li><a href="#"><span class="icon_heart_alt"></span>
            <div class="tip">2</div>
        </a></li>
        <li><a href="#"><span class="icon_bag_alt"></span>
            <div class="tip">2</div>
        </a></li>
    </ul>
    <div class="offcanvas__logo">
        <a href="<?php echo INDEX; ?>"><img src="img/logo.png" alt=""></a>
    </div>
    <?php
    if($_SESSION["front-user"]==false){
        ?>
    
    <div class="offcanvas__auth">
        <a href="<?php echo LOGIN; ?>">Login</a>
        <a href="<?php echo REG; ?>">Register</a>
    </div>
    <?php
    }
    else{
        $id=$_SESSION['front-user'];
        $q="SELECT * FROM `login` WHERE l_id='$id' ";
        $res=mysqli_query($con,$q);
        $user=mysqli_fetch_assoc($res);
        ?>
        <div class="offcanvas__auth">
        <a href="#" style = "text-transform:capitalize;"><?php echo $user["name"];?></a>
        </div>
        <?php
    }
    ?>
    <div id="mobile-menu-wrap"></div>
</div>
<!-- Offcanvas Menu End -->

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