const signupForm = document.getElementById("signup-form");
const doSignupButton = document.getElementById("do-signup");
const gotoLogin = document.getElementById("goto-login");

gotoLogin.onclick = (e) => {
  e.preventDefault();
  window.location.href = "/login";
}

doSignupButton.onclick = (e) => {
  e.preventDefault();
  fetch("api/login.php", {
    method: "POST",
    headers: {},
    body: JSON.stringify({
      "email": signupForm.elements["email"].value,
      "password": rot47(signupForm.elements["passwd"].value),
      "name": signupForm.elements["name"].value,
      "role": signupForm.elements["role-selector"].value,
      "action": "signup"
    })
  }).then((response) => response.json())
    .then((response) => {
      showModal(response.error, response.reason ?? "Conta criada com sucesso");
    });

}
