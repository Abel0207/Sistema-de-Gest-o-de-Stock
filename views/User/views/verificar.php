<?php
   session_start();
     if(!isset($_SESSION['id'])){
        header("location: ../../login.php");
        exit();
     }else{
      $sql = $pdo->query("SELECT * FROM usuarios WHERE id = '$_SESSION[id]'");
      $consulta = $sql->fetch(PDO::FETCH_ASSOC);
     }
?>