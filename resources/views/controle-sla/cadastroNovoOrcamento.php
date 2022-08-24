<div class="modal-body">
    <form id="formNovoOrcamento" method="POST" action="../../../app/Http/Controllers/setDadosNovoBugSLA.php" enctype="multipart/form-data">
        <hr/>    
        <div style="display: grid; grid-template-columns: 15fr 1fr 15fr;">
            <div>
                <label for="cliente">Cliente: </label>
                <select name="cliente" id="cliente" class="form-control" required>
                    <?php
                    //mesmo id do json com o bd. Provisorio. necessario puxar tudo do bd depois
                        require_once __DIR__ . '/../../../app/Http/Controllers/SlaController.php';
                        $dados = new SlaController;
                        $cliente = $dados->getNomeCliente();
                        for($i=0;$i<count($cliente);$i++){
                            echo "<option value=\"".$cliente[$i]['id']."\">".$cliente[$i]['cliente']."</option>";
                        }
                    ?>
                </select>
            </div>
            <div>
                &nbsp;
            </div>
            <div>
                <label for="solicitante">Solicitante: </label>
                <select name="solicitante" id="solicitante" class="form-control" required>
                    <?php
                    $solicitante = $dados->getNomeSolicitante();
                        for($i=0;$i<count($solicitante);$i++){
                            echo "<option value=\"".$solicitante[$i]['id']."\">".$solicitante[$i]['nome']."</option>";
                        }
                    ?>
                </select>
            </div>
        </div>
        <div style="display: grid; grid-template-columns: 15fr 15fr 15fr 15fr;">
            <div>
                <label for="prazo">Total de horas: </label>
                <input type="number" min="0" name="total_horas" id="total_horas" class="form-control-input" style="width: 94%;" placeholder="R$">
            </div>
            <div>
                <label for="valor_hora">Valor da hora: </label>
                <input type="number" min="0" name="valor_hora" id="valor_hora" class="form-control-input" style="width: 94%;" placeholder="R$">                     
            </div>
            <div>
                <label for="desconto">Desconto: </label>
                <input type="number" min="0" name="desconto" id="desconto" class="form-control-input" style="width: 94%;" placeholder="R$">
            </div>
            <div>
                <label for="total_preco">Total: </label>
                <input type="number" name="total_preco" id="total_preco" class="form-control-input" style="width: 100%;" disabled value="R$">
            </div>
        </div>
        <div>
            <label for="descricao">Solicitação: </label>
            <br/>
            <textarea name="descricao" id="descricao" class="form-control-input" style="height: 150px;" required placeholder="Insira aqui a descrição da solicitação"></textarea>
        </div>
        <div style="display: grid; grid-template-columns: 15fr 1fr 15fr;">
            <div>
                <label for="data_entrega_estimada">Data de entrega: </label>
                <input class="form-control" type="date" id="data_entrega_estimada" name=data_entrega_estimada/>
            </div>
            <div>
                &nbsp;                        
            </div>
            <div>
                &nbsp;
            </div>
        </div>
        
        <br/>
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
                            <input type="file" id="fileToUpload2" name="fileToUpload2" accept="image/*" class="input-file-anexos"/>
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
                                <input type="file" id="fileToUpload" name="fileToUpload" accept="image/*" class="input-file-anexos"/>
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
            <input type="submit" name="submit" id="hiddenBtn">
            <input type="button" class="btn btn-dommus-action copy-content" name="button" data-html="true" value=" Salvar " id="btn-enviar" onclick="return confirmaAlertBug()"/>
        </div>
    </form>
</div>
  
<script>
        $(function(){
			$('#modulo').change(function(){
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
						$('#tela').html(options).show();
                    });
				} else {
					$('#tela').html('<option value="">? Escolha o m�dulo primeiro ?</option>');
				}
                
			});
		});
        $(function(){
			$('#produto').change(function(){
				if( $(this).val() ) {
                    $.post("../../../app/Http/api/getModulos.php",
                    {
                        produto:  $(this).val()
                    },
                    function(dataStr, status){
                        console.log(JSON.parse(dataStr));
                        var data = JSON.parse(dataStr); 

                        var options = '<option value="" disabled selected>-- Selecione --</option>';	
						for (var i = 0; i < data.length; i++) {
							options += '<option value="' + data[i].id + '">' + data[i].modulo + '</option>';
						}
						$('#modulo').html(options).show();
                    });
				} else {
					$('#modulo').html('<option value="">? Escolha o produto primeiro ?</option>');
				}
                
			});
		});
            //essa logistica esta pessima. Pense em uma melhoria.
            /*$(function(){
                    $('#tela').change(function(){
                        if( $(this).val() ) {
                            $('#prioridade').hide();
                            $('input[type="radio"]').prop('checked', false); 
                            $('#prazo').html('-');
                            var options = '<span  class=\"input-color\"  style=\"background-color: #cccccc; color: #000;\">Selecione a Tela?</span>';   
                            switch($(this).val()){
                                case '1':case '2':case '3':case '4':case '5':case '6': options = '<span class=\"input-color\" style=\"background-color: red; color: #fff;\">Urgente</span>';
                                break;
                                case '7':case '8':case '9': options = '<span class=\"input-color\"  style=\"background-color: orange; color: #fff;\">Alta</span>';
                                break;
                                case '10':case '11':case '12':case '13':case '14':case '15': options = '<span class=\"input-color\"  style=\"background-color: rgb(236, 236, 0); color: #000;\">M�dia</span>';
                                break;
                                case '16':case '17':case '18':case '19': options = '<span class=\"input-color\"  style=\"background-color: green; color: #fff;\">Baixa</span>';
                                break;
                                case '20':case '21':case '22':case '23':case '24':case '25':case '26': options = '<span class=\"input-color\" style=\"background-color: rgb(34, 34, 201); color: #fff;\">Muito Baixa</span>';
                                break;
                                default: options = '<span class=\"input-color\"  style=\"background-color: orange; color: #fff;\">Alta</span>';
                            }
                                
                                $('#prioridade').html(options).show();
                            
                        } else {
                            $('#prioridade').html('<span  class=\"input-color\"  style=\"background-color: #cccccc; color: #000;\">Selecione a Tela?</span>');
                        }
                    });
                });*/
            </script>

            <script>
            //essa logistica esta pessima. Pense em uma melhoria.
            $(function(){
                    $('#formNewBug input').on('change', function() {
                            $('#prazo').hide();
                                var prioridade = $('#prioridade').text();
                                var prazo = $('input[name=solucao_suporte_radio]:checked', '#formNewBug').val();
                                //alert(prazo);

                                var options = '<span  class=\"input-color\"  style=\"background-color: #cccccc; color: #000;\">Selecione a Tela?</span>';   
                                switch(prioridade){
                                    case 'Urgente': 
                                        if(prazo == 'S'){
                                            options = '<span class=\"input-color\" style=\"background-color: orange; color: #fff;\">48h</span>';
                                        }else{
                                            options = '<span class=\"input-color\" style=\"background-color: red; color: #fff;\">4h</span>';
                                        }

                                    break;
                                    case 'Alta': 
                                        if(prazo == 'S'){
                                            options = '<span class=\"input-color\"  style=\"background-color: rgb(236, 236, 0); color: #000;\">72h</span>';
                                        }else{
                                            options = '<span class=\"input-color\"  style=\"background-color: orange; color: #fff;\">24h</span>';
                                        }

                                    break;
                                    case 'M�dia': 
                                        if(prazo == 'S'){
                                            options = '<span class=\"input-color\"  style=\"background-color: rgb(236, 236, 0); color: #000;\">72h</span>';
                                        }else{
                                            options = '<span class=\"input-color\"  style=\"background-color: orange; color: #000;\">24h</span>';
                                        }

                                    break;
                                    case 'Baixa': 
                                        if(prazo == 'S'){
                                            options = '<span class=\"input-color\"  style=\"background-color: rgb(34, 34, 201); color: #fff;\">120h</span>';
                                        }else{
                                            options = '<span class=\"input-color\"  style=\"background-color: green; color: #fff;\">72h</span>';
                                        }

                                    break;
                                    case 'Muito Baixa': 
                                        if(prazo == 'S'){
                                            options = '<span class=\"input-color\" style=\"background-color: rgb(34, 34, 201); color: #fff;\">120h</span>';
                                        }else{
                                            options = '<span class=\"input-color\" style=\"background-color: rgb(34, 34, 201); color: #fff;\">72h</span>';
                                        }

                                    break;
                                }
                            $('#prazo').html(options).show();
                    });
                });
            
            </script>