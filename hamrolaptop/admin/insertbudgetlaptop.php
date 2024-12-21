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
    <title>insert_budget_laptop</title>
    <link rel="website icon" href="logo.jpg" type="h/jpg" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../style.css" />
    <style>
        label{
            color:blue;
        }

        input[type="text"], input[type="number"], textarea {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        background-color: #eee;
    }
    input[type="submit"]{
        background-color: #1789fc;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
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
      <li><a href="#"><i class="fa-solid fa-laptop"></i>Second-hand Laptops</a></li>
      <div class="gapbuysell">

        <li><a href="buy.php"><i class="fa-solid fa-cart-plus"></i>Buy</a></li>
        <li><a href="sell.php"><i class="fa-solid fa-sack-dollar"></i></i>Sell</a></li>
      </div>

      <li><a href="userprofile.php"><i class="fa-solid fa-user"></i>Your Profile</a></li>
    </ul>
  </div>
</label>
<!--side bar Nav ends here-->

<!--Nav bar-->
<nav class="navbar">
  <div class="navdiv">
    <div class="logo">

      <a href="buy.php" class="title">Hamro laptop

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
//Sell php
$l_name = "";
$l_model = "";
$l_specification = "";
$l_amount = "";
// $l_image = "";
$l_uploaddate = "";
$dbError = "";
$uploadDir = '../budget_laptops/'; 


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
       
    $l_name = $_POST['l_name'];
    $l_model = $_POST['l_model'];
    $l_specification = $_POST['l_specification'];
    $l_amount = $_POST['l_amount'];
    $l_uploaddate =  $_POST['l_uploaddate'];

    $image = $_FILES['image'];
    $imageName = $image['name'];
    // str_replace(" ","_",$image['name']);
    $imageTmpName = $image['tmp_name'];
    $imagePath = $uploadDir . $imageName;
    
    if (move_uploaded_file($imageTmpName, $imagePath)) {
    
    $sql = "insert into budget_laptops(l_name,l_model,l_specification,l_amount,l_image) values('$l_name','$l_model','$l_specification','$l_amount','$imagePath')";
    $result = mysqli_query($conn, $sql); // returns True if data is inserted
    if ($result) {
        // f - Redirect user on login page
        
        header('Location: viewbudgetlaptop.php');


    }
    else{
        echo "Error: " . $conn->error;
    }
  

}
else{
    echo "Failed to upload image";
}
    }
    else{
        echo "Image not uploaded or upload error!";
    }

}

?>


<!--sell page starts here-->

<div class="loginsignupcontainer">
<h1 style="color:#1789fc; text-align:center;">Insert budget laptop <a href="admindashboard.php" style="font-size:30px; color:darkgreen;"> X</a></h1>
   <br>
  
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"] ?>" onsubmit="return validateForm()" enctype="multipart/form-data">
        <label for="l_name">Name:</label>
        <input type="text" id="l_name" name="l_name" required><br>

        <label for="l_model">Model:</label>
        <input type="text" id="l_model" name="l_model" required><br>
        <label for="l_specification">Specification:</label>
        <textarea id="l_specification" name="l_specification" required></textarea><br>

        <label for="l_amount">Amount:</label>
        <input type="number" id="l_amount" name="l_amount" required><br>

        <label for="l_image">Image:</label>
        <input id="l_image" type="file" name="image" accept="image/*"><br>
     
        <input type="submit" value="Insert Laptop">
    </form>
    </div>


</div>


<script>
    function validateForm() {
        const l_name = document.getElementById("l_name").value;
        const l_model = document.getElementById("l_model").value;
        const l_specification = document.getElementById("l_specification").value;
        const l_amount = document.getElementById("l_amount").value;
        const l_image = document.getElementById("l_image");
        const l_boughtdate = document.getElementById("l_uploaddate").value;
        let hasError = false;

        
        // return true;
        if (l_name === "") {
            document.getElementById("lnameerr").innerHTML = "Laptop Name is required!";
           return hasError;
        }

        if (l_model === "") {
            document.getElementById("lmodelerr").innerHTML = "Laptop Model is required!";

            return hasError;

        }


        if (l_specification === "" ) {
            document.getElementById("lspecificaitonerr").innerHTML = "Laptop Specification is Required";

            return hasError;

        }

        if (l_amount === "") {
            document.getElementById("lamounterr").innerHTML = "Laptop Amount is Required";

            return hasError;

        }

        if (l_image === "") {
            document.getElementById("limageerr").innerHTML = "Laptop Imge is Required";

            return hasError;

        }

        if (l_boughtdate === "") {
            document.getElementById("lboughtdateerr").innerHTML = "Date is Required";

            return hasError;
        }
        hasError = true;
        return hasError;


    }
</script>


<!--adminsell page ends here-->


</body>

</html>