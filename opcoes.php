<?php 
session_start();

if($_GET['acao'] == 'sair'){
    unset($_SESSION['cliente']);
    unset($_SESSION['cupom']);
    unset($_SESSION['enderecoEntrega']);
    header("location: ".$_SESSION['urlAnterior']);
} else if($_GET['acao'] == 'limpar'){
    unset($_SESSION['carrinho']);
    header("location: ".$_SESSION['urlAnterior']);
}

?>