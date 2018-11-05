<?php
    require_once "funcoes.php";

    if (!empty($_POST)){
        $id = validarLogin($_POST);

        if (!empty($id['id'])){
            $retorno = buscarCliente($id['id']);
            $cliente = "Bem vindo ".$retorno['nome'];

        } else {
            $cliente = "Cliente não encontrado";
        }
    }
?>



<!DOCTYPE html>
<html lang="en">
<?php    
include_once("_layoutNavbar.php");
?>

<body>
<main role="main" class="container">

<br/><br/><br/>

<?php

echo $cliente;

?>


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