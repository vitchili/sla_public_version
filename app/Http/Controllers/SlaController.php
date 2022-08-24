<?php 
class SlaController {
 public function __construct(){

 }
 public function getChamadosSLA($cargo){
    //Retorna todos chamados independente da prioridade
    require_once __DIR__ . '/../../Models/queries/GetChamadosSLA.php';
    $chamados = new GetChamadosSLA; 
    switch($cargo){
      case 'ADM': $whereVisibilidade = '';
      break;
      case 'DEV': $whereVisibilidade = "AND direcionamento = 'D'";
      break;
      case 'SUP': $whereVisibilidade = "AND direcionamento = 'S'";
      break;
      case 'ADM': $whereVisibilidade = "AND direcionamento = 'A'";
      break;
    }
    $listaChamados = $chamados->getTodosChamadosSLA($whereVisibilidade);
    return $listaChamados;
 }
 public function getChamadosNaoFinalizadosSLA(){
   //Retorna todos chamados independente da prioridade ou associacao
   require_once __DIR__ . '/../../Models/queries/GetChamadosSLA.php';
   $chamados = new GetChamadosSLA; 
   $listaChamados = $chamados->getTodosChamadosNaoFinalizadosSLA();
   return $listaChamados;
}
public function getChamadosEmAndamento(){
   //Retorna todos chamados EM ANDAMENTO independente da prioridade ou associacao
   require_once __DIR__ . '/../../Models/queries/GetChamadosSLA.php';
   $chamados = new GetChamadosSLA; 
   $listaChamados = $chamados->getChamadosEmAndamento();
   return $listaChamados;
}
 public function getQtChamadosSLA($cargo){
    //Retorna quantidade de chamados para cada prioridade
    require_once __DIR__ . '/../../Models/queries/GetChamadosSLA.php';
    $chamados = new GetChamadosSLA;
    switch($cargo){
      case 'ADM': $whereVisibilidade = '';
      break;
      case 'DEV': $whereVisibilidade = "AND direcionamento = 'D'";
      break;
      case 'SUP': $whereVisibilidade = "AND direcionamento = 'S'";
      break;
      case 'ADM': $whereVisibilidade = "AND direcionamento = 'A'";
      break;
      default: $whereVisibilidade = "";
    }
    $qt_chamados = $chamados->getQtChamadosSLA($whereVisibilidade);
    return $qt_chamados;
 }
 public function getQtDirecionamentoChamados(){
    //Retorna quantidade de chamados tiveram necessidade de propagacao e quantos sao erros de configuracao
    require_once __DIR__ . '/../../Models/queries/GetChamadosSLA.php';
    $chamados = new GetChamadosSLA; 
    $qt_chamados = $chamados->getQtDirecionamentoChamados();
    return $qt_chamados;
 }
 public function getChamadosAbertosFilaGeral(){
   //Retorna chamados mais recentes pra fila organizacional
   require_once __DIR__ . '/../../Models/queries/GetChamadosSLA.php';
   $chamados = new GetChamadosSLA; 
   $chamadosRecentes = $chamados->getChamadosAbertosFilaGeral();
   return $chamadosRecentes;
}
 public function getChamadosAssumidosSLA($nome_colaborador){
    //Retorna todos chamados associados ao usuario logado.
    require_once __DIR__ . '/../../Models/queries/GetChamadosSLA.php';
    $chamados = new GetChamadosSLA; 
    $listaChamados = $chamados->getChamadosAssumidosSLA($nome_colaborador);
    return $listaChamados;
 }
 public function getDadosChamadoPorId($idChamado){
   //Retorna todos chamados associados ao usuario logado.
   require_once __DIR__ . '/../../Models/queries/GetChamadosSLA.php';
   $chamados = new GetChamadosSLA; 
   $dados = $chamados->getDadosChamadoPorId($idChamado);
   return $dados;
}
 public function getChamadosConcluidosNPropagados(){
    //Retorna todos chamados concluidos nao propagados, independente do responsavel.
    require_once __DIR__ . '/../../Models/queries/GetChamadosSLA.php';
    $chamados = new GetChamadosSLA; 
    $listaChamados = $chamados->getChamadosConcNProp();
    return $listaChamados;
 }
 public function getChamadosAutorizadosNPropagados(){
   //Retorna todos chamados concluidos nao propagados, autorizados, independente do responsavel.
   require_once __DIR__ . '/../../Models/queries/GetChamadosSLA.php';
   $chamados = new GetChamadosSLA; 
   $listaChamados = $chamados->getChamadosAutNProp();
   return $listaChamados;
}
public function getFinalizadosSemProp(){
  //Retorna todos chamados concluidos nao propagados, autorizados, independente do responsavel.
  require_once __DIR__ . '/../../Models/queries/GetChamadosSLA.php';
  $chamados = new GetChamadosSLA; 
  $listaChamados = $chamados->getChamadosFinalizadosSProp();
  return $listaChamados;
}
public function getIdUsuarioLogado(){
   //Retorna id do usuario logado
   require_once __DIR__ . '/../../Models/queries/GetChamadosSLA.php';
   $user = new GetChamadosSLA; 
   $usuarioLogado = $user->getIdUserLogado();
   return $usuarioLogado;
}
public function getIdUsuarioGet($user){
   //Retorna id do usuario logado
   require_once __DIR__ . '/../../Models/queries/GetChamadosSLA.php';
   $userObj = new GetChamadosSLA;
   $usuarioLogado = $userObj->getIdUsuarioGet($user);
   
   return $usuarioLogado;
}
public function getIdUsuarioPeloNome($user){
   //Retorna id do usuario logado
   require_once __DIR__ . '/../../Models/queries/GetChamadosSLA.php';
   $userObj = new GetChamadosSLA;
   $usuario = $userObj->getIdUsuarioPeloNome($user);
   
   return $usuario;
}
public function getNomeFuncionarios(){
   //Retorna id do usuario logado
   require_once __DIR__ . '/../../Models/queries/GetChamadosSLA.php';
   $user = new GetChamadosSLA; 
   $listaUsuarios = $user->getNomeFuncionarios();
   return $listaUsuarios;
}

public function getChamadosPropagados(){ 
   //Retorna todos chamados concluidos propagados.
   require_once __DIR__ . '/../../Models/queries/GetChamadosSLA.php';
   $chamados = new GetChamadosSLA; 
   $listaChamados = $chamados->getChamadosPropagados();
   return $listaChamados;
}
public function getTodosChamadosPropagados(){
   require_once __DIR__ . '/../../Models/queries/GetChamadosSLA.php';
   $chamados = new GetChamadosSLA; 
   $listaChamados = $chamados->getTodosChamadosPropagados();
   return $listaChamados;
}
public function getChamadosRefatoracao(){
   require_once __DIR__ . '/../../Models/queries/GetChamadosSLA.php';
   $chamados = new GetChamadosSLA; 
   $listaChamados = $chamados->getChamadosRefatoracao();
   return $listaChamados;
}
public function getChamadosPendentes(){
   require_once __DIR__ . '/../../Models/queries/GetChamadosSLA.php';
   $chamados = new GetChamadosSLA; 
   $listaChamados = $chamados->getChamadosPendentes();
   return $listaChamados;
}
public function getChamadosOrcamentoImplantacao(){
   require_once __DIR__ . '/../../Models/queries/GetChamadosSLA.php';
   $chamados = new GetChamadosSLA; 
   $listaChamados = $chamados->getChamadosOrcamentoImplantacao();
   return $listaChamados;
}
public function getPrioridadesSLA(){
   //Retorna todos chamados concluidos propagados.
   require_once __DIR__ . '/../../Models/queries/GetChamadosSLA.php';
   $chamados = new GetChamadosSLA; 
   $listaPrioridades = $chamados->getPrioridades();
   return $listaPrioridades;
}
public function getPesoPrioridadesSLA($prioridade){
   //Retorna todos chamados concluidos propagados.
   require_once __DIR__ . '/../../Models/queries/GetChamadosSLA.php';
   $getprioridade = new GetChamadosSLA; 
   $pesoPrioridade = $getprioridade->getPesoPrioridadesSLA($prioridade);
   return $pesoPrioridade;
}
public function getPesoTelaSLA($tela){
   //Retorna todos chamados concluidos propagados.
   require_once __DIR__ . '/../../Models/queries/GetChamadosSLA.php';
   $gettela = new GetChamadosSLA; 
   $pesoTela = $gettela->getPesoTelaSLA($tela);
   return $pesoTela;
}
public function getPesoModuloSLA($modulo){
   //Retorna todos chamados concluidos propagados.
   require_once __DIR__ . '/../../Models/queries/GetChamadosSLA.php';
   $getmodulo = new GetChamadosSLA; 
   $pesoModulo = $getmodulo->getPesoModuloSLA($modulo);
   return $pesoModulo;
}
public function getNomeCliente(){
   //Retorna todos nomes de Clientes.
   require_once __DIR__ . '/../../Models/queries/GetChamadosSLA.php';
   $nomeCliente = new GetChamadosSLA; 
   $cliente = $nomeCliente->getCliente();
   return $cliente;
}
public function getNomeSolicitante(){
   //Retorna todos nomes de Clientes.
   require_once __DIR__ . '/../../Models/queries/GetChamadosSLA.php';
   $nomeSolicitante = new GetChamadosSLA; 
   $solicitante = $nomeSolicitante->getSolicitante();
   return $solicitante;
}
public function getTelas(){
   require_once __DIR__ . '/../../Models/queries/GetChamadosSLA.php';
   $nomeTelaSLA = new GetChamadosSLA; 
   $tela = $nomeTelaSLA->getTelas();
   return $tela;
}
public function getModuloSLA($produto){
   require_once __DIR__ . '/../../Models/queries/GetChamadosSLA.php';
   $nomeModuloSLA = new GetChamadosSLA; 
   $modulo = $nomeModuloSLA->getModuloSLA($produto);
   return $modulo;
}
public function getProdutoSLA(){
   require_once __DIR__ . '/../../Models/queries/GetChamadosSLA.php';
   $nomeProdutoSLA = new GetChamadosSLA; 
   $produto = $nomeProdutoSLA->getProduto();
   return $produto;
}
public function getSwitchCase($idChamado){
   require_once __DIR__ . '/../../Models/queries/GetChamadosSLA.php';
   $objSwitchCase = new GetChamadosSLA; 
   $switchcase = $objSwitchCase->getSwitchCase($idChamado);
   return $switchcase;
}
public function calculaQtChamados(){
   //Retorna um array com todos meses correntes, e a quantidade de chamados desses meses
   require_once __DIR__ . '/../../Models/queries/GetChamadosSLA.php';
   $qtChamados = new GetChamadosSLA; 
   $quantidade = $qtChamados->calculaChamados();

   $arrayMeses = [];
   for($i=1;$i<=12;$i++){
      $arrayMeses[$i] = 0;
   }
   for($i=0;$i<count($quantidade);$i++){
      $arrayMeses[$quantidade[$i]['mes']]++;
   }
   return $arrayMeses;
}
public function calculaQtChamadosPorTelaMes(){
   //Retorna um array com todos meses correntes e todas as telas, e a quantidade de chamados desses meses
   require_once __DIR__ . '/../../Models/queries/GetChamadosSLA.php';
   $qtChamados = new GetChamadosSLA; 
   $quantidade = $qtChamados->calculaQtChamadosPorTelaMes();
   return $quantidade;
}  
   public function calculaQtChamadosPorDev(){
      //Retorna um array com todos meses correntes, e a quantidade de chamados desses meses separados por dev
      require_once __DIR__ . '/../../Models/queries/GetChamadosSLA.php';
      $qtChamados = new GetChamadosSLA; 
      $quantidade = $qtChamados->calculaChamadosPorDev();
      $arrayMeses = [];
      for($i=1;$i<=12;$i++){
         $arrayMeses[$i] = array(
            'qtChamados' => 0
         );
      }
      for($i=0;$i<count($quantidade);$i++){
         $arrayMeses[$quantidade[$i]['mes']]['qtChamados']++;
         switch($quantidade[$i]['responsavel']){
            case '1':  $arrayMeses[$quantidade[$i]['mes']][1]++;
            break;
            case '2':  $arrayMeses[$quantidade[$i]['mes']][2]++;
            break;
            case '3':  $arrayMeses[$quantidade[$i]['mes']][3]++;
            break;
            case '4':  $arrayMeses[$quantidade[$i]['mes']][4]++;
            break;
            case '5':  $arrayMeses[$quantidade[$i]['mes']][5]++;
            break;
            case '6':  $arrayMeses[$quantidade[$i]['mes']][6]++;
            break;
            case '7':  $arrayMeses[$quantidade[$i]['mes']][7]++;
            break;
            case '8':  $arrayMeses[$quantidade[$i]['mes']][8]++;
            break;
            case '9':  $arrayMeses[$quantidade[$i]['mes']][9]++;
            break;
            case '10':  $arrayMeses[$quantidade[$i]['mes']][10]++;
            break;
            case '11':  $arrayMeses[$quantidade[$i]['mes']][11]++;
            break;
            case '12':  $arrayMeses[$quantidade[$i]['mes']][12]++;
            break;
            
         }
      }
      return $arrayMeses;
   }
   public function calculaQtChamadosEntreguesPorFuncionario(){
      //Retorna um array com todos meses correntes, e a quantidade de chamados desses meses separados por dev
      require_once __DIR__ . '/../../Models/queries/GetChamadosSLA.php';
      $qtChamados = new GetChamadosSLA; 
      $quantidade = $qtChamados->calculaQtChamadosEntreguesPorFuncionario();
      $arrayMeses = [];
      for($i=1;$i<=18;$i++){
         $arrayMeses[$i] = array(
            'qtChamados' => 0
         );
      }
      //for maximo eh a quantidade de funcionarios do banco
      for($i=0;$i<count($quantidade);$i++){
         $arrayMeses[$quantidade[$i]['mes']]['qtChamados']++;
         switch($quantidade[$i]['responsavel']){
            case '1':  $arrayMeses[$quantidade[$i]['mes']][1]++;
            break;
            case '2':  $arrayMeses[$quantidade[$i]['mes']][2]++;
            break;
            case '3':  $arrayMeses[$quantidade[$i]['mes']][3]++;
            break;
            case '4':  $arrayMeses[$quantidade[$i]['mes']][4]++;
            break;
            case '5':  $arrayMeses[$quantidade[$i]['mes']][5]++;
            break;
            case '6':  $arrayMeses[$quantidade[$i]['mes']][6]++;
            break;
            case '7':  $arrayMeses[$quantidade[$i]['mes']][7]++;
            break;
            case '8':  $arrayMeses[$quantidade[$i]['mes']][8]++;
            break;
            case '9':  $arrayMeses[$quantidade[$i]['mes']][9]++;
            break;
            case '10':  $arrayMeses[$quantidade[$i]['mes']][10]++;
            break;
            case '11':  $arrayMeses[$quantidade[$i]['mes']][11]++;
            break;
            case '12':  $arrayMeses[$quantidade[$i]['mes']][12]++;
            break;
            case '13':  $arrayMeses[$quantidade[$i]['mes']][13]++;
            break;
            case '14':  $arrayMeses[$quantidade[$i]['mes']][14]++;
            break;
            case '15':  $arrayMeses[$quantidade[$i]['mes']][15]++;
            break;
            case '16':  $arrayMeses[$quantidade[$i]['mes']][16]++;
            break;
            case '17':  $arrayMeses[$quantidade[$i]['mes']][17]++;
            break;
            case '18':  $arrayMeses[$quantidade[$i]['mes']][18]++;
            break;
            
         }
      }
      return $arrayMeses;
   }
   public function calculaQtChamadosPorCliente(){
      //Retorna um array com todos meses correntes, e a quantidade de chamados desses meses separados por cliente
      require_once __DIR__ . '/../../Models/queries/GetChamadosSLA.php';
      $qtChamados = new GetChamadosSLA; 
      $quantidade = $qtChamados->calculaQtChamadosPorCliente();
      
      $arrayMeses = [];
      for($i=1;$i<=12;$i++){
         $arrayMeses[$i] = array(
            'qtChamados' => 0
         );
      }
      //for maximo eh a quantidade de clientes do banco
      for($i=0;$i<count($quantidade);$i++){
         $arrayMeses[$quantidade[$i]['mes']]['qtChamados']++;
         switch($quantidade[$i]['cliente']){
            case '1':  $arrayMeses[$quantidade[$i]['mes']][1]++;
            break;
            case '2':  $arrayMeses[$quantidade[$i]['mes']][2]++;
            break;
            case '3':  $arrayMeses[$quantidade[$i]['mes']][3]++;
            break;
            case '4':  $arrayMeses[$quantidade[$i]['mes']][4]++;
            break;
            case '5':  $arrayMeses[$quantidade[$i]['mes']][5]++;
            break;
            case '6':  $arrayMeses[$quantidade[$i]['mes']][6]++;
            break;
            case '7':  $arrayMeses[$quantidade[$i]['mes']][7]++;
            break;
            case '8':  $arrayMeses[$quantidade[$i]['mes']][8]++;
            break;
            case '9':  $arrayMeses[$quantidade[$i]['mes']][9]++;
            break;
            case '10':  $arrayMeses[$quantidade[$i]['mes']][10]++;
            break;
            case '11':  $arrayMeses[$quantidade[$i]['mes']][11]++;
            break;
            case '12':  $arrayMeses[$quantidade[$i]['mes']][12]++;
            break;
            case '13':  $arrayMeses[$quantidade[$i]['mes']][13]++;
            break;
            case '14':  $arrayMeses[$quantidade[$i]['mes']][14]++;
            break;
            case '15':  $arrayMeses[$quantidade[$i]['mes']][15]++;
            break;
            case '16':  $arrayMeses[$quantidade[$i]['mes']][16]++;
            break;
            case '17':  $arrayMeses[$quantidade[$i]['mes']][17]++;
            break;
            case '18':  $arrayMeses[$quantidade[$i]['mes']][18]++;
            break;
            case '19':  $arrayMeses[$quantidade[$i]['mes']][19]++;
            break;
            case '20':  $arrayMeses[$quantidade[$i]['mes']][20]++;
            break;
            case '21':  $arrayMeses[$quantidade[$i]['mes']][21]++;
            break;
            case '22':  $arrayMeses[$quantidade[$i]['mes']][22]++;
            break;
            case '23':  $arrayMeses[$quantidade[$i]['mes']][23]++;
            break;
            case '24':  $arrayMeses[$quantidade[$i]['mes']][24]++;
            break;
            case '25':  $arrayMeses[$quantidade[$i]['mes']][25]++;
            break;
            case '26':  $arrayMeses[$quantidade[$i]['mes']][26]++;
            break;
            case '27':  $arrayMeses[$quantidade[$i]['mes']][27]++;
            break;
            case '28':  $arrayMeses[$quantidade[$i]['mes']][28]++;
            break;
            case '29':  $arrayMeses[$quantidade[$i]['mes']][29]++;
            break;
            case '30':  $arrayMeses[$quantidade[$i]['mes']][30]++;
            break;
            case '31':  $arrayMeses[$quantidade[$i]['mes']][31]++;
            break;
            case '32':  $arrayMeses[$quantidade[$i]['mes']][32]++;
            break;
            case '33':  $arrayMeses[$quantidade[$i]['mes']][33]++;
            break;
            case '34':  $arrayMeses[$quantidade[$i]['mes']][34]++;
            break;
            case '35':  $arrayMeses[$quantidade[$i]['mes']][35]++;
            break;
            
         }
      }
      return $arrayMeses;
   }
   
   public function atendimentosSuporte($user){
      require_once __DIR__ . '/../../Models/queries/GetChamadosSLA.php';
      $atendimentosSuporte = new GetChamadosSLA;
      $atendimentos = $atendimentosSuporte->getAtendimentosSuporte($user);
      return $atendimentos;
   }
   public function todosAtendimentosSuporte($userPesquisa, $data_inicial, $data_final){
      require_once __DIR__ . '/../../Models/queries/GetChamadosSLA.php';
      $atendimentosSuporte = new GetChamadosSLA;
      $atendimentos = $atendimentosSuporte->getTodosAtendimentosSuporte($userPesquisa, $data_inicial, $data_final);
      return $atendimentos;
   }
   public function getConversaChamado($idChamado){
      require_once __DIR__ . '/../../Models/queries/GetChamadosSLA.php';
      $conversa = new GetChamadosSLA;
      $mensagem = $conversa->getConversaChamado($idChamado);
      return $mensagem;
   }
   public function getConversaExternaChamado($idChamado){
      require_once __DIR__ . '/../../Models/queries/GetChamadosSLA.php';
      $conversa = new GetChamadosSLA;
      $mensagem = $conversa->getConversaExternaChamado($idChamado);
      return $mensagem;
   }
   public function getRegistrosDiarios($nome_usuario, $dia){
      require_once __DIR__ . '/../../Models/queries/SetNovoAtendimentoSuporte.php';
      $objRegistro = new SetNovoAtendimentoSuporte;
      $registros = $objRegistro->getConversaChamado($nome_usuario, $dia);
      return $registros;
   }
   public function getPromessasDiarias($nome_usuario, $dia){
      require_once __DIR__ . '/../../Models/queries/SetNovoAtendimentoSuporte.php';
      $objRegistro = new SetNovoAtendimentoSuporte;
      $registros = $objRegistro->getPromessasDiarias($nome_usuario, $dia);
      return $registros;
   }
   public function getChamadosDashboard($responsavel = '', $condicao = ''){
      require_once __DIR__ . '/../../Models/queries/GetChamadosSLA.php';
      $objDash = new GetChamadosSLA;
      $dash = $objDash->getChamadosDashboard($responsavel, $condicao);
      return $dash;
   }
   public function getChamadosEmEspera($usuario){
      require_once __DIR__ . '/../../Models/queries/GetChamadosSLA.php';
      $objEspera = new GetChamadosSLA;
      $espera = $objEspera->getChamadosEmEspera($usuario);
      return $espera;
   }
   public function getGrafico_interacao_SLA(){
      require_once __DIR__ . '/../../Models/queries/GetChamadosSLA.php';
      $obj = new GetChamadosSLA;
      $interative = $obj->getGrafico_interacao_SLA(); 
      return $interative;
   }
   
}
?>