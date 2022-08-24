<?php 
    require_once __DIR__ . '/../../Models/queries/GetQtChamadosSLA.php';
	$infos = new GetQtChamadosSLA;
	$listaChamados = $infos->getQtChamadosSLA();
	echo(json_encode($listaChamados, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
?>