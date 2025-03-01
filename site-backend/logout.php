<?php
    session_start();
    session_destroy();
    header("Location: /cardapio.backend.biz/login.php");
    exit;
?>