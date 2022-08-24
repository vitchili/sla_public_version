<?php
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
  <link rel="stylesheet" type="text/css" href="public/css/general.css">
  <link rel="stylesheet" type="text/css" href="public/css/login.css"> 
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
  <link rel="shortcut icon" href="public/images/favicon.png"/>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<title>AQUICOB SLA | LOGIN</title>
<!------ Include the above in your HEAD tag ---------->
<script>
function alertEsqueciMinhaSenha(){
    Swal.fire(
    'Esqueceu sua senha?',
    'Peça para o DBA modificar sua senha manualmente.',
    'question'
    )
}

</script>
</head>
<body id="LoginForm">
    <br/><br/>
    <div class="container">
        <div class="login-form">
            <img src="public/images/logo.png" style="width: 150px;">
            <div class="main-div">
                    <form id="Login" method="POST" action="app/Http/Controllers/Auth/autenticacaoLogin.php">
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" id="inputEmail" placeholder="E-mail">
                        </div>
                        <div class="form-group">
                            <input type="password" name="senha" class="form-control" id="inputPassword" placeholder="Senha">
                        </div>
                        <div class="forgot">
                            <a href="#" onclick="alertEsqueciMinhaSenha()">Esqueci a senha</a>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-sign-in-alt"></i>&nbsp; Entrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>