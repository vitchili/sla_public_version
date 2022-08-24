<?php
session_start();
require_once __DIR__ . '/../../Models/queries/Prioridades.php';

class ControllerPrioridadesChamado{
    function __construct(){
        
    }
    function criarPrioridade(){
        
    }
    function editarPrioridade(){
        
    }
    function excluirPrioridade(){
        
    }
    function visualizarPrioridade(){
        $p1 = new Prioridades;
        $prioridades = $p1->visualizarPrioridade();
        return $prioridades;
    }

}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['visualizarPrioridade'])) {
    $novoController = new ControllerPrioridadesChamado;
    $novoController->visualizarPrioridade();
}