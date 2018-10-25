<?php

define("DSN","mysql");
define("SERVIDOR","localhost");
define("USUARIO","root");
define("SENHA","");
define("BANCODEDADOS","aulaphp");


function conectar(){
    try{
        $conn = new PDO(DSN.':host='.SERVIDOR.';dbname='.
        BANCODEDADOS, USUARIO, SENHA);
        return $conn;
    } catch (PDOException $e) {
        echo ''.$e->getMessage();
    }
}

function salvarCliente($cliente)  {
    $conn = conectar();

    $stmt = $conn->prepare('INSERT INTO cliente (nome, cpf, idade, dtNascimento, url)
            VALUES(:nome, :cpf, :idade, :dtNascimento, :url)');
    $stmt->bindParam(':nome',$cliente['nome']);
    $stmt->bindParam(':cpf',$cliente['cpf']);
    $stmt->bindParam(':idade',$cliente['idade']);
    $stmt->bindParam(':dtNascimento',$cliente['dtNascimento']);
    $stmt->bindParam(':url',$cliente['url']);
    if ($stmt->execute()){
        return "Cliente inserido com sucesso!";
    } else {
        print_r($stmt->errorInfo());
        return "erro! ";
    }

}

function listarClientes() {
    $conn = conectar();

    $stmt = $conn->prepare("select id, nome, cpf, url from cliente order by nome");
    $stmt->execute();
    $retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $retorno;
}

function buscarCliente($id) {
    $conn = conectar();

    $stmt = $conn->prepare("select id, nome, cpf, idade, dtNascimento, url from cliente where id = :id");
    $stmt->bindParam(':id',$id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function editarCliente($cliente){
    $conn = conectar();

    $stmt = $conn->prepare('update cliente set nome = :nome, cpf = :cpf, idade = :idade,
        dtNascimento = :dtNascimento, url = :url where id = :id');
    $stmt->bindParam(':id',$cliente['id']);
    $stmt->bindParam(':nome',$cliente['nome']);
    $stmt->bindParam(':cpf',$cliente['cpf']);
    $stmt->bindParam(':idade',$cliente['idade']);
    $stmt->bindParam(':dtNascimento',$cliente['dtNascimento']);
    $stmt->bindParam(':url',$cliente['url']);
    if ($stmt->execute()){
        return "Cliente alterado com sucesso!";
    } else {
        print_r($stmt->errorInfo());
        return "erro! ";
    }
}

function excluirCliente($id) {
    $conn = conectar();

    $stmt = $conn->prepare('delete from cliente where id = :id');
    $stmt->bindParam(':id',$id);
    if ($stmt->execute()){
        return "Cliente excluído com sucesso!";
    } else {
        print_r($stmt->errorInfo());
        return "erro! ";
    }
}
?>