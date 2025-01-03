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