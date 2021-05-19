<?php
session_start();
      $con=mysqli_connect('localhost','root');
      mysqli_select_db($con,'test');
      if(isset($_POST['id'])){
      $id=$_POST['id'];
      $q="SELECT * FROM products WHERE sub_cat='$id' ";
      $res=mysqli_query($con,$q);
      $num1=mysqli_num_rows($res);
      ?>


      <!DOCTYPE html>
      <html lang="en">
      <head>
          <meta charset="UTF-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>Document</title>
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
          
      
      <div class="row ">
      <?php
      if($num1==0){
        ?>
        <h4 style="color:red; text-decoration:underline; align-items:center;">Sorry,  No items available for this filter</h4>
        <?php
    }
      while($pro=mysqli_fetch_assoc($res)){
        $subcat_id=$pro['sub_cat'];
        $q3="SELECT * FROM `sub-category` WHERE id='$subcat_id' ";
        $res3=mysqli_query($con,$q3);
        $subcat3=mysqli_fetch_assoc($res3);
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
                        <li class="add_cart" idc="<?php echo $pro['p_id'];?>" ><a href="#"><span class="icon_bag_alt"></span></a></li>
                    </ul>
                </div>
                <div class="product__item__text">
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
            ?>
            </div>

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

            </body>
      </html>

<?php

echo "<script> $('.row').html; </script>";
        }
        if(isset($_POST["price"])){
            $price=$_POST["price"];
            $q1="SELECT * FROM products WHERE buy_price <= '$price' ";
            $res1=mysqli_query($con,$q1);
            $num1=mysqli_num_rows($res1);
            ?>
            <!DOCTYPE html>
      <html lang="en">
      <head>
          <meta charset="UTF-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>Document</title>
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
          
      
      <div class="row ">
      <?php
      if($num1==0){
          ?>
          <h4 style="color:red; text-decoration:underline; align-items:center;">Sorry, No items available for this filter</h4>
          <?php
      }
      while($pro=mysqli_fetch_assoc($res1)){
          $subcat_id=$pro['sub_cat'];
          $q3="SELECT * FROM `sub-category` WHERE id='$subcat_id' ";
          $res3=mysqli_query($con,$q3);
          $subcat3=mysqli_fetch_assoc($res3);
        ?>
        <div class="col-lg-4 col-md-6 mix <?php echo $subcat3['name'];?> " id="<?php echo $subcat3['name'];?>" >
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
                <div class="product__item__text">
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
            ?>
            </div>

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

            </body>
      </html>

<?php
echo "<script> $('.row').html; </script>";


        }
?>
