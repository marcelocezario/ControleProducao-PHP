<?php 
session_start();
if($_GET['acao'] == 'sair'){
    session_destroy();
    header("location: login.php");
}


?>