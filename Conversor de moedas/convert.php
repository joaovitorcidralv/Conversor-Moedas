<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversor de Moedas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
        <h1>Conversor de Moedas</h1>
        <p>
            <?php
            //Dinheiro informado no formulário
            $base = $_GET["moeda"] ?? 0;
            //Cotação informada pela API do Banco Central
            $inicio = date("m-d-Y", strtotime("-7 days"));
            $fim = date("m-d-Y");
            $url = 'https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoDolarPeriodo(dataInicial=@dataInicial,dataFinalCotacao=@dataFinalCotacao)?@dataInicial=\'' . $inicio . '\'&@dataFinalCotacao=\''. $fim .'\'&$top=1&$orderby=dataHoraCotacao%20desc&$format=json&$select=cotacaoCompra,dataHoraCotacao';
            $dados = json_decode(file_get_contents($url), true);
            $cv_base = $dados["value"][0]["cotacaoCompra"];
            //Conversão para Dólar
            $dolar = $base / $cv_base;
            echo "<p>Seus R\$" . number_format($base, 2, ",", ".") . " equivalem a US\$ " . number_format($dolar, 2, ",", ".") . "</p>";
            ?>
            <button onclick="javascript:history.go(-1)">Voltar</button>
        </p>
    </main>
</body>
</html>