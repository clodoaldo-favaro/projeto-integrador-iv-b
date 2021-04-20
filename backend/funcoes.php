<?php



if (isset($_POST['action'])) {
    $funcao = $_POST['action'];
    if ($funcao === 'consultaCidade') {
        consultaCidade();
    } else if ($funcao === 'consultaDezMais') {
        consultaDezMais();
    } else if ($funcao === 'consultaBrasil') {
        consultaBrasil();
    } else {
        return ['erros' => ['Função \"' . $funcao .  '\" não encontrada']];
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

function consultaDezMais() {
    $dataConsulta = $_POST['dataConsulta'];
    //TODO implementar a consulta ao banco de dados
    

    $cidades = [
        [
            'nome' => 'Porto Alegre', 
            'casos' => 3200, 
            'recuperados' => 2950, 
            'mortos' => 100, 
            'bandeiraAtual' => 'Preta'

        ],
        [
            'nome' => 'Caxias do Sul', 
            'casos' => 2400, 
            'recuperados' => 2370, 
            'mortos' => 30, 
            'bandeiraAtual' => 'Preta'

        ],
        [
            'nome' => 'Bento Gonçalves', 
            'casos' => 1000, 
            'recuperados' => 990, 
            'mortos' => 10, 
            'bandeiraAtual' => 'Preta'

        ], 
        [
            'nome' => 'Garibaldi', 
            'casos' => 500, 
            'recuperados' => 498, 
            'mortos' => 2, 
            'bandeiraAtual' => 'Vermelha'

        ]
    ];

    header('Content-Type: application/json');
    echo json_encode($cidades);
    exit;
}

function consultaBrasil() {
    //TODO implementar a consulta ao banco de dados
    
    $res = [
        'casos' => 13900000,
        'recuperados' => 12300000,
        'mortos' => 373000
    ];
    
    header('Content-Type: application/json');
    echo json_encode($res);
    exit;
}





?>