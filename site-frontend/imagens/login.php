<?php
session_start();

require '../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $stmt = $conn->prepare("SELECT * FROM gestor WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $gestor = $result->fetch_assoc();

    if ($gestor && password_verify($senha, $gestor['senha'])) {
        $_SESSION['gestor_email'] = $gestor['email'];
        header('Location: /cardapio.backend.biz/index.php');
        exit;
    } else {
        echo "Email ou senha incorretos!";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="estilizacao/login.css">
</head>

<body>
    <div class="container">
        <h1>Login</h1>
        <form method="post">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required><br>

            <label for="senha">Senha:</label>
            <input type="password" name="senha" id="senha" required><br>
            <input type="submit" id="botaologin" value="Login">

            <a id="a" href="cadastrar_gestor.php">Cadastre-se</a>
        </form>
    </div>
</body>

</html>