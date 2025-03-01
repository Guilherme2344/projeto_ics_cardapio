<?php
session_start();
require '../includes/config.php';

if (!isset($_SESSION['gestor_email'])) {
    header('Location: /cardapio.backend.biz/login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM cardapio WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header('Location: /cardapio.backend.biz/cardapios.php');
        exit;
    } else {
        echo "Erro ao excluir cardápio: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>