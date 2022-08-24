<section class="white-section-100">
                <?php echo "
                    <div class=\"bloco-titulo\">
                        <span class=\"titulo-card\" style=\"margin: 0px;\">Fila do funcionário: ".$userName."</span>
                        <form action=\"?user=\" method=\"get\" style=\"margin: 5px 15px auto auto;\">";?>
                        <?php    
                            echo "
                            <select name=\"user\" id=\"user\" class=\"form-control\">";
                                require_once __DIR__ . '/../../../app/Http/Controllers/SlaController.php';
                                $funcionarios = new SlaController;
                                $dados_funcionarios = $funcionarios->getNomeFuncionarios();
                                echo "<option value=\"\">-- Selecione o funcionário --</option>";
                                for($i=0;$i<count($dados_funcionarios);$i++){
                                    echo "<option value=\"".$dados_funcionarios[$i]['id']."\">".$dados_funcionarios[$i]['nome']."</option>";
                                }
                        echo "
                            </select>
                            <input type=\"submit\" id=\"botaoVerChamadosFuncionarios\" style=\"display:none;\"/>
                        </form>
                    </div>
                    <section class=\"white-section-100-invisible cards-gerais\"  style=\"min-height: 166px;\">
                        "; 
                        if(count($chamadosAssumidos) == 0){
                            echo "<div id=\"nenhum-chamado\" style=\"text-align: center;\"><p class=\"p-card\">Nenhum chamado na fila deste funcionário.</p></div>";
                        }
                        for($l=0;$l<count($chamadosAssumidos);$l++){
                                echo"
                                <section draggable=\"true\" id=\"".$chamadosAssumidos[$l]['id_chamado']."\" ondragstart=\"onDragStart(event);\" class=\"white-section-100 cards-gerais\" style=\"margin-bottom:10px;\" >
                                    <div class=\"white-section-toggle\">
                                        <div>
                                            "; //<span class=\"p-card div-form-google\"><span class=\"p-card-bold\">Cliente:</span> ".$chamadosAssumidos[$l]['cliente']." / <span class=\"p-card-bold\">Tela:</span> ".$chamadosAssumidos[$l]['tela']." / <span class=\"p-card-bold\">Prazo:</span> ".$chamadosAssumidos[$l]['prazo']." horas</span>
                                            
                                            if($chamadosAssumidos[$l]['tempo_restante'] != '0'){
                                                echo "<span class=\"p-card div-form-google\"><span class=\"p-card-bold\">ID: </span> #".$chamadosAssumidos[$l]['id_chamado']." / <span class=\"p-card-bold\">Título</span> ".$chamadosAssumidos[$l]['titulo']." / <span class=\"p-card-bold\">Prazo:</span> <div id=\"timer".($l+count($chamadosPrioridade))."\" style=\"color: orange; display: inline;\" >".$chamadosAssumidos[$l]['tempo_restante']."</div></span>";
                                            }else{
                                                echo "<span class=\"p-card div-form-google\"><span class=\"p-card-bold\">ID: </span> #".$chamadosAssumidos[$l]['id_chamado']." / <span class=\"p-card-bold\">Título:</span> ".$chamadosAssumidos[$l]['titulo']." / <span class=\"p-card-bold\">Prazo:</span> <div id=\"timer".($l+count($chamadosPrioridade))."\" style=\"color: red; display: inline;\" >".$chamadosAssumidos[$l]['tempo_restante']."</div></span>";
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
                                        <hr/>";
                                        $cadastrado_em[$i] = (new DateTime($getDadosChamado[0]['cadastrado_em']))->format('d/m/Y');
                                        $data_entrega[$i] = (new DateTime($getDadosChamado[0]['data_entrega_estimada']))->format('d/m/Y');
                                        if(!empty($chamadosAssumidos[$l]['total_preco'])){
                                            echo "
                                            <span class=\"p-card div-form-google\"><span class=\"p-card-bold\">Id:</span> #".$chamadosAssumidos[$l]['id_chamado']."</span><br/>
                                            <span class=\"p-card div-form-google\"><span class=\"p-card-bold\">Cliente:</span> ".$chamadosAssumidos[$l]['cliente']."</span><br/>
                                            <span class=\"p-card div-form-google\"><span class=\"p-card-bold\">Solicitante:</span> ".$chamadosAssumidos[$l]['solicitante']."</span><br/>
                                            <span class=\"p-card div-form-google\"><span class=\"p-card-bold\">Produto:</span> ".$chamadosAssumidos[$l]['produto']."</span><br/>
                                            <span class=\"p-card div-form-google\"><span class=\"p-card-bold\">Módulo:</span> ".$chamadosAssumidos[$l]['modulo']."</span><br/>
                                            <span class=\"p-card div-form-google\"><span class=\"p-card-bold\">Tela:</span> ".$chamadosAssumidos[$l]['tela']."</span><br/>
                                            <span class=\"p-card div-form-google\"><span class=\"p-card-bold\">Prioridade:</span> ".$chamadosAssumidos[$l]['prioridade']."</span><br/>
                                            <span class=\"p-card div-form-google\"><span class=\"p-card-bold\">Prazo:</span> ".$chamadosAssumidos[$l]['prazo']." horas</span><br/>
                                            <span class=\"p-card div-form-google\"><span class=\"p-card-bold\">Data de Cadastro:</span> ".$cadastrado_em[$i]."</span><br/>
                                            <span class=\"p-card div-form-google\"><span class=\"p-card-bold\">Data de Entrega:</span> ".$data_entrega[$i]."</span><br/>
                                            <span class=\"p-card div-form-google\"><span class=\"p-card-bold\">Descrição:</span> ".$chamadosAssumidos[$l]['descricao_chamado']."</span><br/>
                                            "; 
                                        }else{
                                            echo "
                                            <span class=\"p-card div-form-google\"><span class=\"p-card-bold\">Id:</span> #".$chamadosAssumidos[$l]['id_chamado']."</span><br/>
                                            <span class=\"p-card div-form-google\"><span class=\"p-card-bold\">Cliente:</span> ".$chamadosAssumidos[$l]['cliente']."</span><br/>
                                            <span class=\"p-card div-form-google\"><span class=\"p-card-bold\">Solicitante:</span> ".$chamadosAssumidos[$l]['solicitante']."</span><br/>
                                            <span class=\"p-card div-form-google\"><span class=\"p-card-bold\">Produto:</span> ".$chamadosAssumidos[$l]['produto']."</span><br/>
                                            <span class=\"p-card div-form-google\"><span class=\"p-card-bold\">Módulo:</span> ".$chamadosAssumidos[$l]['modulo']."</span><br/>
                                            <span class=\"p-card div-form-google\"><span class=\"p-card-bold\">Tela:</span> ".$chamadosAssumidos[$l]['tela']."</span><br/>
                                            <span class=\"p-card div-form-google\"><span class=\"p-card-bold\">Prioridade:</span> ".$chamadosAssumidos[$l]['prioridade']."</span><br/>
                                            <span class=\"p-card div-form-google\"><span class=\"p-card-bold\">Prazo:</span> ".$chamadosAssumidos[$l]['prazo']." horas</span><br/>
                                            <span class=\"p-card div-form-google\"><span class=\"p-card-bold\">Data de Cadastro:</span> ".$cadastrado_em[$i]."</span><br/>
                                            <span class=\"p-card div-form-google\"><span class=\"p-card-bold\">Data de Entrega:</span> ".$data_entrega[$i]."</span><br/>
                                            <span class=\"p-card div-form-google\"><span class=\"p-card-bold\">Descrição:</span> ".$chamadosAssumidos[$l]['descricao_chamado']."</span><br/>
                                            ";
                                        }  
                                        if(strlen($chamadosAssumidos[$l]['caminho_anexo']) > 0){
                                            echo "<span class=\"p-card div-form-google\"><span class=\"p-card-bold\">Anexos:</span> <a href=\"".$chamadosAssumidos[$l]['caminho_anexo']."\" target=\"_blank\" style=\"text-decoration: underline;\"> Ver anexo 1</a></span><br/>";
                                        }else if(strlen($chamadosAssumidos[$l]['caminho_anexo2']) > 0){
                                            echo "<span class=\"p-card div-form-google\"><span class=\"p-card-bold\">Anexos:</span> <a href=\"".$chamadosAssumidos[$l]['caminho_anexo2']."\" target=\"_blank\" style=\"text-decoration: underline;\"> Ver anexo 1</a></span><br/>";
                                        }else{
                                            echo "<span class=\"p-card div-form-google\"><span class=\"p-card-bold\">Anexos:</span> Sem anexos</span><br/>";
                                        }
                                        echo"
                                        
                                    </div>
                                </section>
                                ";
                        }
                    echo "
                        <div id=\"dropzoneChamado".$i."\">
                        </div>
                        <a>
                            <div ondragover=\"onDragOver(event);\" ondrop=\"onDropAssumir(event,".$i.",'".$userName."');\">
                                <section class=\"white-section-100 cards-gerais chess\">
                                    <br/><br/><br/>
                                    <span class=\"aviso-incluir\">
                                        <i class=\"fas fa-plus-circle\"></i>
                                        &nbsp;Incluir
                                        <span class=\"descricao-hover-geral\" id=\"descricao-incluir-arrastar\">Arraste um chamado para este campo</span>
                                    </span>
                                </section>
                            </div>    
                        </a>
                    </section>
            </section>";?>

            <script>
            $(function(){
                $('#user').change(function(){
                    $("#botaoVerChamadosFuncionarios").trigger('click');
                });
            });
            </script>