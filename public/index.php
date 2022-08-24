<?php
if($_SESSION['cargo'] != 'USR'){
    header('Location: ../resources/views/controle-sla/controle-sla.php');
}else{
    header('Location: ../resources/views/documentacao/index_documentacao.php');
}
?>