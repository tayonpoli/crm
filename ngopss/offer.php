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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="toast.css" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <title>Ngopss</title>
  </head>
  <body>
  <div class="toast">
        <div class="toast-content">
            <i class="fas fa-solid fa-check check"></i>
            <div class="message">
                <span class="text text-1">Success</span>
                <span class="text text-2">Your changes has been saved</span>
            </div>
        </div>
        <i class="fa-solid fa-xmark close"></i>
        <div class="progress"></div>
    </div>
    <?php include 'navbar.php'; ?>
    <section class="section__container special__container">
      <h2 class="section__header">Special promos and offers</h2>
      <p class="section__description">
      Seasonal and limited time promotional offers
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

    <section class="section__container special__container" id="special">
    <img style="max-width: 45px; max-height: 45px; margin-inline: auto;" src="assets/logoo.png" alt="logoo" />
      <br>
      <h2 class="section__header">All offers</h2>
      <p class="section__description">
      Our ongoing promotions, including classic espresso combos, limited editions, and pastry combos.
      </p>
      <div class="offer__grid">
        <?php
        $query2 = mysqli_query($koneksi, 'SELECT * FROM products WHERE type="Offer" limit 4');
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
    <script>
    $(document).ready(function () {
        // Add to Cart button click event
        $('.add-to-cart').on('click', function () {
            var productId = $(this).data('product-id');
            toast = document.querySelector(".toast")
      closeIcon = document.querySelector(".close"),
      progress = document.querySelector(".progress");
            toast.classList.add("active");
        progress.classList.add("active");

        let timer1, timer2;

        timer1 = setTimeout(() => {
            toast.classList.remove("active");
        }, 5000); //1s = 1000 milliseconds

        timer2 = setTimeout(() => {
          progress.classList.remove("active");
        }, 5300);
      
      closeIcon.addEventListener("click", () => {
        toast.classList.remove("active");
        
        setTimeout(() => {
          progress.classList.remove("active");
        }, 300);

        clearTimeout(timer1);
        clearTimeout(timer2);
    });
            // AJAX request to add the product to the cart
            $.ajax({
                type: 'POST',
                url: 'add_to_cart.php',
                data: { product_id: productId },
                success: function (response) {
                    // Update the cart display with the new data
                    $('testcart').php(response);

                    
                    // $('.toast').toast('show');
                }
            });
        });
    });
</script>


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