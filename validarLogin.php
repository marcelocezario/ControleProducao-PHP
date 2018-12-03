<?php
    require_once "funcoes/funcaoCliente.php";

    session_start();

    $login = $_POST['email'];
    $senha = $_POST['senha'];

    $retorno = validarLogin($login,$senha);

    if (!empty($retorno)){
        $id = $retorno['id'];

        $cliente = buscarCliente($id);
        $_SESSION['cliente'] = $cliente;

        header("location: ".$_POST['urlAnterior']);
    } else {
        echo "Login ou senha inválido(s)";
    }

?>
