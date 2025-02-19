<?php
require '../includes/config.php';
$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $nome = $_POST['nome'];
    $senha = password_hash($_POST['senha'], PASSWORD_BCRYPT);

    $stmt = $conn->prepare("INSERT INTO gestor (email, nome, senha) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $email, $nome, $senha);

    if ($stmt->execute()) {
        echo "Gestor cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar gestor: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Cadastrar Gestor</title>
    <link rel="icon" href="estilizacao/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="estilizacao/cadastro.css">
</head>

<body>

    <?php if (!empty($mensagem)) : ?>
        <div id="alerta" class="mensagem <?php echo (strpos($mensagem, 'sucesso') !== false) ? '' : 'erro'; ?>">
            <?php echo $mensagem; ?>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                let alerta = document.getElementById("alerta");
                alerta.style.display = "block";
                setTimeout(() => {
                    alerta.style.opacity = "0";
                    setTimeout(() => alerta.style.display = "none", 500);
                }, 3000);
            });
        </script>
    <?php endif; ?>
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
            <h>2Cadastrar Gestor</h2>
            <form method="post">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required><br>
    
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" required><br>
    
                <label for="senha">Senha:</label>
                <input type="password" name="senha" id="senha" required><br>
    
                <input type="submit" id="botaocadastro" value="Cadastrar">
            </form>
            <a href="login.php">Login</a>
        </div>
    </main>
</body>

</html>
