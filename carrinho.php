<?php
include_once("default/header.php");

$cliente = $_SESSION['cliente'];

?>

<?php 
    require_once "funcoes/funcaoProduto.php";
    include_once("default/header.php");

    
    if (!empty($_GET)) {
      $idProduto = $_GET['idProduto'];

      if ($_GET['acao'] == 'carregar') {
          $produto = buscarProduto($idProduto);
      }
    }

    if (!empty($_SESSION['carrinho'])){
        $carrinho = $_SESSION['carrinho'];
    } else {
        $carrinho = array();
    }
   
?>

<!DOCTYPE html>
<html lang="en">


  <body>
        <?php    
            include_once("default/navbar.php");

        ?>

        <div class="jumbotron-fluid">
                <div class="container">
                    <h1 class="display-4">Olá Sr(a) <?=$cliente['nome']?></h1>
                    <?php
                        if(count($carrinho)>0){
                    ?>            
                    <p class="lead">esse é seu carrinho de compras, clique em comprar para garantir as ofertas</p>
                    <?php
                            } else {
                    ?>
                    <p class="lead">Parece que não tem nenhum produto no seu carrinho =(
                    <br>Não perca tempo e aproveite nossas ofertas</p>
                    <?php
                            }
                    ?>

                </div>



                <div class="container">
                    <table class="table table-dark">
                <thead>
                    <tr>
                        <th></th>
                        <th>Produto</th>
                        <th>Valor Unitário</th>
                        <th>Quantidade</th>
                        <th>Valor total item</th>
                    </tr>
                </thead>
                <?php
                    foreach($carrinho as $item){
                ?>
                    <tbody>
                        <tr>
                            <td>
                            <?php
                                $produto = buscarProduto($item['idProduto']);
                                if(!empty($produto['url'])){                                 
                            ?>
                            <img src="<?=$produto['url']?>" class="rounded-circle" width="50" height="50" />
                            <?php
                                }
                            ?>
                            </td> 
                            <td><?=$item['nomeProduto']?></td>
                            <td><?=$item['valor']?></td>
                            <td><?=$item['qtde']?></td>
                            <td><?=$item['valorTotal']?></td>
                            <td>
                                <a href="cadastroProdutos.php?acao=excluir&id=<?=$produto['id']?>" 
                                    class="btn btn-primary"
                                    onclick="return confirm('Você está certo disso?');">
                                    Remover
                                </a>
                            </td>

                        </tr>
                    </tbody>
                <?php  
                    }
                ?>
            </table>
                </div>
                </div>

        






    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  
  </body>

</html>
