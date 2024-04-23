<?php

include 'koneksi.php';

session_start();
      if(!isset($_SESSION['login_user'])) {
        header("location: login.php");
      }
      $user_id = $_SESSION['login_user'];

      if(empty($_SESSION["pesanan"]) OR !isset($_SESSION["pesanan"])) {
         echo "<script>alert('You arent order anything yet');</script>";
         echo "<script>location= 'menu.php'</script>";
      }

      $totalbelanja = 0;
      foreach ($_SESSION["pesanan"] as $id_menu => $jumlah) : 
        $ambil = mysqli_query($koneksi, "SELECT * FROM products WHERE id='$id_menu'");
        $pecah = $ambil -> fetch_assoc();
        $stock = $pecah['stock'];
        $subharga = $pecah["price"]*$jumlah;
        $c_stock = $stock - $jumlah;
        $cart_products[] = $pecah['name'].' ('.$jumlah.') ';
        $totalbelanja+=$subharga; 
        endforeach;
        $tax=$totalbelanja*0.1;
        $totalpay=$totalbelanja + $tax;
        $total = $totalpay + 15000 + 2000;

if(isset($_POST['order_btn'])){
   $query1 = mysqli_query($koneksi, "SELECT * FROM users where id='$user_id'");
   $userr = $query1 -> fetch_assoc();
   $name = mysqli_real_escape_string($koneksi, $_POST['name']);
   $number = $_POST['number'];
   $email = mysqli_real_escape_string($koneksi, $userr["email"]);
   $method = mysqli_real_escape_string($koneksi, $_POST['payment']);
   $delivery = mysqli_real_escape_string($koneksi, $_POST['delivery']);
   $address = mysqli_real_escape_string($koneksi, $_POST['address'].', '. $_POST['city'].', '. $_POST['pcode']);
   $placed_on = date('d-M-Y');
   

   $total_products = implode(', ',$cart_products);

         mysqli_query($koneksi, "INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on, delivery) VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$total', '$placed_on', '$delivery')") or die('query failed');
         foreach ($_SESSION["pesanan"] as $id_menu => $jumlah) : 
          mysqli_query($koneksi, "UPDATE products SET stock = stock - $jumlah, sold = $jumlah WHERE id='$id_menu'");
          endforeach;
         // Mengosongkan pesanan
         unset($_SESSION["pesanan"]);
      
         // Dialihkan ke halaman nota
         echo "<script>alert('Sucessful Ordered!');</script>";
         echo "<script>location= 'index.php'</script>";
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
    <title>Checkout</title>
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
      <h2 class="section__header">Checkout form</h2>
      <div class="check__grid">
         <div class="form-container">
        <h2 class="form-title">Shipping Details</h2>
        <div class="checkout-form">
        <div class="input-container">
            <div class="input-line">
                <label for="name">Your name</label>
                <input type="text" name="name" id="name" placeholder="John Doe">
            </div>
            <div class="input-line">
                <label for="name">Phone number</label>
                <input type="text" name="number" id="number" placeholder="08123456789">
            </div>
        </div>
            <div class="input-line">
                <label for="name">Address</label>
                <input type="text" name="address" placeholder="Jl. Gajah Mada no.23">
            </div>
            <div class="input-container">
                <div class="input-line">
                    <label for="name">City</label>
                    <input type="text" name="city" placeholder="Bekasi">
                </div>
                <div class="input-line">
                    <label for="name">Postal code</label>
                    <input type="text" name="pcode" placeholder="17167">
                </div>
            </div>
            <h2 class="form-title">Delivery and Payment</h2>
            <div class="input-container">
            
                <div class="input-line">
                <div class="select-menu" id="selectDelivery">
        <div class="select-btn">
            <span class="sBtn-text">Select Delivery</span>
            <i class="bx bx-chevron-down"></i>
        </div>
        <ul class="options">
            <li class="option">
                <img src="assets/grab.png" alt="grab">
                <span class="option-text">Grab</span>
            </li>
            <li class="option">
               <img src="assets/gosend.png" alt="grab">
                <span class="option-text">Go Send</span>
            </li>
            <li class="option">
               <img src="assets/maxim.png" alt="grab">
                <span class="option-text">Maxim</span>
            </li>
        </ul>
        <input type="hidden" name="delivery" id="selectedDelivery">
    </div>
                </div>
                <div class="input-line">
                <div class="select-menu" id="selectPayment">
        <div class="select-btn">
            <span class="sBtn-text">Select Payment</span>
            <i class="bx bx-chevron-down"></i>
        </div>
        <ul class="options">
            <li class="option">
            <img src="assets/gopay.png" alt="grab">
                <span class="option-text">Gopay</span>
            </li>
            <li class="option">
            <img src="assets/dana.jpg" alt="grab">
                <span class="option-text">DANA</span>
            </li>
            <li class="option">
            <img src="assets/ovoo.png" alt="grab">
                <span class="option-text">OVO</span>
            </li>
        </ul>
        <input type="hidden" name="payment" id="selectedPayment">
    </div>
                </div>
            </div>
    <script src="script.js"></script>
</div>
    </div>
    <div class="summ-container">
        <h2 class="summ-title">Shopping summary</h2>
        <div class="checkout-form">
        <div class="input-container">    
            <div class="input-line o-3 mb-0">
                <p>Total price</p>
            </div>
            <div class="input-line txt-r mb-0">
                    <p>Rp. <?php $totalp=$totalpay; echo number_format($totalp) ?></p>
                </div>
         </div>
         <div class="input-container">    
            <div class="input-line o-3 mb-0">
                <p>Delivery fee</p>
            </div>
            <div class="input-line txt-r mb-0">
            <p id="delfee">Rp. 0,00 </p>
                </div>
         </div>
         <div class="input-container">    
            <div class="input-line o-3">
                <p>Service fee</p>
            </div>
            <div class="input-line txt-r">
                    <p name="pfee" id="payfee">Rp. 0,00 </p>
                </div>
         </div>
            <div class="input-container">
                <div class="input-line">
                    <p>Shopping total</p>
                </div>
                <div class="input-line txt-r totalp">
                    <p>Rp. <?php echo number_format($total) ?></p>
                </div>
            </div>
            <input type="submit" value="Complete purchase" name="order_btn">
</div>
    </div>
    <br>
    <br>
    <br>
    <br>
      </div>
</form>

<!-- <section style="width:1200px; justify-content:center; margin-inline:auto;"class="checkout">


   <form action="" method="post">
      <h3>place your order</h3>
      <div class="flex">
         <div class="inputBox">
            <span>your name :</span>
            <input type="text" name="name" required placeholder="enter your name">
         </div>
         <div class="inputBox">
            <span>your number :</span>
            <input type="number" name="number" required placeholder="enter your number">
         </div>
         <div class="inputBox">
            <span>your email :</span>
            <input type="email" name="email" required placeholder="enter your email">
         </div>
         <div class="inputBox">
            <span>payment method :</span>
            <select name="method">
               <option value="cash_on_delivery">Cash on Delivery</option>
               <option value="gopay">Gopay</option>
               <option value="dana">DANA</option>
               <option value="qris">QRIS</option>
            </select>

            
         </div>
         <div class="inputBox">
            <span>address line 01 :</span>
            <input type="number" min="0" name="flat" required placeholder="e.g. flat no.">
         </div>
         <div class="inputBox">
            <span>address line 01 :</span>
            <input type="text" name="street" required placeholder="e.g. street name">
         </div>
         <div class="inputBox">
            <span>city :</span>
            <input type="text" name="city" required placeholder="e.g. mumbai">
         </div>
         <div class="inputBox">
            <span>state :</span>
            <input type="text" name="state" required placeholder="e.g. maharashtra">
         </div>
         <div class="inputBox">
            <span>country :</span>
            <input type="text" name="country" required placeholder="e.g. india">
         </div>
         <div class="inputBox">
            <span>pin code :</span>
            <input type="number" min="0" name="pin_code" required placeholder="e.g. 123456">
         </div>
      </div>
      <input type="submit" value="order now" class="btn" name="order_btn">
   </form>

</section> -->

<footer class="footer" id="contact">
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