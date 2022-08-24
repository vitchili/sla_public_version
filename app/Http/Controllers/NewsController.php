<?php
    class NewsController{
        function __construct(){

        }

    function mostraNovidades(){
        require_once __DIR__ . '/../../Models/queries/Novidade.php';
        $infos = new Novidade;
        $listaNovidades = $infos->getNovidades();
        return $listaNovidades;
    }
}

?>