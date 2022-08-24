<?php 
    require_once __DIR__ . '/../../../app/Http/Controllers/SlaController.php';
    $dados = new SlaController; 
    require_once __DIR__ . '/../../../app/Http/Controllers/ControllerDocumentacaoChamados.php';
    $chamadosAbertosEmpresa = new ControllerDocumentacaoChamados;
?>
<div class="modal-body">
    <form id="formNewBug" method="POST" action="/suporte-aquicob/app/Http/Controllers/setDadosNovoBugSLA.php" enctype="multipart/form-data">
        <hr/>    
        <div style="display: grid; grid-template-columns: 15fr 1fr 15fr;">
            <div>
                <label for="cliente">Cliente: </label>
                <select name="cliente" id="cliente" class="form-control" required>
                    <?php
                        if(!isset($_GET['empresa'])){
                            $cliente = $dados->getNomeCliente();
                            for($i=0;$i<count($cliente);$i++){
                                echo "<option value=\"".$cliente[$i]['id']."\">".$cliente[$i]['cliente']."</option>";
                            }
                        }else{
                            $chamadosAbertos = $chamadosAbertosEmpresa->getNomeEmpresaByBanco($empresa);
                            echo "<option value=\"".$chamadosAbertos[0]['id']."\">".$chamadosAbertos[0]['cliente']."</option>";
                        }
                    ?>
                </select>
            </div>
            <div>
                &nbsp;
            </div>
            <div>
                <label for="envolvidos">E-mail notificado: </label>
                <?php
                    if(!isset($_GET['empresa'])){
                        echo
                        "<select name=\"envolvidos[]\" id=\"envolvidos\" class=\"form-control\" multiple>
                            <option value=\"\" disabled>-- Selecione o cliente antes --</option>
                        </select>";
                    }else{
                        echo 
                        "<input type='text' name=\"email_externo\" id=\"email_externo\" class=\"form-control\" value=\"\" required/>";
                    }
                ?>
            </div>
        </div>
        <div style="display: grid; grid-template-columns: 15fr 1fr 15fr;">
            <div>
                <label for="solicitante">Solicitante: </label>
                <?php
                    if(!isset($_GET['empresa'])){
                        echo "
                        <select name=\"solicitante\" id=\"solicitante\" class=\"form-control\" required>";
                            $solicitante = $dados->getNomeSolicitante();
                            for($i=0;$i<count($solicitante);$i++){
                                echo "<option value=\"".$solicitante[$i]['id']."\">".$solicitante[$i]['nome']."</option>";
                            }
                        echo "</select>
                        <input type=\"hidden\" name=\"solicitante_externo\" id=\"solicitante_externo\" value=\"\"/>";
                    }else{
                       echo "
                        <input type='text' name=\"solicitante_externo\" id=\"solicitante_externo\" class=\"form-control\" value='' required>
                        <input type=\"hidden\" name=\"solicitante\" id=\"solicitante\" value=\"12\"/>

                        <input type=\"hidden\" name=\"token\" id=\"token\" value=\"".$_GET['token']."\"/>
                        <input type=\"hidden\" name=\"empresa\" id=\"empresa\" value=\"".$_GET['empresa']."\"/>
                        <input type=\"hidden\" name=\"nome_usuario\" id=\"nome_usuario\" value=\"".$_GET['nome']."\"/>
                        <input type=\"hidden\" name=\"cargo\" id=\"cargo\" value=\"".$_GET['cargo']."\"/>
                        <input type=\"hidden\" name=\"email\" id=\"email\" value=\"".$_GET['email']."\"/>";
                          
                    }?>
                        
            </div> 
            <div>
                &nbsp;                        
            </div>
            <div>
                <label for="produto">Produto: </label>
                <select name="produto" id="produto" class="form-control" required>
                    <?php
                    $produto = $dados->getProdutoSLA();
                    echo "<option value=\"\" selected disabled>-- Selecione o produto --</option>";
                        for($i=0;$i<count($produto);$i++){
                            echo "<option value=\"".$produto[$i]['id']."\">".$produto[$i]['produto']."</option>";
                        }
                    ?>
                </select>
            </div>
        </div>
    
        <div style="display: grid; grid-template-columns: 15fr 1fr 15fr;">
            <div>
                <label for="modulo">Módulo: </label>
                <select name="modulo" id="modulo" class="form-control" required>
                    <option value="" selected disabled>-- Selecione o produto antes --</option>
                </select>
            </div>
            <div>
                &nbsp;                        
            </div>
            <div>
            <label for="tela">Tela: </label>
                    <select name="tela" id="tela" class="form-control" required>
                        <option value="" selected disabled>-- Selecione o módulo antes --</option>
                    </select>
            </div>
        </div>
        <?php if(!isset($_GET['empresa'])): ?>
            <div style="display: grid; grid-template-columns: 15fr 1fr 15fr;">
                <div>
                    <label for="prioridade">Nível de Urgência: </label>
                        <select name="prioridade" id="prioridade" class="form-control" required>
                            <option value="" selected disabled>-- Selecione a prioridade --</option>
                            <?php
                            //mesmo id do json com o bd. Provisorio. necessario puxar tudo do bd depois
                                require_once __DIR__ . '/../../../app/Http/Controllers/SlaController.php';
                                $dados = new SlaController;
                                $prioridades = $dados->getPrioridadesSLA();
                                for($i=0;$i<count($prioridades);$i++){
                                    echo "<option value=\"".$prioridades[$i]['id']."\">".$prioridades[$i]['nome']."</option>";
                                }
                            ?>
                        </select>
                </div>
                <div>
                &nbsp;          
                </div>
                <div>
                    <label for="solucaoSuporte">Direcionamento:</label><br/>
                    <div class="wrapper" style="margin-top: -10px;">
                        <input type="radio" name="direcionamento" id="option-1" value="S" checked>
                        <input type="radio" name="direcionamento" id="option-2" value="D">
                        <label for="option-1" class="option option-1">
                            <div class="dot"></div>
                            <span>&nbsp;Suporte</span>
                            </label>
                        <label for="option-2" class="option option-2">
                            <div class="dot"></div>
                            <span>&nbsp;Desenvolvimento</span>
                        </label>
                    </div>            
                </div>
            </div>
            <div style="display: grid; grid-template-columns: 15fr 1fr 15fr;">
                <div>
                    <label for="data_entrega_estimada">Data de entrega: </label>
                    <input class="form-control" type="date" id="data_entrega_estimada" name="data_entrega_estimada" value="dd-mm-yyyy" readonly/>
                </div>
                <div>&nbsp;</div>
                <div>
                    <label for="prazo_customizado" data-toggle="tooltip" data-placement="top" title="Justifique o prazo customizado na descrição do problema">Prazo customizado? </label>
                    <input class="form-control" type="date" id="prazo_customizado" name="prazo_customizado"/>
                    <span style="color: #c5c5c5; font-size: 10pt;">&nbsp;(Opcional. Justifique na descrição.)</span>
                </div>
            </div>
        <?php 
        else: 
        ?>
            <input type="hidden" name="prioridade" id="prioridade" value="6"/>
            <input type="hidden" name="direcionamento" id="direcionamento" value="D">
            <input type="hidden" name="data_entrega_estimada" id="data_entrega_estimada" value="01/01/2023"/>
            <input type="hidden" name="direcionamento" id="option-1" value="D" checked>
            <input type="hidden" name="direcionamento" id="option-2" value="D">
        <?php 
        endif;
        ?>
        <label for="titulo">Título: </label>
        <br/>
        <input type="text" name="titulo" id="titulo" class="form-control"/>
        <label for="descricao">Descrição: </label>
        
        <br/>
        <textarea name="descricao" id="descricao" class="form-control-input" style="height: 150px;" required placeholder="Insira aqui a descrição do problema"></textarea>
        <script>CKEDITOR.replace('descricao');</script>
        
        <label for="solucao_suporte">Anexos:</label><br/>
        
        <div>
            <div>
                <div class="aguardando-upload">
                    <span>Aguardando Upload</span>
                </div>
                <div class="sub-bloco-anexos">
                <span style="font-size: 9pt; padding-top:10px; margin-right: 25px; float:right;">(Opcional)</span>
                    <div class="white-section-card">
                        <div class="sub-sub-bloco-anexos">
                            <input type="file" id="fileToUpload" name="fileToUpload" accept="image/*" class="input-file-anexos"/>
                        </div>
                </div>
                </div>
            </div>
            <div>
                &nbsp;                        
            </div>
            <div>
                <div>
                    <div class="aguardando-upload">
                        <span>Aguardando Upload</span>
                    </div>
                    <div class="sub-bloco-anexos">
                    <span style="font-size: 9pt; padding-top:10px; margin-right: 25px; float:right;">(Opcional)</span>
                        <div class="white-section-card">
                            <div class="sub-sub-bloco-anexos">
                                <input type="file" id="fileToUpload2" name="fileToUpload2" accept="image/*" class="input-file-anexos"/>
                            </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!--<div class="bloco-anexos">
            <div class="aguardando-upload">
                <span>Aguardando Upload</span>
            </div>
            <div class="sub-bloco-anexos">
            <span style="font-size: 9pt; padding-top:10px; margin-right: 25px; float:right;">(Opcional)</span>
                <div class="white-section-card">
                    <div class="sub-sub-bloco-anexos">
                        <input type="file" id="fileToUpload3" name="fileToUpload3" accept="image/*" class="input-file-anexos"/>
                    </div>
            </div>
            </div>
        </div>-->
        
        <div style="display: block; text-align: right; margin-top: 10px;">
            <input type="submit" name="submit" id="hiddenBtnNovoBug" style="display:none;">
            <input type="button" class="btn btn-dommus-action copy-content" name="button" data-html="true" value=" Salvar " id="btn-enviar" onclick="return confirmaAlertBug()"/>
        </div>
    </form>
</div>
  
<script>
        $(function(){
			$('#modulo').change(function(){
				if( $(this).val() ) {
                    $.post("/suporte-aquicob/app/Http/api/getTelas.php",
                    {
                        modulo:  $(this).val()
                    },
                    function(dataStr, status){
                        var data = JSON.parse(dataStr); 

                        var options = '<option value="" disabled selected>-- Selecione a Tela --</option>';	
						for (var i = 0; i < data.length; i++) {
							options += '<option value="' + data[i].id + '">' + data[i].nome + '</option>';
						}
						$('#tela').html(options).show();
                    });
				} else {
					$('#tela').html('<option value="">– Escolha o módulo primeiro –</option>');
				}
                
			});
		});
        $(function(){
			$('#cliente').change(function(){
				if( $(this).val() ) {
                    $.post("/suporte-aquicob/app/Http/api/getEnvolvidos.php",
                    {
                        cliente:  $(this).val()
                    },
                    function(dataStr, status){
                        var data = JSON.parse(dataStr); 

                        var options = '<option value="" disabled selected>Pressione Ctrl + Click para selecionar vários</option>';	
						for (var i = 0; i < data.length; i++) {
							options += '<option value="' + data[i].email + '">' + data[i].email + '</option>';
						}
						$('#envolvidos').html(options).show();
                        $('#envolvidos').css("height", "100px");

                    });
				} else {
					$('#envolvidos').html('<option value="">– Selecione o cliente primeiro –</option>');
				}
                
			});
		});
        
        $(function(){
			$('#prioridade').change(function(){
				if( $('#modulo').val() && $('#tela').val() && $('#prioridade').val()) {
                    var modulo = $('#modulo').val();
                    var tela = $('#tela').val();
                    var prioridade = $('#prioridade').val();
                    $.post("suporte-aquicob/app/Http/api/getPesos.php",
                    {
                        modulo:  modulo,
                        tela: tela,
                        prioridade: prioridade
                    },
                    function(dataStr, status){
                        var data = JSON.parse(dataStr);
                        var dataEntregaPrevista = new Date;
                        var diaEntrega = dataEntregaPrevista.getDate()+2;
                        var mesEntrega = dataEntregaPrevista.getMonth()+1;
                        var anoEntrega = dataEntregaPrevista.getFullYear();

                        var data_entrega = $('#data_entrega_estimada').attr('value', anoEntrega + '-' + mesEntrega + '-' + diaEntrega);
                    });
				} else {
					
				}
                
			});
		});
        
        $(function(){
			$('#produto').change(function(){
				if( $(this).val() ) {
                    $.post("/suporte-aquicob/app/Http/api/getModulos.php",
                    {
                        produto:  $(this).val()
                    },
                    function(dataStr, status){
                        var data = JSON.parse(dataStr); 

                        var options = '<option value="" disabled selected>-- Selecione --</option>';	
						for (var i = 0; i < data.length; i++) {
							options += '<option value="' + data[i].id + '">' + data[i].modulo + '</option>';
						}
						$('#modulo').html(options).show();
                    });
				} else {
					$('#modulo').html('<option value="">– Escolha o produto primeiro –</option>');
				}
                
			});
		});
            //essa logistica esta pessima. Pense em uma melhoria.
            
            </script>

            <script>
            //essa logistica esta pessima. Pense em uma melhoria.
            // $(function(){
            //         $('#formNewBug input').on('change', function() {
            //                 $('#prazo').hide();
            //                     var prioridade = $('#prioridade').text();
            //                     var prazo = $('input[name=solucao_suporte_radio]:checked', '#formNewBug').val();
            //                     //alert(prazo);

            //                     var options = '<span  class=\"input-color\"  style=\"background-color: #cccccc; color: #000;\">Selecione a Tela–</span>';   
            //                     switch(prioridade){
            //                         case 'Urgente': 
            //                             if(prazo == 'S'){
            //                                 options = '<span class=\"input-color\" style=\"background-color: orange; color: #fff;\">48h</span>';
            //                             }else{
            //                                 options = '<span class=\"input-color\" style=\"background-color: red; color: #fff;\">4h</span>';
            //                             }

            //                         break;
            //                         case 'Alta': 
            //                             if(prazo == 'S'){
            //                                 options = '<span class=\"input-color\"  style=\"background-color: rgb(236, 236, 0); color: #000;\">72h</span>';
            //                             }else{
            //                                 options = '<span class=\"input-color\"  style=\"background-color: orange; color: #fff;\">24h</span>';
            //                             }

            //                         break;
            //                         case 'Média': 
            //                             if(prazo == 'S'){
            //                                 options = '<span class=\"input-color\"  style=\"background-color: rgb(236, 236, 0); color: #000;\">72h</span>';
            //                             }else{
            //                                 options = '<span class=\"input-color\"  style=\"background-color: orange; color: #000;\">24h</span>';
            //                             }

            //                         break;
            //                         case 'Baixa': 
            //                             if(prazo == 'S'){
            //                                 options = '<span class=\"input-color\"  style=\"background-color: rgb(34, 34, 201); color: #fff;\">120h</span>';
            //                             }else{
            //                                 options = '<span class=\"input-color\"  style=\"background-color: green; color: #fff;\">72h</span>';
            //                             }

            //                         break;
            //                         case 'Muito Baixa': 
            //                             if(prazo == 'S'){
            //                                 options = '<span class=\"input-color\" style=\"background-color: rgb(34, 34, 201); color: #fff;\">120h</span>';
            //                             }else{
            //                                 options = '<span class=\"input-color\" style=\"background-color: rgb(34, 34, 201); color: #fff;\">72h</span>';
            //                             }

            //                         break;
            //                     }
            //                 $('#prazo').html(options).show();
            //         });
            //     });
            
            </script>