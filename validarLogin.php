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

        if(!empty($_SESSION['urlAnterior'])){
            $redirecionar = $_SESSION['urlAnterior'];
            header("location: ".$_SESSION['urlAnterior']);
            unset($_SESSION['urlAnterior']);
        } else {
            header("location: index.php");

        } 
    } else {
        echo "Login ou senha inválido(s)";
    }

?>
