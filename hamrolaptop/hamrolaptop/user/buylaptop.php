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
</head>
<body>
    <h1>Buy this aptop</h1>
    <form  method="post">
        <label for="name">Full Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="phone">Phone Number:</label>
        <input type="tel" id="phone" name="phone" required><br><br>

        <label for="address">Shipping Address:</label>
        <textarea id="address" name="address" required></textarea><br><br>

        <input type="submit" value="Proceed to Payment">
        <?php
        $query = "SELECT model, quantity FROM laptops";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            echo '<label for="laptop_model">Laptop Model:</label>';
            echo '<select id="laptop_model" name="laptop_model" required>';
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<option value="' . htmlspecialchars($row['model']) . '">' . htmlspecialchars($row['model']) . '</option>';
            }
            echo '</select><br><br>';

            echo '<label for="quantity">Quantity:</label>';
            echo '<input type="number" id="quantity" name="quantity" min="1" required><br><br>';
        } else {
            echo '<p>No laptops available.</p>';
        }
        ?>
    </form>
</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $address = htmlspecialchars($_POST['address']);
    $laptop_model = htmlspecialchars($_POST['laptop_model']);
    $quantity = htmlspecialchars($_POST['quantity']);

    // Here you can add code to process the purchase, such as saving the data to a database or sending an email
    // Example: Save the purchase data to a file
    $data = "Name: $name\nEmail: $email\nPhone: $phone\nAddress: $address\nLaptop Model: $laptop_model\nQuantity: $quantity\n\n";
    file_put_contents('purchases.txt', $data, FILE_APPEND);
    echo "<h2>Thank you for your purchase, $name!</h2>";
    echo "<p>Email: $email</p>";
    echo "<p>Phone: $phone</p>";
    echo "<p>Shipping Address: $address</p>";
    echo "<p>Laptop Model: $laptop_model</p>";
    echo "<p>Quantity: $quantity</p>";
}
?>