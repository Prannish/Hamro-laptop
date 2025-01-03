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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>orders</title>
    <link rel="website icon" href="logo.jpg" type="h/jpg" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../style.css" />
    <style>
        table {
            border: 1px solid white;
            margin: 30px;
        }
        ;
    </style>
</head>

<body>
    <!--side bar Nav starts here-->
    <label>
        <input type="checkbox" class="checkbox">
        <div class="toggle">
            <span class="top_line common"></span>
            <span class="middle_line common"></span>
            <span class="bottom_line common"></span>
        </div>
        <div class="slide">
            <br><br>
            <ul>
                <li><a href="admindashboard.php"><i class="fas fa-solid fa-house"></i>Home</a></li>
            </ul>
        </div>
    </label>
<!--side bar Nav ends here-->

<!--Nav bar-->
<nav class="navbar">
  <div class="navdiv">
    <div class="logo">

      <a href="admindashboard.php" class="title">Hamro laptop

      </a>
      <a style="margin-left: 190px;"> <img src="logo.jpg" height="30" /></a>
    </div>
    <ul>
      <button><a href="../logout.php">Logout</a></button>
  
    </ul>
  </div>
</nav>
<br />
<!--nav bar ends here-->
        <h1 align="center">All Orders <button><a href="admindashboard.php" style="font-size:30px; color:darkgreen;">X</a></button> </h1>
        <table border="2px">
            <thead>
                <tr>
                    <th scope="col">Order Id</th>
                    <th scope="col">Buyer Name</th>
                    <th scope="col">Laptop Name</th>
                    <th scope="col">Laptop Model</th>
                    <th scope="col">Laptop Specification</th>
                    <th scope="col">Laptop Image</th>
                    <th scope="col">Seller Name</th>
                    <th scope="col">Order date</th>
                    <th scope="col">User Laptop Amount</th>
                    <th scope="col">Commission Generated</th>
                </tr>
            </thead>
            <tbody>
                <?php
             $sql = "
             SELECT 
                 o.order_id,
                 u_buyer.fullname AS buyer_name,
                 l.l_name AS laptop_name,
                 l.l_model AS laptop_model,
                 CONCAT(l.l_processor, ', ', l.l_ram, ', ', l.l_storage, ', ', l.l_display) AS laptop_specification,
                 l.l_image AS laptop_image,
                 l.l_amount AS laptop_amount,
                 u_seller.fullname AS seller_name,
                 o.order_date
             FROM orders o
             LEFT JOIN users u_buyer ON o.buyer_id = u_buyer.id  
             LEFT JOIN users u_seller ON o.seller_id = u_seller.id  
             LEFT JOIN second_hand_laptops l ON o.laptop_id = l.l_id
         ";
                $result = mysqli_query($conn, $sql);


                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $order_id = $row['order_id'];
                        $buyer_name = $row['buyer_name']; 
                        $seller_name = $row['seller_name'];
                       $laptop_name = $row['laptop_name'];
                       $laptop_model = $row['laptop_model'];
                          $laptop_specification = $row['laptop_specification'];
                        $laptop_image = $row['laptop_image'];
                        $order_date = $row['order_date'];

                        $laptop_amount = $row['laptop_amount'];

                        // Display each row
                        echo "
                        <tr>
                            <th scope='row'>$order_id</th>
                            <td>$buyer_name</td>
                            <td>$laptop_name</td>
                            <td>$laptop_model</td>
                            <td>$laptop_specification</td>
                            <td><img src='../second_hand_laptops/$laptop_image' style='width: 100px; height: auto;'></td>
                            <td>$seller_name</td>
                            <td>$order_date</td>
                            <td>$laptop_amount</td>
                            <td>".$laptop_amount*0.05."</td>
                        </tr>
                        ";
                    }
                } else {
                    echo "<tr><td colspan='6'>No orders found.</td></tr>";
                }

                // Close the connection
                mysqli_close($conn);
                ?>
            </tbody>
        </table>
    
</body>

</html>