<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../Tela de Login/index.html');
    exit;
}

include 'includes/conexao.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Meu Time - Cartola FC</title>
    <link rel="stylesheet" href="../assets/styles.css">
    <style>
        .jogadores-container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }
        .jogador-card {
            border: 1px solid #ccc;
            padding: 10px;
            width: 150px;
            cursor: grab;
        }
        .time-escalado {
            min-height: 300px;
            border: 2px dashed #00f7ff;
        }
    </style>
</head>
<body>
    <h1>Olá, <?php echo $_SESSION['usuario_nome']; ?>!</h1>
    <p>Saldo: R$ <span id="saldo">100.00</span></p> <!-- Valor fictício -->

    <!-- Tabela de Jogadores Disponíveis -->
    <h2>Jogadores Disponíveis</h2>
    <div class="jogadores-container" id="jogadores-disponiveis">
        <?php
        $query = $conn->query("SELECT * FROM jogadores");
        while ($jogador = $query->fetch_assoc()) {
            echo '<div class="jogador-card" draggable="true" data-id="'.$jogador['id'].'">
                <strong>'.$jogador['nome'].'</strong><br>
                '.$jogador['posicao'].' | '.$jogador['clube'].'<br>
                R$ '.$jogador['preco'].'
            </div>';
        }
        ?>
    </div>

    <!-- Time Escalado -->
    <h2>Meu Time</h2>
    <div class="time-escalado" id="time-escalado" ondrop="dropHandler(event)" ondragover="dragoverHandler(event)">
        Arraste jogadores para aqui!
    </div>

    <script>
        // Lógica de arrastar/soltar (simplificado)
        document.querySelectorAll('.jogador-card').forEach(card => {
            card.addEventListener('dragstart', e => {
                e.dataTransfer.setData('text/plain', e.target.dataset.id);
            });
        });

        function dropHandler(e) {
            e.preventDefault();
            const jogadorId = e.dataTransfer.getData('text/plain');
            
            alert(`Jogador ${jogadorId} escalado!`);
        }

        function dragoverHandler(e) {
            e.preventDefault();
        }
document.addEventListener('DOMContentLoaded', () => {
    const slots = document.querySelectorAll('.posicao');
    
    slots.forEach(slot => {
        slot.addEventListener('dragover', (e) => {
            e.preventDefault();
            slot.style.border = '2px dashed #00f7ff';
        });

        slot.addEventListener('dragleave', () => {
            slot.style.border = '1px solid #ccc';
        });

        slot.addEventListener('drop', async (e) => {
            e.preventDefault();
            slot.style.border = '1px solid #ccc';
            
            const jogadorId = e.dataTransfer.getData('jogador_id');
            const posicao = slot.dataset.pos;

            try {
                const response = await fetch('escalar-jogador.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ jogador_id: jogadorId, posicao })
                });

                const data = await response.json();

                if (data.success) {
                    slot.innerHTML = `Jogador ${jogadorId} escalado!`;
                    document.getElementById('saldo').textContent = data.novo_saldo.toFixed(2);
                } else {
                    alert(data.error || 'Erro ao escalar jogador');
                }
            } catch (error) {
                console.error('Erro:', error);
            }
        });
    });
});
    </script>
</body>
</html>