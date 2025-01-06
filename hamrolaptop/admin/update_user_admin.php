<?php
include "../connection.php";
session_start();
if (!isset($_SESSION['name'])) {
  header("location: ../login.php");
  exit();
}


if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Prepare the SQL statement
    $sql = "UPDATE users SET user_type = 'admin' WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);

    // Execute the statement
    if ($stmt->execute()) {
        header('Location: listuser.php');
        
    } else {
        echo "Error making user admin: " . $conn->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "No user ID provided.";
}
?>