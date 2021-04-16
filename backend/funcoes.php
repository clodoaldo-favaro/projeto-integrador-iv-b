<?php


if (isset($_POST['action'])) {
    $funcao = $_POST['action'];
    if ($funcao === 'consultaCidade') {
        consultaCidade();
    }
    
}


function consultaCidade() {
    $nomeCidade = $_POST['nomeCidade'];
    $dataConsulta = $_POST['dataConsulta'];

    //TODO: Consultar banco de dados e substituir os dados do retorno pelo que veio do campo
    //Se ocorrerem erros, colocar dentro do jsonRetorno uma chave 'erros' com um array das mensagens de erro,
    //exemplo: 
    /*
        $jsonRetorno = [
            'erros' = [
                'Não foi possível conectar com o banco de dados',
                'Não foram encontradas informações para a cidade informada no período selecionado'
            ]
        ]
    */

    $jsonRetorno = [
        'nomeCidade' => $nomeCidade,
        'dataConsulta' => $dataConsulta,
        'casosConfirmados' => 3386,
        'qtdeRecuperados' => 3112,
        'qtdeObitos' => 109,
        'bandeira' => 'Laranja'
    ];
        
    header('Content-Type: application/json');
    echo json_encode($jsonRetorno);
    exit;
}


function quoteField($field) {
    return '"' . $field . '"';
}



?>