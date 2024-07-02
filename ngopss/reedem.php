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

        // Assuming you have the user's ID stored in the session
        $user_id = $_SESSION['login_user'];
        
        // Fetch user points
        $user_query = "SELECT poin FROM users WHERE id = ?";
        $user_stmt = $koneksi->prepare($user_query);
        $user_stmt->bind_param('i', $user_id);
        $user_stmt->execute();
        $user_result = $user_stmt->get_result();

        if ($user_result->num_rows > 0) {
            $user = $user_result->fetch_assoc();
            $user_points = $user['poin'];

            // Assuming the product's point cost is stored in the 'point' field
            $product_points = $row['point'];

            if ($user_points >= $product_points) {
                // Deduct product points from user points
                $new_points = $user_points - $product_points;
                $update_points_query = "UPDATE users SET poin = ? WHERE id = ?";
                $update_points_stmt = $koneksi->prepare($update_points_query);
                $update_points_stmt->bind_param('ii', $new_points, $user_id);
                $update_points_stmt->execute();

                // Check if the product is already in the cart
                if (isset($_SESSION['reedem'][$product_id])) {
                    // If yes, increase the quantity
                    $_SESSION['reedem'][$product_id] += 1;
                } else {
                    // If not, add the product to the cart
                    $_SESSION['reedem'][$product_id] = 1;
                }

                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Ups, your point is not enough']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'User not found']);
        }

        $user_stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Product not found']);
    }

    $stmt->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}

// Close the database connection
$koneksi->close();
?>

