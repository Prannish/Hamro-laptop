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
      <button><a href="../logout.php">Logout</a></button>
  
    </ul>
  </div>
</nav>
<br />
<!--nav bar ends here-->

<h1 align="center">Your Wishlist <button><a href="userprofile.php" style="font-size:40px; color:darkgreen;">X</a></button> </h1>



<div id="cardcontainer">
            <?php
            


            $user_id = $_SESSION['id'];

           
    $sql = "SELECT 
    w.wishlist_id, 
    w.blaptop_id, 
    w.dlaptop_id, 
    w.added_at,
    -- Budget Laptop Details
    bl.l_name AS budget_laptop_name, 
    bl.l_model AS budget_laptop_model, 
    bl.l_processor AS budget_laptop_processor,
    bl.l_ram AS budget_laptop_ram, 
    bl.l_storage AS budget_laptop_storage, 
    bl.l_display AS budget_laptop_display, 
    bl.l_amount AS budget_laptop_amount, 
    bl.l_addinfo AS budget_laptop_addinfo, 
    bl.l_image AS budget_laptop_image,
    -- Displayed Laptop Details
    dl.l_name AS displayed_laptop_name, 
    dl.l_model AS displayed_laptop_model, 
    dl.l_processor AS displayed_laptop_processor,
    dl.l_ram AS displayed_laptop_ram, 
    dl.l_storage AS displayed_laptop_storage, 
    dl.l_display AS displayed_laptop_display, 
    dl.l_amount AS displayed_laptop_amount, 
    dl.l_addinfo AS displayed_laptop_addinfo, 
    dl.l_image AS displayed_laptop_image
FROM 
    wishlist w 
LEFT JOIN 
    budget_laptops bl ON w.blaptop_id = bl.l_id 
LEFT JOIN 
    displayed_laptops dl ON w.dlaptop_id = dl.l_id 
WHERE 
    w.user_id = '$user_id';
";

$result = mysqli_query($conn, $sql);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $wishlist_id = $row['wishlist_id'];
        $added_at = $row['added_at'];

        // Budget Laptop Details
        $bl_name = $row['budget_laptop_name'];
        $bl_model = $row['budget_laptop_model'];
        $bl_processor = $row['budget_laptop_processor'];
        $bl_ram = $row['budget_laptop_ram'];
        $bl_storage = $row['budget_laptop_storage'];
        $bl_display = $row['budget_laptop_display'];
        $bl_amount = $row['budget_laptop_amount'];
        $bl_addinfo = $row['budget_laptop_addinfo'];
        $bl_image = $row['budget_laptop_image'];

        // Displayed Laptop Details
        $dl_name = $row['displayed_laptop_name'];
        $dl_model = $row['displayed_laptop_model'];
        $dl_processor = $row['displayed_laptop_processor'];
        $dl_ram = $row['displayed_laptop_ram'];
        $dl_storage = $row['displayed_laptop_storage'];
        $dl_display = $row['displayed_laptop_display'];
        $dl_amount = $row['displayed_laptop_amount'];
        $dl_addinfo = $row['displayed_laptop_addinfo'];
        $dl_image = $row['displayed_laptop_image'];

        // Display the information
        if($bl_name){

        
        echo "
        <div>
            <b>$bl_name</b>
            <img src='../budget_laptops/$bl_image' alt='$bl_name'>
            <div class='parag'>
                <p>Price: रु. $bl_amount</p>
                <br>
                <p style='text-align:left; color: #28a745;'>Specification:</p>
                <p style='text-align:left;'>Model: $bl_model</p>
                <p style='text-align:left;'>Processor: $bl_processor</p>
                <p style='text-align:left;'>Ram: $bl_ram</p>
                <p style='text-align:left;'>Storage: $bl_storage</p>
                <p style='text-align:left;'>Display: $bl_display</p>
                <p style='text-align:left;'>Added on: $added_at</p>
                <br>
                <a href='removewishlist.php?id=$wishlist_id' class='buy-btn'>Remove from Wishlist</a>
            </div>
        </div>";
        }

        // Check if there is a displayed laptop, if available, display its details
        if ($dl_name) {
            echo "
            <div>
                <b>$dl_name</b>
                <img src='../displayed_laptops/$dl_image' alt='$dl_name'>
                <div class='parag'>
                    <p>Price: रु. $dl_amount</p>
                    <br>
                    <p style='text-align:left; color: #28a745;'>Specification:</p>
                    <p style='text-align:left;'>Model: $dl_model</p>
                    <p style='text-align:left;'>Processor: $dl_processor</p>
                    <p style='text-align:left;'>Ram: $dl_ram</p>
                    <p style='text-align:left;'>Storage: $dl_storage</p>
                    <p style='text-align:left;'>Display: $dl_display</p>
                    <p style='text-align:left;'>Added on: $added_at</p>
                    <br>
                    <a href='removewishlist.php?id=$wishlist_id' class='buy-btn'>Remove from Wishlist</a>
                </div>
            </div>";
        }
    }
}

            ?>
          </div>
  
      

      <!--body part ends-->
    <footer>
      <marquee class="marquee">
        Hurry Up!! / / Signup for deals / / Contact No.9861599807, 9764395096 / / Email:
        hamro_laptop@gmail.com / / Hurry Up!! / / Signup for deals / / Contact
        No.9861599807, 9764395096 / / Email: hamro_laptop@gmail.com
      </marquee>
    </footer>
    <script src="script.js"></script>
  </body>
</html>