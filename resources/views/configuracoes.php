<?php require_once '../../inc/header.php';
require_once __DIR__ . '/../../app/Http/Controllers/SlaController.php';
$objMeusDados = new SlaController;
$dados = $objMeusDados->getIdUsuarioLogado();
// get cargo: 
switch($dados[0]['cargo']){
    case 'ADM': $cargo = 'Administrativo';
    break;
    case 'SUP': $cargo = 'Suporte';
    break;
    case 'DEV': $cargo = 'Desenvolvedor';
    break;
    case 'TST': $cargo = 'Tester';
    break;
    case 'USR': $cargo = 'Usuário';
    break;
    default: $cargo = 'Usuário';
}    
?>
    <div class="blocoBody">
        <div style="width: 750px; margin: auto;">
            <section class="white-section-card-100" id="white-section2">
                <div id="manual">    
                    <div class="bloco-titulo">
                        <h1 class="titulo-card" style="margin-bottom: 0px;">Configurações</h1>
                    </div>
                    <div class="bloco-geral">    
                        <div class="sub-bloco">
                            <i class="far fa-clock icon-left fa-2x"></i>
                        </div>
                        <div class="sub-bloco">
                            <h2 class="sub-titulo-card">Configurações do Perfil</h2>
                            <p class="p-card">Tenha em mãos o controle dos seus dados.</p>
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
            
            <section class="white-section-card-100 cards-gerais">
                <div class="modal-body">
                    <form id="formNewBug" method="POST" action="#">
                        <hr/>
                        <div style="display: grid; grid-template-columns: 20fr 1fr 10fr">
                            <div>
                                <label for="nome">Nome: </label>
                                <input type="text" name="nome" id="nome" class="form-control" value="<?=$dados[0]['nome'];?>"/>
                            </div>
                            <div>
                                &nbsp;
                            </div>
                            <div>
                                <label for="email">E-mail: </label>
                                <input type="text" name="email" id="email" class="form-control" value="<?=$dados[0]['email'];?>"/>
                            </div>
                        </div>
                        <br/>
                        <div style="display: grid; grid-template-columns: 15fr 1fr 15fr 1fr 15fr;">
                            <div>
                                <label for="senha">Senha: </label>
                                <input type="password" name="senha" id="senha" class="form-control"/>
                            </div>
                            <div>
                                &nbsp;
                            </div>
                            <div>
                                <label for="confirm_senha">Confirme a senha: </label>
                                <input type="password" name="confirm_senha" id="confirm_senha" class="form-control"/>
                            </div>
                            <div>
                                &nbsp;
                            </div>
                            <div>
                                <label for="tipo_perfil">Perfil: </label>
                                <?php
                                    if($dados[0]['administrador'] == 'S'){
                                        echo "
                                        <select name=\"tipo_perfil\" id=\"tipo_perfil\" class=\"form-control\" required>
                                            <option value=\"".$dados[0]['cargo']."\">".$cargo."</option>
                                            <option value=\"ADM\">Administrativo</option>
                                            <option value=\"DEV\">Desenvolvedor</option>
                                            <option value=\"SUP\">Suporte</option>
                                            <option value=\"TST\">Teste</option>
                                        </select>
                                        ";
                                    }else{
                                        echo "
                                        <select name=\"tipo_perfil\" id=\"tipo_perfil\" class=\"form-control\">
                                            <option value=\"".$dados[0]['cargo']."\">".$cargo."</option>
                                        </select>
                                        ";
                                    }
                                ?>
                                
                                
                            </div> 
                        </div>
                        <div style="display: grid; grid-template-columns: 15fr 1fr 15fr;">
                            <div>
                                <label for="coordenacao">Coordenação: <span style="font-size: 8pt;">(enxerga dados de todos usuários)</span></label>
                                <?php
                                    $admS_N = $dados[0]['administrador'] == 'S'? 'Sim' : 'Não'; 
                                    if($dados[0]['administrador'] == 'S'){
                                        echo "
                                        <select name=\"coordenacao\" id=\"coordenacao\" class=\"form-control\" required>
                                            <option value=\"S\">Sim</option>
                                            <option value=\"N\">Não</option>
                                        </select>
                                        ";
                                    }else{
                                        echo "
                                        <select name=\"coordenacao\" id=\"coordenacao\" class=\"form-control\">
                                            <option value=\"".$dados[0]['administrador']."\">".$admS_N."</option>
                                        </select>
                                        ";
                                    }
                                ?>
                                
                            </div> 
                            <div>
                                &nbsp;                        
                            </div>
                            <div>
                                &nbsp;                        
                            </div>
                        </div>
                        <div style="display: block; text-align: right; margin-top: 10px;">
                            <input type="submit" name="submit" id="hiddenBtnNovoBug" style="display:none;">
                            <input type="button" class="btn btn-dommus-action copy-content" name="button" data-html="true" value=" Salvar " id="btn-enviar" onclick="salvarConfigUsuario();"/>
                        </div>
                    </form>
                </div>        
            </section>
        </div>
        
<?php require_once '../../inc/footer.php';?>