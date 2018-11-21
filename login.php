<html lang="pt">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="css/favicon.ico">

  <title>Signin Template for Bootstrap</title>

  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/login.css" rel="stylesheet">
</head>

<body class="text-center">
  <form class="form-signin" action="validarLogin.php" method="POST">
    <img class="mb-4" src="../../assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal">Faça login em nosso site</h1>
    
    <label for="inputEmail" class="sr-only">E-mail</label>
    <input type="email" id="email" name="email" class="form-control" placeholder="Digite seu E-mail" required autofocus>
    
    <label for="senha" class="sr-only">Password</label>
    <input type="password" id="senha" name="senha" class="form-control" placeholder="Digite sua senha" required>
    <div class="checkbox mb-3">
    <div class="checkbox" id="RememberMeDiv">
      <label class="qtip2" data-hasqtip="0" oldtitle="Ao marcar esta caixa, você entrará automaticamente sempre que retornar." title="" aria-describedby="qtip-0">
          <input name="RememberMe" id="RememberMe" type="checkbox" checked="checked">
          Lembrar
      </label>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
  
    <div class="card-footer">
      <div class="d-flex justify-content-center links">
        Não possue uma conta<a href="cliente.php?acao=novo">Criar conta</a>
      </div>
      <div class="d-flex justify-content-center">
        <a href="#">Esqueceu sua senha?</a>
      </div>
    </div>
		<?php    
        include_once("default/footer.php");
    ?>
	</form>
</body>
</html>