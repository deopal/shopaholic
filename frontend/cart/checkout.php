

<?php
session_start();
$con=mysqli_connect('localhost','root');
mysqli_select_db($con,'test');
if(!isset($_SESSION["front-user"])){
    header("location:../login.php");
}
else{
   

    if(isset($_POST['submit'])){
        $pay=$_POST['payment'];
        
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
        if($pay=="cash"){
            echo "<script> window.onload = function() {
                cashOrder();
            }; </script>";
        }
        
    }
   
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
    <style>
        #form .error{
            color:red;
        }
        </style>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <?php 
    include("../includes/header.php");
    $id=$_SESSION["front-user"];
    $q="SELECT * FROM `user-login` WHERE l_id='$id' ";
    $res=mysqli_query($con,$q);
    $user=mysqli_fetch_assoc($res);
    ?>
    

    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="../index.php"><i class="fa fa-home"></i> Home</a>
                        <span>Shopping cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            
            <form action="checkout.php" method="post" class="checkout__form" id="form">
                <div class="row">
                    <div class="col-lg-8">
                        <h5>Billing detail</h5>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="checkout__form__input">
                                    <p>Full Name <span>*</span></p>
                                    <input type="text" name="name" id="name" value="<?php echo $user['name'];?>" >
                                </div>
                            </div>
                            
                            <div class="col-lg-12">
                                <div class="checkout__form__input">
                                    <p>Country <span>*</span></p>
                                    <input type="text" name="country" id="country" value="<?php echo $user['country'];?>" >
                                </div>
                                <div class="checkout__form__input">
                                    <p>Address <span>*</span></p>
                                    <input type="text" placeholder="Street Address" name="address" id="address" value="<?php echo $user['address'];?>" >
                                </div>
                                
                                <div class="checkout__form__input">
                                    <p>State <span>*</span></p>
                                    <input type="text" name="state" id="state" value="<?php echo $user['state'];?>" >
                                </div>
                                <div class="checkout__form__input">
                                    <p>Postcode/Zip <span>*</span></p>
                                    <input type="text" name="pin" id="pin" value="<?php echo $user['pin'];?>" >
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="checkout__form__input">
                                    <p>Phone <span>*</span></p>
                                    <input type="text" name="number" id="number" value="<?php echo $user['number'];?>" >
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="checkout__form__input">
                                    <p>Email <span>*</span></p>
                                    <input type="text" name="email" id="email" value="<?php echo $user['email'];?>" >
                                </div>
                            </div>
                            <div class="col-lg-12">
                                    <div class="checkout__form__input">
                                        <p>Oder notes <span>*</span></p>
                                        <input type="text"
                                        placeholder="Note about your order, e.g, special noe for delivery">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="checkout__order">
                                <h5>Your order</h5>
                                <div class="checkout__order__product">
                                    <ul>
                                        <li>
                                            <span class="top__text">Product</span>
                                            <span class="top__text__right">Total</span>
                                        </li>
                                        <?php
                                        $q="SELECT * FROM cart";
                                        $res=mysqli_query($con,$q);
                                        $i=1;
                                        $sub_total=0;
                                        while($cart=mysqli_fetch_assoc($res)){
                                            $id=$cart['product'];
                                            $q1="SELECT * FROM products WHERE p_id='$id' ";
                                            $res1=mysqli_query($con,$q1);
                                            $pro=mysqli_fetch_assoc($res1);
                                            $total=$cart['quantity'] * $pro['buy_price'];
                                            $sub_total+=$total;
                                            ?>
                                        <li  style="text-transform:capitalize"><?php echo $i;?>. <?php echo $pro['title'];?>(<?php echo $cart['quantity'];?>) <span>&#8377 <?php echo $total;?></span></li>
                                        <?php
                                        $i++;
                                        }
                                        ?>
                                    </ul>
                                </div>
                                <div class="checkout__order__total">
                                    <ul>
                                        <li>Subtotal <span>&#8377 <?php echo $sub_total;?></span></li>
                                        <li>Total <span>&#8377 <?php echo $sub_total;?></span></li>
                                    </ul>
                                </div>
                                <div class="checkout__order__widget">
                                    <label for="check-payment">
                                        Cash on delivery
                                        <input type="radio" class="payment" value="cash" id="check-payment" name="payment" onchange="addcash()">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label for="paypal">
                                        PayPal
                                        <input type="radio" class="payment" value="paypal" id="paypal" name="payment" onchange="addpaypal()">
                                        <span class="checkmark"></span>
                                    </label>
                                    
                                </div>
                                <button type="submit" name="submit" class="site-btn" id="button">Place order</button>
                                <button type="submit" name="submit" id="paypal-button" style="display:none; border:0px"></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <!-- Checkout Section End -->

       

        <!-- Footer Section Begin -->
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
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>

<script src="https://www.paypalobjects.com/api/checkout.js"></script>



        <script>

        function addcash(){
            $('.site-btn').show();
            $('#paypal-button').hide();
            $('.paypal-button').hide();
        }

function addpaypal()  {
            $('.site-btn').hide();
            $('#paypal-button').show();

                    paypal.Button.render({
    // Configure environment
    env: 'sandbox',
    client: {
      sandbox: 'AWL1CVFysNgGbZH_rFQJ9MnylLqCtAq6bJYaHBl3Yj6aa8e1AdTi-X9nG-oJkSsfjAze6zpDNvjcYEUm',
      production: 'demo_production_client_id'
    },
    // Customize button (optional)
    locale: 'en_US',
    style: {
      size: 'medium',
      color: 'gold',
      shape: 'pill',
    },

    // Enable Pay Now checkout flow (optional)
    commit: true,

    // Set up a payment
    payment: function(data, actions) {
      return actions.payment.create({
        transactions: [{
          amount: {
            total: '0.01',
            currency: 'USD'
          }
        }]
      });
    },
    // Execute the payment
    onAuthorize: function(data, actions) {
      return actions.payment.execute().then(function() {
        // Show a confirmation message to the buyer

        $.ajax({
            type:'POST',
            url:"place_order.php",
            data:{pay:"paypal"},
            success:function(data){
                console.log(data);
            }
        })

        swal.fire({
                'title':"Order placed",
                'text':"Thanks for shopping!",
                'icon':'success',
                confirmButtonText: `OK`,
                timer: 2000
            

     
        }).then(()=>{
            window.location='track_order.php';
        });
      });
    }
  }, '#paypal-button');
                };
        
            $(document).ready(function(){

              
    $("#form").validate({
      rules:{
        name:{
            required:true
        },
        email:{
            required:true,
            email:true
        },
        number:{
            required:true,
            number:true,
            minlength:6
        },
        address:{
            required:true
        },
        country:{
            required:true
        },
        state:{
            required:true
        },
        pin:{
            required:true,
            number:true,
            minlength:6,
            maxlength:6
        },
        payment:{
          required:true
        }
        
      },
      messages:{
        name:"**Please enter your name!",
        email:"**Please enter valid email address!",
        number:"**Please enter valid mobile number!",
        address:"**Please enter your address!",
        pin:"**Please enter valid pincode!",
        state:"**Please enter valid input!",
        country:"**Please enter valid input!",
        payment:"**Please fill the mode of payment!"
  

      },
      submitHandler: function(form) {
      form.submit();
    }
    });
  });


             function cashOrder(){
                swal.fire({
                'title':"Order placed",
                'text':"Thanks for shopping!",
                'icon':'success',
                confirmButtonText: `OK`,
                timer: 2000
            

     
        }).then(()=>{
            window.location='track_order.php';
        });
        
            };
            $('.header__menu ul li.active').removeClass('active');
            $('#pages').addClass('active');

           
        </script>




    </body>

    </html>

<?php
}
?>