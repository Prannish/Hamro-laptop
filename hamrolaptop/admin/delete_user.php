<?php
include('../connection.php');
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Prepare the SQL statement
    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);

    // Execute the statement
    if ($stmt->execute()) {
        header('Location: listuser.php');
        
    } else {
        echo "Error deleting user: " . $conn->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "No user ID provided.";
}
?>