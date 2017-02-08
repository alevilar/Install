
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
				<?php 
				$modulos = array(
					array(
						'alias' => 'Site.modulo_compras',
						'name' => 'Compras',
						'img_url' => '/risto/css/ristorantino/home/pedidos.png',
						'price' => 0,
						'description'=> "Realiza fácilmente los pedidos a tus proveedores. Administra las compras que realizan los empleados y gestiona los remitos y facturas para tener el control de tus gastos.",
					),
					array(
						'alias' => 'Site.modulo_cajero',
						'name' => 'Cajero',
						'img_url' => '/risto/css/ristorantino/home/caja.png',
						'price' => 0,
						'description'=> "Usa al cajero para realizar cobros fácilmente desde la misma pantalla de adición.",
					),
					array(
						'alias' => 'Site.modulo_arqueo_de_caja',
						'name' => 'Arqueo',
						'img_url' => '/risto/css/ristorantino/home/arqueo.png',
						'price' => 0,
						'description'=> 'El arqueo de caja se combina muy bien con el "Cajero", puesto que permite realizar arqueos, imprimir informes "Zeta" y controlar el dinero en efectivo.',
					),
					array(
						'alias' => 'Site.modulo_impresoras',
						'name' => 'Impresoras',
						'img_url' => '/risto/css/ristorantino/home/impresoras.png',
						'price' => 0,
						'description'=> "Realiza impresiones de tickets fiscales o comandas para los distintos sectores del comercio. Es necesario adquirir la <i>\"PC PaxaPos\"</i>.",
					),
					array(
						'alias' => 'Site.modulo_afip_factura_electronica',
						'name' => 'E-Factura',
						'img_url' => '/risto/css/ristorantino/home/afip_factura_electronica.png',
						'price' => 50,
						'description'=> "Conecta con la AFIP para emitir fácilmente tus facturas electrónicas.",
					),
				);
				
				foreach ($modulos as $modulo) {
					 echo $this->element("Install.tr_row_modulo", array('modulo' => $modulo));
				}
				?>
			</tbody>
		</table>
	</div>
</div>

<div class="clearfix"></div>
<br>
		<br><br><br>
		<?php echo $this->Form->button(__('Guardar Cambios'), array('type'=>'submit','class'=>'btn btn-success btn-lg btn-block')); ?>
</div>


<?php echo $this->Form->end() ?>