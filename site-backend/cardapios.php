<?php
session_start();
require '../includes/config.php';

if (!isset($_SESSION['gestor_email'])) {
    header('Location: cardapio.backend.biz/login.php');
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

$sql = "SELECT * FROM cardapio ";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">

    <head>
        <meta charset="UTF-8">
        <title>Cardápios</title>
        <link rel="icon" href="images/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="estilizacao/cardapios.css">
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
            <section id="cadastrar_categoria">
                <h1>Cardápios</h1>
                <form method="post">
                    Categoria: <input type="text" name="categoria" required><br>
                    <input type="submit" value="Cadastrar">
                </form>
            </section>
            <section id="listagem">
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