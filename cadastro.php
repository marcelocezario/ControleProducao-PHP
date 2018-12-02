<!DOCTYPE html>
<html lang="pt">

<header>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Ecommerce</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/sticky-footer-navbar.css" rel="stylesheet">
        <!-- Font Icon -->
        <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

        <!-- Main css -->
        <link rel="stylesheet" href="css/style.css">

    </head>
    <?php
        session_start();
    ?>
</header>
         
<?php    
date_default_timezone_set('America/Sao_Paulo');
require_once "funcoes/funcaoCliente.php";

$id = "";
$nome = "";
$dtNascimento = "";
$cpf = "";
$telefone = "";
$cep = "";
$rua = "";
$numero = "";
$bairro = "";
$id_estado = "";
$email = "";
$senha = "";
$acesso = "";

if(!empty($_POST)) {
    salvarCliente($_POST);
    header("location: login.php");
}
?>
<body>
    <div class="main">
        <div class="container">
            <div class="signup-content">
                <div class="signup-img">
                    <img src="images/signup-img.jpg" alt="">
                </div>
                <div class="signup-form">
                    <form method="POST" class="register-form" id="register-form" action="cadastro.php" >
                        <h2>Bem Vindo. Cadastre-se hoje mesmo</h2>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="nome">Nome</label>
                                <input type="text"  id="nome" name="nome" maxlength="80" placeholder="Nome Completo" required value="<?=$nome?>">
                            </div>
                            <div class="form-group">
                                <label for="dtNascimento">Data de Nascimento</label>
		                    	<input type="date" max="<?=date('Y-m-d')?>" id="dtNascimento" name="dtNascimento" required value="<?=$dtNascimento?>">
		                    </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="cpf">CPF</label>
                                <input type="text" class="cpf" name="cpf" id="cpf" placeholder="CPF" value="<?=$cpf?>">
                            </div>
                            <div class="form-group">
                                <label for="telefone">Telefone</label>
                	    		<input type="telefone" class="sp_celphones" id="telefone" name="telefone" placeholder="Telefone" maxlength="15 " minlength="14" required value="<?=$telefone?>">  </div>
                            </div>
                            
                        <hr />
                        <h3>Endereço</h3>
                            <div class="form-row">
                            <div class="form-group">
                                <label for="cep">
                                    CEP</label>
			                    <input type="text" class="cep" id="cep" requered name="cep" placeholder="CEP" maxlength="10" value="<?=$cep?>">
                            </div>
                            <div class="form-group">
                               <label for="rua">Rua</label>
                                <input type="text" id="rua" requered name="rua" placeholder="Rua" maxlength="80" value="<?=$rua?>">
                            </div>
                            </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="numero">Número</label>
			                    <input type="text" id="numero" name="numero" placeholder="Número" maxlength="10" value="<?=$numero?>">
                            </div>
                            <div class="form-group">                         
                                <label for="Bairro/Distrido">Bairro/Distrido</label>
                                <input type="text" id="bairro" name="bairro" maxlength="80" placeholder="Bairro/Distrido"  value="<?=$bairro?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="course">Estado</label>
                            <div class="form-select">
                            <select id="id_estado" name="id_estado">
                                <option value="" disabled selected>Selecione um estado </option>
                                <?php
                                    $resultado = listarEstados(); 
                                    if(!empty($resultado)){
                                    foreach ($resultado as $res) {
                                        $selected = "";
                                        if($res['id'] == $id_estado){
                                            $selected = "selected";
                                        }
                                        ?>                                             
                                            <option <?=$selected ?> value="<?=$res['id'];?>"><?=$res['descricao']." - ".$res['sigla'];?></option> 
                                        <?php      
                                        }
                                    }
                                ?>
                                 </select>  	  	
                                <span class="select-icon"><i class="zmdi zmdi-chevron-down"></i></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Digite o e-mail" required value="<?=$email?>">
                            <div id='resposta'></div>
                        </div>
                        <div class="form-group">
                            <label for="senha">Senha</label>
                            <input type="password" class="form-control" id="senha" name="senha" placeholder="Digite a senha" required value="<?=$senha?>">
                        </div>
                        <div class="form-submit">
                            <button type="submit" class="btn btn-primary">Cadastrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <!-- JS -->
    <?php    
    include_once("default/footer.php");
?>
 <script type="text/javascript" src="js/main.js"></script>
<script type="text/javascript">
	/* Máscaras ER */
	function mascara(o,f){
		v_obj=o
		v_fun=f
		setTimeout("execmascara()",0)
	}
	function execmascara(){
		v_obj.value=v_fun(v_obj.value)
	}
	function mtel(v){
		v=v.replace(/\D/g,"");
		v=v.replace(/^(\d{2})(\d)/g,"($1) $2");
		v=v.replace(/(\d)(\d{4})$/,"$1-$2");
		return v;
	}
	function id( el ){
		return document.getElementById( el );
	}
	window.onload = function(){
		id('telefone').onkeyup = function(){
			mascara( this, mtel );
		}
    }
    var email = $("#email"); 
    email.blur(function() { 
        $.ajax({ 
            url: 'funcoes/verificaEmail.php', 
            type: 'POST', 
            data:{"email" : email.val()}, 
            success: function(data) { 
            console.log(data); 
            data = $.parseJSON(data); 
            $("#resposta").text(data.email);
        } 
    }); 
    }); 
	$('#cpf').mask('000.000.000-00');
    $('#cep').mask('00000-000');
</script>   
</html>