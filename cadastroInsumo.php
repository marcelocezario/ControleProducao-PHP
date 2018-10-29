<?php
require_once "funcoes.php";
    $id = "";
    $nomeInsumo = "";
    $unidadeMedida = "";

    if (!empty($_GET)) {
        $id = $_GET['id'];

        if ($_GET['acao'] == 'carregar') {
            $insumo = buscarInsumo($id);
            $nomeInsumo = $insumo['nomeInsumo'];
            $unidadeMedida = $insumo['unidadeMedida'];
        }
        if ($_GET['acao'] == 'excluir') {
            excluirInsumo($id);
        }
    }
    if(!empty($_POST)) {

        if (!empty($_POST['id'])){
            editarInsumo($_POST);
        } else {
            salvarInsumo($_POST);
        }
    }


    $insumos = listarInsumos();
?>
<!DOCTYPE html>
<body>
<?php    
include_once("header.php");
?>

<main role="main" class="container">
        <h2>Cadastro de Insumo</h2>
            <form action="cadastroInsumo.php" method="POST">
            <input type="hidden" id="id" name="id" value="<?=$id?>"/>

            <div class="form-group">
                <label for="nomeInsumo">Nome do insumo</label>
                <input type="text" class="form-control" name="nomeInsumo" id="nomeInsumo" placeholder="Digite o nome do Insumo" value="<?=$nomeInsumo?>">
            </div>

            <div class="form-group">
                <label for="unidadeMedida">Unidade de medida</label>
                <select class="form-control" id="unidadeMedida" name="unidadeMedida"  value="<?=$unidadeMedida?>">
                    <option value="" disabled selected>Selecione uma unidade de medida</option>
                    <option value="Gramas" <?php echo selected( 'Gramas', $unidadeMedida ); ?>>Gramas</option>
                    <option value="Litros" <?php echo selected( 'Litros', $unidadeMedida ); ?>>Litros</option>
                    <option value="Mililitro" <?php echo selected( 'Mililitro', $unidadeMedida );?>>Mililitro</option>
                    <option value="Quilos" <?php echo selected( 'Quilos', $unidadeMedida ); ?>>Quilos</option>
                    <option value="Unidade" <?php echo selected( 'Unidade', $unidadeMedida );?>>Unidade</option>
                 </select>
            </div>
            <input type="submit" value="Salvar" class="btn btn-primary" /> 
        </form>

        <table class="table table-dark">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Insumo</th>
                    <th>Unidade</th>
                </tr>
            </thead>
            <?php
                foreach($insumos as $insumo){
            ?>
                <tbody>
                    <tr>
                        <td><?=$insumo['id']?></td>
                        <td><?=$insumo['nomeInsumo']?></td>
                        <td><?=$insumo['unidadeMedida']?></td>                   
                        <td>
                            <a href="cadastroInsumo.php?acao=carregar&id=<?=$insumo['id']?>"
                                class="btn btn-primary">Editar
                            </a>
                        </td>
                        <td>
                            <a href="cadastroInsumo.php?acao=excluir&id=<?=$insumo['id']?>" 
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
    include_once("footer.php");
?>

    <!-- JavaScript-->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>

</body>

</html>