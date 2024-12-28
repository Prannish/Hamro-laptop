<?php
    include("../connection.php");

    $cartId = $_GET['id'];
    $sql = "delete from cart where cart_id=$cartId";

    $result = mysqli_query($conn, $sql); // returns True if data is inserted
    if ($result) {
      header('Location: viewcart.php');
    }
?>