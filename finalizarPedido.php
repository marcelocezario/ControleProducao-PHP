<?php
include_once("default/header.php");

if (!empty($_SESSION['cliente'])){
    $cliente = $_SESSION['cliente'];
    if(empty($_SESSION['carrinho'])){
        header("location: carrinho.php");
    }
} else {
    $_SESSION['urlAnterior'] = "finalizarPedido.php";
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
    <h2>Cadastro de Marcas</h2>
        <form action="cadastroMarcas.php" method="POST">
        <input type="hidden" id="id" name="id" value="<?=$id?>"/>

        <div class="form-group">
            <label for="nomeMarca">Nome da Marca</label>
            <input type="text" class="form-control" maxlength="40" requered name="nomeMarca" id="nomeMarca" placeholder="Digite o nome da Marca" value="<?=$nomeMarca?>">
        </div>

        <div class="form-group">
            <label for="fornecedor">Fornecedor</label>
            <input type="text"  maxlength="200" class="form-control" name="fornecedor" id="fornecedor" placeholder="Digite o fornecedor da marca" value="<?=$fornecedor?>">
        </div>
        <input type="submit" value="Salvar" class="btn btn-primary" /> 
    </form>
        






    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  
  </body>

</html>
