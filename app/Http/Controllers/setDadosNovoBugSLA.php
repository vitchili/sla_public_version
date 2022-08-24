<?php
    session_start();
    function configuraDisparoEmail($settaNovoBug){
      $emailsEnvolvidos = $settaNovoBug[0]['envolvidos'];
      $envolvidos = explode(",", $emailsEnvolvidos);
      $titulo = "Suporte Aquicob - Seu chamado foi aberto - Ticket ".$settaNovoBug[0]['id_chamado'];
      $mensagem = "<p>Olá! Seu chamado de suporte foi aberto. O número de identificação desse ticket o #".$settaNovoBug[0]['id_chamado']."</p>
      <p> Seu chamado está sendo analisado pela nossa equipe de Suporte e Desenvolvimento. Assim que estiver solucionado, você receberá um novo e-mail com as informações da correção.</p>
      <p> Atenciosamente, </p>
      <p> Suporte Aquicob </p>"; 
      
      
      require_once __DIR__ . '/../../Models/queries/DisparoEmail.php';
      $disparoEmail = new DisparoEmail;
      $disparoEmail->enviarEmail($envolvidos, $titulo, $mensagem);
    }
    
    function calculaPesos($modulo, $tela, $prioridade){ //,calcula a media dos pesos do modulo, tela e urgencia
      include __DIR__ . '/SlaController.php';
      $getPesos = new SlaController;
      $pesoPrioridade = $getPesos->getPesoPrioridadesSLA($prioridade);
      $pesoTela = $getPesos->getPesoTelaSLA($tela);
      $pesoModulo = $getPesos->getPesoModuloSLA($modulo);

      $mediaPesos = (intval($pesoPrioridade[0]['peso']) + intval($pesoTela[0]['peso']) + intval($pesoModulo[0]['peso'])) / 3;
      return $mediaPesos;
    }

    function calculaPrazo($mediaPesos){
      $prazo = 48;
      //verificar se calcular por intervalos em if ou switch exato.
        /*switch($mediaPesos){
            case '1': $prazo = 48;
            break;
            case '2': $prazo = 72;
            break;
            case '3': $prazo = 72;
            break;
            case '4': $prazo = 120;
            break;
            case '5': $prazo = 120;
            break;
        }*/
      return $prazo;
  }    
  /*REGRA DE NEGOCIO BUG*/
    // o calculo de data estimada de entrega ÃÂÃÂ© feita no front, por ajax
    /*CRIA CHAMADO E RETORNA ID*/
    require_once __DIR__ . '/../../Models/queries/SetNovoBug.php';
    $novoBug = new SetNovoBug;

      /*REQUESTS GERAIS CRIACAO DE BUG OU ORCAMENTO*/
      $id_cliente = $_POST['cliente'];
      $id_solicitante = $_POST['solicitante'];
      $titulo = addslashes($_POST['titulo']);
      $descricao = addslashes($_POST['descricao']);
      $data_entrega_estimada_str = $_POST['data_entrega_estimada'];
      $data_entrega_estimada = date("Y-m-d",strtotime($data_entrega_estimada_str));

    /*REQUESTS BUG*/
      $produto = isset($_POST['produto']) ? $_POST['produto'] : '';
      $solicitante_externo = isset($_POST['solicitante_externo']) ? addslashes($_POST['solicitante_externo']) : '';
      $email_externo = isset($_POST['email_externo']) ? $_POST['email_externo'] : '';
      $envolvidos = isset($_POST['envolvidos']) ? $_POST['envolvidos'] : '';
      $modulo = isset($_POST['modulo']) ? $_POST['modulo'] : '';
      $tela = isset($_POST['tela']) ? $_POST['tela'] : '';
      $direcionamento = isset($_POST['direcionamento']) ? $_POST['direcionamento'] : '';
      $prioridade = isset($_POST['prioridade']) ? $_POST['prioridade'] : '';
      $mediaPesos = calculaPesos($modulo, $tela, $prioridade);
      $prazo = 48;
      
    /*REQUESTS ORCAMENTO*/
      $total_horas = isset($_POST['total_horas']) ? $_POST['total_horas'] : '';
      $valor_hora = isset($_POST['valor_hora']) ? $_POST['valor_hora'] : '';
      $desconto = isset($_POST['desconto'])? $_POST['desconto'] : '';
      $total_preco = isset($_POST['totalPreco']) ? $_POST['totalPreco'] : '';

      
      if(!isset($total_horas) || empty($total_horas)){
        $settaNovoBug = $novoBug->setNovoBug($id_cliente,$envolvidos,$id_solicitante,$titulo,$descricao,$data_entrega_estimada,$produto,$modulo,$tela, $direcionamento, $prioridade, $prazo, $solicitante_externo, $email_externo); // novo bug
      }else{
        $settaNovoBug = $novoBug->setNovoOrcamento($id_cliente,$id_solicitante,$titulo,$descricao,$data_entrega_estimada,$total_horas,$valor_hora,$desconto,$total_preco); // orcamento
      }
      $id_chamado = $settaNovoBug[0]['id_chamado'];
      echo json_encode(intVal($id_chamado));
      // $id_chamado = $_POST['id_chamado'];
      // if(!isset($total_horas) || empty($total_horas)){
      //   $updateBug = $novoBug->updateBug($id_chamado, $id_cliente,$id_solicitante,$descricao,$data_entrega_estimada,$produto,$modulo,$tela, $direcionamento, $prioridade, $prazo); // novo bug
      // }else{
      //   $updateBug = $novoBug->updateOrcamento($id_chamado, $id_cliente,$id_solicitante,$descricao,$data_entrega_estimada,$total_horas,$valor_hora,$desconto,$total_preco); // orcamento
      // }
    //PRIMEIRO ANEXO
    require_once __DIR__ . '/../../Models/queries/SetResponsavelChamadosSLA.php';

    if(isset($_POST['cadastro_por_api'])){
        if(isset($_POST['url1']) && !empty($_POST['url1'])){
          $caminho_anexo = $_POST['url1'];
          $caminhoAnexo = new SetResponsavelChamadosSLA;
          $caminhoAnexo->setCaminhoAnexo("1", $id_chamado, $caminho_anexo);
        }
    }else if ( isset( $_FILES["fileToUpload"] ) && !empty( $_FILES["fileToUpload"]["name"] ) ) {
      if ( is_uploaded_file( $_FILES["fileToUpload"]["tmp_name"] ) && $_FILES["fileToUpload"]["error"] === 0 ) {
        $uploadOk = 1;
        // RECUPERA A EXTENSÃÂÃÂÃÂÃÂO DO ARQUIVO ANEXADO.
        $extensao = explode('.', $_FILES['fileToUpload']['name']);
        $extensao = end($extensao);
        $extensao = mb_strtolower($extensao);

        

        mkdir(__DIR__ . "/../../../uploads/$id_chamado/", 0777, true);

        $nomeArquivo = 'anexo1';
        $caminho_anexo = "/suporte-aquicob/uploads/$id_chamado/$nomeArquivo.$extensao";
        $caminho_destino =  __DIR__ . "/../../../uploads/$id_chamado/$nomeArquivo.$extensao";
        require_once __DIR__ . '/../../Models/queries/SetResponsavelChamadosSLA.php';
        $caminhoAnexo = new SetResponsavelChamadosSLA;
        
        $caminhoAnexo->setCaminhoAnexo("1", $id_chamado, $caminho_anexo);

        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
          var_dump("Sorry, your file is too large.");
          $uploadOk = 0;
        }

        //$imageFileType = strtolower(pathinfo($caminho_anexo,PATHINFO_EXTENSION));
        
        // // Allow certain file formats
        // if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        //   echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        //   $uploadOk = 0;
        // }
        
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
          echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
          if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $caminho_destino)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
          } else {
            echo "Sorry, there was an error uploading your file.";
          }
        }
        
      }
    }


    //SEGUNDO ANEXO
    if(isset($_POST['cadastro_por_api'])){
      if(isset($_POST['url2']) && !empty($_POST['url2'])){
        $caminho_anexo = $_POST['url2'];
      }
    }else if ( isset( $_FILES["fileToUpload2"] ) && !empty( $_FILES["fileToUpload2"]["name"] ) ) {
      if ( is_uploaded_file( $_FILES["fileToUpload2"]["tmp_name"] ) && $_FILES["fileToUpload2"]["error"] === 0 ) {
        $uploadOk = 1;
        // RECUPERA A EXTENSÃÂÃÂÃÂÃÂO DO ARQUIVO ANEXADO.
        $extensao = explode('.', $_FILES['fileToUpload2']['name']);
        $extensao = end($extensao);
        $extensao = mb_strtolower($extensao);

        mkdir(__DIR__ . "/../../../uploads/$id_chamado/", 0777, true);

        $nomeArquivo = 'anexo2';
        $caminho_anexo = "/suporte-aquicob/uploads/$id_chamado/$nomeArquivo.$extensao";
        $caminho_destino =  __DIR__ . "/../../../uploads/$id_chamado/$nomeArquivo.$extensao";
        require_once __DIR__ . '/../../Models/queries/SetResponsavelChamadosSLA.php';
        $caminhoAnexo = new SetResponsavelChamadosSLA;

        

        $caminhoAnexo->setCaminhoAnexo("2", $id_chamado, $caminho_anexo);

        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
          var_dump("Sorry, your file is too large.");
          $uploadOk = 0;
        }

        //$imageFileType = strtolower(pathinfo($caminho_anexo,PATHINFO_EXTENSION));
        
        // Allow certain file formats
        /*if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
          echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
          $uploadOk = 0;
        }*/

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
          echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
          if (move_uploaded_file($_FILES["fileToUpload2"]["tmp_name"], $caminho_destino)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload2"]["name"])). " has been uploaded.";
          } else {
            echo "Sorry, there was an error uploading your file.";
          }
        }
        
      }
    }
    
    
   if(!isset($_POST['cadastro_por_api'])){
      /*REDIRECIONA*/
      configuraDisparoEmail($settaNovoBug);
      if($_SESSION['cargo'] != 'USR' && $_SESSION['cargo'] != NULL){
        header("Location: /suporte-aquicob/resources/views/controle-sla/controle-sla.php");
      }else{
        $_SESSION['cargo'] = $_POST['cargo'];
        $_SESSION['token'] = $_POST['token'];
        $_SESSION['nome_usuario'] = $_POST['nome_usuario'];
        $_SESSION['empresa'] = $_POST['empresa'];
        $_SESSION['email'] = $_POST['email'];

        header("Location: /suporte-aquicob/resources/views/documentacao/chamados/visualizacao_chamados.php?token=".$_SESSION['token']."&nome=".$_SESSION['nome_usuario']."&empresa=".$_SESSION['empresa']."&email=".$_SESSION['email']."\"");
      }
   }
    