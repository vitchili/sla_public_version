<?php
class Notificacoes{
    public function __construct(){

    }
    public function criarNotificacao($usuario, $mensagem){
        require_once __DIR__ . '/../../../database/connection.php';
        $sql = "INSERT INTO tb_notificacoes (usuario, mensagem, cadastrado_em, visto_em, visto_por, status) VALUES ({$usuario}, '{$mensagem}', NOW(), NULL, NULL, '1');";
        $result = insertGeral($sql); 
        return $result;
    }
    public function visualizarNotificacao($idNotificacao, $usuario, $checkbox){
        require_once __DIR__ . '/../../../database/connection.php';
        if($checkbox == 'true'){
            $sql = "UPDATE tb_notificacoes SET visto_em = NOW(), visto_por = '{$usuario}' WHERE id = {$idNotificacao};";
        }else{
            $sql = "UPDATE tb_notificacoes SET visto_em = NULL, visto_por = NULL' WHERE id = {$idNotificacao};";
        }
        $result = updateGeral($sql);
        return $result;
    }
    public function getNotificacoesNaoVistas($usuario){
        require_once __DIR__ . '/../../../database/connection.php';
        $sql = "SELECT * FROM tb_notificacoes WHERE usuario = {$usuario} AND visto_em IS NULL;";
        $result = select($sql); 
        return $result;
    }
    public function getQtNotificacoesNaoVistas($usuario){
        require_once __DIR__ . '/../../../database/connection.php';
        $sql = "SELECT COUNT(*) AS quantidade FROM tb_notificacoes WHERE usuario = {$usuario} AND visto_em IS NULL;";
        $result = select($sql); 
        return $result;
    }
    
}
?>