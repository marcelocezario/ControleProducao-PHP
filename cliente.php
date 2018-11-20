
<!DOCTYPE html>
<?php    
include_once("default/header.php");
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

if (!empty($_SESSION['cliente'])) {
	$valida = $_SESSION['cliente'];
	$retorno =  buscarCliente($valida['id']);
	$_SESSION['cliente'] = $retorno;
	$cliente = $_SESSION['cliente'];

	$id = $cliente['id'];
	$nome = $cliente['nome'];
	$dtNascimento = $cliente['dtNascimento'];
	$cpf = $cliente['cep'];
	$telefone = $cliente['telefone'];
	$cep = $cliente['cep'];
	$rua = $cliente['rua'];
	$numero = $cliente['numero'];
	$bairro = $cliente['bairro'];
	$id_estado = $cliente['id_estado'];
	$email = $cliente['email'];
	$acesso = $cliente['acesso'];
}
if (!empty($_GET)) {
	$id = $_GET['id'];

	if ($_GET['acao'] == 'excluir') {
		excluirCliente($id);
	}
}
if(!empty($_POST)) {

	if (!empty($_POST['id'])){
		editarCliente($_POST);
	} else {
		salvarCliente($_POST);
	}
}
?>
<body>
<?php    
    include_once("default/navbar.php");
?>
<div id="main" class="container-fluid">
  
  <h3 class="page-header">Area de Cadastro</h3>
  <form action="carrinho.php" method="POST">
  <input type="hidden" id="id" name="id" value="<?=$id?>"/>
  	<div class="row">
		<div class="form-group col-md-4">
			<label for="nome">Nome Completo</label>
			<input type="text" class="form-control" id="nome" name="nome" maxlength="80" placeholder="Digite o nome completo" required value="<?=$nome?>">
		</div>

		<div class="form-group col-md-3">
			<label for="dtNascimento">Data de Nascimento</label>
			<input type="date" max="<?=date('Y-m-d')?>" class="form-control" id="dtNascimento" name="dtNascimento" placeholder="Digite o valor" required value="<?=$dtNascimento?>">
		</div>  
	</div>
	
	<div class="row">
		<div class="form-group col-md-3">
			<label for="cpf">CPF</label>
			<input type="text" class="cpf form-control" name="cpf" id="cpf" placeholder="Digite o cpf" value="<?=$cpf?>">
		</div>
		<div class="form-group col-md-4">
  	  		<label for="telefone">Telefone</label>
				<input type="telefone" class="sp_celphones form-control" id="telefone" name="telefone" placeholder="Digite o telefone" maxlength="15 " minlength="14" required value="<?=$telefone?>">
  	  	</div>
	</div>
	<hr />
	<h3>Endereço</h3>
	<div class="row">
		<div class="form-group col-md-4">
			<label for="cep">CEP</label>
			<input type="text" class="cep form-control" id="cep" requered name="cep" placeholder="Digite o CEP" maxlength="10" value="<?=$cep?>">
		</div>
		<div class="form-group col-md-4">
			<label for="rua">Rua</label>
			<input type="text" class="form-control" id="rua" requered name="rua" placeholder="Digite o nome da rua" maxlength="80" value="<?=$rua?>">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-2">
			<label for="numero">Número</label>
			<input type="number" class="form-control" id="numero" name="numero" placeholder="Digite o número" maxlength="10" value="<?=$numero?>">
		</div>
		<div class="form-group col-md-2">
			<label for="Bairro/Distrido">Bairro/Distrido</label>
			<input type="text" class="form-control" id="bairro" name="bairro" maxlength="80" placeholder="Digite o Bairro/Distrido"  value="<?=$bairro?>">
		</div>
		<div class="form-group col-md-3">
		<label for="id_estado">Estado:</label>
            <select class="form-control" id="id_estado" name="id_estado">
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
            </select>  	  	</div>
	</div>

	<hr />
	<h3>Login</h3>
	<div class="row">
		<div class="form-group col-md-4">
  	  		<label for="email">E-mail</label>
  	  		<input type="email" class="form-control" id="email" name="email" placeholder="Digite o e-mail" required value="<?=$email?>">
  	  	</div>
  	 
	  <div class="form-group col-md-3">
  	  	<label for="senha">Senha</label>
  	  	<input type="password" class="form-control" id="senha" name="senha" placeholder="Digite a senha" required value="<?=$senha?>">
  	  </div>
	</div>
	<hr />
	
	<button type="submit" class="btn btn-primary">Salvar</button>

 	<?php
        if($acesso == 2){
    ?>
    <table class="table table-dark">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nome do cliente</th>
                    <th>E-mail</th>
                    <th>Telefone</th>
                </tr>
            </thead>
            <?php
				$resultados = listarCliente();
                foreach($resultados as $res){
            ?>
                <tbody>
                    <tr>
                        <td><?=$res['id']?></td>
                        <td><?=$res['nome']?></td>
                        <td><?=$res['email']?></td>
                        <td><?=$res['telefone']?></td>                   
                        <td>
                            <a href="cliente.php?acao=excluir&id=<?=$res['id']?>" 
                                class="btn btn-primary"
                                onclick="return confirm('Você está certo disso?');">
                                Remover
                            </a>
                        </td>
                    </tr>
                </tbody>
            <?php  
                }
            ?>
        </table>
        <?php  
            }        
        ?>
  </form>
 </div>
<?php    
    include_once("default/footer.php");
?>
<script type="text/javascript">
	/* Máscaras ER */
	function mascara(o,f){
		v_obj=o
		v_fun=f
		setTimeout("execmascara()",1)
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
	$('#cpf').mask('000.000.000-00', {reverse: true});
	$('#cep').mask('00000-000', {reverse: true});
</script>
 </body>
</html>
