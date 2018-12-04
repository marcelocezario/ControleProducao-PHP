<?php
require_once "funcoes/funcaoProduto.php";
require_once "funcoes/calculoFrete.php";
include_once("default/header.php");

if (!empty($_SESSION['cliente'])){
    $cliente = $_SESSION['cliente'];
    if(empty($_SESSION['carrinho'])){
        header("location: carrinho.php");
    }
} else {
    $_SESSION['urlAnterior'] = "confirmarPedido.php";
    header("location: login.php");
}


$cep = "";

if (!empty($_POST['cep'])){
    $cep = $_POST['cep'];
}

if (!empty($_SESSION['carrinho'])){
    $carrinho = $_SESSION['carrinho'];
} else {
    $carrinho = array();
}
   
    $_SESSION['urlAnterior'] = $_SERVER['REQUEST_URI'];
?>

<?php 
    require_once "funcoes/funcaoProduto.php";
    include_once("default/header.php");
?>

<!DOCTYPE html>
<html lang="en">


<body>
        <?php    
            include_once("default/navbar.php");

        ?>
        <div>
<br/>
<br/>


    <main role="main" class="container">
    <div class="progress">
  <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
</div>


    <h1 class="display-4">Você está quase lá</h1>
    <p class="lead">Os produtos já são quase seus <?=$_SESSION['cliente']['apelido']?>, falta só um poquinho, confira os dados do seu pedido:</p>


<div class="row">
    <div class="col-5">
            <form action="dadosPagamento.php" method="POST">

            <div class="form-group">
                <div>
                    <label for="cep">Cep</label>
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="cep" name="cep" required placeholder="Digite o cep" value="<?=$cep?>">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="consultaCep">Consultar</button>
                    </div>
                </div>
            </div>
            
            <h3>Endereço</h3>
                            <div class="form-group">
                               <label for="logradouro">Logradouro</label>
                                <input class="form-control" type="text" id="logradouro" required name="logradouro" placeholder="Logradouro" maxlength="80">
                            </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="numero">Número</label>
			                    <input class="form-control" type="text" id="numero" required name="numero" placeholder="Número" maxlength="10">
                            </div>
                            <div class="form-group">
                                <label for="Complemento">Complemento</label>
                                <input class="form-control" type="text" id="complemento" required name="complemento" maxlength="80" placeholder="Complemento">
                            </div>
                        </div>
                        <div class="form-group">
                                <label for="Bairro">Bairro</label>
                                <input class="form-control" type="text" id="bairro" required name="bairro" maxlength="80" placeholder="Bairro">
                            </div>
                            <div class="form-row">

                            <div class="form-group">
                                <label for="Cidade">Cidade</label>
                                <input class="form-control" type="text" id="cidade" required name="cidade" maxlength="80" placeholder="Cidade">
                            </div>
                        <div class="form-group">
                            <label for="course">Estado</label>
                            <input class="form-control" type="text" id="uf" name="uf" required maxlength="2" placeholder="Uf">
                                </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Informar dados de pagamento</button>

                        
                    </form>
                </div>
            </div>
        </div>

    </div>

 <script type="text/javascript" src="js/main.js"></script>

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
                $("#uf").val("");
                $("#ibge").val("");

                jQuery('#id_uf').prop('selectedIndex',0);

            }

            //Quando clicar em pesquisa cep.
            $("#consultaCep").click(function() {
                //Nova variável "cep" somente com dígitos.
                var cep = $("#cep").val().replace(/\D/g, '');

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
                        $("#uf").val("...");
                        $("#ibge").val("...");

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#logradouro").val(dados.logradouro);
                                $("#bairro").val(dados.bairro);
                                $("#cidade").val(dados.localidade);
                                $("#uf").val(dados.uf);
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