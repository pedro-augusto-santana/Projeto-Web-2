const forgotPasswdButton = document.getElementById("login-forgot-passwd");
const doLoginButton = document.getElementById("do-login");
const loginForm = document.getElementById("login-form");
const gotoSignup = document.getElementById("goto-signup");

gotoSignup.onclick = (e) => {
  e.preventDefault();
  window.location.href = "/signup";
}

forgotPasswdButton.onclick = (e) => {
  e.preventDefault();
  console.log("Esqueci minha senha");
}

doLoginButton.onclick = (e) => {
  e.preventDefault();
  fetch("api/login.php", {
    method: "POST",
    headers: {},
    body: JSON.stringify({
      email: loginForm.elements["email"].value,
      password: rot47(loginForm.elements["passwd"].value),
      action: "login"
    })
  }).then((response) => response.json())
    .then((response) => {
      if (response.error == true) {
        showModal(response.error, response.reason);
      }
      else {
        window.localStorage.setItem("email", loginForm.elements["email"].value);
        window.location.href = "/home";
      }
    });
}
