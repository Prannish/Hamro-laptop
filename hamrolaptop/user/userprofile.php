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
    <title>User_profile</title>
    <link rel="website icon" href="logo.jpg" type="h/jpg" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css
" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../style.css" />
    <style>
        
/*your profile section starts*/

.profile-container {
  position: relative;
}

.profile-pic {
  width: 30px;
  height: 30px;
  border-radius: 50%;
  object-fit: cover;
  cursor: pointer;
  border: 2px solid #ddd;
  margin-top: 10px;
}

.dropdown {
  display: none;
  position: absolute;
  top: 50px;
  right: 0;
  background-color: white;
  border: 1px solid #ccc;
  border-radius: 5px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  padding: 10px;
  width: 150px;
  z-index: 100;
}

.dropdown a {
  width: 100%;
  padding: 10px;
  border: none;
  background-color: transparent;
  text-align: left;
  cursor: pointer;
}

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
            margin-left: 50px;
            margin-right: 50px;
        }

        .button {
            flex: 1;
            min-width: 150px;
            padding: 0.75rem 1.5rem;
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
                <li><a href="index.php"><i class="fas fa-solid fa-house"></i>Home</a></li>
                <li><a href="budget.php"><i class="fa-solid fa-laptop-code"></i>Budget Laptops</a></li>
                <li><a href="buy.php"><i class="fa-solid fa-laptop"></i>Second-hand Laptops</a></li>
                <div class="gapbuysell">

                <li><a href="buy.php"><i class="fa-solid fa-cart-plus"></i>Buy</a></li>
                <li><a href="sell.php"><i class="fa-solid fa-sack-dollar"></i></i>Sell</a></li>
            </div>

                <li><a href="userprofile.php"><i class="fa-solid fa-user"></i>Your Profile</a></li>
                <li><a href="about.html"><i class="fa-solid fa-info"></i>About</a></li>
            </ul>
        </div>
    </label>
    <!--side bar Nav ends here-->

   <!--Nav bar-->
<nav class="navbar">
  <div class="navdiv">
    <div class="logo">

      <a href="index.php" class="title">Hamro laptop

      </a>
      <a style="margin-left: 190px;"> <img src="logo.jpg" height="30" /></a>
    </div>
    <ul>

    <div class="profile-container">
      <img src="../<?php echo $_SESSION['imageUrl']?>" alt="Profile Picture" class="profile-pic" id="profilePic">
      <div class="dropdown" id="dropdown">
        <a href="userprofile.php"><i class="fa-solid fa-user"></i> Your Profile</a>
        <hr style="color: white;">
        <a href="../logout.php"><i class="fa-solid fa-right-from-bracket"></i> Log Out</a>
      </div>
    </div>
  
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

$sql_sales = "SELECT COUNT(*) as count_sales FROM second_hand_laptops WHERE l_userid = $id";
$result_sales = $conn->query($sql_sales);
$row_sales = $result_sales->fetch_assoc();
$count_sales = $row_sales['count_sales'];

$cart = "SELECT COUNT(*) as count_cart FROM cart WHERE user_id = $id";
$result_cart = $conn->query($cart);
$row_cart = $result_cart->fetch_assoc();
$count_cart = $row_cart['count_cart'];

$wishlist = "SELECT COUNT(*) as count_wishlist FROM wishlist WHERE user_id = $id";
$result_wishlist = $conn->query($wishlist);
$row_wishlist = $result_wishlist->fetch_assoc();
$count_wishlist = $row_wishlist['count_wishlist'];


$orders = "SELECT COUNT(*) as count_orders FROM orders WHERE buyer_id = $id";
$result_orders = $conn->query($orders);
$row_orders = $result_orders->fetch_assoc();
$count_orders = $row_orders['count_orders'];




?>

<!--your profile section starts-->

  <div class="card">
    <h1 style="color:lightgreen;">User Profile</h1>
    <br>
    <div class="profile-header">
      <div class="profile-info">
        <?php
        echo "<img src='../$imageUrl' id='ppImage' alt='users profile picture'>";
        ?>
      
        <h1><?php echo $_SESSION['name']; ?></h1>
        <p>Phone: <?php echo $_SESSION['phone'];?></p>
        <p>User since <?php echo $created_at ?></p>
      </div>
    </div>
    <div class="profile-content">
      <div class="account-overview">
        <h1 style="color:lightgreen;">Account Overview</h1>
        <br>
        <div class="stats-grid">
          <div class="stat-item">
            <div class="stat-value"><?php echo $count_cart?></div>
            <div class="stat-label">Cart Items</div>
          </div>
        
          <div class="stat-item">
            <div class="stat-value"><?php echo $count_wishlist?></div>
            <div class="stat-label">Wishlist</div>
          </div>
          <div class="stat-item">
            <div class="stat-value"><?php echo $count_orders?></div>
            <div class="stat-label">Your purchases</div>
          </div>
          <div class="stat-item">
            <div class="stat-value"><?php echo $count_sales?></div>
            <div class="stat-label">Your sales</div>
          </div>
        </div>

        <div class="quick-actions">
          <h3>Quick Actions</h3>
          <br>
          <div class="buttons">
          <a href="viewcart.php" class="button button-primary">View Cart</a>
          <a href="viewwishlist.php" class="button button-primary">View Wishlist</a>
          <a href="vieworders.php" class="button button-primary">View Purchases</a>
          <a href="viewsales.php" class="button button-primary">Your Sales</a>
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

   
      <script src="script.js"></script>

      <script>
        const profilePic = document.getElementById("profilePic");
const dropdown = document.getElementById("dropdown");

// Toggle the dropdown visibility
profilePic.addEventListener("click", () => {
  dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
});

// Close the dropdown if clicked outside
document.addEventListener("click", (e) => {
  if (!profilePic.contains(e.target) && !dropdown.contains(e.target)) {
    dropdown.style.display = "none";
  }
});

// Example functions for buttons
function viewProfile() {
  alert("Redirecting to your profile...");
  // Add logic for redirecting to the user's profile page
}

function logout() {
  alert("Logging out...");
  // Add logic for logging the user out
}

      </script>

</body>
</html>