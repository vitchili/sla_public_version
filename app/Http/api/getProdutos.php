<?php
header("Access-Control-Allow-Origin: *");
require_once __DIR__ . '/../../Models/queries/GetChamadosSLA.php';
$infos = new GetChamadosSLA;
$produto = $_REQUEST['produto'];

if(isset($_REQUEST['produto'])){
	$produto = $_REQUEST['produto'];
	$listaProdutos = $infos->getProdutoByName($produto);
}else{
	$listaProdutos = $infos->getProduto();
}
	echo(json_encode($listaProdutos, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));

?>
