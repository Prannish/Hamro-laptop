<?php
include "../connection.php";
session_start();
$id = $_GET['id'];
$sql = "delete from second_hand_laptops where l_id=$id";
$result = mysqli_query($conn, $sql);
if ($result) {
    header("Location: viewsales.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

?>