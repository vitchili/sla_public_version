<div class="modal-body">
    <form id="formRegistroAtendimentos" method="POST" action="../../../app/Http/Controllers/setDadosNovoAtendimentoSuporte.php" enctype="multipart/form-data">
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
                <label for="solicitante_externo">Solicitante Externo: </label>
                <input type="text" name="solicitante_externo" id="solicitante_externo" class="form-control"/>
            </div> 
        </div>
        <div style="display: grid; grid-template-columns: 15fr 1fr 15fr;">
            <div>
                <label for="assunto">Assunto: </label>
                <br/>
                <input type="text" name="assunto" id="assunto" class="form-control"/>
            </div> 
            <div>
                &nbsp;                        
            </div>
            <div>
                <label for="resolvido">Resolvido: </label>
                <select name="resolvido" id="resolvido" class="form-control" required>
                    <option value="S">Sim</option>
                    <option value="N">Não</option>
                    <option value="P">Em andamento</option>
                    <option value="C">Corrigindo</option>
                </select>
            </div>
        </div>
        <div>
            <label for="descricao">Descrição: </label>
            <br/>
            <textarea name="descricao" id="descricao" class="form-control-input" style="height: 150px;" required placeholder="Insira aqui a descrição do atendimento"></textarea>
        </div>
        <div style="display: block; text-align: right; margin-top: 10px;">
            <input type="submit" name="submit" id="hiddenBtnNovoBug" style="display:none;">
            <input type="button" class="btn btn-dommus-action copy-content" name="button" data-html="true" value=" Salvar " id="btn-enviar" onclick="return confirmaNovoAtendimento()"/>
        </div>
    </form>
</div>
