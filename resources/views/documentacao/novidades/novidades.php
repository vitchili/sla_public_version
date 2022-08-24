
    <?php require_once '../../../../inc/header.php';?>
    <div class="blocoBody">
        <section class="white-section-card-100" id="white-section">
            <div id="manual">    
                <div class="bloco-titulo">
                    <h1 class="titulo-card">Novidades</h1>
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
                    <i class="far fa-bell icon-left fa-2x"></i>
                    </div>
                    <div class="sub-bloco">
                        <h2 class="sub-titulo-card">Novidades</h2>
                        <p class="p-card">Novas funcionalidades do sistema.</p>
                    </div>
                    <div class="sub-bloco">
                        &nbsp;
                    </div>
                    <div class="sub-bloco">
                        &nbsp;
                    </div>
                    <div class="sub-bloco">
                        <?php
                        if($_SESSION['administrador'] != 'S'){
                        echo "
                        <form action=\"#\" method=\"GET\">
                                <br/>
                                <button class=\"btn btn-dommus-action  copy-content\" type=\"button\" name=\"button\" data-html=\"true\" data-original-title=\"\" data-toggle=\"modal\" data-target=\".bd-example-modal-lg\"><i class=\"fas fa-plus-circle\"></i>&nbsp;Novidade</button>
                        </form>";
                        }
                    ?>
                    </div>
                </div>
            </div>
        </section>
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header" style="">
                            <h5 class="modal-title" id="exampleModalLabel">Cadastro de Novidade</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="../../../../app/Http/Controllers/setNovidadeController.php" method="POST"> 
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Assunto:</label>
                                    <input type="text" class="form-control" name="assunto" id="recipient-name">
                                </div>
                                    <div class="form-group">
                                    <!--Aqui tera o editor de texto completo. Esse textarea eh provisorio-->
                                        <label for="message-text" class="col-form-label">Novidade:</label>
                                        <textarea name="corpo" id="txtConteudo"></textarea>
                                        <script>CKEDITOR.replace( 'corpo' );</script>
                                    <!--ckeditor fim-->
                                    </div>          
                                </div>
                                <div class="modal-footer">
                                <!--o botao hidden chama uma função onclick para dar tempo de aparecer o alert antes de mandar o action do form. button chama uma função com set Interval, depois submita -->
                                    <input type="submit" id="hiddenBtn">
                                    <button class="btn btn-danger copy-content" type="button" name="button" data-html="true" data-dismiss="modal" aria-label="Close"><i class="fas fa-times-circle"></i>&nbsp;Cancelar</button>
                                    <input type="button" class="btn btn-dommus-action copy-content" name="button" data-html="true" value=" Enviar " id="btn-enviar" onclick="return confirmaAlert()"/>
                                </div>
                            </form>    
                        </div>
                    </div>
                </div>
        <?php
        require_once __DIR__ . '/../../../../app/Http/Controllers/NewsController.php';
        $listaNovidades = new NewsController;
        $novidades = $listaNovidades->mostraNovidades();
        for($i=0;$i<count($novidades);$i++){
            echo "
                <section class=\"white-section-card-100\" id=\"white-section2\">    
                <div id=\"manual\">    
                        <div class=\"bloco-geral\">    
                            <div class=\"sub-bloco\">
                                <i class=\"fas fa-chevron-right icon-left fa-2x\"></i>
                            </div>
                            <div class=\"sub-bloco\">
                                <h2 class=\"sub-titulo-card\">".$novidades[$i]['titulo']."</h2>
                                <p class=\"p-card\">".$novidades[$i]['corpo']."</p>
                            </div>
                            <div class=\"sub-bloco\">
                                &nbsp;
                            </div>
                            <div class=\"sub-bloco\">
                                <i class=\"far fa-user-circle fa-2x icon-left\"></i>
                            </div>
                            <div>
                                <p class=\"p-card\" style=\"color: #515151;\"><br/>Suporte Aquicob <br/>".$novidades[$i]['cadastrado_em']."</p>
                            </div>
                        </div>
                    </div>
                </section>
            ";
        }
        ?>
<?php require_once '../../../../inc/footer.php';?>