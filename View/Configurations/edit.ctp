<?php echo $this->Form->create('Configuration'); ?>



<div class="row">
	
	<div class="col-md-4">
		<h3><?php echo __('General')?></h3>
		<?php

		echo $this->Form->hidden('Site.configurado', array(
			'value' => 1
		));

		echo $this->Form->input('Site.name', array(
			'type'=>'text', 
			'label' => __('Nombre de Fantasía')
			));
		?>


		<?php
		echo $this->Form->input('Restaurante.mail', array(
			'type' => 'email',
			'label' => __('Mail de la Empresa'),
			'empty' => true
			));
		?>

		<?php

		if ( Configure::read('Site.type') == SITE_TYPE_RESTAURANTE )	 {

			?>

				<div class="form-group">
				    <label for="data[Restaurante][valorCubierto]">Valor del Cubierto o Servicio de Mesa</label>
				    <div class="input-group">
				      <div class="input-group-addon">$</div>
					  <?php echo $this->Form->text('Restaurante.valorCubierto', array(
					  			'placeholder'=>'Ej: 22.50',
					  			'class' => 'form-control',
					  			));?>
				    </div>
				</div>
			<?php
		}
		?>


		<?php
		echo $this->Form->input('Geo.currency_code', array(
			'options' => $currencyCodes,
			'label' => __('Moneda'),
		));

		?>
	</div>

	<div class="col-md-4">
		<h3><?php echo __('Datos Empresa')?></h3>
		<?php

		echo $this->Form->input('Restaurante.razon_social', array(
			'type' => 'text',
			));
		echo $this->Form->input('Restaurante.cuit', array(
			'type' => 'text',
			));

		echo $this->Form->input('Restaurante.domicilio', array(
			'type' => 'text',
			'label' => __('Domicilio Comercial')
			));

		echo $this->Form->input('Restaurante.domicilio_fiscal', array(
			'type' => 'text',
			'label' => __('Domicilio Fiscal')
			));

		?>


	</div>

	<div class="col-md-4">


	<h3>Fiscal</h3>

		<?php

		echo $this->Form->input('Afip.tipo_factura_id', array(
			'options' => $tipoFacturas,
			'label' => __('Tipo de Factura por Defecto (Consumidor Final)'),
		));
		?>


		<div class="form-group">
		    <label for="data[Restaurante][valorCubierto]">Impuesto aplicado a los productos (IVA)</label>
		    <div class="input-group">
			  <?php echo $this->Form->text('Afip.default_iva_porcentaje', array(
			  			'placeholder'=>'Ej: 21',
			  			'class' => 'form-control',
			  			));?>
		      <div class="input-group-addon">%</div>
		    </div>
		</div>

		<?php

		echo $this->Form->input('Printers.fiscal_id', array(
			'options'=> $printers, 
			'empty' => __('Sin Impresora Fiscal'),
			'label' => __('Impresora Fiscal por Defecto'),
			));

		echo $this->Form->input('Printers.receipt_id', array(
			'options'=> $printers, 
			'label' => __('Impresora de Comandas por Defecto'),
			'empty' => __('Sin Impresora de Comandas'),
			));



		?>

		<?php if ( $fiscal_printer['Printer']['driver'] == PRINTERS_AFIP ) { ?>
			<h3>Factura Electrónica Afip</h3>
			<?php
			

			echo $this->Form->input('Afip.punto_de_venta', array(
				'type' => 'number',
				'min' => 1,
				'max'=> 100,
				'step' => 1,
				'label' => __('Punto de Venta'),
				'after' => 'Número de punto de venta declarado en Afip'
			));



			echo $this->Form->input('Restaurante.ib', array(
				'type' => 'text',
				'label' => __('Ingresos Brutos'),
				'after' => __('Si se deja vacio no se mostrará nada')
				));

			echo $this->Form->input('Restaurante.iva_responsabilidad', array(
				'options' => $ivaResponsabilidades,
				'label' => __('Responsabilidad Ante el IVA'),
				'after' => 'Dejar vacío si no se desea mostrar como ítem en la factura. Si se deja un 0, se mostrará en la factura con valor cero.'
				));



			echo $this->Form->input('Afip.concepto', array(
				'options' => array(
					1 => 'Productos',
					2 => 'Servicios',
					3 => 'Productos y Servicios',
					4 => 'Otro',
					),
				'label' => __('Concepto de la Factura'),
			));

			echo $this->Form->input('Afip.inicio_actividades', array(
				'type' => 'text',
				'label' => __('Inicio de Actividades'),
				'after' => __('Formato DD-MM-AAAA o DD/MM/AAAA')
			));


			?>
		<?php } ?>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
	<?php echo $this->Form->button(__('Guardar'), array('type'=>'submit','class'=>'btn btn-success btn-lg btn-block')) ?>
	
	</div>
</div>
<?php echo $this->Form->end() ?>