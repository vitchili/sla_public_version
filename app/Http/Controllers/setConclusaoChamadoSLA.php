<?php
        session_cache_expire(180000);
        session_start();
        $idChamado = $_POST['idChamado'];
        $inputModif = $_POST['inputModif'];
        require_once __DIR__ . '/../../Models/queries/SetResponsavelChamadosSLA.php';
        $s2 = new SetResponsavelChamadosSLA;
        if(isset($_POST['tipoFinalizacao']) && $_POST['tipoFinalizacao'] == 'suporte'){
                $s2->concluiSemResolver($idChamado,$inputModif);
        }else if(isset($_POST['tipoFinalizacao']) && $_POST['tipoFinalizacao'] == 'cancelamento'){
                $s2->cancelaChamado($idChamado,$inputModif);
        }
        
?>