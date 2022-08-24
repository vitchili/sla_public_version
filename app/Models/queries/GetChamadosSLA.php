<?php
date_default_timezone_set('America/Sao_Paulo');
class GetChamadosSLA{
    public function __construct(){

    }
    public function getTodosChamadosSLA($whereVisibilidade){
        require_once __DIR__ . '/../../../database/connection.php';
        $agora = date('Y-m-d H:i:s');
        $sql = "
        SELECT 	csla.id AS id_chamado, 
        client.cliente AS cliente, 
        ssla.nome As solicitante,
        csla.envolvidos AS envolvidos,
        csla.titulo AS titulo,
        csla.descricao AS descricao_chamado,  
        csla.data_entrega_estimada,
        prod.produto AS produto,
        modu.modulo AS modulo,
        tsla.nome AS tela,
        csla.direcionamento,
        psla.nome AS prioridade, 
        csla.prazo AS prazo, 
        csla.total_horas_orcamento,
        csla.valor_hora_orcamento,
        csla.desconto_orcamento,
        csla.total_preco_orcamento,
        csla.caminho_anexo,
        csla.caminho_anexo2,
        csla.cadastrado_em,
        DATE_ADD(csla.cadastrado_em, INTERVAL + csla.prazo HOUR) tempo_limite,
        IF(TIMESTAMPDIFF(MINUTE,'$agora',DATE_ADD(csla.cadastrado_em, INTERVAL + csla.prazo HOUR))<1,0,
        TIMESTAMPDIFF(MINUTE,'$agora',DATE_ADD(csla.cadastrado_em, INTERVAL + csla.prazo HOUR)))tempo_restante,
        colab.nome AS responsavel,
        csla.concluido_em,
        csla.status
        FROM tb_chamados_sla csla
        JOIN tb_cliente client ON csla.cliente = client.id
        JOIN tb_produto prod ON csla.produto = prod.id
        JOIN tb_solicitante_sla ssla ON csla.solicitante = ssla.id
        JOIN tb_tela_sla tsla ON tsla.id = csla.tela
        JOIN tb_modulo modu ON tsla.modulo = modu.id
        JOIN tb_prioridade_sla psla ON csla.prioridade = psla.id
	    LEFT JOIN tb_solicitante_sla colab ON csla.responsavel = colab.id        
        WHERE csla.concluido_em IS NULL
        AND colab.nome IS NULL
        AND csla.status = '1'
        {$whereVisibilidade}
        ORDER BY tempo_restante;
        ";
        $resultado = select($sql);
        return $resultado;
    }
    public function getChamadosAbertosFilaGeral(){
        require_once __DIR__ . '/../../../database/connection.php';
        $agora = date('Y-m-d H:i:s');
        $sql = "
        SELECT 	csla.id AS id_chamado, 
        tb_cliente.cliente AS cliente, 
        ssla.nome AS solicitante,
        csla.envolvidos AS envolvidos,
        csla.titulo AS titulo,
        csla.descricao AS descricao_chamado,  
        csla.data_entrega_estimada,
        prod.produto AS produto,
        modu.modulo AS modulo,
        tsla.nome AS tela,
        IF(csla.direcionamento = 'D', 'Desenvolvimento', 'Suporte') AS direcionamento,
        psla.nome AS prioridade, 
        csla.prazo AS prazo, 
        csla.total_horas_orcamento,
        csla.valor_hora_orcamento,
        csla.desconto_orcamento,
        csla.total_preco_orcamento,
        csla.caminho_anexo,
        csla.caminho_anexo2,
        csla.iniciado_em,
        csla.aprovado_reprovado,
        csla.cadastrado_em,
        csla.propagado,
        DATE_ADD(csla.cadastrado_em, INTERVAL + csla.prazo HOUR) tempo_limite,
        IF(TIMESTAMPDIFF(MINUTE,'$agora',DATE_ADD(csla.cadastrado_em, INTERVAL + csla.prazo HOUR))<1,0,
        TIMESTAMPDIFF(MINUTE,'$agora',DATE_ADD(csla.cadastrado_em, INTERVAL + csla.prazo HOUR)))tempo_restante,
        colab.nome AS responsavel,
        csla.concluido_em,
        csla.status
        FROM tb_chamados_sla csla
        JOIN tb_cliente ON csla.cliente = tb_cliente.id
        JOIN tb_produto prod ON csla.produto = prod.id
        JOIN tb_solicitante_sla ssla ON csla.solicitante = ssla.id
        JOIN tb_tela_sla tsla ON tsla.id = csla.tela
        JOIN tb_modulo modu ON tsla.modulo = modu.id
        JOIN tb_prioridade_sla psla ON csla.prioridade = psla.id
	    LEFT JOIN tb_solicitante_sla colab ON csla.responsavel = colab.id        
        WHERE csla.status = '1'
        AND csla.etapa_atual = '1'
        AND psla.contabiliza_como_bug = '1'
        ORDER BY csla.id DESC;
        ";
        $resultado = select($sql);
        return $resultado;
    }
    public function getTodosChamadosNaoFinalizadosSLA(){
        require_once __DIR__ . '/../../../database/connection.php';
        $agora = date('Y-m-d H:i:s');
        $sql = "
        SELECT 	csla.id AS id_chamado, 
        tb_cliente.cliente AS cliente, 
        ssla.nome As solicitante,
        csla.solicitante_externo,
        csla.envolvidos AS envolvidos,
        csla.titulo AS titulo,
        csla.descricao AS descricao_chamado,  
        csla.data_entrega_estimada,
        prod.produto AS produto,
        modu.modulo AS modulo,
        tsla.nome AS tela,
        csla.direcionamento,
        psla.nome AS prioridade, 
        csla.prazo AS prazo, 
        csla.total_horas_orcamento,
        csla.valor_hora_orcamento,
        csla.desconto_orcamento,
        csla.total_preco_orcamento,
        csla.caminho_anexo,
        csla.caminho_anexo2,
        csla.cadastrado_em,
        csla.iniciado_em,
        csla.em_pausa,
        csla.branch,
        csla.modificacao,
        DATE_ADD(csla.cadastrado_em, INTERVAL + csla.prazo HOUR) tempo_limite,
        IF(TIMESTAMPDIFF(MINUTE,'$agora',DATE_ADD(csla.cadastrado_em, INTERVAL + csla.prazo HOUR))<1,0,
        TIMESTAMPDIFF(MINUTE,'$agora',DATE_ADD(csla.cadastrado_em, INTERVAL + csla.prazo HOUR)))tempo_restante,
        TIMESTAMPDIFF(MINUTE,csla.iniciado_em,'$agora') AS cronometro_iniciado,
        colab.nome AS responsavel,
        csla.aprovado_reprovado,
        csla.concluido_em,
        csla.status
        FROM tb_chamados_sla csla
        JOIN tb_cliente ON csla.cliente = tb_cliente.id
        JOIN tb_produto prod ON csla.produto = prod.id
        JOIN tb_solicitante_sla ssla ON csla.solicitante = ssla.id
        JOIN tb_tela_sla tsla ON tsla.id = csla.tela
        JOIN tb_modulo modu ON tsla.modulo = modu.id
        JOIN tb_prioridade_sla psla ON csla.prioridade = psla.id
	    LEFT JOIN tb_solicitante_sla colab ON csla.responsavel = colab.id 
        WHERE csla.status = '1'
        AND chamado_em_espera = 'N'
        AND csla.responsavel IS NOT NULL
        AND csla.concluido_em IS NULL
        AND csla.chamado_cancelado = 'N'
        ORDER BY csla.id DESC;
        ";
        $resultado = select($sql);
        return $resultado;
    }
    public function getDadosChamadoPorId($idChamado){
        require_once __DIR__ . '/../../../database/connection.php';
        $agora = date('Y-m-d H:i:s');
        $sql = "
        SELECT 	csla.id AS id_chamado, 
        client.cliente AS cliente,
        client.id AS id_cliente,
        ssla.nome AS solicitante,
        csla.envolvidos AS envolvidos,
        ssla.id AS id_solicitante,
        csla.solicitante_externo AS solicitante_externo,
        csla.titulo AS titulo,
        csla.descricao AS descricao_chamado,  
        csla.data_entrega_estimada, 
        ea.nome_etapa,
        prod.produto AS produto,
        prod.id AS id_produto,
        modu.modulo AS modulo,
        modu.id AS id_modulo,
        tsla.nome AS tela,
        tsla.id AS id_tela,
        csla.direcionamento,
        psla.nome AS prioridade, 
        psla.id AS id_prioridade, 
        csla.prazo AS prazo, 
        csla.total_horas_orcamento,
        csla.valor_hora_orcamento,
        csla.desconto_orcamento,
        csla.total_preco_orcamento,
        csla.caminho_anexo,
        csla.caminho_anexo2,
        csla.cadastrado_em,
        DATE_ADD(csla.cadastrado_em, INTERVAL + csla.prazo HOUR) tempo_limite,
        IF(TIMESTAMPDIFF(MINUTE,'$agora',DATE_ADD(csla.cadastrado_em, INTERVAL + csla.prazo HOUR))<1,0,
        TIMESTAMPDIFF(MINUTE,'$agora',DATE_ADD(csla.cadastrado_em, INTERVAL + csla.prazo HOUR)))tempo_restante,
        colab.nome AS responsavel,
        colab.id AS id_responsavel,
        csla.concluido_em,
        csla.status
        FROM tb_chamados_sla csla
        JOIN tb_cliente client ON csla.cliente = client.id
        JOIN tb_produto prod ON csla.produto = prod.id
        JOIN tb_solicitante_sla ssla ON csla.solicitante = ssla.id
        JOIN tb_tela_sla tsla ON tsla.id = csla.tela
        JOIN tb_modulo modu ON tsla.modulo = modu.id
        JOIN tb_prioridade_sla psla ON csla.prioridade = psla.id
        JOIN tb_etapa_atual ea ON ea.id = csla.etapa_atual
	    LEFT JOIN tb_solicitante_sla colab ON csla.responsavel = colab.id        
        WHERE  csla.id = '$idChamado'
        AND csla.status = '1'
        ORDER BY tempo_restante; 
        ";
        $resultado = select($sql);
        return $resultado;
    }
    
    public function getChamadosEmAndamento(){
        require_once __DIR__ . '/../../../database/connection.php';
        $agora = date('Y-m-d H:i:s');
        $sql = "
        SELECT 	csla.id AS id_chamado, 
        tb_cliente.cliente AS cliente, 
        ssla.nome As solicitante,
        csla.envolvidos AS envolvidos,
        csla.titulo AS titulo,
        csla.descricao AS descricao_chamado,  
        csla.data_entrega_estimada,
        prod.produto AS produto,
        modu.modulo AS modulo,
        tsla.nome AS tela,
        csla.direcionamento,
        psla.nome AS prioridade, 
        csla.prazo AS prazo, 
        csla.total_horas_orcamento,
        csla.valor_hora_orcamento,
        csla.desconto_orcamento,
        csla.total_preco_orcamento,
        csla.caminho_anexo,
        csla.caminho_anexo2,
        csla.cadastrado_em,
        DATE_ADD(csla.cadastrado_em, INTERVAL + csla.prazo HOUR) tempo_limite,
        IF(TIMESTAMPDIFF(MINUTE,'$agora',DATE_ADD(csla.cadastrado_em, INTERVAL + csla.prazo HOUR))<1,0,
        TIMESTAMPDIFF(MINUTE,'$agora',DATE_ADD(csla.cadastrado_em, INTERVAL + csla.prazo HOUR)))tempo_restante,
        colab.nome AS responsavel,
        csla.concluido_em,
        csla.status
        FROM tb_chamados_sla csla
        JOIN tb_cliente ON csla.cliente = tb_cliente.id
        JOIN tb_produto prod ON csla.produto = prod.id
        JOIN tb_solicitante_sla ssla ON csla.solicitante = ssla.id
        JOIN tb_tela_sla tsla ON tsla.id = csla.tela
        JOIN tb_modulo modu ON tsla.modulo = modu.id
        JOIN tb_prioridade_sla psla ON csla.prioridade = psla.id
	    LEFT JOIN tb_solicitante_sla colab ON csla.responsavel = colab.id   
        WHERE csla.status = '1'
        AND csla.etapa_atual IN (2,3,4,5,6,9)
        AND psla.contabiliza_como_bug = '1'
        ORDER BY tempo_restante;
        ";
        $resultado = select($sql);
        return $resultado;
    }
    public function getChamadosConcNProp(){
        require_once __DIR__ . '/../../../database/connection.php';
        $agora = date('Y-m-d H:i:s');
        $sql = "
        SELECT 	csla.id AS id_chamado, 
        tb_cliente.cliente AS cliente, 
        ssla.nome As solicitante,
        csla.envolvidos AS envolvidos,
        csla.titulo AS titulo,
        csla.descricao AS descricao_chamado,  
        csla.data_entrega_estimada,
        prod.produto AS produto,
        modu.modulo AS modulo,
        tsla.nome AS tela,
        csla.direcionamento,
        psla.nome AS prioridade, 
        csla.prazo AS prazo, 
        csla.total_horas_orcamento,
        csla.valor_hora_orcamento,
        csla.desconto_orcamento,
        csla.total_preco_orcamento,
        csla.caminho_anexo,
        csla.caminho_anexo2,
        csla.cadastrado_em,
        csla.iniciado_em,
        csla.branch,
        csla.modificacao,
        csla.propagado,
        csla.iniciada_correcao_em,
        csla.teste_em_pausa,
        csla.aprovacao_tester,
        DATE_ADD(csla.cadastrado_em, INTERVAL + csla.prazo HOUR) tempo_limite,
        IF(TIMESTAMPDIFF(MINUTE,'$agora',DATE_ADD(csla.cadastrado_em, INTERVAL + csla.prazo HOUR))<1,0,
        TIMESTAMPDIFF(MINUTE,'$agora',DATE_ADD(csla.cadastrado_em, INTERVAL + csla.prazo HOUR)))tempo_restante,
        colab.nome AS responsavel,
        csla.concluido_em,
        csla.status
        FROM tb_chamados_sla csla
        JOIN tb_cliente ON csla.cliente = tb_cliente.id
        JOIN tb_produto prod ON csla.produto = prod.id
        JOIN tb_solicitante_sla ssla ON csla.solicitante = ssla.id
        JOIN tb_tela_sla tsla ON tsla.id = csla.tela
        JOIN tb_modulo modu ON tsla.modulo = modu.id
        JOIN tb_prioridade_sla psla ON csla.prioridade = psla.id
	    LEFT JOIN tb_solicitante_sla colab ON csla.responsavel = colab.id        
        WHERE csla.etapa_atual = '7'
        AND csla.status = '1'
        ORDER BY tempo_restante;
        ";
        $resultado = select($sql);
        return $resultado;
    }
    public function getChamadosAutNProp(){
        require_once __DIR__ . '/../../../database/connection.php';
        $agora = date('Y-m-d H:i:s');
        $sql = "
        SELECT 	csla.id AS id_chamado, 
        client.cliente AS cliente, 
        ssla.nome As solicitante,
        csla.envolvidos AS envolvidos,
        csla.titulo AS titulo,
        csla.descricao AS descricao_chamado,  
        csla.data_entrega_estimada,
        prod.produto AS produto,
        modu.modulo AS modulo,
        tsla.nome AS tela,
        csla.direcionamento,
        psla.nome AS prioridade, 
        csla.prazo AS prazo, 
        csla.total_horas_orcamento,
        csla.valor_hora_orcamento,
        csla.desconto_orcamento,
        csla.total_preco_orcamento,
        csla.caminho_anexo,
        csla.caminho_anexo2,
        csla.cadastrado_em,
        csla.iniciado_em,
        csla.branch,
        csla.modificacao,
        csla.propagado,
        csla.aprovacao_tester,
        DATE_ADD(csla.cadastrado_em, INTERVAL + csla.prazo HOUR) tempo_limite,
        IF(TIMESTAMPDIFF(MINUTE,'$agora',DATE_ADD(csla.cadastrado_em, INTERVAL + csla.prazo HOUR))<1,0,
        TIMESTAMPDIFF(MINUTE,'$agora',DATE_ADD(csla.cadastrado_em, INTERVAL + csla.prazo HOUR)))tempo_restante,
        colab.nome AS responsavel,
        csla.concluido_em,
        csla.status
        FROM tb_chamados_sla csla
        JOIN tb_cliente client ON csla.cliente = client.id
        JOIN tb_produto prod ON csla.produto = prod.id
        JOIN tb_solicitante_sla ssla ON csla.solicitante = ssla.id
        JOIN tb_tela_sla tsla ON tsla.id = csla.tela
        JOIN tb_modulo modu ON tsla.modulo = modu.id
        JOIN tb_prioridade_sla psla ON csla.prioridade = psla.id
	    LEFT JOIN tb_solicitante_sla colab ON csla.responsavel = colab.id     
        WHERE csla.etapa_atual = 10
        AND csla.status = '1'
        ORDER BY tempo_restante;
        ";
        $resultado = select($sql);
        return $resultado;
    }
    public function getIdUserLogado(){
        $userLogado = $_SESSION['nome_usuario'];
        require_once __DIR__ . '/../../../database/connection.php';
        $sql = "SELECT * FROM tb_solicitante_sla WHERE nome = '$userLogado'";
        $resultado = select($sql);
        return $resultado;
    }
    public function getIdUsuarioGet($user){
        require_once __DIR__ . '/../../../database/connection.php';
        $sql = "SELECT * FROM tb_solicitante_sla WHERE id = '$user'";
        $resultado = select($sql);
        return $resultado;
    }
    public function getIdUsuarioPeloNome($user){
        require_once __DIR__ . '/../../../database/connection.php';
        $sql = "SELECT * FROM tb_solicitante_sla WHERE nome = '$user'";
        $resultado = select($sql);
        return $resultado;
    }
    public function getChamadosPropagados(){
        require_once __DIR__ . '/../../../database/connection.php';
        $agora = date('Y-m-d H:i:s');
        $sql = "
        SELECT 	csla.id AS id_chamado, 
        client.cliente AS cliente, 
        ssla.nome As solicitante,
        csla.envolvidos AS envolvidos,
        csla.titulo AS titulo,
        csla.descricao AS descricao_chamado,  
        csla.data_entrega_estimada,
        prod.produto AS produto,
        modu.modulo AS modulo,
        tsla.nome AS tela,
        csla.direcionamento,
        psla.nome AS prioridade, 
        csla.prazo AS prazo, 
        csla.total_horas_orcamento,
        csla.valor_hora_orcamento,
        csla.desconto_orcamento,
        csla.total_preco_orcamento,
        csla.caminho_anexo,
        csla.caminho_anexo2,
        csla.cadastrado_em,
        csla.iniciado_em,
        csla.branch,
        csla.modificacao,
        csla.propagado,
        csla.aprovacao_tester,
        DATE_ADD(csla.cadastrado_em, INTERVAL + csla.prazo HOUR) tempo_limite,
        IF(TIMESTAMPDIFF(MINUTE,'$agora',DATE_ADD(csla.cadastrado_em, INTERVAL + csla.prazo HOUR))<1,0,
        TIMESTAMPDIFF(MINUTE,'$agora',DATE_ADD(csla.cadastrado_em, INTERVAL + csla.prazo HOUR)))tempo_restante,
        colab.nome AS responsavel,
        csla.concluido_em,
        csla.status
        FROM tb_chamados_sla csla
        JOIN tb_cliente client ON csla.cliente = client.id
        JOIN tb_produto prod ON csla.produto = prod.id
        JOIN tb_solicitante_sla ssla ON csla.solicitante = ssla.id
        JOIN tb_tela_sla tsla ON tsla.id = csla.tela
        JOIN tb_modulo modu ON tsla.modulo = modu.id
        JOIN tb_prioridade_sla psla ON csla.prioridade = psla.id
	    LEFT JOIN tb_solicitante_sla colab ON csla.responsavel = colab.id 
        WHERE etapa_atual = 11
        AND csla.status = 1
        ORDER BY csla.concluido_em;
        ";
        $resultado = select($sql);
        return $resultado;
    }
    public function getChamadosFinalizadosSProp(){
        require_once __DIR__ . '/../../../database/connection.php';
        $agora = date('Y-m-d H:i:s');
        $sql = "
        SELECT 	csla.id AS id_chamado, 
        client.cliente AS cliente, 
        ssla.nome As solicitante,
        csla.envolvidos AS envolvidos,
        csla.titulo AS titulo,
        csla.descricao AS descricao_chamado,  
        csla.data_entrega_estimada,
        prod.produto AS produto,
        modu.modulo AS modulo,
        tsla.nome AS tela,
        csla.direcionamento,
        psla.nome AS prioridade, 
        csla.prazo AS prazo, 
        csla.total_horas_orcamento,
        csla.valor_hora_orcamento,
        csla.desconto_orcamento,
        csla.total_preco_orcamento,
        csla.caminho_anexo,
        csla.caminho_anexo2,
        csla.cadastrado_em,
        csla.iniciado_em,
        csla.branch,
        csla.modificacao,
        csla.propagado,
        csla.aprovacao_tester,
        DATE_ADD(csla.cadastrado_em, INTERVAL + csla.prazo HOUR) tempo_limite,
        IF(TIMESTAMPDIFF(MINUTE,'$agora',DATE_ADD(csla.cadastrado_em, INTERVAL + csla.prazo HOUR))<1,0,
        TIMESTAMPDIFF(MINUTE,'$agora',DATE_ADD(csla.cadastrado_em, INTERVAL + csla.prazo HOUR)))tempo_restante,
        colab.nome AS responsavel,
        csla.concluido_em,
        csla.status
        FROM tb_chamados_sla csla
        JOIN tb_cliente client ON csla.cliente = client.id
        JOIN tb_produto prod ON csla.produto = prod.id
        JOIN tb_solicitante_sla ssla ON csla.solicitante = ssla.id
        JOIN tb_tela_sla tsla ON tsla.id = csla.tela
        JOIN tb_modulo modu ON tsla.modulo = modu.id
        JOIN tb_prioridade_sla psla ON csla.prioridade = psla.id
	    LEFT JOIN tb_solicitante_sla colab ON csla.responsavel = colab.id      
        WHERE csla.etapa_atual = '12'
        AND csla.status = '1'
        ORDER BY csla.concluido_em;
        ";
        $resultado = select($sql);
        return $resultado;
    }
    function getTodosChamadosPropagados(){
        require_once __DIR__ . '/../../../database/connection.php';
        $agora = date('Y-m-d H:i:s');
        $sql = "
        SELECT csla.id AS id_chamado, 
        tb_cliente.cliente AS cliente, 
        ssla.nome As solicitante,
        csla.envolvidos AS envolvidos,
        csla.titulo AS titulo,
        csla.descricao AS descricao_chamado,  
        csla.data_entrega_estimada,
        prod.produto AS produto,
        modu.modulo AS modulo,
        tsla.nome AS tela,
        csla.direcionamento,
        psla.nome AS prioridade, 
        csla.prazo AS prazo, 
        csla.total_horas_orcamento,
        csla.valor_hora_orcamento,
        csla.desconto_orcamento,
        csla.total_preco_orcamento,
        csla.caminho_anexo,
        csla.caminho_anexo2,
        csla.cadastrado_em,
        csla.iniciado_em,
        csla.branch,
        csla.modificacao,
        csla.propagado,
        csla.aprovacao_tester,
        DATE_ADD(csla.cadastrado_em, INTERVAL + csla.prazo HOUR) tempo_limite,
        IF(TIMESTAMPDIFF(MINUTE,'$agora',DATE_ADD(csla.cadastrado_em, INTERVAL + csla.prazo HOUR))<1,0,
        TIMESTAMPDIFF(MINUTE,'$agora',DATE_ADD(csla.cadastrado_em, INTERVAL + csla.prazo HOUR)))tempo_restante,
        colab.nome AS responsavel,
        csla.concluido_em,
        csla.status
        FROM tb_chamados_sla csla
        JOIN tb_cliente ON csla.cliente = tb_cliente.id
        JOIN tb_produto prod ON csla.produto = prod.id
        JOIN tb_solicitante_sla ssla ON csla.solicitante = ssla.id
        JOIN tb_tela_sla tsla ON tsla.id = csla.tela
        JOIN tb_modulo modu ON tsla.modulo = modu.id
        JOIN tb_prioridade_sla psla ON csla.prioridade = psla.id
	    LEFT JOIN tb_solicitante_sla colab ON csla.responsavel = colab.id       
        WHERE csla.etapa_atual IN (8,10,11,12,13)
        AND csla.status = 1
        ORDER BY csla.concluido_em
        ";
        $resultado = select($sql);
        return $resultado;
    }
    function getChamadosRefatoracao(){
        require_once __DIR__ . '/../../../database/connection.php';
        $agora = date('Y-m-d H:i:s');
        $sql = "
        SELECT csla.id AS id_chamado, 
        tb_cliente.cliente AS cliente, 
        ssla.nome As solicitante,
        csla.envolvidos AS envolvidos,
        csla.titulo AS titulo,
        csla.descricao AS descricao_chamado,  
        csla.data_entrega_estimada,
        prod.produto AS produto,
        modu.modulo AS modulo,
        tsla.nome AS tela,
        csla.direcionamento,
        psla.nome AS prioridade, 
        csla.prazo AS prazo, 
        csla.total_horas_orcamento,
        csla.valor_hora_orcamento,
        csla.desconto_orcamento,
        csla.total_preco_orcamento,
        csla.caminho_anexo,
        csla.caminho_anexo2,
        csla.cadastrado_em,
        csla.iniciado_em,
        csla.branch,
        csla.modificacao,
        csla.propagado,
        csla.aprovacao_tester,
        DATE_ADD(csla.cadastrado_em, INTERVAL + csla.prazo HOUR) tempo_limite,
        IF(TIMESTAMPDIFF(MINUTE,'$agora',DATE_ADD(csla.cadastrado_em, INTERVAL + csla.prazo HOUR))<1,0,
        TIMESTAMPDIFF(MINUTE,'$agora',DATE_ADD(csla.cadastrado_em, INTERVAL + csla.prazo HOUR)))tempo_restante,
        colab.nome AS responsavel,
        csla.concluido_em,
        csla.status
        FROM tb_chamados_sla csla
        JOIN tb_cliente ON csla.cliente = tb_cliente.id
        JOIN tb_produto prod ON csla.produto = prod.id
        JOIN tb_solicitante_sla ssla ON csla.solicitante = ssla.id
        JOIN tb_tela_sla tsla ON tsla.id = csla.tela
        JOIN tb_modulo modu ON tsla.modulo = modu.id
        JOIN tb_prioridade_sla psla ON csla.prioridade = psla.id
	    LEFT JOIN tb_solicitante_sla colab ON csla.responsavel = colab.id       
        WHERE csla.prioridade = '10'
        AND csla.etapa_atual IN (2,3,4,6,9)
        AND csla.status = 1
        ORDER BY csla.concluido_em
        ";
        $resultado = select($sql);
        return $resultado;
    }

    function getChamadosPendentes(){
        require_once __DIR__ . '/../../../database/connection.php';
        $agora = date('Y-m-d H:i:s');
        $sql = "
        SELECT csla.id AS id_chamado, 
        tb_cliente.cliente AS cliente, 
        ssla.nome As solicitante,
        csla.envolvidos AS envolvidos,
        csla.titulo AS titulo,
        csla.descricao AS descricao_chamado,  
        csla.data_entrega_estimada,
        prod.produto AS produto,
        modu.modulo AS modulo,
        tsla.nome AS tela,
        csla.direcionamento,
        psla.nome AS prioridade, 
        csla.prazo AS prazo, 
        csla.total_horas_orcamento,
        csla.valor_hora_orcamento,
        csla.desconto_orcamento,
        csla.total_preco_orcamento,
        csla.caminho_anexo,
        csla.caminho_anexo2,
        csla.cadastrado_em,
        csla.iniciado_em,
        csla.branch,
        csla.modificacao,
        csla.propagado,
        csla.aprovacao_tester,
        DATE_ADD(csla.cadastrado_em, INTERVAL + csla.prazo HOUR) tempo_limite,
        IF(TIMESTAMPDIFF(MINUTE,'$agora',DATE_ADD(csla.cadastrado_em, INTERVAL + csla.prazo HOUR))<1,0,
        TIMESTAMPDIFF(MINUTE,'$agora',DATE_ADD(csla.cadastrado_em, INTERVAL + csla.prazo HOUR)))tempo_restante,
        colab.nome AS responsavel,
        csla.concluido_em,
        csla.status
        FROM tb_chamados_sla csla
        JOIN tb_cliente ON csla.cliente = tb_cliente.id
        JOIN tb_produto prod ON csla.produto = prod.id
        JOIN tb_solicitante_sla ssla ON csla.solicitante = ssla.id
        JOIN tb_tela_sla tsla ON tsla.id = csla.tela
        JOIN tb_modulo modu ON tsla.modulo = modu.id
        JOIN tb_prioridade_sla psla ON csla.prioridade = psla.id
	    LEFT JOIN tb_solicitante_sla colab ON csla.responsavel = colab.id       
        WHERE csla.prioridade = '6'
        AND csla.etapa_atual = '1'
        AND csla.status = 1
        ORDER BY csla.concluido_em
        ";
        $resultado = select($sql);
        return $resultado;
    }
    function getChamadosOrcamentoImplantacao(){
        require_once __DIR__ . '/../../../database/connection.php';
        $agora = date('Y-m-d H:i:s');
        $sql = "
        SELECT csla.id AS id_chamado, 
        tb_cliente.cliente AS cliente, 
        ssla.nome As solicitante,
        csla.envolvidos AS envolvidos,
        csla.titulo AS titulo,
        csla.descricao AS descricao_chamado,  
        csla.data_entrega_estimada,
        prod.produto AS produto,
        modu.modulo AS modulo,
        tsla.nome AS tela,
        csla.direcionamento,
        psla.nome AS prioridade, 
        csla.prazo AS prazo, 
        csla.total_horas_orcamento,
        csla.valor_hora_orcamento,
        csla.desconto_orcamento,
        csla.total_preco_orcamento,
        csla.caminho_anexo,
        csla.caminho_anexo2,
        csla.cadastrado_em,
        csla.iniciado_em,
        csla.branch,
        csla.modificacao,
        csla.propagado,
        csla.aprovacao_tester,
        DATE_ADD(csla.cadastrado_em, INTERVAL + csla.prazo HOUR) tempo_limite,
        IF(TIMESTAMPDIFF(MINUTE,'$agora',DATE_ADD(csla.cadastrado_em, INTERVAL + csla.prazo HOUR))<1,0,
        TIMESTAMPDIFF(MINUTE,'$agora',DATE_ADD(csla.cadastrado_em, INTERVAL + csla.prazo HOUR)))tempo_restante,
        colab.nome AS responsavel,
        csla.concluido_em,
        csla.status
        FROM tb_chamados_sla csla
        JOIN tb_cliente ON csla.cliente = tb_cliente.id
        JOIN tb_produto prod ON csla.produto = prod.id
        JOIN tb_solicitante_sla ssla ON csla.solicitante = ssla.id
        JOIN tb_tela_sla tsla ON tsla.id = csla.tela
        JOIN tb_modulo modu ON tsla.modulo = modu.id
        JOIN tb_prioridade_sla psla ON csla.prioridade = psla.id
	    LEFT JOIN tb_solicitante_sla colab ON csla.responsavel = colab.id       
        WHERE csla.prioridade = '5'
        AND csla.etapa_atual NOT IN (11,12,13)
        AND csla.status = 1
        ORDER BY csla.concluido_em
        ";
        $resultado = select($sql);
        return $resultado;
    }
    
    public function getChamadosAssumidosSLA($nome_colaborador){
        require_once __DIR__ . '/../../../database/connection.php';
        $agora = date('Y-m-d H:i:s');
        $sql = "
        SELECT 	csla.id AS id_chamado, 
        client.cliente AS cliente, 
        ssla.nome As solicitante,
        csla.solicitante_externo,
        csla.envolvidos AS envolvidos,
        csla.titulo AS titulo,
        csla.descricao AS descricao_chamado,  
        csla.data_entrega_estimada,
        prod.produto AS produto,
        modu.modulo AS modulo,
        tsla.nome AS tela,
        csla.direcionamento,
        psla.nome AS prioridade, 
        csla.prazo AS prazo, 
        csla.total_horas_orcamento,
        csla.valor_hora_orcamento,
        csla.desconto_orcamento,
        csla.total_preco_orcamento,
        csla.caminho_anexo,
        csla.em_pausa,
        csla.iniciado_em,
        csla.branch,
        csla.caminho_anexo2,
        csla.cadastrado_em,
        csla.modificacao,
        csla.propagado,
        csla.aprovacao_tester,
        csla.aprovado_reprovado,
        DATE_ADD(csla.cadastrado_em, INTERVAL + csla.prazo HOUR) tempo_limite,
        IF(TIMESTAMPDIFF(MINUTE,'$agora',DATE_ADD(csla.cadastrado_em, INTERVAL + csla.prazo HOUR))<1,0,
        TIMESTAMPDIFF(MINUTE,'$agora',DATE_ADD(csla.cadastrado_em, INTERVAL + csla.prazo HOUR)))tempo_restante,
        TIMESTAMPDIFF(MINUTE,csla.iniciado_em,'$agora') AS cronometro_iniciado, 
        colab.nome AS responsavel,
        csla.concluido_em,
        csla.status
        FROM tb_chamados_sla csla
        JOIN tb_cliente client ON csla.cliente = client.id
        JOIN tb_produto prod ON csla.produto = prod.id
        JOIN tb_solicitante_sla ssla ON csla.solicitante = ssla.id
        JOIN tb_tela_sla tsla ON tsla.id = csla.tela
        JOIN tb_modulo modu ON tsla.modulo = modu.id
        JOIN tb_prioridade_sla psla ON csla.prioridade = psla.id
	    LEFT JOIN tb_solicitante_sla colab ON csla.responsavel = colab.id 
        WHERE csla.concluido_em IS NULL
        AND colab.nome = '$nome_colaborador'
        AND chamado_em_espera = 'N'
        AND csla.status = '1'
        ORDER BY tempo_restante;
        ";
        $resultado = select($sql);
        return $resultado;
    }
    public function getQtDirecionamentoChamados(){
        require_once __DIR__ . '/../../../database/connection.php';
        $sql = "
        SELECT COUNT(*) AS count_chamados FROM tb_chamados_sla WHERE direcionamento = 'D' AND STATUS = '1' UNION
        SELECT COUNT(*) FROM tb_chamados_sla WHERE direcionamento = 'S' AND STATUS = '1';
        ";
        $resultado = select($sql);
        return $resultado;
    }
    public function getConversaChamado($idChamado){
        require_once __DIR__ . '/../../../database/connection.php';
        $sql = "
        SELECT cc.id, ssla.nome AS autor, cc.mensagem FROM tb_conversas_chamados cc
        JOIN tb_solicitante_sla ssla ON ssla.id = cc.autor
        WHERE id_chamado = $idChamado;
        "; 
        $resultado = select($sql);
        return $resultado;
    }
    public function getConversaExternaChamado($idChamado){
        require_once __DIR__ . '/../../../database/connection.php';
        $sql = "
        SELECT cc.id, cc.autor, cc.mensagem, cc.cadastrado_em FROM tb_conversas_externas_chamados cc
        WHERE id_chamado = $idChamado;
        ";
        $resultado = select($sql);
        return $resultado;
    }
    public function getTempoRestanteChamados(){
        require_once __DIR__ . '/../../../database/connection.php';
        $agora = date('Y-m-d H:i:s');
        $sql = "
        SELECT id as id_chamado, 
        DATE_ADD(cadastrado_em, INTERVAL + prazo HOUR) tempo_limite,
        IF(TIMESTAMPDIFF(MINUTE,'$agora',DATE_ADD(cadastrado_em, INTERVAL + prazo HOUR))<1,0,
        TIMESTAMPDIFF(MINUTE,'$agora',DATE_ADD(cadastrado_em, INTERVAL + prazo HOUR)))tempo_restante
        FROM tb_chamados_sla
        WHERE concluido_em IS NULL
        AND propagacao_solicitada = 'N';
        ";
        $resultado = select($sql);
        return $resultado;
    }
    public function getPrioridades(){
        require_once __DIR__ . '/../../../database/connection.php';
        $sql = "
        SELECT id, nome, nivel, peso FROM tb_prioridade_sla psla;";
        $resultado = select($sql);
        return $resultado;
    }
    public function getPesoPrioridadesSLA($prioridade){
        require_once __DIR__ . '/../../../database/connection.php';
        $sql = "
        SELECT id, nome, peso FROM tb_prioridade_sla psla WHERE id = '$prioridade';";
        $resultado = select($sql);
        return $resultado;
    }
    public function getPesoTelaSLA($tela){
        require_once __DIR__ . '/../../../database/connection.php';
        $sql = "
        SELECT id, nome, peso FROM tb_tela_sla tsla WHERE id = '$tela';";
        $resultado = select($sql);
        return $resultado;
    }
    public function getPesoModuloSLA($modulo){
        require_once __DIR__ . '/../../../database/connection.php';
        $sql = "
        SELECT id, modulo, peso FROM tb_modulo msla WHERE id = '$modulo';";
        $resultado = select($sql);
        return $resultado;
    }
    public function getCliente(){
        require_once __DIR__ . '/../../../database/connection.php';
        $sql = "
        SELECT id, cliente, banco_de_dados FROM tb_cliente ORDER BY cliente;";
        $resultado = select($sql);
        return $resultado;
    }
    public function getClienteByNameSLA($cliente){
        require_once __DIR__ . '/../../../database/connection.php';
        $sql = "
        SELECT id, cliente, banco_de_dados FROM tb_cliente WHERE cliente = '$cliente' ORDER BY cliente;";
        $resultado = select($sql);
        return $resultado;
    }
    public function getNomeEmpresaByBanco($empresa){
        require_once __DIR__ . '/../../../database/connection.php';
        $sql = "
        SELECT id, cliente FROM tb_cliente WHERE banco_de_dados = ('$empresa');";
        $resultado = select($sql);
        return $resultado;
    }
    
    public function getNomeFuncionarios(){
        require_once __DIR__ . '/../../../database/connection.php';
        $sql = "
        SELECT id, nome FROM tb_solicitante_sla WHERE status = '1' ORDER BY nome;";
        $resultado = select($sql);
        return $resultado;
    }
    public function getSolicitante(){
        require_once __DIR__ . '/../../../database/connection.php';
        $sql = "
        SELECT id, nome FROM tb_solicitante_sla ORDER BY nome;";
        $resultado = select($sql);
        return $resultado;
    }
    public function getQtChamadosSLA($whereVisibilidade){
        require_once __DIR__ . '/../../../database/connection.php';
        $sql = "
        SELECT nome FROM tb_prioridade_sla WHERE status = '1';";
        $resultado = select($sql);
        
        for($i=1;$i<=count($resultado); $i++){
            $subsql .= "(SELECT COUNT(id) AS count FROM tb_chamados_sla WHERE prioridade=".$i." AND STATUS = '1' AND responsavel IS NULL AND concluido_em IS NULL {$whereVisibilidade}) '".$resultado[$i-1]['nome']."' ,";
        }
        $subsql = rtrim($subsql, ',');
        $sql = "
        SELECT ".$subsql.";
        ";
        $resultado = select($sql);
        return $resultado;
    }
    public function getModuloSLA($produto){
        require_once __DIR__ . '/../../../database/connection.php';
        $sql = "
        SELECT id, modulo FROM tb_modulo WHERE status = '1' AND produto = '$produto';";
        $resultado = select($sql);
        return $resultado;
    }
    public function getModuloByNameSLA($produto, $modulo){
        require_once __DIR__ . '/../../../database/connection.php';
        $sql = "
        SELECT id, modulo FROM tb_modulo WHERE status = '1' AND produto = '$produto' AND modulo = '$modulo';";
        $resultado = select($sql);
        return $resultado;
    }
    public function getProduto(){
        require_once __DIR__ . '/../../../database/connection.php';
        $sql = "
        SELECT id, produto FROM tb_produto WHERE status = '1' ORDER BY produto;";
        $resultado = select($sql);
        return $resultado;
    }
    public function getProdutoByName($produto){
        require_once __DIR__ . '/../../../database/connection.php';
        $sql = "
        SELECT id, produto FROM tb_produto WHERE status = '1' AND produto LIKE ('%$produto%') ORDER BY produto;";
        $resultado = select($sql);
        return $resultado;
    }
    public function getTelaSLA($modulo){
        require_once __DIR__ . '/../../../database/connection.php';
        $sql = "
        SELECT id, nome FROM tb_tela_sla WHERE modulo LIKE ('%$modulo%') AND status = '1' ORDER BY nome;";
        $resultado = select($sql);
        return $resultado;
    }
    public function getTelaByNameSLA($modulo, $tela){
        require_once __DIR__ . '/../../../database/connection.php';
        $sql = "
        SELECT id, nome FROM tb_tela_sla WHERE modulo = '$modulo' AND nome LIKE ('%$tela%') AND status = '1' ORDER BY nome;";
        $resultado = select($sql);
        return $resultado;
    }
    public function getEmailsEnvolvidosSLA($cliente){
        require_once __DIR__ . '/../../../database/connection.php';
        $sql = "
        SELECT id, nome, email FROM tb_contato_cliente WHERE id_cliente = '$cliente' AND status = '1' ORDER BY email;";
        $resultado = select($sql);
        return $resultado;
    }
    public function getTelas(){
        require_once __DIR__ . '/../../../database/connection.php';
        $sql = "
        SELECT id, nome FROM tb_tela_sla WHERE status = '1' ORDER BY nome;";
        $resultado = select($sql);
        return $resultado;
    }
    public function getSwitchCase($idChamado){
        require_once __DIR__ . '/../../../database/connection.php';
        $sql = "
        SELECT id, id_chamado, caminho, descricao, esperado, ocorrido, base FROM tb_chamado_switch_case WHERE id_chamado = '$idChamado' AND status = '1';";
        $resultado = select($sql);
        return $resultado;
    }
    public function calculaChamados(){
        require_once __DIR__ . '/../../../database/connection.php';
        $sql = "
        SELECT MONTH(cadastrado_em) mes FROM tb_chamados_sla WHERE YEAR(cadastrado_em) = YEAR(CURDATE()) AND status = '1' ORDER BY cadastrado_em ASC;
        ";
        $resultado = select($sql);
        return $resultado;
    }
    public function calculaQtChamadosPorTelaMes(){
        require_once __DIR__ . '/../../../database/connection.php';
        $agora = date('Y-m-d H:i:s');
        $sql = "
        SELECT DISTINCT msla.modulo, COUNT(tela) AS contador, MONTH(csla.cadastrado_em) mes FROM tb_modulo msla
        LEFT JOIN tb_chamados_sla csla ON csla.modulo = msla.id
        WHERE MONTH(csla.cadastrado_em) = MONTH('$agora')
        AND msla.modulo != 'Outro'
        AND msla.modulo != 'Outros'
        GROUP BY msla.id, msla.modulo, mes;
        ;
        ";
        $resultado = select($sql);
        return $resultado;
    }
    public function calculaChamadosPorDev(){
        require_once __DIR__ . '/../../../database/connection.php';
        $sql = "
        SELECT MONTH(csla.cadastrado_em) mes, csla.responsavel
        FROM tb_chamados_sla csla
        JOIN tb_tela_sla tsla ON csla.tela = tsla.id
        JOIN tb_modulo modu ON tsla.modulo = modu.id
        WHERE YEAR(csla.cadastrado_em) = YEAR(CURDATE()) AND csla.responsavel IS NOT NULL AND csla.status = '1' ORDER BY csla.cadastrado_em ASC;
        ";
        $resultado = select($sql);
        return $resultado;
    }
    public function calculaQtChamadosEntreguesPorFuncionario(){
        require_once __DIR__ . '/../../../database/connection.php';
        $sql = "
        SELECT MONTH(csla.concluido_em) mes, csla.responsavel
        FROM tb_chamados_sla csla
        JOIN tb_tela_sla tsla ON csla.tela = tsla.id
        JOIN tb_modulo modu ON tsla.modulo = modu.id
        WHERE YEAR(csla.concluido_em) = YEAR(CURDATE()) AND etapa_atual IN (11,12);
        ";
        $resultado = select($sql);
        return $resultado;
    }
    public function calculaQtChamadosPorCliente(){
        require_once __DIR__ . '/../../../database/connection.php';
        $sql = "
        SELECT MONTH(csla.cadastrado_em) mes, csla.cliente
        FROM tb_chamados_sla csla
        JOIN tb_cliente c ON c.id = csla.cliente
        WHERE YEAR(csla.cadastrado_em) = YEAR(CURDATE()) ORDER BY csla.cadastrado_em ASC;
        ";
        $resultado = select($sql);
        return $resultado;
    }
    public function getAtendimentosSuporte($user){
        require_once __DIR__ . '/../../../database/connection.php';
        $sql = "
        SELECT ras.id, solic.nome AS usuario, solic.id AS id_usuario, c.cliente, c.id AS id_cliente, ras.solicitante_externo, ras.assunto, ras.resumo, CASE WHEN ras.resolvido = 'S' THEN 'SIM' WHEN ras.resolvido = 'N' THEN 'NÃO' WHEN ras.resolvido = 'P' THEN 'PENDENTE' WHEN ras.resolvido = 'C' THEN 'CORRIGINDO' END AS resolvido, ras.cadastrado_em, ras.status 
        FROM tb_registros_atendimentos_suporte ras
        JOIN tb_solicitante_sla solic ON ras.usuario = solic.id
        JOIN tb_cliente c ON c.id = ras.cliente
        WHERE solic.nome = '$user' AND ras.status = '1'
        ORDER BY ras.cadastrado_em DESC;
        ";
        $resultado = select($sql);
        return $resultado;
    }
    public function getTodosAtendimentosSuporte($userPesquisa, $data_inicial, $data_final){
        $andUser = $userPesquisa != '' ? " AND solic.nome = '$userPesquisa'" : ''; 
        $andDataInicial = $data_inicial != '' ? " AND ras.cadastrado_em >= '$data_inicial:00:00'" : ''; 
        $andDataFinal = $data_final != '' ? " AND ras.cadastrado_em <= '$data_final:23:59:59'" : ''; 

        require_once __DIR__ . '/../../../database/connection.php';
        $sql = "
        SELECT ras.id, solic.nome AS usuario, solic.id AS id_usuario, c.cliente, c.id AS id_cliente,  ras.solicitante_externo, ras.assunto, ras.resumo, CASE WHEN ras.resolvido = 'S' THEN 'SIM' WHEN ras.resolvido = 'N' THEN 'NÃO' WHEN ras.resolvido = 'P' THEN 'PENDENTE' WHEN ras.resolvido = 'C' THEN 'CORRIGINDO' END AS resolvido, ras.cadastrado_em, ras.status 
        FROM tb_registros_atendimentos_suporte ras
        JOIN tb_solicitante_sla solic ON ras.usuario = solic.id
        JOIN tb_cliente c ON c.id = ras.cliente
        {$andUser}
        {$andDataInicial}
        {$andDataFinal}
        ORDER BY ras.cadastrado_em DESC;
        ";
        $resultado = select($sql);
        return $resultado;
    }
    public function getChamadosDashboard($responsavel = '', $condicao = ''){
        switch($condicao){
            case 'Filtro: Todos': $where = "";
            break;
            case 'Filtro: Chamados abertos hoje': $where = "AND csla.cadastrado_em > CURDATE() ORDER BY csla.id DESC";
            break;
            case 'Filtro: Chamados cancelados': $where = "AND csla.chamado_cancelado = 'S' ORDER BY csla.id DESC";
            break;
            case 'Filtro: Chamados finalizados': $where = "AND csla.aprovado_reprovado = 'A' ORDER BY csla.id DESC";
            break;
            case 'Filtro: Chamados abertos mais antigos': $where = "AND csla.concluido_em IS NULL ORDER BY csla.id ASC";
            break;
            case 'Filtro: Chamados abertos mais recentes': $where = "AND csla.concluido_em IS NULL ORDER BY csla.id DESC";
            break;
            case 'Filtro: Chamados reprovados que estão sendo revisados': $where = "AND csla.aprovado_reprovado = 'R' AND csla.propagacao_solicitada = 'N' ORDER BY csla.id DESC";
            break;
            case 'Filtro: Chamados em teste': $where = "AND csla.concluido_em IS NOT NULL AND csla.propagacao_solicitada = 'S' AND csla.aprovacao_tester IS NULL  ORDER BY csla.id DESC"; 
            break;
            
        }
        $setResponsavel = '';
        if(!empty($responsavel) && $responsavel != '%'){
            $setResponsavel = "AND colab.nome = '$responsavel'";
        }
        require_once __DIR__ . '/../../../database/connection.php';
        $agora = date('Y-m-d H:i:s');
        $sql = "
        SELECT 	csla.id AS id_chamado, 
        client.cliente AS cliente, 
        ssla.nome As solicitante,
        csla.envolvidos AS envolvidos,
        csla.titulo AS titulo,
        csla.descricao AS descricao_chamado,  
        csla.data_entrega_estimada,
        prod.produto AS produto,
        modu.modulo AS modulo,
        tsla.nome AS tela,
        csla.direcionamento,
        psla.nome AS prioridade, 
        csla.prazo AS prazo, 
        csla.total_horas_orcamento,
        csla.valor_hora_orcamento,
        csla.desconto_orcamento,
        csla.total_preco_orcamento,
        csla.caminho_anexo,
        csla.em_pausa,
        csla.iniciado_em,
        csla.branch,
        csla.caminho_anexo2,
        csla.cadastrado_em,
        csla.modificacao,
        csla.propagado,
        csla.aprovacao_tester,
        csla.aprovado_reprovado,
        csla.propagacao_solicitada,
        csla.chamado_cancelado,
        DATE_ADD(csla.cadastrado_em, INTERVAL + csla.prazo HOUR) tempo_limite,
        IF(TIMESTAMPDIFF(MINUTE,'$agora',DATE_ADD(csla.cadastrado_em, INTERVAL + csla.prazo HOUR))<1,0,
        TIMESTAMPDIFF(MINUTE,'$agora',DATE_ADD(csla.cadastrado_em, INTERVAL + csla.prazo HOUR))) tempo_restante,
        colab.nome AS responsavel,
        csla.concluido_em,
        csla.status
        FROM tb_chamados_sla csla
        JOIN tb_cliente client ON csla.cliente = client.id
        JOIN tb_produto prod ON csla.produto = prod.id
        JOIN tb_solicitante_sla ssla ON csla.solicitante = ssla.id
        JOIN tb_tela_sla tsla ON tsla.id = csla.tela
        JOIN tb_modulo modu ON tsla.modulo = modu.id
        JOIN tb_prioridade_sla psla ON csla.prioridade = psla.id
	    LEFT JOIN tb_solicitante_sla colab ON csla.responsavel = colab.id
        WHERE csla.status = '1'
        {$setResponsavel}
        {$where}";
        $resultado = select($sql);
        return $resultado;
    }
    function getChamadosEmEspera($responsavel){
        if(!empty($responsavel)){
            $setResponsavel = "AND colab.nome = '$responsavel'";
        }
        require_once __DIR__ . '/../../../database/connection.php';
        $sql = "
        SELECT 	csla.id AS id_chamado, 
        cliente.cliente AS cliente, 
        ssla.nome As solicitante,
        csla.envolvidos AS envolvidos,
        csla.titulo AS titulo,
        csla.descricao AS descricao_chamado,  
        csla.data_entrega_estimada,
        prod.produto AS produto,
        modu.modulo AS modulo,
        tsla.nome AS tela,
        csla.direcionamento,
        psla.nome AS prioridade, 
        csla.prazo AS prazo,
        csla.motivo_espera,
        csla.data_colocado_espera,
        csla.total_horas_orcamento,
        csla.valor_hora_orcamento,
        csla.desconto_orcamento,
        csla.total_preco_orcamento,
        csla.caminho_anexo,
        csla.caminho_anexo2,
        csla.cadastrado_em,
        colab.nome AS responsavel,
        csla.concluido_em,
        csla.status
        FROM tb_chamados_sla csla
        JOIN tb_cliente cliente ON csla.cliente = cliente.id
        JOIN tb_produto prod ON csla.produto = prod.id
        JOIN tb_solicitante_sla ssla ON csla.solicitante = ssla.id
        JOIN tb_tela_sla tsla ON tsla.id = csla.tela
        JOIN tb_modulo modu ON tsla.modulo = modu.id
        JOIN tb_prioridade_sla psla ON csla.prioridade = psla.id
        LEFT JOIN tb_solicitante_sla colab ON csla.responsavel = colab.id        
        WHERE csla.concluido_em IS NULL
        AND csla.chamado_em_espera = 'S'
        AND csla.status = '1'
        {$setResponsavel}
        ORDER BY csla.id;
        ";
        $resultado = select($sql);
        return $resultado;
    }
    function getChamadosAbertosPorEmpresa($empresa, $type, $idChamado = '', $dataInicial = '', $dataFinal = ''){
        if($type == 'banco'){
            $type = " AND c.banco_de_dados = '$empresa'";
        }else if($type == 'nome_empresa'){
            $type = " AND c.nome_empresa = '$empresa'";
        }
        
        if($idChamado != ''){
            $andChamado = " AND csla.id = '$idChamado' ";
        }else{
            $andChamado = '';
        }

        if($dataInicial != ''){
            $andDataInicial = " AND csla.cadastrado_em >= '$dataInicial 00:00:00'";
        }else{
            $andDataInicial = '';
        }

        if($dataFinal != ''){
            $andDataFinal = " AND csla.cadastrado_em <= '$dataFinal 23:59:59'";
        }else{
            $andDataFinal = '';
        }


        require_once __DIR__ . '/../../../database/connection.php';
        $agora = date('Y-m-d H:i:s');
        $sql = "
        SELECT 	csla.id AS id, 
        c.cliente,
        csla.cliente AS id_cliente,
        csla.solicitante_externo,
        ssla.nome As solicitante,
        csla.envolvidos AS envolvidos,
        csla.titulo AS titulo,
        ea.nome_etapa,
        csla.descricao AS descricao_chamado,  
        csla.data_entrega_estimada,
        prod.produto AS produto,
        modu.modulo AS modulo,
        tsla.nome AS tela,
        csla.direcionamento,
        psla.nome AS prioridade, 
        csla.prazo AS prazo, 
        csla.total_horas_orcamento,
        csla.valor_hora_orcamento,
        csla.desconto_orcamento,
        csla.total_preco_orcamento,
        csla.caminho_anexo,
        csla.caminho_anexo2,
        csla.cadastrado_em,
        DATE_ADD(csla.cadastrado_em, INTERVAL + csla.prazo HOUR) tempo_limite,
        IF(TIMESTAMPDIFF(MINUTE,'$agora',DATE_ADD(csla.cadastrado_em, INTERVAL + csla.prazo HOUR))<1,0,
        TIMESTAMPDIFF(MINUTE,'$agora',DATE_ADD(csla.cadastrado_em, INTERVAL + csla.prazo HOUR)))tempo_restante,
        colab.nome AS responsavel,
        csla.concluido_em,
        csla.status
        FROM tb_chamados_sla csla
        JOIN tb_cliente c ON c.id = csla.cliente
        JOIN tb_produto prod ON csla.produto = prod.id
        JOIN tb_solicitante_sla ssla ON csla.solicitante = ssla.id
        JOIN tb_tela_sla tsla ON tsla.id = csla.tela
        JOIN tb_modulo modu ON tsla.modulo = modu.id
        JOIN tb_prioridade_sla psla ON csla.prioridade = psla.id
        JOIN tb_etapa_atual ea ON ea.id = csla.etapa_atual
	    LEFT JOIN tb_solicitante_sla colab ON csla.responsavel = colab.id        
        WHERE csla.status = '1'
        AND ea.nome_etapa NOT LIKE ('%finalizado%')
        AND  ea.nome_etapa NOT LIKE ('%cancelado%')
        {$type}
        {$andChamado}
        {$andDataInicial}
        {$andDataFinal}
        ;";
        $resultado = select($sql);
        return $resultado; 
    }
    function getChamadosFechadosPorEmpresa($empresa, $type, $idChamado = '', $dataInicial = '', $dataFinal = ''){
        if($type == 'banco'){
            $type = " AND c.banco_de_dados = '$empresa'";
        }else if($type == 'nome_empresa'){
            $type = " AND c.nome_empresa = '$empresa'";
        }
        if($idChamado != ''){
            $andChamado = " AND csla.id = '$idChamado' ";
        }else{
            $andChamado = '';
        }

        if($dataInicial != ''){
            $andDataInicial = " AND csla.cadastrado_em >= '$dataInicial 00:00:00'";
        }else{
            $andDataInicial = '';
        }

        if($dataFinal != ''){
            $andDataFinal = " AND csla.cadastrado_em <= '$dataFinal 23:59:59'";
        }else{
            $andDataFinal = '';
        }
        require_once __DIR__ . '/../../../database/connection.php';
        $sql = "SELECT csla.id,
        csla.cadastrado_em,
        c.cliente,
        csla.solicitante_externo,
        csla.titulo,
        ea.nome_etapa
         FROM tb_chamados_sla csla
            JOIN tb_cliente c ON c.id = csla.cliente
            JOIN tb_etapa_atual ea ON ea.id = csla.etapa_atual
            WHERE csla.status = '1'
            AND (ea.nome_etapa = 'Chamado finalizado' OR ea.nome_etapa = 'Chamado cancelado' OR ea.nome_etapa = 'Chamado finalizado via suporte') 
            {$type}
            {$andChamado}
            {$andDataInicial}
            {$andDataFinal}
            ;";
        $resultado = select($sql);
        return $resultado; 
    }
    function getUltimoChamadoAberto(){
        require_once __DIR__ . '/../../../database/connection.php';
        $agora = date('Y-m-d H:i:s');
        $sql = "
        SELECT 	csla.id AS id_chamado, 
        client.cliente AS cliente, 
        ssla.nome As solicitante,
        csla.envolvidos AS envolvidos,
        csla.titulo AS titulo,
        csla.descricao AS descricao_chamado,  
        csla.data_entrega_estimada,
        prod.produto AS produto,
        modu.modulo AS modulo,
        tsla.nome AS tela,
        csla.direcionamento,
        psla.nome AS prioridade, 
        csla.prazo AS prazo, 
        csla.total_horas_orcamento,
        csla.valor_hora_orcamento,
        csla.desconto_orcamento,
        csla.total_preco_orcamento,
        csla.caminho_anexo,
        csla.caminho_anexo2,
        csla.cadastrado_em,
        DATE_ADD(csla.cadastrado_em, INTERVAL + csla.prazo HOUR) tempo_limite,
        IF(TIMESTAMPDIFF(MINUTE,'$agora',DATE_ADD(csla.cadastrado_em, INTERVAL + csla.prazo HOUR))<1,0,
        TIMESTAMPDIFF(MINUTE,'$agora',DATE_ADD(csla.cadastrado_em, INTERVAL + csla.prazo HOUR)))tempo_restante,
        colab.nome AS responsavel,
        csla.concluido_em,
        csla.status
        FROM tb_chamados_sla csla
        JOIN tb_cliente client ON csla.cliente = client.id
        JOIN tb_produto prod ON csla.produto = prod.id
        JOIN tb_solicitante_sla ssla ON csla.solicitante = ssla.id
        JOIN tb_tela_sla tsla ON tsla.id = csla.tela
        JOIN tb_modulo modu ON tsla.modulo = modu.id
        JOIN tb_prioridade_sla psla ON csla.prioridade = psla.id
	    LEFT JOIN tb_solicitante_sla colab ON csla.responsavel = colab.id        
        WHERE csla.concluido_em IS NULL
        AND colab.nome IS NULL
        AND csla.status = '1'
        ORDER BY csla.id DESC
        LIMIT 1;
        ";
        $resultado = select($sql);
        return $resultado;
    }
}

?>
