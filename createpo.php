<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

if(isset($_POST['add_btn'])){
    $vendorName = mysqli_real_escape_string($conn, $_POST['vendor_name']);
    $vendorEmail = mysqli_real_escape_string($conn, $_POST['vendor_email']);
    $vendorAddress = mysqli_real_escape_string($conn, $_POST['vendor_address']);
    $vendorPhone = mysqli_real_escape_string($conn, $_POST['vendor_phone']);
    $buyerName = mysqli_real_escape_string($conn, $_POST['buyer_name']);
    $buyerEmail = $_POST['buyer_email'];
    $buyerAddress = $_POST['buyer_address'];
    $buyerPhone = $_POST['buyer_phone'];
    $purchaseDate = $_POST['purchase_date'];
    $arrival = $_POST['arrival'];
    $terms = $_POST['terms'];
    $bank = $_POST['bank'];
    $accnumber = $_POST['accnumber'];
    $accname = $_POST['accname'];
    $account = $accnumber . ' - ' . $accname;
    $productNames = $_POST['product_name'];
    $productPrices = $_POST['product_price'];
    $productQtys = $_POST['product_qty'];
    $grandTotal = $_POST['gtotal'];

         mysqli_query($conn, "INSERT INTO `purchase`(vendor, email, address, phone, buyer, date, arrival, terms, total, bank, account) VALUES('$vendorName', '$vendorEmail', '$vendorAddress', '$vendorPhone', '$buyerName', '$purchaseDate', '$arrival', '$terms', '$grandTotal', '$bank', '$account')") or die('query failed');
         $purchaseId = $conn->insert_id;

         for ($i = 0; $i < count($productNames); $i++) {
            $productName = $productNames[$i];
            $productPrice = $productPrices[$i];
            $productQty = $productQtys[$i];
            mysqli_query($conn, "INSERT INTO purchase_products (purchase_id, product_name, product_price, product_qty) VALUES('$purchaseId', '$productName', '$productPrice', '$productQty') ");
        }
      
         // Dialihkan ke halaman nota
         echo "<script>alert('Purchase Order Created!');</script>";
         echo "<script>location= 'admin_purchase.php'</script>";
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

   <h1 class="title">NEW PURCHASE ORDER</h1>
   <form action="#" method="POST" id="add_form">
   <div class="container">
        <div class="row my-4">
            <div class="col-lg-10 mx-auto"> 
                <div class="card shadow">
                    <div class="card-header">
                        <h4>Vendor Details</h4>
                    </div>
                    <div class="card-body p-4">
                                <div class="row">
                                    <div class="col mb-3">
                                        <input type="text" name="vendor_name" class="form-control" placeholder="Vendor Name" required>
                                    </div>
                                    <div class="col mb-3">
                                        <input type="text" name="vendor_email" class="form-control" placeholder="Vendor Email" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <input type="text" name="vendor_address" class="form-control" placeholder="Vendor Address" required>
                                    </div>
                                    <div class="col mb-3">
                                        <input type="text" name="vendor_phone" class="form-control" placeholder="Phone Number" required>
                                    </div>
                                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row my-4">
            <div class="col-lg-10 mx-auto"> 
                <div class="card shadow">
                    <div class="card-header">
                        <h4>Buyer Details</h4>
                    </div>
                    <div class="card-body p-4">
                                <div class="row">
                                    <div class="col mb-3">
                                        <input type="text" name="buyer_name" class="form-control" placeholder="Buyer Name" required>
                                    </div>
                                    <div class="col mb-3">
                                        <input type="text" name="buyer_email" class="form-control" placeholder="Buyer Email" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <input type="text" name="buyer_address" class="form-control" placeholder="Buyer Address" required>
                                    </div>
                                    <div class="col mb-3">
                                        <input type="text" name="buyer_phone" class="form-control" placeholder="Phone Number" required>
                                    </div>
                                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row my-4">
            <div class="col-lg-10 mx-auto"> 
                <div class="card shadow">
                    <div class="card-header">
                        <h4>Payment & Terms</h4>
                    </div>
                    <div class="card-body p-4">
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="pdate">Purchase Date</label>
                                        <input type="date" name="purchase_date" id="pdate" class="form-control" required>
                                    </div>
                                    <div class="col mb-3">
                                        <label for="arrival">Expected Arrival</label>
                                        <input type="date" class="form-control" name="arrival" id="arrival" required>
                                    </div>
                                    <div class="col mb-3">
                                        <label for="terms">Payment Terms</label>
                                        <input type="number" name="terms" id="terms" class="form-control" placeholder="(Days)" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="pdate">Bank</label>
                                        <input type="text" name="bank" class="form-control" placeholder="e.g Mandiri" required>
                                    </div>
                                    <div class="col mb-3">
                                        <label for="pdate">Account Number</label>
                                        <input type="text" name="accnumber" class="form-control" placeholder="e.g 56812313" required>
                                    </div>
                                    <div class="col mb-3">
                                        <label for="terms">Account Name</label>
                                        <input type="text" name="accname" class="form-control" placeholder="e.g John Doe" required>
                                    </div>
                                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row my-4">
            <div class="col-lg-10 mx-auto"> 
                <div class="card shadow">
                    <div class="card-header">
                        <h4>Products</h4>
                    </div>
                    <div class="card-body p-4">
                            <div id="show_item">
                                <div class="row mb-3">
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
                                        <button class="btn btn-success add_item_btn">Add More</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <input type="text" readonly name="sub" class="form-control-plaintext" value="Subtotal">
                                    </div>
                                    <div class="col-md-1 mb-3">
                                        <input type="text" readonly class="form-control-plaintext" value="Rp.">
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <input type="text" readonly name="subtotal" class="form-control-plaintext" value="00">
                                    </div>
                            </div>
                            <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <input type="text" readonly class="form-control-plaintext" value="Tax">
                                    </div>
                                    <div class="col-md-1 mb-3">
                                        <input type="text" readonly class="form-control-plaintext" value="Rp.">
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <input type="text" readonly name="tax" class="form-control-plaintext" value="00">
                                    </div>
                            </div>
                            <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <input type="text" readonly class="form-control-plaintext" value="Grand Total">
                                    </div>
                                    <div class="col-md-1 mb-3">
                                        <input type="text" readonly class="form-control-plaintext" value="Rp.">
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <input type="text" readonly name="gtotal" class="form-control-plaintext" value="00">
                                    </div>
                            </div>
                            <div>
                                <a href="admin_purchase.php" class="btn btn-secondary me-3 w-25">Cancel</a>
                                <input type="submit" value="Place Order" class="btn btn-dark w-25" name="add_btn" id="add_btn">
                            </div>
                    </div>
                </div>
            </div>
        </div>
   </div>
   </form>
</section>
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
   </script>
</body>
</html>