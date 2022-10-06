<p><b>Atenção: </b>Esta é a primeira versão do código do sistema Docsupp SLA (utilizado nos prints pelo suporte da Aquicob)<b>(Modelo 2019-2020)</b>. O projeto ainda existe e é utilizado no mercado, mas foi refatorado por completo e este código não condiz mais em nenhum ponto com a estrutura atual. Atualmente, o sistema utiliza as estruturas bem definidas do padrão de projeto MVC, sintetizado pelo Laravel 9. Dessa forma, decidi divulgar em código aberto a primeira versão, em PHP puro, para estimular de alguma forma a comunidade PHP para estudo.</p>

<p>Este é um sistema de gestão e documentação que relaciona o setor de TI, o administrativo e os clientes que a instituição atende.</p>
<p>O contexto é: toda empresa de tecnologia recebe demandas através do suporte e efetua o atendimento do helpdesk.
Assim, a plataforma proposta trata cada chamado aberto com um cálculo de previsão de entrega dinâmico (calculados por tela, prioridade, módulo e pesos). 
<p>No sistema, cada usuário possui um login e uma fila de demandas cujo administrativo designa as tarefas, e os desenvolvedores efetuam as modificações necessárias e encaminham as alterações para validação do teste.</p>
<p>O administrativo, por sua vez, faz a gestão deste fluxo por meio de diversos gráficos e dashboard de controle. </p>
<p>Além disso, o cliente é notificado a cada chamado aberto e pode acompanhar o chamado aberto. </p>
Todos dados interagidos são gravados em logs para geração de relatórios de produtividade, em uma espécie de diário do funcionário. 
<p>A plataforma carrega funcionalidades diversas considerando as possibilidades de tratamento do chamado, como iniciar correção, pausar correção, deixá-lo em espera, aguardar retorno do cliente, cancelar a tarefa,  finalizar via suporte, entre outros. </p>
<p>Por fim, há também o módulo de documentação, quando o tipo de usuário é cliente, e assim consegue ver os dados de sua empresa. 
Este espaço não precisa de login para acessar, e possui uma base de conhecimento distribuída em manuais, FAQ, canal de novidades e pesquisa por chamados abertos.</p>

<p>Detalhe: o dump e arquivo de conexão não foram disponibilizados por segurança de estrutura</p>

![alt text](prints_interface/tasks_a_distribuir.jpg)

![alt text](prints_interface/criacao_chamados.jpg)

![alt text](prints_interface/testes.jpg)

