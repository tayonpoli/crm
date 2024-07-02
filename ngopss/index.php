<?php
include('koneksi.php');
    session_start();
      if(!isset($_SESSION['login_user'])) {
        header("location: login.php");
      }else{
      $user_id = $_SESSION['login_user'];
      $query1 = mysqli_query($koneksi, "SELECT * FROM users where id='$user_id'");
      $userr = $query1 -> fetch_assoc();
      $name = $userr['name'];
      $poin = $userr['poin'];
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
    <link rel="stylesheet" href="style.css" />
    <title>Ngopss</title>
  </head>
  <body>
  <?php include 'navbar.php'; ?>
    <header class="section__container header__container" id="home">
      <div class="header__image">
        <img src="assets/headerr.png" alt="header" />
      </div>
      <div class="header__content">
        <h1>Enjoy Your  Morning Coffee.</h1>
        <p class="section__description">
        Brewing Moments and Sipping Memories, where every sip tells
            a story and every coffee is brew to perfection.
        </p>
        <div class="header__btn">
          <a href="menu.php" class="btn">Order now</a>
        </div>
      </div>
    </header>

    <section class="section__container explore__container">
      <div class="explore__image">
        <img src="assets/about.png" alt="about" />
      </div>
      <div class="explore__content">
        <h1 class="section__header">Our Story</h1>
        <p class="section__description">
          Ngopps is a pioneer in the coffee industry, firmly established since 2020. With a tireless dedication to bringing the best coffee to coffee lovers around the world, Ngopps has grown into a vast network, with outlets spread across every city.
Our commitment to superior coffee quality has been recognized through various best coffee championship certificates. This is a testament to our dedication to bringing the unparalleled taste of coffee to our customers.
        </p>
        <div class="explore__btn">
         <a href="about.html"><button class="btn">
            Read more <span><i class="ri-arrow-right-line"></i></span>
          </button></a>
        </div>
        <br>
        <hr>
        <br>
        <div class="miles__image">
          <img src="assets/miles.png" alt="milestones" />
        </div>
      </div>
    </section>

    <section class="section__container special__container" id="special">
      <img style="max-width: 45px; max-height: 45px; margin-inline: auto;" src="assets/logoo.png" alt="logoo" />
      <br>
      <h2 class="section__header">Explore the recent products</h2>
      <p class="section__description">
        Our selectable drink options, including classic espresso choices, house specialties, fruit smoothies, and frozen treats.
      </p>
      <div class="special__grid">
        <?php
        $query1 = mysqli_query($koneksi, 'SELECT * FROM products where type = "Coffee" or "Pastry" limit 4');
        $result = mysqli_fetch_all($query1, MYSQLI_ASSOC);
        ?>
        <?php foreach($result as $result) : ?>

            <div class="special__card">
              <img src="upload/<?php echo $result['image'] ?>" alt="..."><br>
              <p class="price"><?php echo $result['type'] ?></p>
                <h4><?php echo $result['name'] ?></h4>
               <p class="price">Rp. <?php echo number_format($result['price']); ?></p><br>
               <a href="menu.php">
                View product
                <span><i class="ri-arrow-right-line"></i></span>
              </a>
                
              </div>
              <?php endforeach; ?>
      </div>
    </section>

    <section class="section__container special__container">
      <h2 class="section__header">Explore our special offers</h2>
      <p class="section__description">
      Our selectable drink options, including classic espresso choices, house specialties, fruit smoothies, and frozen treats.
      </p>
      <div class="offer__grid">
        <?php
        $query2 = mysqli_query($koneksi, 'SELECT * FROM products WHERE type="Offer" limit 3');
        $result = mysqli_fetch_all($query2, MYSQLI_ASSOC);
        ?>
        <?php foreach($result as $result) : ?>

            <div class="offer__card">
              <img src="upload/<?php echo $result['image'] ?>" alt="..."><br>
              <p class="price"><?php echo $result['event'] ?></p>
                <h4><?php echo $result['name'] ?></h4>
               <p class="beforee">Rp. <?php echo number_format($result['discount']); ?></p>
               <p class="after">Rp. <?php echo number_format($result['price']); ?></p><br>

               
               <button class="btn add-to-cart" data-product-id="<?php echo $result['id']; ?>">Add to cart</button>

                
              </div>
              <?php endforeach; ?>
      </div>
    </section>



    <section class="section__container banner__container">
      <div class="banner__card">
        <span class="banner__icon"><i class="ri-truck-fill"></i></span>
        <h4>Order Your Coffee</h4>
        <p>
          Seamlessly place your coffee orders online with just a few clicks. Enjoy
          convenience and efficiency as you select from our diverse menu of
          delectable dishes.
        </p>
        <a href="menu.php">
          See all product
          <span><i class="ri-arrow-right-line"></i></span>
        </a>
      </div>
      <div class="banner__card">
        <span class="banner__icon"><i class="ri-discount-percent-fill"></i></span>
        <h4>Special Offer</h4>
        <p>
          Customize your coffee experience by choosing from a tantalizing array
          of options. For savory, sweet, or in between craving, find the perfect
          coffee to satisfy your appetite.
        </p>
        <a href="offer.php">
          See all offers
          <span><i class="ri-arrow-right-line"></i></span>
        </a>
      </div>
      <div class="banner__card">
        <span class="banner__icon"><i class="ri-star-smile-fill"></i></span>
        <h4>Enjoy Your coffee</h4>
        <p>
          Sit back, relax, and savor the flavors as your meticulously prepared
          coffee arrives. Delight in the deliciousness of every sip, knowing that
          your satisfaction is our top priority.
        </p>
        <a href="about.php">
          Read more
          <span><i class="ri-arrow-right-line"></i></span>
        </a>
      </div>
    </section>

    <section class="section__container client__container" id="client">
      <h2 class="section__header">Review from the experts</h2>
      <p class="section__description">
      Some reviews about experience in ngopss by our customers who are also professionals in the coffee industry.
      </p>
      <div class="client__swiper">
        <!-- Slider main container -->
        <div class="swiper">
          <!-- Additional required wrapper -->
          <div class="swiper-wrapper">
            <!-- Slides -->
            <div class="swiper-slide">
              <div class="client__card">
                <p>
                  "Ngopss never fails to impress me! Every
                  dish is a masterpiece, bursting with flavor and freshness."
                </p>
                <img src="assets/client-1.jpg" alt="client" />
                <h4>John Doe</h4>
                <h5>WBC 2020 Champion</h5>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="client__card">
                <p>
                  "I always turn to Ngopss for a quick and delicious coffee. Their
                  efficient service and mouthwatering options never disappoint!"
                </p>
                <img src="assets/client-2.jpg" alt="client" />
                <h4>Emily Johnson</h4>
                <h5>Coffee Vlogger</h5>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="client__card">
                <p>
                  "Ngopss has become my go-to for all my caffeine needs. Their
                  attention to detail and exceptional customer service is incredible."
                </p>
                <img src="assets/client-3.jpg" alt="client" />
                <h4>Michael Thompson</h4>
                <h5>Arabica Q-Grader</h5>
              </div>
            </div>
          </div>
          <!-- If we need pagination -->
          <div class="swiper-pagination"></div>
        </div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="main.js"></script>
  </body>
</html>
<?php } ?>