<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}


if(isset($_GET['delete'])){
  $delete_id = $_GET['delete'];
  mysqli_query($conn, "DELETE FROM `users` WHERE id = '$delete_id'") or die('query failed');
  header('location:customers.php');
}

if(isset($_POST['update_user'])){

    $update_p_id = $_POST['update_p_id'];
    $update_name = $_POST['update_name'];
    $update_email = $_POST['update_email'];
    $update_point = $_POST['update_point'];
 
    mysqli_query($conn, "UPDATE `users` SET name = '$update_name', email = '$update_email', poin = '$update_point' WHERE id = '$update_p_id'") or die('query failed');

    header('location:customers.php');
}elseif(isset($_POST['cancel'])){
    header('location:customers.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Customers</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

   <style>
      .table-container {
  max-width: 100%;
  overflow-x: auto;
}

.btn.active {
   background-color: black;
   color: white; /* Optional: Change text color for better visibility */
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

<section class="revenue">

   <h1 class="title">CUSTOMERS LIST</h1>

   <a href="register.php" class="btn">Add New</a>
   <br>
   <br>
   <br>

   <div class="table-container">
      <table>
         <thead>
            <tr>
               <th>User ID</th>
               <th>Name</th>
               <th>Email</th>
               <th>Point</th>
               <th>Sales Amount</th>
               <th>Action</th>
            </tr>
         </thead>
         <tbody>
            <?php
                $query = "SELECT * FROM `users` WHERE user_type = 'user' ORDER BY id DESC";
                
                $result = mysqli_query($conn, $query) or die('Query failed');

                if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                echo '<tr>';
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . $row['name'] . '</td>';
                echo '<td>' . $row['email'] . '</td>';
                echo '<td>' . $row['poin'] . '</td>';
                $query2 = mysqli_query($conn, "SELECT SUM(total_price) AS total_price_sum FROM orders WHERE user_id = $id") or die('query failed');

                // Fetch the result
                $roww = mysqli_fetch_assoc($query2);

                // Get the total price sum
                $total_price_sum = $roww['total_price_sum'];

                // Display the total price sum
                echo '<td>Rp. ' . number_format($total_price_sum) . '</td>';
                echo '<td>';
                echo '<a href="customers.php?update=' . $row['id'] . '" class="btn">Edit</a>';
                echo '<a href="customers.php?delete=' . $row['id'] . '" onclick="return confirm(\'Delete this customer?\');" class="btn delete-btn">Delete</a>';
                echo '</td>';
                echo '</tr>';
            }
            } else {
            echo '<tr><td colspan="7" class="empty">No Employees Found</td></tr>';
            } 
            ?>
            
         </tbody>
      </table>
   </div>

</section>

<section class="edit-product-form">

   <?php
      if(isset($_GET['update'])){
         $update_id = $_GET['update'];
         $update_query = mysqli_query($conn, "SELECT * FROM `users` WHERE id = '$update_id'") or die('query failed');
         if(mysqli_num_rows($update_query) > 0){
            while($fetch_update = mysqli_fetch_assoc($update_query)){
   ?>
   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['id']; ?>">
      <input type="text" name="update_name" value="<?php echo $fetch_update['name']; ?>" class="box" required placeholder="enter username">
      <input type="text" name="update_email" value="<?php echo $fetch_update['email']; ?>" class="box" required placeholder="enter user email">
      <input type="number" name="update_point" value="<?php echo $fetch_update['poin']; ?>" min="0" class="box" required placeholder="enter user point">
      <input type="submit" value="update" name="update_user" class="btn">
      <input type="submit" value="cancel" name="cancel" id="close-update" class="option-btn">
   </form>
   <?php
         }
      }
      }else{
         echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
      }
   ?>

</section>
</body>
</html>
