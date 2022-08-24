<?php require_once '../../../inc/header.php';?>
    <div class="blocoBody">
        <section class="white-section-card-100" id="white-section2">
            <div id="manual">    
                <div class="bloco-titulo">
                    <h1 class="titulo-card" style="margin-bottom: 0px;">Gestão SLA</h1>
                </div>
                <div class="bloco-geral">    
                    <div class="sub-bloco">
                        <i class="far fa-clock icon-left fa-2x"></i>
                    </div>
                    <div class="sub-bloco">
                        <h2 class="sub-titulo-card">Propagações</h2>
                        <p class="p-card">Controle de solicitações e autorizações das propagações.</p>
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
        <?php
        require_once __DIR__ . '/../../../app/Http/Controllers/SlaController.php';
        $todosChamadosConcluidos = new SlaController;
        $concluidosNaoPropagados = $todosChamadosConcluidos->getChamadosConcluidosNPropagados();

        $userLogado = $todosChamadosConcluidos->getIdUsuarioLogado();
        ?>
        <section class="white-section-card-100 cards-gerais">
            <?php 
            $autorizadosNaoPropagados = new SlaController;
            $chamadosAutorizados = $autorizadosNaoPropagados->getChamadosAutorizadosNPropagados();
            ?>
            <div class="">
                <h4 class="titulo-card">Aprovado pelo teste e pendente de propagação</h4>
                <ul class="timeline-green">
                    <?php
                    if(count($chamadosAutorizados) == 0){
                        echo "Nenhuma propagação pendente.";
                    }
                    //$modificacao = [];
                    for($j=0;$j<count($chamadosAutorizados);$j++){
                        $data2FormatadaCadastradoEm[$j] = (new DateTime($chamadosAutorizados[$j]['cadastrado_em']))->format('H:i:s d/m/Y');
                        $data2FormatadaIniciadoEm[$j] = (new DateTime($chamadosAutorizados[$j]['iniciado_em']))->format('H:i:s d/m/Y');
                        $data2FormatadaConcluidoEm[$j] = (new DateTime($chamadosAutorizados[$j]['concluido_em']))->format('H:i:s d/m/Y');
                        echo"
                            <li>
                                    <p class=\"p-card\">
                                    <span class=\"p-card-bold\">ID: </span>#".$chamadosAutorizados[$j]['id_chamado']."<br/>
                                    <span class=\"p-card-bold\">Solicitante: </span>".$chamadosAutorizados[$j]['solicitante']."<br/>
                                    <span class=\"p-card-bold\">Responsável implementação: </span>".$chamadosAutorizados[$j]['responsavel']."<br/>
                                    <span class=\"p-card-bold\">Cliente: </span>".$chamadosAutorizados[$j]['cliente']."<br/>
                                    <span class=\"p-card-bold\">Data Solicitação: </span>".$data2FormatadaCadastradoEm[$j]."<br/>
                                    <span class=\"p-card-bold\">Descrição: </span>".$chamadosAutorizados[$j]['descricao_chamado']."<br/>
                                    <span class=\"p-card-bold\">Data Implementação: </span>".$data2FormatadaIniciadoEm[$j]."<br/>
                                    <span class=\"p-card-bold\">Data Finalização: </span>".$data2FormatadaConcluidoEm[$j]."<br/>
                                    <span class=\"p-card-bold\">Modificação: </span>".$chamadosAutorizados[$j]['modificacao']."<br/>
                                    <span class=\"p-card-bold\">Nome da Branch: </span>".$chamadosAutorizados[$j]['branch']."<br/>
                                    ";
                                    if(strlen($chamadosAutorizados[$j]['caminho_anexo']) > 0){
                                        echo "<span><span class=\"p-card-bold\">Anexos:</span> <a href=\"".$chamadosAutorizados[$j]['caminho_anexo']."\" target=\"_blank\" style=\"text-decoration: underline;\"> Ver anexos</a></span><br/>";
                                    }else{
                                        echo "<span><span class=\"p-card-bold\">Anexos:</span> Sem anexos</span><br/>";
                                    }
                                    echo"
                                    </p>
                                    ";
                                    if($userLogado[0]['administrador'] == 'S'){
                                        echo "
                                        <div class=\"setinha-toggle\">
                                            <button class=\"btn  copy-content\" style=\"color: #fff; background-color: #0a71b2;\" onclick=\"propagar(".$chamadosAutorizados[$j]['id_chamado'].");\">Propagar</button>
                                        </div>
                                        <hr/>
                                    ";
                                    }
                            echo "
                            </li>";      
                    }
                    ?>
                </ul>
            </div>
        </section>
        <?php
            $autorizadosPropagados = new SlaController;
            $propagados = $autorizadosPropagados->getChamadosPropagados();  
        ?>                 
        <section class="white-section-card-100 cards-gerais">
            <h4 class="titulo-card">Histórico Desenvolvimento</h4>
            <table style="background-color: #fff;" id="historico_dev" class="display" style="position: relative; width:100%; padding: 10px auto 0px auto; max-height: 800px;">
                <thead style="background-color: #fff;">
                    <tr>
                        <th colspan="8" id="table_dev_info"></th>
                    </tr>
                    <tr>
                        <th>#ID</th>
                        <th>Cliente</th>
                        <th>Solicitante</th>
                        <th>Autor da solução</th>
                        <th>Tela</th>
                        <th>Prioridade</th>
                        <th>Descrição</th>
                        <th>Modificação</th>
                    </tr>
                </thead>
                <?php
                for($m=0;$m<count($propagados);$m++){
                    echo "
                    <tr>
                        <td><span id=\"\" class=\"\">#".$propagados[$m]['id_chamado']."</span></td>
                        <td><span id=\"\" class=\"\">".$propagados[$m]['cliente']."</span></td>
                        <td><span id=\"\" class=\"\">".$propagados[$m]['solicitante']."</span></td>
                        <td><span id=\"\" class=\"\">".$propagados[$m]['responsavel']."</span></td>
                        <td><span id=\"\" class=\"\">".$propagados[$m]['tela']."</span></td>
                        <td><span id=\"\" class=\"\">".$propagados[$m]['prioridade']."</span></td>
                        <td><span id=\"\" class=\"\">".$propagados[$m]['descricao_chamado']."</span></td>
                        <td><span id=\"\" class=\"\">".$propagados[$m]['modificacao']."</span></td>
                    </tr>
                    ";
                }
                ?>
            </table>    
        </section>
        <?php
            $finalizadosSemProp = new SlaController;
            $semPropagacao = $finalizadosSemProp->getFinalizadosSemProp();
        ?>
        <section class="white-section-card-100 cards-gerais">
            <h4 class="titulo-card">Histórico Suporte</h4>
            <table style="background-color: #fff;" id="historico_sup" class="display" style="position: relative; width:100%; padding: 10px auto 0px auto; max-height: 800px;">
                <thead style="background-color: #fff;">
                    <tr>
                        <th colspan="8" id="table_sup_info"></th>
                    </tr>
                    <tr>
                        <th>#ID</th>
                        <th>Cliente</th>
                        <th>Solicitante</th>
                        <th>Autor da solução</th>
                        <th>Tela</th>
                        <th>Prioridade</th>
                        <th>Descrição</th>
                        <th>Modificação</th>
                    </tr>
                </thead>
                <?php
                for($m=0;$m<count($semPropagacao);$m++){
                    echo "
                    <tr>
                        <td><span id=\"\" class=\"\">#".$semPropagacao[$m]['id_chamado']."</span></td>
                        <td><span id=\"\" class=\"\">".$semPropagacao[$m]['cliente']."</span></td>
                        <td><span id=\"\" class=\"\">".$semPropagacao[$m]['solicitante']."</span></td>
                        <td><span id=\"\" class=\"\">".$semPropagacao[$m]['responsavel']."</span></td>
                        <td><span id=\"\" class=\"\">".$semPropagacao[$m]['tela']."</span></td>
                        <td><span id=\"\" class=\"\">".$semPropagacao[$m]['prioridade']."</span></td>
                        <td><span id=\"\" class=\"\">".$semPropagacao[$m]['descricao_chamado']."</span></td>
                        <td><span id=\"\" class=\"\">".$semPropagacao[$m]['modificacao']."</span></td>
                    </tr>
                    ";
                }
                ?>
            </table>    
        </section>
<?php require_once '../../../inc/footer.php';?>

<script>
$(document).ready( function () {
    var table_dev = $('#historico_dev').DataTable({
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
    var info = table_dev.page.info();
    $('#table_dev_info').html('Total de chamados: ' + info.recordsTotal);

} );
$(document).ready( function () {
    var table_sup = $('#historico_sup').DataTable({
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
    var info = table_sup.page.info();
    $('#table_sup_info').html('Total de chamados: ' + info.recordsTotal);

} );
</script>