<?php
        session_start();
        $idChamado = $_POST['idChamado'];
        
        require_once __DIR__ . '/../../Models/queries/SetResponsavelChamadosSLA.php';
        $s1 = new SetResponsavelChamadosSLA; 
        $s1->reativarChamadoEmEspera($idChamado);
?>