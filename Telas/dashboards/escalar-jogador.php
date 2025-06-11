<?php
// Inicia sessão e verifica autenticação
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('HTTP/1.1 401 Unauthorized');
    exit(json_encode(['error' => 'Não autenticado!']));
}

// Conexão com o banco
require_once '../includes/conexao.php';

// Recebe dados do POST (JSON)
$input = json_decode(file_get_contents('php://input'), true);
$jogador_id = intval($input['jogador_id'] ?? 0);
$posicao = $input['posicao'] ?? 'TITULAR'; // Padrão: titular

// Validações
if ($jogador_id <= 0) {
    header('HTTP/1.1 400 Bad Request');
    exit(json_encode(['error' => 'ID do jogador inválido!']));
}

// 1. Busca preço do jogador
$stmt = $conn->prepare("SELECT preco FROM jogadores WHERE id = ?");
$stmt->bind_param("i", $jogador_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header('HTTP/1.1 404 Not Found');
    exit(json_encode(['error' => 'Jogador não encontrado!']));
}

$jogador = $result->fetch_assoc();
$preco = floatval($jogador['preco']);

// 2. Verifica saldo do usuário
if ($_SESSION['usuario_saldo'] < $preco) {
    header('HTTP/1.1 403 Forbidden');
    exit(json_encode(['error' => 'Saldo insuficiente!']));
}

// 3. Escala o jogador
try {
    $conn->begin_transaction();

    // Insere no time do usuário
    $stmt = $conn->prepare("INSERT INTO times_usuarioss (usuario_id, jogador_id, posicao_escalada) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $_SESSION['usuario_id'], $jogador_id, $posicao);
    $stmt->execute();

    // Atualiza saldo
    $conn->query("UPDATE usuarios SET saldo = saldo - $preco WHERE id = {$_SESSION['usuario_id']}");

    $conn->commit();
    echo json_encode(['success' => true, 'novo_saldo' => $_SESSION['usuario_saldo'] - $preco]);

} catch (Exception $e) {
    $conn->rollback();
    header('HTTP/1.1 500 Internal Server Error');
    echo json_encode(['error' => 'Erro ao escalar jogador: ' . $e->getMessage()]);
}
?>