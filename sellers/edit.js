const sellerFormEdit = document.getElementById("seller-edit__form");

sellerFormEdit.onsubmit = (e) => {
  e.preventDefault();
  var url = new URL(window.location.href);
  var id = url.searchParams.get("id");
  const name = sellerFormEdit.elements['name'].value;
  const city = sellerFormEdit.elements['city'].value;
  const manager = sellerFormEdit.elements['manager'].value;
  const email = sellerFormEdit.elements['email'].value;

  fetch(`/api/functions.php`, {
    method: "POST",
    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
    body: `action=editSeller&id=${id}&name=${name}&city=${city}&manager=${manager}&email=${email}`
  }).then(response => response.json())
    .then(response => {
      if (response.code == 200) {
        window.location.href = "/sellers/view.php";
      }
    });

}


