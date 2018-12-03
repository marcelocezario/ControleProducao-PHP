<?php
include_once("default/header.php");

if (!empty($_SESSION['cliente'])){
    $cliente = $_SESSION['cliente'];
    if(empty($_SESSION['carrinho'])){
        header("location: carrinho.php");
    }
    if (empty($_POST['cep'])){
        header("location: carrinho.php");
    }
} else {
    $_SESSION['urlAnterior'] = "confirmarPedido.php";
    header("location: login.php");
}
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
        <div>
<br/>
<br/>


    <main role="main" class="container">
    <div class="progress">
  <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
</div>


    <h1 class="display-4">Você está quase lá</h1>
    <p class="lead">Os produtos já são quase seus <?=$_SESSION['cliente']['apelido']?>, falta só um poquinho</p>
    
  <div class="row">
    <div class="col-5">
        <form action="finalizarPedido.php" method="POST">
        <input type="hidden" id="id" name="id" value="<?=$id?>"/>

        <div class="form-group">
            <div>
                <label for="cupomDesconto">Cupom desconto</label>
            </div>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Digite seu cupom de desconto se houver">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button" id="cupomDesconto">Calcular</button>
            </div>
        </div>

        <div class="form-group">
            <div>
                <label for="cep">Cep</label>
            </div>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Digite seu cupom de desconto se houver" value="<?=$_POST['cep']?>">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button" id="cupomDesconto">Calcular</button>
            </div>
        </div>

    </div>
<?=print_r($_POST)?>

    <input type="submit" value="Salvar" class="btn btn-primary" /> 
    </form>
    </div>
    </div>
        






    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  
  </body>

</html>
