<!-- TRECHO QUE FAZ O DASHBOARD FUNCIONAR (LEMBRE-SE QUE EXISTE UM CSS NO /PUBLIC NECESSARIO*/ -->   
<script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <figure class="highcharts-figure">
      <div id="container6"></div>
      
    </figure>
  <?php
    $chamadosPorSup = $chamadosAssumidosSLA->calculaQtChamadosEntreguesPorFuncionario();
    // echo "<pre>";
    // var_dump($chamadosPorSup);

  ?>
<script>
Highcharts.chart('container6', {
  chart: {
    type: 'line'
  },
  title: {
    text: 'Total de chamados entregues por Suporte'
  },
  subtitle: {
    text: 'Resolvidos e Finalizados'
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
    name: 'João Victor',
    data: [<?php if(isset($chamadosPorSup[1][6])) {echo $chamadosPorSup[1][6];} else { echo '0';}?>, <?php if(isset($chamadosPorSup[2][6])) {echo $chamadosPorSup[2][6];} else { echo '0';}?>, <?php if(isset($chamadosPorSup[3][6])) {echo $chamadosPorSup[3][6];} else { echo '0';}?>, <?php if(isset($chamadosPorSup[4][6])) {echo $chamadosPorSup[4][6];} else { echo '0';}?>, <?php if(isset($chamadosPorSup[5][6])) {echo $chamadosPorSup[5][6];} else { echo '0';}?>, <?php if(isset($chamadosPorSup[6][6])) {echo $chamadosPorSup[6][6];} else { echo '0';}?>, <?php if(isset($chamadosPorSup[7][6])) {echo $chamadosPorSup[7][6];} else { echo '0';}?>, <?php if(isset($chamadosPorSup[8][6])) {echo $chamadosPorSup[8][6];} else { echo '0';}?>, <?php if(isset($chamadosPorSup[9][6])) {echo $chamadosPorSup[9][6];} else { echo '0';}?>, <?php if(isset($chamadosPorSup[10][6])) {echo $chamadosPorSup[10][6];} else { echo '0';}?>, <?php if(isset($chamadosPorSup[11][6])) {echo $chamadosPorSup[11][6];} else { echo '0';}?>, <?php if(isset($chamadosPorSup[12][6])) {echo $chamadosPorSup[12][6];} else { echo '0';}?>]
  },{
    name: 'Lucas Padilha',
    data: [<?php if(isset($chamadosPorSup[1][15])) {echo $chamadosPorSup[1][15];} else { echo '0';}?>, <?php if(isset($chamadosPorSup[2][15])) {echo $chamadosPorSup[2][15];} else { echo '0';}?>, <?php if(isset($chamadosPorSup[3][15])) {echo $chamadosPorSup[3][15];} else { echo '0';}?>, <?php if(isset($chamadosPorSup[4][15])) {echo $chamadosPorSup[4][15];} else { echo '0';}?>, <?php if(isset($chamadosPorSup[5][15])) {echo $chamadosPorSup[5][15];} else { echo '0';}?>, <?php if(isset($chamadosPorSup[6][15])) {echo $chamadosPorSup[6][15];} else { echo '0';}?>, <?php if(isset($chamadosPorSup[7][15])) {echo $chamadosPorSup[7][15];} else { echo '0';}?>, <?php if(isset($chamadosPorSup[8][15])) {echo $chamadosPorSup[8][15];} else { echo '0';}?>, <?php if(isset($chamadosPorSup[9][15])) {echo $chamadosPorSup[9][15];} else { echo '0';}?>, <?php if(isset($chamadosPorSup[10][15])) {echo $chamadosPorSup[10][15];} else { echo '0';}?>, <?php if(isset($chamadosPorSup[11][15])) {echo $chamadosPorSup[11][15];} else { echo '0';}?>, <?php if(isset($chamadosPorSup[12][15])) {echo $chamadosPorSup[12][15];} else { echo '0';}?>]
  }
]});
</script>