<?php
  $conexao = mysqli_connect('192.168.0.2', 'root', 'ifrn') or die(mysqli_connect_error($conexao));
  mysqli_select_db($conexao, 'projeto_ics') or die(mysqli_error($conexao));
?>
