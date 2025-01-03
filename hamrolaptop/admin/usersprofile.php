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



.card {
  background-color:dare;
  border-radius: var(--border-radius);
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  padding: 20px;
  margin-bottom: 20px;
}

.profile-header {
  display: flex;
  align-items: center;
  margin-bottom: 20px;
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
  display: grid;
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
  color:black;
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
        }

        .button-primary {
            background: #1789fc;
            color: white;
            border: none;
        }

        .button-primary:hover {
            background: #0d68d6;
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
$user_id = $_GET['user_id'];




$sql = "SELECT date(created_at) as created_at,fullname,email,image,phone,user_type  FROM users WHERE id = $user_id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $created_at = $row['created_at'];
  $imageUrl = $row['image'];
  $name = $row['fullname'];
  $email = $row['email'];
  $phone = $row['phone'];
  $role = $row['user_type'];
} else {
  echo "No user found.";
  exit();
}





?>

<!--your profile section starts-->
<div class="indexcontainer" style="height: 100%;">
  <div class="card">
    <div class="profile-header">
        <div class="profile-inf">
      <div class="profile-info">
      <h1 style="font-size: 40px;">User's Profile <button> <a href="listuser.php" style="font-size:30px; color:darkgreen;">X</a></button> </h1>
        <?php
        echo "<img src='../$imageUrl' id='ppImage' alt='users profile picture'>";
        ?>
      
        <h1><?php echo $name ?></h1>
        <p>Phone: <?php echo $phone?></p>
        <p>Email Address: <?php echo $email?></p>
        <p>Member since <?php echo $created_at ?></p>
      </div>
    </div>
</div>
</div>

<main>
  <div>
    <?php

if($role != 'admin'){
    echo "
  <h1 style=' font-size: 20px; text-align:center;'>Laptops Uploaded by this user</h1>";
}
  ?>
      
          <!-- Cards Section -->
          <div id="cardcontainer">
            <?php
           if($role != 'admin'){
               $sql = "SELECT s.l_id,s.l_name,u.fullname as username,u.id ,s.l_model,s.l_processor,s.l_ram,s.l_storage,s.l_display,s.l_amount,s.l_addinfo,s.l_image,s.l_uploaddate,s.approval_status from second_hand_laptops s join users u on s.l_userid = u.id where s.approval_status='approved' and u.id=$user_id";
               $result = mysqli_query($conn, $sql);
      
            if ($result) {
              while ($row = mysqli_fetch_assoc($result)) {
                $l_id = $row['l_id'];
                $l_name = $row['l_name'];
                $l_model = $row['l_model'];
                $l_processor = $row['l_processor'];
                $l_ram = $row['l_ram'];
                $l_storage = $row['l_storage'];
                $l_display = $row['l_display'];
                $l_amount = $row['l_amount'];
                $l_addinfo = $row['l_addinfo'];
                $imageUrl = $row['l_image'];
      
                echo "
                <div>
                  <b>$l_name</b>
                  <img src='../user_upload_laptops/$imageUrl' alt='$l_name'>
<div class='parag'>
                  <p>Price: रु. $l_amount</p>
                  <br>
                  <p style='text-align:left; color:green;'>Specification:</p>
                  <p style='text-align:left;'>Model: $l_model</p>
                  <p style='text-align:left;'>Processor: $l_processor</p>
                  <p style='text-align:left;'>Ram: $l_ram</p>
                  <p style='text-align:left;'>Storage: $l_storage</p>
                  <p style='text-align:left;'>Display: $l_display</p>
                  <br>
                </div></div>";
              }
            }
           }
       
            ?>
          </div>
        </div>
      </main>
<!--your profile section starts-->

 
      <script src="script.js"></script>


</body>
</html>