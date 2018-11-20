<?php
    $cliente = $_SESSION['cliente'];

    if(!empty($cliente) && $cliente['acesso'] == 2)
    {
?>
<?php
    require_once "funcoes/funcoesCategoria.php";
    
    $id = "";
    $nomeCategoria = "";
    $unidadeMedida = "";

    if (!empty($_GET)) {
        $id = $_GET['id'];

        if ($_GET['acao'] == 'carregar') {
            $categoria = buscarCategoria($id);
            $nomeCategoria = $categoria['nomeCategoria'];
            $descricao = $descricao['descricao'];
        }
        if ($_GET['acao'] == 'excluir') {
            excluirCategoria($id);
        }
    }
    if(!empty($_POST)) {

        if (!empty($_POST['id'])){
            editarCategoria($_POST);
        } else {
            salvarCategoria($_POST);
        }
    }
    $categorias = listarCategorias();
?>
<!DOCTYPE html>
<?php    
include_once("default/header.php");
?>
<body>
<?php    
    include_once("default/form.php");
?>
<main role="main" class="container">
    <h2>Novos Categorias</h2>
        <form action="cadastroCategoria.php" method="POST">
        <input type="hidden" id="id" name="id" value="<?=$id?>"/>

        <div class="form-group">
            <label for="nomeCategoria">Nome do categoria</label>
            <input type="text" class="form-control" name="nomeCategoria" id="nomeCategoria" placeholder="Digite o nome do Categoria" value="<?=$nomeCategoria?>">
        </div>

        <div class="form-group">
            <label for="unidadeMedida">Unidade de medida</label>
            <input type="text" class="form-control" name="nomeCategoria" id="nomeCategoria" placeholder="Digite o nome do Categoria" value="<?=$nomeCategoria?>">
        </div>
        <input type="submit" value="Salvar" class="btn btn-primary" /> 
    </form>
   
        <table class="table table-dark">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Categoria</th>
                    <th>Descrição</th>
                </tr>
            </thead>
            <?php
                foreach($categorias as $categoria){
            ?>
                <tbody>
                    <tr>
                        <td><?=$categoria['id']?></td>
                        <td><?=$categoria['nomeCategoria']?></td>
                        <td><?=$categoria['descricao']?></td>                   
                        <td>
                            <a href="cadastroCategoria.php?acao=carregar&id=<?=$categoria['id']?>"
                                class="btn btn-primary">Editar
                            </a>
                        </td>
                        <td>
                            <a href="cadastroCategoria.php?acao=excluir&id=<?=$categoria['id']?>" 
                                class="btn btn-primary"
                                onclick="return confirm('Você está certo disso?');">
                                Remover
                            </a>
                        </td>
                    </tr>
                </tbody>
            <?php  
                }
            ?>
        </table>
    
</main>
<?php    
    include_once("default/footer.php");
?>

</body>
</html>
<?php  
    }
?>