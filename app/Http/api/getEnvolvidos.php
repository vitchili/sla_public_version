<?php 
    //header('Content-Type: application/json');
	$cliente = $_REQUEST['cliente'];
	require_once __DIR__ . '/../../Models/queries/GetChamadosSLA.php';
	$infos = new GetChamadosSLA;
	$listaCliente = $infos->getEmailsEnvolvidosSLA($cliente);
	
	echo(json_encode($listaCliente, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
?>