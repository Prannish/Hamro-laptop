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
    <title>Buy Laptop</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
           background-color: #296eb4;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        h1 {
            margin-bottom: 30px;
            color: #333;
        }

        .order-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
        }

        .card {
            background-color: #4075c8;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
            margin-bottom: 20px;
            color: #333;
        }

        .user-info {
            margin-bottom: 20px;
        }

        .user-info p {
            margin-bottom: 10px;
            color: white;
        }

        .user-info strong {
            font-weight: bold;
            color: black;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: white;
        }

        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            min-height: 120px;
            resize: vertical;
            background-color: rgb(163, 176, 176);
        }
        textarea::placeholder{
            color: white;
        }
       

        .laptop-details {
            margin-top: 20px;
        }

        .laptop-image {
            width: 100%;
            max-width: 300px;
            height: auto;
            margin-bottom: 20px;
            border-radius: 8px;
        }

        .laptop-specs {
            margin-bottom: 20px;
        }

        .laptop-specs p {
            margin-bottom: 8px;
            color: white;
        }

        .laptop-specs strong {
            font-weight: bold;
            color: black;
        }

        .price-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            color: black;
        }

        .total {
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #ddd;
            font-weight: bold;
            color:rgb(72, 255, 0); 
        }

        .confirm-button {
            display: block;
            width: 200px;
            padding: 12px;
            margin: 30px 0 0 auto;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .confirm-button:hover {
            background-color: #0056b3;
        }

        @media (max-width: 768px) {
            .order-grid {
                grid-template-columns: 1fr;
            }

            .confirm-button {
                width: 100%;
            }
        }
    </style>
</head>
<body>
<form method='post'>
<?php


   
 
        $l_id = $_GET['id'];

        $query = "SELECT * FROM second_hand_laptops WHERE l_id = '$l_id'";
        $result = mysqli_query($conn, $query);
        if ($result && mysqli_num_rows($result) > 0) {
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

     <div class='container'>
    <h1>Order Confirmation <button><a href='buy.php' style='font-size:30px; color:darkgreen;'>X</a></button></h1>
    
    <div class='order-grid'>
        <!-- User Details Card -->
        <div class='card'>
            <h2 class='card-title'>User Details</h2>
            <div class='user-info'>
                  <p><strong>Name:</strong> " . $_SESSION['name'] . "</p>
                <p><strong>Email:</strong> " . $_SESSION['email'] . "</p>
                <p><strong>Phone:</strong> " . $_SESSION['phone'] . "</p>
            </div>
            
           
                <div class='form-group'>
                    <label for='shipping'><strong style='color: black;'>Shipping Address:<span style='color:red;'>*</span></strong></label>
                    <textarea id='shipping' name='shipping' placeholder='Enter your shipping address' required></textarea>
                </div>
          
        </div>

            <!-- Laptop Details Card -->
            <div class='card'>
                <h2 class='card-title'>Laptop Details</h2>
                <img src='../second_hand_laptops/$imageUrl' alt='Laptop' class='laptop-image'>
                
                <div class='laptop-details'>
                <div class='price-item'>
                <span><strong>$l_name</strong></span>
                </div>
                    <div class='laptop-specs'>
                        <p><strong>Model:</strong>$l_model</p>
                        <p><strong>Processor:</strong>$l_processor</p>
                        <p><strong>RAM:</strong>$l_ram</p>
                        <p><strong>Storage:</strong>$l_storage</p>
                        <p><strong>Display:</strong>$l_display</p>
                    </div>

                    <div class='price-item total'>
                        <span style='color: black;'><strong>Amount</strong></span>
                        <span>रु. $l_amount</span>
                    </div>
                     <div class='price-item total'>
                        <span style='color: black;'><strong>Platform Charge</strong></span>
                        <span>रु.".$l_amount*0.05."</span>
                    </div>
                     <div class='price-item total'>
                        <span style='color: black;'><strong>Total Amount</strong></span>
                        <span>रु.".$l_amount+($l_amount*0.05)."</span>
                    </div>
                    <div>
                        <p><strong>Your 5% of the sale amount will be taken by Hamro laptop</strong></p>
                    </div>
                </div>
            </div>
        </div>

        <button type='submit' class='confirm-button' onclick='return addressValidation()'>Confirm Your Order</button>
         
    </div>
         
          ";
        } 

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $shipping_address = mysqli_real_escape_string($conn, $_POST['shipping']);
            $user_id = $_SESSION['id'];
            $l_id = $_GET['id'];

            $query = "SELECT * FROM orders WHERE buyer_id = '$user_id' AND laptop_id = '$l_id'";
            $result = mysqli_query($conn, $query);
        
            if (mysqli_num_rows($result) > 0) {
                echo "<script>alert('You have already ordered this laptop!')</script>";
            }
            else{

                $seller_query = "select l_userid from second_hand_laptops where l_id = '$l_id';";
                $result = mysqli_query($conn, $seller_query);
                $row = mysqli_fetch_assoc($result);
                $seller_id = $row['l_userid'];

            
        
            $insert_query = "INSERT INTO orders (buyer_id,seller_id, laptop_id, address) VALUES ('$user_id','$seller_id', '$l_id', '$shipping_address')";
            $set_ordered = "UPDATE second_hand_laptops SET approval_status = 'ordered' WHERE l_id = '$l_id'";
            $resultinsert = mysqli_query($conn, $insert_query);
            $resultset = mysqli_query($conn, $set_ordered);

            if ($resultinsert && $resultset) {
            echo "<p>Order placed successfully!</p>";
            } else {
                echo "<p>Error placing order: " . mysqli_error($conn) . "</p>";
            }
        }
    }
   
}
        ?>
    </form>
  

    
    <script>
    function addressValidation() {
        let hasError = false;

        // Validate if the shipping address is empty
        if (document.getElementById('shipping').value === '') {
            alert('Please enter your shipping address.');
            hasError = true;
        }

        // If there is an error, prevent further action
        if (hasError) {
            return false; // Prevent order confirmation
        }

        // Confirm the order
        return confirmOrder();
    }

    function confirmOrder() {
        return confirm("Are you sure you want to confirm the order?");
    }
</script>

</body>
</html>