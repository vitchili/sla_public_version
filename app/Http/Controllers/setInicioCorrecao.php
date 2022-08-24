<?php
        session_start();
        $idChamado = $_POST['idChamado'];
        $colaborador = $_SESSION['nome_usuario'];
        $cargo = $_POST['cargo'];
        require_once __DIR__ . '/../../Models/queries/SetResponsavelChamadosSLA.php';
        $s2 = new SetResponsavelChamadosSLA;
        $s2->setInicioCorrecao($idChamado, $colaborador, $cargo);
?>