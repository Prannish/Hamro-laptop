<?php
include "connection.php";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hamro _Laptop_signup_page</title>
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
    <?php


    //signup php
    $enteredName = "";
    $enteredEmail = "";
    $enteredPassword = "";
    $enteredPhone="";
    $enteredDob="";
    $enteredAddress="";

    $dbError = "";


     if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $enteredName = $_POST['name'];
        $enteredEmail = $_POST['email'];
        $enteredPassword = $_POST['password'];
        $enteredPhone = $_POST['phone'];
        $enteredDob = $_POST['dob'];
        $enteredAddress = $_POST['address'];

      
            // echo "You can now save the data to server";
            $check = "select * from users where email='$enteredEmail'";   
            $res = mysqli_query($conn, $check);   // execute mysql query
          
            if (mysqli_num_rows($res) > 0) { // return int
            // d - if already exists : Email ALready exist
              $dbError = "Email Already Exists";
            } else {
              $dbError = "";
            // e - if not save data in table : id,name, email,password,number,dob,address
              $hashedPassword = password_hash($enteredPassword, PASSWORD_DEFAULT);
                $sql = "insert into users(fullname,email,password,phone,DOB,address) values('$enteredName','$enteredEmail','$hashedPassword','$enteredPhone','$enteredDob','$enteredAddress')";
        
              $result = mysqli_query($conn, $sql); // returns True if data is inserted
              if ($result) {
               // f - Redirect user on login page
                header('Location: login.php');
              
              }
            // }
        
        }
    }

    
   ?>


    <!--signin page starts here-->

    <div class="loginsignupcontainer">
      <div class="loginsignupform-container logsign-in">
        <form method = "POST" action="<?php echo $_SERVER["PHP_SELF"]?>" onsubmit="return validateForm()">
          <h1>Create Account</h1>
          <span id="nameerr" style="color:red;"></span>
          <input id="name"  name="name" type="text" placeholder="Name" value="<?php echo $enteredName; ?>" />

          <span id="emailerr" style="color:red;"></span>
          <span style="color:red;"><?php echo $dbError;?></span>
          <input id="email" name="email" type="email" placeholder="Email" value="<?php echo $enteredEmail; ?>"/>

          <span id="passworderr" style="color:red;"></span>
          <input id="password" name="password" type="password" placeholder="Password" />

          <span id="confirmpassworderr" style="color:red;"></span>
          <input id="confirmpassword" name="comfirmpassword" type="password" placeholder="Confirm Password"  />
          
          <span id="phoneerr" style="color:red;"></span>
          <input id="phone"  name="phone" type="number" placeholder="Phone Number" value="<?php echo $enteredPhone; ?>"/>

          <span id="doberr" style="color:red;"></span>
          <input id="dob"  name="dob" type="date" placeholder="Date-of-birth" value="<?php echo $enteredDob; ?>"/>

          <span id="addresserr" style="color:red;"></span>
          <input id="address" name="address" type="text" placeholder="Address" value="<?php echo $enteredAddress; ?>" />

          <button type="submit">Sign Up</button>
        </form>
      </div>

      <div class="loginsignup2-container">
        <div class="loginsignup2">
          <div class="loginsignup-panel loginsignup-right">
            <h1>Already have an account?</h1>
            <p>Login to use all of site features</p>
            <button><a href="login.php">Login</a></button>
          </div>
        </div>
      </div>
    </div>


    <script>
        function validateForm(){
            const name = document.getElementById("name").value;
            const email = document.getElementById("email").value;
            const password = document.getElementById("password").value;
            const confirmpassword = document.getElementById("confirmpassword").value;
            const phone = document.getElementById("phone").value;
            const dob = document.getElementById("dob").value;
            const address = document.getElementById("address").value;
            let hasError = false;
                // return true;
            if(name === ""){
                document.getElementById("nameerr").innerHTML = "Name is required!";
                hasError =  true;
            }

            if(email === ""){
                document.getElementById("emailerr").innerHTML = "Email is required!";
                
                hasError = true;
            }
            
            if(password === "" || password <= 6){
                document.getElementById("passworderr").innerHTML = "Password must be more than 6 characters!";
                
                hasError = true;
            }

            if(confirmpassword === "" || !confirmpassword === password){
                document.getElementById("confirmpassworderr").innerHTML = "Passwords don't match!";
                
                hasError = true;
            }

            if(phone === "" || !phone === 10 ){
                document.getElementById("phoneerr").innerHTML = "Phone number don't exist!";
                
                hasError = true;
            }

            if(dob === ""){
                document.getElementById("doberr").innerHTML = "DOB must be entered!";
                
                hasError = true;
            }

            if(address === ""){
                document.getElementById("addresserr").innerHTML = "Not a valid address!";
                
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
