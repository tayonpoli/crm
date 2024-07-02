<?php

include 'koneksi.php';

session_start();
      if(!isset($_SESSION['login_user'])) {
        header("location: login.php");
      }
      $user_id = $_SESSION['login_user'];
      $query1 = mysqli_query($koneksi, "SELECT * FROM users where id='$user_id'");
      $userr = $query1 -> fetch_assoc();
      $name = $userr['name'];
      $email = $userr['email'];

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
    <title>Profile</title>
  </head>
<body style="background-color: #F0F3F7;">
   
<?php include 'navbar.php'; ?>
<form action="" method="post" style="width:1200px; justify-content:center; margin-inline:auto;"class="checkout-form">
<br>
      <h2 class="section__header">Hi, <?php echo $name ?></h2>
      <div class="check__grid p-0">
      <div class="prof-container">
    <h2 class="form-title">Profile</h2>
        <div class="checkout-form">
        <div class="input-container mb-1">    
            <div class="input-line o-3 mb-0">
                <p>User ID</p>
            </div>
            <div class="input-line txt-r mb-0 totalp">
                    <p>#<?php echo $user_id ?></p>
                </div>
         </div>
        <div class="input-container mb-1">    
            <div class="input-line o-3 mb-0">
                <p>Name</p>
            </div>
            <div class="input-line txt-r mb-0 totalp">
                    <p><?php echo $name ?></p>
                </div>
         </div>
         <div class="input-container mb-1">    
            <div class="input-line o-3 mb-0">
                <p>Points</p>
            </div>
            <div class="input-line txt-r mb-0 totalp">
                    <p><?php echo $userr['poin'] ?><span><i class="ri-copper-coin-fill" style="color: #F0BB40"></i></span></p>
                </div>
         </div>
         <div class="input-container mb-2">    
            <div class="input-line o-3 mb-0">
                <p>Email</p>
            </div>
            <div class="input-line txt-r mb-0 totalp">
                    <p><?php echo $email ?></p>
                </div>
         </div>
         <div style="margin-inline: auto;" class="explore__btn">
         <a href="logout.php" class="btn logout__btn">
            Logout <span><i class="ri-logout-box-r-line"></i></span>
            </a>
        </div>
</div>
    </div>
         <div class="orders-container">
        <h2 class="orders-title">Orders</h2>
        <div class="orders__grid">
        <?php
        $query2 = mysqli_query($koneksi, "SELECT * FROM orders where user_id = '$user_id' ORDER BY id DESC");
        if(mysqli_num_rows($query2) > 0){
        $result = mysqli_fetch_all($query2, MYSQLI_ASSOC);
        
        ?>
        <?php foreach($result as $result) : ?>
            <div class="orders__card">
        <div class="input-container">    
            <div class="input-line o-3 mb-0 totalp">
                <p># <?php echo $result['id'] ?></p>
            </div>
            <div class="input-line o-3 txt-r mb-0">
                    <p><?php echo $result['placed_on'] ?></p>
                </div>
         </div>
         <div class="input-container">    
            <div class="input-line o-3 mb-0">
                <p>Address</p>
            </div>
            <div class="input-line txt-r mb-0 ">
                    <p><?php $address1 = $result['address']; $separatedParts = explode(',', $address1); echo $separatedParts[0];?></p>
                    <p><?php echo $separatedParts[1];?>, <?php echo $separatedParts[2];?></p>
                </div>
         </div>
         <div class="input-container">    
            <div class="input-line o-3 mb-0">
                <p>Delivery</p>
            </div>
            <div class="input-line txt-r mb-0">
                    <p><?php echo $result['delivery'] ?></p>
                </div>
         </div>
         <div class="input-container">    
            <div class="input-line o-3 mb-0">
                <p>Payment method</p>
            </div>
            <div class="input-line txt-r mb-0">
                    <p><?php echo $result['method'] ?></p>
                </div>
         </div>
         <div class="input-container">    
    <div class="input-line o-3 mb-0">
        <p>Product</p>
    </div>
    <div class="input-line txt-r mb-0">
        <?php 
        $products1 = $result['total_products']; 
        $separatedProducts = explode(' , ', trim($products1));
        
        foreach ($separatedProducts as $product) : 
            preg_match('/^(.*?) \((\d+)\)$/', $product, $matches);
            
            if (count($matches) == 3) {
                // $matches[1] contains the product name, $matches[2] contains the quantity
                $product_name = $matches[1];
                $quantity = $matches[2];
                ?>
                <p><?php echo $product_name?> x <?php echo $quantity?></p>
            <?php 
            } else {
                // Handle case where regular expression doesn't match
                echo "<p>Invalid product format: $product</p>";
            }
        endforeach; 
        ?>
    </div>
      
</div>

         <div class="input-container">    
            <div class="input-line o-3 mb-0">
                <p>Total price</p>
            </div>
            <div class="input-line txt-r mb-0 totalp">
                    <p>Rp. <?php echo number_format($result['total_price']); ?></p>
                </div>
         </div>
         <div class="input-container mb-1">    
            <div class="input-line o-3 mb-0">
                <p>Payment status</p>
            </div>
            <div class="input-line txt-r mb-0 totalp">
                    <p><?php echo $result['payment_status'] ?></p>
                </div>
         </div>
         <div class="input-container ">    
            <div class="input-line o-3 mb-0">
            </div>
            <div class="input-line txt-r mb-0 totalp">
                    <a href="tracking.php?order_id=<?php echo $result['id']; ?>&shipping_status=<?php echo $result['shipping_status']; ?>" class="btn">Track Order</a>
                </div>
         </div>
         </div>
         <?php endforeach; ?>
</div>
      <?php } 
      else {
        echo '<p class="empty">No orders placed yet!</p>';
      }?>
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
<script src="js/script.js"></script>

</body>
</html