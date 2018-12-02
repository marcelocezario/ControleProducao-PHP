<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-info fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">New Submarino</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">

            <li class="nav-item">
              <form action="produtos.php" class="form-inline" method="GET">
                <input class="form-control mr-sm-2" type="search" placeholder="Pesquisa" name="Pesquisa" aria-label="buscaPersonalizada">
                <button class="btn btn btn-dark my-2 my-sm-0" type="submit">Busca</button>
              </form>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="index.php">Home</a>
            </li>



            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" id="navbarDropdownProdutos" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="produtos.php">
                Produtos
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProdutos">

                <a class="dropdown-item" href="produtos.php">Lista de Produtos</a>
                <a class="dropdown-item" href="cadastroProdutos.php">Cadastro de Produtos</a>
                <a class="dropdown-item" href="cadastroCategorias.php">Cadastro de Categorias</a>
                <a class="dropdown-item" href="cadastroMarcas.php">Cadastro de Marcas</a>
                
                <?php
                    if(!empty($_SESSION['cliente'])){
                      if($_SESSION['cliente']['acesso'] == 2){
                  ?>                       
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="cadastroCategorias.php">Cadastro de Categorias</a>
                    <a class="dropdown-item" href="cadastroProdutos.php">Cadastro de Produtos</a>
                    <a class="dropdown-item" href="cadastroMarcas.php">Cadastro de Marcas</a>
                  <?php
                      }
                    }

                  ?>
              </div>
          </li>
           
            <?php
            if(!empty($_SESSION['cliente'])){
          ?>   
            <li class="nav-item">
              <label class="nav-link" href="cliente.php">Ola <?=$_SESSION['cliente']['nome']?></label>
              
            </li>

            
            <form action="opcoes.php?acao=sair" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="urlAnterior" value="<?=$_SERVER['REQUEST_URI']?>">
                <button type="submit" class="btn btn-outline-dark">Sair
                </button>
            </form>

          <?php
            } else {
          ?>   

            <form action="login.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="urlAnterior" value="<?=$_SERVER['REQUEST_URI']?>">
                <button type="submit" class="btn btn-outline-dark">Login
                </button>
            </form>


          <?php
            }
          ?>
                    <li class="nav-item">
                  <a class="btn btn-link" href="carrinho.php">
                    <span class="badge badge-pill badge-light">
                      Itens no carrinho 
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
                    </a>
            </li>


          </ul>
        </div>
      </div>
    </nav>
          
     