<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}


if(isset($_GET['delete'])){
  $delete_id = $_GET['delete'];
  mysqli_query($conn, "DELETE FROM `vouchers` WHERE id = '$delete_id'") or die('query failed');
  header('location:admin_voucher.php');
}

if(isset($_POST['update_voucher'])){

    $update_p_id = $_POST['update_p_id'];
    $update_title = $_POST['update_title'];
    $update_discount = $_POST['update_discount'] / 100;
    $update_description = $_POST['update_description'];
 
    mysqli_query($conn, "UPDATE `vouchers` SET title = '$update_title', discount = '$update_discount', description = '$update_description' WHERE id = '$update_p_id'") or die('query failed');

    header('location:admin_voucher.php');
}elseif(isset($_POST['cancel'])){
    header('location:admin_voucher.php');
}

if(isset($_POST['create_voucher'])){

    $create_id = $_POST['id'];
    $create_title = $_POST['title'];
    $create_discount = $_POST['discount'] / 100;
    $create_description = $_POST['description'];
 
    mysqli_query($conn, "INSERT INTO vouchers (id, title, discount, description)
              VALUES ('$create_id', '$create_title', '$create_discount', '$create_description')") or die('query failed');

    header('location:admin_voucher.php');
}elseif(isset($_POST['cancel'])){
    header('location:admin_voucher.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Discount</title>

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

   <h1 class="title">VOUCHER LIST</h1>

   <a href="#" id="add-new-btn" class="btn">Add New</a>
   <br>
   <br>
   <br>

   <div class="table-container">
      <table>
         <thead>
            <tr>
               <th>voucher ID</th>
               <th>Title</th>
               <th>Discount</th>
               <th>Description</th>
               <th>Action</th>
            </tr>
         </thead>
         <tbody>
            <?php
                $query = "SELECT * FROM `vouchers` ORDER BY id DESC";
                
                $result = mysqli_query($conn, $query) or die('Query failed');

                if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                $discount = $row['discount'] * 100;
                echo '<tr>';
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . $row['title'] . '</td>';
                echo '<td>' . $discount . '%</td>';
                echo '<td>' . $row['description'] . '</td>';
                echo '<td>';
                echo '<a href="admin_voucher.php?update=' . $row['id'] . '" class="btn">Edit</a>';
                echo '<a href="admin_voucher.php?delete=' . $row['id'] . '" onclick="return confirm(\'Delete this voucher?\');" class="btn delete-btn">Delete</a>';
                echo '</td>';
                echo '</tr>';
            }
            } else {
            echo '<tr><td colspan="7" class="empty">No Vouchers Found</td></tr>';
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
         $update_query = mysqli_query($conn, "SELECT * FROM `vouchers` WHERE id = '$update_id'") or die('query failed');
         if(mysqli_num_rows($update_query) > 0){
            while($fetch_update = mysqli_fetch_assoc($update_query)){
   ?>
   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['id']; ?>">
      <input type="text" name="update_title" value="<?php echo $fetch_update['title']; ?>" class="box" required placeholder="enter title">
      <input type="number" name="update_discount" value="<?php echo $fetch_update['discount'] * 100; ?>" class="box" required placeholder="enter voucher discount">
      <input type="text" name="update_description" value="<?php echo $fetch_update['description']; ?>" min="0" class="box" required placeholder="enter description">
      <input type="submit" value="update" name="update_voucher" class="btn">
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

<section class="add-product-form">


   <form action="" method="post" enctype="multipart/form-data">
      <input type="text" name="id" class="box" placeholder="enter voucher id">
      <input type="text" name="title" class="box" required placeholder="enter title">
      <input type="number" name="discount" min="0" class="box" required placeholder="enter voucher discount">
      <input type="text" name="description" class="box" required placeholder="enter description">
      <input type="submit" value="Create" name="create_voucher" class="btn">
      <input type="submit" value="Cancel" name="cancel" id="close-update" class="option-btn">
   </form>


</section>
</body>
<script>
    document.getElementById('add-new-btn').addEventListener('click', function(event) {
            event.preventDefault();
            document.querySelector('.add-product-form').style.display = 'flex';
        });

    document.getElementById('close-update').addEventListener('click', function(event) {
         event.preventDefault();
         document.querySelector('.add-product-form').style.display = 'none';
      });
</script>
</html>
