<?php 


header('Content-Type: text/html; charset=utf-8');
include "phpQuery-onefile.php";
include 'simple_html_dom.php';
$User_Agent = 'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.111 Safari/537.36';
$host="http://eu.battle.net";
$realm="shen'dralar";
$url= "https://eu.api.battle.net/wow/auction/data/shen'dralar?locale=es_ES&apikey=8hw8e9kun6sf8kfh2qvjzw22b9wzzjek";
$server = 'localhost';
$ch = curl_init ();//Abre una instancia cURL
// Connect to MSSQL
$link = mysqli_connect($server, 'root', '','wow');

if (!$link) {
    die('Algo fue mal mientras se conectaba a MSSQL');
}
else{
	$chSet=mysqli_set_charset($link, "utf8");
	$conjuntoCaracteres=mysqli_character_set_name($link);
	echo "Conexion establecida :".$conjuntoCaracteres." : ";
}


$content = file_get_contents($url);
$obj = json_decode($content,true);
foreach ($obj['files'] as $i)
{
   	$fecha=date("Y-m-d H:i:s", $i['lastModified']/1000);
   	$fechaNumerica=$i['lastModified']/1000;
   	echo $fecha."  ".$fechaNumerica."   ";
    echo $i['url']."<br>";
}

		$conten = file_get_contents($i['url']);
		$contenido = json_decode($conten,true);
		$contador=0;
		foreach($contenido['auctions']['auctions']as $alianza){
		//foreach($contenido['alliance']['auctions']as $alianza){
			$contador=$contador+1;
		}
		echo "Total registros:".$contador.".  ";


		$parcial=0;
		$ignorados=0;
		$errores=0;
		foreach($contenido['auctions']['auctions']as $alianza){
		//foreach($contenido['alliance']['auctions']as $alianza){

			$precioMedio=round($alianza['buyout']/$alianza['quantity'],0,PHP_ROUND_HALF_UP);
			if($precioMedio==0){
				$listaerr[$errores][0]=$alianza['buyout'];
				$listaerr[$errores][1]=$alianza['quantity'];
				$listaerr[$errores][2]=$alianza['item'];
				$errores=$errores+1;
			}
			$sqlComprobacion='select idWow,priceAuction,numericDate,sellerName from timeprice where idWow='.$alianza['item']." and priceAuction=".$precioMedio." and sellerName='".$alianza['owner']."' and dateAuction='".$fecha."'";
			$comprobacion=mysqli_query($link,$sqlComprobacion);
			//$sqlComprobacion.":: ";
			$row=mysqli_fetch_array($comprobacion);
			
			if (($comprobacion==FALSE or $row==NULL) and $precioMedio>0 ) {
				$sql1="replace into timeprice values('".$alianza['item']."','".$precioMedio."','".$fecha."','".$alianza['quantity']."','".$fechaNumerica."','".mysql_real_escape_string($alianza['owner'])."')";
				echo $sql1."<br>";
				$sentencia=mysqli_query($link,$sql1);
				if (!$sentencia) {
		    		print('Consulta 1 no valida: '.$alianza['item'].": " . mysqli_error());
				}
				else{
					$parcial=$parcial+1;
				}


			}
			else{
				$ignorados=$ignorados+1;
			}
									
		set_time_limit(20);
		}
		$regTotal=$parcial+$ignorados;	
		echo "<br>Registros actualizados:".$parcial.':'.$regTotal.'<br>';
		for ($z=0; $z < $errores; $z++) { 
			echo "Precio: ".$listaerr[$z][0].";Cantidad: ".$listaerr[$z][1].";Objeto: ".$listaerr[$z][2],"<br>";
		}
curl_close ($ch); /// closes the connection
mysqli_close($link);
?>