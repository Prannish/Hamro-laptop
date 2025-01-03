<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include database connection file
include_once '../connection.php';

// Check if the id is set in the URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    // Prepare the SQL statement to delete the laptop with the specific id
    $sql = "DELETE FROM second_hand_laptops WHERE l_id = ?";

    // Initialize the prepared statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind the id parameter to the prepared statement
        $stmt->bind_param("i", $id);

        // Execute the prepared statement
        if ($stmt->execute()) {
            // Redirect to viewsales.php after successful deletion
            header("Location: viewsales.php");
            exit();
        } else {
            echo "Error executing statement: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    echo "Error: Invalid or missing ID parameter in the URL.";
}
?>
