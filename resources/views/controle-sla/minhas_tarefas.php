<?php require_once '../../../inc/header.php';
require_once __DIR__ . '/../../../app/Http/Controllers/AutomatizacaoController.php';
$automatizacao = new AutomatizacaoController;
$autopause = $automatizacao->getSetAutomatizacaoAgendada('autopause');

?>
    <div class="blocoBody">
        <section class="white-section-card-100" id="white-section2">
            <div id="manual">    
                <div class="bloco-titulo">
                    <h1 class="titulo-card" style="margin-bottom: 0px;">Em andamento</h1>
                </div>
                <div class="bloco-geral">    
                    <div class="sub-bloco">
                        <i class="far fa-clock icon-left fa-2x"></i>
                    </div>
                    <div class="sub-bloco">
                        <h2 class="sub-titulo-card">Tarefas em andamento</h2>
                        <p class="p-card">Controle de fila dos chamados assumidos.</p>
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
            if($_SESSION['administrador'] == 'S'){
                echo "
                <div>
                    <form action=\"\" method=\"get\">
                        <button class=\"btn btn-outline-primary copy-content\" style=\"margin-left: -0px;\" type=\"submit\" name=\"administrador\" value=\"N\" data-html=\"true\" data-original-title=\"\">Meus</button>
                        <button class=\"btn btn-outline-primary copy-content\" style=\"margin-left: -0px;\" type=\"submit\" name=\"administrador\" value=\"S\" data-html=\"true\" data-original-title=\"\">Todos</button>
                    </form>
                    <br/>
                    <form action=\"?user=\" method=\"get\">
                        <select name=\"user\" id=\"user\" class=\"form-control\">";
                            require_once __DIR__ . '/../../../app/Http/Controllers/SlaController.php';
                            $funcionarios = new SlaController;
                            $dados_funcionarios = $funcionarios->getNomeFuncionarios();
                            echo "<option value=\"\">-- Selecione o funcionário --</option>";
                            for($i=0;$i<count($dados_funcionarios);$i++){
                                echo "<option value=\"".$dados_funcionarios[$i]['nome']."\">".$dados_funcionarios[$i]['nome']."</option>";
                            }
                        echo "
                        </select>
                        <input type=\"submit\" id=\"botaoVerChamadosFuncionarios\" style=\"display:none;\"/>
                    </form>
                </div>";
            }
            require_once __DIR__ . '/../../../app/Http/Controllers/SlaController.php';
            $chamadosAssumidosSLA = new SlaController;
            if($_SESSION['administrador'] == 'S' && isset($_GET['administrador']) && $_GET['administrador'] == 'S'){ //isso eh quando o adm clica em TODOS.
                $chamadosAssumidos = $chamadosAssumidosSLA->getChamadosNaoFinalizadosSLA();
            }else if($_SESSION['administrador'] == 'S' && isset($_GET['user'])){ // isso eh quando ele clica sobre um funcionario especifico
                $chamadosAssumidos = $chamadosAssumidosSLA->getChamadosAssumidosSLA($_GET['user']);
            }else{
                $chamadosAssumidos = $chamadosAssumidosSLA->getChamadosAssumidosSLA($_SESSION['nome_usuario']); // quando ele nao clica em nada, Ã© a fila dele mesmo.
            }
            if(count($chamadosAssumidos) == 0){
                echo "<section class=\"white-section-card-100\" id=\"white-section4\">
                <div style=\"display: block; margin: 5px auto 5px auto; text-align: center;\">- Nenhuma tarefa na fila -</div>
                </section>";
            }
            
            //CHAMADOS VINCULADOS AO DEV LOGADO - FORA E DENTRO DO COLLAPSE
            for($l=0;$l<count($chamadosAssumidos);$l++){
                //SWITCH CASE DO CHAMADO
                $switchObj = $chamadosAssumidosSLA->getSwitchCase($chamadosAssumidos[$l]['id_chamado']);
                for($k=0;$k<12;$k++){
                    $idChamado[$chamadosAssumidos[$l]['id_chamado']][$k] = isset($switchObj[$k]['idChamado']) ? $switchObj[$k]['idChamado'] : '';
                    $caminho[$chamadosAssumidos[$l]['id_chamado']][$k] = isset($switchObj[$k]['caminho']) ? $switchObj[$k]['caminho'] : '';
                    $descricao[$chamadosAssumidos[$l]['id_chamado']][$k] = isset($switchObj[$k]['descricao']) ? $switchObj[$k]['descricao'] : '';
                    $esperado[$chamadosAssumidos[$l]['id_chamado']][$k] = isset($switchObj[$k]['esperado']) ? $switchObj[$k]['esperado'] : '';
                    $ocorrido[$chamadosAssumidos[$l]['id_chamado']][$k] = isset($switchObj[$k]['ocorrido']) ? $switchObj[$k]['ocorrido'] : '';
                    $base[$chamadosAssumidos[$l]['id_chamado']][$k] = isset($switchObj[$k]['base']) ? $switchObj[$k]['base'] : '';
                }
                
                
                $dataFormatada[$l] = (new DateTime($chamadosAssumidos[$l]['iniciado_em']))->format('H:i:s d/m/Y');
                    echo"
                    <section class=\"white-section-card-100 cards-gerais\" style=\"margin-bottom:10px;\">
                        <div class=\"white-section-toggle-3-itens\">
                            <div>
                                <span class=\"p-card div-form-google\">";
                                    if($chamadosAssumidos[$l]['aprovado_reprovado'] == 'R'){
                                        echo "<span class=\"p-card-bold\" style=\"display: inline-flex;\"><i class=\"fas fa-registered\" style=\"color: red;\"></i>&nbsp;</span>";
                                    }
                                    echo"
                                    <input type=\"hidden\" id=\"qtChamados\" value=\"".count($chamadosAssumidos)."\"/>
                                    <span class=\"p-card-bold\">ID: </span> #".$chamadosAssumidos[$l]['id_chamado']." / 
                                    ";
                                    if($chamadosAssumidos[$l]['tempo_restante'] != 0){
                                        echo "<span class=\"p-card-bold\" style=\"display: inline-flex;\">Tempo restante: &nbsp;<div id=\"timer".$l."\" style=\"color: orange;\">".$chamadosAssumidos[$l]['tempo_restante']."&nbsp;</div></span>";
                                    }else{
                                        echo "<span class=\"p-card-bold\" style=\"display: inline-flex;\">Tempo restante: &nbsp;<div id=\"timer".$l."\" style=\"color: red;\">".$chamadosAssumidos[$l]['tempo_restante']."&nbsp;</div></span>";
                                    }
                                    if(strlen($chamadosAssumidos[$l]['iniciado_em']) > 0){
                                        echo "<span class=\"p-card-bold\"> / Iniciado em:</span> <span style=\"color: orange; font-size: 0.9em;\"  font-size: .8em;>".$dataFormatada[$l]."</span>";    
                                    }else{
                                        echo "<span class=\"p-card-bold\"> / Iniciado em:</span> <span style=\"color: orange; font-size: 0.9em;\">Não iniciado</span>";    
                                    }
                                    if(strlen($chamadosAssumidos[$l]['responsavel']) > 0){
                                       echo" <span class=\"p-card-bold\"> / Responsável:</span> ".$chamadosAssumidos[$l]['responsavel'];
                                    }else{
                                        echo" <span class=\"p-card-bold\"> / Responsável:</span> Nenhum";
                                    }
                                    echo"
                                    <span class=\"p-card-bold\"> / Cliente:</span> ".$chamadosAssumidos[$l]['cliente']."
                                    <span class=\"p-card-bold\"> / Título:</span> ".$chamadosAssumidos[$l]['titulo']."
                                </span>
                            </div>
                            <div style=\"text-align: right;\">
                                ";
                                if($chamadosAssumidos[$l]['iniciado_em'] == NULL && $_SESSION['nome_usuario'] == $chamadosAssumidos[$l]['responsavel']){    
                                    echo "<button class=\"icon-play-pause\" style=\"outline: none; border: none; background-color: inherit\" onclick=\"playChamado(".$chamadosAssumidos[$l]['id_chamado'].",false, '".$_SESSION['cargo']."');\">
                                            <i class=\"fas fa-play\" id=\"play-".$chamadosAssumidos[$l]['id_chamado']."\" style=\"color: #4caf50;\"></i>
                                          </button>";
                                }else if($chamadosAssumidos[$l]['em_pausa'] == 'S' && $_SESSION['nome_usuario'] == $chamadosAssumidos[$l]['responsavel']){
                                    echo "<button class=\"icon-play-pause\" style=\"outline: none; border: none; background-color: inherit\" onclick=\"retomaChamado(".$chamadosAssumidos[$l]['id_chamado'].", '".$_SESSION['cargo']."');\">
                                            <i class=\"fas fa-play\" id=\"play-".$chamadosAssumidos[$l]['id_chamado']."\" style=\"color: #4caf50;\"></i>
                                          </button>";
                                }else if($chamadosAssumidos[$l]['em_pausa'] == 'N' && $_SESSION['nome_usuario'] == $chamadosAssumidos[$l]['responsavel']){
                                    echo "<button class=\"icon-play-pause\" style=\"outline: none; border: none; background-color: inherit\" onclick=\"pausaChamado(".$chamadosAssumidos[$l]['id_chamado'].", '".$_SESSION['cargo']."');\">
                                            <i class=\"fas fa-pause\" id=\"play-".$chamadosAssumidos[$l]['id_chamado']."\" style=\"color: #585858;\"></i>
                                          </button>";
                                }
                                    echo "
                                
                            </div>
                            <div class=\"setinha-toggle\">  
                                <a data-toggle=\"collapse\" href=\"#chamadoAssumido".$chamadosAssumidos[$l]['id_chamado']."\" role=\"button\" aria-expanded=\"false\" aria-controls=\"collapseExample\">
                                    <i class=\"fa fa-chevron-down\"></i>
                                </a>  
                            </div>
                        </div>
                        <div class=\"collapse\" id=\"chamadoAssumido".$chamadosAssumidos[$l]['id_chamado']."\">
                        <hr/>
                        <table id=\"detalhes_chamado\" class=\"display\" style=\"position: relative; width:100%;\">
                            
                                <tr>
                                    <th>Cliente: <span class=\"p-card div-form-google\">".$chamadosAssumidos[$l]['cliente']."</span></th>
                                    <th>Prioridade: <span class=\"p-card div-form-google\">".$chamadosAssumidos[$l]['prioridade']."</span> </th>
                                    <th>Módulo: <span class=\"p-card div-form-google\">".$chamadosAssumidos[$l]['modulo']."</span></th>
                                </tr>
                                <tr>
                                    <th>Autor interno: <span class=\"p-card div-form-google\">".$chamadosAssumidos[$l]['solicitante']."</span></th>
                                    <th>Solicitante externo: <span class=\"p-card div-form-google\">".$chamadosAssumidos[$l]['solicitante_externo']."</span></th>
                                    <th>Anexos: 
                                    ";
                                    if(strlen($chamadosAssumidos[$l]['caminho_anexo']) > 0){
                                        echo "<span class=\"p-card div-form-google\"><a href=\"".$chamadosAssumidos[$l]['caminho_anexo']."\" target=\"_blank\" style=\"text-decoration: underline;\"> Ver anexo 1</a></span>&nbsp;";
                                    }
                                    if(strlen($chamadosAssumidos[$l]['caminho_anexo2']) > 0){
                                        echo "<span class=\"p-card div-form-google\"><a href=\"".$chamadosAssumidos[$l]['caminho_anexo2']."\" target=\"_blank\" style=\"text-decoration: underline;\"> Ver anexo 2</a></span>&nbsp;";
                                    }                                                                       
                                    if(strlen($chamadosAssumidos[$l]['caminho_anexo']) == 0){
                                        echo "<span class=\"p-card div-form-google\">Sem anexos</span>";
                                    }
                                    echo"
                                    </th>
                                </tr>
                                <tr>
                                    <th>Tela: <span class=\"p-card div-form-google\">".$chamadosAssumidos[$l]['tela']."</span></th>
                                    <th>Status: <span class=\"p-card div-form-google\">";
                                        if($chamadosAssumidos[$l]['iniciado_em'] != ''){
                                            echo "Em andamento</span>";
                                        }else{
                                            echo "Não iniciado</span>";
                                        }
                                        $cadastrado_em[$l] = (new DateTime($chamadosAssumidos[$l]['cadastrado_em']))->format('d/m/Y h:m');
                                        echo "
                                    </th>
                                    <th>Data de Cadastro:
                                        <span class=\"p-card div-form-google\"> ".$cadastrado_em[$l]."</span>
                                    </th>
                                </tr>
                                <tr colspan=\"3\">
                                    <th colspan=\"3\">Descrição: <span class=\"p-card div-form-google\">".$chamadosAssumidos[$l]['descricao_chamado']."</span></th>
                                </tr>
                        </table>";?>
                        <div>
                            <hr/>
                            <div style="display: grid; grid-template-columns: 2fr 1fr">
                                <div>
                                    &nbsp;
                                </div>
                                <div>
                                    <?php  if($_SESSION['nome_usuario'] == $chamadosAssumidos[$l]['responsavel']){ $out = "Marcar promessa de resolução";  } else { $out = "Intimar data de correção"; } ?>
                                    <section class="white-section-card-100-invisible">
                                            <div class="botoes-center-cemPorcento">
                                                <input type="date" class="form-control" id="data_promessa<?=$chamadosAssumidos[$l]['id_chamado'];?>"/>
                                                <?= "<button class=\"btn btn-outline-primary copy-content\" type=\"button\" name=\"button\" data-html=\"true\" onclick=\"prometerIntimar('".$out."','".$chamadosAssumidos[$l]['id_chamado']."','".$chamadosAssumidos[$l]['responsavel']."');\">".$out."</button>";?>
                                            </div>
                                    </section>
                                </div>
                            </div>
                            <hr/>
                                <?php 
                                include './minhas_tarefas_switch_case.php';

                                echo "
                                <section class=\"white-section-card-100\" style=\"background-color: #f6f6f6;\">
                                    <div class=\"white-section-toggle-3-itens\" style=\"padding: 10px; border-bottom: .5px solid #cccccc;\">
                                        <div>
                                            <span class=\"p-card-bold div-form-google\">Conversa Interna</span>
                                        </div>
                                        <div>
                                            &nbsp;
                                        </div>
                                        <div class=\"setinha-toggle\">  
                                            <a data-toggle=\"collapse\" href=\"#conversa_chamado".$chamadosAssumidos[$l]['id_chamado']."\" role=\"button\" aria-expanded=\"false\" aria-controls=\"collapseExample\">
                                                <i class=\"fa fa-chevron-down\" ></i>
                                            </a>  
                                        </div>
                                    </div>
                            
                                    <div class=\"collapse\" id=\"conversa_chamado".$chamadosAssumidos[$l]['id_chamado']."\" style=\"background-color: #f6f6f6;\">
                                        ";
                                        $mensagens_conversa = $chamadosAssumidosSLA->getConversaChamado($chamadosAssumidos[$l]['id_chamado']);
                                        for($c=0; $c<count($mensagens_conversa);$c++){
                                            if(count($mensagens_conversa)>0){
                                                echo "
                                                <div style\"padding: 5px; text-align: center;\">
                                                    <span class=\"p-card-bold div-form-google\">".$mensagens_conversa[$c]['autor'].":</span><br/>
                                                    &nbsp;&nbsp;<i class=\"far fa-comment\"></i>&nbsp;<span>".$mensagens_conversa[$c]['mensagem']."</span>
                                                    <hr/>
                                                </div>";
                                            }
                                        }
                                        echo "
                                        <div style=\"position: relative; margin: auto; max-width: 98%;\">
                                            <textarea placeholder=\"Digite uma mensagem\" name=\"nova_mensagem\" id=\"nova_mensagem".$chamadosAssumidos[$l]['id_chamado']."\" class=\"form-control-input\" style=\"height: 72px; margin-top: 10px;\"></textarea>                                            
                                        </div>
                                        <button class=\"btn setinha-toggle\" style=\"position:relative; color: #fff; background-color: #0066b1; margin: 10px;\" type=\"button\" onclick=\"enviarMensagemChamado('".$chamadosAssumidos[$l]['id_chamado']."')\">Enviar mensagem</button>
                                    </div>
                                </section>

                                <section class=\"white-section-card-100\" style=\"background-color: #f6f6f6;\">
                                <div class=\"white-section-toggle-3-itens\" style=\"padding: 10px; border-bottom: .5px solid #cccccc;\">
                                    <div>
                                        <span class=\"p-card-bold div-form-google\">Conversa com cliente</span>
                                    </div>
                                    <div>
                                        &nbsp;
                                    </div>
                                    <div class=\"setinha-toggle\">  
                                        <a data-toggle=\"collapse\" href=\"#conversa_chamado_externo".$chamadosAssumidos[$l]['id_chamado']."\" role=\"button\" aria-expanded=\"false\" aria-controls=\"collapseExample\">
                                            <i class=\"fa fa-chevron-down\" ></i>
                                        </a>  
                                    </div>
                                </div>
                        
                                <div class=\"collapse\" id=\"conversa_chamado_externo".$chamadosAssumidos[$l]['id_chamado']."\" style=\"background-color: #fff; text-align:center;\">
                                    <div>";
                                    $mensagens_conversa = $chamadosAssumidosSLA->getConversaExternaChamado($chamadosAssumidos[$l]['id_chamado']);
                                    
                                    echo "
                                        <div class=\"padding\">
                                            <div>
                                                <div class=\"col-md-12\">
                                                    <div class=\"card-chat card-bordered\">
                                                            <h5 class=\"p-card-bold\" style='padding: 5px;'>Mensagens</h5>";
                                                        if(count($mensagens_conversa) > 0){
                                                            echo "<div class=\"ps-container ps-theme-default ps-active-y\" id=\"chat-content\" style=\"overflow-y: scroll !important; height:350px !important;\">";
                                                        }else{
                                                            echo "<div class=\"ps-container ps-theme-default ps-active-y\" id=\"chat-content\" style=\"overflow-y: scroll !important; height:50px !important;\">
                                                            <div id=\"nenhum-chamado\" style=\"text-align: center;\"><p class=\"p-card\">Nenhuma mensagem encontrada.</p></div>";
                                                        }
                                                            for($c=0; $c<count($mensagens_conversa);$c++){
                                                                $msg_cadastrado_em[$c] = (new DateTime($mensagens_conversa[$c]['cadastrado_em']))->format('d/m/Y h:m');
                                                                
                                                                if(count($mensagens_conversa)>0){
                                                                    if($mensagens_conversa[$c]['autor'] != $_SESSION['nome_usuario']){
                                                                        echo "
                                                                            <div class=\"media media-chat\">
                                                                                <img class=\"avatar\" src=\"https://img.icons8.com/color/36/000000/administrator-male.png\"alt=\"...\">
                                                                                    <div class=\"media-body\">
                                                                                        <p style='color: #585858;'>".$mensagens_conversa[$c]['mensagem']."</p>
                                                                                        <p class=\"meta\">".$mensagens_conversa[$c]['autor']." - ".$msg_cadastrado_em[$c]."</p>
                                                                                    </div>
                                                                            </div>
                                                                        ";
                                                                    }else{
                                                                        echo "
                                                                        <div class=\"media media-chat media-chat-reverse\">
                                                                            <div class=\"media-body\">
                                                                                <p>".$mensagens_conversa[$c]['mensagem']."</p>
                                                                                <p class=\"meta\"><time datetime>".$mensagens_conversa[$c]['cadastrado_em']."</time></p>
                                                                            </div>
                                                                        </div>
                                                                        ";
                                                                    }
                                                                }
                                                            }
                                                            echo "
                                                        </div>
                                                        <div>
                                                            <div class=\"publisher bt-1 border-light\">
                                                                <img class=\"avatar avatar-xs\" src=\"https://img.icons8.com/color/2x/circled-user-male-skin-type-4.png\" alt=\"...\">
                                                                <input class=\"publisher-input\" type=\"text\" placeholder=\"Digite a mensagem\"  name=\"nova_mensagem_externa\" id=\"nova_mensagem_externa".$chamadosAssumidos[$l]['id_chamado']."\">
                                                                <a class=\"publisher-btn text-info\" href=\"#\" data-abc=\"true\" onclick=\"enviarMensagemExternoChamado('".$chamadosAssumidos[$l]['id_chamado']."')\"> <i class=\"fa fa-paper-plane\"></i></a> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </section>


                                <form id=\"branch-modif\">
                                    <span class=\"p-card div-form-google\"><span class=\"p-card-bold\">Branch: </span>
                                        <textarea placeholder=\"Digite o nome da branch\" value=\"".$chamadosAssumidos[$l]['branch']."\" name=\"branch\" id=\"branch".$chamadosAssumidos[$l]['id_chamado']."\" class=\"form-control\"></textarea>
                                    </span>
                                    <span class=\"p-card div-form-google\"><span class=\"p-card-bold\">Detalhes da Ação: </span>
                                        <textarea placeholder=\"Digite a modificação realizada\" name=\"modificacao\" id=\"modificacao".$chamadosAssumidos[$l]['id_chamado']."\" class=\"form-control-input\" style=\"height: 72px;\"></textarea>
                                        <script>CKEDITOR.replace('modificacao{$chamadosAssumidos[$l]['id_chamado']}');</script>
                                    </span>
                                    <div class=\"dropdown setinha-toggle\" style=\" margin-top: 10px;\">
                                        <button class=\"btn btn-outline-primary copy-content dropdown-toggle\" type=\"button\" id=\"dropdownMenuButton\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\" style=\"position:relative;\">
                                        Ações
                                        </button>
                                        <div class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\">
                                            <button class=\"btn\" style=\"position:relative; margin: 2px 0px 2px 0px; color: #000; width: 100%; background-color: #f0f0f0;\" type=\"button\" onclick=\"cancelarChamado(".$chamadosAssumidos[$l]['id_chamado'].");\">&nbsp;Cancelar Chamado</button><br/>
                                            <button class=\"btn\" style=\"position:relative; margin: 2px 0px 2px 0px; color: #000; width: 100%; background-color: #f0f0f0;\" type=\"button\" onclick=\"finalizaSemProp(".$chamadosAssumidos[$l]['id_chamado'].");\">&nbsp;Finalizar via Suporte</button><br/>
                                            ";
                                            if($chamadosAssumidos[$l]['iniciado_em'] != NULL){
                                                echo
                                                "
                                                <button class=\"btn\" style=\"position:relative; margin: 2px 0px 2px 0px; width: 100%; color: #000; background-color: #f0f0f0;\" type=\"button\" onclick=\"finalizaDemanda(".$chamadosAssumidos[$l]['id_chamado'].");\">&nbsp;Enviar para Tester</button><br/>
                                                ";    
                                            }
                                            echo "
                                            <button class=\"btn\" style=\"position:relative; margin: 2px 0px 2px 0px; color: #000; width: 100%; background-color: #f0f0f0;\" type=\"button\" onclick=\"deixarChamadoEmEspera(".$chamadosAssumidos[$l]['id_chamado'].");\">&nbsp;Deixar em espera</button><br/>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>
                    ";
            }
            echo "<hr/>";
            require_once './controle_produtividade.php';
            require_once './minhas_tarefas_chamados_em_espera.php';
            
            
        ?>
<?php require_once '../../../inc/footer.php';?>
<script>
$(document).ready( function () {
    $('#switch-case').DataTable({
        "paging":   false,
        "ordering": false,
        "info":     false,
        "search": false,
        "language": {
            "lengthMenu": "Display _MENU_ records per page",
            "zeroRecords": "Nothing found - sorry",
            "info": "Showing page _PAGE_ of _PAGES_",
            "infoEmpty": "No records available",
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
            "lengthMenu": "Display _MENU_ records per page",
            "zeroRecords": "Nothing found - sorry",
            "info": "Showing page _PAGE_ of _PAGES_",
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