<?php

    $db_name = 'gestao_de_stock';
    $db_host = 'localhost:3306';
    $db_user = 'root';
    $db_senha = '';

    $pdo = new PDO("mysql:dbname=".$db_name.";host=".$db_host, $db_user, $db_senha, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
?>
    