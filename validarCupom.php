<?php
    require_once "funcoes/funcaoCompra.php";
    include_once("default/header.php");


    if(empty($_POST)){
        header("location: carrinho.php");
    } else {
        date_default_timezone_set('America/Sao_Paulo');
        $data = date('Y-m-d');
        $nrCupom = $_POST['cupomDesconto'];

        $cupom = validarCupom($nrCupom);

        if(!empty($cupom)){
            $_SESSION['cupom'] = $cupom;
            
           header("location: dadosPagamento.php");

        } else {
            $_SESSION['cupom'] = "Cupom inválido";
          header("location: dadosPagamento.php");
        }
    }

?>