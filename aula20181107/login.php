<!DOCTYPE html>
<html lang="en">
<?php    
include_once("_layoutNavbar.php");
?>

<body>
<main role="main" class="container">

<h1>Login</h1>

<form action="validarLogin.php" method="POST"
    >


<div class="form-group">
<br/><br/><br/>

<div class="form-group row">
    <label for="inputPassword" class="col-sm-2 col-form-label">Login</label>
    <div class="col-sm-10">
    <input type="text" class="form-control" id="login" name="login" placeholder="Login">
    </div>
</div>

<div class="form-group row">
    <label for="inputPassword" class="col-sm-2 col-form-label">Senha</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" name="senha" id="inputPassword" placeholder="Password">
    </div>
  </div>
</div>

<input type="submit" value="Login" class="btn btn-primary" />
</form>



</main>

<script type="text/javascript" 
    src="js/jquery-latest.min.js"></script>
<script type="text/javascript" 
    src="js/jquery.mask.min.js"></script>
<script>
    
    $('#valor').mask('#.##0,00', {reverse: true});
    
</script>
    
    </body>

  <?php    
include_once("_layoutFooter.php");
?>

</html>