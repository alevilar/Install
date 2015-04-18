<?php echo $this->Form->create('Configuration'); ?>

<div class="btn-group  pull-right" role="group" aria-label="controles">
	<?php echo $this->Form->button(__('Guardar'), array('type'=>'submit','class'=>'btn btn-success')) ?>
	<?php echo $this->Html->link(__('Ir a Configuración Avanzada'), array('action'=>'edit', 'advanced'),array('class'=>'btn btn-primary pull-right')) ?>
</div>

<h1>Configuración del Sitio</h1>

<?php echo $this->element('no_config_yet'); ?>

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


		if ( Configure::read('Site.type') == SITE_TYPE_RESTAURANTE )	 {
			echo $this->Form->input('Restaurante.valorCubierto', array(
				'type' => 'text',
				'label' => __('Valor %s', Configure::read('Mesa.tituloCubierto')),
				'after' => 'Dejar vacío si no se desea mostrar como ítem en la factura. Si se deja un 0, se mostrará en la factura con valor cero.'
				));
		}

		echo $this->Form->input('Restaurante.precision', array(
			'type' => 'number',
			'after' => __('Precisión de los precios. Cantidad de centavos.')
			));


		echo $this->Form->input('Restaurante.mail', array(
			'type' => 'email',
			'empty' => true
			));
			
			?>


			
		<?php
	if ( Configure::read('Site.type') == SITE_TYPE_RESTAURANTE )	 {
		echo $this->Form->input('Printers.receipt_id', array(
			'options'=> $printers, 
			'label' => __('Impresora de Comandas por Defecto')
			));
	}

	echo $this->Form->input('Printers.fiscal_id', array(
		'options'=> $printers, 
		'label' => __('Impresora Fiscal por Defecto')
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

			?>


	</div>

	<div class="col-md-4">
			<h3>Factura Electrónica Afip</h3>
			<?php
			echo $this->Form->input('Afip.default_iva_porcentaje', array(
			'type' => 'number',
			'min' => 0,
			'max'=> 100,
			'step' => 1,
			'label' => __('Porcentaje de IVA aplicado a sus productos'),
			'after' => __('Ingresar solo el valor numérico. EJ: 0, 21, 10.5')
			));


			echo $this->Form->input('Afip.punto_de_venta', array(
				'type' => 'number',
				'min' => 1,
				'max'=> 100,
				'step' => 1,
				'label' => __('Punto de Venta'),
				'after' => 'Número de punto de venta declarado en Afip'
			));


			echo $this->Form->input('Afip.tipofactura_id', array(
				'options' => $tipoFacturas,
				'label' => __('Tipo de Factura por Defecto (Consumidor Final)'),
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
				'after' => __('Formato DD-MM-AAAA')
			));
			?>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
	<?php echo $this->Form->button(__('Guardar'), array('type'=>'submit','class'=>'btn btn-success btn-lg btn-block')) ?>
	
	</div>
</div>
<?php echo $this->Form->end() ?>