<?php  
include('koneksi.php');
    session_start();
      if(!isset($_SESSION['login_user'])) {
        header("location: login.php");
      }else{
?>
<?php 
if(empty($_SESSION["pesanan"]) OR !isset($_SESSION["pesanan"]))
{
  echo "<script>alert('You arent order anything yet');</script>";
  echo "<script>location= 'menu.php'</script>";
}
?>
<?php 
      if(isset($_POST['konfirm'])) {
          $_SESSION['total']= $totalpay;
          header("location: checkout.php");
          exit;

         
      }
      ?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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
        <a href="pesanan_pembeli.php">
        <i class="ri-shopping-bag-3-line" style="font-size: 1.4rem; color: var(--text-dark)"></i>
        </a>
      </div>
      <div class="nav__btn">
        <a href="profile.php">
        <i class="ri-account-circle-line" style="font-size: 1.55rem; color: var(--text-dark)"></i>
        </a>
      </div>
    </nav>

  <!-- Menu -->
  <section class="section__container special__container" >
      <h2 class="section__header">Your cart</h2>
      <p class="section__description">
      Details of your cart
      </p>
      <div class="special__grid" style="grid-template-columns: 1fr; justify-content:center; margin-left:364px">
            <?php $totalbelanja = 0; ?>
            <?php foreach ($_SESSION["pesanan"] as $id_menu => $jumlah) : ?>

            <?php 
              $ambil = mysqli_query($koneksi, "SELECT * FROM products WHERE id='$id_menu'");
              $pecah = $ambil -> fetch_assoc();
              $subharga = $pecah["price"]*$jumlah;
            ?>
            <div class="special__card" style="padding: 2rem; display: flex; flex-direction:row; align-items:center; column-gap: 2rem; text-align:left; border-radius:28px">
              <img style="max-width: 60px;" src="upload/<?php echo $pecah['image'] ?>" alt="...">
             
                <div style="width: 160px;"><h5><?php echo $pecah["name"]; ?></h5></div>
                <p class="price">Rp. <?php echo number_format($pecah["price"]); ?></p>
                <p class="price">x <?php echo $jumlah; ?></p>
                <p class="price">Rp. <?php echo number_format($subharga); ?></p>
               
               <a href="hapus_pesanan.php?id_menu=<?php echo $id_menu ?>"><i style="color: red; font-size:1.3rem" class="ri-delete-bin-5-fill"></i></a>
              </div>
              <?php $totalbelanja+=$subharga; ?>
              <?php endforeach; ?>
      </div>
      <br><br>
      <hr style="margin-inline: auto; width:690px; height:5px; background-color: black">
      <div style="width:690px; margin-inline:auto; margin-top:1rem;">
      <table style="margin-left: 90px" class="table" id="example" width="100%" cellspacing="5">
                                    <thead>
                                        <tr style="color: var(--text-light); text-align:left; font-size: 18px">
                                        <th colspan="10">Sub total</th>
                                        <th>Rp. <?php echo number_format($totalbelanja) ?></th>
                                        </tr>
                                        <tr style="color: var(--text-light); text-align:left;font-size: 18px">
                                        <th colspan="10">Tax(10%)</th>
                                        <th>Rp. <?php $tax=$totalbelanja*0.1; echo number_format($tax) ?></th>
                                        </tr>
                                        <tr style="text-align:left;font-size: 18px">
                                        <th colspan="10">Total Payment</th>
                                        <th>Rp. <?php $totalpay=$totalbelanja + $tax; echo number_format($totalpay) ?></th>
                                        </tr>
                                    </thead>
                      
                                </table>
    </div>
      <div class="section__description" style="margin-top: 1rem;">
      <br>
      <form  class="" method="POST" action="">
        <a style="margin-right:100px" href="menu.php" class="btn btn-sm btn-light shadow"><i class="fas fa-arrow-left"></i> Add menu</a>
        <button class="btn btn-dark btn-sm shadow" name="konfirm">Checkout <i class="fas fa-check"></i></button>
      </form> 
      </div>
    </section> 


      
    </div>
    
  <!-- Akhir Menu -->
    

    <script>
      $(document).ready(function() {
          $('#example').DataTable();
      } );
    </script>
  </body>
</html>
<?php } ?>