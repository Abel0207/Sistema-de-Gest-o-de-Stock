<?php
    require '../../config.php';    
    require 'verificar.php';

    $id_categoria = filter_input(INPUT_GET, 'id_categoria');
    if($id_categoria){
    $sql = $pdo->prepare("DELETE FROM categorias WHERE id_categoria = :id_categoria");
    $sql->bindValue(':id_categoria', $id_categoria);
    $sql->execute();
    echo"<script>alert('Categoria removida')</script>";
    echo "<script>window.location = 'categorias.php'</script>";
   }
   echo "<script>window.location = 'categorias.php'</script>";
   
?>