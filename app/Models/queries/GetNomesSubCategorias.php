<?php
class GetNomesSubCategorias{
    public function __construct(){

    }
    public function getNomesSubCategorias($categoria){
        require_once __DIR__ . '/../../../database/connection.php';
        $sql = "SELECT id,subcategoria,nome_arquivo_manual,codigo_vimeo FROM tb_subcategoria SUB WHERE categoria = ('$categoria') AND status = '1' ORDER BY CAST(SUB.produto AS UNSIGNED), SUB.categoria, CAST(SUBSTRING_INDEX(SUB.id_subcategoria,'.',-1) AS UNSIGNED);";
        $resultado = select($sql);
        return $resultado;
    }
    public function getAllNomesSubCategoriasIndex($produto){ //puxa todas subcategorias, retornadas a partir do index, sem filtro de categoria
        require_once __DIR__ . '/../../../database/connection.php';
        $sql = "SELECT id,categoria,id_subcategoria,subcategoria,nome_arquivo_manual,codigo_vimeo FROM tb_subcategoria SUB WHERE produto = '$produto' AND status = '1' ORDER BY CAST(SUB.produto AS UNSIGNED), SUB.categoria, CAST(SUBSTRING_INDEX(SUB.id_subcategoria,'.',-1) AS UNSIGNED);";
        $resultado = select($sql);
        return $resultado;
    }
}
?>