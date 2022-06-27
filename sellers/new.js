window.onload = () => {
  const stateSelector = document.getElementById("state__select");
  console.log(stateSelector.value);
  let url = new URL(window.location.href);
  fetch(`/api/functions.php?action=getCities&state=${stateSelector.value}`, {
  }).then(response => response.json())
    .then(response => {
      const citySelector = document.getElementById("city__select");
      citySelector.innerHTML = response.data;
    });

}

const sellerFormNew = document.getElementById("seller-new__form");
sellerFormNew.onsubmit = (e) => {
  e.preventDefault();
  const name = sellerFormNew.elements['name'].value;
  const city = `${sellerFormNew.elements['city'].value} - ${sellerFormNew.elements['state'].value}`;
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
      } else {
        window.alert(response.message);
      }
    });
};

function loadStateCities(evt) {
  fetch(`/api/functions.php?action=getCities&state=${evt.target.value}`, {
  }).then(response => response.json())
    .then(response => {
      const citySelector = document.getElementById("city__select");
      citySelector.innerHTML = response.data;
    });
}

