<?php require_once '../../../../inc/header.php';
require_once __DIR__ . '/../../../../app/Http/Controllers/SlaController.php';
$chamadosSLA = new SlaController;
$chamadosPrioridade = $chamadosSLA->getChamadosSLA('ADM'); // $_SESSION['cargo'] para ver so os chamados do mesmo cargo seu. Coloquei ADM momentaneamente pra todos ver todos.
$qtChamadosPrioridade = $chamadosSLA->getQtChamadosSLA('ADM');
?>
    <div class="blocoBody">
        <section class="white-section-card-100" id="white-section1">
            <div id="manual">    
                <div class="bloco-titulo">
                    <h1 class="titulo-card" style="margin-bottom: 0px;">Kanban</h1>
                </div>
                <div class="bloco-geral">    
                    <div class="sub-bloco">
                        <i class="fas fa-dice-d6 icon-left fa-2x"></i>
                    </div>
                    <div class="sub-bloco">
                        <h2 class="sub-titulo-card">Ferramenta Kanban (A fazer/Fazendo/Feito)</h2>
                        <p class="p-card">Controle de tarefas em backlog</p>
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
        <section style="display: grid; grid-template-columns: 30fr 1fr 30fr 1fr 30fr;">
            <section class="white-section-100">
                <div class="bloco-titulo">
                    <h1 class="titulo-card" style="margin-bottom: 0px;">A fazer</h1>
                </div>
                <br/>
                <?php
                    for($k=0;$k<count($chamadosPrioridade);$k++){
                        
                        if(true/*$_SESSION['administrador'] == 'S' || $userPower == 'SUP'*/){
                            echo"
                            <section id=\"".$chamadosPrioridade[$k]['id_chamado']."\" class=\"white-section-card-100-invisible postit cards-gerais\" style=\"position: relative; width: 85%; height: 250px; overflow-y: scroll; box-shadow: 5px 5px 3px rgba(0,0,0,.05);\">";
                        }else{
                            echo"
                            <section id=\"".$chamadosPrioridade[$k]['id_chamado']."\" class=\"white-section-card-100-invisible cards-gerais\" style=\"position: relative; width: 85%; height: 250px; overflow-y: scroll; box-shadow: 5px 5px 3px rgba(0,0,0,.05);\">";
                        }
                        echo "
                            <div class=\"white-section-toggle\">
                                <div>
                                    ";
                                    if($chamadosPrioridade[$k]['tempo_restante'] != '0'){
                                        echo "<img src=\"../../../../public/images/alfinete.png\" style=\"width: 45px;\"/> <span class=\"p-card div-form-google\"><span class=\"p-card-bold\">ID: </span> #".$chamadosPrioridade[$k]['id_chamado']." <br/> <span class=\"p-card-bold\">Título:</span> ".$chamadosPrioridade[$k]['titulo']." <hr/><br/><span class=\"p-card-bold\">Descrição:</span> ".$chamadosPrioridade[$k]['descricao_chamado'];
                                    }else{
                                        echo "<img src=\"../../../../public/images/alfinete.png\" style=\"width: 45px;\"/> <span class=\"p-card div-form-google\"><span class=\"p-card-bold\">ID: </span> #".$chamadosPrioridade[$k]['id_chamado']." <br/> <span class=\"p-card-bold\">Título:</span> ".$chamadosPrioridade[$k]['titulo']." <hr/><br/> <span class=\"p-card-bold\">Descrição:</span> ".$chamadosPrioridade[$k]['descricao_chamado'];
                                    } 
                                    echo "
                                </div>
                            </div>
                            
                        </section>
                        ";
                    }
                ?>
            </section>
            <section>&nbsp;</section>
            <section class="white-section-100">
                <div class="bloco-titulo">
                    <h1 class="titulo-card" style="margin-bottom: 0px;">Fazendo</h1>
                </div>
                (em construção)
            </section>
            <section>&nbsp;</section>
            <section class="white-section-100">
                <div class="bloco-titulo">
                    <h1 class="titulo-card" style="margin-bottom: 0px;">Feito</h1>
                </div>
                (em construção)
            </section>
        </section>
<?php require_once '../../../../inc/footer.php';?>