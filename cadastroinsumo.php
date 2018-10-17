<html>



<body>
<?php    
include_once("header.php");
?>

<?php
require_once "funcoes.php";

if(!empty($_POST)){
    salvarInsumo($_POST);
}
 
$insumos = listarInsumos();

$id = "";
$nomeInsumo = "";
$unidadeDeMedida = "";

if (!empty($_GET)){
    print_r($_GET);
    $id = $_GET['id'];

    $insumo = buscarInsumo($id);
    $nomeInsumo = $insumo['nomeInsumo'];
    $unidadeDeMedida = $insumo['unidadeDeMedida'];
}

?>
    <main role="main" class="container">
        <h2>Cadastro de Insumo</h2>
            <form action="cadastroInsumo.php" method="POST">
            <input type="hidden" name="id"/>

            <div class="form-group">
                <label for="nomeInsumo">Nome do insumo</label>
                <input type="text" class="form-control" name="nomeInsumo" id="nome" placeholder="Digite o nome do Insumo" value="<?=$nomeInsumo?>">
            </div>

            <div class="form-group">
                <label for="unidadeDeMedida">Unidade de medida</label>
                <select class="form-control" id="unidadeDeMedida" name="unidadeDeMedida"  value="<?=$unidadeDeMedida?>">
                    <option value="" disabled selected>Selecione uma unidade de medida</option>
                    <option value="1" <?=($unidadeDeMedida == 1) ? "selected" : ""?>>Gramas</option>
                    <option value="2" <?=($unidadeDeMedida == 2) ? "selected" : ""?>>Litros</option>
                    <option value="3" <?=($unidadeDeMedida == 3) ? "selected" : ""?>>Mililitro</option>
                    <option value="4" <?=($unidadeDeMedida == 4) ? "selected" : ""?>>Quilos</option>
                    <option value="5" <?=($unidadeDeMedida == 5) ? "selected" : ""?>>Unidade</option>
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
                    <td><?=$insumo['unidadeDeMedida']?></td>
                    <td><a href="cadastroInsumo.php?id=<?=$insumo['id']?>">Editar</a></td>
                    <td><button>Excluir</button></td>
                </tr>

                  </tbody>

            <?php  
                }
            ?>
        




        </table>


    </main>
    <footer class="footer">
        <div class="container">
            <p>&copy; Marcelo Henrique Cezario e Gabryel J. Boeira 2018. All Rights Reserved.</p>
        </div>
    </footer>

    <!-- JavaScript-->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>