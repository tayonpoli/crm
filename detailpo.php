<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}
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
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

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
        $query2 = $conn->query("SELECT * FROM purchase WHERE purchase_id='$_GET[id]'");
        $result = $query2->fetch_assoc();
    ?>

   <h1 class="title">PURCHASE ORDER DETAILS</h1>
   <div class="container">
        <div class="row my-4">
            <div class="col-lg-7 mx-auto"> 
                <div class="card shadow">
                    <div class="row card-header">
                        <div class="col">
                            <h4>PO #<?php echo $result['purchase_id'] ?></h4>
                        </div>
                        <div class="d-flex col justify-content-end">
                            <button class="btn btn-secondary me-3"><?php echo $result['bill_status'] ?></button>
                        </div>
                    </div>
                    <div class="card-body p-4">
                                <div class="row mb-3">
                                    <div class="col mb-3">
                                        <h4>Vendor</h4>
                                    </div>
                                    <div class="col mb-3">
                                        <h5><?php echo $result['vendor'] ?></h5>
                                    </div>
                                    <div class="col mb-3">
                                        <h4>Purchase Date</h4>
                                    </div>
                                    <div class="col mb-3">
                                        <h5><?php echo $result['date'] ?></h5>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col mb-3">
                                        <h4>Payment Terms</h4>
                                    </div>
                                    <div class="col mb-3">
                                        <h5><?php echo $result['terms'] ?></h5>
                                    </div>
                                    <div class="col mb-3">
                                        <h4>Expected Arrival</h4>
                                    </div>
                                    <div class="col mb-3">
                                        <h5><?php echo $result['arrival'] ?></h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <hr>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <h4>Product</h4>
                                    </div>
                                    <div class="col mb-3">
                                        <h4>Quantity</h4>
                                    </div>
                                    <div class="col mb-3">
                                        <h4>Unit Price</h4>
                                    </div>
                                    <div class="col mb-3">
                                        <h4>Total Price</h4>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <hr>
                                </div>
                                <?php
                                $query = mysqli_query($conn,"SELECT * FROM purchase_products where purchase_id = '$_GET[id]' "); 
                                $result2 = mysqli_fetch_all($query, MYSQLI_ASSOC);
                                ?>
                                <?php foreach($result2 as $result2) : ?>
                                <div class="row mb-3">
                                    <div class="col mb-3">
                                        <h5><?php echo $result2['product_name'] ?></h5>
                                    </div>
                                    <div class="col mb-3">
                                        <h5><?php echo $result2['product_qty'] ?></h5>
                                    </div>
                                    <div class="col mb-3">
                                        <h5>Rp. <?php echo number_format($result2['product_price']); ?></h5>
                                    </div>
                                    <div class="col mb-3">
                                        <h5>Rp. <?php $price= $result2['product_qty'] * $result2['product_price']; echo number_format($price); ?></h5>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                    </div>
                </div>
                <div class="mt-3">
                <?php if ($result['bill_status'] == 'Not Billed'): ?>
                    <button type="button" class="btn btn-primary fs-5" data-bs-toggle="modal" data-bs-target="#myModal">
                        Register Payment
                    </button>
                <?php endif; ?>
                <div class="d-flex justify-content-end">
                    <a href="invoice.php?id=<?php echo $result['purchase_id'] ?>" class="btn btn-dark me-3 fs-5"><i class="fa-solid fa-print"></i> Document</a>
                    <a href="admin_purchase.php" class="btn btn-secondary rounded fs-5"><i class="fa-solid fa-arrow-left-long"></i> Back</a>
                </div>
                </div>
            </div>
        </div>
    </div>
    
</section>

<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered fs-5"> <!-- modal-lg for large modal -->
    <div class="modal-content">
      <form id="paymentForm" method="post" action="update_payment.php">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Payment Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="purchaseId" id="purchaseIdInput" value="<?php echo $result['purchase_id']; ?>">
          <div class="row">
            <div class="col-md-2">
              <label for="payment_method" class="form-label">Payment Method:</label>
            </div>
            <div class="col-md-4">
              <p>Bank <?php echo $result['bank']; ?></p>
            </div>
            <div class="col-md-3">
              <label for="amount" class="form-label">Amount:</label>
            </div>
            <div class="col-md-3">
              <p>Rp. <?php echo number_format($result['total']); ?></p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-2">
              <label for="bank_account" class="form-label">Bank Account:</label>
            </div>
            <div class="col-md-4">
              <p><?php echo $result['account']; ?></p>
            </div>
            <div class="col-md-3">
              <label for="pay_date" class="form-label">Pay Date:</label>
            </div>
            <div class="col-md-3">
              <p id="paymentDate"></p>
              <input type="hidden" name="paymentDate" id="paymentDateInput">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Register</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
   <script>

    function calculateTotal() {
    var subtotal = 0;
    $(".total").each(function() {
        subtotal += parseFloat($(this).val() || 0);
    });
    var tax = subtotal * 0.1;
    var grandTotal = subtotal + tax;

    // Update subtotal, tax, and grand total fields with custom formatting
    $("input[name='subtotal']").val((subtotal));
    $("input[name='tax']").val((tax));
    $("input[name='gtotal']").val((grandTotal));
}

// Function to format number with commas

// Calculate total price when quantity or price changes
$(document).on('input', '.qty, .price', function() {
    var row = $(this).closest('.row');
    var qty = parseFloat($(row).find('.qty').val());
    var price = parseFloat($(row).find('.price').val());
    var total = qty * price;
    $(row).find('.total').val(total);

    calculateTotal();
});


    $(document).ready(function() {
        $(".add_item_btn").click(function(e) {
            e.preventDefault();
            $("#show_item").prepend(`<div class="row">
                                    <div class="col-md-4 mb-3">
                                        <input type="text" name="product_name[]" class="form-control" placeholder="Item Name" required>
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <input type="number" name="product_qty[]" class="form-control qty" placeholder="Qty" required>
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <input type="number" name="product_price[]" class="form-control price" placeholder="Item Price" required>
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <input type="number" name="product_total[]" readonly class="form-control-plaintext total" placeholder="Total Price">
                                    </div>

                                    <div class="col-md-2 mb-3 d-grid">
                                        <button class="btn btn-danger remove_item_btn">Remove</button>
                                    </div>
                                </div>`);
        });

        $(document).on('click', '.remove_item_btn', function(e) {
          e.preventDefault();
          let row_item = $(this).parent().parent();
          $(row_item).remove();
          calculateTotal();
        });

    });

     // Wait for the DOM content to be fully loaded
     document.addEventListener('DOMContentLoaded', function() {
    // Get the current date
    var currentDate = new Date();
    
    // Format the date as 'YYYY-MM-DD' (assuming this format)
    var formattedDate = currentDate.getFullYear() + '-' + ('0' + (currentDate.getMonth() + 1)).slice(-2) + '-' + ('0' + currentDate.getDate()).slice(-2);
    
    // Set the content of the paymentDate element to the formatted date
    document.getElementById('paymentDate').textContent = formattedDate;
    document.getElementById('paymentDateInput').value = formattedDate;
    });

   </script>
</body>
</html>