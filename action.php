<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from dynamic inputs
    $vendorName = $_POST['vendor_name'];
    $vendorEmail = $_POST['vendor_email'];
    $vendorAddress = $_POST['vendor_address'];
    $vendorPhone = $_POST['vendor_phone'];
    $buyerName = $_POST['buyer_name'];
    $buyerEmail = $_POST['buyer_email'];
    $buyerAddress = $_POST['buyer_address'];
    $buyerPhone = $_POST['buyer_phone'];
    $purchaseDate = $_POST['purchase_date'];
    $arrival = $_POST['arrival'];
    $terms = $_POST['terms'];
    $productNames = $_POST['product_name'];
    $productPrices = $_POST['product_price'];
    $productQtys = $_POST['product_qty'];
    $grandTotal = $_POST['gtotal'];


    $stmt = $conn->prepare("INSERT INTO purchase (vendor, email, address, phone, buyer, date, arrival, terms, total) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssss", $vendorName, $vendorEmail, $vendorAddress, $vendorPhone, $buyerName, $purchaseDate, $arrival, $terms, $grandTotal);
    $stmt->execute();
    $purchaseId = $stmt->insert_id; // Get the last inserted ID
    $stmt->close();

    // Insert data into purchase_products table
    $stmt = $conn->prepare("INSERT INTO purchase_products (purchase_id, product_name, product_price, product_qty) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isii", $purchaseId, $productName, $productPrice, $productQty);

    // Insert each product into the purchase_products table
    for ($i = 0; $i < count($productNames); $i++) {
        $productName = $productNames[$i];
        $productPrice = $productPrices[$i];
        $productQty = $productQtys[$i];
        $stmt->execute();
    }

    // Close statement
    $stmt->close();

    // Send response back
    echo "Data inserted successfully!";
    echo "<script>alert('Purchase Order Created!');</script>";
    echo "<script>location= 'admin_purchase.php'</script>";
} else {
    echo "Invalid request!";
}
?>
