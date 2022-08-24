<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../../Models/queries/GetChamadosSLA.php';
$infos = new GetChamadosSLA;
$arrayChamado = json_decode(file_get_contents('php://input'));


if(isset($arrayChamado) && !empty($arrayChamado)){
    if(isset($arrayChamado->cliente) && !empty($arrayChamado->cliente)){ 
        $cliente = $arrayChamado->cliente;
        $cliente = $infos->getClienteByNameSLA($cliente);
        $cliente = $cliente[0]['id'];  
    }else{
        $cliente = 4;
    }
    
    $solicitante = '12';
    $titulo = isset($arrayChamado->titulo) ? $arrayChamado->titulo : 'Abertura via Robô';
    $descricao = isset($arrayChamado->descricao) ? $arrayChamado->descricao : '';

    if($descricao == ''){
        throw new Exception('Descrição obrigatória');
    }
    $data_entrega_estimada =  date('Y-m-d', strtotime("+2 days",strtotime(date('Y-m-d'))));

    if(isset($arrayChamado->produto) && !empty($arrayChamado->produto)){
        $produto = $arrayChamado->produto;
        $produto = $infos->getProdutoByName($produto);
        $produto = $produto[0]['id'];
    }else{
        $produto = '1';
    }
    
    $envolvidos = isset($arrayChamado->envolvidos) ? $arrayChamado->envolvidos : '';

    if(isset($arrayChamado->modulo) && !empty($arrayChamado->modulo)){
        $modulo = $arrayChamado->modulo;
        $modulo = $infos->getModuloByNameSLA($produto, $modulo);
        $modulo = $modulo[0]['id'];
    }else{
        $modulo = '16'; 
    }
    if(isset($arrayChamado->tela) && !empty($arrayChamado->tela)){
        $tela = $arrayChamado->tela;
        $tela = $infos->getTelaByNameSLA($modulo, $tela);
        $tela = $tela[0]['id'];
        
    }else{
        $tela = '70';
    }
    $direcionamento = isset($arrayChamado->direcionamento) ? $arrayChamado->direcionamento : 'S';
    $prioridade = '7';

    $url1 = (isset($arrayChamado->url1) && !empty($arrayChamado->url1)) ? $arrayChamado->url1 : '';
    $url2 = (isset($arrayChamado->url2) && !empty($arrayChamado->url2)) ? $arrayChamado->url2 : '';

    $cadastro_por_api = array(
        'cliente' => $cliente,
        'solicitante' => $solicitante,
        'titulo' => addslashes($titulo),
        'descricao' => addslashes($descricao),
        'data_entrega_estimada' => $data_entrega_estimada,
        'produto' => $produto,
        'envolvidos' => addslashes($envolvidos),
        'solicitante_externo' => addslashes($arrayChamado->solicitante_externo),
        'email_externo' => addslashes($arrayChamado->email_externo),
        'modulo' => $modulo,
        'tela' => $tela,
        'direcionamento' => $direcionamento,
        'prioridade' => $prioridade,
        'url1' => $url1,
        'url2' => $url2,
        'cadastro_por_api' => true
    );
    
    define('ENDPOINT_BASE', 'http://sla.aquicob.com.br/suporte-aquicob/app/Http/Controllers/setDadosNovoBugSLA.php');
    $ch = curl_init(ENDPOINT_BASE);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $cadastro_por_api);
    // curl_setopt($ch, CURLOPT_HTTPHEADER,array('Content-Type: multipart/form-data'));
    curl_setopt($ch, CURLOPT_FAILONERROR, true); // Required for HTTP error codes to be reported via our call to curl_error($ch)
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch,CURLOPT_FAILONERROR,true);
    $response = curl_exec($ch);
    $dados = [];
    if($response != '' && is_int($response)){
        $id_retorno = json_decode($response, 1);
        $chamado = $infos->getDadosChamadoPorId($id_retorno);
        $cadastro_por_api = array_merge(array( "id_chamado" => $id_chamado), $cadastro_por_api);
        $dados = array(
            "id_chamado" => $chamado[0]['id_chamado'],
            "cliente" => $chamado[0]['cliente'],
            "solicitante" => $chamado[0]['solicitante'],
            "titulo" => $chamado[0]['titulo'],
            "descricao" => $chamado[0]['descricao_chamado'],
            "produto" => $chamado[0]['produto'],
            "modulo" => $chamado[0]['modulo'],
            'url1' => $url1,
            "tela" => $chamado[0]['tela'],
            "prioridade" => $chamado[0]['prioridade']
        );
        $data = array(
            "success" => true,
            "erro" => false,
            "mensagem" => 'Chamado criado com sucesso',
            "dados" => $dados
        );
    }else{
        $data = array(
            "success" => false,
            "erro" => true,
            "mensagem" => "Erro ao abrir chamado",
            "dados" => "CURL erro" . curl_error($ch)
        );
    }
    curl_close($ch);
    
    echo(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));

}else{
    echo(json_encode('Dados do chamado não informados', JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
}




?>
