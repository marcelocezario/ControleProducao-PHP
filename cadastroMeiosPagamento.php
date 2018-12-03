<?php    
    include_once("default/header.php");
    
    if ($_SESSION['cliente']['acesso'] != 2) {
        header("location: erro.php");
    }
    
    require_once "funcoes/funcaoMeioPagamento.php";
    
    $id = "";
    $formaPagamento = "";
    $nrMaxParcelas = "";
    $txJurosParcelamento = "";

    if (!empty($_GET)) {
        $id = $_GET['id'];

        if ($_GET['acao'] == 'carregar') {

            $meioPagamento = buscarMeioPagamento($id);
            $formaPagamento = $meioPagamento['formaPagamento'];
            $nrMaxParcelas = $meioPagamento['nrMaxParcelas'];
            $txJurosParcelamento = $meioPagamento['txJurosParcelamento'];
        }
        if ($_GET['acao'] == 'excluir') {
            excluirMeioPagamento($id);
            header("location: cadastroMeiosPagamento.php");
        }
    }
    if(!empty($_POST)) {

        if (!empty($_POST['id'])){
            editarMeioPagamento($_POST);
        } else {
            salvarMeioPagamento($_POST);
        }
    }
    $meiosPagamento = listarMeiosPagamento();

    $_SESSION['urlAnterior'] = $_SERVER['REQUEST_URI'];

?>

<!DOCTYPE html>

<body>
<?php    
    include_once("default/navbar.php");
?>
<main role="main" class="container">
    <h2>Cadastro de Meios de Pagamento</h2>
        <form action="cadastroMeiosPagamento.php" method="POST">
        <input type="hidden" id="id" name="id" value="<?=$id?>"/>

        <div class="form-group">
            <label for="formaPagamento">Forma de pagamento</label>
            <input type="text" class="form-control" maxlength="40" required name="formaPagamento"
            id="formaPagamento" placeholder="Digite a forma de pagamento" value="<?=$formaPagamento?>">
        </div>

        <div class="form-group">
            <label for="nrMaxParcelas">Número Máximo de Parcelas</label>
            <input type="number"  min="1" max="200" class="form-control" required
            name="nrMaxParcelas" id="nrMaxParcelas" placeholder="Número Máximo Parcelas" value="<?=$nrMaxParcelas?>">
        </div>

        <div class="form-group">
            <label for="txJurosParcelamento">Taxa de Juros Meio de Pagamento %</label>
            <input type="number" step="0.01" min="0" max="100" class="form-control" required
            name="txJurosParcelamento" id="txJurosParcelamento" placeholder="Taxa de Juros Parcelamento %" value="<?=$txJurosParcelamento?>">
        </div>

        <input type="submit" value="Salvar" class="btn btn-primary" /> 
    </form>
        <table class="table table-dark">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Forma Pagamento</th>
                    <th>Número máximo de Parcelas</th>
                    <th>Taxa de juros parcelamento</th>
                </tr>
            </thead>
            <?php
                foreach($meiosPagamento as $meioPagamento){
            ?>
                <tbody>
                    <tr>
                        <td><?=$meioPagamento['id']?></td>
                        <td><?=$meioPagamento['formaPagamento']?></td>
                        <td><?=$meioPagamento['nrMaxParcelas']?></td>
                        <td><?=$meioPagamento['txJurosParcelamento']?></td>
                        <td>
                            <a href="cadastroMeiosPagamento.php?acao=carregar&id=<?=$meioPagamento['id']?>"
                                class="btn btn-primary">Editar
                            </a>
                        </td>
                        <td>
                            <a href="cadastroMeiosPagamento.php?acao=excluir&id=<?=$meioPagamento['id']?>" 
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

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
