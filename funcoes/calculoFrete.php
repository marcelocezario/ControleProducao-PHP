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
/*			echo $linhas->Codigo.'</br>';
			echo $linhas->Valor .'</br>';
            echo $linhas->PrazoEntrega.' Dias </br>';
*/          
                        
		}else {
			echo $linhas->MsgErro;
		}
        echo '<hr>';
    }

    $retorno = xmlToArray ($linhas, array());
    
    $frete = $retorno['cServico'];

    $frete['Valor'] = (float)$frete['Valor'];
    $frete['PrazoEntrega'] = (float)$frete['PrazoEntrega'];
    return $frete;
}


function xmlToArray($xml, $options = array()) {
    $defaults = array(
        'namespaceSeparator' => ':', // você pode querer que isso seja algo diferente de um cólon
        'attributePrefix' => '@',    // para distinguir entre os nós e os atributos com o mesmo nome
        'alwaysArray' => array(),    // array de tags que devem sempre ser array
        'autoArray' => true,         // só criar arrays para as tags que aparecem mais de uma vez
        'textContent' => '$',        // chave utilizada para o conteúdo do texto de elementos
        'autoText' => true,          // pular chave "textContent" se o nó não tem atributos ou nós filho
        'keySearch' => false,        // pesquisa opcional e substituir na tag e nomes de atributos
        'keyReplace' => false        // substituir valores por valores acima de busca
    );
    $options = array_merge($defaults, $options);
    $namespaces = $xml->getDocNamespaces();
    $namespaces[''] = null; // adiciona namespace base(vazio) 

    // Obtém os atributos de todos os namespaces
    $attributesArray = array();
    foreach ($namespaces as $prefix => $namespace) {
        foreach ($xml->attributes($namespace) as $attributeName => $attribute) {
            // Substituir caracteres no nome do atributo
            if ($options['keySearch']) $attributeName =
                    str_replace($options['keySearch'], $options['keyReplace'], $attributeName);
            $attributeKey = $options['attributePrefix']
                    . ($prefix ? $prefix . $options['namespaceSeparator'] : '')
                    . $attributeName;
            $attributesArray[$attributeKey] = (string)$attribute;
        }
    }

    // Obtém nós filhos de todos os namespaces
    $tagsArray = array();
    foreach ($namespaces as $prefix => $namespace) {
        foreach ($xml->children($namespace) as $childXml) {
            // Recursividade em nós filho
            $childArray = xmlToArray($childXml, $options);
            list($childTagName, $childProperties) = each($childArray);

            // Substituir caracteres no nome da tag
            if ($options['keySearch']) $childTagName =
                    str_replace($options['keySearch'], $options['keyReplace'], $childTagName);
            // Adiciona um prefixo namespace, se houver
            if ($prefix) $childTagName = $prefix . $options['namespaceSeparator'] . $childTagName;

            if (!isset($tagsArray[$childTagName])) {
                // Só entra com esta chave
                // Testa se as tags deste tipo deve ser sempre matrizes, não importa a contagem de elementos
                $tagsArray[$childTagName] =
                        in_array($childTagName, $options['alwaysArray']) || !$options['autoArray']
                        ? array($childProperties) : $childProperties;
            } elseif (
                is_array($tagsArray[$childTagName]) && array_keys($tagsArray[$childTagName])
                === range(0, count($tagsArray[$childTagName]) - 1)
            ) {
                $tagsArray[$childTagName][] = $childProperties;
            } else {
                $tagsArray[$childTagName] = array($tagsArray[$childTagName], $childProperties);
            }
        }
    }

    // Obtém o texto do nó
    $textContentArray = array();
    $plainText = trim((string)$xml);
    if ($plainText !== '') $textContentArray[$options['textContent']] = $plainText;

    $propertiesArray = !$options['autoText'] || $attributesArray || $tagsArray || ($plainText === '')
            ? array_merge($attributesArray, $tagsArray, $textContentArray) : $plainText;

    // Retorna o nó como array
    return array(
        $xml->getName() => $propertiesArray
    );
}
?>