<?php

$id_chamado = $_POST['id_chamado']; 
$cliente = $_POST['cliente'];
$solicitante = $_POST['solicitante'];
$produto = $_POST['produto'];
$modulo = $_POST['modulo'];
$tela = $_POST['tela'];
//$direcionamento = $_POST['direcionamento'];
$prioridade = $_POST['prioridade'];
$data_entrega = $_POST['data_entrega'];
$titulo = addslashes($_POST['titulo']);
$descricao = addslashes($_POST['descricao']);
$prazo = calculaPrazo(0);
require_once __DIR__ . '/../../Models/queries/SetNovoBug.php';
$updateBug = new SetNovoBug;
if(!isset($total_horas) || empty($total_horas)){
  $updateBug->updateBug($id_chamado,$cliente,$solicitante,$produto,$modulo,$tela,/*$direcionamento,*/$prioridade, $data_entrega, $titulo, $descricao, $prazo); // novo bug
}else{
$updateorcamento = $updateBug->updateBug(/*$id_cliente,$id_solicitante,$titulo,$descricao,$data_entrega_estimada,$total_horas,$valor_hora,$desconto,$total_preco*/); // orcamento
}

require_once __DIR__ . '/SlaController.php';
$chamadoObj = new SlaController;
$dadosChamado = $chamadoObj->getDadosChamadoPorId($_POST['id_chamado']);
if($dadosChamado['id_prioridade'] != $_POST['prioridade']){
    $arrayPost = array(
      "idChamado" => $_POST['id_chamado'],
      "mensagem" => "Seu chamado foi alterado para a prioridade " . $dadosChamado[0]['prioridade'] . ".",
      "insert_mensagem_externa_chamado" => "insert_mensagem_externa_chamado"
    );
    
    define('ENDPOINT_BASE', 'http://sla.aquicob.com.br/suporte-aquicob/app/Http/Controllers/ControllerAcoesChamado.php');
    $ch = curl_init(ENDPOINT_BASE);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($arrayPost));
    curl_setopt($ch, CURLOPT_FAILONERROR, true); // Required for HTTP error codes to be reported via our call to curl_error($ch)
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch,CURLOPT_FAILONERROR,true);
    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        echo "CURL erro" . curl_error($ch);
    }
    curl_close($ch);
}

function calculaPrazo($mediaPesos){
  $prazo = 48;
  //verificar se calcular por intervalos em if ou switch exato.
    /*switch($mediaPesos){
        case '1': $prazo = 48;
        break;
        case '2': $prazo = 72;
        break;
        case '3': $prazo = 72;
        break;
        case '4': $prazo = 120;
        break;
        case '5': $prazo = 120;
        break;
    }*/
  return $prazo;
}    