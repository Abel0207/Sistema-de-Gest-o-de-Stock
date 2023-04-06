<?php
    require '../../config.php';    
    require 'verificar.php';

    $id_prod = filter_input(INPUT_GET, 'id_prod');
    if($id_prod){
    $sql = $pdo->prepare("DELETE FROM produtos WHERE id_prod = :id_prod");
    $sql->bindValue(':id_prod', $id_prod);
    $sql->execute();
    echo"<script>alert('O produto foi removido')</script>";
    echo "<script>window.open('produtos.php', '_self')</script>";
   }
   echo "<script>window.open('produtos.php', '_self')</script>";
?>