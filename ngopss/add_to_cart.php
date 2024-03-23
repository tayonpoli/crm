<?php
session_start();

// Include your database connection file
include('koneksi.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    // Fetch product details from the database based on product_id
    $product_query = "SELECT * FROM products WHERE id = ?";
    
    // Use prepared statements to prevent SQL injection
    $stmt = $koneksi->prepare($product_query);
    $stmt->bind_param('i', $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();


        // Check if the product is already in the cart
        if (isset($_SESSION['pesanan'][$product_id])) {
            // If yes, increase the quantity
            $_SESSION['pesanan'][$product_id]+=1;
        } else {
            // If not, add the product to the cart
            $_SESSION['pesanan'][$product_id]=1;
        }


    $stmt->close();
} else {
    // Handle invalid or missing data in the AJAX request
    echo 'Error: Invalid request.';
}
}

// Close the database connection
$koneksi->close();
?>