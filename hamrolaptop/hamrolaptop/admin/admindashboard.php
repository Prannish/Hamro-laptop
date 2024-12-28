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
    <title>Hamro _Laptop_admin_dashboard</title>
    <link rel="website icon" href="logo.jpg" type="h/jpg" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../style.css" />
    <style>
        table{
            border:1px solid white;
            margin: 30px;
        }  
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

                <li><a href="adminprofile.php"><i class="fa-solid fa-user"></i>Admin Profile</a></li>
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

    <main>
        <!--body part starts-->

        <h1 align="center">Manage Details</h1>
        <table border="1">
        <tr>
        <td><button><a href="viewuploadlaptop.php" >View User Uploaded Laptops</a></button></td>
       <td><button><a href="insertdisplayedlaptop.php">Insert displayed Laptops</a></button></td>
       <td><button><a href="viewdisplayedlaptop.php" >View displayed Laptops</a></button></td>
       <td><button><a href="insertbudgetlaptop.php" >Insert budget Laptops</a></button></td>
       <td><button><a href="viewbudgetlaptop.php">View budget Laptops</a></button></td>
       <td><button><a href="orders.php" >All orders</a></button></td>
       <td><button><a href="payment.php" >All Payments</a></button></td>
       <td><button><a href="listuser.php" >List Users</a></button></td>
        </tr>
        </table>

       

        <!--body part ends-->

    </main>


    <script src="../script.js"></script>
</body>

</html>