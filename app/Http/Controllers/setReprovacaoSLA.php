<?php
        session_cache_expire(180000);
        session_start();
        $idChamado = $_POST['idChamado'];
        require_once __DIR__ . '/../../Models/queries/SetResponsavelChamadosSLA.php';
        $s2 = new SetResponsavelChamadosSLA;
        $s2->reprovaPropagacao($idChamado);
?>