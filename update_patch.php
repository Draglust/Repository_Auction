<?php 
//------------------------------------------------------------------------
//SOLO ACTUALIZA LOS REGISTROS CON RUTA,NOMBRE O PARCHE INCOMPLETOS



//------------------------------------------------------------------------

header('Content-Type: text/html; charset=utf-8');
include "phpQuery-onefile.php";
include 'simple_html_dom.php';
$User_Agent = 'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.111 Safari/537.36';
$host="http://eu.battle.net";
$realm="shen'dralar";
$url= $host. "/api/wow/auction/data/". $realm;
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


			$parcial=0;
			$ignorados=0;
			$comprobacion=mysqli_query($link,'select nombre,ruta,id,parche from wowhead order by id');
			
			while($row=mysqli_fetch_array($comprobacion)){
			if (!$row[0] or $row[0]=='' or $row[0]==NULL or $row[1]=='' or $row[3]==0) {
				curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); // tell cURL to return the data
				curl_setopt ($ch, CURLOPT_URL, "http://es.wowhead.com/item=".$row[2]); /// set the URL to download
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); /// Follow any redirects
				curl_setopt($ch, CURLOPT_BINARYTRANSFER, 0); /// tells cURL if the data is binary data or not
				curl_setopt($ch, CURLOPT_USERAGENT, $User_Agent);
				$html = curl_exec($ch); // pulls the webpage from the internet

				
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

				$SCs = pq("script:contains('x20parche')");
					$numParche=count($SCs);
					echo "numero 'x20parche':".$numParche.":";

						for ($i=0; $i < count($SCs) ; $i++) { 
							# code...
						
						$valor=$SCs[$i]->text();
						$pos=strpos($valor, 'parche\x20');
						$pos=$pos+10;
						$patch=substr($valor, $pos,1);
						echo "Expansion:".$patch."<br>";
	  					}
				

				$sql1="update wowhead set parche=".$patch." where id=".$row[2];
				//$sql2="replace into wowhead values('".$row[2]."','".$title."','".$urlRuta."','".$patch."')";
				echo $sql1."<br>";
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