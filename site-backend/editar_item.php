<?php
session_start();
require '../includes/config.php';

if (!isset($_SESSION['gestor_email'])) {
    header('Location: /cardapio.backend.biz/login.php');
    exit;
}

$item = null;

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    
    $stmt = $conn->prepare("SELECT * FROM item WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $item = $result->fetch_assoc();
    $stmt->close();

    
    if (!$item) {
        echo "Item não encontrado.";
        exit;
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if (isset($_POST['id'], $_POST['tipo'], $_POST['descricao'], $_POST['preco']) && is_numeric($_POST['id']) && is_numeric($_POST['preco'])) {
        $id = $_POST['id'];
        $tipo = trim($_POST['tipo']);
        $descricao = trim($_POST['descricao']);
        $preco = (float) $_POST['preco'];

        
        $stmt = $conn->prepare("UPDATE item SET tipo = ?, descricao = ?, preco = ? WHERE id = ?");
        $stmt->bind_param("ssdi", $tipo, $descricao, $preco, $id);

        if ($stmt->execute()) {
            header('Location: itens.php');
            exit;
        } else {
            echo "Erro ao atualizar item: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Dados inválidos.";
        exit;
    }
} else {
    echo "Requisição inválida.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Item</title>
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="estilizacao/editen.css">
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
            <h2>Editar Item</h2>
            <form method="post">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($item['id']); ?>">
                
                <label for="tipo">Tipo:</label>
                <input type="text" name="tipo" id="tipo" value="<?php echo htmlspecialchars($item['tipo']); ?>" required>
                
                <label for="descricao">Descrição:</label>
                <textarea name="descricao" id="descricao"><?php echo htmlspecialchars($item['descricao']); ?></textarea>

                <label for="preco">Preço:</label>
                <input type="number" id="preco" step="0.01" name="preco" value="<?php echo htmlspecialchars($item['preco']); ?>" required>
                
                <input type="submit" value="Atualizar">
            </form>
        </div>
    </main>
</body>
</html>
