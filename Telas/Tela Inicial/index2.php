// Renomeie para index2.php e adicione no início:
<?php 
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../Tela de Login/index.html');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fanáticos FC</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>

<header>
    <div class="logo">Fanáticos FC</div> 
    <nav>
        <ul>
            <li><a href="../Tela de Login/index.html">Login</a></li>
            <li><a href="../Tabela/tabela.html">Tabela Brasileirão A</a> </li>
        </ul>
    </nav>
</header>

<main class="container">
    
    <div class="list">

        <div class="item active">
            <div class="imagem1">
                <img src="img-ancelotti.jpg" alt="Novo Técnico do Brasil">
            </div>
            <div class="content">
                <p class="tag1">Seleção Brasileira</p> 
                <p class="name1">Carlo Ancelotti é o novo técnico da seleção brasileira</p> 
                <p class="descricao">
                    O anúncio foi feito pela CBF na manhã desta segunda-feira. Sem técnico desde a saída de Dorival Júnior, em março, a Seleção enfrenta Equador e Paraguai na próxima Data Fifa, em junho.
                </p>  
                <!-- Botão modificado para link clicável -->
                <a href="https://ge.globo.com/futebol/selecao-brasileira/noticia/2025/05/12/carlo-ancelotti-e-o-novo-tecnico-da-selecao-brasileira.ghtml" target="_blank" class="btn">Saiba Mais</a>
                <p class="descricao-completa" style="display: none;">
                    Ancelotti, multicampeão por clubes europeus, assume a Seleção com a missão de renovar o time e trazer um título inédito. Sua experiência no Real Madrid é vista como diferencial para lidar com craques e pressão.
                </p>
            </div>
        </div>

        <div class="item">
            <div class="imagem1"> 
                <img src="portugal-euro.jpg" alt="Bicampeão 2025">
            </div>
            <div class="content">
                <p class="tag1">Portugal Bicampeão</p> 
                <p class="name1">Portugal vence a Espanha nos pênaltis e conquista o bicampeonato da Liga das Nações</p> 
                <p class="descricao">
                   Com grande atuação de Nuno Mendes, e gol fundamental de Cristiano Ronaldo no segundo tempo, a seleção portuguesa bateu a Espanha por 5 a 3 nas penalidades, após empate em 2 a 2, e conquistou pela segunda vez a Liga das Nações da Uefa.
                </p>  
                <!-- Botão modificado para link clicável -->
                <a href="https://www.uol.com.br/esporte/futebol/ultimas-noticias/2025/06/08/portugal-x-espanha-final-liga-das-nacoes.htm" target="_blank" class="btn">Saiba Mais</a>
                <p class="descricao-completa" style="display: none;">
                    A partida foi realizada no Estádio da Luz, em Lisboa. O técnico Roberto Martínez destacou a união e disciplina do elenco. Cristiano Ronaldo marcou seu 135º gol pela seleção e Nuno Mendes foi eleito o melhor em campo.
                </p>
            </div>
        </div>

        <div class="item">
            <div class="imagem1"> 
                <img src="ney-fica.jpg" alt="Neymar renova com Santos">
            </div>
            <div class="content">
                <p class="tag1">Ele fica!</p> 
                <p class="name1">Neymar renova com Santos e novo contrato pode chegar a R$ 95 milhões</p> 
                <p class="descricao">
                   Com contrato prestes a expirar, dia 30 de junho, o Santos tratou logo de garantir a permanência do craque. Atleta e diretoria irão assinar nos próximos dias o novo contrato, que vai até dezembro de 2026.
                </p>  
                <!-- Botão modificado para link clicável -->
                <a href="https://www.terra.com.br/esportes/santos/ele-fica-neymar-renova-com-santos-e-novo-contrato-pode-chegar-a-r-95-milhoes,c8c124945bac9a84034b63099239920c0dhqzbwg.html" target="_blank" class="btn">Saiba Mais</a>
                <p class="descricao-completa" style="display: none;">
                    O novo contrato inclui bonificações por desempenho, direitos de imagem e cláusulas especiais para ações de marketing. A diretoria santista acredita que a presença de Neymar será essencial para atrair patrocinadores.
                </p>
            </div>
        </div>

    </div> 

    <div class="arrows">
        <button class="arrow-btn" id="prev">
            ◀
        </button>
        <button class="arrow-btn" id="next">
            ▶
        </button>
    </div>

    <div class="indicators">
        <div class="numbers">01</div>
        <div class="dots">
            <div class="dot active"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </div>
    </div>
</main>

<script src="scripts.js"></script>

</body>
</html>
