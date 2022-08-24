<?php 
    // O collapse so tera a classe show (aparecera aberto)  caso o text-pesquisa estiver settado. isso implica em poder comeÃÂÃÂ§ar a pagina com o collapse fechado, mas ao pesquisar um tema aparece com o collapse aberto
if(!isset($_GET['text-pesquisa']) && !isset($_GET['produto'])){
    echo "<div class=\"collapse\" id=\"divModulo\">";
}else{
    echo "<div class=\"collapse show\" id=\"divModulo\">";
}
$produto = isset($_GET['produto'])? $_GET['produto'] : '';
?> 
    <div class="cards-gerais" id="divModulo">
        <section class="white-section-card-100-invisible">
            <form action="#" method="get">
                <div class="botoes-center-cemPorcento"> 
                    <input class="form-control" type="text" id="text-pesquisa" name="text-pesquisa" placeholder="Pesquisar por assunto existente">
                    <input type="hidden" name="produto" id="produto" value="<?= $produto ?>">
                    <button class="btn btn-outline-primary copy-content" type="submit" data-html="true" data-original-title=""><i class="fas fa-filter"></i>&nbsp;Pesquisar</button>
                </div>
            </form>
        </section>
        <?php
            
            require_once __DIR__ . '/../../../app/Http/Controllers/QuantidadePostsDocumentacao.php'; 
            $objCapitulos = new QuantidadePostsDocumentacao;
            $objSubCategorias = new QuantidadePostsDocumentacao;
            if(!isset($_GET['text-pesquisa'])){    
                $baseConhecimento = $objCapitulos->getNomesBaseConhecimento($produto);
                $baseSubCategorias = $objSubCategorias->getAllNomesSubCategoriasIndex($produto);
            }else{
                $textPesquisado = $_GET['text-pesquisa'];
                $baseConhecimento = $objCapitulos->getNomesPesquisadosBaseConhecimento($produto,$textPesquisado);
                $baseSubCategorias = $objSubCategorias->getAllNomesSubCategoriasIndex($produto);
            }
            for($i=0;$i<count($baseConhecimento);$i++){
                echo"
                <section class=\"white-section-card-100 cards-gerais\">
                    <div class=\"white-section-toggle\">
                        <div>
                            <span class=\"\">".$baseConhecimento[$i]['id_categoria_produto'].". </span>
                            <span class=\"\">".$baseConhecimento[$i]['categoria']."</span>
                        </div>
                        <div class=\"setinha-toggle\">    
                        <a data-toggle=\"collapse\" href=\"#divSubItem".$i."\" role=\"button\" aria-expanded=\"false\" aria-controls=\"collapseExample\">
                            <i class=\"fa fa-chevron-down\"></i>
                        </a>  
                        </div>
                    </div>    
                    <div class=\"collapse\" id=\"divSubItem".$i."\">
                        <hr/>";
                        for($j=0;$j<count($baseSubCategorias);$j++){
                            if($baseSubCategorias[$j]['categoria'] == $baseConhecimento[$i]['id']){
                                echo "
                                <section class=\"white-section-card-100 cards-gerais\">
                                    <div class=\"white-section-toggle\">
                                        <div>
                                            <span class=\"\">".$baseSubCategorias[$j]['id_subcategoria'].". </span>
                                            <span class=\"\">".$baseSubCategorias[$j]['subcategoria'].". </span>
                                        </div>
                                        <div class=\"setinha-toggle\">
                                            <a href=\"./manuais/manual-iframe.php?nomeCapitulo=".$baseSubCategorias[$j]['nome_arquivo_manual']."\" id=\"".$baseSubCategorias[$j]['nome_arquivo_manual']."-pdf\"> 
                                                <img src=\"../../../public/images/pdf-file.svg\" class=\"icon-base-conhecimento\"/>
                                            </a>    
                                            &nbsp;&nbsp;
                                            <a href=\"./videoaulas/videoaulas-iframe.php?codigoVideo=".urlencode($baseSubCategorias[$j]['codigo_vimeo'])."\" id=\"".$baseSubCategorias[$j]['nome_arquivo_manual']."-video\">
                                                <img src=\"../../../public/images/video-file.svg\" class=\"icon-base-conhecimento\"/>
                                            </a>
                                        </div>    
                                </section>
                                ";
                            }
                        }
                echo"</div>
                </section>
                ";
            }
            ?>
    </div>
</div>
