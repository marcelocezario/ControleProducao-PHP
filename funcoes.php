<?php
session_start();
if (empty($_SESSION['insumos'])){
    $_SESSION['insumos'] = [];
}

function salvarInsumo($insumo){

    if (listarInsumos($insumo['id'])){
    
        foreach ($_SESSION['insumos'] as $indice => $alterarInsumo) {
    
            if ($insumo['id']== $alterarInsumo['id']){
    
                $_SESSION['insumos'][$indice]=$insumo;
            }
        }
    }else{                    
        if (!empty($insumo)){
    
        $cont = count ($_SESSION['insumos']);
    
        $insumo ['id'] = $cont +1;
    
        array_push ($_SESSION['insumos'],$insumo);
    
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

function excluirInsumo($id) {
    
    foreach($_SESSION['insumos'] as $indice => $insumoRemover) {

        if ($insumoRemover['id'] == $id) {
            unset($_SESSION['insumos'][$indice]);
        }

    }
}

?>