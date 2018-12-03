<?php 
    include_once("default/header.php");
    
    if ($_SESSION['cliente']['acesso'] != 2) {
        header("location: erro.php");
    }
    
    require_once "funcoes/funcaoProduto.php";


    $id = "";
    $descricaoResumida = ""; 
    $descricaoCompleta = ""; 
    $idCategoria = "";
    $idMarca = "";
    $nomeProduto = "";
    $qtdeEstoque = "";
    $url = "";
    $valor = "";

    if (!empty($_GET)) {
        $id = $_GET['id'];

        if ($_GET['acao'] == 'carregar') {
            
            $produto = buscarProduto($id);
            $descricaoResumida = $produto['descricaoResumida'];
            $descricaoCompleta = $produto['descricaoCompleta'];
            $idCategoria = $produto['idCategoria'];
            $idMarca = $produto['idMarca'];
            $nomeProduto = $produto['nomeProduto'];
            $qtdeEstoque = $produto['qtdeEstoque'];
            $url = $produto['url'];
            $valor = $produto['valor'];
        }
        if ($_GET['acao'] == 'excluir') {
            excluirProduto($id);
            header("location: cadastroProdutos.php");
        }
    }

    
    if(!empty($_FILES['image']['name'])) {
        $caminho_arquivo = "C:\\xampp\\htdocs\\Ecommerce-PHP\\img\\";

        $extensaoArquivo = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $nome_arquivo = uniqid().".".$extensaoArquivo;

        move_uploaded_file($_FILES['image']['tmp_name'],$caminho_arquivo.$nome_arquivo);

        $url = 'img/'.$nome_arquivo;
    }


    if(!empty($_POST)){

        if(empty($url)){
            $produto = buscarProduto($_POST['id']);
            if (!empty($produto['url'])){
                $_POST['url'] = $produto['url'];
            } else{
                $_POST['url'] = 'img/sistema/naodisponivel.jpg';
            }
        } else{
            $_POST['url'] = $url;
        }

        if (!empty($_POST['id'])){           
            editarProduto($_POST);
        } else {
            salvarProduto($_POST);
        }
    }

    $produtos = listarProdutos();

    $_SESSION['urlAnterior'] = $_SERVER['REQUEST_URI'];

?>
<!DOCTYPE html>
<body>
    <?php    
        include_once("default/navbar.php");
    ?>

    <main role="main" class="container">
    <h2>Cadastro de Produto</h2>
        <form action="cadastroProdutos.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" id="id" name="id" value="<?=$id?>"/>
        <div class="row">
        <div class="form-group col-md-4">
                <label for="nomeProduto">Nome do Produto</label>
                <input type="text" class="form-control" maxlength="40" requered name="nomeProduto" id="nomeProduto" placeholder="Digite o nome do produto" value="<?=$nomeProduto?>">
            </div>

            <div class="form-group col-md-4">
                <label for="descricaoResumida">Descrição </label>
                <input type="text" maxlength="50" class="form-control" id="descricaoResumida" name="descricaoResumida" placeholder="Digite a Descrição" required value="<?=$descricaoResumida?>">
            </div>

  
        </div>
        <div class="row">

                <div class="form-group col-md-4">
                <label for="descricaoResumida">Descrição </label>
                <input type="text" maxlength="50" class="form-control" id="descricaoResumida" name="descricaoResumida" placeholder="Digite a Descrição" required value="<?=$descricaoResumida?>">
                </div> 
                </div> 

        <div class="row">
            <div class="form-group col-md-3">
                <label for="valor">Valor</label>
                <input type="text" class="cpf form-control" name="valor" id="valor" placeholder="Digite o valor do Produto" value="<?=$valor?>">
            </div>
            <div class="form-group col-md-3">
                <label for="qtdeEstoque">Quantidade em estoque</label>
                    <input type="number" class="sp_celphones form-control" id="qtdeEstoque" name="qtdeEstoque" placeholder="Quantidade Estoque" maxlength="15 " required value="<?=$qtdeEstoque?>">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-3">
                <label for="idCategoria">Categoria</label>
                <select class="form-control" id="idCategoria" name="idCategoria">
                    <option value="" disabled selected>Selecione uma Categoria </option>
                    <?php
                        $categorias = listarCategorias();
                        
                        if(!empty($categorias)){
                        
                            foreach ($categorias as $categoria) {
                                $selected = "";
                                if($categoria['id'] == $idCategoria){
                                    $selected = "selected";
                                }
                            ?>                                             
                                <option <?=$selected?> value="<?=$categoria['id'];?>"> <?=$categoria['nomeCategoria']?></option> 
                            <?php      
                            }
                        }
                    ?>
                </select>
            </div>

            <div class="form-group col-md-3">
                <label for="idMarca">Marca</label>
                <select class="form-control" id="idMarca" name="idMarca">
                    <option value="" disabled selected>Selecione uma Marca</option>
                    <?php
                        $marcas = listarMarcas();
                        
                        if(!empty($marcas)){
                        
                            foreach ($marcas as $marca) {
                                $selected = "";
                                if($marca['id'] == $idMarca){
                                    $selected = "selected";
                                }
                            ?>                                             
                                <option <?=$selected?> value="<?=$marca['id'];?>"> <?=$marca['nomeMarca']?></option> 
                            <?php      
                            }
                        }
                    ?>
                </select>
            </div>
        </div>



        <div class="row">
        <div class="form-group col-md-5">
                <label for="imagem">Imagem</label>
                <input type="file" class="form-control" name="image"
                id="imagem" >
            </div >
            </div>
        





        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
        <table class="table table-dark">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Produto</th>
                        <th>Valor</th>
                        <th>Quantidade em Estoque</th>
                    </tr>
                </thead>
                <?php
                    foreach($produtos as $produto){
                ?>
                    <tbody>
                        <tr>
                            <td><?=$produto['id']?></td>
                            <td><?=$produto['nomeProduto']?></td>
                            <td><?=$produto['valor']?></td>
                            <td><?=$produto['qtdeEstoqueEstoque']?></td>
                            <td>
                            <?php
                                if(!empty($produto['url'])){                                 
                            ?>
                            <img src="<?=$produto['url']?>" class="rounded-circle" width="50" height="50" />
                            <?php
                                }
                            ?>
                            </td>
                            <td>
                                <a href="cadastroProdutos.php?acao=carregar&id=<?=$produto['id']?>"
                                    class="btn btn-primary">Editar
                                </a>
                            </td>
                            <td>
                                <a href="cadastroProdutos.php?acao=excluir&id=<?=$produto['id']?>" 
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