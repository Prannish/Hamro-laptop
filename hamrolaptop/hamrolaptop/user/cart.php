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
    $l_id = $_GET['id'];
    $user_id = $_SESSION['id'];
    $query = "SELECT * FROM cart WHERE user_id = '$user_id' AND laptop_id = '$l_id'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        header('Location: buy.php?error=alreadyadded');
    } else {
        $sql = "INSERT INTO cart(user_id, laptop_id) VALUES('$user_id', '$l_id')";
        if (mysqli_query($conn, $sql)) {
           header('Location: viewcart.php');
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

   
    ?>
</body>
</html>