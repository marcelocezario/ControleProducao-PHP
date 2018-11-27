<?php
include_once("default/header.php");

$cliente = $_SESSION['cliente'];

include_once("default/navbar.php");

echo "Olá Sr(a). ".$cliente['nome'].", este é seu carrinho de compras";


?>