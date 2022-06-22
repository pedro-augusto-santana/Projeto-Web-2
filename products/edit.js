const productFormEdit = document.getElementById("product-edit__form");

productFormEdit.onsubmit = (e) => {
  e.preventDefault();
  var url = new URL(window.location.href);
  var id = url.searchParams.get("id");
  const name = productFormEdit.elements['name'].value;
  const sale_price = productFormEdit.elements['sale_price'].value;
  const buy_price = productFormEdit.elements['buy_price'].value;
  const quantity = productFormEdit.elements['quantity'].value;
  const description = productFormEdit.elements['description'].value;
  const seller = productFormEdit.elements['seller'].value;

  fetch(`/api/functions.php`, {
    method: "POST",
    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
    body: `action=editProduct&id=${id}&name=${name}&quantity=${quantity}&sale_price=${sale_price}&buy_price=${buy_price}
    &description=${description}&seller=${seller}`
  }).then(response => response.json())
    .then(response => {
      if (response.code == 200) {
        window.location.href = "/products/view.php";
      }
    });

}

