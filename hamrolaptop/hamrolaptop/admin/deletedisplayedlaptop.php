<?php
    include("../connection.php");

    $laptopId = $_GET['id'];
    $sql = "delete from displayed_laptops where l_id=$laptopId";

    $result = mysqli_query($conn, $sql); // returns True if data is inserted
    if ($result) {
      header('Location: viewdisplayedlaptop.php');
    }
?>