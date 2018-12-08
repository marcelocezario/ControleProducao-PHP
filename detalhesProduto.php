<?php 
    require_once "funcoes/funcaoProduto.php";
    include_once("default/header.php");

    
    if (!empty($_GET)) {
      $idProduto = $_GET['idProduto'];

      if ($_GET['acao'] == 'carregar') {
          $produto = buscarProduto($idProduto);
      }
    }

    $_SESSION['urlAnterior'] = $_SERVER['REQUEST_URI'];
?>

<!DOCTYPE html>
<html lang="en">


  <body>
        <?php    
            include_once("default/navbar.php");
        ?>

<div class="jumbotron">
  <h1 class="display-4"><?=$produto['nomeProduto']?></h1>
  <p class="lead"><h4>Valor R$ <?=number_format($produto['valor'],2,",",".")?></h4></p>
  <hr class="my-4">
  <p><?=$produto['descricaoDetalhada']?></p>
  <a class="btn btn-success btn-sm" href="adicionarCarrinho.php?acao=adicionar&idProduto=<?=$produto['id']?>">Adicionar</a>
  </div>





    






    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  
  </body>

</html>
