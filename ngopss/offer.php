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
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
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
    <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="5000">
      <img src="assets/banner1.png" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item" data-bs-interval="5000">
      <img src="assets/banner2.png" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item" data-bs-interval="5000">
      <img src="assets/banner3.png" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

    <?php
    // Query to get unique events from the offers
    $queryEvents = mysqli_query($koneksi, 'SELECT DISTINCT event FROM products WHERE type="Offer"');
    $events = mysqli_fetch_all($queryEvents, MYSQLI_ASSOC);

    // Loop through each event
    foreach($events as $event) :
        $eventName = $event['event'];
    ?>
    <section class="section__container special__container p4">
    <h2 class="section__header">Special Offers</h2>
    <h2 class="section__event"><?php echo $eventName; ?></h2>
    <p class="section__description">
        Seasonal and limited time promotional offers
    </p>
        <div class="offer__grid">
            <?php
            // Query to get offers for the current event
            $queryOffers = mysqli_query($koneksi, "SELECT * FROM products WHERE type='Offer' AND event='$eventName' LIMIT 3");
            $offers = mysqli_fetch_all($queryOffers, MYSQLI_ASSOC);

            // Loop through each offer for the current event
            foreach($offers as $offer) :
            ?>
            <div class="offer__card">
                <img src="upload/<?php echo $offer['image'] ?>" alt="..."><br>
                <p class="event"><?php echo $offer['event'] ?></p>
                <h4><?php echo $offer['name'] ?></h4>
                <p class="beforee">Rp. <?php echo number_format($offer['discount']); ?></p>
                <p class="after">Rp. <?php echo number_format($offer['price']); ?></p><br>
                <button class="btn add-to-cart" data-product-id="<?php echo $offer['id']; ?>">Add to cart</button>
            </div>
            <?php endforeach; ?>
        </div>
    </section>
    <?php endforeach; ?>
    <br>
    <br>
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
    <!-- Community Building -->
    <section class="section_container special_container" style="display: flex; align-items: center;">
      <div style="flex: 1; padding: 20px;">
        <img style="max-width: 45px; max-height: 45px; margin-inline: auto;" src="assets/logoo.png" alt="logoo" />
        <br>
        <h2 class="section__header">Join Our Community!</h2>
        <p class="section__description" style="margin:auto; width:100%; text-align:justify; font-weight:600;">
          Join our community on Discord and get special offers, exclusive promotions and discount vouchers directly from us! Enjoy the best experience with our cafe and be part of an exclusive customer base that always gets the best.
        </p>
        <div style="display:flex; justify-content:center; align-items:center;">
          <button id="community-btn" style="background-color:#0f0f0f; color:#fff; border-radius:24px; padding:15px 30px; font-size:25px; font-weight:700; cursor:pointer; margin-top:50px; margin-bottom:111px;">Join Discord</button>
        </div>
      </div>
      <div style="flex: 1; padding: 20px; ">
          <img style="max-width: 100%; height: auto; border-radius:16px;" src="assets/community.jpeg" alt="Community Image" />
      </div>
    </section>
    <!-- Community End -->
     <br>
     <br>


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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="main.js"></script>
  </body>
</html>
<?php } ?>