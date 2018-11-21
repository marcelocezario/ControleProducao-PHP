<?php
require_once "funcoes/funcaoProduto.php";
include_once("default/header.php");

$cliente = $_SESSION['cliente'];

    $id = "";
    $nomeProduto = "";
    $descricao = "";    
    $url = "";
    $valor = "";
    $qtde = "";
    $id_categoria = "";
    $ativo = "";
    if(!empty($_FILES)) {
        $caminho_arquivo = "C:\\xampp\\htdocs\\ControleProducao-PHP\\img\\";
        $nome_arquivo = $_FILES['image']['name'];   
        move_uploaded_file($_FILES['image']['tmp_name'],
        $caminho_arquivo.$nome_arquivo);
        $url = 'img/'.$nome_arquivo;
    }
    if (!empty($_GET)) {
        $id = $_GET['id'];

        if ($_GET['acao'] == 'carregar') {
            $produto = buscarProduto($id);

            $nomeProduto = $produto['nomeProduto'];
            $descricao = $produto['descricao'];
            $valor = $produto['valor'];
            $qtde = $produto['qtde'];
            $id_categoria = $produto['id_categoria'];
            $url = $produto['url'];
            $ativo = $produto['ativo'];
        }
        if ($_GET['acao'] == 'excluir') {
            excluirProduto($id);
        }
    }

    if(!empty($_POST)){
        $_POST['url'] = $url;
        print_r($_POST);
    
        salvarProduto($_POST);
    }

    $produtos = listarProtudos();
?>
<!DOCTYPE html>
<body>
    <?php    
        include_once("default/navbar.php");
    ?>
    <main role="main" class="container">
    <h2>Novos Produtos</h2>
        <form action="cadastroProdutos.php" method="POST">
        <input type="hidden" id="id" name="id" value="<?=$id?>"/>

        <div class="form-group">
            <label for="nomeProduto">Nome da Produto</label>
            <input type="text" class="form-control" maxlength="40" requered name="nomeProduto" id="nomeProduto" placeholder="Digite o nome do produto" value="<?=$nomeProduto?>">
        </div>
    </main>
    <?php    
        include_once("default/footer.php");
    ?>
</body>
</html>