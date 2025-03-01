<?php
require '../includes/config.php';

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
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="estilizacao/cadastro.css">
</head>

<body>
    <div class="container">
        <h1>Cadastrar Gestor</h1>
        <form method="post">
            Email: <input type="email" name="email" required><br>
            Nome: <input type="text" name="nome" required><br>
            Senha: <input type="password" name="senha" required><br>
            <input id="botaocadastro" type="submit" value="Cadastrar">
        </form>
        <a href="/cardapio.backend.biz/login.php">Login</a>
    </div>
</body>

</html>