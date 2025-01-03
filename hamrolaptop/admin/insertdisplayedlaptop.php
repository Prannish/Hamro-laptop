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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="website icon" href="logo.jpg" type="h/jpg" />

    <title>Laptop Details Form</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f3f4f6;
        }

        .container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        h1 {
            font-size: 1.5rem;
            color: #111827;
            margin-bottom: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

       input label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            
        }
        label{
            color: #374151;
        }

        input[type="text"],
        input[type="number"],
        input[type="file"],
        textarea {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #d1d5db;
            border-radius: 4px;
            font-size: 1rem;
        }

        input[type="file"] {
            padding: 0.25rem;
        }

        .spec-inputs {
            display: grid;
            gap: 1rem;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        }

        .submit-btn {
            background-color:rgb(23, 76, 252);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .submit-btn:hover {
            background-color: rgb(13, 54, 238);
        }
    </style>
    <link rel="stylesheet" href="../style.css">
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
//Sell php
$l_name = "";
$l_model = "";
$l_processor = "";
$l_ram = "";
$l_storage = "";
$l_display = "";
$l_amount = "";
$l_addinfo = "";
$dbError = "";
$uploadDir = '../displayed_laptops/'; 


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
       
    $l_name = $_POST['l_name'];
    $l_model = $_POST['l_model'];
    $l_processor = $_POST['l_processor'];
    $l_ram = $_POST['l_ram'];
    $l_storage = $_POST['l_storage'];
    $l_display = $_POST['l_display'];
    $l_amount = $_POST['l_amount'];
    $l_addinfo = $_POST['l_addinfo'];
    

    $image = $_FILES['image'];
    $imageName = $image['name'];
    // str_replace(" ","_",$image['name']);
    $imageTmpName = $image['tmp_name'];
    $imagePath = $uploadDir . $imageName;
    
    if (move_uploaded_file($imageTmpName, $imagePath)) {
    
    $sql = "insert into displayed_laptops(l_name,l_model,l_processor,l_ram,l_storage,l_display,l_amount,l_addinfo,l_image) values('$l_name','$l_model','$l_processor','$l_ram','$l_storage','$l_display','$l_amount','$l_addinfo','$imagePath')";
    $result = mysqli_query($conn, $sql); // returns True if data is inserted
    if ($result) {
        // f - Redirect user on login page
        
        header('Location: viewdisplayedlaptop.php');


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
    <div class="container">
        <h1>Insert Homepage Laptop <button><a href="admindashboard.php" style="font-size:30px; color:darkred;">X</a></button> </h1>
        <form id="laptopForm"  method="POST" action="<?php echo $_SERVER["PHP_SELF"] ?>" onsubmit="return validateForm()" enctype="multipart/form-data">
            <div class="form-group">
                <label for="image">Laptop Image:</label>
                <input type="file" id="image" name="image" accept="image/*" required>
            </div>

            <div class="form-group">
                <label for="l_name">Laptop Title:</label>
                <input type="text" id="l_name" name="l_name" required>
            </div>

            <div class="form-group">
                <label for="l_amount">Price (रु.):</label>
                <input type="number" id="l_amount" name="l_amount" min="0" step="0.01" required>
            </div>

            <div class="form-group">
                <label>Specifications:</label>
                <div class="spec-inputs">
                    <div>
                        <label for="l_model">Model:</label>
                        <input type="text" id="l_model" name="l_model" required>
                    </div>
                    <div>
                        <label for="l_processor">Processor:</label>
                        <input type="text" id="l_processor" name="l_processor" required>
                    </div>
                    <div>
                        <label for="l_ram">RAM:</label>
                        <input type="text" id="l_ram" name="l_ram" required>

                    </div>
                    <div>
                        <label for="l_storage">Storage:</label>
                        <input type="text" id="l_storage" name="l_storage" required>

                    </div>
                    <div>
                        <label for="l_display">Display<i style="font-size: small;"> *inch </i>:</label>
                        <input type="text" id="l_display" name="l_display" required>
                    </div>
                </div>
            </div>


            <div class="form-group">
                <label for="l_addinfo">Additional Information:</label>
                <textarea id="l_addinfo" name="l_addinfo" rows="4" placeholder="Add details like how many years of use, condition..."></textarea>
            </div>

            <button type="submit" class="submit-btn">Submit Laptop Details</button>
        </form>
    </div>
    <script>
    function validateForm() {
        const l_name = document.getElementById("l_name").value;
        const l_model = document.getElementById("l_model").value;
        const l_processor = document.getElementById("l_processor").value;
        const l_ram = document.getElementById("l_ram").value;
        const l_storage = document.getElementById("l_storage").value;
        const l_display = document.getElementById("l_display").value;
        const l_amount = document.getElementById("l_amount").value;
        const l_image = document.getElementById("l_image");
        let hasError = false;

        
        // return true;
        if (l_name === "") {
            document.getElementById("lnameerr").innerHTML = "Laptop Name is required!";
           hasError = true;
        }

        if (l_model === "") {
            document.getElementById("lmodelerr").innerHTML = "Laptop Model is required!";

            hasError = true;


        }


        if (l_processor === "" ) {
            document.getElementById("lprocessorerr").innerHTML = "Processor is Required";

            hasError = true;


        }

        if (l_ram === "" ) {
            document.getElementById("lramerr").innerHTML = "Ram is Required";

            hasError = true;


        }

        if (l_storage === "" ) {
            document.getElementById("lstorageerr").innerHTML = "Storage is Required";

            hasError = true;


        }

        if (l_display === "" ) {
            document.getElementById("ldisplayerr").innerHTML = "Display is Required";

            hasError = true;


        }

        if (l_addinfo === "" ) {
            document.getElementById("laddinfoerr").innerHTML = "Additional Info is Required";

            hasError = true;


        }




        if (l_amount === "") {
            document.getElementById("lamounterr").innerHTML = "Price is Required";

            hasError = true;


        }

        if (l_image === "") {
            document.getElementById("limageerr").innerHTML = "Image is Required";

            hasError = true;


        }

       if(!hasError){
           return true;
       }
       else{
           return false;
       }


    }
</script>

</body>
</html>