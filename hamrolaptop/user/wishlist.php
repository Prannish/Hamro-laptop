<?php
include "../connection.php";
session_start();
if (!isset($_SESSION['name'])) {
  header("location: ../login.php");
  exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    if(isset($_GET['bid'])){
        $bl_id = $_GET['bid'];
        $user_id = $_SESSION['id'];
    $query = "SELECT * FROM wishlist WHERE user_id = '$user_id' AND blaptop_id = '$bl_id'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        header('Location: budget.php?error=alreadyadded');
    } else {
        $sql = "INSERT INTO wishlist(user_id, blaptop_id) VALUES('$user_id', '$bl_id')";
        if (mysqli_query($conn, $sql)) {
           header('Location: viewwishlist.php');
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    }


    if(isset($_GET['did'])){
        $dl_id = $_GET['did'];
        $user_id = $_SESSION['id'];
    $query = "SELECT * FROM wishlist WHERE user_id = '$user_id' AND dlaptop_id = '$dl_id'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        header('Location: index.php?error=alreadyadded');
    } else {
        $sql = "INSERT INTO wishlist(user_id, dlaptop_id) VALUES('$user_id', '$dl_id')";
        if (mysqli_query($conn, $sql)) {
           header('Location: viewwishlist.php');
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    }
  

   
    ?>
</body>
</html>