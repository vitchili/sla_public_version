<?php require_once '../../../inc/header.php';?>
    <div class="blocoBody">
        <section class="white-section-card-100" id="white-section2">
            <div id="manual">    
                <div class="bloco-titulo">
                    <h1 class="titulo-card">Manuais e Videoaulas</h1>
                </div>
                <div class="bloco-geral">    
                    <div class="sub-bloco">
                        <i class="far fa-file-pdf icon-left fa-2x"></i>
                    </div>
                    <div class="sub-bloco">
                        <a href="./manuais/geral-manuais.php">
                            <h2 class="sub-titulo-card">Manual e videoaulas dos módulos do sistema</h2>
                            <p class="p-card">Busque aqui por funcionalidades e passo a passo do sistema.</p>
                        </a>
                        <div class="modulos-manual">
                            <button data-toggle="collapse" class="modulosManual" data-toggle="collapse" data-target="#divModulo" aria-expanded="false" aria-controls="collapseExample">
                                <a class="btn-toggle" id="modulo1" href="?produto=1">CRM AquiCob</a>
                            </button>
                            <button data-toggle="collapse" class="modulosManual" data-toggle="collapse" data-target="#divModulo" aria-expanded="false" aria-controls="collapseExample">
                                <a class="btn-toggle" id="modulo2" href="?produto=2">Portal Negociação</a>
                            </button>
                            <button data-toggle="collapse" class="modulosManual" data-toggle="collapse" data-target="#divModulo" aria-expanded="false" aria-controls="collapseExample">
                                <a class="btn-toggle" id="modulo3" href="?produto=3">Robôs</a>
                            </button>
                            <button data-toggle="collapse" class="modulosManual" data-toggle="collapse" data-target="#divModulo" aria-expanded="false" aria-controls="collapseExample">
                                <a class="btn-toggle" id="modulo4" href="?produto=4">Serviços Terceirizados</a>
                            </button>
                        </div>
                        <br/>
                </div>    
                    <div class="sub-bloco">
                        <?php
                            //busca qt de registro na tb manual
                            require_once __DIR__ . '/../../../app/Http/Controllers/QuantidadePostsDocumentacao.php';
                            $objUserControllerII = new QuantidadePostsDocumentacao;
                            $modulo = '%'; //todos modulos
                            $quantidadeManuais = $objUserControllerII->getQuantidadeManual();    
                            echo "<h2 class=\"sub-titulo-card\">" . $quantidadeManuais . "</h2>";
                        ?>
                        <p class="p-card">capítulos</p>
                    </div>
                    <div class="sub-bloco">
                        <i class="far fa-user-circle fa-2x icon-left"></i>
                    </div>
                    <div>
                        <p class="p-card dommus-assign" style="color: #515151;"><br/>Suporte Aquicob <br/>Att. em 01/01/2021</p>
                    </div>
                </div>
            </div>
            <hr/>
                   <?php
                    include './categoriasdiversas.php';
                   ?>
        </section>
        <section class="white-section-card-100" id="white-section3">
            <div id="manual">    
                <div class="bloco-titulo">
                    <h1 class="titulo-card">FAQ - Perguntas frequentes</h1>
                </div>
                <div class="bloco-geral">    
                    <div class="sub-bloco">
                        <i class="far fa-question-circle icon-left fa-2x"></i>
                    </div>
                    <div class="sub-bloco">
                    <a href="./faq/geral-faq.php">
                        <h2 class="sub-titulo-card">Perguntas frequentes</h2>
                        <p class="p-card">Esclareça algumas dúvidas frequentes do sistema.</p>
                    </a>    
                    </div>
                    <div class="sub-bloco">
                        <?php
                        //busca qt de registro na tb topico
                        require_once __DIR__ . '/../../../app/Http/Controllers/QuantidadePostsDocumentacao.php';
                        $objUserController = new QuantidadePostsDocumentacao;
                        $quantidadeFAQ = $objUserController->getQuantidadePostsFAQ();    
                        echo "<h2 class=\"sub-titulo-card\">" . $quantidadeFAQ . "</h2>";
                        ?>
                        <p class="p-card">posts</p>
                    </div>
                    <div class="sub-bloco">
                        <i class="far fa-user-circle fa-2x icon-left"></i>
                    </div>
                    <div>
                        <p class="p-card dommus-assign" style="color: #515151;"><br/>Suporte Aquicob <br/>Att. em 01/01/2021</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="white-section-card-100" id="white-section4">
            <div id="manual">    
                <div class="bloco-titulo">
                    <h1 class="titulo-card">Novidades</h1>
                </div>
                <div class="bloco-geral">    
                    <div class="sub-bloco">
                        <i class="far fa-bell icon-left fa-2x"></i>
                    </div>
                    <div class="sub-bloco">
                    <a href="./novidades/novidades.php">
                        <h2 class="sub-titulo-card">Novidades</h2>
                        <p class="p-card">Novas funcionalidades do sistema.</p>
                    </a>
                    </div>
                    <div class="sub-bloco">
                        &nbsp;
                    </div>
                    <div class="sub-bloco">
                        <i class="far fa-user-circle fa-2x icon-left"></i>
                    </div>
                    <div>
                        <p class="p-card dommus-assign" style="color: #515151;"><br/>Suporte Aquicob <br/>Att. em 01/01/2021</p>
                    </div>
                </div>
            </div>
        </section>
<?php require_once '../../../inc/footer.php';?>