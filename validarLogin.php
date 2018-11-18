<?php
    require_once "funcoes.php";

    session_start();

    $login = $_POST['login'];
    $senha = $_POST['senha'];

    $retorno = validarLogin($login,$senha);

    if (!empty($retorno)){
        $id = $retorno['id'];

        $cliente = buscarCliente($id);
        $_SESSION['cliente'] = $cliente;

        header("location: carrinho.php");
    } else {
        echo "Login ou senha inválido(s)";
    }

?>
