function rot47(x) {
  var s = []; for (var i = 0; i < x.length; i++) {
    var j = x.charCodeAt(i); if ((j >= 33) && (j <= 126)) {s[i] = String.fromCharCode(33 + ((j + 14) % 94));}
    else {s[i] = String.fromCharCode(j);}
  }
  return s.join('');
}

function resetModal(modalRef) {
  modalRef.classList.add("hidden");
  modalRef.classList.remove("success");
  modalRef.classList.remove("error");
  modalRef.innerHTML = ``;
}

function showModal(error, message) {
  const modalRef = document.getElementById("login-modal");
  modalRef.classList.add("hidden");
  modalRef.classList.remove("hidden");
  modalRef.innerHTML = `
  <p class="modal-content">${message}</p>
  <span class="modal-close" id="modal-close">X</span>
  `;

  const close = document.getElementById("modal-close");
  close.onclick = (e) => {
    e.preventDefault();
    resetModal(modalRef);
  }

  if (error) modalRef.classList.add("error");
  else modalRef.classList.add("success");

  setTimeout(() => {
    resetModal(modalRef);
  }, 8000);

}
