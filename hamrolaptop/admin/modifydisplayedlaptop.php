<?php
include "../connection.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);


$laptopId = $_GET['id'];
$l_name = $l_model = $l_specification = $l_amount = $l_image = "";

if ($laptopId) {
    $stmt = $conn->prepare("SELECT * FROM displayed_laptops WHERE l_id=?");
    $stmt->bind_param("i", $laptopId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $l_name = $row['l_name'];
        $l_model = $row['l_model'];
        $l_specification = $row['l_specification'];
        $l_amount = $row['l_amount'];
        $l_image = $row['l_image'];
    } else {
        $dbError = "Laptop not found!";
    }
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $l_name = $_POST["l_name"];
    $l_model = $_POST["l_model"];
    $l_specification = $_POST["l_specification"];
    $l_amount = $_POST["l_amount"];
    $l_image = $_FILES["l_image"]["name"];

    // Handle image upload
    if ($l_image) {
        $target_dir = '../displayed_laptops/';
        $target_file = $target_dir . basename($_FILES["l_image"]["name"]);
        move_uploaded_file($_FILES["l_image"]["tmp_name"], $target_file);
    } else {
        // If no new image is uploaded, keep the existing image
        $stmt = $conn->prepare("SELECT l_image FROM displayed_laptops WHERE l_id=?");
        $stmt->bind_param("i", $laptopId);
        $stmt->execute();
        $stmt->bind_result($existing_image);
        $stmt->fetch();
        $stmt->close();
        $l_image = $existing_image;
    }

    if ($laptopId) {
        $stmt = $conn->prepare("UPDATE `displayed_laptops` SET l_name=?, l_model=?, l_specification=?, l_amount=?, l_image=? WHERE l_id=?");
        $stmt->bind_param("sssssi", $l_name, $l_model, $l_specification, $l_amount, $l_image, $laptopId);
        if ($stmt->execute()) {
            header("Location: viewdisplayedlaptop.php");
            exit();
        } else {
            $dbError = "Update failed: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Displayed Laptop</title>
    <link rel="website icon" href="../logo.jpg" type="h/jpg" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                <li><a href="../index.html"><i class="fas fa-solid fa-house"></i>Home</a></li>
                <li><a href="../event.php"><i class="fab fa-gripfire"></i>Events</a></li>
                <li><a href="../budget.php"><i class="fa-solid fa-laptop-code"></i>Budget Laptops</a></li>
                <li><a href="../userdashboard.php"><i class="fa-solid fa-laptop"></i>Second-hand Laptops</a></li>
                <div class="../gapbuysell">

                    <li><a href="buy.php"><i class="fa-solid fa-cart-plus"></i>Buy</a></li>
                    <li><a href="sell.php"><i class="fa-solid fa-sack-dollar"></i></i>Sell</a></li>
                </div>

                <li><a href="profile.php"><i class="fa-solid fa-user"></i>Your Profile</a></li>
                <li><a href="about.html"><i class="fa-solid fa-info"></i>About</a></li>
            </ul>
        </div>
    </label>
    <!--side bar Nav ends here-->

    <!--Nav bar-->
    <nav class="navbar">
        <div class="navdiv">
            <div class="logo">

                <a href="index.html" class="title">Hamro laptop

                </a>
                <a style="margin-left: 190px;"> <img src="logo.jpg" height="30" /></a>
            </div>
            <ul>
                <button><a href="logout.php">Logout</a></button>
                <button><a id="mode">Switch Theme</a></button>
            </ul>
        </div>
    </nav>
    <br />
    <!--nav bar ends here-->
<div class="loginsignupcontainer">
<h1 style="color:#1789fc; text-align:center;">Modify Homepage Laptop <a href="admindashboard.php" style="font-size:30px; color:darkgreen;"> X</a></h1>
   <br>
    <?php if (isset($dbError)) { echo "<p style='color:red;'>$dbError</p>"; } ?>
    <form method="post" enctype="multipart/form-data">
        <label for="l_name">Name:</label>
        <input type="text" id="l_name" name="l_name" value="<?php echo htmlspecialchars($l_name); ?>" required><br>

        <label for="l_model">Model:</label>
        <input type="text" id="l_model" name="l_model" value="<?php echo htmlspecialchars($l_model); ?>" required><br>
        <label for="l_specification">Specification:</label>
        <textarea id="l_specification" name="l_specification" required><?php echo htmlspecialchars($l_specification); ?></textarea><br>

        <label for="l_amount">Amount:</label>
        <input type="number" id="l_amount" name="l_amount" value="<?php echo htmlspecialchars($l_amount); ?>" required><br>

        <label for="l_image">Image:</label>
        <input type="file" id="l_image" name="l_image"><br>
        <?php if ($l_image) { echo "<img src='../displayed_laptops/$l_image' alt='Laptop Image' width='100'><br>"; } ?>

        <input type="submit" value="Update Laptop">
    </form>
    </div>
</body>
</html>