<?php echo $this->Form->create('Configuration'); ?>




<?php echo $this->element('MtSites.pasos', array('current'=> 1))?>


<div class="clearfix"></div>
<br><br>
	<div class="col-sm-4">
		<?php

		echo $this->Form->hidden('Site.configurado', array(
			'value' => 1
		));


		echo $this->Form->input('Restaurante.domicilio', array(
			'type' => 'text',
			'class' => 'form-control  input-lg',
			'label' => __('Dirección del Comercio'), 
			'placeholder' => 'Dirección, Localidad, Provincia',
			));
		?>
		<br>

		<?php

		
		
		echo $this->Form->input('Geo.currency_code', array(
			'options' => $currencyCodes,
			'label' => __('Moneda'),
			'class' => 'form-control  input-lg',
		));


		?>
		
	</div>



		


		<div class="col-sm-4">
		<?php

		if ( Configure::read('Site.type') == SITE_TYPE_RESTAURANTE )	 {

			?>

				<div class="form-group">
				    <label for="data[Restaurante][valorCubierto]">Valor del Cubierto o Servicio de Mesa</label>
				    <div class="input-group">
				      <div class="input-group-addon">$</div>
					  <?php echo $this->Form->text('Restaurante.valorCubierto', array(
					  			'placeholder'=>'Ej: 22.50',
					  			'class' => 'form-control input-lg',
					  			));?>
				    </div>
				</div>
			<?php
		}
		?>
		<br>
			<div class="form-group">
			    <label for="data[Restaurante][valorCubierto]">Impuesto aplicado a los productos (IVA)</label>
			    <div class="input-group">
				  <?php echo $this->Form->text('Afip.default_iva_porcentaje', array(
				  			'placeholder'=>'Ej: 21',
				  			'class' => 'form-control input-lg',
				  			));?>
			      <div class="input-group-addon">%</div>
			    </div>
			</div>
		</div>



		<div class="col-sm-4">
			<?php
			echo $this->Form->input('Printers.quiere_imprimir', array(
				'type' => 'radio',
				'default' => 0,
				'label' => '¿Querés imprimir ticket fiscal?',
				'options' => array(
					0 => 'No, primero prefiero probar el sistema',
					1 => 'Si',
					),
			));

			?>


			<?php
			echo $this->Form->input('Printers.quiere_imprimir_comanda', array(
				'type' => 'radio',
				'default' => 0,
				'label' => '¿Querés imprimir órdenes de pedido en la barra/cocina?',
				'options' => array(
					0 => 'No, primero prefiero probar el sistema',
					1 => 'Si',
					),
			));

			?>


			<br>


			<div id="quiere-imprimir" class="alert alert-info" style="display: none;">
				<?php echo $this->Html->image('/risto/css/ristorantino/img/raspberry_nubes.png', array('width'=>'30%', "class"=>"pull-left"));?>
				<h4>
					<span class="glyphicon glyphicon-alert" aria-hidden="true"></span>
					Si necesitás imprimir
				</h4>
				<h5 class="text-primary">¡Te estaremos enviando todos los detalles por mail!</h5>
				<div class="clearfix"></div>
				<p>
				Con el "Servidor de Impresión PaxaPos" podrás emitir tickets desde la nube, incluso aunque se corte internet (en modo offline).
				</p>
			</div>

			<script>

				function mostrarSiEstaSeleccionadoQuiereImprimir() {
					var el = document.getElementById("PrintersQuiereImprimir1");
					if ( el.checked ) {
						$("#quiere-imprimir").show("fade");
					} else {
						$("#quiere-imprimir").hide("fade");
					}
				}

				$("#PrintersQuiereImprimir1").on('change', mostrarSiEstaSeleccionadoQuiereImprimir );

				$("#PrintersQuiereImprimir0").on('change', mostrarSiEstaSeleccionadoQuiereImprimir );

				mostrarSiEstaSeleccionadoQuiereImprimir();
			</script>



		</div>


<?php echo $this->Form->end() ?>

<div class="clearfix"></div>
<br><br><br><br>