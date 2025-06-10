<?php
header('Content-Type: application/json');
include 'includes/conexao.php';

$email = $_POST['email'] ?? '';

// Verifica se e-mail existe
$stmt = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();

if ($stmt->get_result()->num_rows === 0) {
    echo json_encode(['success' => false, 'message' => 'E-mail não cadastrado!']);
    exit;
}

// Gera token temporário (exemplo simplificado)
$token = bin2hex(random_bytes(16));
$expiracao = date('Y-m-d H:i:s', strtotime('+1 hour')); // Token válido por 1 hora

// Atualiza no banco (na prática, envie por e-mail)
$stmt = $conn->prepare("UPDATE usuarios SET reset_token = ?, reset_expira = ? WHERE email = ?");
$stmt->bind_param("sss", $token, $expiracao, $email);
$stmt->execute();

// Em produção, envie um e-mail com um link como:
// `resetar-senha.html?token='.$token
echo json_encode([
    'success' => true,
    'message' => 'Link de recuperação enviado para seu e-mail! (Simulação)'
]);
?>


