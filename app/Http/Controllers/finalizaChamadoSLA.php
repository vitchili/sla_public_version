<?php
        session_cache_expire(180000);
        session_start();
        $idChamado = $_POST['idChamado'];
        $inputModif = $_POST['inputModif'];
        $inputBranch = $_POST['inputBranch'];

        $modif = str_replace("'", "", $inputModif);
        $branch = str_replace("'", "", $inputBranch);
        $modif = str_replace("\"", "", $modif);
        $branch = str_replace("\"", "", $branch);

        require_once __DIR__ . '/../../Models/queries/SetResponsavelChamadosSLA.php';
        $s1 = new SetResponsavelChamadosSLA;
        $s1->concluiESolicitaProp($idChamado, $modif, $branch );
?>