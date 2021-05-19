<?php
session_start();
$con=mysqli_connect('localhost','root');
mysqli_select_db($con,'test');
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
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <?php
    include("includes/header.php");
    ?>

    

    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container-fluid">

        <div class="row">
                <div class="col-lg-6 p-0">
                <?php
                $q1="SELECT * FROM category ";
                $res1=mysqli_query($con,$q1);
                $cat1=mysqli_fetch_assoc($res1);
                ?>
                    <div class="categories__item categories__large__item set-bg"
                    data-setbg="../dist/img/<?php echo $cat1['img'];?>">
                    <div class="categories__text">
                        <h1><?php echo $cat1['name'];?></h1>
                        <p>Sitamet, consectetur adipiscing elit, sed do eiusmod tempor incidid-unt labore
                        edolore magna aliquapendisse ultrices gravida.</p>
                        <a data-filter=".<?php echo $cat1['name'];?>" href="#<?php echo $cat1['name'];?>">Shop now</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row">
                <?php 
                $q2="SELECT * FROM category WHERE c_id NOT IN (SELECT MIN(c_id) FROM category)";
                $res2=mysqli_query($con,$q2);
                while($cat2=mysqli_fetch_assoc($res2)){
                    $id=$cat2['c_id'];
                    $q3="SELECT * FROM products WHERE cat='$id' ";
                    $res3=mysqli_query($con,$q3);
                    $num=mysqli_num_rows($res3);
                    ?>
                    <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                        <div class="categories__item set-bg" data-setbg="../dist/img/<?php echo $cat2['img'];?>">
                            <div class="categories__text">
                                <h4><?php echo $cat2['name'];?></h4>
                                <p><?php echo $num;?> items</p>
                                <a data-filter=".<?php echo $cat2['name'];?>" href="#<?php echo $cat2['name'];?>">Shop now</a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
                </div>
            </div>
        </div>




                
            
    </div>
</section>
<!-- Categories Section End -->

<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <div class="section-title">
                    <h4>New product</h4>
                </div>
            </div>
            <div class="col-lg-8 col-md-8">
                <ul class="filter__controls">
                <li class=" active" data-filter="*">All</li>
                <?php
                $q="SELECT * FROM `category` ";
                $res=mysqli_query($con,$q);
                while($cat=mysqli_fetch_assoc($res)){
                    ?>
                    
                    <li data-filter=".<?php echo $cat['name'];?>" id="<?php echo $cat['name'];?>"><?php echo $cat['name'];?></li>
                    <?php 
                }
                ?>
                </ul>
            </div>
        </div>
        <div class="row property__gallery">
            <?php
            
            $q1="SELECT * FROM `products` WHERE status ='1' ORDER BY p_id DESC LIMIT 8 ";
            $res1=mysqli_query($con,$q1);
            $num1=mysqli_num_rows($res1);
            if($num1>0){
            $i1=0;
            while($pro=mysqli_fetch_assoc($res1)){
                $cat_id=$pro['cat'];
                $q2="SELECT * FROM `category` WHERE c_id='$cat_id' ";
                $res2=mysqli_query($con,$q2);
                $cat=mysqli_fetch_assoc($res2);
                ?>
            <div class="col-lg-3 col-md-4 col-sm-6 mix <?php echo $cat['name']; ?>"  >
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="../dist/img/<?php echo $pro['img']; ?>">
                    <?php
                    if($pro['status']==0){
                        ?>
                        <div class="label stockout">out of stock</div>
                        <?php
                    }
                    ?>
                        <ul class="product__hover">
                            <li><a href="../dist/img/<?php echo $pro['img']; ?>" class="image-popup"><span class="arrow_expand"></span></a></li>
                            <li class="add_wish" idw="<?php echo $pro['p_id'];?>"><a href="#"><span class="icon_heart_alt"></span></a></li>
                            <li class="addto_cart" idc="<?php echo $pro['p_id'];?>"><a href="#"><span class="icon_bag_alt"></span></a></li>
                        </ul>
                    </div>
                    <div class="product__item__text" style="text-transform:capitalize; text-align:center">
                        <h6><a href="#"><?php echo $pro['title']; ?></a></h6>
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="product__price">&#8377 <?php echo $pro['buy_price']; ?></div>
                    </div>
                </div>
            </div>
            <?php
            $i1++;
            }
        
        }
        ?>

        </div>
    </div>
</section>
<!-- Product Section End -->

<!-- Banner Section Begin -->
<section class="banner set-bg" data-setbg="img/banner/banner-1.jpg">
    <div class="container">
        <div class="row">
            <div class="col-xl-7 col-lg-8 m-auto">
                <div class="banner__slider owl-carousel">
                    <div class="banner__item">
                        <div class="banner__text">
                            <span>New Collections</span>
                            <h1>The Project Fashion</h1>
                            <a href="shop.php">Shop now</a>
                        </div>
                    </div>
                    <div class="banner__item">
                        <div class="banner__text">
                            <span>The Chloe Collection</span>
                            <h1>The Project Fashion</h1>
                            <a href="shop.php">Shop now</a>
                        </div>
                    </div>
                    <div class="banner__item">
                        <div class="banner__text">
                            <span>The Best Collection</span>
                            <h1>The Project Fashion</h1>
                            <a href="shop.php">Shop now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Banner Section End -->



<!-- Services Section Begin -->
<section class="services spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="services__item">
                    <i class="fa fa-car"></i>
                    <h6>Free Shipping</h6>
                    <p>For all oder over &#8377 999</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="services__item">
                    <i class="fa fa-money"></i>
                    <h6>Money Back Guarantee</h6>
                    <p>If good have Problems</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="services__item">
                    <i class="fa fa-support"></i>
                    <h6>Online Support 24/7</h6>
                    <p>Dedicated support</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="services__item">
                    <i class="fa fa-headphones"></i>
                    <h6>Payment Secure</h6>
                    <p>100% secure payment</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Services Section End -->


<?php
include("./includes/footer.php");
?>

<!-- Search Begin -->

<!-- Search End -->




<!-- Js Plugins -->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/mixitup.min.js"></script>
<script src="js/jquery.countdown.min.js"></script>
<script src="js/jquery.slicknav.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.nicescroll.min.js"></script>
<script src="js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>



$(".addto_cart").click(function(){
    var id=$(this).attr('idc');
   
    $.ajax({
        url:'cart/add_to_cart.php',
        type:'post',
        data:{"id":id},
        success:function(response){
            swal.fire({
            'text':response,
            'icon':'success',
            confirmButtonText: `OK`,
            timer: 1500

     
        });
        }
    });
});

$(".add_wish").click(function(){
  
    var w_id=$(this).attr('idw');
    $.ajax({
        url:'cart/add_wish.php',
        type:'post',
        data:{"id":w_id},
        success:function(response){
            swal.fire({
            'text':response,
            'icon':'success',
            confirmButtonText: `OK`,
            timer: 1500

     
        });
        }
    });
});




   

$('.header__menu ul li.active').removeClass('active');
    $('#home').addClass('active');


</script>
</body>

</html>