<?php 
if(isset($_GET['nome']) && isset($_GET['empresa']) && isset($_GET['token'])){
    //faz um if de consultar token aqui dps.
    session_start();
    $_SESSION['cargo'] = 'USR';
    $_SESSION['id'] = '0';
    $_SESSION['token'] = $_GET['token'];
    $_SESSION['logged'] = true;
    $_SESSION['nome_usuario'] = utf8_encode($_GET['nome']);
    $empresa = $_GET['empresa'];
    $_SESSION['empresa'] = $empresa;
    $_SESSION['email'] = $_GET['email'];
    
    require_once __DIR__ . '/../../../../app/Http/Controllers/ControllerDocumentacaoChamados.php';
    require_once __DIR__ . '/../../../../app/Http/Controllers/SlaController.php';
    $chamadosAbertosEmpresa = new ControllerDocumentacaoChamados; // cargo baixo ve apenas os chamados abertos por ele. adm ve todos da empresa.
    if(!isset($_GET['idChamadoPesquisa'])){
        $chamadosAbertos = $chamadosAbertosEmpresa->getChamadosAbertosPorEmpresa($empresa, "banco");
    }else{
        $chamadosAbertos = $chamadosAbertosEmpresa->getChamadosAbertosPorEmpresa($empresa, "banco", $_GET['idChamadoPesquisa'], $_GET['data_inicial'], $_GET['data_final']);
    }
}
require_once '../../../../inc/header.php';?>
    <div class="blocoBody">
    <section class="white-section-card-100" id="white-section2">
            <div id="manual">    
                <div class="bloco-titulo">
                    <h1 class="titulo-card" style="margin-bottom: 0px;">Chamados Gerais</h1>
                </div>
                <div class="bloco-geral">    
                    <div class="sub-bloco">
                        <i class="far fa-clock icon-left fa-2x"></i>
                    </div>
                    <div class="sub-bloco">
                        <h2 class="sub-titulo-card">Visualização e acompanhamento de chamados do Suporte</h2>
                        <p class="p-card">Confira os chamados por status.</p>
                    </div>
                    <div class="sub-bloco">
                        &nbsp;
                    </div>
                    <div class="sub-bloco">
                        &nbsp;
                    </div>
                    <div class="sub-bloco" style="margin-right: 50px;">
                        <form action="#" method="GET">
                                <br/>
                                <button id="botaoNovoInformativo" class="btn btn-dommus-action  copy-content" type="button" name="button" data-html="true" data-original-title="" data-toggle="modal" data-target=".cliente_abre_chamado"><i class="fas fa-plus-circle"></i>&nbsp;Abrir Chamado</button>
                        </form>
                    </div>
                </div>    
            </div>
        </section>
        <div class="white-section-card-100" style="padding: 20px; text-align:left;">
            <form method="get">
                <input type="hidden" name="nome" value="<?=$_GET['nome'];?>">
                <input type="hidden" name="empresa" value="<?=$empresa;?>">
                <input type="hidden" name="email" value="<?=$_GET['email'];?>">
                <input type="hidden" name="token" value="<?=$_GET['token'];?>">

                <label for="user" class="p-card-bold div-form-google"> Empresa: </label>
                <span><?= $chamadosAbertos[0]['cliente']; ?></span>
                <label for="idChamadoPesquisa" class="p-card-bold div-form-google"> Chamado: </label>
                <input type="text" name="idChamadoPesquisa" id="idChamadoPesquisa" class="form-control-flex" style="width: 80px;">
                <label for="data_incial" class="p-card-bold div-form-google"> Data Inicial: </label>
                <input type="date" class="form-control-flex" name="data_inicial" id="data_inicial" value="<?=$dataI?>">
                <label for="data_incial" class="p-card-bold div-form-google"> Data Final: </label>
                <input type="date" class="form-control-flex" name="data_final" id="data_final" value="<?=$dataF?>">

                </select>
                <button style="cursor: pointer;" class="form-control-flex" type="submit" data-html="true" data-original-title=""><i class="fas fa-filter"></i>&nbsp;Pesquisar</button>
            </form>
        </div>
        <section class="white-section-card-100" id="white-section2">
            <div id="manual">    
                <div class="bloco-titulo">
                    <h1 class="titulo-card" style="margin-bottom: 0px;">Chamados abertos</h1>
                </div>
                <br/>
                <div>
                    <table id="chamados_abertos_visualizacao" class="display" style="position: relative; width:100%;">
                        <thead style="background-color: #f3f3f3;">
                            <tr>
                                <th colspan="9" id="registros_info"></th>
                            </tr>
                            <tr>
                                <th>ID</th>
                                <th>Data Abertura</th>
                                <th>Empresa</th>
                                <th>Solicitante</th>
                                <th>Assunto</th>
                                <th>Status</th>
                                <th>Informações</th>
                            </tr>
                        </thead>
                        <?php
                            for($i=0;$i<count($chamadosAbertos);$i++){
                                $dataHoraAbertura[$i] = (new DateTime($chamadosAbertos[$i]['cadastrado_em']))->format('d/m/Y H:i:s');
                                echo "
                                <tr>
                                    <td>".$chamadosAbertos[$i]['id']."</td>
                                    <td>".$dataHoraAbertura[$i]."</td>
                                    <td>".$chamadosAbertos[$i]['cliente']."</td>
                                    <td>".$chamadosAbertos[$i]['solicitante_externo']."</td>
                                    <td>".$chamadosAbertos[$i]['titulo']."</td>
                                    <td>".$chamadosAbertos[$i]['nome_etapa']."</td>
                                    <td style='text-align: center'><button id=\"botao_informacoes".$chamadosAbertos[$i]['id']."\" class=\"btn btn-dommus-action  copy-content\" type=\"button\" name=\"button\" data-html=\"true\" data-original-title=\"\" data-toggle=\"modal\" data-target=\".bd-example-modal-lg".$chamadosAbertos[$i]['id']."\"><i class=\"far fa-comment\"></i></button></td>
                                </tr>
                                ";
                            
                            include __DIR__ . '/mais_informacoes_chamado_aberto.php';
                            }
                        ?>
                    </table>
                </div>
            </div>
        </section>
        <hr/>
        <section class="white-section-card-100" id="white-section2">
            <div id="manual">    
                <div class="bloco-titulo">
                    <h1 class="titulo-card" style="margin-bottom: 0px;">Chamados finalizados</h1>
                </div>
                <br/>
                <div>
                <table id="chamados_finalizados_visualizacao" class="display" style="position: relative; width:100%;">
                        <thead style="background-color: #f3f3f3;">
                            <tr>
                                <th colspan="9" id="registros_info_fechados"></th>
                            </tr>
                            <tr>
                                <th>ID</th>
                                <th>Data Abertura</th>
                                <th>Empresa</th>
                                <th>Solicitante</th>
                                <th>Assunto</th>
                                <th>Status</th>
                                <th>Informações</th>
                            </tr>
                        </thead>
                        <?php
                            $chamadosFechadosEmpresa = new ControllerDocumentacaoChamados; // cargo baixo ve apenas os chamados abertos por ele. adm ve todos da empresa.
                            if(!isset($_GET['idChamadoPesquisa'])){
                                $chamadosFechados = $chamadosFechadosEmpresa->getChamadosFechadosPorEmpresa($empresa, "banco");
                            }else{
                                $chamadosFechados = $chamadosFechadosEmpresa->getChamadosFechadosPorEmpresa($empresa, "banco", $_GET['idChamadoPesquisa'], $_GET['data_inicial'], $_GET['data_final']);
                            }
                            for($i=0;$i<count($chamadosFechados);$i++){
                                $dataHoraAbertura[$i] = (new DateTime($chamadosFechados[$i]['cadastrado_em']))->format('d/m/Y H:i:s');
                                echo "
                                <tr>
                                    <td>".$chamadosFechados[$i]['id']."</td>
                                    <td>".$dataHoraAbertura[$i]."</td>
                                    <td>".$chamadosFechados[$i]['cliente']."</td>
                                    <td>".$chamadosFechados[$i]['solicitante_externo']."</td>
                                    <td>".$chamadosFechados[$i]['titulo']."</td>
                                    <td>".$chamadosFechados[$i]['nome_etapa']."</td>
                                    <td style='text-align: center'><button id=\"botao_informacoes".$chamadosFechados[$i]['id']."\" class=\"btn btn-dommus-action  copy-content\" type=\"button\" name=\"button\" data-html=\"true\" data-original-title=\"\" data-toggle=\"modal\" data-target=\".bd-example-modal-lg".$chamadosFechados[$i]['id']."\"><i class=\"far fa-comment\"></i></button></td>
                                </tr>
                                ";
                                include __DIR__ . '/mais_informacoes_chamado_fechado.php';

                            }
                        ?>
                    </table>
                </div>
            </div>
        </section>
        <?php require_once '../../../../inc/footer.php';?>
         <!--MODAL -->
         <div class="modal fade bd-example-modal-lg cliente_abre_chamado" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header" >
                            <h5 class="titulo-card" style="padding: 0px;" id="exampleModalLabel">Informativo de Erro</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="conteudo">
                            <?php include __DIR__ . '/../../controle-sla/cadastroNovoBug.php'; ?>
                        </div>
                    </div>
                </div>
        </div>
        
        <!-- FIM MODAL -->

<script>
$(document).ready( function () {
    var table = $('#chamados_abertos_visualizacao').DataTable({
        
        "paging":   true,
        "ordering": true,
        "order": [[ 0, 'desc' ]],
        "pagingType": "full_numbers",
        "language": {
            "lengthMenu": "&nbsp; Mostrando _MENU_ registros por página",
            "zeroRecords": " Nenhum item encontrado",
            "info": " Página _PAGE_ de _PAGES_",
            "infoEmpty":  " Nenhum item encontrado",
            "infoFiltered": "(filtered from _MAX_ total records)",
        }

    });
    table.buttons().container()
        .appendTo( '#example_wrapper .col-sm-6:eq(0)' );
    var info = table.page.info();
    $('#registros_info').html('Total de registros: ' + info.recordsTotal);
} );

$(document).ready( function () {
    var table = $('#chamados_finalizados_visualizacao').DataTable({
        
        "paging":   true,
        "ordering": true,
        "order": [[ 0, 'desc' ]],
        "pagingType": "full_numbers",
        "language": {
            "lengthMenu": "&nbsp; Mostrando _MENU_ registros por página",
            "zeroRecords": " Nenhum item encontrado",
            "info": " Página _PAGE_ de _PAGES_",
            "infoEmpty": " Nenhum item encontrado",
            "infoFiltered": "(filtered from _MAX_ total records)",
        }

    });
    table.buttons().container()
        .appendTo( '#example_wrapper .col-sm-6:eq(0)' );
    var info = table.page.info();
    $('#registros_info_fechados').html('Total de registros: ' + info.recordsTotal);
} );

$(document).ready( function () {
    $('#switch-case').DataTable({
        "paging":   false,
        "ordering": false,
        "info":     false,
        "search": false,
        "language": {
            "lengthMenu": "&nbsp; Mostrando _MENU_ registros por página",
            "zeroRecords": " Nenhum item encontrado",
            "info": "Página _PAGE_ de _PAGES_",
            "infoEmpty": " Nenhum item encontrado",
            "infoFiltered": "(filtered from _MAX_ total records)"
        }

    });

} );
$(document).ready( function () {
    $('#detalhes_chamado').DataTable({
        "paging":   false,
        "ordering": false,
        "info":     false,
        "search": false,
        "language": {
            "lengthMenu": "&nbsp; Mostrando _MENU_ registros por página",
            "zeroRecords": "Nenhum item encontrado",
            "info": "Página _PAGE_ of _PAGES_",
            "infoEmpty": "No records available",
            "infoFiltered": "(filtered from _MAX_ total records)"
        }

    });

} );
$(function(){
    $('#user').change(function(){
        $("#botaoVerChamadosFuncionarios").trigger('click');
    });
});

</script>
