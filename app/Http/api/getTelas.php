<?php 
    //header('Content-Type: application/json');
	header("Access-Control-Allow-Origin: *");
	$_SESSION['logged'] = true;
	$modulo = $_REQUEST['modulo'];
	require_once __DIR__ . '/../../Models/queries/GetChamadosSLA.php';
	$infos = new GetChamadosSLA;
	$listaTelas = $infos->getTelaSLA($modulo);
	
	echo(json_encode($listaTelas, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
?>