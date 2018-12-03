<!DOCTYPE html>
<?php    
    include_once("default/header.php");
    
    if ($_SESSION['cliente']['acesso'] != 2) {
        header("location: erro.php");
    }
    
    
    require_once "funcoes/funcaoProduto.php";
    
    $id = "";
    $nomeCategoria = "";
    $descricao = "";

    if (!empty($_GET)) {
        $id = $_GET['id'];

        if ($_GET['acao'] == 'carregar') {

            $categoria = buscarCategoria($id);
            $nomeCategoria = $categoria['nomeCategoria'];
            $descricao = $categoria['descricao'];
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

    $_SESSION['urlAnterior'] = $_SERVER['REQUEST_URI'];

?>

<body>
<?php    
    include_once("default/navbar.php");
?>
<main role="main" class="container">
    <h2>Novas Categorias</h2>
        <form action="cadastroCategorias.php" method="POST">
        <input type="hidden" id="id" name="id" value="<?=$id?>"/>

        <div class="form-group">
            <label for="nomeCategoria">Nome da Categoria</label>
            <input type="text" class="form-control" maxlength="40" requered name="nomeCategoria" id="nomeCategoria" placeholder="Digite o nome da Categoria" value="<?=$nomeCategoria?>">
        </div>

        <div class="form-group">
            <label for="descricao">Descrição</label>
            <input type="text"  maxlength="200" class="form-control" name="descricao" id="descricao" placeholder="Digite a descrição da categoria" value="<?=$descricao?>">
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
                            <a href="cadastroCategorias.php?acao=carregar&id=<?=$categoria['id']?>"
                                class="btn btn-primary">Editar
                            </a>
                        </td>
                        <td>
                            <a href="cadastroCategorias.php?acao=excluir&id=<?=$categoria['id']?>" 
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
</body>
</html>
