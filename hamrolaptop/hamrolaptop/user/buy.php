<?php
include "../connection.php";
session_start();
if (!isset($_SESSION['name'])) {
    header("location: ../login.php");
    exit();
}

if (isset($_GET['error'])) {
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../style.css">
    <style>
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
            background: #4075c8;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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
            color: white;
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
            color: #374151;
        }

        .spec-label {
            font-weight: 600;
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

        .cartBtn {
            background-color: blue;
            color: white;
            
            padding: 10px;
            margin-right: 10px;
            margin-bottom: 10px;
         
        }

        .cartBtn:hover {
            background-color: darkblue;
            
        }

        .buyBtn {
            background-color: green;
            color: white;
            
            padding: 10px;
            margin-right: 10px;
            margin-bottom: 10px;

        }

        .buyBtn:hover {
            background-color: rgb(24, 255, 109);
            color: black;
        }



        .stock-status {
            color: #22c55e;
            font-size: 0.875rem;
        }

        .vat-notice {
            color: white;
            font-size: 0.875rem;
        }

        .userprofile {
            font-size: 1rem;
            font-weight: bold;
            color: white;
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
    <div style="text-align: center; margin-top: 20px;">

    </div>
    <main>
        <div> <!-- class="indexcontainer"-->
            <br>
            <br>
            <h1 style=" font-size: 50px; text-align:center;">Find Second Hand Laptops For You</h1>

            <!--search bar-->
            <div class="searchbar">
                <img src="search.png" height="40" class="searchimg" />
                <input type="search" placeholder="Search.." class="searchinput" />
                <button class="searchbtn"><a>Search</a></button>
            </div>
            <br>
            <!--Search bar ends-->
            <h1 style=" font-size: 20px; text-align:center;">Buy Second Hand Laptop</h1>

            <div class="product-container">
                <?php
                $sql = "SELECT s.l_id,s.l_name,u.fullname as username,s.l_model,s.l_processor,s.l_ram,s.l_storage,s.l_display,s.l_amount,s.l_addinfo,s.l_image,s.l_uploaddate,s.approval_status from second_hand_laptops s join users u on s.l_userid = u.id where s.approval_status='approved'";
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


                        echo "
  <div class='container'>
        <div class='product-card'>
            <div class='product-image'>
                      <div class='price-container'>
                    <span class='userprofile'>Uploaded By: $username</span>
                </div>
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
                  <a href='cart.php?id=$id' class='cartBtn'>Add to Cart</a>
                    <a href='buylaptop.php?id=$id' class='buyBtn'>Buy</a>
                </div>

                <p class='vat-notice'>**Price is inclusive of VAT**</p>
               </div>
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


</body>

</html>