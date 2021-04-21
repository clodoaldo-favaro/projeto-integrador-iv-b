<?php

define('DB_HOST', 'localhost');
define('DB_NAME', 'p_int');
define('DB_USER', 'root');
define('DB_PASS', '');

//Habilita as mensagens de error_get_last
ini_set('display errors', true);
error_reporting(E_ALL);

// conexão com o BD
function conecta_bd(){
	$PDO = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);	    
	return $PDO;
}

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
    //DEBUGGER    
    //$nomeCidade = 'Portão';
    //$dataConsulta = '2021/01/10';
    $nomeCidade = $_POST['nomeCidade'];
    $dataConsulta = $_POST['dataConsulta'];    
       
    $PDO = conecta_bd();
    $sql = "SELECT casos, recuperados, mortos, bandeiraAtual 
            FROM casos as a 
            WHERE a.idCidade in (SELECT id 
                                FROM cidades 
                                WHERE nome = :nomeCidade)
            and a.data= :dataConsulta";

    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':nomeCidade', $nomeCidade);
    $stmt->bindParam(':dataConsulta', $dataConsulta);
    $stmt->execute();

    //Exibe os registros secelionados pela query
    $registro = $stmt->fetch();
    $jsonRetorno = [
        'nomeCidade' => $nomeCidade,
        'dataConsulta' => $dataConsulta,
        'casosConfirmados' => (int)$registro["casos"],
        'qtdeRecuperados' => (int)$registro["recuperados"],
        'qtdeObitos' => (int)$registro["mortos"],
        'bandeira' => $registro["bandeiraAtual"]
    ];
        
    header('Content-Type: application/json');
    echo json_encode($jsonRetorno);
    exit;
}

function consultaDezMais() {       
   //DEBUGGER    
   //$dataConsulta = '2021/01/10';
   $dataConsulta = $_POST['dataConsulta'];
      
   $PDO = conecta_bd();
   $sql = "SELECT DISTINCT(casos) casos, recuperados, mortos, bandeiraAtual, 
	            (SELECT c.nome 
                  FROM cidades c 
                  WHERE c.id = a.idCidade) cidade
            FROM casos a
            WHERE data=:dataConsulta 
            ORDER BY a.casos DESC
            LIMIT 10";

    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':dataConsulta', $dataConsulta);
    $stmt->execute();
    $cidades=array();

    while ($resultado = $stmt->fetch (PDO::FETCH_ASSOC)):
        $cidades []= 
            [
            'nome' => $resultado['cidade'], 
            'casos' => (int)$resultado['casos'], 
            'recuperados' => (int)$resultado['recuperados'], 
            'mortos' => (int)$resultado['mortos'], 
            'bandeiraAtual' => $resultado['bandeiraAtual']
            ];
    endwhile; 

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