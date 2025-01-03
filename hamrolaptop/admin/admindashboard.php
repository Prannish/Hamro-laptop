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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css
" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../style.css" />
    <style>
        
/*your profile section starts*/


.card {
  text-align: center;
  background-color: #4075c8;
  border-radius: 10px;
  padding: 5px;
  height: 100%;
  margin-left: 50px;
  margin-right: 50px;
  margin-bottom: 30px;
}

.back-button{
  color: white;
  text-decoration: none;
  font-size: 20px;
  position: relative;
  left: -600px;
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
            margin-left: 20px;
            margin-right: 20px;
        }

        .button {
            flex: 1;
            min-width: 100px;
            display: flex;
            justify-content: center;
            align-items: center;

            padding: 0.75rem 0.75rem;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            text-align: center;
          
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
            margin-left: 40rem;
       margin-bottom: 20px;
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




$sqlusers = "SELECT count(*) as totalusers FROM users";
$resultusers = $conn->query($sqlusers);
$rowusers = $resultusers->fetch_assoc();
$totalusers = $rowusers['totalusers'];

$sqlorders = "SELECT count(*) as totalorders FROM orders";
$resultorders = $conn->query($sqlorders);
$roworders = $resultorders->fetch_assoc();
$totalorders = $roworders['totalorders'];

$sqlbudgetlaptops = "SELECT count(*) as totalbudgetlaptops FROM budget_laptops";
$resultbudgetlaptops = $conn->query($sqlbudgetlaptops);
$rowbudgetlaptops = $resultbudgetlaptops->fetch_assoc();
$totalbudgetlaptops = $rowbudgetlaptops['totalbudgetlaptops'];

$sqldisplayedlaptops = "SELECT count(*) as totaldisplayedlaptops FROM displayed_laptops";
$resultdisplayedlaptops = $conn->query($sqldisplayedlaptops);
$rowdisplayedlaptops = $resultdisplayedlaptops->fetch_assoc();
$totaldisplayedlaptops = $rowdisplayedlaptops['totaldisplayedlaptops'];

$sqlpendinglaptops = "SELECT count(*) as totalpendinglaptops FROM second_hand_laptops where approval_status = 'pending'";
$resultpendinglaptops = $conn->query($sqlpendinglaptops);
$rowpendinglaptops = $resultpendinglaptops->fetch_assoc();
$totalpendinglaptops = $rowpendinglaptops['totalpendinglaptops'];




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
        <br>
        <div class="buttons">
          <a href="../logout.php" class="button button-logout">Log Out</a>
          </div>
      </div>
    </div>
    <div class="profile-content">
      <div class="account-overview">
        <h1 style="color:lightgreen;">Account Overview</h1>
        <br>
        <div class="stats-grid">
          <div class="stat-item">
            <div class="stat-value"><?php echo $totaldisplayedlaptops; ?></div>
            <div class="stat-label">No of Displayed Laptops</div>
          </div>
        
          <div class="stat-item">
            <div class="stat-value"><?php echo $totalbudgetlaptops; ?></div>
            <div class="stat-label">No of Budget Laptops</div>
          </div>
          <div class="stat-item">
            <div class="stat-value"><?php echo $totalpendinglaptops; ?></div>
            <div class="stat-label">No of Pending User-Upload Laptops</div>
          </div>
        
          <div class="stat-item">
            <div class="stat-value"><?php echo $totalorders; ?></div>
            <div class="stat-label">No of Orders</div>
          </div>
    
          <div class="stat-item">
            <div class="stat-value"><?php echo $totalusers; ?></div>
            <div class="stat-label">No of Users</div>
          </div>
        </div>

        <div class="quick-actions">
          <h3>Quick Actions</h3>
          <br>
          <div class="buttons">
          <a href="insertdisplayedlaptop.php" class="button button-primary">Insert Homepage Laptops</a>
          <a href="viewdisplayedlaptop.php" class="button button-primary">View Homepage Laptops</a>
          <a href="insertbudgetlaptop.php" class="button button-primary">Insert Budget Laptops</a>
          <a href="viewbudgetlaptop.php" class="button button-primary">View Budget Laptops</a>
          <a href="viewuploadlaptop.php" class="button button-primary">View User-Upload Laptops</a>
          <a href="orders.php" class="button button-primary">View Orders</a>
          <a href="listuser.php" class="button button-primary">View Users</a>
          </div>
        </div>
       
          <br>
         
       
      </div>
    </div>
  </div>

      <script src="script.js"></script>
</body>
</html>