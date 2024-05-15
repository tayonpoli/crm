<?php
// Include the config.php file to establish database connection
include 'config.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve payment date, purchase ID, and paymentDate from the form submission
    $purchaseId = $_POST['purchaseId'];
    $paymentDate = $_POST['paymentDate'];

    $query = mysqli_query($conn, "SELECT * FROM `purchase` where purchase_id = '$purchaseId'") or die('query failed');
    $result = mysqli_fetch_assoc($query);
    $pic = $result['buyer'];
    $amount = $result['total'];
    $payment = $result['bank'];
    $vendor = $result['vendor'];

    // Update payment details in the database
    try {
        // Update billing status to 'Fully Billed'
        $updateBillingQuery = "UPDATE purchase SET bill_status = 'Fully Billed' WHERE purchase_id = '$purchaseId'";
        $conn->query($updateBillingQuery);
        
        // Update payment date
        $updatePaymentQuery = "UPDATE purchase SET payment_date = '$paymentDate' WHERE purchase_id = '$purchaseId'";
        $conn->query($updatePaymentQuery);

        $updateEmployeeQuery = "UPDATE employee SET transaction = transaction + 1 WHERE name = '$pic'";
        $conn->query($updateEmployeeQuery);

        $insertQuery = "INSERT INTO expenditures (date, categories, pic, amount, payment_method, invoice, recipient, description) 
        VALUES ('$paymentDate', 'Raw Material', '$pic', '$amount', '$payment', '$purchaseId', '$vendor', '-')";
        $conn->query($insertQuery);
        
        header("Location: admin_purchase.php");
        exit();
    } catch (Exception $e) {
        // Output error message
        echo 'Error: ' . $e->getMessage();
    }
} else {
    // If the form is not submitted, redirect or display an error message
    echo 'Error: Form not submitted.';
}
?>
