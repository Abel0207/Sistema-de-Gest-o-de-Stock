<?php
    require '../../config.php';
    session_start();
    session_destroy();
    echo "<script>alert('Secção terminada')</script>";
    echo "<script>window.location = '../../login.php'</script>";
?>