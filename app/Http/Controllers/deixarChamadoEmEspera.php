<?php
        session_start();
        $idChamado = $_POST['idChamado'];
        $inputModif = $_POST['inputModif'];

        $modif = str_replace("'", "\\'", $inputModif);
        $modif = str_replace("\"", "\\'", $modif);
        
        require_once __DIR__ . '/../../Models/queries/SetResponsavelChamadosSLA.php';
        $s1 = new SetResponsavelChamadosSLA;
        $s1->deixarChamadoEmEspera($idChamado, $modif);
?>