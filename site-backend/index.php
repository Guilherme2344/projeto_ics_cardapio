<?php
session_start();

if (!isset($_SESSION['gestor_email'])) {
    header('Location: /login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Menu</title>
    <link rel="icon" href="estilizacao/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="estilizacao/menu.css">
</head>

<body>
    <header>
        <h1><img src="estilizacao/logo.png" alt="PY Bistro" width="105" height="70"></h1>
        <nav>
            <ul>
                <li><a href="/index.php">Home</a></li>
                <li><a href="/itens.php">Itens</a></li>
                <li><a href="/cardapios.php">Cardápios</a></li>
                <li><a id="sair" href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="container">
            <h2>Menu</h2>
            <ul>
                <li><a href="itens.php">Itens</a></li>
                <li><a href="cardapios.php">Cardápios</a></li>
                <li><a id="logouta" href="logout.php">Logout</a></li>
            </ul>
        </div>
    </main>
</body>

</html>
