<?php
$host = 'ics.mysql.database.azure.com';
$db   = 'ics';
$user = 'ifrn';
$pass = 'Projetoics123';

// Criar conexão
$conn = new mysqli($host, $user, $pass, $db);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>