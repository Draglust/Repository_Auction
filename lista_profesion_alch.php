<head>

<link rel="stylesheet" type="text/css" href="itemlist.css">
<script src="http://code.jquery.com/jquery-1.11.1.js"></script>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/stock/highstock.js"></script>
<script type="text/javascript" src="http://static.es.wowhead.com/widgets/power.js"></script>
<script src="dark-unica.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $('.container').hide();
  $(".interruptor").click(function(){
    	$(this).next('.container').toggle();
    	if($(this).val()=='-'){
    		$(this).val('+');	
    	}
    	else{
    		$(this).val('-');
    	}
   
  });
});
</script>
s
</head>

<?php

header('Content-Type: text/html; charset=utf-8');
$server = 'localhost';
$link = mysqli_connect($server, 'root', '','wow');

if (!$link) {
    die('Algo fue mal mientras se conectaba a MSSQL');
}
else{
	$chSet=mysqli_set_charset($link, "utf8");
	$conjuntoCaracteres=mysqli_character_set_name($link);
	
}

$sql="select category.idWow,nombre,subCategoria,priceAuction,dateAuction,sum(quantity),ruta as fecha_max from category inner join timeprice on category.idWow=timeprice.idWow inner join wowhead on timeprice.idWow=wowhead.id where category.subcategoria='hierbas' and dateauction in(select max(dateauction) from timeprice) group by nombre order by idWow desc";
$comprobacion=mysqli_query($link,$sql);


echo "<table border='1'>
<caption>Herboristeria</caption>
<tr><th>Nombre</th><th>Precio mínimo</th><th>Última Fecha</th><th>Cantidad Total</th></tr>";
$precioMax=0;
$precioMin=100000000;
while ($row=mysqli_fetch_array($comprobacion)) {
	unset($datos);
	unset($fechas);
	unset($cantidades);
	echo "<tr><td><a href=# rel='domain=es&amp;item=".$row[0]."'>".$row[1]."</a></td><td>".round($row[3]/10000,2,PHP_ROUND_HALF_UP)."g</td><td>".$row[4]."</td><td>".$row[5]."</td></tr>";
	$innerSql="select id,nombre,priceAuction,numericDate,dateAuction,quantity from wowhead inner join timeprice on wowhead.id=timeprice.idwow where datediff(curdate(),dateauction)<7 and idwow=".$row[0]." group by dateauction";
	
	$innerComprobacion=mysqli_query($link,$innerSql);
	$precioMax=0;
	$precioMin=1000000000;
	$dateMax=0;
	$dateMin=0;
	while($innerRow=mysqli_fetch_array($innerComprobacion)){
		$valorAuction=$innerRow[2];
		if($precioMax<$valorAuction){
			$precioMax=$valorAuction/10000;
			$precioMax=round($precioMax,2,PHP_ROUND_HALF_UP);
			$dateMax=$innerRow[4];
		}
		if($precioMin>$valorAuction){
			$precioMin=$valorAuction/10000;
			$precioMin=round($precioMin,2,PHP_ROUND_HALF_UP);
			$dateMin=$innerRow[4];
		}
	$precioAjustado=round($innerRow[2]/10000,2,PHP_ROUND_HALF_UP);
	$fechaAjustada=$innerRow[3];
	$datos[]=$precioAjustado;
	$fechas[]="'".date('d-m H:i',$fechaAjustada)."'";
	$cantidades[]=$innerRow[5];
	//echo $precioAjustado.":".$fechaAjustada."<br>";



	}
	$precioAvg=round((($precioMax*100)/$precioMin)-100,2,PHP_ROUND_HALF_UP);
	if($precioAvg>=50.00){
		$clase='verde';
	}
	elseif ($precioAvg<50 and $precioAvg>20) {
		$clase='verdeclaro';
	}
	elseif ($precioAvg<0) {
		$clase='rojo';
	}
	else{
		$clase='';
	}
	$nombreGrafico2="'Cantidad'";
	$contenedor="'#id".$row[0]."'";
	$continente=$row[0];
	$nombreGrafico="'".$row[1]."'";
	echo "<tr class='".$clase."'><td>+</td><td>Max: ".$precioMax."g(".$dateMax.")</td><td>Min: ".$precioMin."g(".$dateMin.")</td><td>Porcentaje: ".$precioAvg."%</td></tr>";
	echo "<tr><td><input type=button class='interruptor'value='+'></input><div class='container' id='id".$row[0]."'></div></td></tr>";
?>

<script type="text/javascript">
	$(function () { 
	    $(<?php echo $contenedor ?>).highcharts({
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
            categories: [<?php echo join(",",$fechas) ?>]
        	},
	        yAxis: {
	            title: {
	                text: 'Precio'
	            }
	        },
	        series: [{
            type: 'spline',
            data: [<?php echo join(", ",$datos) ?>],
            name: <?php echo $nombreGrafico ?>
        	},
        	{
        	name: <?php echo $nombreGrafico2 ?>,
            type: 'spline',
            data: [<?php echo join(", ",$cantidades) ?>],
        	}]
	    });
	});
</script>

<?php
}

echo "</table>";
?>
