<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-info fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">New Submarino</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">



            <li class="nav-item">
              <a class="nav-link" href="index.php">Home</a>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" id="navbarDropdownProdutos" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Produtos
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProdutos">

                <a class="dropdown-item" href="produtos.php">Lista de Produtos</a>
                <a class="dropdown-item" href="cadastroProdutos.php">Cadastro de Produtos</a>
                <a class="dropdown-item" href="cadastroCategorias.php">Cadastro de Categorias</a>
                <a class="dropdown-item" href="cadastroMarcas.php">Cadastro de Marcas</a>
                
                <?php
                    if(!empty($_SESSION)){
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
            if(!empty($_SESSION)){
          ?>   
            <li class="nav-item">
              <label class="nav-link" href="cliente.php">Ola <?=$_SESSION['cliente']['nome']?></label>
              
            </li>
            <li class="nav-item">
              <a class="nav-link" href="opcoes.php?acao=sair">Sair</a>
            </li>            
          <?php
            } else {
          ?>   
            <li class="nav-item">
              <a class="nav-link" href="login.php">Login</a>
            </li>
          <?php
            }
          ?>
          </ul>
        </div>
      </div>
    </nav>
          
     