<?php
include "../connection.php";
session_start();
if (!isset($_SESSION['name'])) {
  header("location: ../login.php");
  exit();
}

if(isset($_GET['error'])){
    echo "<script>
    
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('error')) {
        const errorValue = urlParams.get('error');

        if (errorValue === 'alreadyadded') {
           
            alert('This item is already in your cart.');

            const newUrl = window.location.origin + window.location.pathname;
            window.history.replaceState({}, document.title, newUrl);
        }
    }
</script>
";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laptop Product Page</title>
    <link rel="website icon" href="logo.jpg" type="h/jpg" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Anton&family=Poppins&family=Rubik+Vinyl&display=swap" rel="stylesheet">

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

        .product-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .product-card {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
            padding: 2rem;
            background-color: #4075c8;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        @media (min-width: 768px) {
            .product-card {
                grid-template-columns: 1fr 1fr;
            }
        }

        .product-image {
            position: relative;
        }

        .product-image img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .badges {
            position: absolute;
            top: 1rem;
            left: 1rem;
            display: flex;
            gap: 0.5rem;
        }

        .badge {
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-size: 0.875rem;
            font-weight: bold;
            color: white;
        }

        .badge-discount {
            background-color: #ef4444;
        }

        .badge-shipping {
            background-color: #22c55e;
        }

        .product-info {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .product-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #111827;
        }

        .price-container {
            display: flex;
            align-items: baseline;
            gap: 1rem;
        }

        .current-price {
            font-size: 1.875rem;
            font-weight: bold;
            color:rgb(72, 255, 0);            ;
        }

        .specifications {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .spec-title {
            font-weight: bold;
            color: #111827;
        }

        .spec-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .spec-item {
            font-size: 0.875rem;
            color:rgb(229, 231, 235);
        }

        .spec-label {
            font-weight: 600;
        }

        .quantity {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .qty-controls {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .qty-btn {
            width: 32px;
            height: 32px;
            border: 1px solid #d1d5db;
            background: white;
            border-radius: 4px;
            cursor: pointer;
        }

        .qty-btn:hover {
            background: #f3f4f6;
        }

        .qty-value {
            width: 48px;
            text-align: center;
        }

        .buttons {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .buttons a {
            flex: 1;
            min-width: 150px;
            padding: 0.75rem 1.5rem;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            text-align: center;
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

.userprofile a {
                        font-family: 'Anton', sans-serif;
                        font-size: 1rem;
                        color:rgb(0, 0, 0);
                        text-decoration: none;
                        transition: color 0.3s ease;
                        position: relative;
                        left: 15rem;                    }

                    .userprofile a:hover {
                        color:rgb(255, 255, 255);
                    }


      
        .stock-status {
            color: #22c55e;
            font-size: 0.875rem;
        }

        .vat-notice {
            color: white;
            font-size: 0.875rem;
        }

        .colorupdate {
    background-color: blue;
    color: white;
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
    color: white;
    border: 2px solid red;
    padding: 10px;
    margin-right: 10px;
    margin-bottom: 10px;
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

<main>
        <div> <!-- class="indexcontainer"-->
          <br>
          <br>
<h1 style=" font-size: 50px; text-align:center;">Find Second Hand Laptops For You</h1>
             <!--search bar-->
             <form action="" method="GET">
          <div class="searchbar">
            <img src="search.png" height="40" class="searchimg" />
            <input type="search" placeholder="Search.." class="searchinput"  value="<?php if(isset($_GET['search'])){echo $_GET['search'];} ?>" name="search" required/>
            <button type="submit" class="searchbtn"><a>Search</a></button>
          </div>
          </form>
          <br>
 <!-- search Section -->

 <div id="cardcontainer">
           <?php
            //search bar code for displayed laptops
            if(isset($_GET['search'])){
              $search = $_GET['search'];
              $sql = "SELECT s.l_id, s.l_name, u.fullname as username, u.id, s.l_model, s.l_processor, s.l_ram, s.l_storage, s.l_display, s.l_amount, s.l_addinfo, s.l_image, s.l_uploaddate, s.approval_status 
              FROM second_hand_laptops s 
              JOIN users u ON s.l_userid = u.id 
              WHERE s.approval_status='approved'and l_name LIKE '%$search%'";
              $result = mysqli_query($conn, $sql);
              if (mysqli_num_rows($result) > 0) {
        foreach ($result as $row) {

                $id = $row['l_id'];
          $name = $row['l_name'];
          $model = $row['l_model'];
          $processor = $row['l_processor'];
          $ram = $row['l_ram'];
          $storage = $row['l_storage'];
          $display = $row['l_display'];
          $amount = $row['l_amount'];
          $addinfo = $row['l_addinfo'];
          $imageUrl = $row['l_image'];
          $username = $row['username'];
          $userid = $row['id'];
          if ($userid != $_SESSION['id']) {
            $buttons = "
                <a href='cart.php?id=$id' class='cart-btn'>Add to Cart</a>
                <a href='buylaptop.php?id=$id' class='buy-btn'>Buy</a>
            ";
        } else {
            $buttons = "
                <a href='modifyuploadlaptop.php?id=$id' class='colorupdate'>Update</a>
                <a href='deleteuploadlaptop.php?id=$id' class='colordelete'>Delete</a>
            ";
        }
                  echo "
          <div class='container'>
              <div class='product-card'>
                  <div class='product-image'>
                      <div class='price-container'>
                          <span class='userprofile'><a title='See this seller's profile' href='sellerprofile.php?user_id=$userid&laptop_id=$id'>$username</a></span>
                      </div>
                      <br>
                      <img src='$imageUrl' alt='$name'>
                  </div>

                  <div class='product-info'>
                      <h1 class='product-title'>
                          $name
                      </h1>

                      <div class='price-container'>
                          <span class='current-price'>रु. $amount</span>
                      </div>

                      <div class='specifications'>
                          <h2 class='spec-title'>Key Specifications:</h2>
                          <ul class='spec-list'>
                              <li class='spec-item'>
                                  <span class='spec-label'>Model:</span> $model
                              </li>
                              <li class='spec-item'>
                                  <span class='spec-label'>Processor:</span> $processor
                              </li>
                              <li class='spec-item'>
                                  <span class='spec-label'>RAM:</span> $ram
                              </li>
                              <li class='spec-item'>
                                  <span class='spec-label'>Storage:</span> $storage
                              </li>
                              <li class='spec-item'>
                                  <span class='spec-label'>Display:</span> $display inch
                              </li>
                              <li class='spec-item'>
                                  <span class='spec-label'>Additional Information:</span> $addinfo
                              </li>
                          </ul>
                      </div>

                      <div class='buttons'>
                          $buttons
                      </div>

                      <p class='vat-notice'>**Price is inclusive of VAT**</p>
                  </div>
              </div>
          </div>
          ";
              
                }
              } else {  //if no result found
                echo "<h1 style='text-align:center;color:red;'>No result found</h1>";   
              }
             }
             ?>
          </div>
<!--end of search bar code-->
      <h1 style=" font-size: 20px; text-align:center;">Second Hand Laptops</h1>

      <div class="product-container">
<?php
      $sql = "SELECT s.l_id, s.l_name, u.fullname as username, u.id, s.l_model, s.l_processor, s.l_ram, s.l_storage, s.l_display, s.l_amount, s.l_addinfo, s.l_image, s.l_uploaddate, s.approval_status 
              FROM second_hand_laptops s 
              JOIN users u ON s.l_userid = u.id 
              WHERE s.approval_status='approved'";
      $result = mysqli_query($conn, $sql);

      if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
          $id = $row['l_id'];
          $name = $row['l_name'];
          $model = $row['l_model'];
          $processor = $row['l_processor'];
          $ram = $row['l_ram'];
          $storage = $row['l_storage'];
          $display = $row['l_display'];
          $amount = $row['l_amount'];
          $addinfo = $row['l_addinfo'];
          $imageUrl = $row['l_image'];
          $username = $row['username'];
          $userid = $row['id'];

          // Check if the current user is the owner of the laptop
          if ($userid != $_SESSION['id']) {
              $buttons = "
                  <a href='cart.php?id=$id' class='cart-btn'>Add to Cart</a>
                  <a href='buylaptop.php?id=$id' class='buy-btn'>Buy</a>
              ";
          } else {
              $buttons = "
                  <a href='modifyuploadlaptop.php?id=$id' class='colorupdate'>Update</a>
                  <a href='deleteuploadlaptop.php?id=$id' class='colordelete'>Delete</a>
              ";
          }

          echo "
          <div class='container'>
              <div class='product-card'>
                  <div class='product-image'>
                      <div class='price-container'>
                          <span class='userprofile'><a title='See this seller's profile' href='sellerprofile.php?user_id=$userid&laptop_id=$id'>$username</a></span>
                      </div>
                      <br>
                      <img src='$imageUrl' alt='$name'>
                  </div>

                  <div class='product-info'>
                      <h1 class='product-title'>
                          $name
                      </h1>

                      <div class='price-container'>
                          <span class='current-price'>रु. ".$amount+($amount*0.05)."</span>
                      </div>

                      <div class='specifications'>
                          <h2 class='spec-title'>Key Specifications:</h2>
                          <ul class='spec-list'>
                              <li class='spec-item'>
                                  <span class='spec-label'>Model:</span> $model
                              </li>
                              <li class='spec-item'>
                                  <span class='spec-label'>Processor:</span> $processor
                              </li>
                              <li class='spec-item'>
                                  <span class='spec-label'>RAM:</span> $ram
                              </li>
                              <li class='spec-item'>
                                  <span class='spec-label'>Storage:</span> $storage
                              </li>
                              <li class='spec-item'>
                                  <span class='spec-label'>Display:</span> $display inch
                              </li>
                              <li class='spec-item'>
                                  <span class='spec-label'>Additional Information:</span> $addinfo
                              </li>
                          </ul>
                      </div>

                      <div class='buttons'>
                          $buttons
                      </div>

                      <p class='vat-notice'>**Price is inclusive of VAT and Platform Charge**</p>
                  </div>
              </div>
          </div>
          ";
        }
      }
?>
</div>

  </div>
  </main>
             
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