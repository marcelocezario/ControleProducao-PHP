<?php 
session_start();

if($_GET['acao'] == 'sair'){
    unset($_SESSION['cliente']);
    header("location: ".$_POST['urlAnterior']);
} else if($_GET['acao'] == 'limpar'){
    unset($_SESSION['carrinho']);
    header("location: ".$_POST['urlAnterior']);
}

?>