<?php
        session_cache_expire(180000);
        session_start();
        $id = $_POST['id'];
        $nomeResponsavel = $_POST['nomeResponsavel'];
        require_once __DIR__ . '/../../Models/queries/SetResponsavelChamadosSLA.php';
        $s1 = new SetResponsavelChamadosSLA;
        $s1->setResponsavel($id, $nomeResponsavel);
?>