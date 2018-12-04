<?php
include_once("default/header.php");
require_once "funcoes/funcaoProduto.php";
require_once "funcoes/funcaoCompra.php";

if(!empty($_POST)){
    $valores = array();

    $valores['valorFrete'] = $_POST['valorFrete'];
    $valores['valorDesconto'] = $_POST['valorDesconto'];
    $valores['valorCompra'] = $_POST['valorCompra'];
    $valores['totalPedido'] = $_POST['totalPedido'];
    $idMeioPagamento = $_POST['idMeioPagamento'];

    salvarPedido($_SESSION['cliente'], $_SESSION['endereco'], $_SESSION['carrinho'], $idMeioPagamento, $valores);


    print_r($_SESSION['cliente']);
}





?>