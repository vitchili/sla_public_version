<?php
session_start();
require_once __DIR__ . '/../../../database/connection.php';

class Prioridades{
    
    function __construct(){
        
    }
    function criarPrioridade(){
        
    }
    function editarPrioridade(){
        
    }
    function excluirPrioridade(){
        
    }
    function visualizarPrioridade(){
        $sql = "SELECT * FROM tb_prioridade_sla WHERE status= '1';";
        $result = select($sql); 
        return $result;
    }

}