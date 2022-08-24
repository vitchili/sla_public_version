<?php 
    //header('Content-Type: application/json');
    header("Access-Control-Allow-Origin: *");
	$modulo = $_REQUEST['modulo'];
	$tela = $_REQUEST['tela'];
	$prioridade = $_REQUEST['prioridade'];
	include __DIR__ . '/../Controllers/SlaController.php';
    $getPesos = new SlaController;
    $pesoPrioridade = $getPesos->getPesoPrioridadesSLA($prioridade);
    $pesoTela = $getPesos->getPesoTelaSLA($tela);
    $pesoModulo = $getPesos->getPesoModuloSLA($modulo);
    
    $mediaPesos = (intval($pesoPrioridade[0]['peso']) + intval($pesoTela[0]['peso']) + intval($pesoModulo[0]['peso'])) / 3;
    
	echo(json_encode($mediaPesos, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
?>