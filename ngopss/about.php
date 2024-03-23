<?php
include('koneksi.php');
session_start();
      if(!isset($_SESSION['login_user'])) {
        header("location: login.php");
      }else{
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
    <link rel="stylesheet" href="style.css" />
    <title>Ngopss</title>
  </head>
  <body>
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

    <section class="section__container explore__container">
      <div class="about__image">
        <img src="assets/about1.png" alt="about" />
      </div>
      <div class="explore__content">
        <h1 class="section__header">About</h1>
        <p class="section__description">
          Ngopps is a pioneer in the coffee industry, firmly established since 2020. With a tireless dedication to bringing the best coffee to coffee lovers around the world, Ngopps has grown into a vast network, with outlets spread across every city.
Our commitment to superior coffee quality has been recognized through various best coffee championship certificates. This is a testament to our dedication to bringing the unparalleled taste of coffee to our customers.
        </p>
        <div class="explore__btn">
         <a href="about.html"><button class="btn">
            Contact us <span><i class="ri-arrow-right-line"></i></span>
          </button></a>
        </div>
        <br>
        <div class="miles__image">
          <img src="assets/miles.png" alt="milestones" />
        </div>
      </div>
    </section>

    <img style="max-width: 45px; max-height: 45px; margin-inline: auto;" src="assets/logoo.png" alt="logoo" />

    <section class="section__container explore__container">
      <div class="explore__content">
        <h1 class="section__header">Our Story</h1>
        <p class="section__description">
          Ngopps is a pioneer in the coffee industry, firmly established since 2020. With a tireless dedication to bringing the best coffee to coffee lovers around the world, Ngopps has grown into a vast network, with outlets spread across every city.
Our commitment to superior coffee quality has been recognized through various best coffee championship certificates. This is a testament to our dedication to bringing the unparalleled taste of coffee to our customers.
        </p>
        <hr><br>
        <p class="section__description">
        Ngopps is not just a brand, but a lifestyle for coffee enthusiasts. We believe that coffee is not just a drink, but also an experience. With constant innovation and quality service, we strive to deliver the best to our customers, every time.
Order Ngopps and enjoy the best coffee from all corners of the world, along with an unforgettable experience in every sip.
        </p>
      </div>
      <div class="explore__image">
        <img src="assets/about2.png" alt="about" />
      </div>
    </section>


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

    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="main.js"></script>
  </body>
</html>
<?php } ?>