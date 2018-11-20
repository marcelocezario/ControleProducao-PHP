<?php
require_once "conexao.php";
/*
 * Insumo começa linha 11 e ternima 75
 * Categoria começa linha 79 e ternima 142
 */
function selected( $value, $selected ){
    return $value==$selected ? ' selected="selected"' : '';
}

function salvarInsumo($insumo)  {  
    $conn = conectar();

    $stmt = $conn->prepare('INSERT INTO insumo (nomeInsumo, unidadeMedida)
            VALUES(:nomeInsumo, :unidadeMedida)');

    $stmt->bindParam(':nomeInsumo',$insumo['nomeInsumo']);
    $stmt->bindParam(':unidadeMedida',$insumo['unidadeMedida']);
   
    if ($stmt->execute()){
        return "Insumo inserido com sucesso!";
    } else {
        print_r($stmt->errorInfo());
        return "erro! ";
    }
}

function listarInsumos() {
    $conn = conectar();

    $stmt = $conn->prepare("select id, nomeInsumo, unidadeMedida from insumo order by nomeInsumo");
    $stmt->execute();
    $retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $retorno;
}

function buscarInsumo($id) {
    $conn = conectar();

    $stmt = $conn->prepare("select id, nomeInsumo, unidadeMedida from insumo where id = :id");
    $stmt->bindParam(':id',$id);

    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function editarInsumo($insumo){
    $conn = conectar();

    $stmt = $conn->prepare('update insumo set nomeInsumo = :nomeInsumo, unidadeMedida = :unidadeMedida where id = :id');
    $stmt->bindParam(':id',$insumo['id']);
    $stmt->bindParam(':nomeInsumo',$insumo['nomeInsumo']);
    $stmt->bindParam(':unidadeMedida',$insumo['unidadeMedida']);

    if ($stmt->execute()){
        return "Insumo alterado com sucesso!";
    } else {
        print_r($stmt->errorInfo());
        return "erro! ";
    }
}

function excluirInsumo($id) {
    $conn = conectar();

    $stmt = $conn->prepare('delete from insumo where id = :id');
    $stmt->bindParam(':id',$id);
    if ($stmt->execute()){
        return "Insumo excluído com sucesso!";
    } else {
        print_r($stmt->errorInfo());
        return "erro! ";
    }
}

/*************************** ESTOQUE INSUMO ***********************************/

function salvarCategoria($estoque)  {  
    $conn = conectar();

    $stmt = $conn->prepare('INSERT INTO categoria (nomeCategoria, descricao)
                            VALUES (:nomeCategoria, :descricao)');

    $stmt->bindParam(':nomeCategoria',$estoque['nomeCategoria']);
    $stmt->bindParam(':descricao',$estoque['descricao']);
   
    if ($stmt->execute()){
        return "Categoria adicionado com sucesso!";
    } else {
        print_r($stmt->errorInfo());
        return "erro! ";
    }
}

function listarCategoria() {
    $conn = conectar();

    $stmt = $conn->prepare("select id, nomeCategoria, descricao from categoria");
    $stmt->execute();
    $retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $retorno;
}

function buscarCategoria($id) {
    $conn = conectar();

    $stmt = $conn->prepare("select id, nomeCategoria, descricao from categoria where id = :id");
    $stmt->bindParam(':id',$id);

    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function editarCategoria($categoria){
    $conn = conectar();

    $stmt = $conn->prepare('update categoria set nomeCategoria = :nomeCategoria, descricao = :descricao where id = :id');
    $stmt->bindParam(':id',$categoria['id']);
    $stmt->bindParam(':nomeCategoria',$categoria['nomeCategoria']);
    $stmt->bindParam(':descricao',$categoria['descricao']);

    if ($stmt->execute()){
        return "Categoria alterado com sucesso!";
    } else {
        print_r($stmt->errorInfo());
        return "erro! ";
    }
}

function excluirCategoria($id) {
    $conn = conectar();

    $stmt = $conn->prepare('delete from categoria where id = :id');
    $stmt->bindParam(':id',$id);
    if ($stmt->execute()){
        return "Insumo excluído com sucesso!";
    } else {
        print_r($stmt->errorInfo());
        return "erro! ";
    }
}
?>