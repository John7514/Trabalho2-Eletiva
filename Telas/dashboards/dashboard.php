<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/styles.css">
</head>
<body>
    <h1>Bem-vindo, <?php echo $_SESSION['usuario_nome']; ?>!</h1>
    <p>Tipo de conta: <?php echo $_SESSION['usuario_tipo']; ?></p>
    <a href="logout.php">Sair</a>
</body>
</html>