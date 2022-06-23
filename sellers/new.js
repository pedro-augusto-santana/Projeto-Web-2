const sellerFormNew = document.getElementById("seller-new__form");
sellerFormNew.onsubmit = (e) => {
  e.preventDefault();
  const name = sellerFormNew.elements['name'].value;
  const city = sellerFormNew.elements['city'].value;
  const manager = sellerFormNew.elements['manager'].value;
  const email = sellerFormNew.elements['email'].value;

  fetch(`/api/functions.php`, {
    method: "POST",
    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
    body: `action=newSeller&name=${name}&city=${city}&manager=${manager}&email=${email}`
  }).then(response => response.json())
    .then(response => {
      if (response.code == 200) {
        window.location.href = "/sellers/view.php";
      }
    });
};


