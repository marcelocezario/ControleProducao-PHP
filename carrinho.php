<?php
include_once("default/header.php");
session_start();


$cliente = $_SESSION['cliente'];
print_r($cliente);
echo "Olá Sr(a). ".$cliente['nome'].", este é seu carrinho de compras";

include_once("default/navbar.php");

?>