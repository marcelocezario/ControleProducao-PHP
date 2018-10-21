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

//upload de arquivo usado imagem com exemplo
$url = "";
if(!empty($_FILES)) {

    //Seleciona o local que será armazenado os arquivos no servidor
    $caminho_arquivo = "C:\\xampp\\htdocs\\ControleProducao-PHP\\img\\";
    
    /*
    $_FILES = comando do arquivo,
    image é o nome do campo que será feito o upload
    name é o atributo que tem que pegar (nome do arquivo)
    */
    $nome_arquivo = $_FILES['image']['name'];
    
    
    // pega da memória temporária e envia para o servidor 
    move_uploaded_file($_FILES['image']['tmp_name'],
    $caminho_arquivo.$nome_arquivo);
 
    // seta objeto para puxar de novo
    $url = 'img/'.$nome_arquivo;

}

$id = "";
$nomeInsumo = "";
$unidadeDeMedida = "";
$cpf = "";

if (!empty($_GET)){
    if($_GET['acao'] == 'carregar')
    {
        print_r($_GET);
        $id = $_GET['id'];

        $insumo = buscarInsumo($id);
        $nomeInsumo = $insumo['nomeInsumo'];
        $unidadeDeMedida = $insumo['unidadeDeMedida'];
        $cpf = $insumo['cpf'];
        $url = $insumo['url'];
    }
    if($_GET['acao'] == 'excluir')
    {
        excluirInsumo($id);
    }

    if(!empty($_POST)){
        $_POST['url'] = $url;
        print_r($_POST);
        salvarInsumo($_POST);
    }

    $insumos = listarInsumos();
}

?>
    <main role="main" class="container">
        <h2>Cadastro de Insumo</h2>
            <form action="cadastroInsumo.php" method="POST"
            enctype="multipart/form-data">
            <input type="hidden" name="id"/>


            <img src="<?=$url?>" class="rounded-circle" width="304" height="236" />

            <div class="form-group">
                <label for="nomeInsumo">Nome do insumo</label>
                <input type="text" class="form-control" name="nomeInsumo" id="nome" placeholder="Digite o nome do Insumo" value="<?=$nomeInsumo?>">
            </div>
            <div class="form-group">
                <label for="cpf">cpf</label>
                <input type="text" class="cpf form-control" name="cpf" id="cpf" placeholder="Digite o cpf" value="<?=$cpf?>">
            </div>
            <div class="form-group">
                <label for="imagem">Imagem</label>
                <input type="file" class="form-control" name="image" id="imagem" >
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
                    <td><?=$insumo['cpf']?></td>

                    <td>
                        <a href="cadastroInsumo.php?acao=carregar&id=<?=$insumo['id']?>"
                            class="btn btn-primary">Editar
                        </a>
                    </td>
                    <td>
                        <a href="cadastroInsumo.php?acao=excluir&id=<?=$insumo['id']?>" 
                            class="btn btn-primary"
                            onclick="return confirm('Você está certo disso?');"
                        >Remover
                        </a>
                    </td>
</td>
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
    <script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.mask.min.js"></script>

    <script type="text/javascript" src="js/mask.js"></script>
</body>

</html>