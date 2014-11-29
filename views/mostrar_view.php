  <table class='midtable'>
  <tr><td></td><td></td><td>Nombre</td><td>Precio</td><td>Fecha</td><td>Cantidad</td></tr>
  <?php if(count($result)>0){foreach($result as $row):?>
  <tr><td class='grafico' id=<?=$row['catid']?>><a href=<?=$urlb.'profesionestesteo/showgrafics/'.$row['catid']?>><img height=25px src=<?=$urlb.'application/images/graphic_gold.jpg'?>></a><img class='itemstatus' src=<?=$urlb.'application/images/'.$row['clase'].'.png'?>></td><td><img src=<?=$raizruta.$row['ruta'].$extension?>></td></td></td><td><?=$row['nombre']?></td><td><?=round(($row['priceAuction']/10000),2)?>g</td><td><?=$row['dateAuction']?></td><td><?=$row['cantidad']?></td></tr>
  
  
   
 
  <?php endforeach;}?>
  </table>
  

