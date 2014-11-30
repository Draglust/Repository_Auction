<div class='lateralleft'>
<?php $caty='';?>
<?php foreach($result as $row):?>
	<?php if($caty!=$row['categoria_nombre']):?>
		<ul><?=$row['categoria_nombre']?>
		<?php foreach($result as $row1):?>
			<?php if($row['categoria_nombre']==$row1['categoria_nombre']):?>
				<?php $enlace=$urlb."mostrar/show/".$row1['categoria_nombre']."/".$row1['subcategoria_nombre'];?>
				<li><a href=<?=$enlace;?>><?=$row1['subcategoria_nombre']?></a></li>
			<?php endif;?>
		<?php endforeach;?>
	<?php endif;?>
</ul>
<?php 
$caty=$row['categoria_nombre'];
endforeach;?>
</div>
<!-- PROBAR STRCMP()-->