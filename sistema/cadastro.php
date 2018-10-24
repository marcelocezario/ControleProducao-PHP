<?php

    require_once "funcoes.php";

    $url = "";
    if(!empty($_FILES)) {
        $caminho_arquivo = "C:\\xampp\\htdocs\\sistema\\img\\";
         
        $nome_arquivo = $_FILES['image']['name'];
         
        move_uploaded_file($_FILES['image']['tmp_name'], 
        $caminho_arquivo.$nome_arquivo);
         
        $url = 'img/'.$nome_arquivo;
    }

    $id = "";
    $nome = "";
    $idade = "";
    $dtNascimento = "";
    $cpf = "";
    
    if (!empty($_GET)) {
        $id = $_GET['id'];
        if ($_GET['acao'] == 'carregar') {
            $cliente = buscarCliente($id);
            $nome = $cliente['nome'];
            $idade = $cliente['idade'];
            $dtNascimento = $cliente['dtNascimento'];
            $cpf = $cliente['cpf'];
            $url = $cliente['url'];
        }
        if ($_GET['acao'] == 'excluir') {
            excluirCliente($id);
        }
    }

   // print_r($_POST);
    if(!empty($_POST)) {
        $_POST['url'] = $url;
        print_r($_POST);
        salvarCliente($_POST);
    }

    $clientes = listarClientes();

   // print_r($clientes);

?>
<html>
<head>
    <title>Cadastro</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/navbar_sticky-footer-navbar.css" rel="stylesheet">

</head>
<body >

<?php
//include_once("header.php");
?>

<main role="main" class="container">

<h1>Cadastro de Cliente</h1>
<form action="cadastro.php" method="POST"
    enctype="multipart/form-data">
<input type="hidden" name="id" value="<?=$id?>"/>
<img src="<?=$url?>" class="rounded-circle" width="304" height="236" />
<div class="form-group">
    <label for="nome">Nome</label>
    <input type="text" name="nome" class="form-control" 
    id="nome" placeholder="Digite seu nome"
    value="<?=$nome?>"
    required >
</div>
<div class="form-group">
    <label for="cpf">CPF</label>
    <input type="text" name="cpf" class="form-control cpf" 
    id="cpf" placeholder="Digite seu cpf"
    value="<?=$cpf?>"
     >
</div>
<div class="form-group">
    <label for="idade">Idade</label>
    <input type="number" name="idade" class="form-control" 
    id="idade" placeholder="Digite sua idade"
    onkeydown="return event.keyCode >= 48 && event.keyCode <= 57 
    ? true : false;"
    value="<?=$idade?>">
</div>
<div class="form-group">
    <label for="dtNascimento">Data de nascimento</label>
    <input type="date" name="dtNascimento" class="form-control" 
    id="dtNascimento" placeholder="Digite a data de nascimento"
    value="<?=$dtNascimento?>"
    >
</div>
<div class="form-group">
    <label for="imagem">Imagem</label>
    <input type="file" name="image" class="form-control" 
    id="imagem">
</div>
<input type="submit" value="Salvar" class="btn btn-primary" />
</form>

<table class="table">
    <tr>
        <th>ID</th>        
        <th>NOME</th>        
        <th>&nbsp;</th>    
        <th>&nbsp;</th>    
    </tr>
    <?php

    foreach ($clientes as $cliente) {
    
    ?>
    <tr>
        <td><?=$cliente['id']?></td>        
        <td><?=$cliente['nome']?></td>        
        <td><a href="cadastro.php?acao=carregar&id=<?=$cliente['id']?>"
         class="btn btn-primary">Carregar</a>
         </td>     
        <td>
        <a href="cadastro.php?acao=excluir&id=<?=$cliente['id']?>"
         class="btn btn-primary"
         onclick="return confirm('Você está certo disso?');">Excluir</a>
        
        </td>     
    </tr>
    <?php
    }
    ?>

</table>


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

</body>
</html>