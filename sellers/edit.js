window.onload = () => {
  const stateSelector = document.getElementById("state__select");
  console.log(stateSelector.value);
  let url = new URL(window.location.href);
  let id = url.searchParams.get("id");
  fetch(`/api/functions.php?action=getCities&state=${stateSelector.value}&id=${id}`, {
  }).then(response => response.json())
    .then(response => {
      const citySelector = document.getElementById("city__select");
      citySelector.innerHTML = response.data;
    });

}

const sellerFormEdit = document.getElementById("seller-edit__form");

sellerFormEdit.onsubmit = (e) => {
  e.preventDefault();
  let url = new URL(window.location.href);
  let id = url.searchParams.get("id");
  const name = sellerFormEdit.elements['name'].value;
  const city = `${sellerFormEdit.elements['city'].value} - ${sellerFormEdit.elements['state'].value}`;
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


function loadStateCities(evt) {
  fetch(`/api/functions.php?action=getCities&state=${evt.target.value}`, {
  }).then(response => response.json())
    .then(response => {
      const citySelector = document.getElementById("city__select");
      citySelector.innerHTML = response.data;
    });
}

