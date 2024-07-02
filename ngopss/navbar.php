<?php
      $user_id = $_SESSION['login_user'];
      $query1 = mysqli_query($koneksi, "SELECT * FROM users where id='$user_id'");
      $userr = $query1 -> fetch_assoc();
      $name = $userr['name'];
      $poin = $userr['poin'];
?>
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
        <li><a href="rewards.php">Rewards</a></li>
        <li><a href="about.php">About</a></li>
      </ul>
      <div class="nav__btn">
       <h2 style="font-size: 1.2rem"><?php echo $poin; ?><span><i class="ri-copper-coin-fill" style="font-size: 1.4rem; color: #F0BB40"></i></span></h2>
      </div>
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