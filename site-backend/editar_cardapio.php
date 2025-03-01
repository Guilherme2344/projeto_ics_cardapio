<?php
session_start();
require '../includes/config.php';

if (!isset($_SESSION['gestor_email'])) {
    header('Location: /cardapio.backend.biz/login.php.php');
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
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="estilizacao/editcard.css">
</head>

<body>
    <header>
        <h1><img src="images/logo.png" alt="PY Bistro" width="105" height="70"></h1>
        <nav>
            <ul>
                <li><a href="/cardapio.backend.biz/index.php">Home</a></li>
                <li><a href="/cardapio.backend.biz/itens.php">Itens</a></li>
                <li><a href="/cardapio.backend.biz/cardapios.php">Cardápios</a></li>
                <li><a id="sair" href="/cardapio.backend.biz/logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="container">
            <h2>Editar Cardápio</h2>
            <form method="post">
                <input type="hidden" name="id" value="<?php echo $cardapio['id']; ?>">
                
                <label for="categoria">Categoria:</label>
                <input type="text" name="categoria" id="categoria" value="<?php echo $cardapio['categoria']; ?>" required>
                
                <input type="submit" value="Atualizar">
            </form>
        </div>
    </main>
</body>

</html>