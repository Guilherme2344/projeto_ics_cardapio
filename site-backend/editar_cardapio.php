<?php
session_start();
require '../includes/config.php';

if (!isset($_SESSION['gestor_email'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'];
    $sql = "SELECT * FROM cardapio WHERE id = $id";
    $result = $conn->query($sql);
    $cardapio = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $categoria = $_POST['categoria'];

    $stmt = $conn->prepare("UPDATE cardapio SET categoria = ? WHERE id = ?");
    $stmt->bind_param("si", $categoria, $id);

    if ($stmt->execute()) {
        header('Location: cardapios.php');
        exit;
    } else {
        echo "Erro ao atualizar cardápio: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Editar Cardápio</title>
</head>

<body>
    <h1>Editar Cardápio</h1>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $cardapio['id']; ?>">
        Categoria: <input type="text" name="categoria" value="<?php echo $cardapio['categoria']; ?>" required><br>
        <input type="submit" value="Atualizar">
    </form>
</body>

</html>