<?php

define("DSN","mysql");
define("SERVIDOR","localhost");
define("USUARIO","root");
define("SENHA","");
define("BANCODEDADOS","controleproducao");

function conectar(){
    try{
        $conn = new PDO(DSN.':host='.SERVIDOR.';dbname='.
        BANCODEDADOS, USUARIO, SENHA);
        return $conn;
    } catch (PDOException $e) {
        echo ''.$e->getMessage();
    }
}

function salvarProduto($produto)  {
    $conn = conectar();

    $stmt = $conn->prepare('INSERT INTO produto (nome, descricao, valor, urlImagem)
            VALUES(:nome, :descricao, :valor, :urlImagem)');
    $stmt->bindParam(':nome',$produto['nome']);
    $stmt->bindParam(':descricao',$produto['descricao']);
    $stmt->bindParam(':valor',$produto['valor']);
    $stmt->bindParam(':urlImagem',$produto['urlImagem']);
    if ($stmt->execute()){
        return "Produto inserido com sucesso!";
    } else {
        return "Erro ao salvar produto!";
    }
}

function listarProdutos() {
    $conn = conectar();

    $stmt = $conn->prepare("select id, nome, descricao, valor, urlImagem from produto order by nome");
    $stmt->execute();
    $retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $retorno;
}

function buscarProduto($id) {
    $conn = conectar();

    $stmt = $conn->prepare("select id, nome, descricao, valor, urlImagem from produto where id = :id");
    $stmt->bindParam(':id',$id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function editarProduto($produto){
    $conn = conectar();

    $stmt = $conn->prepare('update produto set nome = :nome, descricao = :descricao, valor = :valor,
        urlImagem = :urlImagem where id = :id');
    $stmt->bindParam(':id',$produto['id']);
    $stmt->bindParam(':nome',$produto['nome']);
    $stmt->bindParam(':descricao',$produto['descricao']);
    $stmt->bindParam(':valor',$produto['valor']);
    $stmt->bindParam(':urlImagem',$produto['urlImagem']);
   if ($stmt->execute()){
        return "Produto alterado com sucesso!";
    } else {
        return "Erro ao alterar produto!";
    }
}

function excluirProduto($id) {
    $conn = conectar();

    $stmt = $conn->prepare('delete from produto where id = :id');
    $stmt->bindParam(':id',$id);
    if ($stmt->execute()){
        return "Produto excluído com sucesso!";
    } else {
        return "Erro ao excluir produto!";
    }
}


?>