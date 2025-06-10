<?php
header('Content-Type: application/json');

// Inclui a conexão com o banco
include 'includes/conexao.php';

// Recebe dados do formulário
$nome = $_POST['nome'] ?? '';
$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';
$tipo = $_POST['tipo'] ?? 'comum'; // Padrão: comum

// Validações básicas
if (empty($nome) || empty($email) || empty($senha)) {
    echo json_encode(['success' => false, 'message' => 'Preencha todos os campos!']);
    exit;
}

// Verifica se e-mail já existe
$stmt = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
if ($stmt->get_result()->num_rows > 0) {
    echo json_encode(['success' => false, 'message' => 'E-mail já cadastrado!']);
    exit;
}

// Criptografa a senha
$senhaHash = password_hash($senha, PASSWORD_DEFAULT);

// Insere no banco
$stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha, tipo) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $nome, $email, $senhaHash, $tipo);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Cadastro realizado com sucesso!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Erro no cadastro: ' . $conn->error]);
}
?>
