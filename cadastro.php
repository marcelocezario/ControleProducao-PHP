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

        <!-- Main css -->
        <link rel="stylesheet" href="css/bootstrap.css">

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
$apelido = "";
$dtNascimento = "";
$cpf = "";
$telefone = "";
$cep = "";
$logradouro = "";
$numero = "";
$complemento = "";
$bairro = "";
$cidade = "";
$id_uf = "";
$email = "";
$senha = "";

if(!empty($_POST)) {

    $retorno = validarEmail($_POST['email']);

    if($retorno){
        $nome = $_POST['nome'];
        $dtNascimento = $_POST['dtNascimento'];
        $cpf = $_POST['cpf'];
        $telefone = $_POST['telefone'];
        $cep = $_POST['cep'];
        $id_uf = $_POST['id_uf'];
        $email = $_POST['email'];
    }else{
        salvarCliente($_POST);
        header("location: login.php");
    }
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
                            <div class="form-group">
                                <label for="nome">Nome</label>
                                <input type="text"  id="nome" name="nome" maxlength="80" placeholder="Nome Completo" required value="<?=$nome?>">
                            </div>
                            <div class="form-group">
                                <label for="apelido">Como gostaria de ser chamado?</label>
		                    	<input type="text" id="apelido" name="apelido" placeholder="Apelido" required value="<?=$apelido?>">
		                    </div>
                            <div class="form-row">

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
                                </div>
                            <div class="form-group">
                               <label for="logradouro">Logradouro</label>
                                <input type="text" id="logradouro" requered name="logradouro" placeholder="Logradouro" maxlength="80" value="<?=$logradouro?>">
                            </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="numero">Número</label>
			                    <input type="text" id="numero" name="numero" placeholder="Número" maxlength="10" value="<?=$numero?>">
                            </div>
                            <div class="form-group">
                                <label for="Complemento">Complemento</label>
                                <input type="text" id="complemento" name="complemento" maxlength="80" placeholder="Complemento"  value="<?=$complemento?>">
                            </div>
                        </div>
                        <div class="form-group">
                                <label for="Bairro">Bairro</label>
                                <input type="text" id="bairro" name="bairro" maxlength="80" placeholder="Bairro"  value="<?=$bairro?>">
                            </div>
                            <div class="form-row">

                            <div class="form-group">
                                <label for="Cidade">Cidade</label>
                                <input type="text" id="cidade" name="cidade" maxlength="80" placeholder="Cidade"  value="<?=$cidade?>">
                            </div>
                        <div class="form-group">
                            <label for="course">Estado</label>
                            <div class="form-select">
                            <input type="hidden" name="ufRetorno" id="ufRetorno" value="">
                            <select id="id_uf" name="id_uf">
                                <option value="" disabled selected>Uf</option>
                                <?php
                                    $estados = listarEstados(); 
                                    if(!empty($estados)){
                                    foreach ($estados as $estado) {
                                        $selected = "";
                                        if($estado['id'] == $id_uf){
                                            $selected = "selected";
                                        }
                                        ?>                                             
                                            <option <?=$selected ?> value="<?=$estado['id'];?>"><?=$estado['sigla']?></option> 
                                        <?php      
                                        }
                                    }
                                ?>
                                 </select>  	  	
                                <span class="select-icon"><i class="zmdi zmdi-chevron-down"></i></span>
                            </div>
                                </div>
                        </div>
                        <div class="form-group">
                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
                            <label for="email">E-mail</label>
                            <input type="email" class="email" id="email" name="email" placeholder="Digite o e-mail" required value="<?=$email?>">
                            <div id='resposta'></div>
                            <script language="javascript">
                                var email = $("#email"); 
                                        email.blur(function() { 
                                            $.ajax({ 
                                                url: 'verificaEmail.php', 
                                                type: 'POST', 
                                                data:{"email" : email.val()}, 
                                                success: function(data) { 
                                                console.log(data); 
                                                data = $.parseJSON(data); 
                                                $("#resposta").text(data.email);
                                            } 
                                        }); 
                                    }); 
                                </script>
                        </div>
                        <div class="form-group">
                            <label for="senha">Senha</label>
                            <input type="password" id="senha" name="senha" placeholder="Digite a senha" required value="<?=$senha?>">
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
    var email = $('#email'); 
    email.blur(function() { 
        $.ajax({ 
            url: 'verificarEmail.php', 
            type: 'POST', 
            data:{'email' : email.val()}, 
            success: function(data) { 
                console.log(data); 
                data = $.parseJSON(data); 
                $('#resposta').text(data.email);
            } 
        }); 
    }); 
	$('#cpf').mask('000.000.000-00');
    $('#cep').mask('00000-000');
</script>

    <!-- Adicionando JQuery -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
            crossorigin="anonymous"></script>

    <!-- Adicionando Javascript -->
    <script type="text/javascript" >

        $(document).ready(function() {

            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#logradouro").val("");
                $("#bairro").val("");
                $("#cidade").val("");
                $("#ufRetorno").val("");
                $("#id_uf").val("1");
                $("#ibge").val("");

                jQuery('#id_uf').prop('selectedIndex',0);

            }
            
            //Quando o campo cep perde o foco.
            $("#cep").blur(function() {

                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if(validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#logradouro").val("...");
                        $("#bairro").val("...");
                        $("#cidade").val("...");
                        $("#ufRetorno").val("...");
                        $("#ibge").val("...");

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#logradouro").val(dados.logradouro);
                                $("#bairro").val(dados.bairro);
                                $("#cidade").val(dados.localidade);
                                $("#ufRetorno").val(dados.uf);
                                $("#ibge").val(dados.ibge);

                                var estado = ufRetorno.value;
                                $("#id_uf option").filter(function() {
                                    return this.text == estado; 
                                }).attr('selected', true)

                            } //end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulário_cep();
                                alert("CEP não encontrado.");
                            }
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                        alert("Formato de CEP inválido.");
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
                }
            });
        });

    </script>
    </body>
</html>