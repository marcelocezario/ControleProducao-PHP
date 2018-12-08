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
        $conn ->beginTransaction();

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
        
        $stmt->execute();
        $id_pedido = $conn->lastInsertId();
        
        $_SESSION['pedido'] = $id_pedido;

        foreach ($carrinho as $item) {
            $stmt = $conn->prepare("insert into itemvenda (idProduto, idVenda, nomeProduto,
            valorProduto, qtde, valorTotal) values (:idProduto,:idVenda,:nomeProduto, :valorProduto,
            :qtde, :valorTotal)");
            $stmt->bindParam(':idProduto',$item['idProduto']);
            $stmt->bindParam(':nomeProduto', $item['nomeProduto']);
            $stmt->bindParam(':valorProduto', $item['valor']);
            $stmt->bindParam(':qtde', $item['qtde']);
            $stmt->bindParam(':valorTotal', $item['valorTotal']);
            $stmt->bindParam(':idVenda', $id_pedido);
            $stmt->execute();
         }
         $conn -> commit();
         

    }

    function buscarVenda($id){
        $conn = conectar();    
        $stmt = $conn->prepare('SELECT id, bairro, cep, cidade, complemento, idCliente, uf,
        idMeioPagamento, logradouro, nomeCliente, numero, valorFrete, valorDesconto, valorCompra,
        totalPedido, data, nrPedido from venda where id = :id');
        $stmt->bindParam(':id',$id);
        $stmt->execute();    
        return $stmt->fetch(PDO::FETCH_ASSOC); 
    }

    function buscarPedidosCliente($idCliente){
        $conn = conectar();    
        $stmt = $conn->prepare('SELECT v.id as id,
        v.totalPedido as totalPedido, v.data as data, v.nrPedido as nrPedido, 
        iv.valorTotal as totalItem, iv.nomeProduto as produto, iv.qtde as qtde from venda v
        inner join itemvenda as iv on (v.id = iv.idVenda)
         where v.idCliente = :idCliente');
        $stmt->bindParam(':idCliente',$idCliente);
        $stmt->execute();    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function buscarItensVenda($idVenda){
        $conn = conectar();    
        $stmt = $conn->prepare('SELECT id, idProduto, idVenda, nomeProduto, valorProduto, qtde, valorTotal from itemvenda where idVenda = :idVenda');
        $stmt->bindParam(':idVenda',$idVenda);
        $stmt->execute();    
        return $stmt->fetch(PDO::FETCH_ASSOC); 
    }
?>
