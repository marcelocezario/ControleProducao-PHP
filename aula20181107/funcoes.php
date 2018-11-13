<?php

define("DSN","mysql");
define("SERVIDOR","localhost");
define("USUARIO","root");
define("SENHA","");
define("BANCODEDADOS","aulaphp");

function conectar() {    
    try {
        $conn = new PDO(DSN.':host='.SERVIDOR.';dbname='.
        BANCODEDADOS, USUARIO, SENHA);
        return $conn;
    } catch (PDOException $e) {
        echo ''.$e->getMessage();
    }
}
function salvarCliente($cliente)  {  
    $conn = conectar();    
    $stmt = $conn->prepare('INSERT INTO cliente (nome, cpf) 
            VALUES(:nome, :cpf)');
    $stmt->bindParam(':nome',$cliente['nome']);
    $stmt->bindParam(':cpf',$cliente['cpf']);
    if ($stmt->execute()) {
        return "Cliente inserido com sucesso!";
    } else {
        print_r($stmt->errorInfo());
        return "erro! ";
    }  
}

function listarClientes() {
    $conn = conectar();
    
    $stmt = $conn->prepare("select id, nome, cpf from 
    cliente order by nome");
    $stmt->execute();
    $retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //print_r($retorno);
    return $retorno;
}

function buscarCliente($id) {
    $conn = conectar();
    
    $stmt = $conn->prepare("select id, nome, cpf, 
        idade, dtNascimento, url  from
     cliente where id = :id");
    $stmt->bindParam(':id',$id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function editarCliente($cliente) {
    $conn = conectar();    
    $stmt = $conn->prepare('update cliente set nome = :nome, 
    cpf = :cpf where id = :id');
    $stmt->bindParam(':nome',$cliente['nome']);
    $stmt->bindParam(':cpf',$cliente['cpf']);
    $stmt->bindParam(':id',$cliente['id']);
    if ($stmt->execute()) {
        return "Cliente alterado com sucesso!";
    } else {
        print_r($stmt->errorInfo());
        return "erro! ";
    }  
}

function excluirCliente($id) {
    
    
}

function validarLogin($login,$senha) {
    $conn = conectar();

    $stmt = $conn->prepare("select id from cliente where login = :login 
        and senha = :senha");
    $stmt->bindParam(':login',$login);
    $stmt->bindParam(':senha',$senha);
    $stmt->execute();    
    return $stmt->fetch(PDO::FETCH_ASSOC);    
    //array ("id" => "1")
}


?>