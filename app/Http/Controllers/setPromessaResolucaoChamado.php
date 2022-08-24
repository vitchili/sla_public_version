<?php
        session_start();
        date_default_timezone_set('America/Sao_Paulo');
        $idChamado = $_POST['idChamado'];
        $responsavel = $_POST['responsavel'];
        $data_promessa = $_POST['data_promessa'];
        require_once __DIR__ . '/../../Models/queries/GetChamadosSLA.php';
        $objUserResponsavel = new GetChamadosSLA;
        $usuarioResponsavel = $objUserResponsavel->getIdUsuarioPeloNome($responsavel);
        require_once __DIR__ . '/../../Models/queries/SetResponsavelChamadosSLA.php';
        $s2 = new SetResponsavelChamadosSLA;
        $s2->prometeIntimaCorrecao($idChamado, $usuarioResponsavel[0]['id'], $data_promessa);
?>