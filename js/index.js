const logoutButton = document.getElementById("logout-btn");
logoutButton.onclick = (e) => {
  e.preventDefault();
  document.cookie = "croodtoken=;Max-Age=0;Expires=Thu, 01 Jan 1970 00:00:01 GMT;";
  window.location.href = "/login.php";
}
