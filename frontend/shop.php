<?php
session_start();
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

    <style>
    .show_p{
        overflow:scroll;
    }

    .show_p::-webkit-scrollbar { display: none;}
    </style>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <?php
    include("includes/header.php");
    ?>

    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="index.php"><i class="fa fa-home"></i> Home</a>
                        <span>Shop</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Shop Section Begin -->
    <section class="shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="shop__sidebar">
                        <div class="sidebar__categories">
                            <div class="section-title">
                                <h4>Categories</h4>
                            </div>
                            <div class="categories__accordion">
                                <div class="accordion" id="accordionExample">
                                <?php
                                $q="SELECT * FROM category";
                                $res=mysqli_query($con,$q);
                                while($cat=mysqli_fetch_assoc($res)){
                                    ?>
                                    <div class="card">
                                        <div class="card-heading active">
                                            <a data-toggle="collapse" data-target="#<?php echo $cat['name'];?>"><?php echo $cat['name'];?></a>
                                        </div>
                                    
                                        <div id="<?php echo $cat['name'];?>" class="collapse" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <ul >
                                                <?php 
                                                $id=$cat['c_id'];
                                                $q1="SELECT * FROM `sub-category` WHERE cat_id='$id' ";
                                                $res1=mysqli_query($con,$q1);
                                                while($subcat=mysqli_fetch_assoc($res1)){
                                                    ?>
                                                    <li class="subcat" id="<?php echo $subcat['id'];?>"><a href="#"><?php echo $subcat['name'];?></a></li>
                                                    <?php
                                                }?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }?>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="sidebar__filter">
                            <div class="section-title">
                                <h4>Shop by price</h4>
                            </div>
                            <div class="filter-range-wrap">
                                        <h5><strong>Price: </strong></h5><h5 id="max_value">&#8377 99 - &#8377 9999</h5>
                                        <br>
                                        <div class="price-input">
                                        
                                        <input type="range" id="price-filter" min="99" max="9999" value="9999" oninput=max_display()>
                                        </div>
                            </div>
                            <a id="filter" href="#">Filter</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9 " id="main">
                    <div class="row " >
                    <?php
                    $q2="SELECT * FROM category";
                    $res2=mysqli_query($con,$q2);
                    while($cat2=mysqli_fetch_assoc($res2)){
                        $c_id=$cat2['c_id'];
                        $q3="SELECT * FROM `sub-category` WHERE cat_id='$c_id' ";
                        $res3=mysqli_query($con,$q3);
                        while($subcat3=mysqli_fetch_assoc($res3)){
                            $sub_id=$subcat3['id'];
                            $q4="SELECT * FROM products WHERE sub_cat='$sub_id' ";
                            $res4=mysqli_query($con,$q4);
                            while($pro=mysqli_fetch_assoc($res4)){
                                ?>
                        <div class="col-lg-4 col-md-6 mix <?php echo $subcat3['name'];?> " id="<?php echo $subcat3['name'];?>">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="../dist/img/<?php echo $pro['img'];?>">
                                <?php
                                if($pro['status']==0){
                                ?>
                                <div class="label stockout">out of stock</div>
                                <?php
                                }
                                ?>
                                    <ul class="product__hover">
                                        <li><a href="../dist/img/<?php echo $pro['img'];?>" class="image-popup"><span class="arrow_expand"></span></a></li>
                                        <li class="add_wish" idw="<?php echo $pro['p_id'];?>"><a href="#"><span class="icon_heart_alt"></span></a></li>
                                        <li class="add_cart" idc="<?php echo $pro['p_id'];?>"><a href="#"><span class="icon_bag_alt"></span></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text" style="text-transform:capitalize; text-align:center">
                                    <h6><a href="#"><?php echo $pro['title'];?></a></h6>
                                    <div class="rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="product__price">&#8377 <?php echo $pro['buy_price'];?></div>
                                </div>
                            </div>
                        </div>
                        <?php 
                            }
                        }
                    }?>
                        
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Section End -->

    <?php
include("includes/footer.php");
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



    <script type="text/javascript">


$(document).ready(function(){


    $('body').on('click','.subcat',function() {
    const s_id=$(this).attr('id');
    $.ajax({
        async: true,   
        url: 'shopajax.php',
        type: 'post',
        data: {"id": s_id},
        cache:false,
        success: function(response) {
            $("#main").html(response); }
          });
});

$('body').on('click','.add_cart',function() {
    var id=$(this).attr('idc');
    $.ajax({
        async: true,   
        url:'cart/add_to_cart.php',
        type:'post',
        data:{"id":id},
        cache:false,
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

$('body').on('click','.add_wish',function() {
    var w_id=$(this).attr('idw');
    $.ajax({
        async: true,   
        url:'cart/add_wish.php',
        type:'post',
        data:{"id":w_id},
        cache:false,
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








$('body').on('click','#filter',function() {
    const price=$("#price-filter").val();
    $.ajax({
        async: true,   
        url:'shopajax.php',
        type:'post',
        data:{"price":price},
        cache:false,
        success:function(response){
            $("#main").html(response);}
    });
});



$('.header__menu ul li.active').removeClass('active');
   $('#shop').addClass('active');
  

});

function max_display(){
    var price=$("#price-filter").val();
    var ans=`&#8377 99 - &#8377 ${price}`;
    $("#max_value").html(ans);
};
</script>
</body>

</html>