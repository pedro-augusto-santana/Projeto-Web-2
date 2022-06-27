const userFormEdit = document.getElementById("user-edit__form");

userFormEdit.onsubmit = (e) => {
  e.preventDefault();
  var url = new URL(window.location.href);
  var id = url.searchParams.get("id");
  const name = userFormEdit.elements['name'].value;
  const email = userFormEdit.elements['email'].value;
  const role = userFormEdit.elements['role'].value;

  fetch(`/api/functions.php`, {
    method: "POST",
    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
    body: `action=editUser&id=${id}&name=${name}&email=${email}&role=${role}`
  }).then(response => response.json())
    .then(response => {
      if (response.code == 200) {
        window.location.href = "/users/view.php";
      } else {
        window.alert(response.message);
      }
    });

}


