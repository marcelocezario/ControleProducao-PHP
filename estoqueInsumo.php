<?php
require_once "funcoes.php";
$id = "";
$qtde = "";
$id_insumo = "";
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
        editarEstoqueInsumo($_POST);
    } else {
        salvarEstoqueInsumo($_POST);
    }
}
$insumos = listarInsumos();
?>
<!DOCTYPE html>
<?php    
        include_once("header.php");
?>
<body>
<main role="main" class="container">
        <h2>Quantidade para o insumo</h2>
    <form action="estoqueInsumo.php" method="POST">
    <input type="hidden" id="id" name="id" value="<?=$id?>"/>

    <div class="form-group">
        <label for="qtde">cpf</label>
        <input type="text" class="form-control" name="qtde" id="qtde" placeholder="Digite a quantidade">
    </div>
    <div class="form-group">
    <label for="id_insumo">Insumo:</label>
    <select class="form-control" id="id_insumo" name="id_insumo"  value="<?=$insumo?>">
        <option value="" disabled selected>Selecione um insumo </option>
        <?php
            $resultado = listarInsumos();
        
        if(!empty($resultado)){
            foreach ($resultado as $res) {
        ?>                                             
        <option  value="<?=$res['id'];?>" ><?=$res['nomeInsumo'];?></option> 
        <?php      
        }
        }
        ?>
        </select>
    </div>
    <input type="submit" value="Salvar" class="btn btn-primary" /> 

    </form>
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