<?php
session_start();
require_once __DIR__ . '/../../Models/queries/SetResponsavelChamadosSLA.php';
require_once __DIR__ . '/SlaController.php';
require_once __DIR__ . '/../../Models/queries/GetChamadosSLA.php';
require_once __DIR__ . '/../../Models/queries/Notificacoes.php';

class ControllerAcoesChamado{
    function __construct(){
        
    }
    function deixarChamadoEmEspera($idChamado, $modif){
        $modif = str_replace("'", "\\'", $modif);
        $modif = str_replace("\"", "\\'", $modif);
        $s1 = new SetResponsavelChamadosSLA;
        $s1->deixarChamadoEmEspera($idChamado, $modif);
    }
    function concluiESolicitaProp($idChamado, $modif, $branch){
        $modif = str_replace("'", "", $modif);
        $branch = str_replace("'", "", $branch);
        $modif = str_replace("\"", "", $modif);
        $branch = str_replace("\"", "", $branch);

        $s1 = new SetResponsavelChamadosSLA;
        $s1->concluiESolicitaProp($idChamado, $modif, $branch);
    }
    function reativarChamadoEmEspera($idChamado){
        $s1 = new SetResponsavelChamadosSLA; 
        $s1->reativarChamadoEmEspera($idChamado);
    }
    function setRetomadaCorrecao($idChamado, $colaborador, $cargo){
        $s2 = new SetResponsavelChamadosSLA;
        $s2->setRetomadaCorrecao($idChamado, $colaborador, $cargo);
    }
    function cancelaOuConluiChamado($idChamado, $inputModif, $tipoFinalizacao = '', $quantidade_minutos){
        $s2 = new SetResponsavelChamadosSLA;
        if($tipoFinalizacao == 'suporte'){
                $inputModif_slash = addslashes($inputModif);
                $s2->concluiSemResolver($idChamado,$inputModif_slash,$quantidade_minutos);
        }else if($_POST['tipoFinalizacao'] == 'cancelamento'){
                $s2->cancelaChamado($idChamado,$inputModif);
        }
    } 
    function setInicioCorrecao($idChamado, $colaborador, $cargo){
        $s2 = new SetResponsavelChamadosSLA;
        $s2->setInicioCorrecao($idChamado, $colaborador, $cargo);
    }
    function insertMensagemChamado($idChamado,$msg_tratada){
        $msg_tratada =  str_replace("'", "\\'", $msg_tratada);
        $msg_tratada =  str_replace("\"", "\\'", $msg_tratada);
        
        $s2 = new SetResponsavelChamadosSLA;
        $s2->insertMensagemChamado($idChamado,$msg_tratada, $_SESSION['id']); 
    }
    function insertMensagemExternaChamado($idChamado,$msg_tratada){
        $msg_tratada =  str_replace("'", "\\'", $msg_tratada);
        $msg_tratada =  str_replace("\"", "\\'", $msg_tratada);
        
        $s2 = new SetResponsavelChamadosSLA;
        $s2->insertMensagemExternaChamado($idChamado,$msg_tratada, $_SESSION['nome_usuario']);
        
        $user = new GetChamadosSLA;
        $dados = $user->getDadosChamadoPorId($idChamado);
        $nome_responsavel = $dados[0]['responsavel'];
        $id_responsavel = $dados[0]['id_responsavel'];
        //pensar aqui como enviar a notificacao para o cliente. nesse modelo, apenas os devs e sup recebem notificacao. sms? email?
        if($nome_responsavel != $_SESSION['nome_usuario']){
            $notificacao = new Notificacoes;
            $notificacao->criarNotificacao($id_responsavel, "Task #{$idChamado} - Mensagem de ". $_SESSION['nome_usuario']);
        }
    }
    function setPausaCorrecao($idChamado, $colaborador, $cargo){
        $s2 = new SetResponsavelChamadosSLA;
        $s2->setPausaCorrecao($idChamado, $colaborador, $cargo);
    }
    function prometeIntimaCorrecao($idChamado, $responsavel, $data_promessa){
        $objUserResponsavel = new GetChamadosSLA;
        $usuarioResponsavel = $objUserResponsavel->getIdUsuarioPeloNome($responsavel);
        $s2 = new SetResponsavelChamadosSLA;
        $s2->prometeIntimaCorrecao($idChamado, $usuarioResponsavel[0]['id'], $data_promessa);
    }
    function setResponsavel($idChamado, $responsavel){
        $s2 = new SetResponsavelChamadosSLA;
        $s2->setResponsavel($idChamado, $responsavel);
    }
    function insertSwitchCase($idChamado, $arrayPost){
        $insertSwitchCase = new SetResponsavelChamadosSLA;
        $insertSwitchCase->insertSwitchCase($idChamado,$arrayPost);
    }
    function unsetResponsavel($idChamado){
        $s1 = new SetResponsavelChamadosSLA;
        $s1->unsetResponsavel($idChamado);
    }
    function reprovaPropagacao($idChamado){
        $s1 = new SetResponsavelChamadosSLA;
        $s1->reprovaPropagacao($idChamado);
    }
    function autorizaPropagacao($idChamado, $nomeAutorizador){
        $s1 = new SetResponsavelChamadosSLA;
        $s1->autorizaPropagacao($idChamado, $nomeAutorizador);
    }
    function finalizaChamado($idChamado){
        $s2 = new SetResponsavelChamadosSLA;
        $s2->finalizaChamado($idChamado);
    }
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deixar_chamado_em_espera'])) {
    $acao_chamado = new ControllerAcoesChamado;
    $acao_chamado->deixarChamadoEmEspera($_POST['idChamado'], $_POST['inputModif']); 
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['finaliza_chamado_sla'])) {
    $acao_chamado = new ControllerAcoesChamado;
    $acao_chamado->concluiESolicitaProp($_POST['idChamado'], $_POST['inputModif'], $_POST['inputBranch']);
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reativar_chamado_em_espera'])) {
    $acao_chamado = new ControllerAcoesChamado;
    $acao_chamado->reativarChamadoEmEspera($_POST['idChamado']);
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['set_retomada_correcao'])) {
    $acao_chamado = new ControllerAcoesChamado;
    $acao_chamado->setRetomadaCorrecao($_POST['idChamado'], $_SESSION['nome_usuario'], $_POST['cargo']);
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cancela_ou_conlui_chamado'])) {
    $acao_chamado = new ControllerAcoesChamado;
    $acao_chamado->cancelaOuConluiChamado($_POST['idChamado'], $_POST['inputModif'], $_POST['tipoFinalizacao'], $_POST['quantidade_minutos']);
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['set_inicio_correcao'])) {
    $acao_chamado = new ControllerAcoesChamado;
    $acao_chamado->setInicioCorrecao($_POST['idChamado'], $_SESSION['nome_usuario'], $_POST['cargo']);
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['insert_mensagem_chamado'])) {
    $acao_chamado = new ControllerAcoesChamado;
    $acao_chamado->insertMensagemChamado($_POST['idChamado'], $_POST['mensagem']);
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['insert_mensagem_externa_chamado'])) {
    $acao_chamado = new ControllerAcoesChamado;
    $acao_chamado->insertMensagemExternaChamado($_POST['idChamado'], $_POST['mensagem']);
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['set_pausa_correcao'])) {
    $acao_chamado = new ControllerAcoesChamado;
    $acao_chamado->setPausaCorrecao($_POST['idChamado'], $_SESSION['nome_usuario'], $_POST['cargo']);
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['promete_intima_correcao'])) {
    $acao_chamado = new ControllerAcoesChamado;
    $acao_chamado->prometeIntimaCorrecao($_POST['idChamado'], $_POST['responsavel'], $_POST['data_promessa']);
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['set_responsavel'])) {
    $acao_chamado = new ControllerAcoesChamado;
    $acao_chamado->setResponsavel($_POST['idChamado'], $_POST['nomeResponsavel']);
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['insert_switch_case'])) {
    $acao_chamado = new ControllerAcoesChamado;
    $acao_chamado->insertSwitchCase($_POST['idChamado'], $_POST);
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['unset_responsavel'])) {
    $acao_chamado = new ControllerAcoesChamado;
    $acao_chamado->unsetResponsavel($_POST['id']);
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reprovaPropagacao'])) {
    $acao_chamado = new ControllerAcoesChamado;
    $acao_chamado->reprovaPropagacao($_POST['idChamado']);
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['autoriza_propagacao'])) {
    $acao_chamado = new ControllerAcoesChamado;
    $acao_chamado->autorizaPropagacao($_POST['idChamado'], $_SESSION['nome_usuario']);
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['propaga_apos_autorizar'])) {
    $acao_chamado = new ControllerAcoesChamado;
    $acao_chamado->finalizaChamado($_POST['idChamado']);
}