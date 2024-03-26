<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
  header('location:login.php');
}

if(isset($_POST['track'])){
  $order_id = $_POST['order_id'];

  // Get the shipping status from the database
  $shipping_status_query = mysqli_query($conn, "SELECT shipping_status FROM `orders` WHERE id = '$order_id'") or die('query failed');
  $fetch_shipping_status = mysqli_fetch_assoc($shipping_status_query);
  $shipping_status = $fetch_shipping_status['shipping_status'];

  // Redirect to trackprocess.php with the order ID and shipping status
  header("location: tracking.php?order_id=$order_id&shipping_status=$shipping_status");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>orders</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

  <link rel="stylesheet" href="CSS/styless.css">

</head>
<body>
  
  <?php include 'header.php'; ?>

<div class="heading">
  <h3>your orders</h3>
  <p> <a href="home.php">home</a> / orders </p>
</div>

<section class="placed-orders">

  <div class="box-container">

    <?php
      $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($order_query) > 0){
        while($fetch_orders = mysqli_fetch_assoc($order_query)){
          $order_id = $fetch_orders['id'];
    ?>
    <div class="box">
      <p> placed on : <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
      <p> name : <span><?php echo $fetch_orders['name']; ?></span> </p>
      <p> number : <span><?php echo $fetch_orders['number']; ?></span> </p>
      <p> email : <a href="trackprocess.php"></a><span><?php echo $fetch_orders['email']; ?></span> </p>
      <p> address : <span><?php echo $fetch_orders['address']; ?></span> </p>
      <p> shipping status : <span><?php echo $fetch_orders['shipping_status']; ?></span> </p>
      <p> payment status : <span><?php echo $fetch_orders['payment_status']; ?></span> </p>
      <form action="" method="post">
        <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
        <button type="submit" name="track" class="btn">Track Order</button>
      </form>

    </div>
    <?php
        }
      }else{
        echo '<p class="empty">no orders placed yet!</p>';
      }
    ?>
  </div>

</section>








<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
