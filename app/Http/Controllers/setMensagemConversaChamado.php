<?php
        session_start();
        $idChamado = $_POST['idChamado'];
        $mensagem = $_POST['mensagem'];

        $msg_tratada =  str_replace("'", "\\'", $mensagem);
        $msg_tratada =  str_replace("\"", "\\'", $msg_tratada);
        require_once __DIR__ . '/SlaController.php';
        $objAutor = new SlaController;
        $id_autor = $objAutor->getIdUsuarioLogado();
        require_once __DIR__ . '/../../Models/queries/SetResponsavelChamadosSLA.php';
        $insertMensagemChamado = new SetResponsavelChamadosSLA;
        $insertMensagemChamado->insertMensagemChamado($idChamado,$msg_tratada, $id_autor[0]['id']); 
        
?>