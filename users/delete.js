function deleteUser(e) {
  const id = e.target.id;
  if (confirm(`Deseja mesmo deletar esse usuário ? {id = ${id}}`)) {
    fetch(`/api/functions.php`, {
      method: "POST",
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      body: `action=deleteUser&id=${id}`
    }).then(response => response.json())
      .then(response => {
        if (response.code == 200) {
          window.location.href = "/users/view.php";
        }
      });

  }
  return;

}

