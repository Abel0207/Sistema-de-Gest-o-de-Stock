const myModal = document.getElementById('myModal')
const myInput = document.getElementById('myInput')

myModal.addEventListener('shown.bs.modal', () => {
  myInput.focus()
})


function acesso(){
  const acesso = document.getElementById('acesso');
  const novoAcesso = new bootstrap.Modal(acesso);
  novoAcesso.show();
}