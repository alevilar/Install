<h1 class="center">Activar o Desactivar Módulos</h1>



<div class="row">
<?php echo $this->Form->create('Configuration'); ?>

	<div class="col-sm-3 center">
		<div id="bton-adicion">
		<?php
  		$img = $this->Html->image('/risto/css/ristorantino/home/contabilidad.png'); 
		?>
		</div>
		<?php echo $this->Form->input('Site.modulo_contable', array(
		'div' => array('class' => 'form-group'),
			'class' => 'form-control input-lg',
			'type'=>'checkbox',
			'label' => $img. "<br>Contabilidad",
			));?>
	</div>
	<div class="col-sm-3 center">
		<?php
  		$img =  $this->Html->image('/risto/css/ristorantino/home/botonarqueo.png'); 
		?>
		<?php echo $this->Form->input('Site.modulo_arqueo_de_caja', array(
		'div' => array('class' => 'form-group'),
			'class' => 'form-control input-lg',
			'type'=>'checkbox',
			'label' => $img. "<br>Arqueo",
			));?>
	</div>
	<div class="col-sm-3 center">
		<?php
  		$img =  $this->Html->image('/risto/css/ristorantino/home/pedidos.png'); 
		?>
		<?php echo $this->Form->input('Site.modulo_compras', array(
		'div' => array('class' => 'form-group'),
			'class' => 'form-control input-lg',
			'type'=>'checkbox',
			'label' => $img. "<br>Compras",
			));?>
	</div>
	<div class="col-sm-3 center">
		<?php
  		$img =  $this->Html->image('/risto/css/ristorantino/home/caja.png'); 
		?>
		<?php echo $this->Form->input('Site.modulo_cajero', array(
			'type'=>'checkbox',
			'div' => array('class' => 'form-group'),
			'class' => 'form-control input-lg',
			'label' => $img. "<br>Cajero",
			));?>
	</div>

</div>

<div class="row">
	<div class="col-sm-12">
		<br><br><br>
		<?php echo $this->Form->button(__('Guardar'), array('type'=>'submit','class'=>'btn btn-success btn-lg btn-block')); ?>
	</div>
</div>
<?php echo $this->Form->end() ?>