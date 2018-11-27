<!DOCTYPE html>
<?php    
    include_once("default/header.php");
    $cliente =  $_SESSION['cliente'];
    if (!empty($_SESSION['cliente'])) {
        
    }else {
        header("location: erro.php");
    } 
    
    
    require_once "funcoes/funcaoProduto.php";
    
    $id = "";
    $nomeMarca = "";
    $descricao = "";

    if (!empty($_GET)) {
        $id = $_GET['id'];

        if ($_GET['acao'] == 'carregar') {

            $marca = buscarMarca($id);
            $nomeMarca = $marca['nomeMarca'];
            $descricao = $descricao['descricao'];
        }
        if ($_GET['acao'] == 'excluir') {
            excluirMarca($id);
        }
    }
    if(!empty($_POST)) {

        if (!empty($_POST['id'])){
            editarMarca($_POST);
        } else {
            salvarMarca($_POST);
        }
    }
    $marcas = listarMarca();
?>

<body>
<?php    
    include_once("default/navbar.php");
?>
<main role="main" class="container">
    <h2>Novas Marcas</h2>
        <form action="cadastroMarcas.php" method="POST">
        <input type="hidden" id="id" name="id" value="<?=$id?>"/>

        <div class="form-group">
            <label for="nomeMarca">Nome da Marca</label>
            <input type="text" class="form-control" maxlength="40" requered name="nomeMarca" id="nomeMarca" placeholder="Digite o nome da Marca" value="<?=$nomeMarca?>">
        </div>

        <div class="form-group">
            <label for="descricao">Descrição</label>
            <input type="text"  maxlength="200" class="form-control" name="descricao" id="descricao" placeholder="Digite a descrição da marca" value="<?=$descricao?>">
        </div>
        <input type="submit" value="Salvar" class="btn btn-primary" /> 
    </form>
        <table class="table table-dark">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Marca</th>
                    <th>Descrição</th>
                </tr>
            </thead>
            <?php
                foreach($marcas as $marca){
            ?>
                <tbody>
                    <tr>
                        <td><?=$marca['id']?></td>
                        <td><?=$marca['nomeMarca']?></td>
                        <td><?=$marca['descricao']?></td>
                        <td>
                            <a href="cadastroMarcas.php?acao=carregar&id=<?=$marca['id']?>"
                                class="btn btn-primary">Editar
                            </a>
                        </td>
                        <td>
                            <a href="cadastroMarcas.php?acao=excluir&id=<?=$marca['id']?>" 
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
