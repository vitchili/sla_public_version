<?php
        session_cache_expire(180000);
        session_start();
        $idChamado = $_POST['idChamado'];
        require_once __DIR__ . '/../../Models/queries/SetResponsavelChamadosSLA.php';
        $insertSwitchCase = new SetResponsavelChamadosSLA;
        $insertSwitchCase->insertSwitchCase($idChamado,$_POST);
        
?>