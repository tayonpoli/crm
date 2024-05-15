<?php
include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location: login.php');
    exit; // Stop further execution
}

if (isset($_POST['add_btn'])) {
    // Escape and retrieve form data
    
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $department = mysqli_real_escape_string($conn, $_POST['department']);
    $transaction = $_POST['transaction'];
    $ID = $_POST['ID'];
    
    // Insert data into expenditures table
    $query = "UPDATE employee SET name='$name', email='$email', gender='$gender', department='$department', transaction='$transaction' WHERE employee_id=$ID";
    
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Employee Data Updated!');</script>";
         echo "<script>location= 'employee.php'</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Employee</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="css/admin_style.css">

   <!-- custom admin css file link  -->
<style>
    @import url('https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600&display=swap');

:root{
   --purple:#747264;
   --red:#c0392b;
   --orange:#f39c12;
   --black:#333;
   --white:#fff;
   --light-color:#666;
   --light-white:#ccc;
   --light-bg:#f5f5f5;
   --border:.1rem solid var(--black);
   --box-shadow:0 .5rem 1rem rgba(0,0,0,.1);
}

html{
   font-size: 70%;
   overflow-x: hidden;
}

body{
   background-color: var(--light-bg);
}

*{
   font-family: 'Rubik', sans-serif;
   margin:0; padding:0;
   box-sizing: border-box;
   outline: none; border:none;
   text-decoration: none;
   transition:all .2s linear;
}

.title{
   text-align: center;
   margin-bottom: 2rem;
   text-transform: uppercase;
   color:var(--black);
   font-size: 4rem;
}

.header{
   position: sticky;
   top:0; left:0; right:0;
   z-index: 1000;
   background-color: var(--white);
   box-shadow: var(--box-shadow);
}

.header .flex{
   display: flex;
   align-items: center;
   padding:2rem;
   justify-content: space-between;
   position: relative;
   max-width: 1200px;
   margin:0 auto;
}
 
.header .flex .logo{
   font-size: 2.5rem;
   color:var(--black);
}

.header .flex .logo span{
   color:var(--purple);
}

.header .flex .navbar a{
   margin:0 1rem;
   font-size: 2rem;
   color:var(--black);
}

.header .flex .navbar a:hover{
   color:var(--purple);
}

.header .flex .icons div{
   margin-left: 1.5rem;
   font-size: 2.5rem;
   cursor: pointer;
   color:var(--black);
}

.header .flex .icons div:hover{
   color:var(--purple);
}

.header .flex .account-box{
   position: absolute;
   top:120%; right:2rem;
   width: 30rem;
   box-shadow: var(--box-shadow);
   border-radius: .5rem;
   padding:2rem;
   text-align: center;
   border-radius: .5rem;
   border:var(--border);
   background-color: var(--white);
   display: none;
   animation:fadeIn .2s linear;
}

.header .flex .account-box.active{
   display: inline-block;
}

.header .flex .account-box p{
   font-size: 2rem;
   color:var(--light-color);
   margin-bottom: 1.5rem;
}

.header .flex .account-box p span{
   color:var(--purple);
}

.header .flex .account-box .delete-btn{
   margin-top: 0;
}

.header .flex .account-box div{
   margin-top: 1.5rem;
   font-size: 2rem;
   color:var(--light-color);
}

.header .flex .account-box div a{
   color:var(--orange);
}

.header .flex .account-box div a:hover{
   text-decoration: underline;
}
</style>
</head>
<body>

<?php include 'admin_header.php'; ?>

<section class="revenue">
<?php
        $query2 = $conn->query("SELECT * FROM employee WHERE employee_id='$_GET[id]'");
        $result = $query2->fetch_assoc();
    ?>
   <h1 class="title">Edit EMPLOYEE DATA</h1>
   <form action="#" method="POST" id="add_form">
      <div class="container">
         <div class="row my-4">
            <div class="col-lg-10 mx-auto"> 
               <div class="card shadow">
                  <div class="card-header">
                     <h4>Edit Employee Data</h4>
                  </div>
                  <div class="card-body p-4">
                    <div class="column">
                    <div class="col mb-3">
                            <label for="name">Name Employee</label>
                            <input type="text" name="name" id="name" class="form-control" value=<?php echo $result['name'];?> required>
                            <input type="hidden" name="ID" value=<?php echo $_GET['id'];?>>
                    </div>
                    <div class="col mb-3">
                            <label for="email">Email</label>
                            <input type="text" name="email" id="email" class="form-control" value=<?php echo $result['email'];?> required>
                    </div>
                    <div class="col mb-3">
                            <label for="gender">Gender</label>
                            <select name="gender" id="gender" class="form-control" value=<?php echo $result['gender'];?> required>
                              <option value="Male">Male</option>
                              <option value="Female">Female</option>
                              </select>
                    </div>
                    <div class="col mb-3">
                            <label for="department">Department</label>
                           <select name="department" id="department" class="form-control" value=<?php echo $result['department'];?> required>
                           <option value="Sales">Sales</option>
                           <option value="Purchasing">Purchasing</option>
                           <option value="Expenditure">Expenditure</option>
                           <option value="Human Resources">Human Resources</option>
                           </select>
                   </div>
                   <div class="col mb-3">
                            <label for="transaction">Transaction</label>
                            <input type="number" name="transaction" id="transaction" class="form-control" value=<?php echo $result['transaction'];?> required>
                    </div>

                     </div>
                  </div>
               </div>
            </div>
         </div>

         <!-- Buyer Details Card -->
         <!-- Repeat a similar structure for Buyer Details -->

         <!-- Requirements Card -->
         <!-- Repeat a similar structure for Requirements -->

         <!-- Products Card -->
         <!-- Repeat a similar structure for Products -->
         <!-- You can use the dynamic addition of product rows as you implemented -->

         <div>
            <a href="employee.php" style="background-color: black" class="btn btn-secondary me-3 w-25">Cancel</a>
         <input type="submit" style="background-color: #747264" value="Update" class="btn btn-dark w-25" name="add_btn" id="add_btn">
      </div>
   </form>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
   // Your JavaScript scripts and functions
</script>

</body>
</html>