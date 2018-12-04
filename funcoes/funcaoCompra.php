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

    function salvarPedido($cliente, $endereco, $carrinho, $idFormaPagamento, $valores) {
        $conn = conectar();

        $nrPedido = uniqid();

        $stmt = $conn->prepare("insert into venda (bairro, cep, cidade, complemento, idCliente, uf,
        idMeioPagamento, logradouro, nomeCliente, numero, valorFrete, valorDesconto, valorCompra,
        totalPedido, data, nrPedido) values (:bairro, :cep, :cidade, :complemento, :idCliente, :uf,
        :idMeioPagamento, :logradouro, :nomeCliente, :numero, :valorFrete, :valorDesconto, :valorCompra,
        :totalPedido, now(), :nrPedido)");
        
        $stmt->bindParam(':bairro',$endereco['bairro']);
        $stmt->bindParam(':cep',$endereco['cep']);
        $stmt->bindParam(':cidade',$endereco['cidade']);
        $stmt->bindParam(':complemento',$endereco['complemento']);
        $stmt->bindParam(':idCliente',$cliente['id']);
        $stmt->bindParam(':idMeioPagamento',$idFormaPagamento);
        $stmt->bindParam(':logradouro',$endereco['logradouro']);
        $stmt->bindParam(':nomeCliente',$cliente['nome']);
        $stmt->bindParam(':nrPedido',$nrPedido);
        $stmt->bindParam(':numero',$endereco['numero']);
        $stmt->bindParam(':uf',$endereco['uf']);
        
        $stmt->bindParam(':valorCompra',$valores['valorCompra']);
        $stmt->bindParam(':valorDesconto',$valores['valorDesconto']);
        $stmt->bindParam(':valorFrete',$valores['valorFrete']);



        $stmt->bindParam(':totalPedido',$valores['totalPedido']);

/*
        if ($stmt->execute()) {
            return "Cliente inserido com sucesso!";
        } else {
            return "erro! ";
        } 
              
        print_r($stmt);
    */
        $stmt->execute();
        $id_pedido = $stmt->lastInsertId(); 
    


        foreach ($carrinho as $item) {
            $stmt = $conn->prepare("insert into itemvenda (idProduto, idVenda, nomeProduto,
            valorProduto, qtde, valorTotal) values (:idProduto,:idVenda,:nomeProduto, :valorProduto,
            :qtde, :valorTotal)");
            $stmt->bindParam(':idProduto',$item['id']);
            $stmt->bindParam(':idVenda', $$id_pedido);
            $stmt->bindParam(':nomeProduto', $item['nomeProduto']);
            $stmt->bindParam(':valorProduto', $item['valorProduto']);
            $stmt->bindParam(':qtde', $item['qtde']);
            $stmt->bindParam(':valorTotal', $item['valorTotal']);
            $stmt->execute();
         }

         
    }
?>
