<?php
    require '../../config.php';    
    require 'verificar.php';

    $cod_fat = filter_input(INPUT_GET, 'cod_fat');
    if($cod_fat){
    $sql = $pdo->prepare("DELETE FROM vendas WHERE cod_fat = :cod_fat");
    $sql->bindValue(':cod_fat', $cod_fat);
    $sql->execute();
    echo"<script>alert('Sucesso')</script>";
    echo"<script>window.location.href = 'vendas.php'</script>";
   }
   
?>