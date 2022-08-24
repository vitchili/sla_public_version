<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<figure class="highcharts-figure">
    <div id="container5"></div>
</figure>


  <?php
    $total = 0;
    $chamadosPorTela = $chamadosAbertosFila->calculaQtChamadosPorTelaMes();
    for($i=0;$i<count($chamadosPorTela);$i++){
        $total += $chamadosPorTela[$i]['contador'];
    }
  ?>
  <style>
.highcharts-figure, .highcharts-data-table table {
    min-width: 310px; 
    max-width: 800px;
    margin: 1em auto;
}

#container5 {
    height: 300px;
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
// Create the chart
var data = new Date();
var mes = String(data.getMonth() + 1).padStart(2, '0');
var ano = data.getFullYear();
dataAtual = mes + '/' + ano;
Highcharts.chart('container5', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Porcentagem de chamados por tela - ' + dataAtual
    },
    accessibility: {
        announceNewData: {
            enabled: true
        }
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Quantidade de chamados'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:.1f}%'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
    },

    series: [
        {
            name: "Tela",
            colorByPoint: true,
            data: [
                <?php
                for($i=0;$i<count($chamadosPorTela);$i++){
                    echo "
                    {
                        name: \"".$chamadosPorTela[$i]['modulo']."\",
                        y: ".(intval($chamadosPorTela[$i]['contador'])*100)/(intval($total))."
                    },
                    ";
                }
                ?>

            ]
        }
    ]
});
</script>