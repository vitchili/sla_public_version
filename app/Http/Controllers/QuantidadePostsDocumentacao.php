<?php
class QuantidadePostsDocumentacao {
    public function __construct(){

    }
    public function getQuantidadePosts(){
        //Essa funcao retorna a quantidade de POSTS do FORUM
        require_once __DIR__ . '/../../Models/queries/GetQuantidadePosts.php';
        $infos = new GetQuantidadePosts;
        $quantidadePosts = $infos->getQuantidadePosts();
        return $quantidadePosts;
    }
    public function getQuantidadePostsFAQ(){ 
        require_once __DIR__ . '/../../Models/queries/GetQuantidadePosts.php';
        $infos = new GetQuantidadePosts;
        $quantidadePosts = $infos->getQuantidadePostsFAQ();
        return $quantidadePosts;
    }
    public function getQuantidadeManual(){
        //Essa funcao retorna a quantidade de CAPITULOS do MANUAL
        require_once __DIR__ . '/../../Models/queries/GetQuantidadePosts.php';
        $infos = new GetQuantidadePosts;
        $quantidadePosts = $infos->getQuantidadeCapsManual();
        return $quantidadePosts;
    }
    public function getQuantidadeVideos(){
        //Essa funcao retorna a quantidade de VIDEOS do MANUAL VIDEOAULAS
        require_once __DIR__ . '/../../Models/queries/GetQuantidadePosts.php';
        $infos = new GetQuantidadePosts;
        $quantidadeVideos = $infos->getQuantidadeVideos();
        return $quantidadeVideos;
    }
    public function getNomesBaseConhecimento($produto){
        require_once __DIR__ . '/../../Models/queries/GetNomesCategorias.php';
        $infos = new GetNomesCategorias;
        $nomes = $infos->getNomesCategoriasIndex($produto);
        return $nomes;
    }
    public function getNomesPesquisadosBaseConhecimento($produto,$textPesquisado){
        require_once __DIR__ . '/../../Models/queries/GetNomesCategorias.php';
        $infos = new GetNomesCategorias;
        $nomes = $infos->getNomesPesquisadosCategoriasIndex($produto,$textPesquisado);
        return $nomes;
    }
    public function getAllNomesSubCategoriasIndex($produto){
        require_once __DIR__ . '/../../Models/queries/GetNomesSubCategorias.php';
	    $infos = new GetNomesSubCategorias;
	    $listaSubcategorias = $infos->getAllNomesSubCategoriasIndex($produto);
        return $listaSubcategorias;
    }
    public function getAssuntosFAQ(){
        require_once __DIR__ . '/../../Models/queries/GetAssuntosFAQ.php';
        $infos = new GetAssuntosFAQ;
        $listaFAQ = $infos->getNomesAssuntosFAQ();
        return $listaFAQ;
    }
    public function getAssuntosPesquisadosFAQ($textPesquisado){
        require_once __DIR__ . '/../../Models/queries/GetAssuntosFAQ.php';
        $infos = new GetAssuntosFAQ;
        $listaFAQ = $infos->getNomesAssuntosPesquisadosFAQ($textPesquisado);
        return $listaFAQ;
    }
}
?>