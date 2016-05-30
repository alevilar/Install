
<?php $this->start('css');?> 
<style>
	.app-list img{
		width: 100%;
		max-width: 100px;
	}
</style>
<?php $this->end();?>
<div class="row bg-white app-list">
<br><br>
<?php echo $this->Form->create('Configuration'); ?>

	<div class="col-sm-2 center col-sm-offset-1">
		<?php
  		$img = $this->Html->image('/risto/css/ristorantino/home/contabilidad.png'); 
		?>
		<?php echo $this->Form->input('Site.modulo_contable', array(
		'div' => array('class' => 'form-group'),
			'class' => 'form-control input-lg',
			'type'=>'checkbox',
			'label' => $img. "<br>Contabilidad",
			));?>
	</div>

	<div class="col-sm-2 center">
		<?php
  		$img =  $this->Html->image('/risto/css/ristorantino/home/arqueo.png'); 
		?>
		<?php echo $this->Form->input('Site.modulo_arqueo_de_caja', array(
		'div' => array('class' => 'form-group'),
			'class' => 'form-control input-lg',
			'type'=>'checkbox',
			'label' => $img. "<br>Arqueo",
			));?>
	</div>
	<div class="col-sm-2 center">
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
	<div class="col-sm-2 center">
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
	<div class="col-sm-2 center">
		<?php
  		$img =  $this->Html->image('/risto/css/ristorantino/home/stats.png'); 
		?>
		<?php echo $this->Form->input('Site.modulo_stats', array(
			'type'=>'checkbox',
			'div' => array('class' => 'form-group'),
			'class' => 'form-control input-lg',
			'label' => $img. "<br>Estadísticas",
			));?>
	</div>

<div class="clearfix"></div>
<br>
		<br><br><br>
		<?php echo $this->Form->button(__('Guardar'), array('type'=>'submit','class'=>'btn btn-success btn-lg btn-block')); ?>
</div>

<div class="row">
	<div class="col-sm-12">
	</div>
</div>
<?php echo $this->Form->end() ?>