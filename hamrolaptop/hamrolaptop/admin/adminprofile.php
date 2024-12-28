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
    <title>Hamro _Laptop_home_page</title>
    <link rel="website icon" href="logo.jpg" type="h/jpg" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../style.css" />
    <style>
        
/*your profile section starts*/


.card {
  text-align: center;
  background-color: #4075c8;
  border-radius: 10px;
  padding: 5px;
  height: 65vmin;
  margin-left: 50px;
  margin-right: 50px;
  margin-bottom: 30px;
}

.profile-header {

  align-items: center;
  margin-bottom: 20px;
  text-align: center;
}


.profile-avatar {
  width: 100px;
  height: 100px;
  border-radius: 50%;
  margin-right: 20px;
}

.profile-info h1 {
  margin: 0;
  font-size: 24px;
}

#ppImage{
  width: 100px;
  height: 100px;
  border-radius: 50%;
  object-fit: cover;
}

.profile-info p {
  margin: 5px 0;
  color: var(--text-muted);
}

.profile-content {
  
  grid-template-columns: 1fr 1fr;
  gap: 20px;
}

.stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
  gap: 10px;
}

.stat-item {
  background-color: var(--background-color);
  padding: 10px;
  border-radius: var(--border-radius);
  text-align: center;
}

.stat-value {
  font-size: 24px;
  font-weight: bold;
  margin-bottom: 5px;
  color:purple;
}

.stat-label {
  font-size: 14px;
  color: var(--text-muted);
}

.quick-actions {
  margin-top: 20px;
}

.buttons {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .button {
            flex: 1;
            min-width: 150px;
            padding: 0.75rem 1.5rem;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            text-align: center;
            margin-left: 650px;
        }

        .button-primary {
            background: #1789fc;
            color: white;
            border: none;
        }

        .button-primary:hover {
            background: #0d68d6;
        }

        .button-logout {
            background:rgb(231, 4, 15);
            color: white;
            border: none;
       
          max-width: 100px;
         

        }

        .button-logout:hover {
            background:rgb(246, 61, 4);
        }
.recent-activity {
  list-style-type: none;
  padding: 0;
  color: #0a0d0c;
}

.activity-item {
  background-color: var(--background-color);
  padding: 10px;
  border-radius: var(--border-radius);
  margin-bottom: 10px;
}

.activity-item h4 {
  margin: 0 0 5px 0;
}

.activity-item p {
  margin: 0;
  font-size: 14px;
  color: var(--text-muted);
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
<?php
$id = $_SESSION['id'];

$sql = "SELECT date(created_at) as created_at FROM users WHERE id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$created_at = $row['created_at'];
$imageUrl = $_SESSION['imageUrl'];




?>

<!--your profile section starts-->

  <div class="card">
    <h1 style="color:lightgreen;">Admin Profile</h1>
    <br>
    <div class="profile-header">
      <div class="profile-info">
        <?php
        echo "<img src='../$imageUrl' id='ppImage' alt='users profile picture'>";
        ?>
      
        <h1><?php echo $_SESSION['name']; ?></h1>
        <p>Phone: <?php echo $_SESSION['phone'];?></p>
        <p>Admin since <?php echo $created_at ?></p>
      </div>
    </div>
    <div class="profile-content">
      <div class="account-overview">
        <h1 style="color:lightgreen;">Account Overview</h1>
        <br>
        <div class="stats-grid">
          <div class="stat-item">
            <div class="stat-value">#</div>
            <div class="stat-label">No of users</div>
          </div>
        
          <div class="stat-item">
            <div class="stat-value">#</div>
            <div class="stat-label">No of Orders</div>
          </div>
          <div class="stat-item">
            <div class="stat-value">#</div>
            <div class="stat-label">No of Displayed laptops</div>
          </div>
          <div class="stat-item">
            <div class="stat-value">#</div>
            <div class="stat-label">No of Budget laptops</div>
          </div>
        </div>
       
          <br>
          <div class="buttons">
          <a href="../logout.php" class="button button-logout">Log Out</a>
          </div>
       
      </div>
    </div>
  </div>

   
<!--your profile section starts-->

    <footer>
        <marquee class="marquee">
          Hurry Up!! / / Signup for deals / / Contact No.9861599807 / / Email:
          hamro_laptop@gmail.com / / Hurry Up!! / / Signup for deals / / Contact
          No.9861599807 / / Email: hamro_laptop@gmail.com
        </marquee>
      </footer>
      <script src="script.js"></script>
</body>
</html>