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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css
"
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
      <a style="margin-left: 190px; "> <img src="logo.jpg" height="30" /></a>
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
                    <th scope="col">Profile Picture</th>
                    <th scope="col">Joined Date</th>
                    <th scope="col">User Type</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT id, fullname,user_type,created_at, image  FROM users";
                $result = mysqli_query($conn, $sql);

                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['id'];
                        $username = $row['fullname'];
                        $usertype = $row['user_type'];
                        $imageurl = $row['image'];
                        $joindate = $row['created_at']; 
                        // Display each row
                        if($usertype == 'user'){
                            $buttons = "<a href='delete_user.php?id=$id' class='colordelete' onclick='return confirmDelete()'>Delete</a>
                            <a href='update_user_admin.php?id=$id' class='colorupdate' onclick='return confirmAdmin()'>Make Admin</a>";
                        }else{
                            $buttons = "<a href='delete_user.php?id=$id' class='colordelete' onclick='return confirmDelete()'>Delete</a>";
                        }
                        echo "
                        <tr>
                            <th scope='row'>$id</th>
                            <td><a href='usersprofile.php?user_id=$id'>$username</td>
                            <td><img src='../$imageurl' alt='Image' style='width: 100px; height: 100px; object-fit: cover;'></td>
                            <td>$joindate</td>
                            <td>$usertype</td>
                            

                            <td>
                             $buttons
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

            
            function confirmAdmin() {
                return confirm("Are you sure you want to make this user an admin?");
            };
        </script>
</body>

</html>