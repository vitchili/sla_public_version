<?php
date_default_timezone_set('America/Sao_Paulo');
class SetResponsavelChamadosSLA{
    public function __construct(){

    }
    public function setResponsavel($id, $nomeColaborador){
        require_once __DIR__ . '/../../../database/connection.php';
        
        $sql = "SELECT id, nome FROM tb_solicitante_sla WHERE nome = '$nomeColaborador';";
        $colaborador = select($sql);
        
        $sql2 = "UPDATE tb_chamados_sla SET etapa_atual = '2', responsavel = '".$colaborador[0]['id']."' WHERE id = '$id';";
        $update = updateGeral($sql2);
        /*******************LOG DIARIO***************** */
        
        $sql3 = "INSERT INTO tb_registros_atendimentos_suporte (usuario, cliente, solicitante_externo, assunto, resumo, resolvido, cadastrado_em, status)
        VALUES('".$colaborador[0]['id']."', '4', 'Log Sistema', 'Chamado Assumido', 'Chamado #".$id." foi assumido para fila de tarefas.', 'S', NOW(), '1' );";
        insertGeral($sql3);
    }
    public function unsetResponsavel($id){
        require_once __DIR__ . '/../../../database/connection.php';
        
        $sql = "UPDATE tb_chamados_sla SET etapa_atual = '1', responsavel = NULL WHERE id = '$id';";
        $update = updateGeral($sql);
    }
    
    public function setInicioCorrecao($idChamado, $colaborador, $cargo){

        require_once __DIR__ . '/../../../database/connection.php';
        $agora = date('Y-m-d H:i:s');

        if($cargo == 'DEV' || $cargo == 'ADM' || $cargo == 'SUP'){
            $sql = "UPDATE tb_chamados_sla SET etapa_atual = '3', iniciado_em = '$agora', em_pausa = 'N' WHERE id = '$idChamado';";

            $sql2 = "INSERT INTO tb_log_pausa_sla 
            (id_chamado, id_colaborador, iniciado_pausado, iniciado_pausado_em)
            SELECT
            '$idChamado',
            S.id,
            'I',
            '$agora'
            FROM tb_solicitante_sla S
            WHERE S.nome = '$colaborador';";
        }else{
            $sql = "UPDATE tb_chamados_sla SET etapa_atual = '3', iniciada_correcao_em = '$agora', teste_em_pausa = 'N', iniciada_correcao_em = NOW() WHERE id = '$idChamado';";
            $sql2 = "INSERT INTO tb_log_pausa_teste_sla 
            (id_chamado, id_colaborador, iniciado_pausado, iniciado_pausado_em)
            SELECT
            '$idChamado',
            S.id,
            'I',
            '$agora'
            FROM tb_solicitante_sla S
            WHERE S.nome = '$colaborador';";
        }

        $update = updateGeral($sql);
        $update2 = updateGeral($sql2);

        /*******************LOG DIARIO***************** */
        
        $sql4 = "SELECT id, nome FROM tb_solicitante_sla WHERE nome = '$colaborador';";
        $colaborador = select($sql4);
        $sql3 = "INSERT INTO tb_registros_atendimentos_suporte (usuario, cliente, solicitante_externo, assunto, resumo, resolvido, cadastrado_em, status)
        VALUES('".$colaborador[0]['id']."', '4', 'Log Sistema', 'Correção Inicializada', 'Chamado #".$idChamado." foi inicializado para correção.', 'S', NOW(), '1' );"; 
        insertGeral($sql3);
    }
    public function insertSwitchCase($idChamado, $arrayPost){
        $base_a_ser_testado = $arrayPost['base_a_ser_testado'];
 
        for($i=0; $i<12;$i++){
            $arrayPost['switchCaseCaminho'.$i] = str_replace("'", "\\'", $arrayPost['switchCaseCaminho'.$i]);
            $arrayPost['switchCaseDescricao'.$i] = str_replace("'", "\\'", $arrayPost['switchCaseDescricao'.$i]);
            $arrayPost['switchCaseEsperado'.$i] = str_replace("'", "\\'", $arrayPost['switchCaseEsperado'.$i]);
            $arrayPost['switchCaseOcorrido'.$i] = str_replace("'", "\\'", $arrayPost['switchCaseOcorrido'.$i]);

            $arrayPost['switchCaseCaminho'.$i] = str_replace("\"", "\\'", $arrayPost['switchCaseCaminho'.$i]);
            $arrayPost['switchCaseDescricao'.$i] = str_replace("\"", "\\'", $arrayPost['switchCaseDescricao'.$i]);
            $arrayPost['switchCaseEsperado'.$i] = str_replace("\"", "\\'", $arrayPost['switchCaseEsperado'.$i]);
            $arrayPost['switchCaseOcorrido'.$i] = str_replace("\"", "\\'", $arrayPost['switchCaseOcorrido'.$i]);
        }
        require_once __DIR__ . '/../../../database/connection.php';
        $sqlUpdate = "UPDATE tb_chamado_switch_case SET status = '0' WHERE id_chamado = '$idChamado'";
        updateGeral($sqlUpdate);

        /*$sqlPesquisa = "SELECT * FROM tb_chamado_switch_case WHERE status = 1 AND id_chamado = '$idChamado'";
        $switchCaseAtual = select($sqlPesquisa);*/

        if(!empty($arrayPost['switchCaseCaminho0'])){ 
            $sql = "INSERT INTO tb_chamado_switch_case (id_chamado, caminho, descricao, esperado, ocorrido, base, status) VALUES ('$idChamado', '".$arrayPost['switchCaseCaminho0']."', '".$arrayPost['switchCaseDescricao0']."', '".$arrayPost['switchCaseEsperado0']."', '".$arrayPost['switchCaseOcorrido0']."' ,'".$arrayPost['base_a_ser_testado']."','1');";
            var_dump($sql);
            insertGeral($sql);
        }
        if(!empty($arrayPost['switchCaseCaminho1'])){
            $sql = "INSERT INTO tb_chamado_switch_case (id_chamado, caminho, descricao, esperado, ocorrido, base, status) VALUES ('$idChamado', '".$arrayPost['switchCaseCaminho1']."', '".$arrayPost['switchCaseDescricao1']."', '".$arrayPost['switchCaseEsperado1']."', '".$arrayPost['switchCaseOcorrido0']."' ,'".$arrayPost['base_a_ser_testado']."','1');";
            var_dump($sql);
            insertGeral($sql);
        }
        if(!empty($arrayPost['switchCaseCaminho2'])){
            $sql = "INSERT INTO tb_chamado_switch_case (id_chamado, caminho, descricao, esperado, ocorrido, base, status) VALUES ('$idChamado', '".$arrayPost['switchCaseCaminho2']."', '".$arrayPost['switchCaseDescricao2']."', '".$arrayPost['switchCaseEsperado2']."', '".$arrayPost['switchCaseOcorrido2']."' ,'".$arrayPost['base_a_ser_testado']."','1');";
            var_dump($sql);
            insertGeral($sql);
        }
        if(!empty($arrayPost['switchCaseCaminho3'])){
            $sql = "INSERT INTO tb_chamado_switch_case (id_chamado, caminho, descricao, esperado, ocorrido, base, status) VALUES ('$idChamado', '".$arrayPost['switchCaseCaminho3']."', '".$arrayPost['switchCaseDescricao3']."', '".$arrayPost['switchCaseEsperado3']."', '".$arrayPost['switchCaseOcorrido3']."' ,'".$arrayPost['base_a_ser_testado']."','1');";
            var_dump($sql);
            insertGeral($sql);
        }
        if(!empty($arrayPost['switchCaseCaminho4'])){
            $sql = "INSERT INTO tb_chamado_switch_case (id_chamado, caminho, descricao, esperado, ocorrido, base, status) VALUES ('$idChamado', '".$arrayPost['switchCaseCaminho4']."', '".$arrayPost['switchCaseDescricao4']."', '".$arrayPost['switchCaseEsperado4']."', '".$arrayPost['switchCaseOcorrido4']."' ,'".$arrayPost['base_a_ser_testado']."','1');";
            var_dump($sql);
            insertGeral($sql);
        }
        if(!empty($arrayPost['switchCaseCaminho5'])){
            $sql = "INSERT INTO tb_chamado_switch_case (id_chamado, caminho, descricao, esperado, ocorrido, base, status) VALUES ('$idChamado', '".$arrayPost['switchCaseCaminho5']."', '".$arrayPost['switchCaseDescricao5']."', '".$arrayPost['switchCaseEsperado5']."', '".$arrayPost['switchCaseOcorrido5']."' ,'".$arrayPost['base_a_ser_testado']."','1');";
            var_dump($sql);
            insertGeral($sql);
        }
        if(!empty($arrayPost['switchCaseCaminho6'])){
            $sql = "INSERT INTO tb_chamado_switch_case (id_chamado, caminho, descricao, esperado, ocorrido, base, status) VALUES ('$idChamado', '".$arrayPost['switchCaseCaminho6']."', '".$arrayPost['switchCaseDescricao6']."', '".$arrayPost['switchCaseEsperado6']."', '".$arrayPost['switchCaseOcorrido6']."' ,'".$arrayPost['base_a_ser_testado']."','1');";
            var_dump($sql);
            insertGeral($sql);
        }
        if(!empty($arrayPost['switchCaseCaminho7'])){
            $sql = "INSERT INTO tb_chamado_switch_case (id_chamado, caminho, descricao, esperado, ocorrido, base, status) VALUES ('$idChamado', '".$arrayPost['switchCaseCaminho7']."', '".$arrayPost['switchCaseDescricao7']."', '".$arrayPost['switchCaseEsperado7']."', '".$arrayPost['switchCaseOcorrido7']."' ,'".$arrayPost['base_a_ser_testado']."','1');";
            var_dump($sql);
            insertGeral($sql);
        }
        if(!empty($arrayPost['switchCaseCaminho8'])){
            $sql = "INSERT INTO tb_chamado_switch_case (id_chamado, caminho, descricao, esperado, ocorrido, base, status) VALUES ('$idChamado', '".$arrayPost['switchCaseCaminho8']."', '".$arrayPost['switchCaseDescricao8']."', '".$arrayPost['switchCaseEsperado8']."', '".$arrayPost['switchCaseOcorrido8']."' ,'".$arrayPost['base_a_ser_testado']."','1');";
            var_dump($sql);
            insertGeral($sql);
        }
        if(!empty($arrayPost['switchCaseCaminho9'])){
            $sql = "INSERT INTO tb_chamado_switch_case (id_chamado, caminho, descricao, esperado, ocorrido, base, status) VALUES ('$idChamado', '".$arrayPost['switchCaseCaminho9']."', '".$arrayPost['switchCaseDescricao9']."', '".$arrayPost['switchCaseEsperado9']."', '".$arrayPost['switchCaseOcorrido9']."' ,'".$arrayPost['base_a_ser_testado']."','1');";
            var_dump($sql);
            insertGeral($sql);
        }
        if(!empty($arrayPost['switchCaseCaminho10'])){
            $sql = "INSERT INTO tb_chamado_switch_case (id_chamado, caminho, descricao, esperado, ocorrido, base, status) VALUES ('$idChamado', '".$arrayPost['switchCaseCaminho10']."', '".$arrayPost['switchCaseDescricao10']."', '".$arrayPost['switchCaseEsperado10']."', '".$arrayPost['switchCaseOcorrido10']."' ,'".$arrayPost['base_a_ser_testado']."','1');";
            var_dump($sql);
            insertGeral($sql);
        }
        if(!empty($arrayPost['switchCaseCaminho11'])){
            $sql = "INSERT INTO tb_chamado_switch_case (id_chamado, caminho, descricao, esperado, ocorrido, base, status) VALUES ('$idChamado', '".$arrayPost['switchCaseCaminho11']."', '".$arrayPost['switchCaseDescricao11']."', '".$arrayPost['switchCaseEsperado11']."', '".$arrayPost['switchCaseOcorrido11']."' ,'".$arrayPost['base_a_ser_testado']."','1');";
            var_dump($sql);
            insertGeral($sql);
        }

        /*******************LOG DIARIO***************** */
        
        $sql3 = "INSERT INTO tb_registros_atendimentos_suporte (usuario, cliente, solicitante_externo, assunto, resumo, resolvido, cadastrado_em, status)
        VALUES('".$_SESSION['id']."', '4', 'Log Sistema', 'Switch Case registrado', 'Switch Case do chamado #".$idChamado." foi salvo ou atualizado.', 'S', NOW(), '1' );";
        insertGeral($sql3);
    }
    public function setRetomadaCorrecao($idChamado, $colaborador, $cargo){
        require_once __DIR__ . '/../../../database/connection.php';
        $agora = date('Y-m-d H:i:s');
        
        if($cargo == 'DEV'){
            $sql = "UPDATE tb_chamados_sla  SET etapa_atual = '6', em_pausa = 'N' WHERE id = '$idChamado';";
        
            $sql2 = "INSERT INTO tb_log_pausa_sla 
            (id_chamado, id_colaborador, iniciado_pausado, iniciado_pausado_em)
            SELECT
            '$idChamado',
            S.id,
            'I',
            '$agora'
            FROM tb_solicitante_sla S
            WHERE S.nome = '$colaborador';";
        }else{
            $sql = "UPDATE tb_chamados_sla SET teste_em_pausa = 'N' WHERE id = '$idChamado';";
        
            $sql2 = "INSERT INTO tb_log_pausa_teste_sla 
            (id_chamado, id_colaborador, iniciado_pausado, iniciado_pausado_em)
            SELECT
            '$idChamado',
            S.id,
            'I',
            '$agora'
            FROM tb_solicitante_sla S
            WHERE S.nome = '$colaborador';";
        }
        $update = updateGeral($sql);
        $update2 = updateGeral($sql2);

        /*******************LOG DIARIO***************** */
        
        $sql4 = "SELECT id, nome FROM tb_solicitante_sla WHERE nome = '$colaborador';";
        $colaborador = select($sql4);
        $sql3 = "INSERT INTO tb_registros_atendimentos_suporte (usuario, cliente, solicitante_externo, assunto, resumo, resolvido, cadastrado_em, status)
        VALUES('".$colaborador[0]['id']."', '4', 'Log Sistema', 'Correção Retomada', 'Correção retomada do chamado #".$idChamado."', 'S', NOW(), '1' );";
        insertGeral($sql3);

    }
    public function concluiSemResolver($idChamado,$inputModif,$quantidade_minutos){
        require_once __DIR__ . '/../../../database/connection.php'; 
        $agora = date('Y-m-d H:i:s');
        // $inputModif = utf8_encode($inputModif);
        // $inputModif = str_replace("\n","",$inputModif);
        // $inputModif = str_replace("\r","",$inputModif); 
        // $inputModif = str_replace("\"","",$inputModif);
        // $inputModif = str_replace("/","-",$inputModif);
        // $inputModif = str_replace(":"," ->",$inputModif);
        // $inputModif = json_encode($inputModif, JSON_UNESCAPED_UNICODE);
        
        $sql = "UPDATE tb_chamados_sla SET etapa_atual = '12', concluido_em = '$agora', propagacao_solicitada = 'N', modificacao = '$inputModif', quantidade_minutos_atendimento = '$quantidade_minutos' WHERE id = '$idChamado';";
        $update = updateGeral($sql);

        /*******************LOG DIARIO***************** */
        
        $sql4 = "SELECT id, responsavel FROM tb_chamados_sla WHERE id = '$idChamado';";
        $chamado = select($sql4);
        $sql3 = "INSERT INTO tb_registros_atendimentos_suporte (usuario, cliente, solicitante_externo, assunto, resumo, resolvido, cadastrado_em, status)
        VALUES('".$chamado[0]['responsavel']."', '4', 'Log Sistema', 'Chamado finalizado sem modificação de código', 'Chamado #".$idChamado." foi finalizado sem necessidade de modificar o código.', 'S', NOW(), '1' );";
        insertGeral($sql3);
    }
    public function cancelaChamado($idChamado,$inputModif){
        require_once __DIR__ . '/../../../database/connection.php'; 
        $agora = date('Y-m-d H:i:s');
        $sql = "UPDATE tb_chamados_sla SET etapa_atual = '13', concluido_em = '$agora', modificacao = '$inputModif', propagacao_solicitada = 'N', chamado_cancelado = 'S' WHERE id = '$idChamado';";
        $update = updateGeral($sql);

        /*******************LOG DIARIO***************** */
        
        $sql4 = "SELECT id, responsavel FROM tb_chamados_sla WHERE id = '$idChamado';";
        $chamado = select($sql4);
        $sql3 = "INSERT INTO tb_registros_atendimentos_suporte (usuario, cliente, solicitante_externo, assunto, resumo, resolvido, cadastrado_em, status)
        VALUES('".$chamado[0]['responsavel']."', '4', 'Log Sistema', 'Chamado cancelado', 'Chamado #".$idChamado." foi cancelado pelo usuário.', 'S', NOW(), '1' );";
        insertGeral($sql3);
    }
    public function insertMensagemChamado($idChamado,$mensagem, $autor){
        require_once __DIR__ . '/../../../database/connection.php'; 
        $agora = date('Y-m-d H:i:s');
        $sql = "INSERT INTO tb_conversas_chamados (id_chamado, autor, mensagem) VALUES ('$idChamado', '$autor', '$mensagem');";
        $update = insertGeral($sql);

        /*******************LOG DIARIO***************** */
        
        $sql3 = "INSERT INTO tb_registros_atendimentos_suporte (usuario, cliente, solicitante_externo, assunto, resumo, resolvido, cadastrado_em, status)
        VALUES('".$autor."', '4', 'Log Sistema', 'Mensagem inserida no chamado #".$idChamado."', 'Conversa inserida no chamado #".$idChamado."', 'S', NOW(), '1' );";
        insertGeral($sql3);
    }

    public function insertMensagemExternaChamado($idChamado,$mensagem, $autor){
        require_once __DIR__ . '/../../../database/connection.php'; 
        $sql = "INSERT INTO tb_conversas_externas_chamados (id_chamado, autor, mensagem) VALUES ('$idChamado', '$autor', '$mensagem');";
        insertGeral($sql);
    }
    
    public function concluiESolicitaProp($idChamado, $inputModif, $inputBranch){
        require_once __DIR__ . '/../../../database/connection.php';
        $agora = date('Y-m-d H:i:s');
        // $inputModif = utf8_encode($inputModif);
        $inputModif = str_replace("\"","",$inputModif);
        $inputModif = str_replace("'","",$inputModif);
        $sql = "UPDATE tb_chamados_sla SET etapa_atual = '7', concluido_em = '$agora', propagacao_solicitada = 'S', modificacao = '$inputModif', branch = '$inputBranch'  WHERE id = '$idChamado';";
        $update = updateGeral($sql);

        /*******************LOG DIARIO***************** */
        
        $sql4 = "SELECT id, responsavel FROM tb_chamados_sla WHERE id = '$idChamado';";
        $chamado = select($sql4);
        $sql3 = "INSERT INTO tb_registros_atendimentos_suporte (usuario, cliente, solicitante_externo, assunto, resumo, resolvido, cadastrado_em, status)
        VALUES('".$chamado[0]['responsavel']."', '4', 'Log Sistema', 'Chamado #".$idChamado." foi enviado para teste.', 'Chamado #".$idChamado." foi finalizado pelo desenvolvedor e enviado para teste.', 'S', NOW(), '1' );";
        insertGeral($sql3);
        
    }
    public function deixarChamadoEmEspera($idChamado, $inputModif){
        require_once __DIR__ . '/../../../database/connection.php';
        $agora = date('Y-m-d H:i:s');
        $inputModif = str_replace("\"","\\\"",$inputModif);
        $inputModif = str_replace("'","\\\"",$inputModif);
        $sql = "UPDATE tb_chamados_sla SET etapa_atual = '5', chamado_em_espera = 'S', motivo_espera = '$inputModif', data_colocado_espera = NOW()  WHERE id = '$idChamado';";
        $update = updateGeral($sql);

        /*******************LOG DIARIO***************** */
        
        $sql4 = "SELECT id, responsavel FROM tb_chamados_sla WHERE id = '$idChamado';";
        $chamado = select($sql4);
        $sql3 = "INSERT INTO tb_registros_atendimentos_suporte (usuario, cliente, solicitante_externo, assunto, resumo, resolvido, cadastrado_em, status)
        VALUES('".$chamado[0]['responsavel']."', '4', 'Log Sistema', 'Chamado #".$idChamado." foi colocado em espera.', 'Chamado #".$idChamado." foi colocado em espera.', 'S', NOW(), '1' );";
        insertGeral($sql3);
        
    }
    public function reativarChamadoEmEspera($idChamado){
        require_once __DIR__ . '/../../../database/connection.php';
        $agora = date('Y-m-d H:i:s');
        $sql = "UPDATE tb_chamados_sla SET etapa_atual = '6', chamado_em_espera = 'N', motivo_espera = NULL, data_colocado_espera = NULL  WHERE id = '$idChamado';";
        $update = updateGeral($sql);

        /*******************LOG DIARIO***************** */
        
        $sql4 = "SELECT id, responsavel FROM tb_chamados_sla WHERE id = '$idChamado';";
        $chamado = select($sql4);
        $sql3 = "INSERT INTO tb_registros_atendimentos_suporte (usuario, cliente, solicitante_externo, assunto, resumo, resolvido, cadastrado_em, status)
        VALUES('".$chamado[0]['responsavel']."', '4', 'Log Sistema', 'Chamado #".$idChamado." foi reativado.', 'Chamado #".$idChamado." foi reativado após espera.', 'S', NOW(), '1' );";
        insertGeral($sql3);
        
    }
    public function autorizaPropagacao($idChamado, $nomeAutorizador){
        require_once __DIR__ . '/../../../database/connection.php';
        
        $sqlAutorizador = "SELECT * FROM tb_solicitante_sla WHERE nome = '$nomeAutorizador'";
        $dadosAutorizador = select($sqlAutorizador);
        $agora = date('Y-m-d H:i:s');
        if($dadosAutorizador[0]['cargo'] == 'TST'){
            $sqlupdate1 = "UPDATE tb_chamados_sla SET etapa_atual = '10', aprovado_reprovado = 'A', aprovacao_tester = '".$dadosAutorizador[0]['id']."', ultima_aprovacao = '$agora'  WHERE id = '$idChamado';";
            $update1 = updateGeral($sqlupdate1);
        }

        /*******************LOG DIARIO***************** */
        
        $sql3 = "INSERT INTO tb_registros_atendimentos_suporte (usuario, cliente, solicitante_externo, assunto, resumo, resolvido, cadastrado_em, status)
        VALUES('".$_SESSION['id']."', '4', 'Log Sistema', 'Chamado #".$idChamado." foi aprovado no teste.', 'Teste do chamado #".$idChamado." foi aprovado e encaminhado para propagação.', 'S', NOW(), '1' );";
        insertGeral($sql3);

        $select = "SELECT responsavel FROM tb_chamados_sla WHERE id = '$idChamado';";
        $resultado = select($select);
        return $resultado;
        
        $sql4 = "INSERT INTO tb_registros_atendimentos_suporte (usuario, cliente, solicitante_externo, assunto, resumo, resolvido, cadastrado_em, status)
        VALUES('".$resultado[0]['responsavel']."', '4', 'Log Sistema', 'Chamado #".$idChamado." foi aprovado no teste.', 'Teste do chamado #".$idChamado." foi aprovado e encaminhado para administrador propagar modificações.', 'S', NOW(), '1' );";
        insertGeral($sql4);
        
    }
    
    public function reprovaPropagacao($idChamado){
        require_once __DIR__ . '/../../../database/connection.php';
        $agora = date('Y-m-d H:i:s');
        $sql = "UPDATE tb_chamados_sla SET etapa_atual = '9', aprovado_reprovado = 'R', concluido_em = NULL, ultima_reprovacao = '$agora', propagacao_solicitada = NULL WHERE id = '$idChamado';";
        $update = updateGeral($sql);

        /*******************LOG DIARIO***************** */
        
        $sql3 = "INSERT INTO tb_registros_atendimentos_suporte (usuario, cliente, solicitante_externo, assunto, resumo, resolvido, cadastrado_em, status)
        VALUES('".$_SESSION['id']."', '4', 'Log Sistema', 'Chamado #".$idChamado." foi reprovado no teste.', 'Teste do chamado #".$idChamado." foi reprovado e encaminhado para o desenvolvedor corrigir.', 'S', NOW(), '1' );";
        insertGeral($sql3);

        $select = "SELECT responsavel FROM tb_chamados_sla WHERE id = '$idChamado';";
        $resultado = select($select);
        return $resultado;
        
        $sql4 = "INSERT INTO tb_registros_atendimentos_suporte (usuario, cliente, solicitante_externo, assunto, resumo, resolvido, cadastrado_em, status)
        VALUES('".$resultado[0]['responsavel']."', '4', 'Log Sistema', 'Chamado #".$idChamado." foi reprovado no teste.', 'Teste do chamado #".$idChamado." foi reprovado e encaminhado para o desenvolvedor corrigir.', 'S', NOW(), '1' );";
        insertGeral($sql4);
    }
    
    public function finalizaChamado($idChamado){
        require_once __DIR__ . '/../../../database/connection.php';
        $sql = "UPDATE tb_chamados_sla SET etapa_atual = '11', propagado = 'S' WHERE id = '$idChamado';";
        $update = updateGeral($sql);
    }
    function setPausaCorrecao($idChamado, $colaborador, $cargo){
        require_once __DIR__ . '/../../../database/connection.php';
        $agora = date('Y-m-d H:i:s');

        if($cargo == 'DEV'){
            $sql = "UPDATE tb_chamados_sla SET etapa_atual = '4', em_pausa = 'S' WHERE id = '$idChamado';";
            $sql2 = "INSERT INTO tb_log_pausa_sla 
            (id_chamado, id_colaborador, iniciado_pausado, iniciado_pausado_em)
            SELECT
            '$idChamado',
            S.id,
            'P',
            '$agora'
            FROM tb_solicitante_sla S
            WHERE S.nome = '$colaborador';";
        }else{
            $sql = "UPDATE tb_chamados_sla SET teste_em_pausa = 'S' WHERE id = '$idChamado';";
            $sql2 = "INSERT INTO tb_log_pausa_teste_sla 
            (id_chamado, id_colaborador, iniciado_pausado, iniciado_pausado_em)
            SELECT
            '$idChamado',
            S.id,
            'P',
            '$agora'
            FROM tb_solicitante_sla S
            WHERE S.nome = '$colaborador';";
        }
        $update = updateGeral($sql);
        $update2 = updateGeral($sql2);

        /*******************LOG DIARIO***************** */
        
        $sql4 = "SELECT id, responsavel FROM tb_chamados_sla WHERE id = '$idChamado';";
        $chamado = select($sql4);
        $sql3 = "INSERT INTO tb_registros_atendimentos_suporte (usuario, cliente, solicitante_externo, assunto, resumo, resolvido, cadastrado_em, status)
        VALUES('".$chamado[0]['responsavel']."', '4', 'Log Sistema', 'Chamado #".$idChamado." foi pausado.', 'A correção do chamamdo #".$idChamado." foi pausada pelo desenvolvedor.', 'S', NOW(), '1' );";
        insertGeral($sql3);
    }
    function setCaminhoAnexo($key, $idChamado, $caminhoAnexo){
        require_once __DIR__ . '/../../../database/connection.php';
        if($key == 1){
            $sql = "UPDATE tb_chamados_sla SET caminho_anexo = '$caminhoAnexo' WHERE id = '$idChamado';";
        }else if($key == 2){
            $sql = "UPDATE tb_chamados_sla SET caminho_anexo2 = '$caminhoAnexo' WHERE id = '$idChamado';";
        }else if($key == 3){
            $sql = "UPDATE tb_chamados_sla SET caminho_anexo3 = '$caminhoAnexo' WHERE id = '$idChamado';";
        }
        $update = updateGeral($sql);
    }
    function prometeIntimaCorrecao($idChamado, $responsavel, $data_promessa){
        $solicitante = $_SESSION['id'];
        require_once __DIR__ . '/../../../database/connection.php';
        $sql = "INSERT INTO tb_promessas_sla (id_referencia, id_usuario_solicitante, id_usuario_responsavel, resolvido, data_promessa, cadastrado_em, status)
        VALUES('$idChamado', '$solicitante', '$responsavel', 'N', '$data_promessa', NOW(), '1')";
        $result = insertGeral($sql); 

        /*******************LOG DIARIO***************** */
        $dataHora = (new DateTime($data_promessa))->format('d-m-Y');
        $sql3 = "INSERT INTO tb_registros_atendimentos_suporte (usuario, cliente, solicitante_externo, assunto, resumo, resolvido, cadastrado_em, status)
        VALUES('".$responsavel."', '4', 'Log Sistema', 'Promessa de resolução de chamado', 'Chamado #".$idChamado." foi prometido para ".$dataHora.".', 'S', NOW(), '1' );";
        insertGeral($sql3);
    }
    
}
        
?>