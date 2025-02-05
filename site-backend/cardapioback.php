<?php

include('conexao.php');

$sql = mysqli_query($conexao, 'select * from alunos') or die(mysqli_error($conexao));

$sql = "INSERT INTO gestor (email, nome, senha) VALUES ('$gestor_email', '$gestor_nome', '$gestor_senha') 
        ON DUPLICATE KEY UPDATE id=LAST_INSERT_ID(id)";
$conn->query($sql);
$gestor_id = $conn->insert_id;


$categoria = $_POST['categoria'];
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
