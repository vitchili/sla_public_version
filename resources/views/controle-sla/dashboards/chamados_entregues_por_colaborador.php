<!-- TRECHO QUE FAZ O DASHBOARD FUNCIONAR (LEMBRE-SE QUE EXISTE UM CSS NO /PUBLIC NECESSARIO*/ -->   
<script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <figure class="highcharts-figure">
      <div id="container3"></div>
      
    </figure>
  <?php
    $chamadosPorDev = $chamadosAssumidosSLA->calculaQtChamadosEntreguesPorFuncionario();
    //echo '<pre>';
    //print_r($chamadosPorDev);
    //o primeiro indice � o mes, o segundo � o id do tb_solicitante_sla. Caso for incluir um novo colaborador, inclua ali no name-data com o id e nome correto
  ?>
<script>
Highcharts.chart('container3', {
  chart: {
    type: 'line'
  },
  title: {
    text: 'Total de chamados entregues por colaborador'
  },
  subtitle: {
    text: 'Aprovados e reprovados, independente de quando criado'
  },
  xAxis: {
    categories: ['Jan/<?php echo date("Y")?>', 'Feb/<?php echo date("Y")?>', 'Mar/<?php echo date("Y")?>', 'Apr/<?php echo date("Y")?>', 'May/<?php echo date("Y")?>', 'Jun/<?php echo date("Y")?>', 'Jul/<?php echo date("Y")?>', 'Aug/<?php echo date("Y")?>', 'Sep/<?php echo date("Y")?>', 'Oct/<?php echo date("Y")?>', 'Nov/<?php echo date("Y")?>', 'Dec/<?php echo date("Y")?>']
  },
  yAxis: {
    title: {
      text: 'Quantidade'
    }
  },
  plotOptions: {
    line: {
      dataLabels: {
        enabled: true
      },
      enableMouseTracking: false
    }
  },
  series: [{
    name: 'Bruno Leria',
    data: [<?php if(isset($chamadosPorDev[1][8])) {echo $chamadosPorDev[1][8];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[2][8])) {echo $chamadosPorDev[2][8];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[3][8])) {echo $chamadosPorDev[3][8];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[4][8])) {echo $chamadosPorDev[4][8];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[5][8])) {echo $chamadosPorDev[5][8];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[6][8])) {echo $chamadosPorDev[6][8];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[7][8])) {echo $chamadosPorDev[7][8];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[8][8])) {echo $chamadosPorDev[8][8];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[9][8])) {echo $chamadosPorDev[9][8];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[10][8])) {echo $chamadosPorDev[10][8];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[11][8])) {echo $chamadosPorDev[11][8];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[12][8])) {echo $chamadosPorDev[12][8];} else { echo '0';}?>]
  },{
    name: 'Derso Naves',
    data: [<?php if(isset($chamadosPorDev[1][7])) {echo $chamadosPorDev[1][7];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[2][7])) {echo $chamadosPorDev[2][7];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[3][7])) {echo $chamadosPorDev[3][7];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[4][7])) {echo $chamadosPorDev[4][7];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[5][7])) {echo $chamadosPorDev[5][7];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[6][7])) {echo $chamadosPorDev[6][7];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[7][7])) {echo $chamadosPorDev[7][7];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[8][7])) {echo $chamadosPorDev[8][7];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[9][7])) {echo $chamadosPorDev[9][7];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[10][7])) {echo $chamadosPorDev[10][7];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[11][7])) {echo $chamadosPorDev[11][7];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[12][7])) {echo $chamadosPorDev[12][7];} else { echo '0';}?>]
  },{
    name: 'Gabriel Moreira',
    data: [<?php if(isset($chamadosPorDev[1][4])) {echo $chamadosPorDev[1][4];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[2][4])) {echo $chamadosPorDev[2][4];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[3][4])) {echo $chamadosPorDev[3][4];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[4][4])) {echo $chamadosPorDev[4][4];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[5][4])) {echo $chamadosPorDev[5][4];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[6][4])) {echo $chamadosPorDev[6][4];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[7][4])) {echo $chamadosPorDev[7][4];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[8][4])) {echo $chamadosPorDev[8][4];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[9][4])) {echo $chamadosPorDev[9][4];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[10][4])) {echo $chamadosPorDev[10][4];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[11][4])) {echo $chamadosPorDev[11][4];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[12][4])) {echo $chamadosPorDev[12][4];} else { echo '0';}?>]
  },{
    name: 'João Victor',
    data: [<?php if(isset($chamadosPorDev[1][18])) {echo $chamadosPorDev[1][18];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[2][18])) {echo $chamadosPorDev[2][18];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[3][18])) {echo $chamadosPorDev[3][18];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[4][18])) {echo $chamadosPorDev[4][18];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[5][18])) {echo $chamadosPorDev[5][18];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[6][18])) {echo $chamadosPorDev[6][18];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[7][18])) {echo $chamadosPorDev[7][18];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[8][18])) {echo $chamadosPorDev[8][18];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[9][18])) {echo $chamadosPorDev[9][18];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[10][18])) {echo $chamadosPorDev[10][18];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[11][18])) {echo $chamadosPorDev[11][18];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[12][18])) {echo $chamadosPorDev[12][18];} else { echo '0';}?>]
  },{
    name: 'Mário Sérgio',
    data: [<?php if(isset($chamadosPorDev[1][2])) {echo $chamadosPorDev[1][2];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[2][2])) {echo $chamadosPorDev[2][2];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[3][2])) {echo $chamadosPorDev[3][2];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[4][2])) {echo $chamadosPorDev[4][2];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[5][2])) {echo $chamadosPorDev[5][2];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[6][2])) {echo $chamadosPorDev[6][2];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[7][2])) {echo $chamadosPorDev[7][2];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[8][2])) {echo $chamadosPorDev[8][2];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[9][2])) {echo $chamadosPorDev[9][2];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[10][2])) {echo $chamadosPorDev[10][2];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[11][2])) {echo $chamadosPorDev[11][2];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[12][2])) {echo $chamadosPorDev[12][2];} else { echo '0';}?>]
  },{
    name: 'Mathaus Adorno',
    data: [<?php if(isset($chamadosPorDev[1][11])) {echo $chamadosPorDev[1][11];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[2][11])) {echo $chamadosPorDev[2][11];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[3][11])) {echo $chamadosPorDev[3][11];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[4][11])) {echo $chamadosPorDev[4][11];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[5][11])) {echo $chamadosPorDev[5][11];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[6][11])) {echo $chamadosPorDev[6][11];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[7][11])) {echo $chamadosPorDev[7][11];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[8][11])) {echo $chamadosPorDev[8][11];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[9][11])) {echo $chamadosPorDev[9][11];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[10][11])) {echo $chamadosPorDev[10][11];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[11][11])) {echo $chamadosPorDev[11][11];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[12][11])) {echo $chamadosPorDev[12][11];} else { echo '0';}?>]
  },{
    name: 'Vitor Pimenta',
    data: [<?php if(isset($chamadosPorDev[1][1])) {echo $chamadosPorDev[1][1];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[2][1])) {echo $chamadosPorDev[2][1];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[3][1])) {echo $chamadosPorDev[3][1];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[4][1])) {echo $chamadosPorDev[4][1];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[5][1])) {echo $chamadosPorDev[5][1];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[6][1])) {echo $chamadosPorDev[6][1];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[7][1])) {echo $chamadosPorDev[7][1];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[8][1])) {echo $chamadosPorDev[8][1];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[9][1])) {echo $chamadosPorDev[9][1];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[10][1])) {echo $chamadosPorDev[10][1];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[11][1])) {echo $chamadosPorDev[11][1];} else { echo '0';}?>, <?php if(isset($chamadosPorDev[12][1])) {echo $chamadosPorDev[12][1];} else { echo '0';}?>]
  }
]});
</script>