<?php
$servername = "ics.mysql.database.azure.com";
$username = "ifrn";
$password = "Projetoics123";
$dbname = "ics";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if(!$conn){
    die("Conexão falhou: " . mysqli_connect_error());
}
?>