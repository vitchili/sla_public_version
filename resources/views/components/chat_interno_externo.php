<?php
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
                        <input class=\"publisher-input\" type=\"text\" placeholder=\"Digite a mensagem\"  name=\"nova_mensagem_externa\" id=\"nova_mensagem_externa".$chamadosAbertos[$l]['id']."\">
                        <a class=\"publisher-btn text-info\" href=\"#\" data-abc=\"true\" onclick=\"enviarMensagemExternoChamado('".$chamadosAbertos[$l]['id']."')\"> <i class=\"fa fa-paper-plane\"></i></a> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>";