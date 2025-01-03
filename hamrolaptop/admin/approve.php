<?php
include "../connection.php";
session_start();
if (!isset($_SESSION['name'])) {
  header("location: ../login.php");
  exit();
}


$id = $_GET['id'];
$sql = "update second_hand_laptops set approval_status='approved' where l_id=$id";
$result = mysqli_query($conn, $sql);
if ($result) {
    header("Location: viewuploadlaptop.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}


?>