<?php
class SetConfiguracoesUsuario{
    function __construct(){

    }
    function atualizaDados($id_usuario, $nome, $email, $senha, $tipo_perfil, $coordenacao){
        require_once __DIR__ . '/../../../database/connection.php';
        $senhaEncrypt = md5($senha);
        $sql = "UPDATE tb_solicitante_sla SET nome = '$nome', email = '$email', senha = '$senhaEncrypt', cargo = '$tipo_perfil', administrador = '$coordenacao' WHERE id = '$id_usuario';";
        $update = updateGeral($sql);

        $_SESSION['nome_usuario'] = $nome;
        $_SESSION['email'] = $email;
        $_SESSION['cargo'] = $tipo_perfil;
        $_SESSION['administrador'] = $coordenacao;
        
    }
}