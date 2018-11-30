<?php
require_once "conexao.php";

function selected( $value, $selected ){
    return $value==$selected ? ' selected="selected"' : '';
}

function salvarProduto($produto)  {  
    $conn = conectar();
    $ativo = true;

    $stmt = $conn->prepare('INSERT INTO produtos (nomeProduto, descricao, url, valor, qtde, id_categoria, ativo)
        VALUES(:nomeProduto, :descricao, :url, :valor, :qtde, :id_categoria, :ativo)');
 
    $stmt->bindParam(':nomeProduto',$produto['nomeProduto']);
    $stmt->bindParam(':descricao',$produto['descricao']);
    $stmt->bindParam(':url',$produto['url']);
    $stmt->bindParam(':valor',$produto['valor']);
    $stmt->bindParam(':qtde',$produto['qtde']);
    $stmt->bindParam(':id_categoria',$produto['id_categoria']);
    $stmt->bindParam(':ativo',$ativo);
   
    if ($stmt->execute()){
        return "Produto inserido com sucesso!";
    } else {
        print_r($stmt->errorInfo());
        return "erro! ";
    }
}

function listarProdutos() {
    $conn = conectar();

    $stmt = $conn->prepare("SELECT id, nomeProduto, descricao, url, valor, qtde, id_categoria from produtos order by nomeProduto");
    $stmt->execute();
    $retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $retorno;
}

function listarProdutosPorCategoria($idCategoria) {
    $conn = conectar();

    $stmt = $conn->prepare("SELECT id, nomeProduto, descricao, url, valor, qtde, id_categoria from produtos where id_categoria = :idCategoria order by nomeProduto");
    $stmt->bindParam(':idCategoria',$idCategoria);
    $stmt->execute();
    $retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $retorno;
}

function buscarProduto($id) {
    $conn = conectar();

    $stmt = $conn->prepare("select id, nomeProduto, descricao, url, valor, qtde, id_categoria from produtos where id = :id");
    $stmt->bindParam(':id',$id);

    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function editarProduto($produto){
    $conn = conectar();

    $stmt = $conn->prepare('UPDATE produtos set nomeProduto = :nomeProduto, descricao = :descricao, url = :url, valor = :valor, qtde = :qtde, id_categoria = :id_categoria where id = :id');
    $stmt->bindParam(':id',$produto['id']);

    $stmt->bindParam(':nomeProduto',$produto['nomeProduto']);
    $stmt->bindParam(':descricao',$produto['descricao']);
    $stmt->bindParam(':url',$produto['url']);
    $stmt->bindParam(':valor',$produto['valor']);
    $stmt->bindParam(':qtde',$produto['qtde']);
    $stmt->bindParam(':id_categoria',$produto['id_categoria']);

    if ($stmt->execute()){
        return "Produto alterado com sucesso!";
    } else {
        print_r($stmt->errorInfo());
        return "erro! ";
    }
}

function excluirProduto($id) {
    $conn = conectar();
    $ativo = false;
    $stmt = $conn->prepare('DELETE from produtos where id = :id');
    $stmt->bindParam(':id',$id);

    if ($stmt->execute()){
        return "Produto excluído com sucesso!";
    } else {
        print_r($stmt->errorInfo());
        return "erro! ";
    }
}

/*************************** Categorias ***********************************/

function salvarCategoria($categoria)  {  
    $conn = conectar();

    $stmt = $conn->prepare('INSERT INTO categoria (nomeCategoria, descricao)
                            VALUES (:nomeCategoria, :descricao)');

    $stmt->bindParam(':nomeCategoria',$categoria['nomeCategoria']);
    $stmt->bindParam(':descricao',$categoria['descricao']);
   
    if ($stmt->execute()){
        return "Categoria adicionado com sucesso!";
    } else {
        print_r($stmt->errorInfo());
        return "erro! ";
    }
}

function listarCategorias() {
    $conn = conectar();

    $stmt = $conn->prepare("select id, nomeCategoria, descricao from categoria order by nomeCategoria");
    $stmt->execute();
    $retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $retorno;
}

function buscarCategoria($id) {
    $conn = conectar();

    $stmt = $conn->prepare("select id, nomeCategoria, descricao from categoria where id = :id");
    $stmt->bindParam(':id',$id);

    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function editarCategoria($categoria){
    $conn = conectar();

    $stmt = $conn->prepare('update categoria set nomeCategoria = :nomeCategoria, descricao = :descricao where id = :id');
    $stmt->bindParam(':id',$categoria['id']);
    $stmt->bindParam(':nomeCategoria',$categoria['nomeCategoria']);
    $stmt->bindParam(':descricao',$categoria['descricao']);

    if ($stmt->execute()){
        return "Categoria alterado com sucesso!";
    } else {
        print_r($stmt->errorInfo());
        return "erro! ";
    }
}

function excluirCategoria($id) {
    $conn = conectar();

    $stmt = $conn->prepare('delete from categoria where id = :id');
    $stmt->bindParam(':id',$id);
    if ($stmt->execute()){
        return "Categoria excluída com sucesso!";
    } else {
        print_r($stmt->errorInfo());
        return "erro! ";
    }
}



/********************* Marca  *********************/
function salvarMarca($marca)  {  
    $conn = conectar();

    $stmt = $conn->prepare('INSERT INTO marcas (nomeMarca, fornecedor)
                            VALUES (:nomeMarca, :fornecedor)');

    $stmt->bindParam(':nomeMarca',$marca['nomeMarca']);
    $stmt->bindParam(':fornecedor',$marca['fornecedor']);
   
    if ($stmt->execute()){
        return "Marca adicionada com sucesso!";
    } else {
        print_r($stmt->errorInfo());
        return "erro! ";
    }
}

function listarMarcas() {
    $conn = conectar();

    $stmt = $conn->prepare("select id, nomeMarca, fornecedor from marcas order by nomeMarca");
    $stmt->execute();
    $retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $retorno;
}

function buscarMarca($id) {
    $conn = conectar();

    $stmt = $conn->prepare("select id, nomeMarca, fornecedor from marcas where id = :id");
    $stmt->bindParam(':id',$id);

    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function editarMarca($marca){
    $conn = conectar();

    $stmt = $conn->prepare('update marcas set nomeMarca = :nomeMarca, fornecedor = :fornecedor where id = :id');
    $stmt->bindParam(':id',$marca['id']);
    $stmt->bindParam(':nomeMarca',$marca['nomeMarca']);
    $stmt->bindParam(':fornecedor',$marca['fornecedor']);

    if ($stmt->execute()){
        return "Marca alterada com sucesso!";
    } else {
        print_r($stmt->errorInfo());
        return "erro! ";
    }
}

function excluirMarca($id) {
    $conn = conectar();

    $stmt = $conn->prepare('delete from marcas where id = :id');
    $stmt->bindParam(':id',$id);
    if ($stmt->execute()){
        return "Marca excluída com sucesso!";
    } else {
        print_r($stmt->errorInfo());
        return "erro! ";
    }
}

?>