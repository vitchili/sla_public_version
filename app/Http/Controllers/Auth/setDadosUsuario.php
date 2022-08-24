<?php
    session_start();
    $id_usuario = $_SESSION['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $tipo_perfil = $_POST['tipo_perfil'];
    $coordenacao = $_POST['coordenacao'];

    require_once __DIR__ .'/../../../Models/queries/SetConfiguracoesUsuario.php';
    $objConfig = new SetConfiguracoesUsuario;
    $setDados = $objConfig->atualizaDados($id_usuario, $nome, $email, $senha, $tipo_perfil, $coordenacao); 
    
?>