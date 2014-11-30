<?php 


header('Content-Type: text/html; charset=utf-8');
include "phpQuery-onefile.php";
include 'simple_html_dom.php';
$User_Agent = 'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.111 Safari/537.36';
$host="http://eu.battle.net";
$realm="shen'dralar";
$url= "https://eu.api.battle.net/wow/auction/data/shen'dralar?locale=es_ES&apikey=8hw8e9kun6sf8kfh2qvjzw22b9wzzjek";
$server = 'localhost';
$urlRuta='';
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
		foreach($contenido['auctions']['auctions']as $alianza){
		//foreach($contenido['alliance']['auctions']as $alianza){

				/*echo "http://es.wowhead.com/item=".$alianza['item']."+ Precio:".$alianza['buyout']/$alianza['quantity'].'<br>';*/
			$comprobacion=mysqli_query($link,'select nombre,ruta from wowhead where id='.$alianza['item']);
			$row=mysqli_fetch_array($comprobacion);
			if (!$row[0] or $row[0]=='' or $row[0]==NULL or $row[1]=='') {
				curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); // tell cURL to return the data
				curl_setopt ($ch, CURLOPT_URL, "http://es.wowhead.com/item=".$alianza['item']); /// set the URL to download
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); /// Follow any redirects
				curl_setopt($ch, CURLOPT_BINARYTRANSFER, 0); /// tells cURL if the data is binary data or not
				curl_setopt($ch, CURLOPT_USERAGENT, $User_Agent);
				$html = curl_exec($ch); // pulls the webpage from the internet

				
				curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); // tell cURL to return the data
				curl_setopt ($ch, CURLOPT_URL, "http://es.wowhead.com/item=".$alianza['item']."&xml"); /// set the URL to download
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); /// Follow any redirects
				curl_setopt($ch, CURLOPT_BINARYTRANSFER, 0); /// tells cURL if the data is binary data or not
				curl_setopt($ch, CURLOPT_USERAGENT, $User_Agent);
				$xml = curl_exec($ch);
				$xmll=simplexml_load_string($xml);
				$urlRuta=$xmll->item->icon;
				


				phpQuery::newDocument($html);
				$titleElement='';
				$titleElement = pq('h1.heading-size-1');
				$title = $titleElement->text();
				$title=str_replace("'", "", $title);//Modificar el nombre del objeto para que no contenga comillas simples
				
				if($titleElement==''){
					echo 'Titulo de elemento no encontrado<br>';
				}
				else{
					echo $title." : ";
				}

				$sql1="replace into wowhead(id,nombre,ruta) values(".$alianza['item'].",'".$title."','".$urlRuta."')";
				$sentencia=mysqli_query($link,$sql1);
				if (!$sentencia) {
		    		print('Consulta 1 no valida: ' . mysqli_error());
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
curl_close ($ch); /// closes the connection
mysqli_close($link);
?>