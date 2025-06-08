// script.js
function handleReset(event) {
  event.preventDefault();
  alert("Um link de recuperação foi enviado para o seu e-mail!");
  // Simulação de envio e retorno à tela de login
  window.location.href = "index.html";
}

function handleCadastro(event) {
  event.preventDefault();
  alert("Conta criada com sucesso!");
  window.location.href = "index.html"; // Volta para a tela de login
}