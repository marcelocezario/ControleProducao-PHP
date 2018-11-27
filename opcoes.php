<?php 

session_start();

if($_GET['acao'] == 'sair'){
    session_destroy();
    header("location: login.php");
} else if($_GET['acao'] == 'limpar'){
    unset($_SESSION['carrinho']);
    header("location: login.php");
}

?>