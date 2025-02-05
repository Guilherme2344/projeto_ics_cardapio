<?php
  $conexao = mysqli_connect('192.168.100.20', 'ics', '1fr') or die(mysqli_connect_error($conexao));
  mysqli_select_db($conexao, 'sitecs') or die(mysqli_error($conexao));
?>
