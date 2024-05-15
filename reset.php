<?php
// Include the database configuration file
include 'config.php'; // Update this with your database connection setup

// Define the query to reset or update column data
$query = "UPDATE employee SET transaction = 0";

// Execute the query
if ($conn->query($query) === TRUE) {
    header('location:employee.php');
} else {
    echo "Error resetting column data: " . $conn->error;
}

// Close the database connection
$conn->close();
?>