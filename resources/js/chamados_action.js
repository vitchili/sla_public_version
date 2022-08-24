function onDragStart(event) {
    event
      .dataTransfer
      .setData('text/plain', event.target.id);
  
    event
      .currentTarget
      .style
      .backgroundColor = '#f4f4f4';
  }

  function onDragOver(event) {
    event.preventDefault();
  }

  function onDropAssumir(event,count,nomeResponsavel) {
    event.preventDefault();
    $('#nenhum-chamado').hide();
    const id = event
      .dataTransfer
      .getData('text');
      
      const draggableElement = document.getElementById(id);
      const dropzone = document.getElementById('dropzoneChamado'+count);
      dropzone.appendChild(draggableElement);
      draggableElement.style.backgroundColor = '#ffffff';
      
    event
    .dataTransfer
    .clearData();


    //Ajax assume chamado x responsavel no banco.
    $.post('../../../app/Http/Controllers/ControllerAcoesChamado.php', {
      idChamado:id,
      nomeResponsavel : nomeResponsavel,
      set_responsavel : 'set_responsavel'
    }, function(resposta){
        // Valida a resposta
        console.log(resposta);
    });
    Swal.fire(
      'Chamado direcionado com sucesso!',
      'Confira mais detalhes na aba de "Tarefas',
      'success'
    )
    
  }

  function onDropDesassumir(event,count) {
    const id = event
      .dataTransfer
      .getData('text');
      const draggableElement = document.getElementById(id);
      const dropzone = document.getElementById('blocoChamadosNaoAssumidos'+count);
      dropzone.appendChild(draggableElement);
      
      draggableElement.style.backgroundColor = '#ffffff';
      
    event
    .dataTransfer
    .clearData();

    //Ajax desassume chamado x responsavel no banco.
    $.post('../../../app/Http/Controllers/ControllerAcoesChamado.php', {
      id : id,
      unset_responsavel : 'unset_responsavel'
    }, function(resposta){
        // Valida a resposta
        console.log(resposta)
    });
  }
  function playChamado(idChamado, jaIniciou, cargo){

    //Se o boolean for verdadeiro, o ajax inicia o "iniciado_em", senao, pausa.
    var iconChamado = document.getElementById('play-'+idChamado);
    if(!jaIniciou){
        Swal.fire({
            title: 'Deseja iniciar a correção?',
            showDenyButton: true,
            confirmButtonText: `Sim`,
            denyButtonText: `Cancelar`,
          }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
              Swal.fire('Solução Iniciada!', '', 'success');
              iconChamado.classList.remove('fa-play');
              iconChamado.classList.add('fa-stopwatch');
              //ajax aqui para iniciar o atendimento.
            

              $.post('../../../app/Http/Controllers/ControllerAcoesChamado.php', {
                idChamado : idChamado,
                cargo : cargo,
                set_inicio_correcao : 'set_inicio_correcao'
              }, function(resposta){
                  // Valida a resposta
                  console.log(resposta)
              });

              var load = setInterval(function () {
                  document.location.reload();
              }, 2000);      
            } else if (result.isDenied) {
              Swal.fire('Solução não iniciada', '', 'info')
            }
          })
        
    }else{
        Swal.fire({
            title: 'Deseja encerrar o chamado via suporte?',
            showDenyButton: true,
            confirmButtonText: `Sim, encerrar.`,
            denyButtonText: `Cancelar`,
          }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
              Swal.fire('Chamado finalizado!', '', 'success');
              $.post('../../../app/Http/Controllers/ControllerAcoesChamado.php', {
                idChamado : idChamado,
                cancela_ou_conlui_chamado : 'cancela_ou_conlui_chamado'
              }, function(resposta){
                  // Valida a resposta
                  console.log(resposta)
              });
              iconChamado.classList.remove('fa-stopwatch');
              iconChamado.classList.add('fa-play');
              var load = setInterval(function () {
                  document.location.reload();
              }, 2000);  
            } else if (result.isDenied) {
              Swal.fire('Chamado em aberto.', '', 'info')
            }
          })
        
    }
}

function pausaChamado(idChamado, cargo){
  //Se o boolean for verdadeiro, o ajax inicia o "iniciado_em", senao, pausa.
  var iconChamado = document.getElementById('play-'+idChamado);
 
      Swal.fire({
          title: 'Deseja pausar a correção?',
          showDenyButton: true,
          confirmButtonText: `Sim`,
          denyButtonText: `Cancelar`,
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
            Swal.fire('Solução pausada!', '', 'success');
            iconChamado.classList.remove('fa-pause');
            iconChamado.classList.add('fa-play');
            //ajax aqui para iniciar o atendimento.
          

            $.post('../../../app/Http/Controllers/ControllerAcoesChamado.php', {
              idChamado : idChamado,
              cargo : cargo,
              set_pausa_correcao : 'set_pausa_correcao'
            }, function(resposta){
                // Valida a resposta
                console.log(resposta)
            });

              var load = setInterval(function () {
                  document.location.reload();
              }, 2000);
          } else if (result.isDenied) {
            Swal.fire('Solução não iniciada', '', 'info')
          }
        })
      
  
}

function retomaChamado(idChamado, cargo){
  //Se o boolean for verdadeiro, o ajax inicia o "iniciado_em", senao, pausa.
  var iconChamado = document.getElementById('play-'+idChamado);
 
      Swal.fire({
          title: 'Deseja retomar a correção?',
          showDenyButton: true,
          confirmButtonText: `Sim`,
          denyButtonText: `Cancelar`,
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
            Swal.fire('Solução retomada!', '', 'success');
            iconChamado.classList.remove('fa-play');
            iconChamado.classList.add('fa-pause');
            //ajax aqui para iniciar o atendimento.
          

            $.post('../../../app/Http/Controllers/ControllerAcoesChamado.php', {
              idChamado : idChamado,
              cargo : cargo,
              set_retomada_correcao : 'set_retomada_correcao'
            }, function(resposta){
                // Valida a resposta
                console.log(resposta)
            });

            var load = setInterval(function () {
                  document.location.reload();
            }, 2000)
          } else if (result.isDenied) {
            Swal.fire('Solução não iniciada', '', 'info')
          }
        })
}
function finalizaSemProp(idChamado){
  var inputModif = CKEDITOR.instances['modificacao'+idChamado].getData();
  // var inputModif = inputModifText.value;
  var tipoFinalizacao = 'suporte';

  Swal.fire({
    title: 'Digite quantos minutos foram gastos na correção.',
    input: 'text',
    inputAttributes: {
      autocapitalize: 'off'
    },
    showCancelButton: true,
    confirmButtonText: 'Confirmar',
    showLoaderOnConfirm: true,
    preConfirm: (quantidade_minutos) => {
      Swal.fire({
        title: 'Deseja encerrar o chamado via Suporte?',
        showDenyButton: true,
        confirmButtonText: `Sim, encerrar.`,
        denyButtonText: `Não`,
      }).then((result) => {
          if (result.isConfirmed) {
            Swal.fire('Chamado finalizado!', '', 'success');
            $.post('../../../app/Http/Controllers/ControllerAcoesChamado.php', {
              idChamado : idChamado,
              inputModif : inputModif,
              tipoFinalizacao : tipoFinalizacao,
              quantidade_minutos : quantidade_minutos,
              cancela_ou_conlui_chamado : 'cancela_ou_conlui_chamado'
            }, function(resposta){
                // Valida a resposta
                console.log(resposta)
            });      
          } else if (result.isDenied) {
            Swal.fire('Chamado em aberto.', '', 'info')
          }
          var load = setInterval(function () {
            document.location.reload();
          }, 3000);
      })

    },
    allowOutsideClick: () => !Swal.isLoading()
  }).then((result) => {
    
  })
}
function salvarConfigUsuario(){
  var nome = document.getElementById('nome').value;
  var email = document.getElementById('email').value;
  var senha = document.getElementById('senha').value;
  var confirm_senha = document.getElementById('confirm_senha').value;
  var tipo_perfil = document.getElementById('tipo_perfil').value;
  var coordenacao = document.getElementById('coordenacao').value;

  if(!nome || !email || !senha || !confirm_senha || !tipo_perfil || !coordenacao){
    Swal.fire('Preencha todas informaÃ§Ãµes obrigatÃ³rias.', '', 'error');
    return;
  }


  if(senha != confirm_senha){
    Swal.fire('As senhas informadas são diferentes.', '', 'error');
    return;
  }
  Swal.fire({
    title: 'Salvar dados do perfil?',
    showDenyButton: true,
    confirmButtonText: `Sim.`,
    denyButtonText: `Não`,
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire('Dados salvos com sucesso.', '', 'success');
      $.post('../../app/Http/Controllers/Auth/setDadosUsuario.php', {
        nome:nome,
        email:email,
        senha:senha,
        tipo_perfil:tipo_perfil,
        coordenacao:coordenacao
      }, function(resposta){
          //console log;
      });   
      var load = setInterval(function () {
            document.location.reload();
      }, 3000); 
    }else{
      Swal.fire('Dados não salvos.', '', 'success');
    }
  })
}

function prometerIntimar(tipo_botao, idChamado, responsavel){
  var data_promessa = document.getElementById("data_promessa"+idChamado).value;
  if(!data_promessa){
    Swal.fire('Nenhuma data inserida', '', 'error');
    return;
  }
  if(tipo_botao == 'Marcar promessa de resolução'){
    Swal.fire({
      title: 'Marcar promessa de inicialização?',
      showDenyButton: true,
      confirmButtonText: `Sim.`,
      denyButtonText: `Não`,
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire('Inicialização marcada.', '', 'success');
        $.post('../../../app/Http/Controllers/ControllerAcoesChamado.php', {
          idChamado : idChamado,
          data_promessa : data_promessa,
          responsavel : responsavel,
          promete_intima_correcao : 'promete_intima_correcao'
        }, function(resposta){
            
        });   
        var load = setInterval(function () {
              document.location.reload();
        }, 3000); 
      }
      
    })
  
  }else{
    Swal.fire({
      title: 'Intimar inicialização da correção?',
      showDenyButton: true,
      confirmButtonText: `Sim.`,
      denyButtonText: `Não`,
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire('Inicialização intimada!', '', 'success');
        $.post('../../../app/Http/Controllers/ControllerAcoesChamado.php', {
          idChamado : idChamado,
          data_promessa : data_promessa,
          responsavel : responsavel,
          promete_intima_correcao : 'promete_intima_correcao'
        }, function(resposta){
            console.log(resposta)
        });      

        Swal.fire({
          title: 'Deseja bloquear a fila do usuário?',
          text: 'A partir da data indicada, o desenvolvedor não poderá entregar nenhuma tarefa antes desta.',
          showDenyButton: true,
          confirmButtonText: `Sim.`,
          denyButtonText: `Não`,
        }).then((result) => {
          if (result.isConfirmed) {
            Swal.fire('Fila será bloqueada em ' + data_promessa, '', 'success');
            $.post('../../../app/Http/Controllers/ControllerAcoesChamado.php', {
              idChamado : idChamado,
              data_promessa : data_promessa,
              responsavel : responsavel,
              bloqueia_em : 'bloqueia_em'
            }, function(resposta){
                // Valida a resposta
                console.log(resposta)
            });      
          } else if (result.isDenied) {
            Swal.fire('Fila não bloqueada.', '', 'info')
          }
        })

      } else if (result.isDenied) {
        Swal.fire('Resolução não intimada.', '', 'info')
      }
      
    })
  }
}
function cancelarChamado(idChamado){
  var inputModifText = CKEDITOR.instances['modificacao'+idChamado].getData();
  var inputModif = inputModifText;
  var tipoFinalizacao = 'cancelamento';
  if(inputModif.length < 1){
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Modificação obrigatória para cancelamento do chamado!'
    })
    return 0;
  }

  Swal.fire({
    title: 'Deseja cancelar o chamado?',
    showDenyButton: true,
    confirmButtonText: `Sim, encerrar.`,
    denyButtonText: `Não`,
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire('Chamado finalizado!', '', 'success');
      $.post('../../../app/Http/Controllers/ControllerAcoesChamado.php', {
        idChamado : idChamado,
        inputModif : inputModif,
        tipoFinalizacao : tipoFinalizacao,
        cancela_ou_conlui_chamado : 'cancela_ou_conlui_chamado'
      }, function(resposta){
          // Valida a resposta
          console.log(resposta)
      });      
    } else if (result.isDenied) {
      Swal.fire('Chamado não cancelado.', '', 'info')
    }
    var load = setInterval(function () {
      document.location.reload();
  }, 3000);
  })

}
function salvarSwitchCase(idChamado){

  var base_a_ser_testado = document.getElementById('base_a_ser_testado' + idChamado).value;
  var switchCaseCaminho0 = document.getElementById('switchCaseCaminho0' + idChamado).value;
  var switchCaseCaminho1 = document.getElementById('switchCaseCaminho1' + idChamado).value;
  var switchCaseCaminho2 = document.getElementById('switchCaseCaminho2' + idChamado).value;
  var switchCaseCaminho3 = document.getElementById('switchCaseCaminho3' + idChamado).value;
  var switchCaseCaminho4 = document.getElementById('switchCaseCaminho4' + idChamado).value;
  var switchCaseCaminho5 = document.getElementById('switchCaseCaminho5' + idChamado).value;
  var switchCaseCaminho6 = document.getElementById('switchCaseCaminho6' + idChamado).value;
  var switchCaseCaminho7 = document.getElementById('switchCaseCaminho7' + idChamado).value;
  var switchCaseCaminho8 = document.getElementById('switchCaseCaminho8' + idChamado).value;
  var switchCaseCaminho9 = document.getElementById('switchCaseCaminho9' + idChamado).value;
  var switchCaseCaminho10 = document.getElementById('switchCaseCaminho10' + idChamado).value;
  var switchCaseCaminho11 = document.getElementById('switchCaseCaminho11' + idChamado).value;

  var switchCaseDescricao0 = document.getElementById('switchCaseDescricao0' + idChamado).value;
  var switchCaseDescricao1 = document.getElementById('switchCaseDescricao1' + idChamado).value;
  var switchCaseDescricao2 = document.getElementById('switchCaseDescricao2' + idChamado).value;
  var switchCaseDescricao3 = document.getElementById('switchCaseDescricao3' + idChamado).value;
  var switchCaseDescricao4 = document.getElementById('switchCaseDescricao4' + idChamado).value;
  var switchCaseDescricao5 = document.getElementById('switchCaseDescricao5' + idChamado).value;
  var switchCaseDescricao6 = document.getElementById('switchCaseDescricao6' + idChamado).value;
  var switchCaseDescricao7 = document.getElementById('switchCaseDescricao7' + idChamado).value;
  var switchCaseDescricao8 = document.getElementById('switchCaseDescricao8' + idChamado).value;
  var switchCaseDescricao9 = document.getElementById('switchCaseDescricao9' + idChamado).value;
  var switchCaseDescricao10 = document.getElementById('switchCaseDescricao10' + idChamado).value;
  var switchCaseDescricao11 = document.getElementById('switchCaseDescricao11' + idChamado).value;

  var switchCaseEsperado0 = document.getElementById('switchCaseEsperado0' + idChamado).value;
  var switchCaseEsperado1 = document.getElementById('switchCaseEsperado1' + idChamado).value;
  var switchCaseEsperado2 = document.getElementById('switchCaseEsperado2' + idChamado).value;
  var switchCaseEsperado3 = document.getElementById('switchCaseEsperado3' + idChamado).value;
  var switchCaseEsperado4 = document.getElementById('switchCaseEsperado4' + idChamado).value;
  var switchCaseEsperado5 = document.getElementById('switchCaseEsperado5' + idChamado).value;
  var switchCaseEsperado6 = document.getElementById('switchCaseEsperado6' + idChamado).value;
  var switchCaseEsperado7 = document.getElementById('switchCaseEsperado7' + idChamado).value;
  var switchCaseEsperado8 = document.getElementById('switchCaseEsperado8' + idChamado).value;
  var switchCaseEsperado9 = document.getElementById('switchCaseEsperado9' + idChamado).value;
  var switchCaseEsperado10 = document.getElementById('switchCaseEsperado10' + idChamado).value;
  var switchCaseEsperado11 = document.getElementById('switchCaseEsperado11' + idChamado).value;

  var switchCaseOcorrido0 = document.getElementById('switchCaseOcorrido0' + idChamado).value;
  var switchCaseOcorrido1 = document.getElementById('switchCaseOcorrido1' + idChamado).value;
  var switchCaseOcorrido2 = document.getElementById('switchCaseOcorrido2' + idChamado).value;
  var switchCaseOcorrido3 = document.getElementById('switchCaseOcorrido3' + idChamado).value;
  var switchCaseOcorrido4 = document.getElementById('switchCaseOcorrido4' + idChamado).value;
  var switchCaseOcorrido5 = document.getElementById('switchCaseOcorrido5' + idChamado).value;
  var switchCaseOcorrido6 = document.getElementById('switchCaseOcorrido6' + idChamado).value;
  var switchCaseOcorrido7 = document.getElementById('switchCaseOcorrido7' + idChamado).value;
  var switchCaseOcorrido8 = document.getElementById('switchCaseOcorrido8' + idChamado).value;
  var switchCaseOcorrido9 = document.getElementById('switchCaseOcorrido9' + idChamado).value;
  var switchCaseOcorrido10 = document.getElementById('switchCaseOcorrido10' + idChamado).value;
  var switchCaseOcorrido11 = document.getElementById('switchCaseOcorrido11' + idChamado).value;

  Swal.fire({
    title: 'Deseja salvar o Switch Case?',
    showDenyButton: true,
    confirmButtonText: `Sim, salvar.`,
    denyButtonText: `Não`,
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire('Switch Case gravado com sucesso!', '', 'success');
      $.post('../../../app/Http/Controllers/ControllerAcoesChamado.php', {
        idChamado : idChamado,
        insert_switch_case : 'insert_switch_case',
        base_a_ser_testado : base_a_ser_testado,
        switchCaseCaminho0 : switchCaseCaminho0,
        switchCaseCaminho1 : switchCaseCaminho1,
        switchCaseCaminho2 : switchCaseCaminho2,
        switchCaseCaminho3 : switchCaseCaminho3,
        switchCaseCaminho4 : switchCaseCaminho4,
        switchCaseCaminho5 : switchCaseCaminho5,
        switchCaseCaminho6 : switchCaseCaminho6,
        switchCaseCaminho7 : switchCaseCaminho7,
        switchCaseCaminho8 : switchCaseCaminho8,
        switchCaseCaminho9 : switchCaseCaminho9,
        switchCaseCaminho10 : switchCaseCaminho10,
        switchCaseCaminho11 : switchCaseCaminho11,
        switchCaseDescricao0 : switchCaseDescricao0,
        switchCaseDescricao1 : switchCaseDescricao1,
        switchCaseDescricao2 : switchCaseDescricao2,
        switchCaseDescricao3 : switchCaseDescricao3,
        switchCaseDescricao4 : switchCaseDescricao4,
        switchCaseDescricao5 : switchCaseDescricao5,
        switchCaseDescricao6 : switchCaseDescricao6,
        switchCaseDescricao7 : switchCaseDescricao7,
        switchCaseDescricao8 : switchCaseDescricao8,
        switchCaseDescricao9 : switchCaseDescricao9,
        switchCaseDescricao10 : switchCaseDescricao10,
        switchCaseDescricao11 : switchCaseDescricao11,
        switchCaseEsperado0 : switchCaseEsperado0,
        switchCaseEsperado1 : switchCaseEsperado1,
        switchCaseEsperado2 : switchCaseEsperado2,
        switchCaseEsperado3 : switchCaseEsperado3,
        switchCaseEsperado4 : switchCaseEsperado4,
        switchCaseEsperado5 : switchCaseEsperado5,
        switchCaseEsperado6 : switchCaseEsperado6,
        switchCaseEsperado7 : switchCaseEsperado7,
        switchCaseEsperado8 : switchCaseEsperado8,
        switchCaseEsperado9 : switchCaseEsperado9,
        switchCaseEsperado10 : switchCaseEsperado10,
        switchCaseEsperado11 : switchCaseEsperado11,
        switchCaseOcorrido0 : switchCaseOcorrido0,
        switchCaseOcorrido1 : switchCaseOcorrido1,
        switchCaseOcorrido2 : switchCaseOcorrido2,
        switchCaseOcorrido3 : switchCaseOcorrido3,
        switchCaseOcorrido4 : switchCaseOcorrido4,
        switchCaseOcorrido5 : switchCaseOcorrido5,
        switchCaseOcorrido6 : switchCaseOcorrido6,
        switchCaseOcorrido7 : switchCaseOcorrido7,
        switchCaseOcorrido8 : switchCaseOcorrido8,
        switchCaseOcorrido9 : switchCaseOcorrido9,
        switchCaseOcorrido10 : switchCaseOcorrido10,
        switchCaseOcorrido11 : switchCaseOcorrido11
      }, function(resposta){
        var load = setInterval(function () {
          document.location.reload();
        }, 3000);
      });      
    } else if (result.isDenied) {
      Swal.fire('Switch Caso não foi salvo. Clique novamente para salvar.', '', 'info')
    }
  })

}
function enviarMensagemChamado(idChamado){
  var mensagem = document.getElementById('nova_mensagem' + idChamado).value;

  console.log(idChamado);
  console.log(mensagem);
  Swal.fire({
    title: 'Deseja enviar a mensagem?',
    showDenyButton: true,
    confirmButtonText: `Sim, enviar.`,
    denyButtonText: `Não`,
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire('Mensagem enviada com sucesso!', '', 'success');
      $.post('../../../app/Http/Controllers/ControllerAcoesChamado.php', {
        idChamado : idChamado, 
        mensagem : mensagem,
        insert_mensagem_chamado : 'insert_mensagem_chamado'
      }, function(resposta){
          var load = setInterval(function () {
            document.location.reload();
        }, 1500); 
      });      
    } else if (result.isDenied) {
      Swal.fire('Mensagem não enviada.', '', 'info')
    }
  })
}
function enviarMensagemExternoChamado(idChamado){
  var mensagem = document.getElementById('nova_mensagem_externa' + idChamado).value;
  Swal.fire({
    title: 'Deseja enviar a mensagem?',
    showDenyButton: true,
    confirmButtonText: `Sim, enviar.`,
    denyButtonText: `Não`,
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire('Mensagem enviada com sucesso!', '', 'success');
      $.post('/suporte-aquicob/app/Http/Controllers/ControllerAcoesChamado.php', {
        idChamado : idChamado, 
        mensagem : mensagem,
        insert_mensagem_externa_chamado : 'insert_mensagem_externa_chamado'
      }, function(resposta){
          var load = setInterval(function () {
            document.location.reload();
        }, 1500); 
      });      
    } else if (result.isDenied) {
      Swal.fire('Mensagem não enviada.', '', 'info')
    }
  })
}
function abrirChamadoPeloDiario(cliente, solicitante, titulo, descricao){
  var now = new Date;
  var data_entrega_estimada = now.getFullYear() + '-' + String(now.getMonth() + 1).padStart(2, '0') + '-' + String(now.getDate()).padStart(2, '0');
  var produto = '5';
  var modulo = '15';
  var tela = '66'
  var direcionamento = 'S';
  var prioridade = '3';

  Swal.fire({
    title: 'Abrir chamado para este registro?',
    showDenyButton: true,
    confirmButtonText: `Sim`,
    denyButtonText: `Não`,
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      Swal.fire('Chamado aberto! Edite-o na prioridade média', '', 'success');
      //ajax aqui para iniciar o atendimento.
    
      $.post('../../../app/Http/Controllers/setDadosNovoBugSLA.php', {
        cliente:cliente,
        solicitante:solicitante,
        titulo:titulo,
        descricao:descricao,
        data_entrega_estimada:data_entrega_estimada,
        produto:produto,
        modulo:modulo,
        tela:tela,
        direcionamento:direcionamento,
        prioridade:prioridade

      }, function(resposta){
          // Valida a resposta
          console.log(resposta)
      });      
    } else if (result.isDenied) {
      Swal.fire('Chamado não aberto', '', 'info')
    }
  })
}

function finalizaDemanda(idChamado){
  var form = document.getElementById('branch-modif');
  form.addEventListener('submit', function(e) {
    e.preventDefault();
  });
  
  var inputModif = CKEDITOR.instances['modificacao'+idChamado].getData();
  var inputBranchText = document.getElementById("branch"+idChamado);
  var inputBranch = inputBranchText.value;

  if(!inputModif || !inputBranch){
    Swal.fire('Preencha a modificação e a branch do Git', '', 'error');
    return 0;
  }

  if(!(document.getElementById('switchCaseCaminho0' + idChamado).value)){
    Swal.fire('Preencha e salve o Switch Case!', '', 'error');
    return 0;
  }

  Swal.fire({
    title: 'Enviar para testes?',
    showDenyButton: true,
    confirmButtonText: `Sim`,
    denyButtonText: `Não`,
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      Swal.fire('Finalizado!', '', 'success');
      //ajax aqui para iniciar o atendimento.
    
      $.post('../../../app/Http/Controllers/ControllerAcoesChamado.php', {
        idChamado : idChamado,
        inputModif : inputModif,
        inputBranch : inputBranch,
        finaliza_chamado_sla : 'finaliza_chamado_sla'
      }, function(resposta){
          // Valida a resposta
          console.log(resposta)
      });

      var load = setInterval(function () {
          document.location.reload();
      }, 3000);      
    } else if (result.isDenied) {
      Swal.fire('Chamado não finalizado', '', 'info')
    }
  })
}

function deixarChamadoEmEspera(idChamado){
  
  var inputModifText = document.getElementById("modificacao"+idChamado);
  var inputModif = inputModifText.value;

  if(!inputModif){
    Swal.fire('Preencha o motivo da espera', '', 'error');
    return 0;
  }

  Swal.fire({
    title: 'Deixar chamado em espera?',
    showDenyButton: true,
    confirmButtonText: `Sim`,
    denyButtonText: `Não`,
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      Swal.fire('Chamado em espera!', '', 'success');
      //ajax aqui para iniciar o atendimento.
    
      $.post('../../../app/Http/Controllers/ControllerAcoesChamado.php', {
        idChamado : idChamado,
        inputModif : inputModif,
        deixar_chamado_em_espera : 'deixar_chamado_em_espera'
      }, function(resposta){
          // Valida a resposta
          console.log(resposta)
          var load = setInterval(function () {
            document.location.reload();
        }, 3000);   
      });

           
    }
  })
}
function reativarChamadoEmEspera(idChamado){
  Swal.fire({
    title: 'Reativar chamado?',
    showDenyButton: true,
    confirmButtonText: `Sim`,
    denyButtonText: `Não`,
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      Swal.fire('Chamado reativado!', '', 'success');
      //ajax aqui para iniciar o atendimento.
    
      $.post('../../../app/Http/Controllers/ControllerAcoesChamado.php', {
        idChamado : idChamado,
        reativar_chamado_em_espera : 'reativar_chamado_em_espera'
      }, function(resposta){
          // Valida a resposta
          console.log(resposta)
          var load = setInterval(function () {
            document.location.reload();
        }, 3000);   
      });

           
    }
  })
}
  function reprovarProp(idChamado){
    var switchCaseCaminho0 = document.getElementById('switchCaseCaminho0' + idChamado).value;
    var switchCaseCaminho1 = document.getElementById('switchCaseCaminho1' + idChamado).value;
    var switchCaseCaminho2 = document.getElementById('switchCaseCaminho2' + idChamado).value;
    var switchCaseCaminho3 = document.getElementById('switchCaseCaminho3' + idChamado).value;
    var switchCaseCaminho4 = document.getElementById('switchCaseCaminho4' + idChamado).value;
    var switchCaseCaminho5 = document.getElementById('switchCaseCaminho5' + idChamado).value;
    var switchCaseCaminho6 = document.getElementById('switchCaseCaminho6' + idChamado).value;
    var switchCaseCaminho7 = document.getElementById('switchCaseCaminho7' + idChamado).value;
    var switchCaseCaminho8 = document.getElementById('switchCaseCaminho8' + idChamado).value;
    var switchCaseCaminho9 = document.getElementById('switchCaseCaminho9' + idChamado).value;
    var switchCaseCaminho10 = document.getElementById('switchCaseCaminho10' + idChamado).value;
    var switchCaseCaminho11 = document.getElementById('switchCaseCaminho11' + idChamado).value;

    var switchCaseDescricao0 = document.getElementById('switchCaseDescricao0' + idChamado).value;
    var switchCaseDescricao1 = document.getElementById('switchCaseDescricao1' + idChamado).value;
    var switchCaseDescricao2 = document.getElementById('switchCaseDescricao2' + idChamado).value;
    var switchCaseDescricao3 = document.getElementById('switchCaseDescricao3' + idChamado).value;
    var switchCaseDescricao4 = document.getElementById('switchCaseDescricao4' + idChamado).value;
    var switchCaseDescricao5 = document.getElementById('switchCaseDescricao5' + idChamado).value;
    var switchCaseDescricao6 = document.getElementById('switchCaseDescricao6' + idChamado).value;
    var switchCaseDescricao7 = document.getElementById('switchCaseDescricao7' + idChamado).value;
    var switchCaseDescricao8 = document.getElementById('switchCaseDescricao8' + idChamado).value;
    var switchCaseDescricao9 = document.getElementById('switchCaseDescricao9' + idChamado).value;
    var switchCaseDescricao10 = document.getElementById('switchCaseDescricao10' + idChamado).value;
    var switchCaseDescricao11 = document.getElementById('switchCaseDescricao11' + idChamado).value;

    var switchCaseEsperado0 = document.getElementById('switchCaseEsperado0' + idChamado).value;
    var switchCaseEsperado1 = document.getElementById('switchCaseEsperado1' + idChamado).value;
    var switchCaseEsperado2 = document.getElementById('switchCaseEsperado2' + idChamado).value;
    var switchCaseEsperado3 = document.getElementById('switchCaseEsperado3' + idChamado).value;
    var switchCaseEsperado4 = document.getElementById('switchCaseEsperado4' + idChamado).value;
    var switchCaseEsperado5 = document.getElementById('switchCaseEsperado5' + idChamado).value;
    var switchCaseEsperado6 = document.getElementById('switchCaseEsperado6' + idChamado).value;
    var switchCaseEsperado7 = document.getElementById('switchCaseEsperado7' + idChamado).value;
    var switchCaseEsperado8 = document.getElementById('switchCaseEsperado8' + idChamado).value;
    var switchCaseEsperado9 = document.getElementById('switchCaseEsperado9' + idChamado).value;
    var switchCaseEsperado10 = document.getElementById('switchCaseEsperado10' + idChamado).value;
    var switchCaseEsperado11 = document.getElementById('switchCaseEsperado11' + idChamado).value;

    var switchCaseOcorrido0 = document.getElementById('switchCaseOcorrido0' + idChamado).value;
    var switchCaseOcorrido1 = document.getElementById('switchCaseOcorrido1' + idChamado).value;
    var switchCaseOcorrido2 = document.getElementById('switchCaseOcorrido2' + idChamado).value;
    var switchCaseOcorrido3 = document.getElementById('switchCaseOcorrido3' + idChamado).value;
    var switchCaseOcorrido4 = document.getElementById('switchCaseOcorrido4' + idChamado).value;
    var switchCaseOcorrido5 = document.getElementById('switchCaseOcorrido5' + idChamado).value;
    var switchCaseOcorrido6 = document.getElementById('switchCaseOcorrido6' + idChamado).value;
    var switchCaseOcorrido7 = document.getElementById('switchCaseOcorrido7' + idChamado).value;
    var switchCaseOcorrido8 = document.getElementById('switchCaseOcorrido8' + idChamado).value;
    var switchCaseOcorrido9 = document.getElementById('switchCaseOcorrido9' + idChamado).value;
    var switchCaseOcorrido10 = document.getElementById('switchCaseOcorrido10' + idChamado).value;
    var switchCaseOcorrido11 = document.getElementById('switchCaseOcorrido11' + idChamado).value;
    
    Swal.fire({
      title: 'Reprovar solução?',
      showDenyButton: true,
      confirmButtonText: `Sim`,
      denyButtonText: `Cancelar`,
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        Swal.fire('Reprovado!', '', 'success');
        //ajax aqui para iniciar o atendimento.
      
        $.post('../../../app/Http/Controllers/ControllerAcoesChamado.php', {
          idChamado : idChamado,
          reprovaPropagacao : 'reprovaPropagacao'
        }, function(resposta){
          
        });  

        $.post('../../../app/Http/Controllers/ControllerAcoesChamado.php', {
          idChamado : idChamado,
          insert_switch_case : 'insert_switch_case',
          switchCaseCaminho0 : switchCaseCaminho0,
          switchCaseCaminho1 : switchCaseCaminho1,
          switchCaseCaminho2 : switchCaseCaminho2,
          switchCaseCaminho3 : switchCaseCaminho3,
          switchCaseCaminho4 : switchCaseCaminho4,
          switchCaseCaminho5 : switchCaseCaminho5,
          switchCaseCaminho6 : switchCaseCaminho6,
          switchCaseCaminho7 : switchCaseCaminho7,
          switchCaseCaminho8 : switchCaseCaminho8,
          switchCaseCaminho9 : switchCaseCaminho9,
          switchCaseCaminho10 : switchCaseCaminho10,
          switchCaseCaminho11 : switchCaseCaminho11,
          switchCaseDescricao0 : switchCaseDescricao0,
          switchCaseDescricao1 : switchCaseDescricao1,
          switchCaseDescricao2 : switchCaseDescricao2,
          switchCaseDescricao3 : switchCaseDescricao3,
          switchCaseDescricao4 : switchCaseDescricao4,
          switchCaseDescricao5 : switchCaseDescricao5,
          switchCaseDescricao6 : switchCaseDescricao6,
          switchCaseDescricao7 : switchCaseDescricao7,
          switchCaseDescricao8 : switchCaseDescricao8,
          switchCaseDescricao9 : switchCaseDescricao9,
          switchCaseDescricao10 : switchCaseDescricao10,
          switchCaseDescricao11 : switchCaseDescricao11,
          switchCaseEsperado0 : switchCaseEsperado0,
          switchCaseEsperado1 : switchCaseEsperado1,
          switchCaseEsperado2 : switchCaseEsperado2,
          switchCaseEsperado3 : switchCaseEsperado3,
          switchCaseEsperado4 : switchCaseEsperado4,
          switchCaseEsperado5 : switchCaseEsperado5,
          switchCaseEsperado6 : switchCaseEsperado6,
          switchCaseEsperado7 : switchCaseEsperado7,
          switchCaseEsperado8 : switchCaseEsperado8,
          switchCaseEsperado9 : switchCaseEsperado9,
          switchCaseEsperado10 : switchCaseEsperado10,
          switchCaseEsperado11 : switchCaseEsperado11,
          switchCaseOcorrido0 : switchCaseOcorrido0,
          switchCaseOcorrido1 : switchCaseOcorrido1,
          switchCaseOcorrido2 : switchCaseOcorrido2,
          switchCaseOcorrido3 : switchCaseOcorrido3,
          switchCaseOcorrido4 : switchCaseOcorrido4,
          switchCaseOcorrido5 : switchCaseOcorrido5,
          switchCaseOcorrido6 : switchCaseOcorrido6,
          switchCaseOcorrido7 : switchCaseOcorrido7,
          switchCaseOcorrido8 : switchCaseOcorrido8,
          switchCaseOcorrido9 : switchCaseOcorrido9,
          switchCaseOcorrido10 : switchCaseOcorrido10,
          switchCaseOcorrido11 : switchCaseOcorrido11
        }, function(resposta){
            var load = setInterval(function () {
              document.location.reload();
          }, 2000); 
        });      


      } else if (result.isDenied) {
        Swal.fire('Solução pendente', '', 'info')
      }
    })


    
  }

function autorizarProp(idChamado){
  var switchCaseCaminho0 = document.getElementById('switchCaseCaminho0' + idChamado).value;
  var switchCaseCaminho1 = document.getElementById('switchCaseCaminho1' + idChamado).value;
  var switchCaseCaminho2 = document.getElementById('switchCaseCaminho2' + idChamado).value;
  var switchCaseCaminho3 = document.getElementById('switchCaseCaminho3' + idChamado).value;
  var switchCaseCaminho4 = document.getElementById('switchCaseCaminho4' + idChamado).value;
  var switchCaseCaminho5 = document.getElementById('switchCaseCaminho5' + idChamado).value;
  var switchCaseCaminho6 = document.getElementById('switchCaseCaminho6' + idChamado).value;
  var switchCaseCaminho7 = document.getElementById('switchCaseCaminho7' + idChamado).value;
  var switchCaseCaminho8 = document.getElementById('switchCaseCaminho8' + idChamado).value;
  var switchCaseCaminho9 = document.getElementById('switchCaseCaminho9' + idChamado).value;
  var switchCaseCaminho10 = document.getElementById('switchCaseCaminho10' + idChamado).value;
  var switchCaseCaminho11 = document.getElementById('switchCaseCaminho11' + idChamado).value;

  var switchCaseDescricao0 = document.getElementById('switchCaseDescricao0' + idChamado).value;
  var switchCaseDescricao1 = document.getElementById('switchCaseDescricao1' + idChamado).value;
  var switchCaseDescricao2 = document.getElementById('switchCaseDescricao2' + idChamado).value;
  var switchCaseDescricao3 = document.getElementById('switchCaseDescricao3' + idChamado).value;
  var switchCaseDescricao4 = document.getElementById('switchCaseDescricao4' + idChamado).value;
  var switchCaseDescricao5 = document.getElementById('switchCaseDescricao5' + idChamado).value;
  var switchCaseDescricao6 = document.getElementById('switchCaseDescricao6' + idChamado).value;
  var switchCaseDescricao7 = document.getElementById('switchCaseDescricao7' + idChamado).value;
  var switchCaseDescricao8 = document.getElementById('switchCaseDescricao8' + idChamado).value;
  var switchCaseDescricao9 = document.getElementById('switchCaseDescricao9' + idChamado).value;
  var switchCaseDescricao10 = document.getElementById('switchCaseDescricao10' + idChamado).value;
  var switchCaseDescricao11 = document.getElementById('switchCaseDescricao11' + idChamado).value;

  var switchCaseEsperado0 = document.getElementById('switchCaseEsperado0' + idChamado).value;
  var switchCaseEsperado1 = document.getElementById('switchCaseEsperado1' + idChamado).value;
  var switchCaseEsperado2 = document.getElementById('switchCaseEsperado2' + idChamado).value;
  var switchCaseEsperado3 = document.getElementById('switchCaseEsperado3' + idChamado).value;
  var switchCaseEsperado4 = document.getElementById('switchCaseEsperado4' + idChamado).value;
  var switchCaseEsperado5 = document.getElementById('switchCaseEsperado5' + idChamado).value;
  var switchCaseEsperado6 = document.getElementById('switchCaseEsperado6' + idChamado).value;
  var switchCaseEsperado7 = document.getElementById('switchCaseEsperado7' + idChamado).value;
  var switchCaseEsperado8 = document.getElementById('switchCaseEsperado8' + idChamado).value;
  var switchCaseEsperado9 = document.getElementById('switchCaseEsperado9' + idChamado).value;
  var switchCaseEsperado10 = document.getElementById('switchCaseEsperado10' + idChamado).value;
  var switchCaseEsperado11 = document.getElementById('switchCaseEsperado11' + idChamado).value;

  var switchCaseOcorrido0 = document.getElementById('switchCaseOcorrido0' + idChamado).value;
  var switchCaseOcorrido1 = document.getElementById('switchCaseOcorrido1' + idChamado).value;
  var switchCaseOcorrido2 = document.getElementById('switchCaseOcorrido2' + idChamado).value;
  var switchCaseOcorrido3 = document.getElementById('switchCaseOcorrido3' + idChamado).value;
  var switchCaseOcorrido4 = document.getElementById('switchCaseOcorrido4' + idChamado).value;
  var switchCaseOcorrido5 = document.getElementById('switchCaseOcorrido5' + idChamado).value;
  var switchCaseOcorrido6 = document.getElementById('switchCaseOcorrido6' + idChamado).value;
  var switchCaseOcorrido7 = document.getElementById('switchCaseOcorrido7' + idChamado).value;
  var switchCaseOcorrido8 = document.getElementById('switchCaseOcorrido8' + idChamado).value;
  var switchCaseOcorrido9 = document.getElementById('switchCaseOcorrido9' + idChamado).value;
  var switchCaseOcorrido10 = document.getElementById('switchCaseOcorrido10' + idChamado).value;
  var switchCaseOcorrido11 = document.getElementById('switchCaseOcorrido11' + idChamado).value;    


  Swal.fire({
    title: 'Aprovar propagação?',
    showDenyButton: true,
    confirmButtonText: `Sim`,
    denyButtonText: `Cancelar`,
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      Swal.fire('Autorizado!', '', 'success');
      //ajax aqui para iniciar o atendimento.
    
      $.post('../../../app/Http/Controllers/ControllerAcoesChamado.php', {
        idChamado : idChamado, 
        insert_switch_case : 'insert_switch_case',
        switchCaseCaminho0 : switchCaseCaminho0,
        switchCaseCaminho1 : switchCaseCaminho1,
        switchCaseCaminho2 : switchCaseCaminho2,
        switchCaseCaminho3 : switchCaseCaminho3,
        switchCaseCaminho4 : switchCaseCaminho4,
        switchCaseCaminho5 : switchCaseCaminho5,
        switchCaseCaminho6 : switchCaseCaminho6,
        switchCaseCaminho7 : switchCaseCaminho7,
        switchCaseCaminho8 : switchCaseCaminho8,
        switchCaseCaminho9 : switchCaseCaminho9,
        switchCaseCaminho10 : switchCaseCaminho10,
        switchCaseCaminho11 : switchCaseCaminho11,
        switchCaseDescricao0 : switchCaseDescricao0,
        switchCaseDescricao1 : switchCaseDescricao1,
        switchCaseDescricao2 : switchCaseDescricao2,
        switchCaseDescricao3 : switchCaseDescricao3,
        switchCaseDescricao4 : switchCaseDescricao4,
        switchCaseDescricao5 : switchCaseDescricao5,
        switchCaseDescricao6 : switchCaseDescricao6,
        switchCaseDescricao7 : switchCaseDescricao7,
        switchCaseDescricao8 : switchCaseDescricao8,
        switchCaseDescricao9 : switchCaseDescricao9,
        switchCaseDescricao10 : switchCaseDescricao10,
        switchCaseDescricao11 : switchCaseDescricao11,
        switchCaseEsperado0 : switchCaseEsperado0,
        switchCaseEsperado1 : switchCaseEsperado1,
        switchCaseEsperado2 : switchCaseEsperado2,
        switchCaseEsperado3 : switchCaseEsperado3,
        switchCaseEsperado4 : switchCaseEsperado4,
        switchCaseEsperado5 : switchCaseEsperado5,
        switchCaseEsperado6 : switchCaseEsperado6,
        switchCaseEsperado7 : switchCaseEsperado7,
        switchCaseEsperado8 : switchCaseEsperado8,
        switchCaseEsperado9 : switchCaseEsperado9,
        switchCaseEsperado10 : switchCaseEsperado10,
        switchCaseEsperado11 : switchCaseEsperado11,
        switchCaseOcorrido0 : switchCaseOcorrido0,
        switchCaseOcorrido1 : switchCaseOcorrido1,
        switchCaseOcorrido2 : switchCaseOcorrido2,
        switchCaseOcorrido3 : switchCaseOcorrido3,
        switchCaseOcorrido4 : switchCaseOcorrido4,
        switchCaseOcorrido5 : switchCaseOcorrido5,
        switchCaseOcorrido6 : switchCaseOcorrido6,
        switchCaseOcorrido7 : switchCaseOcorrido7,
        switchCaseOcorrido8 : switchCaseOcorrido8,
        switchCaseOcorrido9 : switchCaseOcorrido9,
        switchCaseOcorrido10 : switchCaseOcorrido10,
        switchCaseOcorrido11 : switchCaseOcorrido11
      }, function(resposta){
          
      });


      $.post('../../../app/Http/Controllers/ControllerAcoesChamado.php', {
        idChamado : idChamado,
        autoriza_propagacao : 'autoriza_propagacao'
      }, function(resposta){
          // Valida a resposta
      });

        var load = setInterval(function () {
            document.location.reload();
        }, 2000);      
    } else if (result.isDenied) {
      Swal.fire('Propagação não autorizada', '', 'info')
    }
  })
}
function propagar(idChamado){
  Swal.fire({
    title: 'Propagar e finalizar demanda?',
    showDenyButton: true,
    confirmButtonText: `Sim`,
    denyButtonText: `Cancelar`,
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      Swal.fire('Demanda finalizada!', '', 'success');
      //ajax aqui para iniciar o atendimento.
    
      $.post('../../../app/Http/Controllers/ControllerAcoesChamado.php', {
        idChamado : idChamado,
        propaga_apos_autorizar : 'propaga_apos_autorizar'
      }, function(resposta){
          // Valida a resposta
          console.log(resposta)
      });

        var load = setInterval(function () {
            document.location.reload();
        }, 2000);      
    } else if (result.isDenied) {
      Swal.fire('Propagação não autorizada', '', 'info')
    }
  })
}
