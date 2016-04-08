<?php echo $this->Form->create('Configuration'); ?>


<h1 class="center text-success" style="border-bottom: 2px solid #2e8924; padding-bottom: 6px; ">Setup Inicial</h1>


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
				'label' => __('($) Valor del Cubierto o Servicio de Mesa'),
				));
		}


		echo $this->Form->input('Restaurante.mail', array(
			'type' => 'email',
			'label' => __('Mail de la Empresa'),
			'empty' => true
			));
			


		echo $this->Form->input('Afip.tipo_factura_id', array(
			'options' => $tipoFacturas,
			'label' => __('Tipo de Factura por Defecto (Consumidor Final)'),
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

		echo $this->Form->input('Printers.fiscal_id', array(
			'options'=> $printers, 
			'empty' => __('Sin Impresora Fiscal'),
			'label' => __('Impresora Fiscal por Defecto'),
			'after' => __('<span class="text-info">Probablemente quieras agregar, quitar o configurar tus impresoras %s</span>', $this->Html->link(__('haciendo click aquí'), array('plugin'=>'printers', 'controller'=>'printers', 'action'=>'index'),array('escape'=>false))),
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