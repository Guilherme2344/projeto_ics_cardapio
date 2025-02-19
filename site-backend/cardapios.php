<?php
session_start();
require '../includes/config.php';

if (!isset($_SESSION['gestor_email'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $categoria = $_POST['categoria'];
    $gestor_email = $_SESSION['gestor_email'];

    $stmt = $conn->prepare("INSERT INTO cardapio (categoria, gestor_email) VALUES (?, ?)");
    $stmt->bind_param("ss", $categoria, $gestor_email);

    if ($stmt->execute()) {
        echo "Cardápio cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar cardápio: " . $stmt->error;
    }

    $stmt->close();
}

$sql = "SELECT * FROM cardapio WHERE gestor_email = '{$_SESSION['gestor_email']}'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Cardápios</title>
    <link rel="icon" href="estilo/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="estilizacao/cardapios.css">
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
        <section id="cadastrar-cardapios">
            <h2>Cadastrar Cardápio</h2>
            <form method="post">
                <label for="categoria">Categoria:</label>
                <input type="text" id="categoria" name="categoria" required><br>
                <input type="submit" value="Cadastrar">
            </form>
        </section>
        <section id="lista-cardapios">
            <h2>Lista de Cardápios</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Categoria</th>
                    <th>Ações</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['categoria']; ?></td>
                    <td>
                        <a href="editar_cardapio.php?id=<?php echo $row['id']; ?>">Editar</a>
                        <a href="excluir_cardapio.php?id=<?php echo $row['id']; ?>">Excluir</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </table>
        </section>
    </main>
</body>

</html>
