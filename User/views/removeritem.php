<?php
    require '../../config.php';
    require 'verificar.php';

    $id_prod = filter_input(INPUT_GET, 'id_prod');
    /* Remover do carrinho */
    if($id_prod){
        $idProduto = $_GET['id_prod'];
        unset( $_SESSION['itens'][$idProduto]);
        echo '<META HTTP-EQUIV="REFRESH" CONTENT="0;URL=adicionarcarrinho.php">';
    }else{
        echo"Erro grave";
    }
?>