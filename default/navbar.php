<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-info fixed-top">
      <div class="container">
        <a class="navbar-brand" href="index.php">Ecommerce</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">

            <li class="nav-item">
              <form action="produtos.php" class="form-inline" method="GET">
                <input class="form-control mr-sm-2" type="search" placeholder="Pesquisa" name="pesquisa" aria-label="buscaPersonalizada">
                <button class="btn btn btn-dark my-2 my-sm-0" type="submit">Busca</button>
              </form>
            </li>
 
            



            
                <?php
                    if(!empty($_SESSION['cliente'])){
                      if($_SESSION['cliente']['acesso'] == 2){
                ?>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownProdutos" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false" href="#">
                Cadastros
                </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProdutos">
                     
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="cadastroCategorias.php">Categorias</a>
                    <a class="dropdown-item" href="cadastroProdutos.php">Produtos</a>
                    <a class="dropdown-item" href="cadastroMarcas.php">Marcas</a>
                    <a class="dropdown-item" href="cadastroMeiosPagamento.php">Meios de Pagamento</a>
                    </div>
          </li>
                  <?php
                      }
                    }
                  ?>

           
            <?php
            if(!empty($_SESSION['cliente'])){
          ?>   
                <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdownCliente" href="cliente.php?" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false" href="#">
                Olá <?=$_SESSION['cliente']['apelido']?>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownCliente">
                <a class="dropdown-item" href="meusPedidos.php">Meus Pedidos</a>


            </li>

            
            <form action="opcoes.php?acao=sair" method="POST" enctype="multipart/form-data">
                <button type="submit" class="btn btn-outline-dark">Sair
                </button>
            </form>

          <?php
            } else {
          ?>   

            <form action="login.php" method="POST" enctype="multipart/form-data">
                <button type="submit" class="btn btn-outline-dark">Login
                </button>
            </form>


          <?php
            }
          ?>
                    <li class="nav-item">
                  <a class="btn btn-link" href="carrinho.php">
                    <span class="badge badge-pill badge-light">
                      Meu carrinho
                      <span class="badge badge-pill badge-success">
                      <?php
                      if(!empty($_SESSION['carrinho'])){
                        ?>
                        <?=count($_SESSION['carrinho'])?>
                        <?php
                      } else {
                        ?>
                        0
                        <?php
                      }
                      ?>

</span>
</span>
                    </a>
            </li>


          </ul>
        </div>
      </div>
    </nav>
          
     