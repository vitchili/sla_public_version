<?php require_once '../../../../inc/header.php';?> 
<div class="blocoBody">
        <section class="white-section-card-100" id="white-section">
            <div id="manual">    
                <div class="bloco-titulo">
                    <h1 class="titulo-card">Manuais</h1>
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
                    <i class="far fa-file-pdf icon-left fa-2x"></i>
                    </div>
                    <div class="sub-bloco">
                        <h2 class="sub-titulo-card">Manual completo dos módulos do sistema</h2>
                        <p class="p-card">Busque aqui por funcionalidades e passo a passo do sistema.</p>
                    </div>
                    <div class="sub-bloco">
                        &nbsp;
                    </div>
                    <div class="sub-bloco">
                        <i class="far fa-user-circle fa-2x icon-left"></i>
                    </div>
                    <div>
                        <p class="p-card" style="color: #515151;"><br/>por Administrador <br/>20/04/2022 às 00:00</p>
                    </div>
                </div>
            </div>
            <div class="bloco-titulo-toggle">
                <a class="btn-toggle" data-toggle="collapse" href="#modulo1" role="button" aria-expanded="false" aria-controls="collapseExample">
                    <span>CRM</span>
                </a>&nbsp;
                <a class="btn-toggle" id="modulo2" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                    <span>Portal de Negociação</span>
                </a>&nbsp;
                <a class="btn-toggle"  id="modulo3" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                    <span>Robôs</span>
                </a>&nbsp;
                <a class="btn-toggle" id="modulo4" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                    <span>Serviços Terceiros</span>
                </a>&nbsp;
            </div>
            <br/>
        </section>

        <section class="white-section-card-100" id="white-section2">    
            
            <div class="collapse" id="modulo1">
                <div class="card card-body">
                   <object data="/suporte-aquicob/storage/app/capitulos_manual/manual_crm.pdf"  type="application/pdf" width="100%" height="1200px">
                        <embed data="/suporte-aquicob/storage/app/capitulos_manual/manual_crm.pdf"  type="application/pdf">
                    </object>
                </div>
            </div>
        </section>
<?php require_once '../../../../inc/footer.php';?>
