<?php
session_start();
include("../connection.php");
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
                <li><a href="../index.html"><i class="fas fa-solid fa-house"></i>Home</a></li>
                <li><a href="../event.php"><i class="fab fa-gripfire"></i>Events</a></li>
                <li><a href="../budget.php"><i class="fa-solid fa-laptop-code"></i>Budget Laptops</a></li>
                <li><a href="../userdashboard.php"><i class="fa-solid fa-laptop"></i>Second-hand Laptops</a></li>
                <div class="../gapbuysell">

                    <li><a href="buy.php"><i class="fa-solid fa-cart-plus"></i>Buy</a></li>
                    <li><a href="sell.php"><i class="fa-solid fa-sack-dollar"></i></i>Sell</a></li>
                </div>

                <li><a href="profile.php"><i class="fa-solid fa-user"></i>Your Profile</a></li>
                <li><a href="about.html"><i class="fa-solid fa-info"></i>About</a></li>
            </ul>
        </div>
    </label>
    <!--side bar Nav ends here-->

    <!--Nav bar-->
    <nav class="navbar">
        <div class="navdiv">
            <div class="logo">

                <a href="index.html" class="title">Hamro laptop

                </a>
                <a style="margin-left: 190px;"> <img src="logo.jpg" height="30" /></a>
            </div>
            <ul>
                <button><a href="logout.php">Logout</a></button>
                <button><a id="mode">Switch Theme</a></button>
            </ul>
        </div>
    </nav>
    <br />
    <!--nav bar ends here-->
        <h1 align="center">All Payments <button><a href="admindashboard.php" style="font-size:30px; color:darkgreen;">X</a></button> </h1>
        <table border="2px">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">User Name</th>
                    <th scope="col">Laptop Name</th>
                    <th scope="col">order date</th>
                    <th scope="col">Amount</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT posts.id,posts.title,posts.description,posts.image_url, users.full_name as created_by FROM posts INNER join users on posts.userid=users.id;";
                $result = mysqli_query($conn, $sql);

                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['id'];
                        $l_name = $row['l_name']; 
                        $l_model = $row['l_model'];
                        $l_specification = $row['l_specification'];
                        $l_amount = $row['l_amount'];
                        $l_image = $row['l_image'];
                        $l_uploaddate = $row['l_uploaddate'];

                        // Display each row
                        echo "
                        <tr>
                            <th scope='row'>$id</th>
                            <td>$l_name</td>
                            <td>$l_model</td>
                            <td>$l_specification</td>
                            <td>$l_amount</td>
                            <td><img src='$l_image'></td>
                            <td>$l_uploaddate</td>
                            <td>
                                <a href='update_blog.php?id=$id'>Update</a>
                                <a href='delete_blog.php?id=$id'>Delete</a>
                            </td>
                        </tr>
                        ";
                    }
                } else {
                    echo "<tr><td colspan='6'>No blog entries found.</td></tr>";
                }

                // Close the connection
                mysqli_close($conn);
                ?>
            </tbody>
        </table>
    
</body>

</html>