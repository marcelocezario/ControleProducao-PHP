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

            if (!empty($_GET['acao']) && $_GET['acao'] == 'adicionar') {
                $idProduto = $_GET['idProduto'];
                
                $produto = buscarProduto($idProduto);
                $itemVenda['idTemp'] = count($_SESSION['carrinho'])+1;
                $itemVenda['idProduto'] = $idProduto;
                $itemVenda['idVenda'] = 0;
                $itemVenda['nomeProduto'] = $produto['nomeProduto'];
                $itemVenda['valor'] = $produto['valor'];
                $itemVenda['qtde'] = 1;
                $itemVenda['valorTotal'] = $itemVenda['valor'] * $itemVenda['qtde'];

                array_push($_SESSION['carrinho'],$itemVenda);
            }
            if (!empty($_GET['acao']) && $_GET['acao'] == 'remover') {
                unset($_SESSION['carrinho'][$_GET['id']]);
            }

            if (!empty($_GET['qtde']) && $_GET['qtde'] == 'aumentar'){
                $itemVenda = $_SESSION['carrinho'][$_GET['id']];

                $itemVenda['qtde']++;
                $itemVenda['valorTotal'] = $itemVenda['qtde'] * $itemVenda['valor'];
                
                $_SESSION['carrinho'][$_GET['id']] = $itemVenda;
            }
            if (!empty($_GET['qtde']) && $_GET['qtde'] == 'diminuir'){
                $itemVenda = $_SESSION['carrinho'][$_GET['id']];

                if($itemVenda['qtde'] > 1){
                    $itemVenda['qtde']--;
                    $itemVenda['valorTotal'] = $itemVenda['qtde'] * $itemVenda['valor'];
                    
                    $_SESSION['carrinho'][$_GET['id']] = $itemVenda;
                } else {
                    unset($_SESSION['carrinho'][$_GET['id']]);
                }
            }
        }


        header("location: carrinho.php");
?>