<?php
date_default_timezone_set('America/Sao_Paulo');
    class SetNovoBug{
        function __construct(){

        }
        function setNovoBug($id_cliente, $envolvidos, $id_solicitante,$titulo,$descricao,$data_entrega_estimada,$produto,$modulo,$tela, $direcionamento, $prioridade, $prazo, $solicitante_externo, $email_externo){
            require_once __DIR__ . '/../../../database/connection.php';
            
            $strenvolvidos = '';
            if(!empty($envolvidos) && count($envolvidos) > 0){
                $strenvolvidos = implode(",", $envolvidos);
            }
            
            $agora = date('Y-m-d H:i:s');
            $sql = "
            INSERT INTO tb_chamados_sla
            (
                cliente,
                envolvidos,
                solicitante,
                solicitante_externo,
                email_externo,
                titulo,
                descricao,
                data_entrega_estimada,
                produto,
                modulo,
                tela,
                direcionamento,
                prioridade,
                prazo,
                total_horas_orcamento,
                valor_hora_orcamento, 
                desconto_orcamento,
                total_preco_orcamento,
                caminho_anexo,
                caminho_anexo2,
                responsavel,
                iniciado_em,
                em_pausa,
                concluido_em,
                propagacao_solicitada,
                aprovacao_tester,
                propagado,
                propagado_em,
                cadastrado_em,
                etapa_atual,
                status
            )
            VALUES (
                '$id_cliente',
                '$strenvolvidos',
                '$id_solicitante',
                '$solicitante_externo',
                '$email_externo',
                '$titulo',
                '$descricao',
                '$data_entrega_estimada',
                '$produto',
                '$modulo',
                '$tela',
                '$direcionamento',
                '$prioridade',
                '$prazo',
                NULL,
                NULL,
                NULL,
                NULL,
                NULL,
                NULL,
                NULL,
                NULL,
                NULL,
                NULL,
                NULL,
                NULL,
                'N',
                NULL,
                '$agora',
                '1',
                '1'
            );
            ";
            insertGeral($sql);

            $sql2 = "SELECT MAX(id) AS id_chamado, envolvidos, prazo FROM tb_chamados_sla WHERE status = '1' GROUP BY id ORDER BY id DESC LIMIT 1;";
            $resultado = select($sql2);
            return $resultado;
        }
        function setNovoOrcamento($id_cliente,$id_solicitante,$descricao,$data_entrega_estimada,$total_horas,$valor_hora,$desconto,$total_preco){
            require_once __DIR__ . '/../../../database/connection.php';
            // $descricao = str_replace("\n","",$descricao);
            // $descricao = str_replace("\r","",$descricao);
            $descricao = str_replace("\"","\\\"",$descricao);
            // $descricao = str_replace(":","->",$descricao);
            $descricao = str_replace("'","\\\'",$descricao);
             
            // $descricao = json_encode($descricao, JSON_UNESCAPED_UNICODE);
            //echo $descricao;
            $agora = date('Y-m-d H:i:s');
            $sql = "
            INSERT INTO tb_chamados_sla
            (
                cliente,
                solicitante,
                descricao,
                data_entrega_estimada,
                produto,
                modulo,
                tela,
                direcionamento,
                prioridade,
                prazo,
                total_horas_orcamento,
                valor_hora_orcamento,
                desconto_orcamento,
                total_preco_orcamento,
                caminho_anexo,
                caminho_anexo2,
                responsavel,
                iniciado_em,
                em_pausa,
                concluido_em,
                propagacao_solicitada,
                aprovacao_tester,
                propagado,
                propagado_em,
                cadastrado_em,
                etapa_atual,
                status
            )
            VALUES (
                '$id_cliente',
                '$id_solicitante',
                '$descricao',
                '$data_entrega_estimada',
                NULL,
                NULL,
                NULL,
                NULL,
                '$prioridade',
                '$prazo',
                '$total_horas',
                '$valor_hora',
                '$desconto',
                '$total_preco',
                NULL,
                NULL,
                NULL,
                NULL,
                NULL,
                NULL,
                NULL,
                NULL,
                NULL,
                NULL,
                '$agora',
                '1',
                '1'
            );
            ";
            insertGeral($sql);

            $sql2 = "SELECT MAX(id) AS id_chamado, envolvidos, prazo FROM tb_chamados_sla WHERE status = '1' GROUP BY id ORDER BY id DESC LIMIT 1;";
            $resultado = select($sql2);
            return $resultado;
        }
        function updateBug($id_chamado,$cliente,$solicitante,$produto,$modulo,$tela,/*$direcionamento,*/$prioridade, $data_entrega, $titulo, $descricao, $prazo){
            require_once __DIR__ . '/../../../database/connection.php';
            
            $sql = "
            UPDATE tb_chamados_sla
            SET
                cliente = '$cliente',
                solicitante = '$solicitante',
                titulo = '$titulo',
                descricao = '$descricao',
                data_entrega_estimada = '$data_entrega',
                produto = '$produto',
                modulo = '$modulo',
                tela = '$tela',
                prioridade = '$prioridade',
                prazo = '$prazo'
           WHERE id = '$id_chamado';
            ";

            updateGeral($sql);
        }
    }
?>