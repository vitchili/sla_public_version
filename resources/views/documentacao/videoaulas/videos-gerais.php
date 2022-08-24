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
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../../../public/images/favicon.png"/>
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
    <div class="verticalMenu">
            <div class="itensVerticalGroup">
                <div class="itemVerticalMenu">
                <br/>
                    <a href="#">
                        <span class="itemHide">Exibir Menu</span>
                        <i class="fas fa-angle-double-right"></i>
                    </a>
                </div>
                <hr/>
                <div class="itemVerticalMenu">
                    <a href="../../../public/index.php">
                        <span class="itemHide">Home</span>
                        <i class="fas fa-home"></i>
                    </a>
                </div>
                <!--<div class="itemVerticalMenu">
                    <a href="../forum/geral-topicos.php">
                    <span class="itemHide">Forum</span>
                    <i class="fas fa-comment-dots"></i>
                    </a>
                </div>-->
                <div class="itemVerticalMenu">
                    <a href="../manuais/geral-manuais.php">
                        <span class="itemHide">Manual</span>
                        <i class="fas fa-file-pdf"></i>
                    </a>
                </div>
                <div class="itemVerticalMenu">
                    <a href="#">
                        <span class="itemHide">Videoaula</span>
                        <i class="fas fa-file-video"></i>
                    </a>
                </div>
                <div class="itemVerticalMenu">
                    <a href="../faq/geral-faq.php">
                        <span class="itemHide">FAQ</span>
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
                    <a href="../../../../index_ui.php">
                        <span class="itemHide">Voltar</span>
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
                    <h1 class="titulo-card">Videoaulas</h1>
                    <a href="#" onclick="clickVoltar()" class="voltaPagAnterior">
                        <i class="fas fa-arrow-circle-left"></i>
                        <script>
                            function clickVoltar(){
                                window.history.go(-1);
                            }
                        </script>
                    </a>
                </div>
                <div class="bloco-geral">    
                    <div class="sub-bloco">
                    <i class="far fa-file-video icon-left fa-2x"></i>
                    </div>
                    <div class="sub-bloco">
                        <h2 class="sub-titulo-card">Videoaulas sobre as etapas e funcionalidades do sistema</h2>
                        <p class="p-card">Busque aqui por funcionalidades e passo a passo do sistema.</p>
                    </div>
                    <div class="sub-bloco">
                        &nbsp;
                    </div>
                    <div class="sub-bloco">
                        <i class="far fa-user-circle fa-2x icon-left"></i>
                    </div>
                    <div>
                        <p class="p-card" style="color: #515151;"><br/>por Administrador <br/>20/04/2021 às 00:00</p>
                    </div>
                </div>
            </div>
            <div class="bloco-titulo-toggle">
                <a class="btn-toggle" data-toggle="collapse" href="#modulo1" role="button" aria-expanded="false" aria-controls="collapseExample">
                    <span>Módulo de Vendas</span>
                </a>&nbsp;
                <a class="btn-toggle" id="modulo2" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                    <span>CRM Pré-vendas</span>
                </a>&nbsp;
                <a class="btn-toggle"  id="modulo3" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                    <span>Vendas Online</span>
                </a>&nbsp;
                <a class="btn-toggle" id="modulo4" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                    <span>Novos Negócios</span>
                </a>&nbsp;
                <a class="btn-toggle" id="modulo5" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                    <span>Comissionamento</span>
                </a>&nbsp;
                <a class="btn-toggle" id="modulo6" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                    <span>Entrega de Chaves</span>
                </a>&nbsp;
            </div>
            <br/>
        </section>
        <section class="white-section">   
            <div class="collapse" id="modulo1">
                <div class="white-section-100">
                <?php
                require_once __DIR__ . '/../../../app/Http/Controllers/GetVideoaulas.php';
                $getVideos = new GetVideoaulas;
                $videos = $getVideos->getVideos();    
                
                echo "<script src=\"https://player.vimeo.com/api/player.js\"></script>";
            
                for($i=0;$i<count($videos);$i++){
                    if(strlen($videos[$i]['codigo_vimeo']) > 0){
                        echo "
                            <div class=\"itemGridVideo\">
                                <h1 class=\"sub-titulo-card\">".$videos[$i]['subcategoria']."</h1>
                                <iframe src=\"https://player.vimeo.com/video/".$videos[$i]['codigo_vimeo']."\" width=\"100%\" height=\"300\" frameborder=\"0\" allow=\"autoplay;fullscreen\" allowfullscreen></iframe>
                            </div>
                            <hr/>
                        ";
                    }    
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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script> 
    <script type="text/javascript" src="../../../public/js/interaction.js"></script>
    <script type="text/javascript" src="../../../public/js/mouse-block.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>