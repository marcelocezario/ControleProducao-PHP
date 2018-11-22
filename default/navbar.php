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
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Produtos
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="produto/album.php">Lista de produtos</a>
                  <?php
                    if(!empty($acesso) && $acesso == 2){
                  ?>                       
                      <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="produto/cadastroCategorias.php">Novas Categorias </a>
                    <a class="dropdown-item" href="produto/cadastroProdutos.php">Novos Produtos</a>
                  <?php
                    }
                  ?>
              </div>
          </li>
          <?php
            if(!empty($cliente)){
          ?>   
            <li class="nav-item">
              <a class="nav-link" href="opcoes.php?acao=sair">Sair</a>
            </li>
            <li class="nav-item">
              <label class="nav-link" href="cliente.php">Ola <?=$cliente['nome']?></label>
            </li>
          <?php
            }
          ?>
        <li class="nav-item">
          <a class="nav-link" href="#">Services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
      </ul>
    </div>
</nav>

     