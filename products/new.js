const productFormNew = document.getElementById("product-new__form");

productFormNew.onsubmit = (e) => {
  e.preventDefault();
  const name = productFormNew.elements['name'].value;
  const sale_price = productFormNew.elements['sale_price'].value;
  const buy_price = productFormNew.elements['buy_price'].value;
  const quantity = productFormNew.elements['quantity'].value;
  const description = productFormNew.elements['description'].value;
  const seller = productFormNew.elements['seller'].value;

  fetch(`/api/functions.php`, {
    method: "POST",
    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
    body: `action=newProduct&name=${name}&quantity=${quantity}&sale_price=${sale_price}&buy_price=${buy_price}
    &description=${description}&seller=${seller}`
  }).then(response => response.json())
    .then(response => {
      if (response.code == 200) {
        window.location.href = "/products/view.php";
      } else {
        window.alert(response.message);
      }
    });
};

