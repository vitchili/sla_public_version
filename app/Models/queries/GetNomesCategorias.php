<?php
class GetNomesCategorias{
    public function __construct(){
 
    }
    public function getNomesCategorias($produto){
        require_once __DIR__ . '/../../../database/connection.php';
        $sql = "SELECT id,id_categoria_produto,categoria FROM tb_categoria WHERE produto = ('$produto') AND status = '1' ORDER BY id_categoria_produto;";
        $resultado = select($sql);
        return $resultado;
    }
    public function getNomesCategoriasIndex($produto){ //funcao acima chamada a partir do index
        require_once __DIR__ . '/../../../database/connection.php';
        $sql = "SELECT id,id_categoria_produto,categoria FROM tb_categoria WHERE produto = ('$produto') AND status = '1' ORDER BY id_categoria_produto;";
        $resultado = select($sql);
        return $resultado;
    }
    public function getNomesPesquisadosCategoriasIndex($produto , $textPesquisado){ //funcao acima chamada a partir do index
        require_once __DIR__ . '/../../../database/connection.php';
        $sql = "SELECT id,id_categoria_produto,categoria FROM tb_categoria WHERE produto = ('$produto') AND categoria LIKE ('%$textPesquisado%') AND status = '1';";
        $resultado = select($sql);
        return $resultado;
    }
}
?>