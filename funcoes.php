<?php
require_once "conexao.php";

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
        print_r("\n\n\naqui foi ");
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
    return $retorno;}

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

?>