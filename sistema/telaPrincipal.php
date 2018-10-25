<?php

    require_once "funcoes.php";

?>
<html>
<head>
    <title>Cadastro</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/navbar_sticky-footer-navbar.css" rel="stylesheet">
    <link href="album.css" rel="stylesheet">
    

</head>
<body >

<?php
//include_once("header.php");
?>

<main role="main" class="container">

<div class="album py-5 bg-light">
        <div class="container">

          <div class="row">

              <?php

$clientes = listarClientes();
foreach ($clientes as $cliente) {

?>

            <div class="col-md-4">
              <div class="card mb-4 shadow-sm">
                <img class="card-img-top" src="<?=$cliente['url']?>" alt="Card image cap">
                <div class="card-body">
                  <p class="card-text">
                  <?=$cliente['nome']?>
                  </p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-outline-secondary">Detalhes</button>
                      <a type="button" class="btn btn-sm btn-outline-secondary" href="detalhesCliente.php?acao=carregar&id=<?=$cliente['id']?>">Editar</a>
                    </div>
                    <small class="text-muted">9 mins</small>
                  </div>
                </div>
              </div>
            </div>
<?php
}
?>
          </div>
        </div>
      </div>

</main>

<footer class="footer">
<div class="container">
    <span class="text-muted">Sistema abc!!</span>
</div>
</footer>
    
<script type="text/javascript" 
    src="js/jquery-latest.min.js"></script>
<script type="text/javascript" 
    src="js/jquery.mask.min.js"></script>
<script>
    
     $('#cpf').mask('000.000.000-00', {reverse: true});
    
</script>

    <script src="js/holder.min.js"></script>

</body>
</html>