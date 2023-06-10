<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversor de moeda</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
        <h1>Conversor Real - Dólar</h1>
        <?php 
            //Dados da cotação através Banco Central
            $data_inicio=date("m-d-Y",strtotime("-7 days"));
            $data_fim=date("m-d-Y");
            $url='https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoDolarPeriodo(dataInicial=@dataInicial,dataFinalCotacao=@dataFinalCotacao)?@dataInicial=\''.$data_inicio.'\'&@dataFinalCotacao=\''.$data_fim.'\'&$top=1&$orderby=dataHoraCotacao&$format=json&$select=cotacaoCompra,dataHoraCotacao';
            $conversao_arquivo=json_decode(file_get_contents($url),true);
            $cotacao=$conversao_arquivo["value"][0]["cotacaoCompra"];
            //Fim importação de dados

            $moeda_real=$_REQUEST["moeda"];
            $conversao_moeda=$moeda_real/$cotacao;
            $padrao=numfmt_create("pt-BR",NumberFormatter::CURRENCY);
            echo "<p>Seus ".numfmt_format_currency($padrao,$moeda_real,"BRL").
            " equivalem a ".numfmt_format_currency($padrao, $conversao_moeda,"USD").
            ".</p> <p><strong>Cotação fixa de R$".number_format($cotacao,2)."</strong> informada pelo Banco Central.</p>";
        
        ?>
        <button onclick="javascript:history.go(-1)">Voltar</button>
    </main>

</body>
</html>





