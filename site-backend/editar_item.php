<?php
session_start();
require '../includes/config.php';

if (!isset($_SESSION['gestor_email'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'];
    $sql = "SELECT * FROM item WHERE id = $id";
    $result = $conn->query($sql);
    $item = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $tipo = $_POST['tipo'];
    $descricao = $_POST['descricao'];

    $stmt = $conn->prepare("UPDATE item SET tipo = ?, descricao = ? WHERE id = ?");
    $stmt->bind_param("ssi", $tipo, $descricao, $id);

    if ($stmt->execute()) {
        header('Location: itens.php');
        exit;
    } else {
        echo "Erro ao atualizar item: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Editar Item</title>
</head>

<body>
    <h1>Editar Item</h1>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
        Tipo: <input type="text" name="tipo" value="<?php echo $item['tipo']; ?>" required><br>
        Descrição: <textarea name="descricao"><?php echo $item['descricao']; ?></textarea><br>
        <input type="submit" value="Atualizar">
    </form>
</body>

</html>