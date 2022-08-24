<?php
require_once __DIR__ . '/../../Models/queries/Automatizacao.php';
require_once __DIR__ . '/../../Models/queries/ConfiguracaoEmails.php';
require_once __DIR__ . '/../../Models/queries/Log.php';
class AutomatizacaoController{
    public function __construct(){

    }
    public function getSetAutomatizacaoAgendada($tag){
        $automatizacao = new Automatizacao;
        $getAutomatizacao = $automatizacao->getAutomatizacaoAgendada($tag);
        $data_agora = date('Y-m-d H:i:s');
        if($data_agora > $getAutomatizacao[0]['agendado_para']){
            $dataHoraDoPause = $getAutomatizacao[0]['agendado_para'];
            switch($tag){
                case 'autopause':
                    $log = new Log;
                    $log->autopause($dataHoraDoPause);
                break;
                case 'abre_chamado_email':
                    $config_email = new ConfiguracaoEmails;
                    $emails = $config_email->getConfiguracaoEmails();
                    /**********CONFIGURACAO RECEBIMENTO EMAIL******** */
                    for($i=0; $i<count($emails); $i++){
                        $imapPath = "{".$emails[$i]['servidor_pop_imap'].":".$emails[$i]['porta']."/".$emails[$i]['imap_pop']."/ssl}INBOX";
                        $username = $emails[$i]['username'];
                        $password = $emails[$i]['password'];
                        $inbox = imap_open($imapPath,$username,$password);
                        
                        $emails = imap_search($inbox,'UNSEEN');
                        if(count($emails) > 0){
                            foreach($emails as $email) {
                                $headerInfo = imap_headerinfo($inbox,$email);
                                $assunto = quoted_printable_decode($headerInfo->subject);
                                $message = quoted_printable_decode(imap_fetchbody($inbox, $email, 1));
                                $from = $headerInfo->from[0]->mailbox.'@'.$headerInfo->from[0]->host;  
                                $from_name = $headerInfo->fromaddress;  
                                $arrayFields = array(
                                    "cliente" => "Cliente Pad",
                                    "titulo" => $assunto,
                                    "descricao" => $message,
                                    "produto" => "CRM",
                                    "modulo" => "Outro",
                                    "tela" => "Outro",
                                    "solicitante_externo" => "$from_name",
                                    "email_externo" => "$from"
                                );
                                $curl = curl_init();
            
                                curl_setopt_array($curl, array(
                                CURLOPT_URL => 'http://sla.aquicob.com.br/suporte-aquicob/app/Http/api/abreChamadoPorAPI.php',
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_ENCODING => '',
                                CURLOPT_MAXREDIRS => 10,
                                CURLOPT_TIMEOUT => 0,
                                CURLOPT_FOLLOWLOCATION => true,
                                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                CURLOPT_CUSTOMREQUEST => 'POST',
                                CURLOPT_POSTFIELDS => json_encode($arrayFields),
                                CURLOPT_HTTPHEADER => array(
                                    'Content-Type: text/plain'
                                ),
                                ));
            
                                curl_exec($curl);
                                curl_close($curl);    
                            }
                        }
                        imap_expunge($inbox);
                        imap_close($inbox);
                        
                    }
                    /*FIM DA CONFIGURACAO EMAIL*/
                break;
            }
            
            $this->setUpdateAutomatizacao($tag);   
        }
        return $getAutomatizacao;
    }
    public function setUpdateAutomatizacao($tag){
        $automatizacao = new Automatizacao;
        $automatizacao->setUpdateAutomatizacao($tag);
    }

}