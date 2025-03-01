<?php
require '../includes/config.php';

$sql_categorias = "SELECT id, categoria FROM cardapio";
$result_categorias = $conn->query($sql_categorias);
$categorias = [];

if ($result_categorias->num_rows > 0) {
    while ($row = $result_categorias->fetch_assoc()) {
        $categorias[] = $row;
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipo = $_POST['tipo'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $cardapio_id = $_POST['cardapio_id'];

    
    $stmt = $conn->prepare("INSERT INTO item (tipo, descricao, preco, cardapio_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssdi", $tipo, $descricao, $preco, $cardapio_id);

    if ($stmt->execute()) {
        echo "Item cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar item: " . $stmt->error;
    }

    $stmt->close();
}


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
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="estilizacao/cadastrar_itens.css">
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
        <section id="cadastar-itens">
            <h2>Cadastrar Item</h2>
            <form method="post">
                <label for="tipo">Tipo:</label>
                <input type="text" id="tipo" name="tipo" required><br>
                
                <label for="descricao">Descrição:</label>
                <textarea id="descricao" name="descricao"></textarea><br>
                
                <label for="preco">Preço:</label>
                <input type="number" id="preco" step="0.01" name="preco" required><br>
                <label for="cardapio_id">Categoria:</label>
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
        </section>
        <section id="lista-itens">
            <h2>Lista de Itens</h2>
            <table>
                <tr>
                    <th id="iddd">ID</th>
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
        </section>
    </main>
</body>

</html>