function incrementaLikesResposta(i,idTopico,qtLikes,ano,mes,dia,hora,minuto,segundo,ja_curtiu,idUser){
    /*i é o contador que vem do php
    * idTopico é o topico
    * idUser é quem criou a resposta
    * os parametros de tempo sao convertidos em data_hora
    * a global condicaoLikeDislike é um array de ate 100 posicoes, em que ave se o usuario ja curtiu */
    var dataHora = `${ano}-${mes}-${dia} ${hora}:${minuto}:${segundo}`;
    var likesAtuais = Number(document.getElementById('incrementaLikes'+i).innerHTML);    
    var idTopico = $(`#idTopico${i}`).val();
    var dataHora = $(`#dataHora${i}`).val();
    var qtLikes = Number($(`#qtLikes${i}`).val());    
    var ja_curtiu = $(`#ja_curtiu${i}`).val();
    var divModificada = 0;
    var jaDeuLike;

    $.ajax({
        url:'../../../app/Http/Controllers/getQuemCurtiu.php',
        type:'POST',
        data:{dataHora:dataHora, idTopico:idTopico},
        datatype:'json',
        success:function(data){
            data = JSON.parse(data);
            console.log(data);
            for(k=0;k<data.length;k++){
                if(data[k] == idUser){
                    jaDeuLike = 1;
                    k=data.length;
                }else{
                    jaDeuLike = 0;
                }
            }
            if(jaDeuLike == 1){
                divModificada = --likesAtuais;
                document.getElementById('incrementaLikes'+i).innerHTML = divModificada;
                document.getElementById('likeNumero'+i).style.color = '#424242';
                qtLikes = Number(qtLikes - 1);

                
            }else{
                divModificada = ++likesAtuais;
                document.getElementById('incrementaLikes'+i).innerHTML = divModificada;
                document.getElementById('likeNumero'+i).style.color = '#53E458';
                qtLikes = Number(qtLikes + 1);
            }
            $.post('../../../app/Http/Controllers/incrementaLikesResposta.php', {
                idTopico:idTopico,
                dataHora:dataHora,
                qtLikes:qtLikes,
                jaDeuLike:jaDeuLike,
                idUser:idUser
            }, function(resposta){
                // Valida a resposta
                if(resposta == 1){
                    // Limpa os inputs
                    
                    //alert('Mensagem enviada com sucesso.');
                }else {
                    //alert(resposta);
                }
            });
            
        },
        error:function(){
            console.log('Erro');
        }
    }) ;
    
    /*if(ja_curtiu == 0){
        var divModificada = ++likesAtuais;
        document.getElementById('incrementaLikes'+i).innerHTML = divModificada;
        document.getElementById('likeNumero'+i).style.color = '#53E458';
        qtLikes = Number(qtLikes + 1);
    }else{
        var divModificada = --likesAtuais;
        document.getElementById('incrementaLikes'+i).innerHTML = divModificada;
        document.getElementById('likeNumero'+i).style.color = '#424242';
        qtLikes = Number(qtLikes - 1);                
    }*/
    /*
    $.post('../../../app/Http/Controllers/incrementaLikesResposta.php', {
        idTopico:idTopico,
        dataHora:dataHora,
        qtLikes:qtLikes,
        jaDeuLike:jaDeuLike,
        idUser:idUser
    }, function(resposta){
        // Valida a resposta
        if(resposta == 1){
            // Limpa os inputs
            
            //alert('Mensagem enviada com sucesso.');
        }else {
            //alert(resposta);
        }
    });*/

    
}
function setJaDeuLike(binario){
    this.binario = binario;
}