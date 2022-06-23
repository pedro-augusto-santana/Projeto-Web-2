function deleteProduct(e) {
  const id = e.target.id;
  if (confirm(`Deseja mesmo deletar o produto ${id} ?`)) {
    fetch(`/api/functions.php`, {
      method: "POST",
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      body: `action=deleteProduct&id=${id}`
    }).then(response => response.json())
      .then(response => {
        if (response.code == 200) {
          window.location.href = "/products/view.php";
        }
      });

  }
  return;

}



