

<?= "
    <section class=\"white-section-card-100\" style=\"background-color: #f6f6f6;\">
        <div class=\"white-section-toggle-3-itens\" style=\"padding: 10px; border-bottom: .5px solid #cccccc;\">
            <div>
                <span class=\"p-card-bold div-form-google\">Switch Case</span>
            </div>
            <div>
                &nbsp;
            </div>
            <div class=\"setinha-toggle\">  
                <a data-toggle=\"collapse\" href=\"#switch-case-".$l."\" role=\"button\" aria-expanded=\"false\" aria-controls=\"collapseExample\">
                    <i class=\"fa fa-chevron-down\" ></i>
                </a>  
            </div>
        </div>

        <div class=\"collapse\" id=\"switch-case-".$l."\" style=\"background-color: #f6f6f6; padding: 10px;\">
        


            <div style=\"max-height: 350px; overflow-y: scroll; border: 1px solid rgba(1,1,1,.3);\">
                <table id=\"switch-case\" class=\"display\" style=\"position: relative; width:100%;\">
                    <thead style=\"background-color: #f3f3f3;\">
                        <tr>
                            <th colspan='4' style='text-align: center;'>&nbsp;Switch Case: envio para teste<br/><hr/></th>
                        </tr>
                        <tr>
                            <th colspan='4'>&nbsp;Base a ser testada a solução: <input type='text' class='form-control' id='base_a_ser_testado".$chamadosAssumidos[$l]['id_chamado']."' name='base_a_ser_testado".$chamadosAssumidos[$l]['id_chamado']."' placeholder='Insira aqui a base a ser testada a solução' value='".$base[$chamadosAssumidos[$l]['id_chamado']][0]."'/> </th>
                        </tr>
                        <tr>
                            <th>&nbsp;Caminho</th>
                            <th>&nbsp;Descrição</th>
                            <th>&nbsp;Esperado</th>
                            <th>&nbsp;Ocorrido</th>
                        </tr>
                    </thead>
                        <tr>
                            <td><textarea id=\"switchCaseCaminho0".$chamadosAssumidos[$l]['id_chamado']."\" class=\"switchcase form-control-larger\">".$caminho[$chamadosAssumidos[$l]['id_chamado']][0]."</textarea></td>
                            <td><textarea id=\"switchCaseDescricao0".$chamadosAssumidos[$l]['id_chamado']."\" class=\"switchcase form-control-larger\">".$descricao[$chamadosAssumidos[$l]['id_chamado']][0]."</textarea></td>
                            <td><textarea id=\"switchCaseEsperado0".$chamadosAssumidos[$l]['id_chamado']."\" class=\"switchcase form-control-larger\">".$esperado[$chamadosAssumidos[$l]['id_chamado']][0]."</textarea></td>
                            <td><textarea id=\"switchCaseOcorrido0".$chamadosAssumidos[$l]['id_chamado']."\" class=\"switchcase form-control-larger\" disabled>".$ocorrido[$chamadosAssumidos[$l]['id_chamado']][0]."</textarea></td>
                        </tr>
                        <tr>
                            <td><textarea id=\"switchCaseCaminho1".$chamadosAssumidos[$l]['id_chamado']."\" class=\"switchcase form-control-larger\">".$caminho[$chamadosAssumidos[$l]['id_chamado']][1]."</textarea></td>
                            <td><textarea id=\"switchCaseDescricao1".$chamadosAssumidos[$l]['id_chamado']."\" class=\"switchcase form-control-larger\">".$descricao[$chamadosAssumidos[$l]['id_chamado']][1]."</textarea></td>
                            <td><textarea id=\"switchCaseEsperado1".$chamadosAssumidos[$l]['id_chamado']."\" class=\"switchcase form-control-larger\">".$esperado[$chamadosAssumidos[$l]['id_chamado']][1]."</textarea></td>
                            <td><textarea id=\"switchCaseOcorrido1".$chamadosAssumidos[$l]['id_chamado']."\" class=\"switchcase form-control-larger\" disabled>".$ocorrido[$chamadosAssumidos[$l]['id_chamado']][1]."</textarea></td>
                        </tr>
                        <tr>
                            <td><textarea id=\"switchCaseCaminho2".$chamadosAssumidos[$l]['id_chamado']."\" class=\"switchcase form-control-larger\">".$caminho[$chamadosAssumidos[$l]['id_chamado']][2]."</textarea></td>
                            <td><textarea id=\"switchCaseDescricao2".$chamadosAssumidos[$l]['id_chamado']."\" class=\"switchcase form-control-larger\">".$descricao[$chamadosAssumidos[$l]['id_chamado']][2]."</textarea></td>
                            <td><textarea id=\"switchCaseEsperado2".$chamadosAssumidos[$l]['id_chamado']."\" class=\"switchcase form-control-larger\">".$esperado[$chamadosAssumidos[$l]['id_chamado']][2]."</textarea></td>
                            <td><textarea id=\"switchCaseOcorrido2".$chamadosAssumidos[$l]['id_chamado']."\" class=\"switchcase form-control-larger\" disabled>".$ocorrido[$chamadosAssumidos[$l]['id_chamado']][2]."</textarea></td>
                        </tr>
                        <tr>
                            <td><textarea id=\"switchCaseCaminho3".$chamadosAssumidos[$l]['id_chamado']."\" class=\"switchcase form-control-larger\">".$caminho[$chamadosAssumidos[$l]['id_chamado']][3]."</textarea></td>
                            <td><textarea id=\"switchCaseDescricao3".$chamadosAssumidos[$l]['id_chamado']."\" class=\"switchcase form-control-larger\">".$descricao[$chamadosAssumidos[$l]['id_chamado']][3]."</textarea></td>
                            <td><textarea id=\"switchCaseEsperado3".$chamadosAssumidos[$l]['id_chamado']."\" class=\"switchcase form-control-larger\">".$esperado[$chamadosAssumidos[$l]['id_chamado']][3]."</textarea></td>
                            <td><textarea id=\"switchCaseOcorrido3".$chamadosAssumidos[$l]['id_chamado']."\" class=\"switchcase form-control-larger\" disabled>".$ocorrido[$chamadosAssumidos[$l]['id_chamado']][3]."</textarea></td>
                        </tr>
                        <tr>
                            <td><textarea id=\"switchCaseCaminho4".$chamadosAssumidos[$l]['id_chamado']."\" class=\"switchcase form-control-larger\">".$caminho[$chamadosAssumidos[$l]['id_chamado']][4]."</textarea></td>
                            <td><textarea id=\"switchCaseDescricao4".$chamadosAssumidos[$l]['id_chamado']."\" class=\"switchcase form-control-larger\">".$descricao[$chamadosAssumidos[$l]['id_chamado']][4]."</textarea></td>
                            <td><textarea id=\"switchCaseEsperado4".$chamadosAssumidos[$l]['id_chamado']."\" class=\"switchcase form-control-larger\">".$esperado[$chamadosAssumidos[$l]['id_chamado']][4]."</textarea></td>
                            <td><textarea id=\"switchCaseOcorrido4".$chamadosAssumidos[$l]['id_chamado']."\" class=\"switchcase form-control-larger\" disabled>".$ocorrido[$chamadosAssumidos[$l]['id_chamado']][4]."</textarea></td>
                        </tr>
                        <tr>
                            <td><textarea id=\"switchCaseCaminho5".$chamadosAssumidos[$l]['id_chamado']."\" class=\"switchcase form-control-larger\">".$caminho[$chamadosAssumidos[$l]['id_chamado']][5]."</textarea></td>
                            <td><textarea id=\"switchCaseDescricao5".$chamadosAssumidos[$l]['id_chamado']."\" class=\"switchcase form-control-larger\">".$descricao[$chamadosAssumidos[$l]['id_chamado']][5]."</textarea></td>
                            <td><textarea id=\"switchCaseEsperado5".$chamadosAssumidos[$l]['id_chamado']."\" class=\"switchcase form-control-larger\">".$esperado[$chamadosAssumidos[$l]['id_chamado']][5]."</textarea></td>
                            <td><textarea id=\"switchCaseOcorrido5".$chamadosAssumidos[$l]['id_chamado']."\" class=\"switchcase form-control-larger\" disabled>".$ocorrido[$chamadosAssumidos[$l]['id_chamado']][5]."</textarea></td>
                        </tr>
                        <tr>
                            <td><textarea id=\"switchCaseCaminho6".$chamadosAssumidos[$l]['id_chamado']."\" class=\"switchcase form-control-larger\">".$caminho[$chamadosAssumidos[$l]['id_chamado']][6]."</textarea></td>
                            <td><textarea id=\"switchCaseDescricao6".$chamadosAssumidos[$l]['id_chamado']."\" class=\"switchcase form-control-larger\">".$descricao[$chamadosAssumidos[$l]['id_chamado']][6]."</textarea></td>
                            <td><textarea id=\"switchCaseEsperado6".$chamadosAssumidos[$l]['id_chamado']."\" class=\"switchcase form-control-larger\">".$esperado[$chamadosAssumidos[$l]['id_chamado']][6]."</textarea></td>
                            <td><textarea id=\"switchCaseOcorrido6".$chamadosAssumidos[$l]['id_chamado']."\" class=\"switchcase form-control-larger\" disabled>".$ocorrido[$chamadosAssumidos[$l]['id_chamado']][6]."</textarea></td>
                        </tr>
                        <tr>
                            <td><textarea id=\"switchCaseCaminho7".$chamadosAssumidos[$l]['id_chamado']."\" class=\"switchcase form-control-larger\">".$caminho[$chamadosAssumidos[$l]['id_chamado']][7]."</textarea></td>
                            <td><textarea id=\"switchCaseDescricao7".$chamadosAssumidos[$l]['id_chamado']."\" class=\"switchcase form-control-larger\">".$descricao[$chamadosAssumidos[$l]['id_chamado']][7]."</textarea></td>
                            <td><textarea id=\"switchCaseEsperado7".$chamadosAssumidos[$l]['id_chamado']."\" class=\"switchcase form-control-larger\">".$esperado[$chamadosAssumidos[$l]['id_chamado']][7]."</textarea></td>
                            <td><textarea id=\"switchCaseOcorrido7".$chamadosAssumidos[$l]['id_chamado']."\" class=\"switchcase form-control-larger\" disabled>".$ocorrido[$chamadosAssumidos[$l]['id_chamado']][7]."</textarea></td>
                        </tr>
                        <tr>
                            <td><textarea id=\"switchCaseCaminho8".$chamadosAssumidos[$l]['id_chamado']."\" class=\"switchcase form-control-larger\">".$caminho[$chamadosAssumidos[$l]['id_chamado']][8]."</textarea></td>
                            <td><textarea id=\"switchCaseDescricao8".$chamadosAssumidos[$l]['id_chamado']."\" class=\"switchcase form-control-larger\">".$descricao[$chamadosAssumidos[$l]['id_chamado']][8]."</textarea></td>
                            <td><textarea id=\"switchCaseEsperado8".$chamadosAssumidos[$l]['id_chamado']."\" class=\"switchcase form-control-larger\">".$esperado[$chamadosAssumidos[$l]['id_chamado']][8]."</textarea></td>
                            <td><textarea id=\"switchCaseOcorrido8".$chamadosAssumidos[$l]['id_chamado']."\" class=\"switchcase form-control-larger\" disabled>".$ocorrido[$chamadosAssumidos[$l]['id_chamado']][8]."</textarea></td>
                        </tr>
                        <tr>
                            <td><textarea id=\"switchCaseCaminho9".$chamadosAssumidos[$l]['id_chamado']."\" class=\"switchcase form-control-larger\">".$caminho[$chamadosAssumidos[$l]['id_chamado']][9]."</textarea></td>
                            <td><textarea id=\"switchCaseDescricao9".$chamadosAssumidos[$l]['id_chamado']."\" class=\"switchcase form-control-larger\">".$descricao[$chamadosAssumidos[$l]['id_chamado']][9]."</textarea></td>
                            <td><textarea id=\"switchCaseEsperado9".$chamadosAssumidos[$l]['id_chamado']."\" class=\"switchcase form-control-larger\">".$esperado[$chamadosAssumidos[$l]['id_chamado']][9]."</textarea></td>
                            <td><textarea id=\"switchCaseOcorrido9".$chamadosAssumidos[$l]['id_chamado']."\" class=\"switchcase form-control-larger\" disabled>".$ocorrido[$chamadosAssumidos[$l]['id_chamado']][9]."</textarea></td>
                        </tr>
                        <tr>
                            <td><textarea id=\"switchCaseCaminho10".$chamadosAssumidos[$l]['id_chamado']."\" class=\"switchcase form-control-larger\">".$caminho[$chamadosAssumidos[$l]['id_chamado']][10]."</textarea></td>
                            <td><textarea id=\"switchCaseDescricao10".$chamadosAssumidos[$l]['id_chamado']."\" class=\"switchcase form-control-larger\">".$descricao[$chamadosAssumidos[$l]['id_chamado']][10]."</textarea></td>
                            <td><textarea id=\"switchCaseEsperado10".$chamadosAssumidos[$l]['id_chamado']."\" class=\"switchcase form-control-larger\">".$esperado[$chamadosAssumidos[$l]['id_chamado']][10]."</textarea></td>
                            <td><textarea id=\"switchCaseOcorrido10".$chamadosAssumidos[$l]['id_chamado']."\" class=\"switchcase form-control-larger\" disabled>".$ocorrido[$chamadosAssumidos[$l]['id_chamado']][10]."</textarea></td>
                        </tr>
                        <tr>
                            <td><textarea id=\"switchCaseCaminho11".$chamadosAssumidos[$l]['id_chamado']."\" class=\"switchcase form-control-larger\">".$caminho[$chamadosAssumidos[$l]['id_chamado']][11]."</textarea></td>
                            <td><textarea id=\"switchCaseDescricao11".$chamadosAssumidos[$l]['id_chamado']."\" class=\"switchcase form-control-larger\">".$descricao[$chamadosAssumidos[$l]['id_chamado']][11]."</textarea></td>
                            <td><textarea id=\"switchCaseEsperado11".$chamadosAssumidos[$l]['id_chamado']."\" class=\"switchcase form-control-larger\">".$esperado[$chamadosAssumidos[$l]['id_chamado']][11]."</textarea></td>
                            <td><textarea id=\"switchCaseOcorrido11".$chamadosAssumidos[$l]['id_chamado']."\" class=\"switchcase form-control-larger\" disabled>".$ocorrido[$chamadosAssumidos[$l]['id_chamado']][11]."</textarea></td>
                        </tr>
                        
                </table>
            </div>
            <br/>
            <div class=\"setinha-toggle\">
                <button class=\"btn btn-outline-primary setinha-toggle\" style=\"position:relative;\" type=\"button\" onclick=\"salvarSwitchCase('".$chamadosAssumidos[$l]['id_chamado']."')\">Salvar Switch Case</button>
            </div>


        </div>
    </section>";