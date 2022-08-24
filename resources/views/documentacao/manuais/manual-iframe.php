<?php require_once '../../../../inc/header.php';?> 
    <div class="blocoBody">
        <section class="white-section-card-100">
            <div id="manual">    
                <div class="bloco-titulo">
                    <h1 class="titulo-card">Manuais</h1>
                    <a href="#" onclick="clickVoltar()" class="voltaPagAnterior">
                        <i class="fas fa-arrow-circle-left"></i>
                        <script>
                            function clickVoltar(){
                                window.location.replace(`../index_documentacao.php?text-pesquisa=&button=#`); 
                            }
                        </script>
                    </a>
                </div>
                <div>
                <?php
                    //se receber o nome do capitulo por parametro, mostra ele. senao, mostra o pdf em construcao.
                    if($_GET['nomeCapitulo'] != ""){
                        $nomeCapitulo = $_GET['nomeCapitulo'];
                        $largura = '100';
                        $altura = '900';
                    }else{
                        $nomeCapitulo = "em_construcao.jpg";
                        $altura = '400';
                        $largura = '70';
                    }    
                    echo 
                    "<object data=\"/suporte-aquicob/storage/app/capitulos_manual/". $nomeCapitulo . "\" type=\"application/pdf\" width=\"".$largura."%\" height=\"".$altura."px\">
                        <embed src=\"/suporte-aquicob/storage/app/capitulos_manual/". $nomeCapitulo . "\" type=\"application/pdf\"/>
                    </object>";
                ?>    
                </div>
            </div>
        </section>
<?php require_once '../../../../inc/footer.php';?>