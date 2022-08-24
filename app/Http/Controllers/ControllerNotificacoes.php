<?php
session_start();
require_once __DIR__ . '/../../Models/queries/Notificacoes.php';

class ControllerNotificacoes{
    function __construct(){
        
    }
    function criarNotificacao($usuario, $mensagem){
        $n1 = new Notificacoes;
        $mensagem = addslashes($mensagem);
        $novaNotificacao = $n1->criarNotificacao($usuario, $mensagem);
    }
    function visualizarNotificacao($idNotificacao, $usuario, $checkbox){
        $n1 = new Notificacoes;
        $n1->visualizarNotificacao($idNotificacao, $usuario, $checkbox);
    }
    function getNotificacoesNaoVistas($usuario){
        $n1 = new Notificacoes;
        $notificacoes = $n1->getNotificacoesNaoVistas($usuario);
        return $notificacoes;
    }
    function getQtNotificacoesNaoVistas($usuario){
        $n1 = new Notificacoes;
        $notificacoes = $n1->getQtNotificacoesNaoVistas($usuario);
        return $notificacoes;
    }

}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['criarNotificacao'])) {
    $novoController = new ControllerNotificacoes;
    $novoController->criarNotificacao($_POST['usuario'], $_POST['mensagem']);
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['visualizaNotificacao'])) {
    $novoController = new ControllerNotificacoes;
    $novoController->visualizarNotificacao($_POST['idNotificacao'], $_POST['usuario'], $_POST['checkbox']);
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['getNotificacoesNaoVistas'])) {
    $novoController = new ControllerNotificacoes;
    $novoController->getNotificacoesNaoVistas($_POST['usuario']);
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['getQtNotificacoesNaoVistas'])) {
    $novoController = new ControllerNotificacoes;
    $novoController->getQtNotificacoesNaoVistas($_POST['usuario']);
}