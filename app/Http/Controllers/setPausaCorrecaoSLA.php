<?php
        session_cache_expire(180000);
        session_start();
        $idChamado = $_POST['idChamado'];
        $cargo = $_POST['cargo'];
        $colaborador = $_SESSION['nome_usuario'];
        require_once __DIR__ . '/../../Models/queries/SetResponsavelChamadosSLA.php';
        $s2 = new SetResponsavelChamadosSLA;
        $s2->setPausaCorrecao($idChamado, $colaborador, $cargo);
?>