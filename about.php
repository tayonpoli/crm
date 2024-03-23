<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="CSS/styless.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>about us</h3>
   <p> <a href="home.php">home</a> / about </p>
</div>

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="IMG/banner.jpeg" alt="">
      </div>

      <div class="content">
         <h3>why choose us?</h3>
         <p>Ngopps is a pioneer in the coffee industry, firmly established since 2020. With a tireless dedication to bringing the best coffee to coffee lovers around the world, Ngopps has grown into a vast network, with outlets spread across every city.

Our commitment to superior coffee quality has been recognized through various best coffee championship certificates. This is a testament to our dedication to bringing the unparalleled taste of coffee to our customers.

</p>
         <a href="shop.php" class="btn">buy now</a>
      </div>

   </div>

</section>






<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>