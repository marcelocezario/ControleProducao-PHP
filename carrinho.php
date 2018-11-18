<?php

session_start();


$cliente = $_SESSION['cliente'];
print_r($cliente);
echo "Olá Sr(a). ".$cliente['nome'].", este é seu carrinho de compras";


?>