<?php    
    include_once("default/header.php");
    
    require_once "funcoes/funcaoProduto.php";
    require_once "funcoes/funcaoCompra.php";

    if(!empty($_POST)) {


    }

    $apelido = "";
    $itensVenda = "";
    $venda = array();


    $venda = buscarVenda($_SESSION['pedido']);

    $itensVenda = buscarItensVenda($venda['id']);
    
    $somaCarrinho = 0;

    $carrinho = $_SESSION['carrinho'];

    unset($_SESSION['carrinho']);





    $_SESSION['urlAnterior'] = $_SERVER['REQUEST_URI'];
?>

<!DOCTYPE html>

<body>
<?php    
    include_once("default/navbar.php");
?>
<main role="main" class="container">
<div class="progress">
  <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
</div>
<div class="jumbotron">
  <h1 class="display-4">Pedido <?=$venda['nrPedido']?> efetuado com sucesso!</h1>
  <p class="lead">Parabéns, você vai receber seu produto em até <?=$_SESSION['prazoEntrega']?> dias úteis, confira abaixo os dados do seu pedido:</p>
  <hr class="my-4">
  <p>Confira os dados do seu pedido</p>

<div class="col-8">
    <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Item</th>
      <th scope="col">Produto</th>
      <th scope="col">Quantidade</th>
      <th scope="col">Valor total</th>
    </tr>
  </thead>
  <?php
        $i = 0;
                foreach($carrinho as $item){
        ?>
  <tbody>
    <tr>
        <td><?=$i+=1?></td>
        <td><?=$item['nomeProduto']?></td>
        <td><?=$item['qtde']?></td>
        <td><?=number_format($item['valorTotal'],2,",",".")?></td>
        <?php
                }
        ?>
    </tr>

  </tbody>
</table>

<ul class="list-group">
                    <li class="list-group-item">Total de produtos: R$ <?=number_format($somaCarrinho,2,",",".")?></li>
                    <li class="list-group-item">Desconto Cupom: R$ <?=number_format($venda['valorDesconto'],2,",",".")?></li>
                    <li class="list-group-item">Valor do Frete: R$ <?=number_format($venda['valorFrete'],2,",",".")?></li>
                    <li class="list-group-item active">TOTAL DO PEDIDO: R$ <?=number_format($venda['totalPedido'],2,",",".")?></li>

                </ul>
</div>
</div>




    
</main>

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
