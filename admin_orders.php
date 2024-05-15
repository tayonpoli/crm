<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

if(isset($_POST['update_sale'])){

   $order_update_id = $_POST['order_id'];
   $update_sales = $_POST['update_sales'];
   mysqli_query($conn, "UPDATE `orders` SET sales = '$update_sales' WHERE id = '$order_update_id'") or die('query failed');
   $message[] = 'Salesperson has been updated!';

}

if(isset($_POST['update_pay'])){

   $order_update_id = $_POST['order_id'];
   $update_payment = $_POST['update_payment'];
   mysqli_query($conn, "UPDATE `orders` SET payment_status = '$update_payment' WHERE id = '$order_update_id'") or die('query failed');
   $message[] = 'payment status has been updated!';
   if($update_payment == "paid"){
      $order_data = mysqli_query($conn, "SELECT * FROM `orders` WHERE id = '$order_update_id'") or die('query failed');
      $fetch_order = mysqli_fetch_assoc($order_data); 
      $sales = $fetch_order['sales'];
      mysqli_query($conn, "UPDATE `employee` SET transaction = transaction + 1 WHERE name = '$sales'") or die('query failed');
     $check_query = mysqli_query($conn, "SELECT * FROM `revenue` WHERE order_id = '$order_update_id'") or die('query failed');
     if(mysqli_num_rows($check_query) == 0) { // Check if order already exists in revenue table
       $insert_query = mysqli_query($conn, "INSERT INTO `revenue` (order_id, payment_status, order_placed, name, number, email, address, total_products, total_price, payment_method) VALUES ('$order_update_id', 'paid', '".$fetch_order['placed_on']."', '".$fetch_order['name']."', '".$fetch_order['number']."', '".$fetch_order['email']."', '".$fetch_order['address']."', '".$fetch_order['total_products']."', '".$fetch_order['total_price']."', '".$fetch_order['method']."')") or die('query failed');
    
      }
   }

}

if(isset($_POST['update_status'])){

   $order_update_id = $_POST['order_id'];
   $update_status = $_POST['update_status'];
   mysqli_query($conn, "UPDATE `orders` SET shipping_status = '$update_status' WHERE id = '$order_update_id'") or die('query failed');
   $message[] = 'Order status has been updated!';

}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `orders` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_orders.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>orders</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

   <style>
      .table-container {
  max-width: 100%;
  overflow-x: auto;
}

table {
  width: 100%;
  border-collapse: collapse;
}

thead {
  background-color: #f2f2f2;
}

th, td {
  padding: 10px;
  border-bottom: 1px solid #ddd;
  text-align: left;
}

th {
  font-weight: bold;
}

tbody tr:nth-child(even) {
  background-color: #f2f2f2;
}

tbody tr:hover {
  background-color: #ddd;
}

select, input[type="submit"] {
  padding: 8px 12px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 4px;
  background-color: #f2f2f2;
  cursor: pointer;
}

option[disabled] {
  color: #999;
}

.option-btn, .delete-btn {
  padding: 8px 16px;
  margin-right: 5px;
  border: none;
  border-radius: 4px;
  color: #fff;
  text-decoration: none;
  cursor: pointer;
}

.option-btn {
  background-color: #007bff;
}

.delete-btn {
  background-color: #dc3545;
}

.option-btn:hover, .delete-btn:hover {
  background-color: #0056b3;
}

.empty {
  text-align: center;
  padding: 10px 0;
  font-size: 20px;
}

   </style>

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="orders">

   <h1 class="title">placed orders</h1>

   <div class="table-container">
      <table>
         <thead>
            <tr>
               <th>User ID</th>
               <th>Placed On</th>
               <th>Name</th>
               <th>Number</th>
               <th>Email</th>
               <th>Address</th>
               <th>Total Products</th>
               <th>Total Price</th>
               <th>Delivery</th>
               <th>Salesperson</th>
               <th>Payment Method</th>
               <th>Payment Status</th>
               <th>Current Status</th>
               <th>Action</th>
            </tr>
         </thead>
         <tbody>
            <?php
            $select_orders = mysqli_query($conn, "SELECT * FROM `orders` ORDER BY id DESC") or die('query failed');
            if(mysqli_num_rows($select_orders) > 0){
               while($fetch_orders = mysqli_fetch_assoc($select_orders)){
            ?>
            <tr>
               <td><?php echo $fetch_orders['user_id']; ?></td>
               <td><?php echo $fetch_orders['placed_on']; ?></td>
               <td><?php echo $fetch_orders['name']; ?></td>
               <td><?php echo $fetch_orders['number']; ?></td>
               <td><?php echo $fetch_orders['email']; ?></td>
               <td><?php echo $fetch_orders['address']; ?></td>
               <td><?php echo $fetch_orders['total_products']; ?></td>
               <td>Rp. <?php echo number_format($fetch_orders['total_price']); ?></td>
               <td><?php echo $fetch_orders['delivery']; ?></td>
               <td><?php echo $fetch_orders['sales']; ?></td>
               <td><?php echo $fetch_orders['method']; ?></td>
               <td><?php echo $fetch_orders['payment_status']; ?></td>
               <td><?php echo $fetch_orders['shipping_status']; ?></td>
               <td>
                  <?php
                  $query = "SELECT * FROM employee WHERE department = 'Sales'";
                  $result = $conn->query($query);
                  
                  // Check if employees are found
                  if ($result && $result->num_rows > 0) { 
                  ?>
                  <form action="" method="post">
                     <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
                     <select name="update_sales">
                           <option value="" selected disabled>Select Salesperson</option>
                           <?php
                           // Loop through each employee and generate <option> elements
                           while ($row = $result->fetch_assoc()) {
                              echo '<option value="' . $row['name'] . '">' . $row['name'] . '</option>';
                           }
                           ?>
                     </select>
                     <input type="submit" value="Update" name="update_sale" class="option-btn">
                  </form>
                  <?php } ?>
                  <form action="" method="post">
                     <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
                     <select name="update_payment">
                        <option value="" selected disabled>Update payment</option>
                        <option value="paid">Paid</option>
                        <option value="unpaid">Unpaid</option>
                     </select>
                     <input type="submit" value="Update" name="update_pay" class="option-btn">
                  </form>
                  <form action="" method="post">
                     <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
                     <select name="update_status">
                        <option value="" selected disabled>Update status</option>
                        <option value="In Process">In Process</option>
                        <option value="In Delivery">In Delivery</option>
                        <option value="Complete">Completed</option>
                     </select>
                     <input type="submit" value="Update" name="update_stat" class="option-btn">
                  </form>
                  <a href="admin_orders.php?delete=<?php echo $fetch_orders['id']; ?>" onclick="return confirm('Delete this order?');" class="delete-btn">Delete</a>
               </td>
            </tr>
            <?php
               }
            }else{
               echo '<tr><td colspan="11" class="empty">No orders placed yet!</td></tr>';
            }
            ?>
         </tbody>
      </table>
   </div>

</section>











<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>