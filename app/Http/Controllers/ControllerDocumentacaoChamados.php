<?php
session_start();
require_once __DIR__ . '/../../Models/queries/SetResponsavelChamadosSLA.php';
require_once __DIR__ . '/SlaController.php';
require_once __DIR__ . '/../../Models/queries/GetChamadosSLA.php';

class ControllerDocumentacaoChamados{
    function __construct(){
        
    }
    function getNomeEmpresaByBanco($empresa){
        $obj = new GetChamadosSLA;
        $nomeEmpresa = $obj->getNomeEmpresaByBanco($empresa);
        return $nomeEmpresa;
    }
    function getChamadosAbertosPorEmpresa($empresa, $type, $idChamadoPesquisa = '', $dataInicial = '', $dataFinal = ''){
        $chamados = new GetChamadosSLA;
        $chamadosAbertos = $chamados->getChamadosAbertosPorEmpresa($empresa, $type, $idChamadoPesquisa, $dataInicial, $dataFinal);
        return $chamadosAbertos;
    }
    function getChamadosFechadosPorEmpresa($empresa, $type, $idChamadoPesquisa = '', $dataInicial = '', $dataFinal = ''){
        $chamados = new GetChamadosSLA;
        $chamadosAbertos = $chamados->getChamadosFechadosPorEmpresa($empresa, $type, $idChamadoPesquisa, $dataInicial, $dataFinal);
        return $chamadosAbertos;
    }
}