// script.js
function handleReset(event) {
  event.preventDefault();
  const formData = new FormData(event.target);

  fetch('reset-password.php', {
    method: 'POST',
    body: formData
  })
  .then(response => response.json())
  .then(data => {
    alert(data.message); // Ex: "Link enviado para seu e-mail!"
  });
}

function handleCadastro(event) {
  event.preventDefault();
  const formData = new FormData(event.target);

  fetch('cadastro.php', {
    method: 'POST',
    body: formData
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      alert("Cadastro realizado! Redirecionando...");
      window.location.href = "dashboard.html";
    } else {
      alert("Erro: " + data.message);
    }
  });
}

function handleLogin(event) {
  event.preventDefault();
  const formData = new FormData(event.target);

  fetch('login.php', {
    method: 'POST',
    body: formData
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      window.location.href = "dashboard.html";
    } else {
      alert("Login falhou: " + data.message);
    }
  });
}