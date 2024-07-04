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
          <li><a href="admin_voucher.php"><i class="fa-solid fa-tags"></i>Discount</a></li>
          <li><a href="customers.php"><i class="fa-solid fa-users"></i>Customers</a></li>
          <li><a href="employee.php"><i class="fa-solid fa-user-tie"></i>Employee</a></li>
          <div class="icons">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fa-brands fa-instagram"></i></a>
          </div>
        </ul>
      </nav>
    </div>