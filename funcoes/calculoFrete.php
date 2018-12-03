<?php

function consultaFrete($cepOrigem, $cepDestino, $valorEncomenda){
	$parametros = array();
	
	// C�digo e senha da empresa, se voc� tiver contrato com os correios, se n�o tiver deixe vazio.
	$parametros['nCdEmpresa'] = '';
	$parametros['sDsSenha'] = '';
	
	// CEP de origem e destino. Esse parametro precisa ser num�rico, sem "-" (h�fen) espa�os ou algo diferente de um n�mero.
	$parametros['sCepOrigem'] = $cepOrigem;
	$parametros['sCepDestino'] = $cepDestino;
	
	// O peso do produto dever� ser enviado em quilogramas, leve em considera��o que isso dever� incluir o peso da embalagem.
	$parametros['nVlPeso'] = '1';
	
	// O formato tem apenas duas op��es: 1 para caixa / pacote e 2 para rolo/prisma.
	$parametros['nCdFormato'] = '1';
	
	// O comprimento, altura, largura e diametro dever� ser informado em cent�metros e somente n�meros
	$parametros['nVlComprimento'] = '16';
	$parametros['nVlAltura'] = '5';
	$parametros['nVlLargura'] = '15';
	$parametros['nVlDiametro'] = '0';
	
	// Aqui voc� informa se quer que a encomenda deva ser entregue somente para uma determinada pessoa ap�s confirma��o por RG. Use "s" e "n".
	$parametros['sCdMaoPropria'] = 's';
	
	// O valor declarado serve para o caso de sua encomenda extraviar, ent�o voc� poder� recuperar o valor dela. Vale lembrar que o valor da encomenda interfere no valor do frete. Se n�o quiser declarar pode passar 0 (zero).
	$parametros['nVlValorDeclarado'] = $valorEncomenda;
	
	// Se voc� quer ser avisado sobre a entrega da encomenda. Para n�o avisar use "n", para avisar use "s".
	$parametros['sCdAvisoRecebimento'] = 'n';
	
	// Formato no qual a consulta ser� retornada, podendo ser: Popup � mostra uma janela pop-up | URL � envia os dados via post para a URL informada | XML � Retorna a resposta em XML
	$parametros['StrRetorno'] = 'xml';
	
	// C�digo do Servi�o, pode ser apenas um ou mais. Para mais de um apenas separe por virgula.
	//$parametros['nCdServico'] = '40010,41106';
    $parametros['nCdServico'] = '40010';

	
	$parametros = http_build_query($parametros);
	$url = 'http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx';
	$curl = curl_init($url.'?'.$parametros);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$dados = curl_exec($curl);
	$dados = simplexml_load_string($dados);
	
	foreach($dados->cServico as $linhas) {
		if($linhas->Erro == 0) {
			echo $linhas->Codigo.'</br>';
			echo $linhas->Valor .'</br>';
			echo $linhas->PrazoEntrega.' Dias </br>';
		}else {
			echo $linhas->MsgErro;
		}
        echo '<hr>';
    }
    
    return $linhas;
}
?>