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
    <div class="container">
        <h1>Menu</h1>
        <ul>
            <li><a href="itens.php">Itens</a></li>
            <li><a href="cardapios.php">Cardápios</a></li>
            <li><a id="logouta" href="logout.php">Logout</a></li>
        </ul>
    </div>
</body>

</html>
