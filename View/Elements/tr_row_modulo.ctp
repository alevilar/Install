
<tr>
	<td>
		<?php
	  		$img = $this->Html->image($modulo['img_url']); 
	  		echo $this->Form->label($modulo['alias'], $img, array('escape'=>false));
		?>	
	</td>
	<td class="center">
		<?php 
		echo $this->Form->label($modulo['alias'], "Instalar<br>");
		echo $this->Form->checkbox($modulo['alias'], array(
				));?>
	</td>
	<td class="center"><b><?php echo $modulo['name'] ?></b></td>
	<td class="center">
		<?php if ($modulo['price'] == 0) { ?>
			<b><?php echo __("¡GRATIS!");?></b>
		<?php } else {?>
			<b><?php echo $this->Number->currency($modulo['price']);?></b>
			<br>
			<?php echo __("Mensual");?>
		<?php } ?>
	</td>
	<td>
	<?php echo $modulo['description']; ?>
	</td>
</tr>