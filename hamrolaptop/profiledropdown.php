<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Profile Dropdown</title>
  <style>
    
body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
}

header {
  display: flex;
  justify-content: flex-end;
  padding: 10px 20px;
  background-color: #f5f5f5;
  position: relative;
}

.profile-container {
  position: relative;
}

.profile-pic {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  cursor: pointer;
  border: 2px solid #ddd;
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

.dropdown button {
  width: 100%;
  padding: 10px;
  border: none;
  background-color: transparent;
  text-align: left;
  cursor: pointer;
}

.dropdown button:hover {
  background-color: #f0f0f0;
}

  </style>
</head>
<body>
  <header>
    <div class="profile-container">
      <img src="profile.jpg" alt="Profile Picture" class="profile-pic" id="profilePic">
      <div class="dropdown" id="dropdown">
        <button onclick="viewProfile()">Your Profile</button>
        <button onclick="logout()">Log Out</button>
      </div>
    </div>
  </header>
  <script>
    // script.js
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
