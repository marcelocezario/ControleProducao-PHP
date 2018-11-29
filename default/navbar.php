<nav class="navbar navbar-expand-lg navbar-fixed-top navbar-dark bg-dark static-top">
  <div class="container">
    <a class="navbar-brand" href="#">New Submarino store</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home
            <span class="sr-only">(current)</span>
          </a>
        </li>
        
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="produtos.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Produtos
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="produtos.php">Lista de Produtos</a>
                  <a class="dropdown-item" href="cadastroProdutos.php">Cadastro de Produtos</a>
                  <a class="dropdown-item" href="cadastroCategorias.php">Cadastro de Catagorias</a>
                  <a class="dropdown-item" href="cadastroMarcas.php">Cadastro de Marcas</a>
                  <?php
                    if(!empty($acesso) && $acesso == 2){
                  ?>                       
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="cadastroCategorias.php">Cadastro de Catagorias</a>
                    <a class="dropdown-item" href="cadastroProdutos.php">Cadastro de Produtos</a>
                    <a class="dropdown-item" href="cadastroMarcas.php">Cadastro de Marcas</a>
                  <?php
                    }
                  ?>
              </div>
          </li>
          <?php
            if(!empty($cliente)){
          ?>   
            <li class="nav-item">
              <label class="nav-link" href="cliente.php">Ola <?=$cliente['nome']?></label>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="opcoes.php?acao=sair">Sair</a>
            </li>          <?php
            }
          ?>
         <?php
            if(empty($cliente)){
          ?>   
            <li class="nav-item">
              <a class="nav-link" href="login.php">Login</a>
            </li>
          <?php
            }
          ?>
      </ul>
    </div>
</nav>

     