<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../../Models/queries/GetChamadosSLA.php';
$infos = new GetChamadosSLA;
$arrayChamado = json_decode(file_get_contents('php://input'));

if(isset($arrayChamado->id) && !empty($arrayChamado->id)){ 
    $dados_chamado = $infos->getDadosChamadoPorId($arrayChamado->id);
    $dados_chamado = $dados_chamado[0];
    $dados_retorno = array(
        "id_chamado" => $dados_chamado['id_chamado'],
        "cliente" => $dados_chamado['cliente'],
        "descricao_chamado" => $dados_chamado['descricao_chamado'],
        "etapa_atual" => $dados_chamado['nome_etapa'],
        "produto" => $dados_chamado['produto'],
        "modulo" => $dados_chamado['modulo'],
        "tela" => $dados_chamado['tela'],
        "prioridade" => $dados_chamado['prioridade'],
        "cadastrado_em" => $dados_chamado['cadastrado_em']
    );
}else{
    $dados_retorno = "Id do chamado não encontrado";
}
echo(json_encode($dados_retorno, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
?>