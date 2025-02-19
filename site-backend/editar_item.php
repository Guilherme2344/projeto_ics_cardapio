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
    <link rel="icon" href="estilo/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="estilizacao/editen.css">
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
            <h2>Editar Item</h2>
            <form method="post">
                <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                
                <label for="tipo">Tipo:</label>
                <input type="text" name="tipo" id="tipo" value="<?php echo $item['tipo']; ?>" required>
                
                <label for="descricao">Descrição:</label>
                <textarea name="descricao" id="descricao"><?php echo $item['descricao']; ?></textarea>
                
                <input type="submit" value="Atualizar">
            </form>
        </div>
    </main>
</body>

</html>
