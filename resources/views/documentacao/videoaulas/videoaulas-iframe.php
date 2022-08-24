<?php 
error_reporting(0);
session_start();
    if (!isset($_SESSION['nome_usuario'])) {
        echo "
        <script>
            alert('Acesso não permitido. Usuário não autenticado!');
            window.location.replace(`../../../../login.php`);
        </script>";
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link rel="stylesheet" type="text/css" href="../../../public/css/general.css">
    <link rel="stylesheet" type="text/css" href="../../../public/css/general-responsive.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="../../../public/images/favicon.png"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DOMMUS DOC | VIDEOAULA</title>
</head>
<body>
<header class="cabecalho">
        <div class="logo"><img src="../../../public/images/logo.svg" id="logo-dommus"></div>
        <div class="right-nav">
            <div class="info-nav">
                <div class="user-acess">
                        <a class="botaoAbrirDropdown" href="#" onclick="dropdownMenu(2)">
                            <picture>
                                <img src="../../../public/images/usuario.svg" id="user-icon">&nbsp;&nbsp;&nbsp;
                            </picture>
                            <span id="span-ola-nome-usuario"><?php echo "Olá " . $_SESSION['nome_usuario']; ?></span>
                            <i class="fa fa-chevron-down"></i>&nbsp;&nbsp; <!--chave 2 = abrir dropdown. 1 = fechar -->
                            <div id="dropdownitens"></div>
                        </a>
                        <picture>
                            <a href="#"><img src="../../../public/images/alarm.svg" id="alarm-icon" onclick="news(2)"></a>
                        </picture>
                </div>
            </div>
        </div>
        <div class="search-topic">
                    <picture>
                        <img src="../../../public/images/search.svg" id="search-icon">
                    </picture>
        </div>
    </header>
    <header>
        <div class="verticalMenu" id="menuVertical">
            <div class="itensVerticalGroup">
                <div class="itemVerticalMenu">
                <br/>
                    <a href="#" id="botaoEstender">
                        <i class="fas fa-angle-double-right"></i>
                    </a>
                </div>
                <hr/>
                <div class="itemVerticalMenu">
                        <span class="itemHide" id="itemHide">Início</span>
                    <a href="../../../public/index.php">  
                        <i class="fas fa-home"></i>
                    </a>
                </div>
                <!--<div class="itemVerticalMenu">
                    <span class="itemHide" id="itemHide2">Forum</span>
                    <a href="../forum/geral-topicos.php">
                    <i class="fas fa-comment-dots"></i>
                    </a>
                </div>-->
                <div class="itemVerticalMenu">
                    <span class="itemHide" id="itemHide3">Manual</span>
                   <a href="../manuais/geral-manuais.php">     
                        <i class="fas fa-file-pdf"></i>
                    </a>
                </div>
                <div class="itemVerticalMenu">
                    <span class="itemHide" id="itemHide4">Videoaulas</span>
                    <a href="./videos-gerais.php">
                        <i class="fas fa-file-video"></i>
                    </a>
                </div>
                <div class="itemVerticalMenu">
                        <span class="itemHide" id="itemHide5">FAQ</span>
                    <a href="../faq/geral-faq.php">
                        <i class="fas fa-question"></i>
                    </a>
                </div>
                <div class="itemVerticalMenu">
                        <span class="itemHide" id="itemHide7">Novidades</span>
                    <a href="../novidades/novidades.php">
                        <i class="fas fa-bell"></i>
                    </a>
                </div>
                <div class="itemVerticalMenu">
                        <span class="itemHide" id="itemHide8">Agenda</span>
                    <a href="../agenda/agenda.php">
                        <i class="fas fa-calendar-alt"></i>
                    </a>
                </div>
                <hr/>
                <div class="itemVerticalMenu">
                    <span class="itemHide" id="itemHide6">Voltar</span>
                    <a href="../../../../index_ui.php">
                        <i class="fas fa-arrow-circle-left"></i>
                    </a>
                </div>
            </div>
        </div>
    </header>
    <div id="blocoBody">
        <section class="white-section">
            <div id="manual">    
                <div class="bloco-titulo">
                    <h1 class="titulo-card">Videoaula</h1>
                    <a href="#" onclick="clickVoltar()" class="voltaPagAnterior">
                        <i class="fas fa-arrow-circle-left"></i>
                        <script>
                            function clickVoltar(){
                                window.location.replace(`../../../public/index.php?text-pesquisa=&button=#`);
                            }
                        </script>
                    </a>
                </div>
                <div>
                    <?php
                        //se receber o nome do capitulo por parametro, mostra ele. senao, mostra o pdf em construcao.
                        if(isset($_GET['codigoVideo']) && strlen($_GET['codigoVideo']) > 1){
                            $codigoVideo = $_GET['codigoVideo'];
                            echo
                            "<iframe src=\"https://player.vimeo.com/video/$codigoVideo\" width=\"100%\" height=\"700\" frameborder=\"0\" allow=\"autoplay;fullscreen\" allowfullscreen></iframe>";
                        }else{
                            $nomeCapitulo = "em_construcao.pdf";
                            echo
                            "<object data=\"../../../storage/app/capitulos_manual/". $nomeCapitulo . "\" type=\"application/pdf\" width=\"100%\" height=\"1200px\">
                                <embed src=\"../../../storage/app/capitulos_manual/". $nomeCapitulo . "\" type=\"application/pdf\"/>
                            </object>";
                        }    
                    ?>    
                </div>
            </div>
        </section>
        <footer class="rodape">
            <hr id="hr-footer"/>
            <p class="copy">Siga-nos nas redes sociais:
            <a href="https://www.facebook.com/dommussistemas" target="blank">Facebook: <i class="fab fa-facebook-f"></i></a> &nbsp; <a href="https://www.instagram.com/dommussistemas/" target="blank">Instagram: <i class="fab fa-instagram"></i></a> &nbsp; <a href="https://website.dommus.com.br/" target="blank">Website: <i class="fab fa-chrome"></i></a>
            </p>
            <p class="copy"> &copy; 2021. Dommus Tecnologia</p>
        </footer>
    </div>    
    <script type="text/javascript" src="../../../public/js/interaction.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
