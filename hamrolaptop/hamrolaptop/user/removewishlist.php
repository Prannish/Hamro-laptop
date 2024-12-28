<?php
    include("../connection.php");

    $wishlistId = $_GET['id'];
    $sql = "delete from wishlist where wishlist_id=$wishlistId";

    $result = mysqli_query($conn, $sql); // returns True if data is inserted
    if ($result) {
      header('Location: viewwishlist.php');
    }
?>