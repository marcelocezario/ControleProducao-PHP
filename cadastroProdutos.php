<?php 
    include_once("default/header.php");
    
    if ($_SESSION['cliente']['acesso'] != 2) {
        header("location: erro.php");
    }
    
    require_once "funcoes/funcaoProduto.php";


    $id = "";
    $nomeProduto = "";
    $descricao = ""; 
    $valor = "";
    $qtde = "";
    $id_categoria = "";
    $url = "";

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
            print_r('url: '.$produto['url']);
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
            <div class="form-group col-md-3">
                <label for="nomeProduto">Nome do Produto</label>
                <input type="text" class="form-control" maxlength="40" requered name="nomeProduto" id="nomeProduto" placeholder="Digite o nome do produto" value="<?=$nomeProduto?>">
            </div>

            <div class="form-group col-md-4">
                <label for="descricao">Descrição </label>
                <input type="text" maxlength="50" class="form-control" id="descricao" name="descricao" placeholder="Digite a Descrição" required value="<?=$descricao?>">
            </div>  
        </div>

        <div class="row">
            <div class="form-group col-md-3">
                <label for="valor">Valor</label>
                <input type="text" class="cpf form-control" name="valor" id="valor" placeholder="Digite o valor do Produto" value="<?=$valor?>">
            </div>
            <div class="form-group col-md-4">
                <label for="qtde">Quantidade</label>
                    <input type="text" class="sp_celphones form-control" id="qtde" name="qtde" placeholder="Digite a quantidade de produto" maxlength="15 " required value="<?=$qtde?>">
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <label for="imagem">Imagem</label>
                <input type="file" class="form-control" name="image"
                id="imagem" >
            </div >

            <div class="form-group col-md-3">
                <label for="id_categoria">Categoria</label>
                <select class="form-control" id="id_categoria" name="id_categoria">
                    <option value="" disabled selected>Selecione uma Categoria </option>
                    <?php
                        $categorias = listarCategorias();
                        
                        if(!empty($categorias)){
                        
                            foreach ($categorias as $categoria) {
                                $selected = "";
                                if($categoria['id'] == $id_categoria){
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
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
        <table class="table table-dark">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Produto</th>
                        <th>Descrição</th>
                        <th>Imagem</th>
                    </tr>
                </thead>
                <?php
                    foreach($produtos as $produto){
                ?>
                    <tbody>
                        <tr>
                            <td><?=$produto['id']?></td>
                            <td><?=$produto['nomeProduto']?></td>
                            <td><?=$produto['descricao']?></td>
                            <td>
                            <?php
                                if(!empty($produto['url'])){                                 
                            ?>
                            <img src="<?=$produto['url']?>" class="rounded-circle" width="50" height="50" />
                            <?php
                                }
                            ?>
                            </td>                            <td>
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
</body>
</html>