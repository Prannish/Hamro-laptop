const modeBtn = document.querySelector("#mode");
let currentMode = localStorage.getItem("theme") || "dark"; // Retrieve saved theme or default to 'dark'

// Function to apply theme
function applyTheme(mode) {
    if (mode === "light") {
        document.querySelector("body").style.backgroundColor = "#42213D";
        document.querySelector(".navbar").style.backgroundColor = "#683257";
        document.querySelector(".indexcontainer").style.backgroundColor = "#683257";
        document.querySelector(".marquee").style.backgroundColor = "#BD4089";
        document.querySelector(".slide").style.backgroundColor = "#683257";
        document.querySelector(".toggle").style.backgroundColor = "#683257";
    } else {
        document.querySelector("body").style.backgroundColor = "#296eb4";
        document.querySelector(".navbar").style.backgroundColor = "#1789fc";
        document.querySelector(".indexcontainer").style.backgroundColor = "#4075c8";
        document.querySelector(".marquee").style.backgroundColor = "#1789fc";
        document.querySelector(".slide").style.backgroundColor = "#1789fc";
        document.querySelector(".toggle").style.backgroundColor = "#fff";
    }
}

// Apply theme on page load
applyTheme(currentMode);

// Switch mode event
modeBtn.addEventListener("click", () => {
    currentMode = currentMode === "light" ? "dark" : "light";
    localStorage.setItem("theme", currentMode); // Save the current theme in localStorage
    applyTheme(currentMode); // Apply the theme
});

//seemore hide unhide function
function toggleseemore(){
    var target=document.getElementById("seemore");
    if(target.style.display =="none"){
        target.style.display="block";
    }
    else{
        target.style.display="none";
       
    }
}


// javascript for profile dropdown

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

