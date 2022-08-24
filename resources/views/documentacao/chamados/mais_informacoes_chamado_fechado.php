<!--MODAL -->
<?php
$conversas = new SlaController;
$mensagens_conversa = $conversas->getConversaExternaChamado($chamadosFechados[$i]['id']);
?>

<div class="modal fade bd-example-modal-lg<?= $chamadosFechados[$i]['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header" >
                            <h5 class="titulo-card" style="padding: 0px;" id="exampleModalLabel">Mais informações</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div style="padding: 10px;">
                            <?php
                                $cadastrado_em[$i] = (new DateTime($chamadosFechados[$i]['cadastrado_em']))->format('d/m/Y h:m');
                            echo"

                                <div style='display:grid; grid-template-columns: 1fr 1fr 1fr; padding: 0px 7px;'>
                                    <div> <span class=\"p-card-bold\">Cliente: <span class=\"p-card\">".$chamadosFechados[$i]['cliente']."</span></span> </div>
                                    <div> <span class=\"p-card-bold\">Módulo: <span class=\"p-card\">".$chamadosFechados[$i]['modulo']."</span></span> </div>
                                    <div> <span class=\"p-card-bold\">Solicitante: <span class=\"p-card\">".$chamadosFechados[$i]['solicitante_externo']."</span></span> </div>
                                </div>
                                <div style='display:grid; grid-template-columns: 1fr 1fr 1fr; padding: 0px 7px;'>
                                    <div> <span class=\"p-card-bold\">Solicitante: <span class=\"p-card\">".$chamadosFechados[$i]['solicitante_externo']."</span></span> </div>
                                    <div> <span class=\"p-card-bold\">Tela: <span class=\"p-card\">".$chamadosFechados[$i]['tela']."</span></span> </div>
                                    <div> <span class=\"p-card-bold\">Status: <span class=\"p-card\">".$chamadosFechados[$i]['nome_etapa']."</span></span> </div>
                                </div>
                                <div style='padding: 0px 7px;'>
                                    <span class=\"p-card-bold\">Título: <span class=\"p-card\">".$chamadosFechados[$i]['titulo']."</span></span><br/>
                                </div>
                                <div style='padding: 0px 7px;'>
                                    <span class=\"p-card-bold\">Descrição: <span class=\"p-card\">".$chamadosFechados[$i]['descricao_chamado']."</span></span>
                                </div>
                                <hr/>
                                <div class=\"padding\">
                                    <div class=\"row container d-flex justify-content-center\">
                                        <div class=\"col-md-12\">
                                            <div class=\"card-chat card-bordered\">
                                                    <h5 class=\"p-card-bold\">Mensagens</h5>";
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
                                                <div class=\"ps-scrollbar-x-rail\" style=\"left: 0px; bottom: 0px;\"><div class=\"ps-scrollbar-x\" tabindex=\"0\" style=\"left: 0px; width: 0px;\"></div></div><div class=\"ps-scrollbar-y-rail\" style=\"top: 0px; height: 0px; right: 2px;\"><div class=\"ps-scrollbar-y\" tabindex=\"0\" style=\"top: 0px; height: 2px;\"></div></div></div>
                                                    <div class=\"publisher bt-1 border-light\">
                                                        <img class=\"avatar avatar-xs\" src=\"https://img.icons8.com/color/2x/circled-user-male-skin-type-4.png\" alt=\"...\">
                                                        <input class=\"publisher-input\" type=\"text\" placeholder=\"Digite a mensagem\"  name=\"nova_mensagem_externa\" id=\"nova_mensagem_externa".$chamadosFechados[$i]['id']."\">
                                                        <a class=\"publisher-btn text-info\" href=\"#\" data-abc=\"true\" onclick=\"enviarMensagemExternoChamado('".$chamadosFechados[$i]['id']."')\"> <i class=\"fa fa-paper-plane\"></i></a> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>";

                            ?>
                        </div>
                       
                    </div>
                </div>
</div>
        <!-- FIM MODAL -->
