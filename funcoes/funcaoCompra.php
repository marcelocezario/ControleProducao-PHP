<?php
    require_once "funcoes/funcaoCliente.php";

    function validarCupom($cupom) {
        $conn = conectar();
        $ativo = true;

        $data = date('Y-m-d');

        $stmt = $conn->prepare("SELECT id, nrCupom, percentualDesconto, dataValidade FROM cupomdesconto WHERE dataValidade >= :dataValidade and nrCupom = :nrCupom");
    
        //SELECT id, acesso, telefone from cliente where id = :id'
        $stmt->bindParam(':dataValidade',$data);
        $stmt->bindParam(':nrCupom',$cupom);
        $stmt->execute();    
        return $stmt->fetch(PDO::FETCH_ASSOC);    
    }
?>
