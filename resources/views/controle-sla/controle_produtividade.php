<?php require_once __DIR__ . '/../../../app/Http/Controllers/SlaController.php';
$objRegistros = new SlaController;
if(isset($_GET['user']) && $_SESSION['administrador'] == 'S'){
    $userRegistro = $_GET['user'];
}else{
    $userRegistro = $_SESSION['nome_usuario'];
}
$registrosOntem = $objRegistros->getRegistrosDiarios($userRegistro, 'ontem');
$registrosHoje = $objRegistros->getRegistrosDiarios($userRegistro, 'hoje');
$promessasOntem = $objRegistros->getPromessasDiarias($userRegistro, 'ontem');
$promessasHoje = $objRegistros->getPromessasDiarias($userRegistro, 'hoje');
$promessasPosteriores = $objRegistros->getPromessasDiarias($userRegistro, 'futuro');
?>

<br/>
<section class="white-section-card-100" id="white-section2">
    <div id="manual">    
        <div class="bloco-titulo">
            <h1 class="titulo-card" style="margin-bottom: 0px;">Registro de log no sistema </h1>
        </div>
        <div class="bloco-geral">    
            <div class="sub-bloco">
                <i class="far fa-folder icon-left fa-2x"></i>
            </div>
            <div class="sub-bloco">
                <h2 class="sub-titulo-card">Controle de interações</h2>
                <p class="p-card">Todas interações no sistema poderão ser visualizadas e registradas por aqui.</p>
            </div>
            <div class="sub-bloco">
                &nbsp;
            </div>
            <div class="sub-bloco">
                &nbsp;
            </div>
            <div class="sub-bloco" style="margin-right: 50px;">
                &nbsp;
            </div>
        </div>    
    </div>
</section>
<section style="display: grid; grid-template-columns: 30fr 1fr 30fr 1fr 30fr">
    <div>
        <section class="white-section-card-100">
            <div class="bloco-titulo">
                <h1 class="titulo-card" style="margin-bottom: 0px;">Ontem</h1>
            </div>
            <div class="bloco-titulo">
                <h1 class="titulo-card" style="margin-bottom: 0px;">Registros de tarefas</h1>
            </div>
                <table id="registros_ontem" class="display" style="position: relative; width:100%;">
                    <thead style="background-color: #f3f3f3;">
                        <tr>
                            <th>Data</th>
                            <th>Resumo</th>
                        </tr>
                    </thead>
                    <?php
                    for($i=0;$i<count($registrosOntem);$i++){
                        $dataHoraAtendimento[$i] = (new DateTime($registrosOntem[$i]['cadastrado_em']))->format('H:i:s');
                        echo "
                        <tr>
                            <td>".$dataHoraAtendimento[$i]."</td>
                            <td style=\"word-break: break-all; max-width:470px;\">".$registrosOntem[$i]['resumo']."</td>
                    </tr>
                    ";
                    }
                    ?>
                </table>
        </section>
        <section class="white-section-card-100" style="background-color: #F5F5F5;">
        <div class="bloco-titulo">
                    <h1 class="titulo-card" style="margin-bottom: 0px;">Previstas para ontem</h1>
                </div>
                <table id="promessas_ontem" class="display" style="position: relative; width:100%; background-color: #F5F5F5;">
                    <thead style="background-color: #f3f3f3;">
                        <tr>
                            <th>Chamado</th>
                            <th>Solicitante da promessa</th>
                            <th>Resolvido</th>
                        </tr>
                    </thead>
                    <?php
                    for($i=0;$i<count($promessasOntem);$i++){
                        echo "
                        <tr>
                            <td>".$promessasOntem[$i]['id_referencia']."</td>
                            <td>".$promessasOntem[$i]['solicitante']."</td>
                            <td>".$promessasOntem[$i]['resolvido']."</td>
                    </tr>
                    ";
                    }
                    ?>
                </table>
        </section>
    </div>
    <div>&nbsp;</div>
    <div>
        <section class="white-section-card-100">
            <div class="bloco-titulo">
                <h1 class="titulo-card" style="margin-bottom: 0px;">Hoje</h1>
            </div>
            <div class="bloco-titulo">
                <h1 class="titulo-card" style="margin-bottom: 0px;">Registros de tarefas</h1>
            </div>
                <table id="registros_hoje" class="display" style="position: relative; width:100%;">
                    <thead style="background-color: #f3f3f3;">
                        <tr>
                            <th>Data</th>
                            <th>Resumo</th>
                        </tr>
                    </thead>
                    <?php
                    for($i=0;$i<count($registrosHoje);$i++){
                        $dataHoraAtendimento[$i] = (new DateTime($registrosHoje[$i]['cadastrado_em']))->format('H:i:s');
                        echo "
                        <tr>
                            <td>".$dataHoraAtendimento[$i]."</td>
                            <td  style=\"word-break: break-all; max-width:470px;\">".$registrosHoje[$i]['resumo']."</td>
                    </tr>
                    ";
                    }
                    ?>
                </table>
        </section>
        <section class="white-section-card-100" style="background-color: #F5F5F5;">
            <div class="bloco-titulo">
                    <h1 class="titulo-card" style="margin-bottom: 0px;">Previstas para hoje</h1>
                </div>
                <table id="promessas_hoje" class="display" style="position: relative; width:100%; background-color: #F5F5F5;">
                    <thead style="background-color: #f3f3f3;">
                        <tr>
                            <th>Chamado</th>
                            <th>Solicitante da promessa</th>
                            <th>Resolvido</th>
                        </tr>
                    </thead>
                    <?php
                    for($i=0;$i<count($promessasHoje);$i++){
                        echo "
                        <tr>
                            <td>".$promessasHoje[$i]['id_referencia']."</td>
                            <td>".$promessasHoje[$i]['solicitante']."</td>
                            <td>".$promessasHoje[$i]['resolvido']."</td>
                    </tr>
                    ";
                    }
                    ?>
                </table>
        </section>
    </div>
    
    <div>&nbsp;</div>
    <div>
        <section class="white-section-card-100" style="background-color: #F5F5F5;">
            <div class="bloco-titulo">
                <h1 class="titulo-card" style="margin-bottom: 0px;">Posterior</h1>
            </div>
            <div class="bloco-titulo">
                <h1 class="titulo-card" style="margin-bottom: 0px;">Promessas de correção</h1>
            </div>
            <table id="promessas_posteriores" class="display" style="position: relative; width:100%; background-color: #F5F5F5;">
                <thead style="background-color: #f3f3f3;">
                    <tr>
                        <th>Chamado</th>
                        <th>Solicitante da promessa</th>
                        <th>Prometido para</th>
                        <th>Promessa feita em</th>
                    </tr>
                </thead>
                <?php
                for($i=0;$i<count($promessasPosteriores);$i++){
                    $dataHora[$i] = (new DateTime($promessasPosteriores[$i]['data_promessa']))->format('d-m-Y');
                    $dataHoraPromessa[$i] = (new DateTime($promessasPosteriores[$i]['cadastrado_em']))->format('d-m-Y');
                    echo "
                    <tr>
                        <td>#".$promessasPosteriores[$i]['id_referencia']."</td>
                        <td>".$promessasPosteriores[$i]['solicitante']."</td>
                        <td>".$dataHora[$i]."</td>
                        <td>".$dataHoraPromessa[$i]."</td>
                </tr>
                ";
                }
                ?>
            </table> 
    </div>
    
</section>
<script>
$(document).ready( function () {
    var table = $('#registros_ontem').DataTable({
        "paging":   true,
        "ordering": true,
        "info":     false,
        "order": [[ 0, 'desc' ]],
        "pagingType": "full_numbers",
        "language": {
            "lengthMenu": "",
            "zeroRecords": "Nenhum item encontrado",
            "info": "PÃ¡gina _PAGE_ de _PAGES_",
            "infoEmpty": "Nenhum item encontrado",
            "infoFiltered": "(filtered from _MAX_ total records)",
            "search" : "Pesquisa"
        }

    });
    table.buttons().container()
        .appendTo( '#example_wrapper .col-sm-6:eq(0)' );
} );
$(document).ready( function () {
    var table = $('#registros_hoje').DataTable({
        "paging":   true,
        "ordering": true,
        "info":     false,
        "order": [[ 0, 'desc' ]],
        "pagingType": "full_numbers",
        "language": {
            "lengthMenu": "",
            "zeroRecords": "Nenhum item encontrado",
            "info": "PÃ¡gina _PAGE_ de _PAGES_",
            "infoEmpty": "Nenhum item encontrado",
            "infoFiltered": "(filtered from _MAX_ total records)",
            "search" : "Pesquisa"
        }

    });
    table.buttons().container()
        .appendTo( '#example_wrapper .col-sm-6:eq(0)' );
} );
$(document).ready( function () {
    var table = $('#promessas_ontem').DataTable({
        "paging":   true,
        "ordering": true,
        "info":     false,
        "order": [[ 0, 'desc' ]],
        "pagingType": "full_numbers",
        "language": {
            "lengthMenu": "",
            "zeroRecords": "Nenhum item encontrado",
            "info": "PÃ¡gina _PAGE_ de _PAGES_",
            "infoEmpty": "Nenhum item encontrado",
            "infoFiltered": "(filtered from _MAX_ total records)",
            "search" : "Pesquisa"
        }

    });
    table.buttons().container()
        .appendTo( '#example_wrapper .col-sm-6:eq(0)' );
} );
$(document).ready( function () {
    var table = $('#promessas_hoje').DataTable({
        "paging":   true,
        "ordering": true,
        "info":     false,
        "order": [[ 0, 'desc' ]],
        "pagingType": "full_numbers",
        "language": {
            "lengthMenu": "",
            "zeroRecords": "Nenhum item encontrado",
            "info": "PÃ¡gina _PAGE_ de _PAGES_",
            "infoEmpty": "Nenhum item encontrado",
            "infoFiltered": "(filtered from _MAX_ total records)",
            "search" : "Pesquisa"
        }

    });
    table.buttons().container()
        .appendTo( '#example_wrapper .col-sm-6:eq(0)' );
} );
$(document).ready( function () {
    var table = $('#promessas_posteriores').DataTable({
        "paging":   true,
        "ordering": true,
        "info":     false,
        "order": [[ 0, 'desc' ]],
        "pagingType": "full_numbers",
        "language": {
            "lengthMenu": "",
            "zeroRecords": "Nenhum item encontrado",
            "info": "PÃ¡gina _PAGE_ de _PAGES_",
            "infoEmpty": "Nenhum item encontrado",
            "infoFiltered": "(filtered from _MAX_ total records)",
            "search" : "Pesquisa"
        }

    });
    table.buttons().container()
        .appendTo( '#example_wrapper .col-sm-6:eq(0)' );
} );
</script>