<?php require_once '../../../inc/header.php';?>
    <div class="blocoBody">
        <section class="white-section-card-100" id="white-section1">
            <div id="manual">    
                <div class="bloco-titulo">
                    <h1 class="titulo-card" style="margin-bottom: 0px;">Gestão de Diário</h1>
                </div>
                <div class="bloco-geral">    
                    <div class="sub-bloco">
                        <i class="far fa-clock icon-left fa-2x"></i>
                    </div>
                    <div class="sub-bloco">
                        <h2 class="sub-titulo-card">Registro de atendimentos e demandas realizadas</h2>
                        <p class="p-card">Controle de atendimentos diversos e tarefas diárias.</p>
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
                                <button id="botaoNovoInformativo" class="btn btn-dommus-action  copy-content" type="button" name="button" data-html="true" data-original-title="" data-toggle="modal" data-target=".registro_atendimentos"><i class="fas fa-plus-circle"></i>&nbsp;Registrar Tarefa</button>
                        </form>
                    </div>
                </div>    
            </div>
        </section>
        <!--MODAL -->
        <div class="modal fade registro_atendimentos" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header" >
                            <h5 class="titulo-card" style="padding: 0px;" id="exampleModalLabel">Registro de atendimentos</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        
                        <?php include './cadastroNovoRegistroSuporte.php' ?>
                    </div>
                </div>
        </div>
        
        <!-- FIM MODAL -->
        <?php

if($_SESSION['administrador'] == 'S'){
    echo "
    <div class=\"white-section-card-100\" style=\"padding: 20px; text-align:left;\">
        <form method=\"get\">
            <label for=\"user\" class=\"p-card-bold div-form-google\"> Funcionário: </label>
            <select name=\"user\" id=\"user\" class=\"form-control-flex\" style=\"cursor: pointer;\">";
                require_once __DIR__ . '/../../../app/Http/Controllers/SlaController.php';
                $funcionarios = new SlaController;
                $dados_funcionarios = $funcionarios->getNomeFuncionarios();
                if(isset($_GET['user']) && $_GET['user'] != ''){
                    echo "<option value=\"".$_GET['user']."\" selected>".$_GET['user']."</option>";
                }else{
                    echo "<option value=\"\" disabled selected>-- Selecione o funcionário --</option>";
                }
                
                echo "<option value=\"\">Todos</option>";
                for($i=0;$i<count($dados_funcionarios);$i++){
                    echo "<option value=\"".$dados_funcionarios[$i]['nome']."\">".$dados_funcionarios[$i]['nome']."</option>";
                }
                $dataI = isset($_GET['data_inicial']) ? $_GET['data_inicial'] : '';
                $dataF = isset($_GET['data_final']) ? $_GET['data_final'] : '';
            echo "
            </select>
            <label for=\"data_incial\" class=\"p-card-bold div-form-google\"> Data Inicial: </label>
            <input type=\"date\" class=\"form-control-flex\" name=\"data_inicial\" id=\"data_inicial\" value=\"".$dataI."\">
            <label for=\"data_incial\" class=\"p-card-bold div-form-google\"> Data Final: </label>
            <input type=\"date\" class=\"form-control-flex\" name=\"data_final\" id=\"data_final\" value=\"". $dataF."\">
            
            <button style=\"cursor: pointer;\" class=\"form-control-flex\" type=\"submit\" data-html=\"true\" data-original-title=\"\"><i class=\"fas fa-filter\"></i>&nbsp;Pesquisar</button>

        </form>
    </div>";
}
?>
<br/>
        <div>
            <table id="registros_suporte" class="display" style="position: relative; width:100%;">
                <thead style="background-color: #f3f3f3;">
                    <tr>
                        <th colspan="9" id="registros_info"></th>
                    </tr>
                    <tr>
                        <th>ID</th>
                        <th>Data</th>
                        <th>Funcionário</th>
                        <th>Cliente</th>
                        <th>Solicitante</th>
                        <th>Assunto</th>
                        <th>Resumo</th>
                        <th>Resolvido</th>
                        <th>Abrir chamado</th>
                    </tr>
                </thead>
                <?php
                require_once __DIR__ . '/../../../app/Http/Controllers/SlaController.php';
                $suporte = new SlaController;
                if($_SESSION['cargo'] != 'ADM'){
                    $atendimentos = $suporte->atendimentosSuporte($_SESSION['nome_usuario']);
                }else{
                    $userPesquisa = isset($_GET['user']) ? $_GET['user'] : '';
                    $data_inicial = isset($_GET['data_inicial']) ? $_GET['data_inicial'] : ''; 
                    $data_final = isset($_GET['data_final']) ? $_GET['data_final'] : ''; 
                    $atendimentos = $suporte->todosAtendimentosSuporte($userPesquisa, $data_inicial, $data_final);
                }
                for($i=0;$i<count($atendimentos);$i++){
                    $dataHoraAtendimento[$i] = (new DateTime($atendimentos[$i]['cadastrado_em']))->format('d/m/Y H:i:s');
                    echo "
                    <tr>
                        <td>".$atendimentos[$i]['id']."</td>
                        <td>".$dataHoraAtendimento[$i]."</td>
                        <td>".$atendimentos[$i]['usuario']."</td>
                        <td>".$atendimentos[$i]['cliente']."</td>
                        <td>".$atendimentos[$i]['solicitante_externo']."</td>
                        <td>".$atendimentos[$i]['assunto']."</td>
                        <td>".$atendimentos[$i]['resumo']."</td>
                        <td>".$atendimentos[$i]['resolvido']."</td>
                        <td>&nbsp;<button type=\"button\" onclick=\"abrirChamadoPeloDiario('".$atendimentos[$i]['id_cliente']."','".$atendimentos[$i]['id_usuario']."','".$atendimentos[$i]['assunto']."','".$atendimentos[$i]['resumo']."');\" style=\"cursor: pointer; background-color: #FFE230; border-radius: 3px; border: none;\"><i style=\"color: #fff\" class=\"fas fa-thumbtack\"></i></button></td>
                    </tr>
                ";
                }
                ?>
            </table>
        </div>
<?php require_once '../../../inc/footer.php';?>

<script>
$(document).ready( function () {
    var table = $('#registros_suporte').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'csv'
        ],
        "paging":   true,
        "ordering": true,
        "order": [[ 0, 'desc' ]],
        "pagingType": "full_numbers",
        "language": {
            "lengthMenu": "Mostrando _MENU_ registros por página",
            "zeroRecords": "Nenhum item encontrado",
            "info": "Página _PAGE_ de _PAGES_",
            "infoEmpty": "Nenhum item encontrado",
            "infoFiltered": "(filtered from _MAX_ total records)",
        }

    });
    table.buttons().container()
        .appendTo( '#example_wrapper .col-sm-6:eq(0)' );
    var info = table.page.info();
    $('#registros_info').html('Total de registros: ' + info.recordsTotal);
} );


</script>