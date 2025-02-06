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
</head>

<body>
    <h1>Menu</h1>
    <ul>
        <li><a href="/itens.php">Itens</a></li>
        <li><a href="/cardapios.php">Cardápios</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</body>

</html>