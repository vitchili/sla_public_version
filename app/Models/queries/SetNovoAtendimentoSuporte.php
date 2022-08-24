<?php
    class SetNovoAtendimentoSuporte{
        function __construct(){

        }
        function setNovoAtendimento($usuario, $cliente, $solicitante_externo, $assunto, $resumo, $resolvido){
            require_once __DIR__ . '/../../../database/connection.php';
            $resumo = str_replace("\"","",$resumo);
            $resumo = str_replace("'","",$resumo);
            date_default_timezone_set('America/Sao_Paulo');
            $agora = date('Y-m-d H:i:s');
            $sql = "
            INSERT INTO tb_registros_atendimentos_suporte
            (
                usuario,
                cliente,
                solicitante_externo,
                assunto,
                resumo,
                resolvido,
                cadastrado_em,
                status
            )
            VALUES (
                '$usuario',
                '$cliente',
                '$solicitante_externo',
                '$assunto',
                '$resumo',
                '$resolvido',
                '$agora',
                '1'
            );
            ";
            insertGeral($sql);
        }
        function getConversaChamado($user, $dia){
            if($dia == 'ontem'){
                $andOntem = 'AND DATE(ras.cadastrado_em) = DATE(NOW() - INTERVAL 1 DAY)';
            }else{
                $andHoje = 'AND DATE(ras.cadastrado_em) = DATE(NOW())';
            }
            require_once __DIR__ . '/../../../database/connection.php';
            $sql = "SELECT ras.assunto, ras.resumo, ras.cadastrado_em FROM tb_registros_atendimentos_suporte ras
            JOIN tb_solicitante_sla ssla ON ssla.id = ras.usuario
            WHERE ssla.nome = '$user' 
            {$andOntem}
            {$andHoje}"; 
             
            $resultado = select($sql);
            return $resultado;
        }   
        function getPromessasDiarias($user, $dia){
            if($dia == 'ontem'){
                $andOntem = 'AND DATE(pro.data_promessa) = DATE(NOW() - INTERVAL 1 DAY)';
            }else if($dia == 'hoje'){
                $andHoje = 'AND DATE(pro.data_promessa) = DATE(NOW())';
            }else{
                $andPosterior = 'AND DATE(pro.data_promessa) > DATE(NOW())';
            }
            require_once __DIR__ . '/../../../database/connection.php';
            $sql = "SELECT id_referencia, IF(resolvido = 'S', 'Sim', 'Não') AS resolvido, data_promessa, ssla.nome AS solicitante, cadastrado_em, pro.status  FROM tb_promessas_sla pro
            JOIN tb_solicitante_sla ssla ON ssla.id = pro.id_usuario_solicitante
            WHERE ssla.nome = '$user' 
            {$andOntem}
            {$andHoje}
            {$andPosterior}"; 
             
            $resultado = select($sql);
            return $resultado;
        }   
    }
    
?>