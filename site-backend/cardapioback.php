<?php
$servername = "192.160.0.2";
$username = "root";
$password = "ifrn";
$dbname = "projeto_ics";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$categoria = $_POST['categoria'];
$gestor_id = $_POST['gestor_id'];
$tipo = $_POST['tipo'];
$descricao = $_POST['descricao'];

$sql = "INSERT INTO cardapio (categoria, gestor_id) VALUES ('$categoria', '$gestor_id')";

if ($conn->query($sql) === TRUE) {
    echo "Novo registro criado com sucesso na tabela cardapio<br>";
    $cardapio_id = $conn->insert_id;
} else {
    echo "Erro: " . $sql . "<br>" . $conn->error;
}

$sql = "INSERT INTO item (tipo, descricao) VALUES ('$tipo', '$descricao')";

if ($conn->query($sql) === TRUE) {
    echo "Novo registro criado com sucesso na tabela item<br>";
    $item_id = $conn->insert_id;
} else {
    echo "Erro: " . $sql . "<br>" . $conn->error;
}

$sql = "INSERT INTO cardapio_item (cardapio_id, item_id) VALUES ('$cardapio_id', '$item_id')";

if ($conn->query($sql) === TRUE) {
    echo "Novo registro criado com sucesso na tabela cardapio_item<br>";
} else {
    echo "Erro: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
