<?php

    require_once "funcoes.php";

    $id = "";
    $nome = "";
    $descricao = "";
    $valor = "";
    $urlImagem = "";

    if(!empty($_FILES)) {
        $caminho_arquivo = "C:\\xampp\\htdocs\\ControleProducao-PHP\\marcelo\\img\\";
         
        $nome_arquivo = $_FILES['image']['name'];
         
        move_uploaded_file($_FILES['image']['tmp_name'], 
        $caminho_arquivo.$nome_arquivo);
         
        $urlImagem = 'img/'.$nome_arquivo;
    }

    
    if (!empty($_GET)) {
        $id = $_GET['id'];
        if ($_GET['acao'] == 'carregar') {
            $produto = buscarProduto($id);
            $nome = $produto['nome'];
            $descricao = $produto['descricao'];
            $valor = $produto['valor'];
            $urlImagem = $produto['urlImagem'];
        }
        if ($_GET['acao'] == 'excluir') {
            excluirProduto($id);
        }
    }

    if(!empty($_POST)) {
        $_POST['urlImagem'] = $urlImagem;

        if (!empty($_POST['id'])){
            editarProduto($_POST);
        } else {
            salvarProduto($_POST);
        }
    }

    $produtos = listarProdutos();

?>

<!DOCTYPE html>
<html lang="en">
<?php    
include_once("_layoutNavbar.php");
?>


    <body>

    <main role="main" class="container">

    <h1>Cadastro de produtos</h1>
    <form action="cadastroProduto.php" method="POST"
        enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?=$id?>"/>
    
    <?php
    if (!empty($id)){
    ?>
    
    <img src="<?=$urlImagem?>" class="rounded-circle" height="236" width="304" />
    
    <?php
    }
    ?>


    <div class="form-group">
    <label for="nome">Nome</label>
    <input type="text" name="nome" class="form-control" 
    id="nome" placeholder="Digite o nome do produto"
    value="<?=$nome?>"
    required >
</div>

  <div class="form-group">
    <label for="descricao">Descrição do produto</label>
    <textarea class="form-control" id="descricao" name="descricao" rows="3"
    required placeholder="Descreva o produto"><?=$descricao?></textarea>
  </div>


<div class="form-group">
    <label for="valor">Valor</label>
    <input type="decimal" name="valor" class="form-control" 
    id="valor" placeholder="Digite o valor do produto" required min="0"
    value="<?=$valor?>">

</div>

<div class="form-group">
    <label for="imagem">Imagem</label>
    <input type="file" name="image" class="form-control" 
    id="imagem">
</div>
<input type="submit" value="Salvar" class="btn btn-primary" />
</form>

<div>
<br/>
<table class="table">
    <tr>
        <th>ID</th>        
        <th>NOME</th>        
        <th>VALOR</th>        
        <th>&nbsp;</th>    
        <th>&nbsp;</th>    
    </tr>
    <?php

    foreach ($produtos as $produto) {
    
    ?>
    <tr>
        <td><?=$produto['id']?></td>        
        <td><?=$produto['nome']?></td>        
        <td><?=$produto['valor']?></td>        
        <td><a href="cadastroProduto.php?acao=carregar&id=<?=$produto['id']?>"
         class="btn btn-primary">Carregar</a>
         </td>     
        <td>
        <a href="cadastroProduto.php?acao=excluir&id=<?=$produto['id']?>"
         class="btn btn-primary"
         onclick="return confirm('Você está certo disso?');">Excluir</a>
        
        </td>     
    </tr>
    <?php
    }
    ?>

</table>
</div>


    </main>



<script>

    $('#valor').mask('#.##0,00', {reverse: true});

</script>

    </body>

<?php    
include_once("_layoutFooter.php");
?>

</html>
