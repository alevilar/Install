
<?php $this->start('css');?> 
<style>
	.app-list .destacados img{
		width: 100%;
		max-width: 120px;
	}

	.app-list table img{
		width: 48px;
	}
</style>
<?php $this->end();?>
<div class="bg-white app-list">
<br><br>
<?php echo $this->Form->create('Configuration'); ?>

<div class="row destacados">
	<h1 class="center">Destacadas</h1>
	
	<div class="col-sm-2 center">
		<?php
  		$img =  $this->Html->image('/risto/css/ristorantino/home/contabilidad.png'); 
  		echo $this->Form->label("Site.modulo_contable", $img, array('escape'=>false));
		?>
	</div>
	<div class="col-sm-4">
	<h4 class="center">Contabilidad</h4>
		Con el módulo contable podrás administrar los gastos y pagos. realizar cierres mensuales y analizar la clasificación de los gastos. Es indispensable para controlar la contabilidad básica de tu empresa
		<div class="center">
		<br>
		<?php 
		echo $this->Form->label("Site.modulo_contable", 'Instalar GRATIS&nbsp;&nbsp;');
		echo $this->Form->checkbox('Site.modulo_contable', array(
		
			));?>
			</div>
	</div>


	<div class="col-sm-2 center">
	<?php
  		$img = $this->Html->image('/risto/css/ristorantino/home/stats.png'); 
  		echo $this->Form->label("Site.modulo_stats", $img, array('escape'=>false));
	?>		
	</div>

	<div class="col-sm-4">
		<h4 class="center">Estadísticas</h4>
		Mira la gráfica de ventas, gastos, cobros, pagos y los impuestos que debes pagar.
		<div class="center">
		<br>
		<?php 
		echo $this->Form->label("Site.modulo_stats", 'Instalar GRATIS&nbsp;&nbsp;');
		echo $this->Form->checkbox('Site.modulo_stats', array(
			));?>
			</div>
	</div>

</div>
	<div class="clearfix"></div>

	<br><br>
<div class="row">
	<div class="col-md-10 col-md-offset-1">
		<h3 class="center">Otras Apps</h3>
		<table class="table">
			<tbody>
				<tr>
					<td>
						<?php
					  		$img = $this->Html->image('/risto/css/ristorantino/home/pedidos.png'); 
					  		echo $this->Form->label("Site.modulo_compras", $img, array('escape'=>false));
						?>	
					</td>
					<td class="center">
						<?php 
						echo $this->Form->label("Site.modulo_compras", "Instalar<br>");
						echo $this->Form->checkbox('Site.modulo_compras', array(
								));?>
					</td>
					<td class="center"><b>Compras</b></td>
					<td class="center"><b>¡GRATIS!</b></td>
					<td>
					Realiza fácilmente los pedidos a tus proveedores. Administra las compras que realizan los empleados y gestiona los remitos y facturas para tener el control de tus gastos.
					</td>
				</tr>

				<tr>
					<td>
						<?php
					  		$img = $this->Html->image('/risto/css/ristorantino/home/caja.png'); 
					  		echo $this->Form->label("Site.modulo_cajero", $img, array('escape'=>false));
						?>	
					</td>
					<td class="center">
						<?php 
						echo $this->Form->label("Site.modulo_cajero", "Instalar<br>");
						echo $this->Form->checkbox('Site.modulo_cajero', array(
								));?>
					</td>
					<td class="center"><b>Cajero</b></td>
					<td class="center"><b>¡GRATIS!</b></td>
					<td>
					Usa al cajero para realizar cobros fácilmente desde la misma pantalla de adición.
					</td>
				</tr>

				<tr>
					<td>
						<?php
					  		$img = $this->Html->image('/risto/css/ristorantino/home/arqueo.png'); 
					  		echo $this->Form->label("Site.modulo_arqueo_de_caja", $img, array('escape'=>false));
						?>	
					</td>
					<td class="center">
						<?php 
						echo $this->Form->label("Site.modulo_arqueo_de_caja", "Instalar<br>");
						echo $this->Form->checkbox('Site.modulo_arqueo_de_caja', array(
								));?>
					</td>
					<td class="center"><b>Arqueo</b></td>
					<td class="center"><b>¡GRATIS!</b></td>
					<td>
					El arqueo de caja se combina muy bien con el "Cajero", puesto que permite realizar arqueos, imprimir informes "Zeta" y controlar el dinero en efectivo.
					</td>
				</tr>


			</tbody>
		</table>
	</div>
</div>

<div class="clearfix"></div>
<br>
		<br><br><br>
		<?php echo $this->Form->button(__('Guardar'), array('type'=>'submit','class'=>'btn btn-success btn-lg btn-block')); ?>
</div>


<?php echo $this->Form->end() ?>