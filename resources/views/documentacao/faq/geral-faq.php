<?php require_once '../../../../inc/header.php';?>
    <div class="blocoBody">
        <section class="white-section-card-100">
            <div id="manual">    
                <div class="bloco-titulo">
                    <h1 class="titulo-card">FAQ - Perguntas Frequentes</h1>
                    <a href="#" onclick="clickVoltar()" class="voltaPagAnterior">
                        <i class="fas fa-arrow-circle-left"></i>
                        <script>
                            function clickVoltar(){
                                window.history.go(-1);
                            }
                        </script>
                    </a>
                </div>
                <div class="bloco-geral">    
                    <div class="sub-bloco">
                    <i class="far fa-question-circle icon-left fa-2x"></i>
                    </div>
                    <div class="sub-bloco">
                        <h2 class="sub-titulo-card">FAQ</h2>
                        <p class="p-card">Esclareça algumas dúvidas frequentes do sistema.</p>
                        <div id="listaTopicosManual"></div>
                        
                        </div>
                    <div class="sub-bloco">
                        &nbsp;
                    </div>
                    <div class="sub-bloco">
                        <i class="far fa-user-circle fa-2x icon-left"></i>
                    </div>
                    <div>
                        <p class="p-card" style="color: #515151;"><br/>por Administrador <br/>20/04/2021 às 00:00</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="white-section-card-100-invisible">
            <form action="#" method="GET">
                <div class="botoes-center-cemPorcento"> 
                    <input class="form-control" type="text" name="text-pesquisa" placeholder="Pesquisar por assunto existente">
                    <button class="btn btn-outline-primary copy-content" type="submit" name="button" data-html="true" data-original-title=""><i class="fas fa-filter"></i>&nbsp;Pesquisar</button>
                    <!-- Button trigger modal -->
                </div>
            </form>
        </section>
        <section class="white-section-card-100">
                <div class="cards-gerais">
                    <?php
                        require_once __DIR__ . '/../../../../app/Http/Controllers/QuantidadePostsDocumentacao.php';
                        $objFAQ = new QuantidadePostsDocumentacao;
                        if(!isset($_GET['text-pesquisa'])){
                            $assuntosFAQ = $objFAQ->getAssuntosFAQ();  
                            echo"<h2 class=\"titulo-card\">Top 10 - Assuntos mais pesquisados</h2>";  
                        }else{
                            $textPesquisa = $_GET['text-pesquisa'];
                            $assuntosFAQ = $objFAQ->getAssuntosPesquisadosFAQ($textPesquisa);
                            echo"<h2 class=\"titulo-card\">".count($assuntosFAQ)." assuntos encontrados para essa pesquisa:</h2>";
                        }        
                        
                        for($i=0;$i<count($assuntosFAQ);$i++){
                            
                            echo"
                            <section class=\"white-section-card cards-gerais\">
                                <div class=\"white-section-toggle\">
                                    <div>
                                        <span class=\"\">".($i+1).") </span>
                                        <span class=\"\">".$assuntosFAQ[$i]['pergunta']."</span>
                                    </div>
                                    <div class=\"setinha-toggle\">    
                                    <a data-toggle=\"collapse\" href=\"#divSubItem".$i."\" role=\"button\" aria-expanded=\"false\" aria-controls=\"collapseExample\">
                                        <i class=\"fa fa-chevron-down\"></i>
                                    </a>  
                                    </div>
                                </div>    
                                <div class=\"collapse\" id=\"divSubItem".$i."\">
                                    <hr/>
                                    <div>
                                        ".($assuntosFAQ[$i]['resposta'])."
                                    </div>
                                </div>
                            </section>
                            ";
                        }                        
                    ?>
                </div>
        </section>
<?php require_once '../../../../inc/footer.php';?>