<?php
require '../includes/config.php';

// Recuperar categorias do banco de dados
$sql_categorias = "SELECT id, categoria FROM cardapio";
$result_categorias = $conn->query($sql_categorias);
$categorias = [];

if ($result_categorias->num_rows > 0) {
    while ($row = $result_categorias->fetch_assoc()) {
        $categorias[] = $row;
    }
}

// Processar o formulário de cadastro de itens
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipo = $_POST['tipo'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $cardapio_id = $_POST['cardapio_id']; // ID da categoria selecionada

    // Inserir o item no banco de dados
    $stmt = $conn->prepare("INSERT INTO item (tipo, descricao, preco, cardapio_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssdi", $tipo, $descricao, $preco, $cardapio_id);

    if ($stmt->execute()) {
        echo "Item cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar item: " . $stmt->error;
    }

    $stmt->close();
}

// Recuperar itens para exibir na lista
$sql_itens = "SELECT item.id, item.tipo, item.descricao, item.preco, cardapio.categoria 
            FROM item 
            INNER JOIN cardapio ON item.cardapio_id = cardapio.id";
$result_itens = $conn->query($sql_itens);
$itens = [];

if ($result_itens->num_rows > 0) {
    while ($row = $result_itens->fetch_assoc()) {
        $itens[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Cadastrar Item</title>
    <link rel="stylesheet" href="estilizacao/itens.css">
</head>

<body>
    <header>
        <h1><img src="images/logo.svg" alt="logo PY Bistro"></img></h1>
        <nav>
            <ul>
                <li><a href="/index.php">Home</a></li>
                <li><a href="/itens.php">Itens</a></li>
                <li><a href="/cardapios.php">Cardápios</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h1>Cadastrar Item</h1>
        <form method="post">
            Tipo: <input type="text" name="tipo" required><br>
            Descrição: <textarea name="descricao"></textarea><br>
            Preço: <input type="number" step="0.01" name="preco" required><br>
            Categoria:
            <select name="cardapio_id" required>
                <option value="">Selecione uma categoria</option>
                <?php foreach ($categorias as $categoria): ?>
                <option value="<?php echo $categoria['id']; ?>">
                    <?php echo $categoria['categoria']; ?>
                </option>
                <?php endforeach; ?>
            </select><br>
            <input type="submit" value="Cadastrar">
        </form>

        <h2>Lista de Itens</h2>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Tipo</th>
                <th>Descrição</th>
                <th>Preço</th>
                <th>Categoria</th>
                <th>Ações</th>
            </tr>
            <?php foreach ($itens as $item): ?>
            <tr>
                <td><?php echo $item['id']; ?></td>
                <td><?php echo $item['tipo']; ?></td>
                <td><?php echo $item['descricao']; ?></td>
                <td><?php echo number_format($item['preco'], 2, ',', '.'); ?></td>
                <td><?php echo $item['categoria']; ?></td>
                <td>
                    <a href="editar_item.php?id=<?php echo $item['id']; ?>">Editar</a>
                    <a href="excluir_item.php?id=<?php echo $item['id']; ?>">Excluir</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </main>
    <footer>
        <h3><img src=""></img></h3>
    </footer>
</body>

</html>