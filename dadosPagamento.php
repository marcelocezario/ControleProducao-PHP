<?php
require_once "funcoes/funcaoProduto.php";
require_once "funcoes/calculoFrete.php";
require_once "funcoes/funcaoMeioPagamento.php";
include_once("default/header.php");

$cupom = "";
$nrCupom = "";
$percentualDesconto = "";


if (!empty($_SESSION['cliente'])){

    $cliente = $_SESSION['cliente'];

    if (!empty($_POST)){



    }
    else {
        if(!empty($_SESSION['cupom'])){

            $cupom = $_SESSION['cupom'];
            if ($cupom == "Cupom inválido"){

            } else{
                $nrCupom = $cupom['nrCupom'];
                $percentualDesconto = $cupom['percentualDesconto'];
            }
        }
        else {
            header("location: teste.php");
        }
    }
} 
else{
    $_SESSION['urlAnterior'] = "confirmarPedido.php";
    header("location: login.php");
}

if (!empty($_POST)){
    $_SESSION['endereco'] = $_POST;

    $endereco = $_POST;
}

if (!empty($_SESSION['carrinho'])){
    $carrinho = $_SESSION['carrinho'];
} else {
    $carrinho = array();
}
    $totalCarrinho = 0;
    $totalFrete = 0;
    $prazoEntrega = 0;
    $desconto = 0;

    $idTemp = 0;

    foreach($carrinho as $item){
        $totalCarrinho += $item['valorTotal'];
    }

    if (!empty($_POST['cep'])){
        $cepOrigem = 83030580;
        $cepDestino = $endereco['cep'];

        $valorDeclarado = $totalCarrinho;

        if ($valorDeclarado < 50){
            $valorDeclarado = 50;
        } elseif ($valorDeclarado > 10000){
            $valorDeclarado = 10000;
        }

        $frete = consultaFrete($cepOrigem, $cepDestino, $valorDeclarado);
        
        if($totalCarrinho > 10000){
            $totalFrete = round($frete['Valor'] * ($totalCarrinho / $valorDeclarado));
        } else {
            $totalFrete = $frete['Valor'];
        }
        
        if($prazoEntrega < $frete['PrazoEntrega']){
            $prazoEntrega = $frete['PrazoEntrega'];
        }

        $_SESSION['frete'] = $totalFrete;
    } else{
        $totalFrete = $_SESSION['frete'];
    }


    if (!empty($_SESSION['cupom'])){
        if($_SESSION['cupom'] == "Cupom inválido"){
            $desconto = 0;

        } else{
            $desconto = $totalCarrinho * ($_SESSION['cupom']['percentualDesconto'] / 100);
        }
    }

    $totalPedido = $totalCarrinho + $totalFrete - $desconto;

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
  <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
</div>


    <h1 class="display-4">Você está quase lá</h1>
    <p class="lead">Os produtos já são quase seus <?=$_SESSION['cliente']['apelido']?>, falta só um poquinho, confira os dados do seu pedido:</p>


<div class="row">
    <div class="col-5">
    <div class="form-group">

            <form action="validarCupom.php" method="POST">
                <div>
                    <label for="cupomDesconto">Cupom desconto</label>
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="cupomDesconto" name="cupomDesconto" required placeholder="Digite o cupom de desconto" value="<?=$nrCupom?>">
                    
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-outline-secondary" type="button" id="validarCupom">Validar Cupom</button>
                    </div>
                </div>
            </div>
            </form>



                <div class="form-row">
                <div class="form-group">

            <label for="idMarca">Meio de pagamento</label>
                <select class="form-control" id="idMeioPagamento" name="idMeioPagamento">
                    <option value="" disabled selected>Selecione um meio de pagamento</option>
                    <?php
                        $meiosPagamento = listarMeiosPagamento();
                        
                        if(!empty($meiosPagamento)){
                        
                            foreach ($meiosPagamento as $meiosPagamento) {
                                $selected = "";
                                if($marca['id'] == $idMeioPagamento){
                                    $selected = "selected";
                                }
                            ?>                                             
                                <option <?=$selected?> value="<?=$meiosPagamento['id'];?>"> <?=$meiosPagamento['formaPagamento']?></option> 
                            <?php      
                            }
                        }
                    ?>
                </select>
                </div>

                <div class="form-row">

                            <div class="form-group">

                <ul class="list-group">
                    <li class="list-group-item">Total de produtos: R$ <?=number_format($totalCarrinho,2,",",".")?></li>
                    <li class="list-group-item">Desconto Cupom: R$ <?=number_format($desconto,2,",",".")?></li>
                    <li class="list-group-item">Valor do Frete: R$ <?=number_format($totalFrete,2,",",".")?></li>
                    <li class="list-group-item active">TOTAL DO PEDIDO: R$ <?=number_format($totalPedido,2,",",".")?></li>

                </ul>

                </div>
</div>
                        
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