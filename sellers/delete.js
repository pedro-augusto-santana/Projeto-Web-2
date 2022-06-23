function deleteSeller(e) {
  const id = e.target.id;
  if (confirm(`Deseja mesmo deletar o fornecedor ${id} ?`)) {
    fetch(`/api/functions.php`, {
      method: "POST",
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      body: `action=deleteSeller&id=${id}`
    }).then(response => response.json())
      .then(response => {
        if (response.code == 200) {
          window.location.href = "/sellers/view.php";
        } else {
          alert(response.message);
        }
      });

  }
  return;

}


