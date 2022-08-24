<?php
class GetQuantidadePosts{
    function __construct(){
        
    }
    function getQuantidadePosts(){
        require_once __DIR__ . '/../../../database/connection.php';
            $sql = "SELECT COUNT(id) FROM tb_topico T WHERE T.status = '1';";
            $resultado = select($sql);
            $count = $resultado[0]['COUNT(id)'];
            return $count;
    }
    function getQuantidadeCapsManual(){
        require_once __DIR__ . '/../../../database/connection.php';
            $sql = "SELECT COUNT(id) FROM tb_categoria C WHERE C.status = '1';";
            $resultado = select($sql);
            $count = $resultado[0]['COUNT(id)'];
            return $count;
    }
    function getQuantidadeVideos(){
        require_once __DIR__ . '/../../../database/connection.php';
            $sql = "SELECT COUNT(id) FROM tb_videoaulas M WHERE M.status = '1';";
            $resultado = select($sql);
            $count = $resultado[0]['COUNT(id)'];
            return $count;
    }
    function getQtRespostas($idTopico){
        require_once __DIR__ . '/../../../database/connection.php';
            $sql = "SELECT qt_respostas FROM tb_topico T WHERE T.id = ('$idTopico') AND T.status = '1';";
            $resultado = select($sql);
            $count = $resultado[0]['qt_respostas'];
            return $count;
    }
    function getQuantidadePostsFAQ(){
        require_once __DIR__ . '/../../../database/connection.php';
            $sql = "SELECT COUNT(id) FROM tb_faq F WHERE F.status = '1';";
            $resultado = select($sql);
            $count = $resultado[0]['COUNT(id)'];
            return $count;
    }
}
?>