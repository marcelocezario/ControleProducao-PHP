<?php
        session_start();
        require_once "funcoes/funcaoCompra.php";


        $vendas = buscarPedidosCliente($_SESSION['cliente']['id']);
        
        
        print_r($vendas);

?>