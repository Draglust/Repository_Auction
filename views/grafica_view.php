<html>
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script src="http://code.highcharts.com/highcharts.js"></script>
<?php header('Content-Type: text/html; charset=utf-8');?>	
</head>
<body>
<div class='container' ></div>
<script type="text/javascript">
	$(function () { 
	    $('.container').highcharts({
	        chart: {
            	marginRight: 80
        	},
	        title: {
	            text: 'Historial Precios'

	        },
	        subtitle: {
            	text: 'Periodo: Últimos 7 dias'
        	},
	        xAxis: {
            categories: [<?=$fecha7?>]
        	},
	        yAxis: {
	            title: {
	                text: 'Precio'
	            }
	        },
	        series: [{
            type: 'spline',
            data: [<?=$precio7 ?>],
            name: 'Precio'
        	},
        	{
        	name: 'Cantidad',
            type: 'spline',
            data: [<?=$cantidades7 ?>],
        	}]
	    });
	});
</script>
</body>
</html>