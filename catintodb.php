<?php 


header('Content-Type: text/html; charset=utf-8');
include "phpQuery-onefile.php";
include 'simple_html_dom.php';
$User_Agent = 'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.111 Safari/537.36';
$server = 'localhost';
$totalr=0;
$regist=0;
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
			$contador=0;
			$comprobacion=mysqli_query($link,'select id,nombre from wowhead');
			while ($row=mysqli_fetch_array($comprobacion)) {
				$cat=mysqli_query($link,'select idWow,categoria from category where idWow='.$row[0]);
				$fila=mysqli_fetch_row($cat);
				echo $fila[1].'<br>';
				if($fila[1]==''){

					curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); // tell cURL to return the data
					curl_setopt ($ch, CURLOPT_URL, "http://es.wowhead.com/item=".$row[0]); /// set the URL to download
					curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); /// Follow any redirects
					curl_setopt($ch, CURLOPT_BINARYTRANSFER, 0); /// tells cURL if the data is binary data or not
					curl_setopt($ch, CURLOPT_USERAGENT, $User_Agent);
					$html = curl_exec($ch); // pulls the webpage from the internet

					phpQuery::newDocument($html);
					//$titleElement='';
					
					$LIs = pq("script:contains('breadcrumb')");
					echo count($LIs)." : ";
					//echo $LIs[0]->text();
					$valor=$LIs[0]->text();
					$pos=strpos($valor, 'parche\x20');
					$pos=$pos+10;
					$patch=substr($valor, $pos,1);
					echo $patch;
	  				error_reporting(0);
					list($miga[0],$miga[1],$miga[2],$miga[3],$miga[4],$miga[5])=explode(',',$criba3);
					$valNombre='';
					$subNombre='';
					echo "Total numeros:".$miga[2]." : ".$miga[3]."...<br>";
					error_reporting(-1);
					//for ($i=2; $i <count($miga) ; $i++) { 
							
							switch ($miga[2]) {
	   							case 2:
							        $valNombre='Armas';
							        switch ($miga[3]) {
							         	case 15:
							         		$subNombre='Dagas';
							         		break;
							         	case 13:
							         		$subNombre='Armas_de_puño';
							         		break;
							         	case 0:
							         		$subNombre='Hachas_de_una_mano';
							         		break;
							         	case 4:
							         		$subNombre='Mazas_de_una_mano';
							         		break;
							         	case 7:
							         		$subNombre='Espadas_de_una_mano';
							         		break;
							         	case 6:
							         		$subNombre='Armas_de_asta';
							         		break;
							         	case 10:
							         		$subNombre='Bastones';
							         		break;
							         	case 1:
							         		$subNombre='Hachas_de_dos_manos';
							         		break;
							         	case 5:
							         		$subNombre='Mazas_de_dos_manos';
							         		break;
							         	case 8:
							         		$subNombre='Espadas_de_dos_manos';
							         		break;
							         	case 2:
							         		$subNombre='Arcos';
							         		break;
							         	case 18:
							         		$subNombre='Ballestas';
							         		break;
							         	case 3:
							         		$subNombre='Armas_de_fuego';
							         		break;
							         	case 19:
							         		$subNombre='Varitas';
							         		break;
							         	case 20:
							         		$subNombre='Cañas_de_pescar';
							         		break;
							         	case 14:
							         		$subNombre='Miscelanea';
							         		break;
							         	default:
							         		echo "Subcategoria2 no contemplada".$miga[3]."<br>";
							         		break;
							         } 
							    break;   
							    case 4:
							        $valNombre='Armaduras';
							        switch ($miga[3]) {
							        	case 1:
							        		$subNombre='Tela';
							        		break;
							        	case 2:
							        		$subNombre='Cuero';
							        		break;
							        	case 3:
							        		$subNombre='Malla';
							        		break;
							        	case 4:
							        		$subNombre='Placas';
							        		break;
							        	case -3:
							        		$subNombre='Amuletos';
							        		break;
							        	case -2:
							        		$subNombre='Anillos';
							        		break;
							        	case -4:
							        		$subNombre='Abalorios';
							        		break;
							        	case -6:
							        		$subNombre='Capas';
							        		break;
							        	case -5:
							        		$subNombre='Mano_izquierda';
							        		break;
							        	case 6:
							        		$subNombre='Escudos';
							        		break;
							        	case -8:
							        		$subNombre='Camisas';
							        		break;
							        	case -7:
							        		$subNombre='Tabardos';
							        		break;
							        	case 5:
							        		$subNombre='Cosmetico';
							        		break;
							        	case 0:
							        		$subNombre='Miscelanea';
							        		break;
							        	
							        	default:
							        		echo "Subcategoria4 no contemplada".$miga[3]."<br>";
							        		break;
							        }
							    break;
							    case 1:
							        $valNombre='Contenedores';
							    break;
							    case 0:
							        $valNombre='Consumibles';
							        switch ($miga[3]) {
							        	case 5:
							        		$subNombre='Comidas_y_bebidas';
							        		break;
							        	case 0:
							        		$subNombre='Consumibles';
							        		break;
							        	case 2:
							        		$subNombre='Elixires';
							        		break;
							        	case 3:
							        		$subNombre='Frascos';
							        		break;
							        	case 6:
							        		$subNombre='Mejoras_permanentes';
							        		break;
							        	case -3:
							        		$subNombre='Mejoras_temporales';
							        		break;
							        	case 8:
							        		$subNombre='Otros';
							        		break;
							        	case 4:
							        		$subNombre='Pergaminos';
							        		break;
							        	case 1:
							        		$subNombre='Pociones';
							        		break;
							        	case 7:
							        		$subNombre='Vendas';
							        		break;
							        	
							        	default:
							        		echo "Subcategoria no contemplada".$miga[3]."<br>";
							        		break;
							        }
							    break;
							    case 16:
							        $valNombre='Glifos';
							    break;
							    case 7:
							        $valNombre='Objetos_Comerciables';
							        switch ($miga[3]) {
							        	case 8:
							        		$subNombre='Carne';
							        		break;
							        	case 6:
							        		$subNombre='Cuero';
							        		break;
							        	case 10:
							        		$subNombre='Elemental';
							        		break;
							        	case 12:
							        		$subNombre='Encantamiento';
							        		break;
							        	case 14:
							        		$subNombre='Encantamiento_armaduras';
							        		break;
							        	case 15:
							        		$subNombre='Encantamiento_armas';
							        		break;
							        	case 2:
							        		$subNombre='Explosivos';
							        		break;
							        	case 9:
							        		$subNombre='Hierbas';
							        		break;
							        	case 3:
							        		$subNombre='Instrumentos';
							        		break;
							        	case 4:
							        		$subNombre='Joyeria';
							        		break;
							        	case 13:
							        		$subNombre='Materiales';
							        		break;
							        	case 7:
							        		$subNombre='Metal_y_piedra';
							        		break;
							        	case 11:
							        		$subNombre='Otros';
							        		break;
							        	case 1:
							        		$subNombre='Piezas';
							        		break;
							        	case 5:
							        		$subNombre='Tela';
							        		break;
							        	
							        	default:
							        		echo "Subcategoria no contemplada".$miga[3]."<br>";
							        		break;
							        }
							    break;
							    case 9:
							        $valNombre='Recetas';
							        switch ($miga[3]) {
							        	case 6:
							        		$subNombre='Alquimia';
							        		break;
							        	case 5:
							        		$subNombre='Cocina';
							        		break;
							        	case 8:
							        		$subNombre='Encantamiento';
							        		break;
							        	case 4:
							        		$subNombre='Herreria';
							        		break;
							        	case 3:
							        		$subNombre='Ingenieria';
							        		break;
							        	case 11:
							        		$subNombre='Inscripcion';
							        		break;
							        	case 10:
							        		$subNombre='Joyeria';
							        		break;
							        	case 0:
							        		$subNombre='Libros';
							        		break;
							        	case 12:
							        		$subNombre='Mineria';
							        		break;
							        	case 1:
							        		$subNombre='Peleteria';
							        		break;
							        	case 9:
							        		$subNombre='Pesca';
							        		break;
							        	case 7:
							        		$subNombre='Primeros_auxilios';
							        		break;
							        	case 2:
							        		$subNombre='Sastreria';
							        		break;
							        	
							        	default:
							        		echo "Subcategoria no contemplada".$miga[3]."<br>";
							        		break;
							        }
							    break;
							    case 3:
							        $valNombre='Gemas';
							        switch ($miga[3]) {
							        	case 6:
							        		$subNombre='Meta';
							        		break;
							        	case 0:
							        		$subNombre='Roja';
							        		break;
							        	case 1:
							        		$subNombre='Azul';
							        		break;
							        	case 2:
							        		$subNombre='Amarilla';
							        		break;
							        	case 3:
							        		$subNombre='Morada';
							        		break;
							        	case 4:
							        		$subNombre='Verde';
							        		break;
							        	case 5:
							        		$subNombre='Naranja';
							        		break;
							        	case 8:
							        		$subNombre='Centelleante';
							        		break;
							        	case 10:
							        		$subNombre='Engranaje';
							        		break;
							        	case 7:
							        		$subNombre='Simple';
							        		break;
							        	
							        	default:
							        		echo "Subcategoria no contemplada".$miga[3]."<br>";
							        		break;
							        }
							    break;
							    case 15:
							        $valNombre='Miscelanea';
							        switch ($miga[3]) {
							        	case 0:
							        		$subNombre='Chatarra';
							        		break;
							        	case 5:
							        		$subNombre='Monturas';
							        		break;
							        	case 2:
							        		$subNombre='Compañeros';
							        		break;
							        	
							        	default:
							        		echo "Subcategoria no contemplada".$miga[3]."<br>";
							        		break;
							        }
							    break;
							    case 10:
							        $valNombre='Monedas';
							    break;
							    case 12:
							        $valNombre='Mision';
							    break;
							    case 13:
							        $valNombre='Llaves';
							    break;
							    default:
							    	echo "Categoria no contemplada".$miga[2].":".$miga[3]."<br>";
							  	break;
					}
					$contador=$contador+1;
					$totalr=$totalr+1;
					echo  $row[1]."=>".$valNombre."=>".$subNombre."<br>";
					$sqlin="replace into category values ('".$row[0]."','".$valNombre."','".$subNombre."')";
					$insercion=mysqli_query($link,$sqlin);
					if (!$insercion) {
					    die('Algo fue mal mientras se insertaba la consulta');
					}
					set_time_limit(20);
				
				}
				else{
					$totalr=$totalr+1;
				}

			}				
			echo "Total: ".$contador." de ".$totalr." registros<br>";
		

curl_close ($ch); /// closes the connection
mysqli_free_result($comprobacion);
mysqli_free_result($cat);
mysqli_close($link);
?>