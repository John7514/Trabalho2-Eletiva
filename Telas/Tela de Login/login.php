<?php
header('Content-Type: application/json');
session_start([
    'cookie_lifetime' => 86400, // 1 dia
]);

include 'includes/conexao.php';

$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$senha = $_POST['senha'] ?? '';

// Busca usuário no banco
$stmt = $conn->prepare("SELECT id, nome, senha, tipo FROM usuarios WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(['success' => false, 'message' => 'E-mail não encontrado!']);
    exit;
}

$usuario = $result->fetch_assoc();

// Verifica senha
if (!password_verify($senha, $usuario['senha'])) {
    echo json_encode(['success' => false, 'message' => 'Senha incorreta!']);
    exit;
}

// Cria sessão
$_SESSION['usuario_id'] = $usuario['id'];
$_SESSION['usuario_nome'] = $usuario['nome'];
$_SESSION['usuario_tipo'] = $usuario['tipo']; // 'comum' ou 'premium'

echo json_encode(['success' => true, 'message' => 'Login realizado!']);
?>

