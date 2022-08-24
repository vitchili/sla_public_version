<?php
class Log{
    public function __construct(){

    }
    public function autopause($dataHoraDoPause){
        require_once __DIR__ . '/../../../database/connection.php';
        $sqlConsultaPausa = "SELECT id FROM tb_chamados_sla WHERE em_pausa = 'N';";
        $result1 = select($sqlConsultaPausa);

        if($result1[0]['id'] != ''){
            $sqlInsertLog = "INSERT INTO tb_log_pausa_sla (id_chamado, id_colaborador, iniciado_pausado, iniciado_pausado_em)
            SELECT
            id,
            responsavel,
            'P',
            '$dataHoraDoPause'
            FROM tb_chamados_sla WHERE em_pausa = 'N' AND status = '1';";
            insertGeral($sqlInsertLog);

            $sqlUpdate = "UPDATE tb_chamados_sla SET em_pausa = 'S' WHERE em_pausa = 'N' AND concluido_em IS NULL AND status = '1';";
            updateGeral($sqlUpdate);

            //fazer aqui o insert no diario automatico.
        }
        $sqlConsultaPausaTeste = "SELECT id FROM tb_chamados_sla WHERE teste_em_pausa = 'N';";
        $result2 = select($sqlConsultaPausaTeste);

        if($result2[0]['id'] != ''){
            $sqlInsertLog2 = "INSERT INTO tb_log_pausa_teste_sla (id_chamado, id_colaborador, iniciado_pausado, iniciado_pausado_em)
            SELECT
            id,
            '0',
            'P',
            '$dataHoraDoPause'
            FROM tb_chamados_sla WHERE em_pausa = 'N';";
            insertGeral($sqlInsertLog2);

            $sqlUpdate2 = "UPDATE tb_chamados_sla SET teste_em_pausa = 'S' WHERE teste_em_pausa = 'N' AND concluido_em IS NULL AND status = '1';";
            updateGeral($sqlUpdate2);
        }        
    }
}

