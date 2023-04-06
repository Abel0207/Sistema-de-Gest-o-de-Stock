<?php
    require '../../config.php';    
    require 'verificar.php';

    $id = filter_input(INPUT_GET, 'id');
    if($id){
    $sql = $pdo->prepare("DELETE FROM usuarios WHERE id = :id");
    $sql->bindValue(':id', $id);
    $sql->execute();
    echo"<script>alert('Usuário removido com Sucesso')</script>";
   }
   
   header('location: utilizadores.php');
?>