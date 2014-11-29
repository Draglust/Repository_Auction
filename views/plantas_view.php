<body>
  <table>
  <?php foreach($result as $row):?>
  <tr><td class='grafico' id=<?=$row->catid?>><a href=<?=$urlb.'profesionestesteo/showgrafics/'.$row->catid?>><img height=30px src=<?=$urlb.'application/images/graphic.jpg'?>></td><td><img src=<?=$raizruta.$row->ruta.$extension?>></td></td></td><td>Nombre:<?=$row->nombre?></td><td>Precio:<?=($row->priceAuction)/10000?>g</td><td>Fecha:<?=$row->dateAuction?></td><td>Cantidad:<?=$row->cantidad?></td></tr>
  <tr><td><!--<?php //$this->load->view($grafico)?>--></td></tr>
  
   
 
  <?php endforeach;?>
  </table>
  
</body>
