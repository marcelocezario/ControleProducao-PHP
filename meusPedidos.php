<?php 
    require_once "funcoes/funcaoProduto.php";
    require_once "funcoes/funcaoCompra.php";
    include_once("default/header.php");



    $vendas = buscarPedidosCliente($_SESSION['cliente']['id']);

    $_SESSION['urlAnterior'] = $_SERVER['REQUEST_URI'];
?>

<!DOCTYPE html>
<html lang="en">


  <body>
        <?php    
            include_once("default/navbar.php");
        ?>
        <div class="form-group">
        <br><br><br><br>
        <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Data</th>
                        <th>Número do Pedido</th>
                        <th>Valor total pedido</th>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Valor total do Item</th>
                        
                    </tr>
                </thead>
                <?php
                    foreach($vendas as $venda){
                ?>
                    <tbody>
                        <tr>
                            <td><?=$venda['id']?></td>
                            <td><?=$venda['data']?></td>
                            <td><?=$venda['nrPedido']?></td>
                            <td><?=$venda['totalPedido']?></td>
                            <td><?=$venda['produto']?></td>
                            <td><?=$venda['qtde']?></td>
                            <td><?=$venda['totalItem']?></td>
                        </tr>
                    </tbody>
                <?php  
                    }
                ?>
            </table>
            </div>





    






    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  
  </body>

</html>
