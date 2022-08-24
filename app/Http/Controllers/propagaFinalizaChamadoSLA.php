<?php
        $idChamado = $_POST['idChamado'];
        require_once __DIR__ . '/../../Models/queries/SetResponsavelChamadosSLA.php';
        $s2 = new SetResponsavelChamadosSLA;
        $s2->finalizaChamado($idChamado);
?>