<?php
    class Novidade {
        private $corpoNovidade;
        
        public function __construct(){

        }
        public function newNovidade($assunto, $corpoNovidade){ //a criacao do topico recebe um titulo e um corpo. o titulo sera o titulo do topico, e o corpo sera o primeiro post desse topico
            require_once __DIR__ . '/../../../database/connection.php';
            $sql = "INSERT INTO tb_novidade (titulo, corpo, cadastrado_em, status) 
            VALUES ('$assunto', '$corpoNovidade',  NOW(), '1')";
            insertGeral($sql);
        }
        public function getNovidades(){
            require_once __DIR__ . '/../../../database/connection.php';
            $sql = "SELECT
            N.titulo, 
            N.corpo, 
            N.modulo, 
            N.cadastrado_em
            FROM tb_novidade N
            WHERE N.status = '1';";  
            
            $resultado = select($sql);
            return $resultado;
        }
    }
?>
