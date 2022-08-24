<?php
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL ^ E_STRICT ^ E_DEPRECATED);
        require_once __DIR__ . '/../../Models/queries/Novidade.php';
        $assunto = $_POST['assunto'];
        $corpoNovidade = $_POST['corpo'];

        $n1 = new Novidade();
        $n1->newNovidade($assunto, $corpoNovidade);
        header("Location: /suporte-aquicob/resources/views/documentacao/novidades/novidades.php");
?>