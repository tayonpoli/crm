<?php

include 'koneksi.php';

session_start();
      if(!isset($_SESSION['login_user'])) {
        header("location: login.php");
      }
      
      $order_id = $_GET['order_id'];

      $query1 = mysqli_query($koneksi, "SELECT * FROM orders where id='$order_id'");
      $orderr = $query1 -> fetch_assoc();
      
      if(isset($_GET['shipping_status'])){
          $shipping_status = $_GET['shipping_status'];
      } else {
          $shipping_status_query = mysqli_query($koneksi, "SELECT shipping_status FROM `orders` WHERE id = '$order_id'") or die('query failed');
          $fetch_shipping_status = mysqli_fetch_assoc($shipping_status_query);
          $shipping_status = $fetch_shipping_status['shipping_status'];
      }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
    />
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>Profile</title>
    <style>

.main{
    width: 100%;
    height: fit-content;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    padding: 10rem;
}
.head{
    text-align: center;
}
.head_1{
    font-size: 30px;
    font-weight: 600;
    color: #333;
}
.head_1 span{
    color: #ff4732;
}
.head_2{
    font-size: 16px;
    font-weight: 600;
    color: #333;
    margin-top: 3px;
}
.main ul{
    display: flex;
    margin-top: 80px;
}
.main ul li{
    list-style: none;
    display: flex;
    flex-direction: column;
    align-items: center;
}
.main ul li .icon{
    font-size: 35px;
    color: #ff4732;
    margin: 0 60px;
}
.main ul li .text{
    font-size: 14px;
    font-weight: 600;
    color: #ff4732;
}

/* Progress Div Css  */

.main ul li .progress{
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background-color: rgba(68, 68, 68, 0.781);
    margin: 14px 0;
    display: grid;
    place-items: center;
    color: #fff;
    position: relative;
    cursor: pointer;
}
.progress::after{
    content: " ";
    position: absolute;
    width: 125px;
    height: 5px;
    background-color: rgba(68, 68, 68, 0.781);
    right: 30px;
}
.one::after{
    width: 0;
    height: 0;
}
.main ul li .progress .uil{
    display: none;
}
.main ul li .progress p{
    font-size: 13px;
}

/* Active Css  */

.main ul li .active{
    background-color: #ff4732;
    display: grid;
    place-items: center;
}
.main li .active::after{
    background-color: #ff4732;
}
.main ul li .active p{
    display: none;
}
.main ul li .active .uil{
    font-size: 20px;
    display: flex;
}

/* Responsive Css  */

@media (max-width: 980px) {
    .main ul{
        flex-direction: column;
    }
    .main ul li{
        flex-direction: row;
    }
    .main ul li .progress{
        margin: 0 30px;
    }
    .progress::after{
        width: 5px;
        height: 55px;
        bottom: 30px;
        left: 50%;
        transform: translateX(-50%);
        z-index: -1;
    }
    .one::after{
        height: 0;
    }
    .main ul li .icon{
        margin: 15px 0;
    }
}

@media (max-width:600px) {
    .head .head_1{
        font-size: 24px;
    }
    .head .head_2{
        font-size: 16px;
    }
}


    </style>
  </head>
<body style="background-color: #F0F3F7;">
   
<nav>
      <div class="nav__header">
        <div class="logo nav__logo">
          <a href=""><img style="height: 45px; width: 200px;" src="assets/logo.png" alt="logo"></a>
        </div>
        <div class="nav__menu__btn" id="menu-btn">
          <span><i class="ri-menu-line"></i></span>
        </div>
      </div>
      <ul class="nav__links" id="nav-links">
        <li><a href="index.php">Home</a></li>
        <li><a href="menu.php">Menu</a></li>
        <li><a href="offer.php">Offer</a></li>
        <li><a href="about.php">About</a></li>
      </ul>
      <div class="nav__btn">
        <a href="testcart.php">
        <i class="ri-shopping-bag-3-line" style="font-size: 1.4rem; color: var(--text-dark)"></i>
        </a>
      </div>
      <div class="nav__btn">
        <a href="profile.php">
        <i class="ri-account-circle-line" style="font-size: 1.55rem; color: var(--text-dark)"></i>
        </a>
      </div>
</nav>
<form action="" method="post" style="width:1200px; justify-content:center; margin-inline:auto;"class="checkout-form">
<br>
      <h2 class="section__header">Tracking Order</h2>
      <div class="check__grid p-0">
      <div class="prof-container">
    <h2 class="form-title">Order Detail</h2>
        <div class="checkout-form">
        <div class="input-container mb-1">    
            <div class="input-line o-3 mb-0">
                <p>Order ID</p>
            </div>
            <div class="input-line txt-r mb-0 totalp">
                    <p>#<?php echo $orderr['id'] ?></p>
                </div>
         </div>
         <div class="input-container mb-1">
         <div class="input-line o-3 mb-0">
        <p>Product</p>
    </div>
    <div class="input-line txt-r mb-0">
        <?php 
        $products1 = $orderr['total_products']; 
        $separatedProducts = explode(' , ', trim($products1));
        
        foreach ($separatedProducts as $product) : 
            preg_match('/^(.*?) \((\d+)\)$/', $product, $matches);
            
            if (count($matches) == 3) {
                // $matches[1] contains the product name, $matches[2] contains the quantity
                $product_name = $matches[1];
                $quantity = $matches[2];
                ?>
                <p style="text-align: right"><?php echo $product_name?> x <?php echo $quantity?></p>
            <?php 
            } else {
                // Handle case where regular expression doesn't match
                echo "<p>Invalid product format: $product</p>";
            }
        endforeach; 
        ?>
    </div>
         </div>
        <div class="input-container mb-1">    
            <div class="input-line o-3 mb-0">
                <p>Address</p>
            </div>
            <div class="input-line txt-r mb-0">
                    <p style="text-align: right"><?php echo $orderr['address'] ?></p>
                </div>
         </div>
         <div class="input-container mb-1">    
            <div class="input-line o-3 mb-0">
                <p>Delivery</p>
            </div>
            <div class="input-line txt-r mb-0">
                    <p><?php echo $orderr['delivery'] ?></p>
                </div>
         </div>
         <div class="input-container mb-1">    
            <div class="input-line o-3 mb-0">
                <p>Payment</p>
            </div>
            <div class="input-line txt-r mb-0">
                    <p><?php echo $orderr['method'] ?></p>
                </div>
         </div>
         <div class="input-container mb">    
            <div class="input-line o-3 mb-0">
                <p>Total Price</p>
            </div>
            <div class="input-line txt-r mb-0 totalp">
                    <p>Rp. <?php echo number_format($orderr['total_price']); ?></p>
                </div>
         </div>
</div>
    </div>
         <div class="orders-container">
            <a href="profile.php" class="back__btn"><i class="ri-arrow-left-line"></i>
            <span> Back</span>
            </a>
        <div class="main">

        <div class="head">
            <p class="head_1">Your Order Status</p>
           
        </div>

        <ul>
            <li>
                <i class="icon uil uil-clipboard-notes"></i>
                <div class="progress one">
                    <p>1</p>
                    <i class="uil uil-check"></i>
                </div>
                <p class="text">Order Processes</p>
            </li>
            <li>
                <i class="icon uil uil-parcel"></i>
                

                <div class="progress two">
                    <p>2</p>
                    <i class="uil uil-check"></i>
                </div>
                <p class="text">In Delivery</p>
            </li>
            <li>
                <i class="icon uil uil-exchange"></i>
                <div class="progress three">
                    <p>3</p>
                    <i class="uil uil-check"></i>
                </div>
                <p class="text">Order Complete</p>
            </li>
            
        </ul>

    </div>
    </div>
    
    <br>
      </div>
    </div>
</form>
<br>
<br>

<footer class="footer bot" id="contact">
      <div class="section__container footer__container">
        <div class="footer__col">
          <div class="logo footer__logo">
          <a href=""><img style="height: 45px; width: 200px;" src="assets/logo.png" alt="logo"></a>
          </div>
          <p class="section__description">
           Brewing Moments and Sipping Memories, where every sip tells
            a story and every coffee is brew to perfection.
          </p>
        </div>
        <div class="footer__col">
          <h4>Privacy</h4>
          <ul class="footer__links">
            <li><a href="#">Terms of Use</a></li>
            <li><a href="#">Privacy Policy</a></li>
            <li><a href="#">Cookies</a></li>
          </ul>
        </div>
        <div class="footer__col">
          <h4>Product</h4>
          <ul class="footer__links">
            <li><a href="#">Menu</a></li>
            <li><a href="#">Special Offer</a></li>
          </ul>
        </div>
        <div class="footer__col">
          <h4>Information</h4>
          <ul class="footer__links">
            <li><a href="#">About Us</a></li>
            <li><a href="#">Career</a></li>
            <li><a href="#">Contact Us</a></li>
          </ul>
        </div>
      </div>
      <div class="footer__bar">
        Copyright © 2024 Tayonpoli. All rights reserved.
      </div>
    </footer>

<!-- custom js file link  -->
<script src="main.js"></script>
    <script>
const progressbarOne = document.querySelector(".one");
const progressbarTwo = document.querySelector(".two");
const progressbarThree = document.querySelector(".three");

// Get the order ID and shipping status from the URL.
const urlParams = new URLSearchParams(window.location.search);
const orderId = urlParams.get('order_id');
const shippingStatus = urlParams.get('shipping_status');

// Update progress bar based on shipping status.
if (shippingStatus === "In Process") {
  progressbarOne.classList.add("active");
} else if (shippingStatus === "In Delivery") {
  progressbarOne.classList.add("active");
  progressbarTwo.classList.add("active");
} else if (shippingStatus === "Complete") {
  progressbarOne.classList.add("active");
  progressbarTwo.classList.add("active");
  progressbarThree.classList.add("active");
}
</script>

</body>
</html