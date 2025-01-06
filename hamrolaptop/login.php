<?php
include "connection.php";
session_start();

if (isset($_SESSION['name'])) {
  header("location: /user/index.php");
} 

if(isset($_GET['signup'])){
  echo '<script>alert("Signup successful! Please login to continue.")</script>';
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hamro _Laptop_login_page</title>
    <link rel="website icon" href="logo.jpg" type="h/jpg" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
      integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="style.css" />

  </head>
  <body>
    <!--Nav bar-->
    <nav class="navbar">
      <div class="navdiv">
        <div class="logo">
          <a href="index.php" class="title">Hamro laptop </a>
          <a style="margin-left: 190px"> <img src="logo.jpg" height="30" /></a>
        </div>
      </div>
    </nav>
    <br />
    <!--nav bar ends here-->

    <!--login php starts here-->
    <?php
    $enteredEmail = "";
    $enteredPassword = "";
    $dbError="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $enteredEmail = $_POST['logemail'];
  $enteredPassword = $_POST['logpassword'];



      $sqlQ = "select * from users where email='$enteredEmail'";
      $res = mysqli_query($conn, $sqlQ);
      if (mysqli_num_rows($res) == 0) {
          $dbError = "Invalid Email!";
      } else {
        $dbError = "";
          $row = mysqli_fetch_assoc($res); // fetch data from our table
          $DBhashpassword = $row['password'];
          $decrypt = password_verify($enteredPassword, $DBhashpassword);
          
          if ($decrypt) {
              $_SESSION['id'] = $row['id'];
              $_SESSION['name'] = $row['fullname'];
              $_SESSION['email'] = $row['email'];
              $_SESSION['phone'] = $row['phone'];
              $_SESSION['imageUrl'] = $row['image'];
              

              //logic to check whether the user_type is user or admin and redirect accordingly..
             if($row['user_type']=="admin"){
              header('Location: /hamrolaptop/admin/admindashboard.php');
             }
             else{
              header('Location: user/buy.php');
             }
            
          } else {
              $dbError = "Invalid Password";
          }
      }
  }

?>
<!-- login php ends here-->

    <div class="loginsignupcontainer">

      <div class="loginsignupform-container logsign-in">
      <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>" onsubmit="return loginValidation()">
          <h1>Login</h1>
          <span>Use your email and password to login</span>
          <span id="logemailerr" style="color:red;"></span>
          <input type="email" placeholder="Email" id="logemail" name="logemail" value="<?php echo $enteredEmail; ?>"/>

          <span id="logpassworderr" style="color:red;"></span> 
          <input type="password" placeholder="Password" id="logpassword" name="logpassword" value="<?php echo $enteredPassword; ?>" />
          <span style="color:red;"><?php echo $dbError; ?></span>
          <button type="submit">Login</button>
        </form>
      </div>
      <div class="loginsignup2-container">
        <div class="loginsignup2">

          <div class="loginsignup-panel loginsignup-right">
            <h1>Don't have an account?</h1>
            <p>Register to use all of site features</p>
            <button><a href="signup.php">Sign Up</a></button>
          </div>
        </div>
      </div>
    </div>

    <script>
        function loginValidation(){

        
         const logemail = document.getElementById("logemail").value;
         const logpassword = document.getElementById("logpassword").value;
         let hasError = false;

         if(logemail === ""){
                document.getElementById("logemailerr").innerHTML = "Email is required!";
                
                hasError = true;
            }
            
            if(logpassword === ""){
                document.getElementById("logpassworderr").innerHTML = "Password is required!";
                
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

<script src="script.js"></script> 

    
    <!--signin page ends here-->

    <footer>
      <marquee class="marquee">
        Hurry Up!! / / Signup for deals / / Contact No.9861599807 / / Email:
        hamro_laptop@gmail.com / / Hurry Up!! / / Signup for deals / / Contact
        No.9861599807 / / Email: hamro_laptop@gmail.com
      </marquee>
    </footer>
  </body>
</html>
