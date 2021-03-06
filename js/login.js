const loginForm = document.getElementById("login-form");
const loginBtn = document.getElementById("newacc-btn");

loginForm.onsubmit = (e) => {
  e.preventDefault();
  e.stopPropagation();
  const email = loginForm.elements['email'].value;
  const passwd = rot47(loginForm.elements['passwd'].value);

  fetch(`/api/functions.php?action=login&email=${email}&passwd=${passwd}`)
    .then((response) => response.json())
    .then((response) => {
      if (response.code != 200) {
        const errModal = document.getElementById("err-modal");
        errModal.style.display = "flex";
        errModal.innerHTML = `<p>Erro: ${response.message}</p>`;
        setTimeout(() => { errModal.style.display = "none" }, 7500);
      }
      else {
        document.cookie = `croodtoken=${response.token};`;
        window.location.href = "/home.php";
      }
    });
}

loginBtn.onclick = (e) => {
  e.preventDefault();
  window.location.href = "/signup.php";
}
