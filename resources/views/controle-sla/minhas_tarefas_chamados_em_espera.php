<br/>
<section class="white-section-card-100" id="white-section2">
    <div id="manual">    
        <div class="bloco-titulo">
            <h1 class="titulo-card" style="margin-bottom: 0px;">Aguardando o cliente</h1>
        </div>
        <div class="bloco-geral">    
            <div class="sub-bloco">
                <i class="fas fa-pause-circle icon-left fa-2x"></i>
            </div>
            <div class="sub-bloco">
                <h2 class="sub-titulo-card">Chamados em espera</h2>
                <p class="p-card">Chamados que estão em espera por inviabilidade ou aguardo de retorno do cliente.</p>
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
//CHAMADOS VINCULADOS AO DEV LOGADO - FORA E DENTRO DO COLLAPSE
$objEmEspera = new SlaController;
if($_SESSION['administrador'] == 'S' && isset($_GET['administrador']) && $_GET['administrador'] == 'S'){ //isso eh quando o adm clica em TODOS.
    $chamadosEmEspera =  $objEmEspera->getChamadosEmEspera('%');
}else if($_SESSION['administrador'] == 'S' && isset($_GET['user'])){ // isso eh quando ele clica sobre um funcionario especifico
    $chamadosEmEspera =  $objEmEspera->getChamadosEmEspera($_GET['user']);
}else{
    $chamadosEmEspera =  $objEmEspera->getChamadosEmEspera($_SESSION['nome_usuario']); // quando ele nao clica em nada, Ã© a fila dele mesmo.
}
if(count($chamadosEmEspera) == 0){
    echo "<section class=\"white-section-card-100\" id=\"white-section4\">
    <div style=\"display: block; margin: 5px auto 5px auto; text-align: center;\">- Nenhuma tarefa em espera -</div>
    </section>";
}

for($l=0;$l<count($chamadosEmEspera);$l++){    
    $dataFormatada[$l] = (new DateTime($chamadosEmEspera[$l]['iniciado_em']))->format('H:i:s d/m/Y');
        echo"
        <section class=\"white-section-card-100 cards-gerais\" style=\"margin-bottom:10px;\">
            <div class=\"white-section-toggle-3-itens\">
                <div>
                    <span class=\"p-card div-form-google\">";
                        echo"
                        <input type=\"hidden\" id=\"qtChamados\" value=\"".count($chamadosEmEspera)."\"/>
                        <span class=\"p-card-bold\">ID: </span> #".$chamadosEmEspera[$l]['id_chamado']."
                        <span class=\"p-card-bold\"> / Título:</span> ".$chamadosEmEspera[$l]['titulo']."
                        <span class=\"p-card-bold\"> / Data espera:</span> ".$chamadosEmEspera[$l]['titulo']."
                    </span>
                </div>
                <div style=\"text-align: right;\">
                    &nbsp;
                </div>
                <div class=\"setinha-toggle\">  
                    <a data-toggle=\"collapse\" href=\"#chamadoEspera".$chamadosEmEspera[$l]['id_chamado']."\" role=\"button\" aria-expanded=\"false\" aria-controls=\"collapseExample\">
                        <i class=\"fa fa-chevron-down\"></i>
                    </a>  
                </div>
            </div>

            <div class=\"collapse\" id=\"chamadoEspera".$chamadosEmEspera[$l]['id_chamado']."\">
            <hr/>
            <table id=\"detalhes_chamado\" class=\"display\" style=\"position: relative; width:100%;\">
                
                    <tr>
                        <th>Cliente: <span class=\"p-card div-form-google\">".$chamadosEmEspera[$l]['cliente']."</span></th>
                        <th>Prioridade: <span class=\"p-card div-form-google\">".$chamadosEmEspera[$l]['prioridade']."</span> </th>
                        <th>Módulo: <span class=\"p-card div-form-google\">".$chamadosEmEspera[$l]['modulo']."</span></th>
                    </tr>
                    <tr>
                        <th>Solicitante: <span class=\"p-card div-form-google\">".$chamadosEmEspera[$l]['solicitante']."</span></th>
                        <th>Prazo: <span class=\"p-card div-form-google\">".$chamadosEmEspera[$l]['prazo']."</span></th>
                        <th>Anexos: 
                        ";
                        if(strlen($chamadosEmEspera[$l]['caminho_anexo']) > 0){
                            echo "<span class=\"p-card div-form-google\"><a href=\"".$chamadosEmEspera[$l]['caminho_anexo']."\" target=\"_blank\" style=\"text-decoration: underline;\"> Ver anexo 1</a></span>&nbsp;";
                        }
                        if(strlen($chamadosEmEspera[$l]['caminho_anexo2']) > 0){
                            echo "<span class=\"p-card div-form-google\"><a href=\"".$chamadosEmEspera[$l]['caminho_anexo2']."\" target=\"_blank\" style=\"text-decoration: underline;\"> Ver anexo 2</a></span>&nbsp;";
                        }                                                                       
                        if(strlen($chamadosEmEspera[$l]['caminho_anexo']) == 0){
                            echo "<span class=\"p-card div-form-google\">Sem anexos</span>";
                        }
                        echo"
                        </th>
                    </tr>
                    <tr>
                    </tr>
                    <tr>
                        <th>Tela: <span class=\"p-card div-form-google\">".$chamadosEmEspera[$l]['tela']."</span></th>
                        <th>Status: <span class=\"p-card div-form-google\">Em Espera</span>";
                            $cadastrado_em[$l] = (new DateTime($chamadosEmEspera[$l]['cadastrado_em']))->format('d/m/Y h:m');
                            $espera_em[$l] = (new DateTime($chamadosEmEspera[$l]['data_colocado_espera']))->format('d/m/Y h:m');
                            echo "
                        </th>
                        <th>Data de Cadastro:
                            <span class=\"p-card div-form-google\"> ".$cadastrado_em[$l]."</span>
                        </th>
                    </tr>
                    <tr colspan=\"3\">
                        <th colspan=\"3\">Descrição: <span class=\"p-card div-form-google\">".$chamadosEmEspera[$l]['descricao_chamado']."</span></th>
                    </tr>
                    <tr colspan=\"3\">
                        <th colspan=\"3\">Motivo Espera: <span class=\"p-card div-form-google\">".$chamadosEmEspera[$l]['motivo_espera']."</span></th>
                    </tr>
                    <th>Data espera:
                        <span class=\"p-card div-form-google\"> ".$espera_em[$l]."</span>
                    </th>
            </table>";?>
            <div>
                <hr/>
                    <?php 
                    echo "
                    <section class=\"white-section-card-100\" style=\"background-color: #f6f6f6;\">
                        <div class=\"white-section-toggle-3-itens\" style=\"padding: 10px; border-bottom: .5px solid #cccccc;\">
                            <div>
                                <span class=\"p-card-bold div-form-google\">Conversas</span>
                            </div>
                            <div>
                                &nbsp;
                            </div>
                            <div class=\"setinha-toggle\">  
                                <a data-toggle=\"collapse\" href=\"#conversa_chamado_espera".$chamadosEmEspera[$l]['id_chamado']."\" role=\"button\" aria-expanded=\"false\" aria-controls=\"collapseExample\">
                                    <i class=\"fa fa-chevron-down\" ></i>
                                </a>  
                            </div>
                        </div>
                
                        <div class=\"collapse\" id=\"conversa_chamado_espera".$chamadosEmEspera[$l]['id_chamado']."\" style=\"background-color: #f6f6f6;\">
                            ";
                            $mensagens_conversa = $objEmEspera->getConversaChamado($chamadosEmEspera[$l]['id_chamado']);
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
                                <textarea placeholder=\"Digite uma mensagem\" name=\"nova_mensagem\" id=\"nova_mensagem".$chamadosEmEspera[$l]['id_chamado']."\" class=\"form-control-input\" style=\"height: 72px; margin-top: 10px;\"></textarea>
                            </div>
                            <button class=\"btn setinha-toggle\" style=\"position:relative; color: #fff; background-color: #0066b1; margin: 10px;\" type=\"button\" onclick=\"enviarMensagemChamado('".$chamadosEmEspera[$l]['id_chamado']."')\">Enviar mensagem</button>
                        </div>
                    </section>
                        <div class=\"dropdown setinha-toggle\" style=\" margin-top: 10px;\">
                            <button class=\"btn btn-outline-primary copy-content dropdown-toggle\" type=\"button\" id=\"dropdownMenuButton\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\" style=\"position:relative;\">
                            Ações
                            </button>
                            <div class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\">
                                <button class=\"btn\" style=\"position:relative; margin: 2px 0px 2px 0px; color: #000; width: 100%; background-color: #f0f0f0;\" type=\"button\" onclick=\"cancelarChamado(".$chamadosEmEspera[$l]['id_chamado'].");\">&nbsp;Cancelar Chamado</button><br/>
                                <button class=\"btn\" style=\"position:relative; margin: 2px 0px 2px 0px; color: #000; width: 100%; background-color: #f0f0f0;\" type=\"button\" onclick=\"finalizaSemProp(".$chamadosEmEspera[$l]['id_chamado'].");\">&nbsp;Finalizar via Suporte</button><br/>
                                <button class=\"btn\" style=\"position:relative; margin: 2px 0px 2px 0px; color: #000; width: 100%; background-color: #f0f0f0;\" type=\"button\" onclick=\"reativarChamadoEmEspera(".$chamadosEmEspera[$l]['id_chamado'].");\">&nbsp;Reativar chamado</button><br/>
                            </div>
                        </div>
                </div>
            </div>
        </section>
        ";
}