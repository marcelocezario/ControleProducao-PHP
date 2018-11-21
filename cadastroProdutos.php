<?php
require_once "funcoes/funcaoProduto.php";


    $id = "";
    $nomeProduto = "";
    $descricao = "";    
    $url = "";
    $valor = "";
    $qtde = "";
    $id_categoria = "";
    $ativo = "";
    if(!empty($_FILES)) {
        $caminho_arquivo = "C:\\xampp\\htdocs\\ControleProducao-PHP\\img\\";
        $nome_arquivo = $_FILES['image']['name'];   
        move_uploaded_file($_FILES['image']['tmp_name'],
        $caminho_arquivo.$nome_arquivo);
        $url = 'img/'.$nome_arquivo;
    }
    if (!empty($_GET)) {
        $id = $_GET['id'];

        if ($_GET['acao'] == 'carregar') {
            $produto = buscarProduto($id);

            $nomeProduto = $produto['nomeProduto'];
            $descricao = $produto['descricao'];
            $valor = $produto['valor'];
            $qtde = $produto['qtde'];
            $id_categoria = $produto['id_categoria'];
            $url = $produto['url'];
            $ativo = $produto['ativo'];
        }
        if ($_GET['acao'] == 'excluir') {
            excluirProduto($id);
        }
    }

    if(!empty($_POST)){
        $_POST['url'] = $url;
        print_r($_POST);
    
        salvarProduto($_POST);
    }

    $produtos = listarProtudos();
?>