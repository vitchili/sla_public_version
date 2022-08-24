<?php require_once '../../../../inc/header.php';?>
    <div class="blocoBody">
        <section class="white-section-card-100" id="white-section">
            <div id="manual">    
                <div class="bloco-titulo">
                    <h1 class="titulo-card">Agenda</h1>
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
                        <i class="far fa-calendar-alt icon-left fa-2x"></i>
                    </div>
                    <div class="sub-bloco">
                        <h2 class="sub-titulo-card">Agenda de consultorias e treinamentos</h2>
                        <p class="p-card">Confira nossa agenda de treinamentos sobre as funcionalidades do sistema!</p>
                    </div>
                    <div class="sub-bloco">
                        &nbsp;
                    </div>
                    <div class="sub-bloco">
                        &nbsp;
                    </div>
                    <div>
                        &nbsp;
                    </div>
                </div>
            </div>
        </section>
        <section class="grid-agenda-form" id="white-section2">    
            <div class="div-agenda">
                <div class="white-section-card-100">
                    <iframe src="https://calendar.google.com/calendar/embed?height=655&amp;wkst=2&amp;bgcolor=%23ffffff&amp;ctz=America%2FSao_Paulo&amp;src=dml0b3J2aWVpcmEyODVAZ21haWwuY29t&amp;color=%237986CB&amp;showTitle=0&amp;showPrint=0&amp;mode=WEEK" style="border-width:0" width="100%" height="655" frameborder="0" scrolling="no"></iframe>
                </div>
            </div>
            <div class="div-form-google">
                <div class="white-section-card-100">
                    <iframe src="https://docs.google.com/forms/d/e/1FAIpQLSc1DF2qau4n4VyV98CJmExfw5KRzYTO7ysCrbzlmOVg9XvU2Q/viewform?embedded=true" width="100%" height="655" frameborder="0" marginheight="0" marginwidth="0">Carregando…</iframe>
                </div>
            </div>
        </section>
<?php require_once '../../../../inc/footer.php';?>