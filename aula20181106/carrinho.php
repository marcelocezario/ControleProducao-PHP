<?php

session_start();

$cliente = $_SESSION['cliente'];

echo "Olá Sr(a). ".$cliente['nome'].", este é seu carrinho de compras";


?>