<?php
class Automatizacao{
    public function __construct(){

    }
    public function getAutomatizacaoAgendada($tag){
        require_once __DIR__ . '/../../../database/connection.php';
        $sql = "SELECT * FROM tb_automatizacao WHERE tag = '$tag' AND status = '1';";
        $resultado = select($sql);
        return $resultado;
    }
    public function setUpdateAutomatizacao($tag){
        require_once __DIR__ . '/../../../database/connection.php';
        switch($tag){
            case 'autopause':
                $sqlNovoAgendamento = "UPDATE tb_automatizacao SET agendado_para = date_add(agendado_para, interval 1 day) WHERE tag = '$tag';";
                updateGeral($sqlNovoAgendamento);
            break;
            case 'abre_chamado_email':
                $sqlNovoAgendamento = "UPDATE tb_automatizacao SET agendado_para = date_add(NOW(), interval 10 minute) WHERE tag = '$tag';";
                updateGeral($sqlNovoAgendamento);
            break;
        }
    }
    
}