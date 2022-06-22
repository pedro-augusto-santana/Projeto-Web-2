const signupForm = document.getElementById("signup-form");
const loginBtn =  document.getElementById("login-btn");

loginBtn.onclick = (e) => {
  e.preventDefault();
  window.location.href = "/login.php";
}

signupForm.onsubmit = (e) => {
  e.preventDefault();
  e.stopPropagation();
  const name = signupForm.elements['name'].value;
  const email = signupForm.elements['email'].value;
  const passwd = rot47(signupForm.elements['passwd'].value);

  fetch(`/api/functions.php`, {
    method: "POST",
    headers: {'Content-Type':'application/x-www-form-urlencoded'},
    body: `action=signup&email=${email}&passwd=${passwd}&name=${name}`
  })
    .then((response) => response.json())
    .then((response) => {
      if (response.code != 200) {}
      else {
        document.cookie=`croodtoken=${response.token};`;
        window.location.href = "/home.php";
      }
  });

}
