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
    <title>View Cart</title>
    <link rel="website icon" href="logo.jpg" type="h/jpg" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../style.css">
    <style>


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

      #cardcontainer {
  display: flex;
  flex-wrap: wrap;
  justify-content: center; /* Center-align the cards */
  gap: 20px; /* Space between cards */
  padding: 20px;
}

#cardcontainer div {
  flex: 1 1 calc(33.33% - 40px); /* Three cards in a row */
  max-width: 300px;
  height:auto;
  background: #013244;
  color: white;
  padding: 20px;
  border-radius: 10px;
  text-align: center;
  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
}

#cardcontainer img {
  max-width: 100%; /* Ensure images fit within their containers */
  height: auto;
  object-fit: contain;
  border-radius: 5px;
  margin-bottom: 10px;
}

.cardspancolor {
  background: #377299;
  padding: 8px;
  border-radius: 5px;
  display: inline-block;
  margin: 10px auto;
  color: white;
}

.buy-btn,
.cart-btn {
  text-decoration: none;
  padding: 10px 15px;
  margin: 5px;
  border-radius: 5px;
  display: inline-block;
  font-size: 14px;
  color: white;
  transition: 0.3s;
}

.buy-btn {
  background-color: #28a745;
}

.cart-btn {
  background-color:rgb(17, 190, 167);
}

.buy-btn:hover {
  background-color: #218838;
}

.cart-btn:hover {
  background-color: #e0a800;
}

.parag{
  font-size: 15px;
  font-weight: bold;
  font-family: Arial, sans-serif;
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
                <li><a href="about.php"><i class="fa-solid fa-info"></i>About</a></li>
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

<h1 align="center">Your Purchases <button><a href="userprofile.php" style="font-size:40px; color:darkgreen;">X</a></button> </h1>


<div id="cardcontainer">
            <?php
            


            $user_id = $_SESSION['id'];

           
    $sql = "SELECT u.fullname,o.order_id, o.laptop_id,date(o.order_date) as ordered_at, l.l_name, l.l_model, l.l_processor, l.l_ram, l.l_storage, l.l_display, l.l_amount, l.l_addinfo, l.l_image , l.l_userid
        FROM orders o 
        JOIN second_hand_laptops l ON o.laptop_id = l.l_id 
        JOIN users u ON l.l_userid = u.id
        WHERE o.buyer_id = '$user_id'";

    $result = mysqli_query($conn, $sql);
  
            if ($result) {
              while ($row = mysqli_fetch_assoc($result)) {
                $order_id = $row['order_id'];
                $ordered_at = $row['ordered_at'];
                $l_name = $row['l_name'];
                $l_model = $row['l_model'];
                $l_processor = $row['l_processor'];
                $l_ram = $row['l_ram'];
                $l_storage = $row['l_storage'];
                $l_display = $row['l_display'];
                $l_amount = $row['l_amount'];
                $l_addinfo = $row['l_addinfo'];
                $imageUrl = $row['l_image'];
                $laptopId = $row['laptop_id'];
                $sellerName = $row['fullname'];
              

          
      
                echo "
                <div>
                <b>$sellerName</b>
                <br>
                  <b>$l_name</b>
                  <img src='../second_hand_laptops/$imageUrl' alt='$l_name'>
<div class='parag'>
                  <p>Price: रु. $l_amount</p>
                  <br>
                  <p style='text-align:left; color: #28a745;'>Specification:</p>
                  <p style='text-align:left;'>Model: $l_model</p>
                  <p style='text-align:left;'>Processor: $l_processor</p>
                  <p style='text-align:left;'>Ram: $l_ram</p>
                  <p style='text-align:left;'>Storage: $l_storage</p>
                  <p style='text-align:left;'>Display: $l_display</p>
                  <p style='text-align:left;'>Added on: $ordered_at</p>
                  <br>
             <p><strong>Ordered ✅</strong></p>
                </div></div>";
              }
            }
            ?>
          </div>
  
      

      <!--body part ends-->

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