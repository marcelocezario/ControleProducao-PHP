<?php

    require_once "funcoes.php";
    $produtos = listarProdutos();

?>

<!DOCTYPE html>
<html lang="en">
<?php    
include_once("_layoutNavbar.php");
?>


  <body>
    <!-- Page Content -->
    <div class="container">

      <!-- Jumbotron Header -->
      <header class="jumbotron my-4">
        <h1 class="display-3">Controle de produção!</h1>
        <p class="lead">Sistema desenvolvido durante as aulas de php</p>
        <a href="#" class="btn btn-primary btn-lg">Call to action!</a>
      </header>

      <!-- Page Features -->
      <div class="row text-center">

              <?php

$produtos = listarProdutos();
foreach ($produtos as $produto) {

?>



        <div class="col-lg-3 col-md-6 mb-4">
          <div class="card">
            <img class="card-img-top" src="<?=$produto['urlImagem']?>" alt="">
            <div class="card-body">
              <h4 class="card-title"><?=$produto['nome']?></h4>
              <p class="card-text"><?=$produto['descricao']?></p>
            </div>
            <div class="card-footer">
              <a href="#" class="btn btn-primary">Find Out More!</a>
            </div>
          </div>
        </div>

        <?php
}
?>

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->



  </body>


  <?php    
include_once("_layoutFooter.php");
?>

</html>