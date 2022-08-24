<?php 
require_once '../../../inc/header.php';
require_once __DIR__ . '/../../../app/Http/Controllers/SlaController.php';
$chamadosAbertosFila = new SlaController;
$chamadosAbertos = $chamadosAbertosFila->getChamadosAbertosFilaGeral();
$chamadosNaoFinalizados = $chamadosAbertosFila->getChamadosNaoFinalizadosSLA();
$chamadosEmAndamento = $chamadosAbertosFila->getChamadosEmAndamento();
$chamadosEmTeste = $chamadosAbertosFila->getChamadosConcluidosNPropagados();
$chamadosFinalizados = $chamadosAbertosFila->getTodosChamadosPropagados();
$chamadosRefatoracao = $chamadosAbertosFila->getChamadosRefatoracao();
$chamadosPendentes = $chamadosAbertosFila->getChamadosPendentes();
$chamadosOrcamentoImplantacao = $chamadosAbertosFila->getChamadosOrcamentoImplantacao();
$chamadosAssumidosSLA = new SlaController;
?>
    <div class="blocoBody">
        
        
        
        <section class="white-section-card-100" id="white-section2" style="position: relative;">
            <div id="manual">    
                    <div class="bloco-titulo">
                        <h1 class="titulo-card" style="margin-bottom: 0px;">Dashboard</h1>
                    </div>
                <div class="bloco-geral">    
                    <div class="sub-bloco">
                        <i class="fas fa-search icon-left fa-2x"></i>
                    </div>
                    <div class="sub-bloco">
                        <h2 class="sub-titulo-card">Dashboard organizacional de chamados</h2>
                        <p class="p-card">Controle de fila dos chamados.</p>
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
        <section class="white-section-card-100-invisible">
            <div class="bloco-tickets" style="display:grid; grid-template-columns: 1fr 1fr 1fr 1fr">
                <div>
                    <div class='card-informativo-dashboard'>
                        <div class='icon-ticket'>
                            <i class="fas fa-headset fa-3x" style="color: #fff; margin-top: 20px;"></i>
                        </div>
                        <div >
                            <h2>Aguardando distribuição</h2>
                            <hr/>
                            <h3><?=count($chamadosAbertos);?></h3>
                        </div>
                    </div>
                </div>
                <div>
                    <div class='card-informativo-dashboard'>
                        <div class='icon-ticket'>
                            <i class="fas fa-list-ul fa-3x" style="color: #fff; margin-top: 20px;"></i>
                        </div>
                        <div>
                            <h2>Bugs em correção</h2>
                            <hr/>
                            <h3><?=count($chamadosEmAndamento);?></h3>
                        </div>
                    </div>
                </div>
                <div>
                    <div class='card-informativo-dashboard'>
                        <div class='icon-ticket'>
                            <i class="fas fa-tasks fa-3x" style="color: #fff; margin-top: 20px;"></i>
                        </div>
                        <div>
                            <h2>Em teste</h2>
                            <hr/>
                            <h3><?=count($chamadosEmTeste);?></h3>
                        </div>
                    </div>
                </div>
                <div>
                    <div class='card-informativo-dashboard'>
                        <div class='icon-ticket'>
                            <i class="fas fa-check fa-3x" style="color: #fff; margin-top: 20px;"></i>
                        </div>
                        <div>
                            <h2>Finalizados</h2>
                            <hr/>
                            <h3><?=count($chamadosFinalizados);?></h3>
                        </div>
                    </div>        
                </div>
            </div>
            <div class="bloco-tickets" style="display:none;">
                <div>
                    <div class='card-informativo-dashboard'>
                        <div class='icon-ticket'>
                            <?php echo "
                            <h2 style=\"font-size: 11pt; margin-top: 20px;\">ID: #".$chamadosAbertos[0]['id_chamado']." | Cliente: "
                            .$chamadosAbertos[0]['cliente']." | "
                            .$chamadosAbertos[0]['direcionamento'];?>
                        </div>
                        <div>
                            
                            <hr/>
                            <?php echo "
                            <h2 style=\"font-size: 11pt;\">Descrição: "
                            .$chamadosAbertos[0]['descricao_chamado']."</h2>";?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="white-section-card-100-invisible">
            <div class="bloco-tickets" style="display:grid; grid-template-columns: 1fr 1fr 1fr">
                <div>
                    <div class='card-informativo-dashboard'>
                        <div class='icon-ticket'>
                            <i class="fas fa-industry fa-3x" style="color: #fff; margin-top: 20px;"></i>
                        </div>
                        <div >
                            <h2>Refatoração de funcionalidade</h2>
                            <hr/>
                            <h3><?=count($chamadosRefatoracao);?></h3>
                        </div>
                    </div>
                </div>
                <div>
                    <div class='card-informativo-dashboard'>
                        <div class='icon-ticket'>
                            <i class="fas fa-hourglass-end fa-3x" style="color: #fff; margin-top: 20px;"></i>
                        </div>
                        <div>
                            <h2>Pendentes de aprovação</h2>
                            <hr/>
                            <h3><?=count($chamadosPendentes);?></h3>
                        </div>
                    </div>
                </div>
                <div>
                    <div class='card-informativo-dashboard'>
                        <div class='icon-ticket'>
                            <i class="fas fa-drafting-compass fa-3x" style="color: #fff; margin-top: 20px;"></i>
                        </div>
                        <div>
                            <h2>Em Implantação/ Orçamento</h2>
                            <hr/>
                            <h3><?=count($chamadosOrcamentoImplantacao);?></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bloco-tickets" style="display:none;">
                <div>
                    <div class='card-informativo-dashboard'>
                        <div class='icon-ticket'>
                            <?php echo "
                            <h2 style=\"font-size: 11pt; margin-top: 20px;\">ID: #".$chamadosAbertos[0]['id_chamado']." | Cliente: "
                            .$chamadosAbertos[0]['cliente']." | "
                            .$chamadosAbertos[0]['direcionamento'];?>
                        </div>
                        <div>
                            
                            <hr/>
                            <?php echo "
                            <h2 style=\"font-size: 11pt;\">Descrição: "
                            .$chamadosAbertos[0]['descricao_chamado']."</h2>";?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <br/>
        <div class="white-section-card-100" style="display:grid; grid-template-columns: 1fr 1fr">
            <section>
                <?php include './dashboards/chamados_mensais.php'; ?>
            </section>
            <section>
                <?php include './dashboards/chamados_por_telas.php'; ?>
            </section>
        </div>
        <div class="white-section-card-100" style="display:grid; grid-template-columns: 1fr 1fr">
            <section>
                <?php include './dashboards/chamados_por_colaborador.php';?>
            </section>
            <section>
                <?php include './dashboards/chamados_entregues_por_colaborador.php';?>
            </section>
        </div>
        <div class="white-section-card-100" style="display:grid; grid-template-columns: 1fr 1fr">
            <section>
                <?php include './dashboards/chamados_entregues_por_suporte.php'; ?>
            </section>
            <section>
                <?php include './dashboards/chamados_por_cliente.php'; ?>
            </section>
        </div>    
        <section class="white-section-card-100" id="white-section2">
            <div id="manual">    
                    <div class="bloco-titulo">
                        <h1 class="titulo-card" style="margin-bottom: 0px;">Fila dos chamados</h1>
                    </div>
                <div class="bloco-geral">    
                    <div class="sub-bloco">
                        <i class="fas fa-search icon-left fa-2x"></i>
                    </div>
                    <div class="sub-bloco">
                        <h2 class="sub-titulo-card">Acompanhamento do desenvolvimento</h2>
                    </div>
                    <div class="sub-bloco">
                        &nbsp;
                    </div>
                    <div class="sub-bloco">
                        &nbsp;
                    </div>
                    <div class="sub-bloco">
                        &nbsp;
                    </div>
                </div>    
            </div>
        </section>
        <?php

        if($_SESSION['administrador'] == 'S'){
            echo "
            <div class=\"white-section-card-100\" style=\"padding: 20px; text-align:left;\">
                <form method=\"get\">
                    <select name=\"user\" id=\"user\" class=\"form-control-flex\" style=\"cursor: pointer;\">";
                        require_once __DIR__ . '/../../../app/Http/Controllers/SlaController.php';
                        $funcionarios = new SlaController;
                        $dados_funcionarios = $funcionarios->getNomeFuncionarios();
                        if(isset($_GET['user']) && $_GET['user'] != '%'){
                            echo "<option value=\"".$_GET['user']."\" selected>".$_GET['user']."</option>";
                        }else{
                            echo "<option value=\"\" disabled selected>-- Selecione o funcionário --</option>";
                        }
                        
                        echo "<option value=\"%\">Todos</option>";
                        for($i=0;$i<count($dados_funcionarios);$i++){
                            echo "<option value=\"".$dados_funcionarios[$i]['nome']."\">".$dados_funcionarios[$i]['nome']."</option>";
                        }
                    echo "
                    </select>
                    <select class=\"form-control-flex\" name=\"tipo_filtro\" id=\"tipo_filtro\" style=\"cursor: pointer;\">
                    ";
                    if(isset($_GET['tipo_filtro'])){
                        echo "<option value=\"".$_GET['tipo_filtro']."\" selected>".$_GET['tipo_filtro']."</option>";
                    }else{
                        echo "<option value=\"\" disabled selected>-- Selecione o Filtro --</option>";
                    }
                    echo "
                        <option value=\"Filtro: Todos\">Filtro: Todos</option>
                        <option value=\"Filtro: Chamados abertos hoje\">Filtro: Chamados abertos hoje</option>
                        <option value=\"Filtro: Chamados cancelados\">Filtro: Chamados cancelados</option>
                        <option value=\"Filtro: Chamados em teste\">Filtro: Chamados em teste</option>
                        <option value=\"Filtro: Chamados finalizados\">Filtro: Chamados finalizados</option>
                        <option value=\"Filtro: Chamados abertos mais antigos\">Filtro: Chamados abertos mais antigos</option>
                        <option value=\"Filtro: Chamados abertos mais recentes\">Filtro: Chamados abertos mais recentes</option>
                        <option value=\"Filtro: Chamados reprovados que estão sendo revisados\">Filtro: Chamados reprovados que estão sendo revisados</option>
                    </select>
                    <button style=\"cursor: pointer;\" class=\"form-control-flex\" type=\"submit\" data-html=\"true\" data-original-title=\"\"><i class=\"fas fa-filter\"></i>&nbsp;Pesquisar</button>

                </form>
            </div>";
        }
        ?>
        <br/>
        <?php
            
            if($_SESSION['administrador'] == 'S' && isset($_GET['user']) && $_GET['user'] == '%' && isset($_GET['tipo_filtro'])){ //isso eh quando o adm clica em TODOS.
                $chamadosAssumidos = $chamadosAssumidosSLA->getChamadosDashboard('', $_GET['tipo_filtro']);
                
            }else if($_SESSION['administrador'] == 'S' && !isset($_GET['user']) && !isset($_GET['tipo_filtro'])){ // isso eh quando ele clica sobre um funcionario especifico
                $chamadosAssumidos = $chamadosAssumidosSLA->getChamadosDashboard();
                
            }else if($_SESSION['administrador'] == 'S' && !isset($_GET['user']) && isset($_GET['tipo_filtro'])){ // isso eh quando ele clica sobre um funcionario especifico
                $chamadosAssumidos = $chamadosAssumidosSLA->getChamadosDashboard('',$_GET['tipo_filtro'] );
               
            }else if($_SESSION['administrador'] == 'S' && isset($_GET['user']) && !isset($_GET['tipo_filtro'])){ // isso eh quando ele clica sobre um funcionario especifico
                $chamadosAssumidos = $chamadosAssumidosSLA->getChamadosDashboard($_GET['user'], '' );
               
            }else if($_SESSION['administrador'] == 'S' && isset($_GET['user']) && $_GET['user'] != '%' && isset($_GET['tipo_filtro'])){ // isso eh quando ele clica sobre um funcionario especifico
                $chamadosAssumidos = $chamadosAssumidosSLA->getChamadosDashboard($_GET['user'],$_GET['tipo_filtro']);
                
            }else{
                $chamadosAssumidos = $chamadosAssumidosSLA->getChamadosDashboard($_SESSION['nome_usuario']); // quando ele nao clica em nada, Ã© a fila dele mesmo.
            }
            

        ?>
        <div>
            <table style="background-color: #fff;" id="fila_usuarios" class="display" style="position: relative; width:100%; padding: 10px auto 0px auto; max-height: 800px;">
                <thead style="background-color: #fff;">
                    <tr>
                        <th colspan="8" id="fila_usuarios_info"></th>
                    </tr>
                    <tr>
                        <th>#ID</th>
                        <th>Data Criação</th>
                        <th>Prioridade</th>
                        <th>Responsável</th>
                        <th><?php if(isset($_GET['tipo_filtro'])) { echo $_GET['tipo_filtro']; } else { echo "Descricao"; } ?></th>
                        <th>Última ação</th>
                        <th>Anexo</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <?php
                
                for($i=0;$i<count($chamadosAssumidos);$i++){
                    $dataFormatadaCadastradoEm[$i] = (new DateTime($chamadosAssumidos[$i]['cadastrado_em']))->format('d/m/Y H:i:s');
                    echo "
                    <tr>
                        <td><span id=\"\" class=\"\">#".$chamadosAssumidos[$i]['id_chamado']."</span></td>
                        <td><span id=\"\" class=\"\">".$dataFormatadaCadastradoEm[$i]."</span></td>
                        <td><span id=\"\" class=\"\">".$chamadosAssumidos[$i]['prioridade']."</span></td>
                        <td><span id=\"\" class=\"\">".$chamadosAssumidos[$i]['responsavel']."</span></td>
                        <td><span id=\"\" class=\"\" style=\"word-break: break-all; max-width:450px;\">".$chamadosAssumidos[$i]['descricao_chamado']."</span></td>
                        <td><span id=\"\" class=\"\">-</span></td>";
                        if(strlen($chamadosAssumidos[$i]['caminho_anexo']) > 0){
                            echo "<td><span id=\"\" class=\"\"><a href=\"".$chamadosAssumidos[$i]['caminho_anexo']."\" target=\"_blank\" style=\"text-decoration: underline;\"> Ver anexo</a></span></td>";
                        }else{
                            echo "<td><span id=\"\" class=\"\">Sem anexo</span></td>";
                        }
                        if($chamadosAssumidos[$i]['iniciado_em'] == '' && $chamadosAssumidos[$i]['concluido_em'] == ''){
                            echo "<td><span id=\"\" class=\"\" style=\"font-weight: 500;\">Não iniciado</i></span></td>";
                        }else if($chamadosAssumidos[$i]['iniciado_em'] != '' && $chamadosAssumidos[$i]['concluido_em'] == '' && $chamadosAssumidos[$i]['propagacao_solicitada'] == '' && $chamadosAssumidos[$i]['aprovado_reprovado'] == '' && $chamadosAssumidos[$i]['chamado_cancelado'] == 'N'){
                            echo "<td><span id=\"\" class=\"\" style=\"color: orange; font-weight: 500;\">Em andamento</i></span></td>";
                        }else if($chamadosAssumidos[$i]['iniciado_em'] != '' && $chamadosAssumidos[$i]['aprovado_reprovado'] == 'R' && $chamadosAssumidos[$i]['propagacao_solicitada'] != 'S'){
                            echo "<td><span id=\"\" class=\"\" style=\"color: red; font-weight: 500;\">Reprovado em correção</i></span></td>";
                        }else if($chamadosAssumidos[$i]['iniciado_em'] != '' && $chamadosAssumidos[$i]['aprovado_reprovado'] == 'A' && $chamadosAssumidos[$i]['propagado'] == 'N'){
                            echo "<td><span id=\"\" class=\"\">Aguardando Propagação</i></span></td>";
                        }else if($chamadosAssumidos[$i]['propagado'] == 'S'){
                            echo "<td><span id=\"\" class=\"\" style=\"color: #82D507; font-weight: 500;\">Finalizado</i></span></td>";
                        }else if($chamadosAssumidos[$i]['propagacao_solicitada'] == 'S' && $chamadosAssumidos[$i]['aprovado_reprovado'] != 'A' && $chamadosAssumidos[$i]['aprovacao_tester'] == ''){
                            echo "<td><span id=\"\" class=\"\" style=\"color: orange; font-weight: 500;\">Em análise do Tester</i></span></td>";
                        }else if($chamadosAssumidos[$i]['chamado_cancelado'] == 'S'){
                            echo "<td><span id=\"\" class=\"\" style=\"color: red; font-weight: 500;\">Cancelado</i></span></td>";
                        }else if($chamadosAssumidos[$i]['concluido_em'] != '' && $chamadosAssumidos[$i]['chamado_cancelado'] == 'N' && $chamadosAssumidos[$i]['propagacao_solicitada'] == 'N'){
                            echo "<td><span id=\"\" class=\"\" style=\"color: orange; font-weight: 500;\">Finalizado via suporte</i></span></td>";
                        }else{
                            echo "<td><span id=\"\" class=\"\" style=\"color: orange; font-weight: 500;\">?</i></span></td>";
                        }
                        echo "
                    </tr>
                ";
                }
                ?>
            </table>
        </div>
        <hr/>
<?php require_once '../../../inc/footer.php';
?>
<script>

$(document).ready( function () {
    $('#switch-case').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'csv'
        ],
        "paging":   true,
        "ordering": true,
        "order": [[ 0, 'desc' ]],
        "pagingType": "full_numbers",
        "language": {
        "lengthMenu": "",
        "zeroRecords": "Nenhum item encontrado",
        "info": "Página _PAGE_ de _PAGES_",
        "infoEmpty": "Nenhum item encontrado",
        "infoFiltered": "(filtered from _MAX_ total records)",
        "search" : "Pesquisa"
        }
        
    });
} );

$(document).ready( function () {
    var table_fila = $('#fila_usuarios').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'csv'
        ],
        "paging":   true,
        "ordering": true,
        "order": [[ 0, 'desc' ]],
        "pagingType": "full_numbers",
        "language": {
        "lengthMenu": "",
        "zeroRecords": "Nenhum item encontrado",
        "info": "Página _PAGE_ de _PAGES_",
        "infoEmpty": "Nenhum item encontrado",
        "infoFiltered": "(filtered from _MAX_ total records)",
        "search" : "Pesquisa"
        }
    });
    var info = table_fila.page.info();
    $('#fila_usuarios_info').html('Total de chamados: ' + info.recordsTotal);

} );

</script>