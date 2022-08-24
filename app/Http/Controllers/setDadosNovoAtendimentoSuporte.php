<?php
require_once __DIR__ . '/SlaController.php';
session_cache_expire(180000);
session_start();
$userObj = new SlaController;
$usuario = $userObj->getIdUsuarioLogado();
$cliente = isset($_POST['cliente'])? $_POST['cliente'] : '';
$solicitante_externo = isset($_POST['solicitante_externo'])? $_POST['solicitante_externo'] : '';
$assunto = isset($_POST['assunto'])? $_POST['assunto'] : '';
$resumo = isset($_POST['descricao'])? $_POST['descricao'] : '';
$resolvido = isset($_POST['resolvido'])? $_POST['resolvido'] : '';

require_once __DIR__ . '/../../Models/queries/SetNovoAtendimentoSuporte.php';
$novo_atendimento = new SetNovoAtendimentoSuporte;
$set = $novo_atendimento->setNovoAtendimento($usuario[0]['id'], $cliente, $solicitante_externo, $assunto, $resumo, $resolvido);


header("Location: /suporte-aquicob/resources/views/controle-sla/registro_atendimentos.php");

