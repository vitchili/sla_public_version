<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<figure class="highcharts-figure">
  <div id="container4"></div>
</figure>

<style>
  #container4 {
    height: 300px;
    max-width: 100%;
}
</style>

<?php
    $finalizacaoChamadosTipos = $chamadosAbertosFila->getQtDirecionamentoChamados();
  ?>
<script>


Highcharts.chart('container4', {
  chart: {
    plotBackgroundColor: null,
    plotBorderWidth: null,
    plotShadow: false,
    type: 'pie'
  },
  title: {
    text: 'Direcionamento'
  },
  tooltip: {
    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
  },
  accessibility: {
    point: {
      valueSuffix: '%'
    }
  },
  plotOptions: {
    pie: {
      allowPointSelect: true,
      cursor: 'pointer',
      dataLabels: {
        enabled: true,
        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
      }
    }
  },
  series: [{
    name: 'Chamados',
    colorByPoint: true,
    data: [{
      name: 'Suporte',
      y: <?php echo $finalizacaoChamadosTipos[1]['count_chamados'];?>
    },
    {
      name: 'Desenvolvimento',
      y: <?php echo $finalizacaoChamadosTipos[0]['count_chamados'];?>
    }]
  }]
});    
</script>