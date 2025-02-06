<?php
session_start();
require '../includes/config.php';

if (!isset($_SESSION['gestor_email'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM item WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header('Location: itens.php');
        exit;
    } else {
        echo "Erro ao excluir item: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>