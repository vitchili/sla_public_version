<?php require_once '../../../inc/header.php';
require_once __DIR__ . '/../../../app/Http/Controllers/ControllerPrioridadesChamado.php';
require_once __DIR__ . '/../../../app/Http/Controllers/AutomatizacaoController.php';
$automatizacao = new AutomatizacaoController;
$automatizacao = $automatizacao->getSetAutomatizacaoAgendada('abre_chamado_email');
?>
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
                        <h2 class="sub-titulo-card">Gestão SLA de prazos para a solução de bugs e novas implementações</h2>
                        <p class="p-card">Confira os chamados em aberto.</p>
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
                                <button id="botaoNovoInformativo" class="btn btn-dommus-action  copy-content" type="button" name="button" data-html="true" data-original-title="" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fas fa-plus-circle"></i>&nbsp;Novo Informativo</button>
                        </form>
                    </div>
                </div>    
            </div>
            <?php 
                // O collapse so terÃÂ¡ a classe show (aparecera aberto) caso o text-pesquisa estiver settado. isso implica em poder comeÃÂ§ar a pagina com o collapse fechado, mas ao pesquisar um tema aparece com o collapse aberto
               
            ?> 
            
        </section>
        <section style="display: grid; grid-template-columns: 30fr 1fr 30fr;">
            <section class="white-section-100">
                        <div class="bloco-titulo">
                                <h1 class="titulo-card" style="margin: 0px;">Informativos/Erros/Orçamento</h1>
                        </div>
                        <?php
                        
                        require_once __DIR__ . '/../../../app/Http/Controllers/SlaController.php';
                        $objPrioridade = new ControllerPrioridadesChamado;
                        $prioridades = $objPrioridade->visualizarPrioridade();
                        
                        //CHAMADOS NAO ASSUMIDOS EM ABERTO
                        $chamadosSLA = new SlaController;
                        $chamadosPrioridade = $chamadosSLA->getChamadosSLA('ADM'); // $_SESSION['cargo'] para ver so os chamados do mesmo cargo seu. Coloquei ADM momentaneamente pra todos ver todos.
                        $qtChamadosPrioridade = $chamadosSLA->getQtChamadosSLA('ADM'); // $_SESSION['cargo'] para ver so os chamados do mesmo cargo seu
                        
                        $arrayQtChamados = [0,0,0,0,0,0,0,0];
                        for($i=0;$i<count($prioridades);$i++){
                            $arrayQtChamados[$i] = $qtChamadosPrioridade[0][$prioridades[$i]['nome']];     
                        }
                        //CHAMADOS ASSUMIDOS - COM RESPONSAVEL
                        $chamadosAssumidosSLA = new SlaController;
                        $userTmp = '';
                        $userTmpGet = '';
                        if(isset($_GET['user'])){
                            $userTmpGet = $chamadosAssumidosSLA->getIdUsuarioGet($_GET['user']);                         
                            $userId = $userTmpGet[0]['id'];
                            $userName = $userTmpGet[0]['nome'];
                        }else{
                            $userTmp = $chamadosAssumidosSLA->getIdUsuarioLogado();
                            $userId = $userTmp[0]['id'];
                            $userName = $userTmp[0]['nome'];
                        }
                        
                        $userDados = $chamadosAssumidosSLA->getIdUsuarioLogado();
                        $userPower = $userDados[0]['cargo'];
                        $chamadosAssumidos = $chamadosAssumidosSLA->getChamadosAssumidosSLA($userName);

                        //CHAMADOS GERAIS NAO FINALIZADOS- INDEPENDENTE DO RESPONSAVEL OU STATUS.
                        //$chamadosGerais = $chamadosSLA->getChamadosNaoFinalizadosSLA(); ERA para o top tres prazos esgotando. descontinuei
                        for($i=0;$i<count($prioridades);$i++){
                            echo"
                            <section class=\"white-section-card cards-gerais\">
                                <div class=\"white-section-toggle\">
                                    <div class=\"div-qt-chamados\">
                                        <div class=\"qt-chamados\" id=\"qt-chamados".$prioridades[$i]['id']."\" style='background-color: ".$prioridades[$i]['hex_color']."'>
                                            <span class=\"span-qt-chamados\">".$arrayQtChamados[$i]."</span>
                                        </div>
                                        <span class=\"\">".$prioridades[$i]['nome']."</span>
                                    </div>
                                    <div class=\"setinha-toggle\">
                                        <a data-toggle=\"collapse\" href=\"#divSubItem".$i."\" role=\"button\" aria-expanded=\"false\" aria-controls=\"collapseExample\">
                                            <i class=\"fa fa-chevron-down\"></i>
                                        </a>  
                                    </div>
                                </div>    
                                <div class=\"collapse\" id=\"divSubItem".$i."\">
                                    <hr/>
                                    <section ondragover=\"onDragOver(event);\" onDrop=\"onDropDesassumir(event,".$i.");\" id=\"blocoChamadosNaoAssumidos".$i."\" class=\"white-section-100-invisible\" style=\"min-height: 166px; padding-bottom: 5px;\">
                                    ";

                                        //LISTA DE CHAMADOS SEM RESPONSAVEL ATUALMENTE - FORA E DENTRO DO COLLAPSE
                                    $qtChamadosSoma = count($chamadosPrioridade) + count($chamadosAssumidos); // essa variavel soma a quantidade de chamados em aberto com a quantidade de chamados assumidos.
                                        for($k=0;$k<count($chamadosPrioridade);$k++){
                                            if($chamadosPrioridade[$k]['prioridade'] == $prioridades[$i]['nome']){
                                                if($_SESSION['administrador'] == 'S' || $userPower == 'SUP'){
                                                    echo"
                                                    <section draggable=\"true\" id=\"".$chamadosPrioridade[$k]['id_chamado']."\" class=\"white-section-100 cards-gerais\" style=\"margin-bottom:10px;\" ondragstart=\"onDragStart(event);\">";
                                                }else{
                                                    echo"
                                                    <section id=\"".$chamadosPrioridade[$k]['id_chamado']."\" class=\"white-section-100 cards-gerais\" style=\"margin-bottom:10px;\">";
                                                }
                                                echo "
                                                    <div class=\"white-section-toggle\">
                                                        <div>
                                                        <input type=\"hidden\" id=\"qtChamados\" value=\"".$qtChamadosSoma."\"/>
                                                        ";
                                                        if($chamadosPrioridade[$k]['tempo_restante'] != '0'){
                                                            echo "<span class=\"p-card div-form-google\"><span class=\"p-card-bold\">ID: </span> #".$chamadosPrioridade[$k]['id_chamado']." / <span class=\"p-card-bold\">Título:</span> ".$chamadosPrioridade[$k]['titulo']." / <span class=\"p-card-bold\">Prazo:</span> <div id=\"timer".$k."\" style=\"color: orange; display: inline;\" >".$chamadosPrioridade[$k]['tempo_restante']."</div></span>";
                                                        }else{
                                                            echo "<span class=\"p-card div-form-google\"><span class=\"p-card-bold\">ID: </span> #".$chamadosPrioridade[$k]['id_chamado']." / <span class=\"p-card-bold\">Título:</span> ".$chamadosPrioridade[$k]['titulo']." / <span class=\"p-card-bold\">Prazo:</span> <div id=\"timer".$k."\" style=\"color: red; display: inline;\" >".$chamadosPrioridade[$k]['tempo_restante']."</div></span>";
                                                        } 
                                                        echo "
                                                        </div>
                                                        <div class=\"setinha-toggle\">    
                                                            <a data-toggle=\"collapse\" href=\"#chamado".$chamadosPrioridade[$k]['id_chamado']."\" role=\"button\" aria-expanded=\"false\" aria-controls=\"collapseExample\">
                                                                <i class=\"fa fa-chevron-down\"></i>
                                                            </a>  
                                                        </div>
                                                    </div>
                                                    <div class=\"collapse\" id=\"chamado".$chamadosPrioridade[$k]['id_chamado']."\"> 
                                                        <hr/>";
                                                        if(!empty($chamadosPrioridade[$k]['total_preco'])){ //apenas orcamentos tem precos
                                                            
                                                        }else{
                                                            $getDadosChamado = $chamadosSLA->getDadosChamadoPorId($chamadosPrioridade[$k]['id_chamado']);
                                                            $dados = new SlaController;
                                                            echo "
                                                            <span class=\"p-card-bold div-form-google\">Id:</span>
                                                            <input type=\"text\" class=\"form-control\" id=\"id_chamado_edit".$chamadosPrioridade[$k]['id_chamado']."\" value=\"".$chamadosPrioridade[$k]['id_chamado']."\" disabled/>";?>
                                                            <span class=p-card-bold div-form-google>Cliente</span>
                                                            <?php echo "<select name=\"clienteEdit\" id=\"clienteEdit".$chamadosPrioridade[$k]['id_chamado']."\" class=\"form-control clienteEdit\" required>";?>
                                                                <?php
                                                                //mesmo id do json com o bd. Provisorio. necessario puxar tudo do bd depois
                                                                    
                                                                    $clienteEdit = $dados->getNomeCliente();

                                                                    echo "<option value=\"".$getDadosChamado[0]['id_cliente']."\" selected>".$getDadosChamado[0]['cliente']."</option>";
                                                                    for($j=0;$j<count($clienteEdit);$j++){
                                                                        echo "<option value=\"".$clienteEdit[$j]['id']."\">".$clienteEdit[$j]['cliente']."</option>";
                                                                    }
                                                                ?>
                                                            </select>
                                                            <span class="p-card-bold div-form-google">Solicitante:</span>
                                                            <?php echo "<select name=\"solicitanteEdit\" id=\"solicitanteEdit".$chamadosPrioridade[$k]['id_chamado']."\" class=\"form-control\" required>";?>
                                                                <?php
                                                                $solicitanteEdit = $dados->getNomeSolicitante();
                                                                echo "<option value=\"".$getDadosChamado[0]['id_solicitante']."\" selected>".$getDadosChamado[0]['solicitante']."</option>";
                                                                    for($j=0;$j<count($solicitanteEdit);$j++){
                                                                        echo "<option value=\"".$solicitanteEdit[$j]['id']."\">".$solicitanteEdit[$j]['nome']."</option>";
                                                                    }
                                                                ?>
                                                            </select>
                                                            <span class="p-card-bold div-form-google">Solicitante Externo:</span>
                                                                <?php echo "<input disabled class=\"form-control\" type=\"text\" id=\"solicitante_externo".$chamadosPrioridade[$k]['id_chamado']."\" value=\"".$getDadosChamado[0]['solicitante_externo']."\"/>";?>
                                                            <span class="p-card-bold div-form-google">Produto:</span>
                                                            <?php echo"<select name=\"produtoEdit\" id=\"produtoEdit".$chamadosPrioridade[$k]['id_chamado']."\" class=\"form-control produtoEdit\" required>";?>
                                                                <?php
                                                                $produtoEdit = $dados->getProdutoSLA();
                                                                echo "<option value=\"".$getDadosChamado[0]['id_produto']."\" selected>".$getDadosChamado[0]['produto']."</option>";
                                                                    for($j=0;$j<count($produtoEdit);$j++){
                                                                        echo "<option value=\"".$produtoEdit[$j]['id']."\">".$produtoEdit[$j]['produto']."</option>";
                                                                    }
                                                                ?>
                                                            </select>
                                                            <span class="p-card-bold div-form-google">Módulo:</span>
                                                            <?php echo "<select name=\"moduloEdit\" id=\"moduloEdit".$chamadosPrioridade[$k]['id_chamado']."\" class=\"form-control moduloEdit\" required>";?>
                                                            <?php
                                                                echo "<option value=\"".$getDadosChamado[0]['id_modulo']."\" selected>".$getDadosChamado[0]['modulo']."</option>";
                                                            ?>
                                                            </select>
                                                            <span class="p-card-bold div-form-google">Tela:</span>
                                                            <?php echo "<select name=\"telaEdit\" id=\"telaEdit".$chamadosPrioridade[$k]['id_chamado']."\" class=\"form-control telaEdit\" required>";?>
                                                            <?php
                                                                echo "<option value=\"".$getDadosChamado[0]['id_tela']."\" selected>".$getDadosChamado[0]['tela']."</option>";
                                                            ?>
                                                            </select>
                                                            
                                                            <span class="p-card-bold div-form-google">Prioridade:</span>
                                                            <?php echo "<select name=\"prioridadeEdit\" id=\"prioridadeEdit".$chamadosPrioridade[$k]['id_chamado']."\" class=\"form-control\" required>";?>
                                                            <?php
                                                            //mesmo id do json com o bd. Provisorio. necessario puxar tudo do bd depois
                                                                require_once __DIR__ . '/../../../app/Http/Controllers/SlaController.php';
                                                                $dados = new SlaController;
                                                                $prioridadeEdit = $dados->getPrioridadesSLA();
                                                                echo "<option value=\"".$getDadosChamado[0]['id_prioridade']."\" selected>".$getDadosChamado[0]['prioridade']."</option>";
                                                                for($j=0;$j<count($prioridadeEdit)-1;$j++){
                                                                    echo "<option value=\"".$prioridadeEdit[$j]['id']."\">".$prioridadeEdit[$j]['nome']."</option>";
                                                                }
                                                                $cadastrado_em[$k] = (new DateTime($getDadosChamado[0]['cadastrado_em']))->format('d/m/Y');
                                                            ?>
                                                            </select> 
                                                            <span class="p-card-bold div-form-google">Data de Entrega:</span>
                                                            <?php echo "<input class=\"form-control\" type=\"date\" id=\"data_entrega_estimada_edit".$chamadosPrioridade[$k]['id_chamado']."\" name=\"data_entrega_estimada_edit\" value=\"".$getDadosChamado[0]['data_entrega_estimada']."\"/>";?>
                                                            
                                                            <span class="p-card-bold div-form-google">Data de Criação:</span>
                                                            <?php echo "<input disabled class=\"form-control\" type=\"text\" id=\"data_criacao_estimada_edit".$chamadosPrioridade[$k]['id_chamado']."\" value=\"".$cadastrado_em[$k]."\"/>";?>
                                                            
                                                            <span class="p-card-bold div-form-google">Título:</span>
                                                            <?php echo "<input type=\"text\" name=\"tituloEdit\" id=\"tituloEdit".$chamadosPrioridade[$k]['id_chamado']."\" class=\"form-control\" value=\"".$getDadosChamado[0]['titulo']."\"/>";?>

                                                            <span class="p-card-bold     div-form-google">Descrição:</span>
                                                            <?php echo "<textarea name=\"descricaoEdit\" id=\"descricaoEdit".$chamadosPrioridade[$k]['id_chamado']."\" class=\"form-control-input\" style=\"height: 150px;\" required placeholder=\"Insira aqui a descrição do problema\">";?><?php echo $getDadosChamado[0]['descricao_chamado'];?></textarea>
                                                            <script>CKEDITOR.replace('descricaoEdit<?=$chamadosPrioridade[$k]['id_chamado'];?>');</script>

                                                            <?php
                                                        }
                                                            if(strlen($chamadosPrioridade[$k]['caminho_anexo']) > 0){
                                                                echo "<span class=\"p-card div-form-google\"><span class=\"p-card-bold\">Anexos:</span> <a href=\"".$chamadosPrioridade[$k]['caminho_anexo']."\" target=\"_blank\" style=\"text-decoration: underline;\"> Ver anexo 1</a></span>&nbsp;";
                                                            }
                                                            if(strlen($chamadosPrioridade[$k]['caminho_anexo2']) > 0){
                                                                echo "<a href=\"".$chamadosPrioridade[$k]['caminho_anexo2']."\" target=\"_blank\" style=\"text-decoration: underline;\"> Ver anexo 2</a>&nbsp;";
                                                            }                                                                      
                                                            if(strlen($chamadosPrioridade[$k]['caminho_anexo']) == 0){
                                                                echo "<span class=\"p-card div-form-google\"><span class=\"p-card-bold\">Anexos:</span> Sem anexos</span><br/>";
                                                            }
                                                            ?>
                                                            <?php
                                                            echo"
                                                            <hr/>
                                                            <div class=\"setinha-toggle\">
                                                                <button type=\"button\" class=\"btn setinha-toggle\" style=\"position:relative; color: #fff; background-color: #fdde2c;\" onclick=\"testeEdit('".$chamadosPrioridade[$k]['id_chamado']."');\">Editar</button>
                                                            </div>
                                                    </div>
                                                </section>
                                                ";
                                            }
                                        }
                                    echo "
                                    </section>
                                </div>
                            </section>
                            ";
                        }
                    ?>
            </section>
            <section>&nbsp;</section>
            <?php include './filaDosFuncionarios.php' ?>
        </section>
                    
        <!--MODAL -->
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header" >
                            <h5 class="titulo-card" style="padding: 0px;" id="exampleModalLabel">Informativo de Erro/Bug/Orçamento</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="wrapper">
                            <input type="radio" name="selectTipoAbertura" id="selectTipoAbertura-1" checked>
                            <input type="radio" name="selectTipoAbertura" id="selectTipoAbertura-2">
                            <label for="selectTipoAbertura-1" class="selectTipoAbertura selectTipoAbertura-1">
                                <div class="dot"></div>
                                <span>&nbsp;Chamado</span>
                                </label>
                            <label for="selectTipoAbertura-2" class="selectTipoAbertura selectTipoAbertura-2">
                                <div class="dot"></div>
                                <span>&nbsp;Orçamento</span>
                            </label>
                        </div>
                        <?php include './cadastroNovoBug.php'; ?>
                        <?php include './cadastroNovoOrcamento.php'; ?>
                    </div>
                </div>
        </div>
        
        <!-- FIM MODAL -->
        
       
<?php require_once '../../../inc/footer.php';?>

<script>
     $(document).ready(function(){
            $('#botaoNovoInformativo').click(function() {
                $("#selectTipoAbertura-2").prop("checked", false);
                $("#selectTipoAbertura-1").prop("checked", true);
                $('#formNewBug').show();
                $('#formNovoOrcamento').hide();
            });
            $('#selectTipoAbertura-2').click(function() {
                $('#formNewBug').hide();
                $('#formNovoOrcamento').show();
                
            });
            $('#selectTipoAbertura-1').click(function() {
                $('#formNovoOrcamento').hide();
                $('#formNewBug').show();
            });
        });
         
        $(function(){
			$('.moduloEdit').change(function(){
				if( $(this).val() ) {
                    $.post("../../../app/Http/api/getTelas.php",
                    {
                        modulo:  $(this).val()
                    },
                    function(dataStr, status){
                        var data = JSON.parse(dataStr); 

                        var options = '<option value="" disabled selected>-- Selecione a Tela --</option>';	
						for (var i = 0; i < data.length; i++) {
							options += '<option value="' + data[i].id + '">' + data[i].nome + '</option>';
						}
						$('.telaEdit').html(options).show();
                    });
				} else {
					$('.telaEdit').html('<option value="">-- Escolha o módulo primeiro --</option>');
				}
                
			});
		});
        
        
        $(function(){
			$('.produtoEdit').change(function(){
				if( $(this).val() ) {
                    $.post("../../../app/Http/api/getModulos.php",
                    {
                        produto:  $(this).val()
                    },
                    function(dataStr, status){
                        var data = JSON.parse(dataStr); 

                        var options = '<option value="" disabled selected>-- Selecione --</option>';	
						for (var i = 0; i < data.length; i++) {
							options += '<option value="' + data[i].id + '">' + data[i].modulo + '</option>';
						}
						$('.moduloEdit').html(options).show();
                    });
				} else {
					$('.moduloEdit').html('<option value="">-- Escolha o produto primeiro --</option>');
				}
                
			});
		});
        /*********************************EDIT**************************************** */

            
            </script>