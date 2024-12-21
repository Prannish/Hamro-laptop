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
            width: 95%;
            border-collapse: collapse;
            margin-top: 20px;
            margin-bottom: 20px;
            margin-right: 30px;
            margin-left: 30px;
            font-size: 18px;
            text-align: left;

        }
        table th, table td {
    padding: 12px 15px;
    border: 1px solid #ddd;
}

table tr:hover {
    background-color: rgb(4, 33, 36);
}

table a {
    color: white;
    text-decoration: none;
    padding: 10px 20px;
    display: inline-block;
    margin-right: 10px;
    border-radius: 4px;
    transition: background-color 0.3s ease;
}

.colorupdate {
    background-color: blue;
    border: 2px solid blue;
    padding: 10px;
    margin-right: 10px;
    margin-bottom: 10px;
    transition: background-color 0.3s ease;
}

.colorupdate:hover {
    background-color: darkblue;
}

.colordelete {
    background-color: red;
    border: 2px solid red;
    padding: 10px ;
    
    margin-right: 10px;
   
    transition: background-color 0.3s ease;
}

.colordelete:hover {
    background-color: darkred;
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
                <button><a href="../logout.php">Logout</a></button>

            </ul>
        </div>
    </nav>
    <br />
    <!--nav bar ends here-->
        <h1 align="center">List Users <button><a href="admindashboard.php" style="font-size:30px; color:darkgreen;">X</a></button> </h1>
        <table border="2px">
          
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">User Name</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT id, fullname FROM users;";
                $result = mysqli_query($conn, $sql);

                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['id'];
                        $username = $row['fullname'];

                        // Display each row
                        echo "
                        <tr>
                            <th scope='row'>$id</th>
                            <td>$username</td>
                            <td>
                                <a href='delete_user.php?id=$id' class='colordelete' onclick='return confirmDelete()'>Delete</a>
                            </td>
                        </tr>
                        ";
                    }
                } else {
                    echo "<tr><td colspan='3'>No users found.</td></tr>";
                }

                // Close the connection
                mysqli_close($conn);
                ?>
            </tbody>
            <tbody>
                
            </tbody>
        </table>
        <script>
            function confirmDelete() {
                return confirm("Are you sure you want to delete this user?");
            };
        </script>
</body>

</html>