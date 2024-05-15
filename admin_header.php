<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<div class="wrapper">
      <input type="checkbox" id="btn" hidden>
      <label for="btn" class="menu-btn">
        <i class="fas fa-bars"></i>
        <i class="fas fa-times"></i>
      </label>
      <nav id="sidebar">
        <div class="title">Dashboard</div>
        <ul class="list-items">
          <li><a href="admin_page.php"><i class="fas fa-home"></i>Home</a></li>
          <li><a href="admin_products.php"><i class="fa-solid fa-box-archive"></i>Products</a></li>
          <li><a href="admin_orders.php"><i class="fa-solid fa-file-lines"></i>Orders</a></li>
          <li><a href="admin_purchase.php"><i class="fa-solid fa-file-invoice-dollar"></i>Purchase</a></li>
          <li><a href="#"><i class="fas fa-stream"></i>Expenditure</a></li>
          <li><a href="employee.php"><i class="fa-solid fa-user-tie"></i>Employee</a></li>
          <li><a href="#"><i class="fa-solid fa-dolly"></i>Record Goods</a></li>
          <li><a href="#"><i class="fa-solid fa-file-invoice"></i>Account Payable</a></li>
          <li><a href="#"><i class="fa-solid fa-file-invoice"></i>Account Receivable</a></li>
          <div class="icons">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fa-brands fa-instagram"></i></a>
          </div>
        </ul>
      </nav>
    </div>

<!-- <header class="header">

   <div class="flex">

      <a href="admin_page.php" class="logo">Admin<span>Panel</span></a>

      <nav class="navbar">
         <a href="admin_page.php">home</a>
         <a href="admin_products.php">products</a>
         <a href="admin_orders.php">orders</a>
         <a href="admin_users.php">users</a>
         <a href="admin_purchase.php">purchase</a>
         <a href="employee.php">employee</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="account-box">
         <p>username : <span><?php echo $_SESSION['admin_name']; ?></span></p>
         <p>email : <span><?php echo $_SESSION['admin_email']; ?></span></p>
         <a href="logout.php" class="delete-btn">logout</a>
         <div>new <a href="login.php">login</a> | <a href="register.php">register</a></div>
      </div>

   </div>

</header> -->