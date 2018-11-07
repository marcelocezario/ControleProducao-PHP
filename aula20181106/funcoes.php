<?php

define("DSN","mysql");
define("SERVIDOR","localhost");
define("USUARIO","root");
define("SENHA","");
define("BANCODEDADOS","aula20181031");


function conectar(){
    try{
        $conn = new PDO(DSN.':host='.SERVIDOR.';dbname='.
        BANCODEDADOS, USUARIO, SENHA);
        return $conn;
    } catch (PDOException $e) {
        echo ''.$e->getMessage();
    }
}

function validarLogin($login,$senha){
    $conn = conectar();

    $stmt = $conn->prepare("select id from cliente where login = :login 
        and senha = :senha");
    $stmt->bindParam(':login',$login);
    $stmt->bindParam(':senha',$senha);
    $stmt->execute();    
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

 function buscarCliente($id) {
    $conn = conectar();

    $stmt = $conn->prepare("select nome from cliente where id = :id");
    $stmt->bindParam(':id',$id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}




?>