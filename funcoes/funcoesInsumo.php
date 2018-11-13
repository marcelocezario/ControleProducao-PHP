<?php
require_once "conexao.php";
/*
 * Insumo começa linha 11 e ternima 75
 * EstoqueInsumo começa linha 79 e ternima 142
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

function salvarEstoqueInsumo($estoque)  {  
    $conn = conectar();

    $stmt = $conn->prepare('INSERT INTO insumo_estoque (qtde, id_insumo)
                            VALUES (:qtde, :id_insumo)');

    $stmt->bindParam(':qtde',$estoque['qtde']);
    $stmt->bindParam(':id_insumo',$estoque['id_insumo']);
   
    if ($stmt->execute()){
        return "Insumo  com sucesso!";
    } else {
        print_r($stmt->errorInfo());
        return "erro! ";
    }
}

function listarEstoqueInsumo() {
    $conn = conectar();

    $stmt = $conn->prepare("select ie.id, ie.qtde as qtde , i.nomeInsumo, i.unidadeMedida from insumo_estoque as ie inner join insumo as i on ie.id_insumo =  i.id");
    $stmt->execute();
    $retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $retorno;
}

function buscarEstoqueInsumo($id) {
    $conn = conectar();

    $stmt = $conn->prepare("select id, qtde,id_insumo from insumo_estoque where id = :id");
    $stmt->bindParam(':id',$id);

    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function editarEstoqueInsumo($estoqueInsumo){
    $conn = conectar();

    $stmt = $conn->prepare('update insumo_estoque set id_insumo = :id_insumo, qtde = :qtde where id = :id');
    $stmt->bindParam(':id',$estoqueInsumo['id']);
    $stmt->bindParam(':id_insumo',$estoqueInsumo['id_insumo']);
    $stmt->bindParam(':qtde',$estoqueInsumo['qtde']);

    if ($stmt->execute()){
        return "Insumo alterado com sucesso!";
    } else {
        print_r($stmt->errorInfo());
        return "erro! ";
    }
}

function excluirEstoqueInsumo($id) {
    $conn = conectar();

    $stmt = $conn->prepare('delete from insumo_estoque where id = :id');
    $stmt->bindParam(':id',$id);
    if ($stmt->execute()){
        return "Insumo excluído com sucesso!";
    } else {
        print_r($stmt->errorInfo());
        return "erro! ";
    }
}
?>