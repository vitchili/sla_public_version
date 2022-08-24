<?php
class ConfiguracaoEmails{
    public function __construct(){

    }
    public function criarConfiguracaoEmail(){
    }

    public function getConfiguracaoEmails(){
        require_once __DIR__ . '/../../../database/connection.php';
        $sql = "SELECT * FROM tb_configuracao_emails WHERE status = '1';";
        $result = select($sql); 
        return $result;
    }
}
?>