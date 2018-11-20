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
        $url = 'img/'.$nome_arquivo.$nomeProduto;
    }

?>