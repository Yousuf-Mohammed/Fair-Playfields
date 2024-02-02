// JavaScript (login-script.js)
function clearLoginForm() {
  document.getElementById("loginForm").reset();
}

function clearSignupForm() {
  document.getElementById("signupForm").reset();
}

function showPosition(selectedValue) {
  document.getElementById("position").style.display =
    selectedValue === "player" ? "block" : "none";
}

// /////////////////////////////////
/*create_match.php Clear button */
function clearForm() {
  document.getElementById("match-name").value = "";
  document.getElementById("date").value = "";
  document.getElementById("time-from").value = "";
  document.getElementById("time-to").value = "";
  document.getElementById("min-players").value = "";
  document.getElementById("max-players").value = "";
  document.getElementById("location").value = "";
}
