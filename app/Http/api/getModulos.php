<?php
header("Access-Control-Allow-Origin: *");
require_once __DIR__ . '/../../Models/queries/GetChamadosSLA.php';
$infos = new GetChamadosSLA;
$produto = $_REQUEST['produto'];

if(isset($_REQUEST['modulo'])){
	$modulo = $_REQUEST['modulo'];
	$listaModulos = $infos->getModuloByNameSLA($produto, $modulo);
}else{
	$listaModulos = $infos->getModuloSLA($produto);
}
	echo(json_encode($listaModulos, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));

?>
