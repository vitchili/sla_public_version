<?php
class GetAssuntosFAQ{
    public function __construct(){

    }
    public function getNomesAssuntosFAQ(){
        require_once __DIR__ . '/../../../database/connection.php';
        $sql = "SELECT id,pergunta,resposta FROM tb_faq WHERE status = '1' ORDER BY top_dez_prioridades DESC LIMIT 10;";
        $resultado = select($sql);
        return $resultado;
    }
    public function getNomesAssuntosPesquisadosFAQ($textPesquisado){
        require_once __DIR__ . '/../../../database/connection.php';
        $sql = "SELECT id,pergunta,resposta FROM tb_faq
        WHERE pergunta LIKE ('%$textPesquisado%') 
        AND status = '1' ORDER BY top_dez_prioridades DESC;";
        $resultado = select($sql);
        return $resultado;
    }
}
?>