<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}


if(isset($_GET['delete'])){
  $delete_id = $_GET['delete'];
  mysqli_query($conn, "DELETE FROM `employee` WHERE employee_id = '$delete_id'") or die('query failed');
  header('location:employee.php');
}

// if(isset($_POST['update_order'])){

//    $order_update_id = $_POST['order_id'];
//    $update_payment = $_POST['update_payment'];
//    mysqli_query($conn, "UPDATE `orders` SET payment_status = '$update_payment' WHERE id = '$order_update_id'") or die('query failed');
//    $message[] = 'payment status has been updated!';

// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Purchase</title>

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

   <h1 class="title">EMPLOYEE LIST</h1>

   <a href="createemployee.php" class="btn">Add New</a>
   <a href="reset.php" class="delete-btn">Reset</a>
   <br>
   <br>
   <br>

   <h2>Achiever Department: </h2>
   <button class="btn filter-btn <?php echo isset($_GET['department']) && $_GET['department'] === 'Sales' ? 'active' : ''; ?>" data-department="Sales">Sales</button>
<button class="btn filter-btn <?php echo isset($_GET['department']) && $_GET['department'] === 'Purchasing' ? 'active' : ''; ?>" data-department="Purchasing">Purchasing</button>
   <br>
   <br>

   <div class="table-container">
      <table id="employee-table">
         <thead>
            <tr>
               <th>ID</th>
               <th>Name</th>
               <th>Email</th>
               <th>Gender</th>
               <th>Department</th>
               <th>Transaction</th>
               <?php if (isset($_GET['department'])): ?>
                            <th>Bonus Incentive (%)</th>
                        <?php endif; ?>
               <th>Action</th>
            </tr>
         </thead>
         <tbody id="employee-table-body">
            <?php include 'fetch_employee.php'; ?>
            
         </tbody>
      </table>
   </div>

</section>
</body>
<script>
document.addEventListener('DOMContentLoaded', function() {
   const filterButtons = document.querySelectorAll('.filter-btn');
   let currentDepartment = null; // Track current department filter

   filterButtons.forEach(button => {
      button.addEventListener('click', function() {
         const department = this.getAttribute('data-department');

         filterButtons.forEach(btn => {
            if (btn !== this) {
               btn.classList.remove('active');
            }
         });
         this.classList.toggle('active');


         if (department === currentDepartment) {
            // If the same department filter button is clicked again, revert to displaying all employees
            currentDepartment = null;
            fetchEmployeeData(null); // Pass null to fetch all employees
         } else {
            // Otherwise, fetch employees based on the selected department
            currentDepartment = department;
            fetchEmployeeData(department); // Pass department to fetch filtered employees
         }
      });
   });

   // Function to fetch employee data based on department filter
   function fetchEmployeeData(department) {
      let url = 'fetch_employee.php';
      if (department !== null) {
         url += `?department=${department}`;
      }

      fetch(url)
         .then(response => response.text())
         .then(data => {
            // Update table body with fetched employee data
            document.getElementById('employee-table').innerHTML = data;
         })
         .catch(error => {
            console.error('Error fetching employee data:', error);
         });
   }

   // Initial fetch to display all employees on page load
   fetchEmployeeData(null);
});
</script>
