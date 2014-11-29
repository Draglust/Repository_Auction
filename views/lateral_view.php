<div class='lateralleft'>
<?php $caty='';?>
<?php foreach($result as $row):?>
	<?php if($caty!=$row->categoria):?>
		<ul><?=$row->categoria?>
		<?php foreach($result as $row1):?>
			<?php if($row->categoria==$row1->categoria):?>
				<li><?=$row1->subcategoria?></li>
			<?php endif;?>
		<?php endforeach;?>
	<?php endif;?>
</ul>
<?php 
$caty=$row->categoria;
endforeach;?>
</div>
<!-- PROBAR STRCMP()-->