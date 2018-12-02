<?php 
    require_once "funcoes/funcaoProduto.php";
    require_once "funcoes/funcaoCompra.php";
    include_once("default/header.php");


    

    if (!empty($_GET)) {

      // filtra por categoria
      if(!empty($_GET['idCategoria'])){
        $idCategoria = $_GET['idCategoria'];

        if ($_GET['acao'] == 'carregar') {
            $produtos = listarProdutosPorCategoria($idCategoria);
        }
      }

      if(!empty($_GET['pesquisa'])){
            $produtos = pesquisaProdutos($_GET['pesquisa']);
      }
    }
    else {
      $produtos = listarProdutos();
    }

    $categorias = listarCategorias();

    ?>

<!DOCTYPE html>
<html lang="en">


  <body>
        <?php    
            include_once("default/navbar.php");
        ?>

    <!-- Page Content -->
    <div class="container">

      <div class="row">

        <div class="col-lg-3">

          <h1 class="my-4">Categorias</h1>
          <div class="list-group">
                <?php
                print_r($produtos);
                    foreach($categorias as $categoria){
                ?>
                    <a href="produtos.php?acao=carregar&idCategoria=<?=$categoria['id']?>" class="list-group-item"><?=$categoria['nomeCategoria']?></a>
                    

                <?php
                    }
                ?>
                             
          </div>
        </div>
        <!-- /.col-lg-3 -->

        <div class="col-lg-9">

          <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
            <ol class="carousel-indicators">
            <?php

                $tamanhoLista = count($produtos);
                $qtdeProdutosDestaque = 5;
                if ($tamanhoLista < $qtdeProdutosDestaque){
                  $qtdeProdutosDestaque = $tamanhoLista;
                }
                
                for ($i = 0; $i < $qtdeProdutosDestaque; $i++){
            ?>
              <li data-target="#carouselExampleIndicators" data-slide-to="<?=$i?>" <?php if($i==0):?> class="active" <?php endif; ?>></li>
            <?php          
                }
            ?>

            </ol>

             <div class="carousel-inner" role="listbox">

            <?php

                $larguraImagem = 900;
                $alturaImagem = 350;

                for ($i = 0; $i < $qtdeProdutosDestaque; $i++){
                  redimensionarImagem($produtos[$i]['url'],$larguraImagem,$alturaImagem);
            ?>

              <div class="carousel-item <?php if($i==0):?> active <?php endif; ?>">
                <a href="detalhesProduto.php?acao=carregar&idProduto=<?=$produtos[$i]['id']?>">
                  <img class="d-block img-fluid" src="<?=$produtos[$i]['url'].' w'.$larguraImagem.'xh'.$alturaImagem.'.jpg'?>" alt="slide <?= $i ?>">
                </a>
                <div class="carousel-caption d-none d-md-block">
                    <h1 class="display-4"><?=$produtos[$i]['nomeProduto']?></h1>
                    <h4><span class="badge badge-light">R$ <?=$produtos[$i]['valor']?></span></h4>
                
                </div>



              </div>

            <?php          
                }
            ?>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>

          <div class="row">

          <?php
                $larguraImagem = 700;
                $alturaImagem = 400;

                foreach ($produtos as $produto){

                redimensionarImagem($produto['url'],$larguraImagem,$alturaImagem);
                
          ?>

          
            <div class="col-lg-4 col-md-6 mb-4">
              <div class="card h-30">
                <a href="detalhesProduto.php?acao=carregar&idProduto=<?=$produto['id']?>"><img class="card-img-top" src="<?=$produto['url'].' w'.$larguraImagem.'xh'.$alturaImagem.'.jpg'?>" alt=""></a>
                <div class="card-body">
                  <h4 class="card-title">
                    <a href="detalhesProduto.php?acao=carregar&idProduto=<?=$produto['id']?>"><?=$produto['nomeProduto']?></a>
                  </h4>
                  <h5><?='R$ '.$produto['valor']?></h5>
                  <p class="card-text"><?=$produto['descricao']?></p>
                </div>
                <div class="card-footer text-center">
                  <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small><br/>
                  
                  <div class="btn-group" role="group" aria-label="Basic example">
                    <a class="btn btn-primary btn-sm" href="detalhesProduto.php?acao=carregar&idProduto=<?=$produto['id']?>">Detalhes</a>
                    <a class="btn btn-success btn-sm" href="adicionarCarrinho.php?acao=adicionar&idProduto=<?=$produto['id']?>">Adicionar</a>
                  </div>
                
                </div>
              </div>
            </div>





          <?php
                }
          ?>


          </div>
          <!-- /.row -->

        </div>
        <!-- /.col-lg-9 -->

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  
  </body>

</html>
