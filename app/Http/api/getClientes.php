<?php
header("Access-Control-Allow-Origin: *");
require_once __DIR__ . '/../../Models/queries/GetChamadosSLA.php';
$infos = new GetChamadosSLA;
if(isset($_REQUEST['cliente'])){
	$cliente = $_REQUEST['cliente'];
	$listaClientes = $infos->getClienteByNameSLA($cliente);
}else{
	$listaClientes = $infos->getCliente();
}

if(count($listaClientes) == 1){
	$json = (json_encode($listaClientes[0], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
}else if(count($listaClientes) > 1){
	$json = (json_encode($listaClientes, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
}
echo $json;
?>
