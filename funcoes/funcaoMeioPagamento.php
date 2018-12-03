<?php
require_once "conexao.php";

function salvarMeioPagamento($meioPagamento)  {  
    $conn = conectar();

    $stmt = $conn->prepare('INSERT INTO meiopagamento (formaPagamento, nrMaxParcelas, txJurosParcelamento)
                            VALUES (:formaPagamento, :nrMaxParcelas, :txJurosParcelamento)');

    $stmt->bindParam(':formaPagamento',$meioPagamento['formaPagamento']);
    $stmt->bindParam(':nrMaxParcelas',$meioPagamento['nrMaxParcelas']);
    $stmt->bindParam(':txJurosParcelamento',$meioPagamento['txJurosParcelamento']);
   
    if ($stmt->execute()){
        return "Meio de pagamento adicionado com sucesso!";
    } else {
        print_r($stmt->errorInfo());
        return "erro! ";
    }
}

function listarMeiosPagamento() {
    $conn = conectar();

    $stmt = $conn->prepare("select id, formaPagamento, nrMaxParcelas, txJurosParcelamento from meiopagamento order by formaPagamento");
    $stmt->execute();
    $retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $retorno;
}

function buscarMeioPagamento($id) {
    $conn = conectar();

    $stmt = $conn->prepare("select id, formaPagamento, nrMaxParcelas, txJurosParcelamento from meiopagamento where id = :id");
    $stmt->bindParam(':id',$id);

    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function editarMeioPagamento($meioPagamento){
    $conn = conectar();

    $stmt = $conn->prepare('update meioPagamento set formaPagamento = :formaPagamento, nrMaxParcelas = :nrMaxParcelas, txJurosParcelamento = :txJurosParcelamento where id = :id');
    $stmt->bindParam(':id',$meioPagamento['id']);
    $stmt->bindParam(':formaPagamento',$meioPagamento['formaPagamento']);
    $stmt->bindParam(':nrMaxParcelas',$meioPagamento['nrMaxParcelas']);
    $stmt->bindParam(':txJurosParcelamento',$meioPagamento['txJurosParcelamento']);

    if ($stmt->execute()){
        return "Meio de pagamento alterada com sucesso!";
    } else {
        print_r($stmt->errorInfo());
        return "erro! ";
    }
}

function excluirMeioPagamento($id) {
    $conn = conectar();

    $stmt = $conn->prepare('delete from meioPagamento where id = :id');
    $stmt->bindParam(':id',$id);
    if ($stmt->execute()){
        return "Meiode pagamento excluído com sucesso!";
    } else {
        print_r($stmt->errorInfo());
        return "erro! ";
    }
}
?>