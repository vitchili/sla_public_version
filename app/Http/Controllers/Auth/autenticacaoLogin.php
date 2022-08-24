<?php
    //error_reporting(0);
    session_cache_expire(180000);
    session_start();
    $_SESSION['logged'] = false;
    if(!$_SESSION['logged']){
        if(isset($_POST['email'])){
            $userPrint = $_POST['email']; //o usuario digitado no login
        }else{
            $userPrint = NULL;
        }
        
        if(isset($_POST['senha'])){
            $passwordPrint = $_POST['senha']; //a senha digitada no login
        }else{
            $passwordPrint = NULL;
        }
        
        if($userPrint != NULL || $passwordPrint != NULL){
           /*se o email OU a senha nao forem nulos, conecta ao banco e faz a verificacao*/
           require_once '../../../../database/connection.php'; 
           $senhaCript = md5($passwordPrint);
           $sql = "SELECT id, nome, email, senha, cargo, administrador, status FROM tb_solicitante_sla
           WHERE email = '$userPrint'
           AND senha = '$senhaCript';";
           $rows = select($sql);

           for($i=0;$i<count($rows);$i++){
                if($userPrint == $rows[$i]['email'] && $senhaCript == $rows[$i]['senha'] && $rows[$i]['status'] == '1'){ // checa compatibilidade de user e senha e cria as sessions
                    $_SESSION['nome_usuario'] = $rows[$i]['nome'];
                    $_SESSION['cargo'] = $rows[$i]['cargo'];
                    $_SESSION['email'] = $rows[$i]['email'];
                    $_SESSION['senha'] = $rows[$i]['senha'];
                    $_SESSION['id'] = $rows[$i]['id'];
                    $_SESSION['administrador'] = $rows[$i]['administrador'];
                    $_SESSION['logged'] = true;
                    
                    if($_SESSION['cargo'] != 'USR'){
                        header('Location: /suporte-aquicob/resources/views/controle-sla/controle-sla.php');
                    }else{
                        header('Location: /suporte-aquicob/resources/views/documentacao/index_documentacao.php');
                    }
                    
                }
           }
           //ESSE TRECHO NUNCA SERÁ EXECUTADO SE O LOGIN ESTIVER CORRETO
           echo "
            <script type=\"text/javascript\">
                alert('Usuário e/ou senha incorretos.');
                window.history.go(-1);
            </script>
            ";
        }
    }    
?>