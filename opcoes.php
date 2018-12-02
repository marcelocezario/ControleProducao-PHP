<?php 
session_start();

if($_GET['acao'] == 'sair'){
    session_destroy();
    header("location: ".$_POST['urlAnterior']);
} else if($_GET['acao'] == 'limpar'){
    unset($_SESSION['carrinho']);
    header("location: ".$_POST['urlAnterior']);
}

?>