<?php require_once '../../../inc/header.php';?>
    <div class="blocoBody">
        <section class="white-section-card-100" id="white-section2">
            <div id="manual">    
                <div class="bloco-titulo">
                    <h1 class="titulo-card" style="margin-bottom: 0px;">Qualidade de Software</h1>
                </div>
                <div class="bloco-geral">    
                    <div class="sub-bloco">
                        <i class="far fa-clock icon-left fa-2x"></i>
                    </div>
                    <div class="sub-bloco">
                        <h2 class="sub-titulo-card">Testes</h2>
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
                <div class="">
                    <h4 class="titulo-card">Em análise do Tester</h4>
                    <ul class="timeline">
                        <?php
                        if(count($concluidosNaoPropagados) == 0){
                            echo "Nenhuma propagação pendente.";
                        }
                        for($i=0;$i<count($concluidosNaoPropagados);$i++){

                            $switchObj = $todosChamadosConcluidos->getSwitchCase($concluidosNaoPropagados[$i]['id_chamado']);
                            for($k=0;$k<12;$k++){
                                $idChamado[$concluidosNaoPropagados[$i]['id_chamado']][$k] = isset($switchObj[$k]['idChamado']) ? $switchObj[$k]['idChamado'] : '';
                                $caminho[$concluidosNaoPropagados[$i]['id_chamado']][$k] = isset($switchObj[$k]['caminho']) ? $switchObj[$k]['caminho'] : '';
                                $descricao[$concluidosNaoPropagados[$i]['id_chamado']][$k] = isset($switchObj[$k]['descricao']) ? $switchObj[$k]['descricao'] : '';
                                $esperado[$concluidosNaoPropagados[$i]['id_chamado']][$k] = isset($switchObj[$k]['esperado']) ? $switchObj[$k]['esperado'] : '';
                                $ocorrido[$concluidosNaoPropagados[$i]['id_chamado']][$k] = isset($switchObj[$k]['ocorrido']) ? $switchObj[$k]['ocorrido'] : '';
                                $base[$concluidosNaoPropagados[$i]['id_chamado']][$k] = isset($switchObj[$k]['base']) ? $switchObj[$k]['base'] : '';
                            }
                            $dataFormatadaCadastradoEm[$i] = (new DateTime($concluidosNaoPropagados[$i]['cadastrado_em']))->format('H:i:s d/m/Y');
                            $dataFormatadaIniciadoEm[$i] = (new DateTime($concluidosNaoPropagados[$i]['iniciado_em']))->format('H:i:s d/m/Y');
                            $dataFormatadaConcluidoEm[$i] = (new DateTime($concluidosNaoPropagados[$i]['concluido_em']))->format('H:i:s d/m/Y');
                            
                            echo"
                                <li>
                                    <p class=\"p-card\">
                                    <span class=\"p-card-bold\">ID: </span>#".$concluidosNaoPropagados[$i]['id_chamado']."<br/>
                                    <span class=\"p-card-bold\">Solicitante: </span>".$concluidosNaoPropagados[$i]['solicitante']."<br/>
                                    <span class=\"p-card-bold\">Resposável Solução: </span>".$concluidosNaoPropagados[$i]['responsavel']."<br/>
                                    <span class=\"p-card-bold\">Cliente: </span>".$concluidosNaoPropagados[$i]['cliente']."<br/>
                                    <span class=\"p-card-bold\">Data Solicitação: </span>".$dataFormatadaCadastradoEm[$i]."<br/>
                                    <span class=\"p-card-bold\">Data Implementação: </span>".$dataFormatadaIniciadoEm[$i]."<br/>
                                    <span class=\"p-card-bold\">Data Finalização: </span>".$dataFormatadaConcluidoEm[$i]."<br/>
                                    <span class=\"p-card-bold\">Descrição: </span><br/>".$concluidosNaoPropagados[$i]['descricao_chamado']."<br/>
                                    <span class=\"p-card-bold\">Modificação: </span><br/>".$concluidosNaoPropagados[$i]['modificacao']."<br/>
                                    <span class=\"p-card-bold\">Nome da Branch: </span>".$concluidosNaoPropagados[$i]['branch']."
                                    </p>

                            ";
                            if($userLogado[0]['cargo'] == 'TST'){
                                echo"
                                    <div style=\"max-height: 350px; overflow-y: scroll;\">
                                    <table id=\"switch-case\" class=\"display\" style=\"position: relative; width:100%;\">
                                        <thead style=\"background-color: #f3f3f3;\">
                                            <tr>
                                                <th colspan='4' style='text-align: center;'>&nbsp;Switch Case: Teste<hr/>
                                                <div style=\"text-align: right; \">
                                                    ";
                                                    if($concluidosNaoPropagados[$i]['iniciada_correcao_em'] == ''){    
                                                        echo "<button class=\"icon-play-pause\" style=\"outline: none; border: none; background-color: inherit\" onclick=\"playChamado(".$concluidosNaoPropagados[$i]['id_chamado'].",false, '".$_SESSION['cargo']."');\">
                                                                <i class=\"fas fa-play\" id=\"play-".$concluidosNaoPropagados[$i]['id_chamado']."\" style=\"color: #4caf50;\"></i>
                                                            </button>";
                                                    }else if($concluidosNaoPropagados[$i]['teste_em_pausa'] == 'S'){
                                                        echo "<button class=\"icon-play-pause\" style=\"outline: none; border: none; background-color: inherit\" onclick=\"retomaChamado(".$concluidosNaoPropagados[$i]['id_chamado'].", '".$_SESSION['cargo']."');\">
                                                                <i class=\"fas fa-play\" id=\"play-".$concluidosNaoPropagados[$i]['id_chamado']."\" style=\"color: #4caf50;\"></i>
                                                            </button>";
                                                    }else if($concluidosNaoPropagados[$i]['teste_em_pausa'] == 'N' || $concluidosNaoPropagados[$i]['teste_em_pausa'] == ''){
                                                        echo "<button class=\"icon-play-pause\" style=\"outline: none; border: none; background-color: inherit\" onclick=\"pausaChamado(".$concluidosNaoPropagados[$i]['id_chamado'].", '".$_SESSION['cargo']."');\">
                                                                <i class=\"fas fa-pause\" id=\"play-".$concluidosNaoPropagados[$i]['id_chamado']."\" style=\"color: #585858;\"></i>
                                                            </button>";
                                                    }
                                                        echo "
                                                    
                                                </div>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th colspan='4'>&nbsp;Base a ser testada a solução: <span type='text' disabled class='form-control' id='base_a_ser_testado".$concluidosNaoPropagados[$i]['id_chamado']."' name='base_a_ser_testado".$chamadosAssumidos[$i]['id_chamado']."' placeholder='Insira aqui a base a ser testada a solução' value='".$base[$chamadosAssumidos[$i]['id_chamado']][0]."'/> </th>
                                            </tr>
                                            <tr>
                                                <th>&nbsp;Caminho</th>
                                                <th>&nbsp;Descrição</th>
                                                <th>&nbsp;Esperado</th>
                                                <th>&nbsp;Ocorrido</th>
                                            </tr>
                                        </thead>
                                            <tr>
                                            <td><textarea id=\"switchCaseCaminho0".$concluidosNaoPropagados[$i]['id_chamado']."\" class=\"form-control-larger\" disabled>".$caminho[$concluidosNaoPropagados[$i]['id_chamado']][0]."</textarea></td>
                                            <td><textarea id=\"switchCaseDescricao0".$concluidosNaoPropagados[$i]['id_chamado']."\" class=\"form-control-larger\" disabled>".$descricao[$concluidosNaoPropagados[$i]['id_chamado']][0]."</textarea></td>
                                            <td><textarea id=\"switchCaseEsperado0".$concluidosNaoPropagados[$i]['id_chamado']."\" class=\"form-control-larger\" disabled>".$esperado[$concluidosNaoPropagados[$i]['id_chamado']][0]."</textarea></td>
                                            <td><textarea id=\"switchCaseOcorrido0".$concluidosNaoPropagados[$i]['id_chamado']."\" class=\"form-control-larger\"></textarea></td>
                                            </tr>
                                            <tr>
                                                <td><textarea id=\"switchCaseCaminho1".$concluidosNaoPropagados[$i]['id_chamado']."\" class=\"form-control-larger\" disabled>".$caminho[$concluidosNaoPropagados[$i]['id_chamado']][1]."</textarea></td>
                                                <td><textarea id=\"switchCaseDescricao1".$concluidosNaoPropagados[$i]['id_chamado']."\" class=\"form-control-larger\" disabled>".$descricao[$concluidosNaoPropagados[$i]['id_chamado']][1]."</textarea></td>
                                                <td><textarea id=\"switchCaseEsperado1".$concluidosNaoPropagados[$i]['id_chamado']."\" class=\"form-control-larger\" disabled>".$esperado[$concluidosNaoPropagados[$i]['id_chamado']][1]."</textarea></td>
                                                <td><textarea id=\"switchCaseOcorrido1".$concluidosNaoPropagados[$i]['id_chamado']."\" class=\"form-control-larger\"></textarea></td>
                                            </tr>
                                            <tr>
                                                <td><textarea id=\"switchCaseCaminho2".$concluidosNaoPropagados[$i]['id_chamado']."\" class=\"form-control-larger\" disabled>".$caminho[$concluidosNaoPropagados[$i]['id_chamado']][2]."</textarea></td>
                                                <td><textarea id=\"switchCaseDescricao2".$concluidosNaoPropagados[$i]['id_chamado']."\" class=\"form-control-larger\" disabled>".$caminho[$concluidosNaoPropagados[$i]['id_chamado']][2]."</textarea></td>
                                                <td><textarea id=\"switchCaseEsperado2".$concluidosNaoPropagados[$i]['id_chamado']."\" class=\"form-control-larger\" disabled>".$caminho[$concluidosNaoPropagados[$i]['id_chamado']][2]."</textarea></td>
                                                <td><textarea id=\"switchCaseOcorrido2".$concluidosNaoPropagados[$i]['id_chamado']."\" class=\"form-control-larger\"></textarea></td>
                                            </tr>
                                            <tr>
                                                <td><textarea id=\"switchCaseCaminho3".$concluidosNaoPropagados[$i]['id_chamado']."\" class=\"form-control-larger\" disabled>".$caminho[$concluidosNaoPropagados[$i]['id_chamado']][3]."</textarea></td>
                                                <td><textarea id=\"switchCaseDescricao3".$concluidosNaoPropagados[$i]['id_chamado']."\" class=\"form-control-larger\" disabled>".$descricao[$concluidosNaoPropagados[$i]['id_chamado']][3]."</textarea></td>
                                                <td><textarea id=\"switchCaseEsperado3".$concluidosNaoPropagados[$i]['id_chamado']."\" class=\"form-control-larger\" disabled>".$esperado[$concluidosNaoPropagados[$i]['id_chamado']][3]."</textarea></td>
                                                <td><textarea id=\"switchCaseOcorrido3".$concluidosNaoPropagados[$i]['id_chamado']."\" class=\"form-control-larger\"></textarea></td>
                                            </tr>
                                            <tr>
                                                <td><textarea id=\"switchCaseCaminho4".$concluidosNaoPropagados[$i]['id_chamado']."\" class=\"form-control-larger\" disabled>".$caminho[$concluidosNaoPropagados[$i]['id_chamado']][4]."</textarea></td>
                                                <td><textarea id=\"switchCaseDescricao4".$concluidosNaoPropagados[$i]['id_chamado']."\" class=\"form-control-larger\" disabled>".$descricao[$concluidosNaoPropagados[$i]['id_chamado']][4]."</textarea></td>
                                                <td><textarea id=\"switchCaseEsperado4".$concluidosNaoPropagados[$i]['id_chamado']."\" class=\"form-control-larger\" disabled>".$esperado[$concluidosNaoPropagados[$i]['id_chamado']][4]."</textarea></td>
                                                <td><textarea id=\"switchCaseOcorrido4".$concluidosNaoPropagados[$i]['id_chamado']."\" class=\"form-control-larger\"></textarea></td>
                                            </tr>
                                            <tr>
                                                <td><textarea id=\"switchCaseCaminho5".$concluidosNaoPropagados[$i]['id_chamado']."\" class=\"form-control-larger\" disabled>".$caminho[$concluidosNaoPropagados[$i]['id_chamado']][5]."</textarea></td>
                                                <td><textarea id=\"switchCaseDescricao5".$concluidosNaoPropagados[$i]['id_chamado']."\" class=\"form-control-larger\" disabled>".$caminho[$concluidosNaoPropagados[$i]['id_chamado']][5]."</textarea></td>
                                                <td><textarea id=\"switchCaseEsperado5".$concluidosNaoPropagados[$i]['id_chamado']."\" class=\"form-control-larger\" disabled>".$caminho[$concluidosNaoPropagados[$i]['id_chamado']][5]."</textarea></td>
                                                <td><textarea id=\"switchCaseOcorrido5".$concluidosNaoPropagados[$i]['id_chamado']."\" class=\"form-control-larger\"></textarea></td>
                                            </tr>
                                            <tr>
                                                <td><textarea id=\"switchCaseCaminho6".$concluidosNaoPropagados[$i]['id_chamado']."\" class=\"form-control-larger\" disabled>".$caminho[$concluidosNaoPropagados[$i]['id_chamado']][6]."</textarea></td>
                                                <td><textarea id=\"switchCaseDescricao6".$concluidosNaoPropagados[$i]['id_chamado']."\" class=\"form-control-larger\" disabled>".$descricao[$concluidosNaoPropagados[$i]['id_chamado']][6]."</textarea></td>
                                                <td><textarea id=\"switchCaseEsperado6".$concluidosNaoPropagados[$i]['id_chamado']."\" class=\"form-control-larger\" disabled>".$esperado[$concluidosNaoPropagados[$i]['id_chamado']][6]."</textarea></td>
                                                <td><textarea id=\"switchCaseOcorrido6".$concluidosNaoPropagados[$i]['id_chamado']."\" class=\"form-control-larger\"></textarea></td>
                                            </tr>
                                            <tr>
                                                <td><textarea id=\"switchCaseCaminho7".$concluidosNaoPropagados[$i]['id_chamado']."\" class=\"form-control-larger\" disabled>".$caminho[$concluidosNaoPropagados[$i]['id_chamado']][7]."</textarea></td>
                                                <td><textarea id=\"switchCaseDescricao7".$concluidosNaoPropagados[$i]['id_chamado']."\" class=\"form-control-larger\" disabled>".$descricao[$concluidosNaoPropagados[$i]['id_chamado']][7]."</textarea></td>
                                                <td><textarea id=\"switchCaseEsperado7".$concluidosNaoPropagados[$i]['id_chamado']."\" class=\"form-control-larger\" disabled>".$esperado[$concluidosNaoPropagados[$i]['id_chamado']][7]."</textarea></td>
                                                <td><textarea id=\"switchCaseOcorrido7".$concluidosNaoPropagados[$i]['id_chamado']."\" class=\"form-control-larger\"></textarea></td>
                                            </tr>
                                            <tr>
                                                <td><textarea id=\"switchCaseCaminho8".$concluidosNaoPropagados[$i]['id_chamado']."\" class=\"form-control-larger\" disabled>".$caminho[$concluidosNaoPropagados[$i]['id_chamado']][8]."</textarea></td>
                                                <td><textarea id=\"switchCaseDescricao8".$concluidosNaoPropagados[$i]['id_chamado']."\" class=\"form-control-larger\" disabled>".$caminho[$concluidosNaoPropagados[$i]['id_chamado']][8]."</textarea></td>
                                                <td><textarea id=\"switchCaseEsperado8".$concluidosNaoPropagados[$i]['id_chamado']."\" class=\"form-control-larger\" disabled>".$caminho[$concluidosNaoPropagados[$i]['id_chamado']][8]."</textarea></td>
                                                <td><textarea id=\"switchCaseOcorrido8".$concluidosNaoPropagados[$i]['id_chamado']."\" class=\"form-control-larger\"></textarea></td>
                                            </tr>
                                            <tr>
                                                <td><textarea id=\"switchCaseCaminho9".$concluidosNaoPropagados[$i]['id_chamado']."\" class=\"form-control-larger\" disabled>".$caminho[$concluidosNaoPropagados[$i]['id_chamado']][9]."</textarea></td>
                                                <td><textarea id=\"switchCaseDescricao9".$concluidosNaoPropagados[$i]['id_chamado']."\" class=\"form-control-larger\" disabled>".$descricao[$concluidosNaoPropagados[$i]['id_chamado']][9]."</textarea></td>
                                                <td><textarea id=\"switchCaseEsperado9".$concluidosNaoPropagados[$i]['id_chamado']."\" class=\"form-control-larger\" disabled>".$esperado[$concluidosNaoPropagados[$i]['id_chamado']][9]."</textarea></td>
                                                <td><textarea id=\"switchCaseOcorrido9".$concluidosNaoPropagados[$i]['id_chamado']."\" class=\"form-control-larger\"></textarea></td>
                                            </tr>
                                            <tr>
                                                <td><textarea id=\"switchCaseCaminho10".$concluidosNaoPropagados[$i]['id_chamado']."\" class=\"form-control-larger\" disabled>".$caminho[$concluidosNaoPropagados[$i]['id_chamado']][10]."</textarea></td>
                                                <td><textarea id=\"switchCaseDescricao10".$concluidosNaoPropagados[$i]['id_chamado']."\" class=\"form-control-larger\" disabled>".$descricao[$concluidosNaoPropagados[$i]['id_chamado']][10]."</textarea></td>
                                                <td><textarea id=\"switchCaseEsperado10".$concluidosNaoPropagados[$i]['id_chamado']."\" class=\"form-control-larger\" disabled>".$esperado[$concluidosNaoPropagados[$i]['id_chamado']][10]."</textarea></td>
                                                <td><textarea id=\"switchCaseOcorrido10".$concluidosNaoPropagados[$i]['id_chamado']."\" class=\"form-control-larger\"></textarea></td>
                                            </tr>
                                            <tr>
                                                <td><textarea id=\"switchCaseCaminho11".$concluidosNaoPropagados[$i]['id_chamado']."\" class=\"form-control-larger\" disabled>".$caminho[$concluidosNaoPropagados[$i]['id_chamado']][11]."</textarea></td>
                                                <td><textarea id=\"switchCaseDescricao11".$concluidosNaoPropagados[$i]['id_chamado']."\" class=\"form-control-larger\" disabled>".$caminho[$concluidosNaoPropagados[$i]['id_chamado']][11]."</textarea></td>
                                                <td><textarea id=\"switchCaseEsperado11".$concluidosNaoPropagados[$i]['id_chamado']."\" class=\"form-control-larger\" disabled>".$caminho[$concluidosNaoPropagados[$i]['id_chamado']][11]."</textarea></td>
                                                <td><textarea id=\"switchCaseOcorrido11".$concluidosNaoPropagados[$i]['id_chamado']."\" class=\"form-control-larger\"></textarea></td>
                                            </tr>
                                    </table>
                                </div>
                                <br/>
                                    <div class=\"setinha-toggle\">";
                                    if($concluidosNaoPropagados[$i]['aprovacao_tester'] != $userLogado[0]['id'] && ($userLogado[0]['peso_permissao'] == '1' || $userLogado[0]['peso_permissao'] == '2')){
                                        echo "<button class=\"btn copy-content\" style=\"background-color: red; color: #fff\" onclick=\"reprovarProp(".$concluidosNaoPropagados[$i]['id_chamado'].");\">Reprovar</button>";
                                        echo "<button class=\"btn btn-dommus-action copy-content\" onclick=\"autorizarProp(".$concluidosNaoPropagados[$i]['id_chamado'].");\">Aprovar</button>";
                                    }
                                    echo "
                                        </div>
                                    <hr/>  
                                </li>
                                ";
                            }
                            echo "<section class=\"white-section-card-100\" style=\"background-color: #f6f6f6;\">
                                <div class=\"white-section-toggle-3-itens\" style=\"padding: 10px; border-bottom: .5px solid #cccccc;\">
                                    <div>
                                        <span class=\"p-card-bold div-form-google\">Conversas</span>
                                    </div>
                                    <div>
                                        &nbsp;
                                    </div>
                                    <div class=\"setinha-toggle\">  
                                        <a data-toggle=\"collapse\" href=\"#conversa_chamado".$i."\" role=\"button\" aria-expanded=\"false\" aria-controls=\"collapseExample\">
                                            <i class=\"fa fa-chevron-down\" ></i>
                                        </a>  
                                    </div>
                                </div>
                                
                                <div class=\"collapse\" id=\"conversa_chamado".$i."\" style=\"background-color: #f6f6f6;\">
                                    ";
                                    $mensagens_conversa = $todosChamadosConcluidos->getConversaChamado($concluidosNaoPropagados[$i]['id_chamado']);
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
                                        <textarea placeholder=\"Digite uma mensagem\" name=\"nova_mensagem\" id=\"nova_mensagem".$concluidosNaoPropagados[$i]['id_chamado']."\" class=\"form-control-input\" style=\"height: 72px; margin: 5px;\"></textarea>
                                    </div>
                                    <button class=\"btn setinha-toggle\" style=\"position:relative; color: #fff; background-color: #0066b1; margin: 10px;\" type=\"button\" onclick=\"enviarMensagemChamado('".$concluidosNaoPropagados[$i]['id_chamado']."')\">Enviar mensagem</button>
                                </div>
                            </section>";
                        }
                        ?>
                    </ul>
                </div>
            </section>
                
<?php require_once '../../../inc/footer.php';?>