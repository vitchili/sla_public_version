var count = 0;
function estenderMenu(){
    if(count % 2 == '0'){
        var menuVertical = document.getElementById('menuVertical');
        menuVertical.setAttribute("style","width:15%;");

        var showItemHide = document.getElementById('itemHide');
        showItemHide.setAttribute("style", "opacity:1;");
        
        var showItemHide2 = document.getElementById('itemHide2');
        showItemHide2.setAttribute("style", "opacity:1;");
        
        var showItemHide3 = document.getElementById('itemHide3');
        showItemHide3.setAttribute("style", "opacity:1;");
        
        var showItemHide4 = document.getElementById('itemHide4');
        showItemHide4.setAttribute("style", "opacity:1;");
        
        var showItemHide5 = document.getElementById('itemHide5');
        showItemHide5.setAttribute("style", "opacity:1;");
        
        var showItemHide6 = document.getElementById('itemHide6');
        showItemHide6.setAttribute("style", "opacity:1;");

        var showItemHide7 = document.getElementById('itemHide7');
        showItemHide7.setAttribute("style", "opacity:1;");

        var showItemHide8 = document.getElementById('itemHide8');
        showItemHide8.setAttribute("style", "opacity:1;");
        /****************Modifica as sections ******************/

        var section = document.getElementById('white-section');
        section.setAttribute("style", "max-width:82%; margin:15px 20px 15px auto; left: 0px");
        
        var section2 = document.getElementById('white-section2');
        section2.setAttribute("style", "max-width:82%; margin:15px 20px 15px auto; left: 0px");

        var section3 = document.getElementById('white-section3');
        section3.setAttribute("style", "max-width:82%; margin:15px 20px 15px auto; left: 0px");

        var section4 = document.getElementById('white-section4');
        section4.setAttribute("style", "max-width:82%; margin:15px 20px 15px auto; left: 0px");

        count++;
        
    }else{
        var menuVertical = document.getElementById('menuVertical');
        menuVertical.setAttribute("style","width:50px;");

        var showItemHide = document.getElementById('itemHide');
        showItemHide.setAttribute("style", "opacity:0;");

        
        var showItemHide2 = document.getElementById('itemHide2');
        showItemHide2.setAttribute("style", "opacity:0;");

        
        var showItemHide3 = document.getElementById('itemHide3');
        showItemHide3.setAttribute("style", "opacity:0;");

        
        var showItemHide4 = document.getElementById('itemHide4');
        showItemHide4.setAttribute("style", "opacity:0;");

        
        var showItemHide5 = document.getElementById('itemHide5');
        showItemHide5.setAttribute("style", "opacity:0;");

        
        var showItemHide6 = document.getElementById('itemHide6');
        showItemHide6.setAttribute("style", "opacity:0;");

        var showItemHide7 = document.getElementById('itemHide7');
        showItemHide7.setAttribute("style", "opacity:0;");

        var showItemHide8 = document.getElementById('itemHide8');
        showItemHide8.setAttribute("style", "opacity:0;");
        /****************Modifica as sections ******************/

        var section = document.getElementById('white-section');
        section.setAttribute("style", "max-width:94%;  margin: 15px auto 15px auto;");

        var section2 = document.getElementById('white-section2');
        section2.setAttribute("style", "max-width:94%;  margin: 15px auto 15px auto;");

        var section3 = document.getElementById('white-section3');
        section3.setAttribute("style", "max-width:94%;  margin: 15px auto 15px auto;");

        var section4 = document.getElementById('white-section4');
        section4.setAttribute("style", "max-width:94%;  margin: 15px auto 15px auto;");

        count++;
    }
}



var countDrop = 0;
//key indica se vem do index ou do resources. key 1 = index. key 2 = resources 
function dropdownMenu(key){
    if(key == 1){
        if(countDrop % 2 == 0){
            var drop = `
                    <ul class="user-wrapper">
                        <li class=\"list-user-wrapper">
                            <a class="link-nav" href="/suporte-aquicob/sair.php">
                            <div class="divSair">
                                <span class="sair">Sair</span>
                                <i class="fas fa-power-off iconSair"></i>
                            </div>
                            </a>
                        </li>
                        <li class=\"list-user-wrapper">
                            <a class="link-nav" href="/suporte-aquicob/resources/views/configuracoes.php">
                            <div class="divSair">
                                <span class="sair">Perfil</span>
                                <i class="fas fa-cog iconSair"></i>
                            </div>
                            </a>
                        </li>
                    </ul>
            `;
            dropdownitens.innerHTML = `${drop}`;
            countDrop ++;
        }else {
            var drop = ``;
            dropdownitens.innerHTML = `${drop}`;
            countDrop ++;
        }
    }else{
        if(countDrop % 2 == 0){
            var drop = `
                    <ul class="user-wrapper">
                        <li class=\"list-user-wrapper">
                            <a class="link-nav" href="/suporte-aquicob/sair.php">
                            <div class="divSair">
                                <span class="sair">Sair</span>
                                <i class="fas fa-power-off iconSair"></i>
                            </div>
                            </a>
                        </li>
                        <li class=\"list-user-wrapper">
                            <a class="link-nav" href="/suporte-aquicob/resources/views/configuracoes.php">
                            <div class="divSair">
                                <span class="sair">Perfil</span>
                                <i class="fas fa-cog iconSair"></i>
                            </div>
                            </a>
                        </li>
                    </ul>
            `;
            dropdownitens.innerHTML = `${drop}`;
            countDrop ++;
        }else {
            var drop = ``;
            dropdownitens.innerHTML = `${drop}`;
            countDrop ++;
        }
    }
    
}
function textAreaAdjust(element) {
    element.style.height = "1px";
    element.style.height = (25+element.scrollHeight)+"px";
}

  
function testeEdit(id_chamado){
var cliente = $('#clienteEdit'+id_chamado).val();
var solicitante = $('#solicitanteEdit'+id_chamado).val();
var produto = $('#produtoEdit'+id_chamado).val();
var modulo = $('#moduloEdit'+id_chamado).val();
var tela = $('#telaEdit'+id_chamado).val();
var suporte = $('#suporte'+id_chamado).val();
var desenvolvimento = $('#desenvolvimento'+id_chamado).val();
var prioridade = $('#prioridadeEdit'+id_chamado).val();
var data_entrega = $('#data_entrega_estimada_edit'+id_chamado).val();
var titulo = $('#tituloEdit'+id_chamado).val();
var descricao = CKEDITOR.instances['descricaoEdit'+id_chamado].getData();
$.post("../../../app/Http/Controllers/setDadosUpdateSLA.php",
    {
        id_chamado : id_chamado, 
        cliente : cliente, 
        solicitante : solicitante, 
        produto : produto, 
        modulo : modulo, 
        tela : tela, 
        suporte : suporte, 
        desenvolvimento : desenvolvimento, 
        prioridade : prioridade, 
        data_entrega : data_entrega, 
        titulo : titulo, 
        descricao : descricao
    },
    function(dataStr, status){
        Swal.fire({
            icon: 'success',
            title: 'Chamado editado com sucesso',
            showConfirmButton: true,
            timer: 2500
            });
            // trigger click event of the hidden button
    });

}


function getIdChamadoModal(){
    $("#getIdChamadoModal").trigger('click');
}
//Alert de topico criado com sucesso
function confirmaAlert(){
    Swal.fire({
    icon: 'success',
    title: 'Novidade criada com sucesso',
    showConfirmButton: true,
    timer: 2500
    });        
    setTimeout(function(){ $('#hiddenBtn').trigger("click"); }, 2000);
    // trigger click event of the hidden button

}
//Alert de informartivo de bug criado com sucesso
function confirmaAlertBug(){

    var tela = document.getElementById('tela');
    var telaVal = tela.options[tela.selectedIndex].value;

    var direcionamentoDev = document.getElementById('option-2').checked;
    var direcionamentoSup = document.getElementById('option-1').checked;

    if(telaVal > 0 && (direcionamentoDev || direcionamentoSup)){
        Swal.fire({
            icon: 'success',
            title: 'Informativo criado com sucesso',
            showConfirmButton: true,
            timer: 2500
            });        
            setTimeout(function(){ $('#hiddenBtnNovoBug').trigger("click"); }, 2000);
    }else{
        Swal.fire({
            icon: 'error',
            title: 'Itens obrigatórios',
            text: 'Selecione todos itens obrigatórios para abrir o chamado!',
            footer: ''
          })
    }
}
function confirmaNovoAtendimento(){

    var cliente = document.getElementById('cliente');
    var solicitante_externo = document.getElementById('solicitante_externo');
    var assunto = document.getElementById('assunto');
    var descricao = document.getElementById('descricao');
    var resolvido = document.getElementById('resolvido');

    if(cliente && solicitante_externo && assunto && descricao && resolvido){
        Swal.fire({
            icon: 'success',
            title: 'Atendimento registrado com sucesso',
            showConfirmButton: true,
            timer: 2500
            });        
            setTimeout(function(){ $('#hiddenBtnNovoBug').trigger("click"); }, 2000);
    }else{
        Swal.fire({
            icon: 'error',
            title: 'Itens obrigatórios',
            text: 'Selecione todos itens obrigatórios para abrir o chamado!',
            footer: ''
          })
    }
}

  
function confirmaAlertUpdateBug(){

    var tela = document.getElementById('telaEdit');
    var telaVal = tela.options[tela.selectedIndex].value;
   

    if(telaVal > 0){
        Swal.fire({
            icon: 'success',
            title: 'Informativo editado com sucesso',
            showConfirmButton: true,
            timer: 2500
            });        
            setTimeout(function(){ $('#hiddenBtnUpdate').trigger("click"); }, 2000);
    }else{
        Swal.fire({
            icon: 'error',
            title: 'Itens obrigatórios',
            text: 'Selecione todos itens obrigatórios para abrir o chamado!',
            footer: ''
          })
    }
}
//Alert de respost enviada com sucesso
function confirmaAlertResposta(){
    Swal.fire({
    icon: 'success',
    title: 'Resposta enviada com sucesso',
    showConfirmButton: true,
    timer: 2500
    });        
    setTimeout(function(){ $('#hiddenBtn').trigger("click"); }, 2000);
    // trigger click event of the hidden button

}
//Alert de resposta excluida com sucesso
function confirmaAlertExclusao(idTopico,idUser,ano,mes,dia,hora,minuto,segundo){
    //GAMBIARRA DECLARADA. Pegando dados do button via ajax e mandando pro back
    var dataHora = `${ano}-${mes}-${dia} ${hora}:${minuto}:${segundo}`;

    Swal.fire({
    title: 'Deseja excluir a resposta?',
    text: "Você não poderá reverter isso.",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Sim, delete isso!',
    cancelButtonText: 'Cancelar'
    }).then((result) => {
    if (result.isConfirmed) {
        mandaDadosBack(idTopico,idUser,dataHora);
    }
    });
}

function loadPagina(){
    var i = setInterval(function () {
    
        clearInterval(i);
      
        // bolinha de recarregamento, por baixo das telas, e com prazo maximo de 4000ms
        document.getElementById("dommus-load-page").style.display = "none";
        document.getElementById("grupo-de-topicos").style.display = "inline";
    
    }, 4000);
    
}


//ESSE TRECHO CALCULA A QUANTIDADE DE MINUTOS E CONSTROI UM CRONOMETRO REVERSO.

function startTimer(duration, display) {
    var timer = duration, hours, minutes, seconds;
    
    setInterval(function () {
        minutes = parseInt(timer / 60 % 60, 10);
        hours = parseInt(timer / 60 / 60, 10);
        seconds = parseInt(timer % 60, 10);
        hours = hours < 10 ? "0" + hours : hours;
        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;
        display.textContent = hours + ":" + minutes + ":" + seconds;
        if (--timer < 0) {
            timer = duration;
        }
    }, 1000);
}
window.onload = function () {
    /*$.ajax({
        url:'../../../app/Http/Controllers/getQtChamadosAtuais.php',
        type:'POST',
        datatype:'json',
        success:function(dados){
            dados = JSON.parse(dados);
            var qtChamadosAtuais = 0//dados[0].count;
            setInterval(function () {
                $.ajax({
                    url:'../../../app/Http/Controllers/getQtChamadosAtuais.php',
                    type:'POST',
                    datatype:'json',
                    success:function(novosdados){
                        novosdados = JSON.parse(novosdados);
                        var verificaNovosChamados = novosdados[0].count;
                        if(verificaNovosChamados > qtChamadosAtuais){
                            errou();
                            qtChamados = verificaNovosChamados;
                        }
                    },
                    error:function(){
                        console.log('Erro');
                    }
                });
            }, 60000); //1 min
        },
        error:function(){
            console.log('Erro');
        }
    }) ;*/
    var qtChamados = document.getElementById('qtChamados').value;

    for(i=0;i<qtChamados;i++){
        var prazo = document.getElementById('timer'+i).innerText;
        //console.log(prazo);
        var duration = 60 * prazo; // Converter para segundos
            display = document.querySelector('#timer'+i); // selecionando o timer
        startTimer(duration, display); // iniciando o timer
    }
};
/**********************************SELECT MULTIPLE***************************** */
var expanded = false;

function showCheckboxes() {
  var checkboxes = document.getElementById("checkboxes");
  if (!expanded) {
    checkboxes.style.display = "block";
    expanded = true;
  } else {
    checkboxes.style.display = "none";
    expanded = false;
  }
}

function retiraDadosHeader(){
    document.getElementById('span-ola-nome-usuario').style.visibility="hidden";
    document.getElementById('icon_usuario').style.visibility="hidden";
    document.getElementById('user-icon').style.visibility="hidden";
    document.getElementById('setinha_dropdown').style.visibility="hidden";
}
function voltaDadosHeader(){
    document.getElementById('span-ola-nome-usuario').style.visibility="visible";
    document.getElementById('icon_usuario').style.visibility="visible";
    document.getElementById('user-icon').style.visibility="visible";
    document.getElementById('setinha_dropdown').style.visibility="visible";
}
function visualizarNotificacao(idNotificacao, usuario){
    var checkbox = document.getElementById("checkVisuNotificacao"+idNotificacao).checked;
    $.post("../../../app/Http/Controllers/ControllerNotificacoes.php",
    {
        idNotificacao : idNotificacao,
        usuario: usuario,
        checkbox : checkbox,
        visualizaNotificacao : 'visualizaNotificacao'
    });
}