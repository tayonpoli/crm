
<?php
include 'config.php';

$query = "SELECT * FROM `employee`";

// Fetch employees based on the selected department (if specified)
if (isset($_GET['department'])) {
   $department = $_GET['department'];
   $query .= " WHERE department = '$department'";
} 

$query .= " ORDER BY transaction DESC";

$result = mysqli_query($conn, $query) or die('Query failed');

if (mysqli_num_rows($result) > 0) {
   echo '<thead>
            <tr>
               <th>ID</th>
               <th>Name</th>
               <th>Email</th>
               <th>Gender</th>
               <th>Department</th>
               <th>Transaction</th>';
               if (isset($_GET['department'])) {
                            echo '<th>Bonus Incentive (%)</th>';
               }
      echo     '<th>Action</th>
            </tr>
         </thead>';
   while ($row = mysqli_fetch_assoc($result)) {
      echo '<tr>';
      echo '<td>' . $row['employee_id'] . '</td>';
      echo '<td>' . $row['name'] . '</td>';
      echo '<td>' . $row['email'] . '</td>';
      echo '<td>' . $row['gender'] . '</td>';
      echo '<td>' . $row['department'] . '</td>';
      echo '<td>' . $row['transaction'] . '</td>';
      if (isset($_GET['department'])) {
         $transactionCount = $row['transaction'];
         $bonusPercentage = 30;
         $bonusIncentive = ($bonusPercentage / 100) * $transactionCount;
         echo '<td>' . $bonusIncentive . '%</td>';
     }
      echo '<td>';
      echo '<a href="editemp.php?id=' . $row['employee_id'] . '" class="btn">Edit</a>';
      echo '<a href="employee.php?delete=' . $row['employee_id'] . '" onclick="return confirm(\'Delete this employee?\');" class="btn delete-btn">Delete</a>';
      echo '</td>';
      echo '</tr>';
   }
} else {
   echo '<tr><td colspan="7" class="empty">No Employees Found';
    if (isset($_GET['department'])) {
        echo ' for ' . $_GET['department'];
    }
    echo '</td></tr>';
}
?>

