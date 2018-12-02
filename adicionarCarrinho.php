<?php
    require_once "funcoes/funcaoProduto.php";

        // inicia sessão se não houver alguma ativa
        if(empty($_SESSION)){
            session_start();
        }

        // cria o carrinho de compras se não houver um criado
        if(empty($_SESSION['carrinho'])){
            $_SESSION['carrinho'] = array();
        }

        if (!empty($_GET)) {
            $idProduto = $_GET['idProduto'];
            if ($_GET['acao'] == 'adicionar') {
                
                $produto = buscarProduto($idProduto);
                $itemVenda['idProduto'] = $idProduto;
                $itemVenda['idVenda'] = 0;
                $itemVenda['nomeProduto'] = $produto['nome'];
                $itemVenda['valor'] = $produto['valor'];
                $itemVenda['qtde'] = 1;
                $itemVenda['valorTotal'] = $itemVenda['valor'] * $itemVenda['qtde'];
            }
        }

        array_push($_SESSION['carrinho'],$itemVenda);

        header("location: carrinho.php");


?>