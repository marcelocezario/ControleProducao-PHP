<?php
session_start();
if (empty($_SESSION['insumos'])){
    $_SESSION['insumos'] = [];
}

function salvarInsumo($insumo){

    if (buscarInsumo($insumo['id'])){

      foreach($_SESSION['insumos']) as
        $indice => $insumoEditar){

            if ($insumo['id'] == $insumoEditar['id']){
                $_SESSION['insumos'][$indice] = $insumo;
            }
        }
    }
}

function listarInsumos(){
   return $_SESSION['insumos'];
}

function buscarInsumo($id){

    foreach ($_SESSION['insumos'] as $insumo){
        if ($insumo['id'] == $id){
            return $insumo;
        }
    }
}
?>