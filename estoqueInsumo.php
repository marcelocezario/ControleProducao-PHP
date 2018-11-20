<?php
require_once "funcoes/funcoesInsumo.php";
    $id = "";
    $qtde = "";
    $id_insumo = "";

    if (!empty($_GET)) {
        $id = $_GET['id'];

        if ($_GET['acao'] == 'carregar') {
            $estoqueInsumo = buscarEstoqueInsumo($id);

            $qtde = $estoqueInsumo['qtde'];
            $id_insumo = $estoqueInsumo['id_insumo'];
        }
        if ($_GET['acao'] == 'excluir') {
            excluirEstoqueInsumo($id);
        }
    }
    if(!empty($_POST)) {
        if (!empty($_POST['id'])){
            editarEstoqueInsumo($_POST);
        } else {
            salvarEstoqueInsumo($_POST);
        }
    }
    $estoqueInsumos = listarEstoqueInsumo();
?>
<!DOCTYPE html>
<?php    
        include_once("default/header.php");
?>
<body>
<?php    
        include_once("default/navbar.php");
?>
<main role="main" class="container">
        <h2>Estoque de Insumos</h2>
    <form action="estoqueInsumo.php" method="POST">
        <input type="hidden" id="id" name="id" value="<?=$id?>"/>

        <div class="form-group">
            <label for="qtde">Quantidade do Insumo</label>
            <input type="text" class="form-control" name="qtde" id="qtde" placeholder="Digite a quantidade" value="<?=$qtde?>">
        </div>
        <div class="form-group">
            <label for="id_insumo">Insumo:</label>
            <select class="form-control" id="id_insumo" name="id_insumo">
                <option value="" disabled selected>Selecione um insumo </option>
                <?php
                    $resultado = listarInsumos();
                    
                    if(!empty($resultado)){
                    
                        foreach ($resultado as $res) {
                            $selected = "";
                            if($res['id'] == $id_insumo){
                                $selected = "selected";
                            }
                        ?>                                             
                            <option <?=$selected ?> value="<?=$res['id'];?>" ><?=$res['nomeInsumo'];?></option> 
                        <?php      
                        }
                    }
                ?>
            </select>
        </div>
        <input type="submit" value="Salvar" class="btn btn-primary" /> 
    </form>
    <?php
        if(!empty($estoqueInsumos)){

    ?>
    <table class="table table-dark">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Insumo</th>
                    <th>U. de Medida</th>
                    <th>Quantidade</th>
                </tr>
            </thead>
            <?php
                foreach($estoqueInsumos as $estoqueInsumo){
            ?>
                <tbody>
                    <tr>
                        <td><?=$estoqueInsumo['id']?></td>
                        <td><?=$estoqueInsumo['nomeInsumo']?></td>
                        <td><?=$estoqueInsumo['unidadeMedida']?></td>
                        <td><?=$estoqueInsumo['qtde']?></td>                   
                        <td>
                            <a href="estoqueInsumo.php?acao=carregar&id=<?=$estoqueInsumo['id']?>"
                                class="btn btn-primary">Editar
                            </a>
                        </td>
                        <td>
                            <a href="estoqueInsumo.php?acao=excluir&id=<?=$estoqueInsumo['id']?>" 
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
        <?php  
            }        
        ?>
    </main>
    <?php    
        include_once("default/footer.php");
    ?>
</body>
</html>