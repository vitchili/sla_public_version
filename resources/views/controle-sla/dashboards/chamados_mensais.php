<!-- TRECHO QUE FAZ O DASHBOARD FUNCIONAR (LEMBRE-SE QUE EXISTE UM CSS NO /PUBLIC NECESSARIO*/ -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <figure class="highcharts-figure">
      <div id="container"></div>
      
    </figure>

  <?php
    $chamadosPorMes = $chamadosAbertosFila->calculaQtChamados();
  ?>
  <style>
.highcharts-figure, .highcharts-data-table table {
    min-width: 310px; 
    max-width: 800px;
    margin: 1em auto;
}

#container {
    height: 300px;
    max-width: 100%;
}

.highcharts-data-table table {
	font-family: Verdana, sans-serif;
	border-collapse: collapse;
	border: 1px solid #EBEBEB;
	margin: 10px auto;
	text-align: center;
	width: 100%;
	max-width: 500px;
}
.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}
.highcharts-data-table th {
	font-weight: 600;
    padding: 0.5em;
}
.highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
    padding: 0.5em;
}
.highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}
.highcharts-data-table tr:hover {
    background: #f1f7ff;
}

  </style>
<script>
var data = new Date();
var ano = data.getFullYear();
Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Chamados ao longo do tempo - ' + ano
    },
    xAxis: {
        categories: [
            'Jan',
            'Fev',
            'Mar',
            'Abr',
            'Mai',
            'Jun',
            'Jul',
            'Ago',
            'Set',
            'Out',
            'Nov',
            'Dez'
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Quantidade'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} chamados</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Chamados',
        data: [<?php echo $chamadosPorMes[1];?>, <?php echo $chamadosPorMes[2];?>, <?php echo $chamadosPorMes[3];?>, <?php echo $chamadosPorMes[4];?>, <?php echo $chamadosPorMes[5];?>, <?php echo $chamadosPorMes[6];?>, <?php echo $chamadosPorMes[7];?>, <?php echo $chamadosPorMes[8];?>, <?php echo $chamadosPorMes[9];?>, <?php echo $chamadosPorMes[10];?>, <?php echo $chamadosPorMes[11];?>, <?php echo $chamadosPorMes[12];?>]

    }]
});
</script>
