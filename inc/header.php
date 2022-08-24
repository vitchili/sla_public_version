<?php
error_reporting(0);
//session_cache_expire(180000);
date_default_timezone_set('America/Sao_Paulo'); 
session_start();
if (!($_SESSION['logged'])) {
    echo " 
    <script>
        alert('Acesso não permitido. Usuário não autenticado.');
        window.location.replace(\"/suporte-aquicob/sair.php\");
    </script>";
}
$dropdownok = "";
if($_SESSION['cargo'] != 'USR'){
 $dropdownok = "onclick='dropdownMenu(2)'";
}

if(isset($_SESSION['empresa']) && substr($_SESSION['empresa'], 0, 11) == 'acerteaqui_'){
    $logo = "<img src='/suporte-aquicob/public/images/logo_acerte.png' style='width:200px;' id='logo-aquicob'>";
    $title = "SUPORTE ACERTE AQUI";
    $color_header = "#31b9c2";
}else{
    $logo = "<img src='/suporte-aquicob/public/images/logo.png' id='logo-aquicob' >";
    $title = "SUPORTE AQUICOB";
    $color_header = "#0066b1";
}

require_once __DIR__ . '/../app/Http/Controllers/ControllerNotificacoes.php';
$notificacoes = new ControllerNotificacoes;
$qtNotificacoes = $notificacoes->getNotificacoesNaoVistas($_SESSION['id']);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous"></script> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link rel="stylesheet" type="text/css" href="/suporte-aquicob/public/css/general.css">
    <link rel="stylesheet" type="text/css" href="/suporte-aquicob/public/css/general-responsive.css">
    <link rel="stylesheet" type="text/css"  href="/suporte-aquicob/public/css/dashboard_chamados_mes.css">
    <link rel="stylesheet" type="text/css" href="/suporte-aquicob/public/css/propagacoesSLA.css"> 
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
    <link rel="shortcut icon" href="/suporte-aquicob/public/images/favicon.png">

    <script src="//cdn.ckeditor.com/4.17.1/basic/ckeditor.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title><?= $title;?></title>
</head>
<body>
    <header class="cabecalho" style='background-color: <?= $color_header; ?>'>
        <div class="logo"><?= $logo; ?></div>
        <div class="right-nav">
            <div class="info-nav">
                <div class="user-acess">
                    <a class="botaoAbrirDropdown" href="#" <?= $dropdownok; ?>>
                            <picture id="icon_usuario">
                                <img src="/suporte-aquicob/public/images/usuario.svg" id="user-icon">&nbsp;&nbsp;&nbsp;
                            </picture>
                            <span id="span-ola-nome-usuario" style='background-color: <?= $color_header; ?>'><?php echo "Olá, " . $_SESSION['nome_usuario']; ?></span>
                                <i class="fa fa-chevron-down" id="setinha_dropdown"></i>&nbsp;&nbsp; <!--chave 2 = abrir dropdown. 1 = fechar -->
                                <div id="dropdownitens"></div>
                    </a>
                    <div class="box" >
                        <div class="notifications" onmouseover="retiraDadosHeader()" onmouseout="voltaDadosHeader()">
                            <picture>
                                <img src="/suporte-aquicob/public/images/alarm.svg" id="alarm-icon">
                            </picture>
                            <?php
                                if(count($qtNotificacoes) > 0){
                                    echo "<span class='num'>".count($qtNotificacoes)."</span>";                                         
                                }else{
                                    echo "<span class='num' style='visibility: hidden;'>".count($qtNotificacoes)."</span>";                                         
                                }
                            ?>
                            <ul class="listNotification">
                                <?php
                                    if(count($qtNotificacoes) == 0){
                                        echo "
                                            <li class='icon' style='display: block; text-align: center'>
                                                <div>
                                                    <span class='text'>- Nenhuma notificação pendente -</span>
                                                </div>
                                            </li>       
                                        ";        
                                    }
                                    for($i=0; $i<count($qtNotificacoes); $i++){
                                        echo "
                                            <li class='icon'>
                                                <input type='checkbox' id='checkVisuNotificacao".$qtNotificacoes[$i]['id']."' name='checkVisuNotificacao".$qtNotificacoes[$i]['id']."' onclick=\"visualizarNotificacao('".$qtNotificacoes[$i]['id']."', '".$_SESSION['id']."');\"/>&nbsp;&nbsp;
                                                <span class='text'>".$qtNotificacoes[$i]['mensagem']."</span>
                                            </li>       
                                        ";
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <header id="header-cabecalho-horizontal" style="position: fixed;"> 
        <?php
        if(isset($_GET['dashboard'])){
            header('Location: /suporte-aquicob/resources/views/controle-sla/dashboard.php');
        }
        if($_SESSION['cargo'] != 'USR'){
            echo "
                <ul id=\"cabecalho-horizontal\">
                    <a href=\"/suporte-aquicob/resources/views/controle-sla/dashboard.php\"><li class=\"item-cabecalho-horizontal\">Dashboard</li></a>
                    <a href=\"/suporte-aquicob/resources/views/controle-sla/controle-sla.php\"><li class=\"item-cabecalho-horizontal\">Novos Chamados</li></a>
                    <a href=\"/suporte-aquicob/resources/views/controle-sla/minhas_tarefas.php\"><li class=\"item-cabecalho-horizontal\">Minhas Tarefas</li></a>
                    <a href=\"/suporte-aquicob/resources/views/controle-sla/testes.php?\"><li class=\"item-cabecalho-horizontal\">Testes</li></a>
                    <a href=\"/suporte-aquicob/resources/views/controle-sla/propagacoes.php?\"><li class=\"item-cabecalho-horizontal\">Propagações</li></a>
                    <a href=\"/suporte-aquicob/resources/views/controle-sla/registro_atendimentos.php?\"><li class=\"item-cabecalho-horizontal\">Diário do Funcionário</li></a>
                </ul>    
            ";
        }else{
            echo "
            <ul id=\"cabecalho-horizontal\">
                <a href=\"/suporte-aquicob/resources/views/documentacao/index_documentacao.php?token=".$_SESSION['token']."&nome=".$_SESSION['nome_usuario']."&empresa=".$_SESSION['empresa']."&email=".$_SESSION['email']."\"><li class=\"item-cabecalho-horizontal\">Central de Ajuda</li></a>
                <a href=\"/suporte-aquicob/resources/views/documentacao/manuais/geral_manuais.php?token=".$_SESSION['token']."&nome=".$_SESSION['nome_usuario']."&empresa=".$_SESSION['empresa']."&email=".$_SESSION['email']."\"><li class=\"item-cabecalho-horizontal\">Manual</li></a>
                <a href=\"/suporte-aquicob/resources/views/documentacao/faq/geral-faq.php?token=".$_SESSION['token']."&nome=".$_SESSION['nome_usuario']."&empresa=".$_SESSION['empresa']."&email=".$_SESSION['email']."\"><li class=\"item-cabecalho-horizontal\">FAQ</li></a>
                <a href=\"/suporte-aquicob/resources/views/documentacao/novidades/novidades.php?token=".$_SESSION['token']."&nome=".$_SESSION['nome_usuario']."&empresa=".$_SESSION['empresa']."&email=".$_SESSION['email']."\"><li class=\"item-cabecalho-horizontal\">Novidades</li></a>
                <a href=\"/suporte-aquicob/resources/views/documentacao/chamados/visualizacao_chamados.php?token=".$_SESSION['token']."&nome=".$_SESSION['nome_usuario']."&empresa=".$_SESSION['empresa']."&email=".$_SESSION['email']."\"><li class=\"item-cabecalho-horizontal\">Chamados Suporte</li></a>
            </ul>    
        ";
        }
        echo "
    </header>
    ";