<?php
session_start();
if (empty($_SESSION['insumos'])){
    $_SESSION['insumos'] = [];
}
function salvarInsumo($post){

    if(!empty($post)){
        array_push($_SESSION['insumos'],$post);
    }
}

function listarInsumos(){
    $_SESSION['insumos'];
}
?>