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
        header('Location: ../index.php');
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
</head>

<body>
    <h1>Login</h1>
    <form method="post">
        Email: <input type="email" name="email" required><br>
        Senha: <input type="password" name="senha" required><br>
        <input type="submit" value="Login">
    </form>
</body>

</html>