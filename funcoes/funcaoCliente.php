<?php
require_once "conexao.php";

function listarEstados(){
    $conn = conectar();

    $stmt = $conn->prepare("select id, sigla ,descricao from estados");
    $stmt->execute();    
    return  $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function salvarCliente($cliente){  
    $ativo = true;
    $acesso = 1;
    $conn = conectar();    
    $stmt = $conn->prepare('INSERT INTO cliente (nome, dtNascimento, cpf, telefone, cep, rua, numero, bairro, id_estado, email, senha, ativo, acesso)
    VALUES(:nome, :dtNascimento, :cpf, :telefone, :cep, :rua, :numero, :bairro, :id_estado, :email, :senha, :ativo, :acesso)');
    
    $stmt->bindParam(':nome',$cliente['nome']);
    $stmt->bindParam(':dtNascimento',$cliente['dtNascimento']);
    $stmt->bindParam(':cpf',$cliente['cpf']);
    $stmt->bindParam(':telefone',$cliente['telefone']);
    $stmt->bindParam(':cep',$cliente['cep']);
    $stmt->bindParam(':rua',$cliente['rua']);
    $stmt->bindParam(':numero',$cliente['numero']);
    $stmt->bindParam(':bairro',$cliente['bairro']);
    $stmt->bindParam(':id_estado',$cliente['id_estado']);
    $stmt->bindParam(':email',$cliente['email']);
    $stmt->bindParam(':senha',$cliente['senha']);
    $stmt->bindParam(':ativo',$ativo);
    $stmt->bindParam(':acesso',$acesso);

    if ($stmt->execute()) {
        print_r('aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
        return "Cliente inserido com sucesso!";
    } else {
        print_r($stmt->errorInfo());
        return "erro! ";
    }  
}
function editarCliente(){
}

function excluirCliente($id){

}
function buscarCliente($id){

}
?>