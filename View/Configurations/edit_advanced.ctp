<?php echo $this->Form->create('Configuration'); ?>
<?php echo $this->Form->button(__('Guardar'), array('type'=>'submit','class'=>'btn btn-success pull-right')) ?>
<h1>Configuración Avanzada del Sitio</h1>

<?php echo $this->element('no_config_yet'); ?>


<div class="row">
	
	<div class="col-md-4">
		<h2></h2>

		<h3>Adición</h3>
			<?php


		echo $this->Form->hidden('Site.configurado', array(
			'value' => 1
		));

		echo $this->Form->input('Site.name', array(
			'type'=>'text', 
			'label' => __('Nombre del Sitio')
			));
		
		echo $this->Form->input('Adicion.cantidadCubiertosObligatorio', array(
			'options'=> array(0 => __('No'), 1 => __('Si') ), 
			'label' => __('Es Obligatorio Indicar la Cantidad de %s', Inflector::pluralize(Configure::read('Mesa.tituloCubierto') ) ),
			));

		echo $this->Form->input('Adicion.numeroMesaObligatorio', array(
			'options'=> array( 0 => __('No'), 1 => __('Si')) , 
			'label' => __('Es Obligatorio Describir %s al crear nueva', Inflector::pluralize(Configure::read('Mesa.tituloMesa') ) ),
			'after' => '<span class="text-info">' . __('Por ejemplo, en un Restaurante usariamos un numero de Mesa. Para un monotributista puede ser un identificador de pedido.') . '</span>'
			));

		echo $this->Form->input('Horario.corte_del_dia', array(
			'type' => 'number',
			'label' => __('Indicar la hora de corte del día'),
			'after' => '<span class="text-info">'.__('La hora se tiene en cuenta despues de las 00 hs. Por ejemplo. En un restaurante querremos que las mesas cerradas a las 00:30 hs, sean computadas en el día "anterior". La hora corte del día sirve para indicar a partir de que hora debemos indicar el día siguiente.').'</span>'
			));

		echo $this->Form->input('Mesa.imprimePrimeroRemito', array(
			'options'=> array( 0 => __('Directo a la Fiscal'), 1 => __('Imprimir Remito')) , 
			'label' => __('Al cerrar, o facturar mesa, sacar un remito o imprimir directo en la fiscal') 
			));


		echo $this->Form->input('Geo.currency_code', array(
			'type'=>'text', 
			'length'=>3,
			'label' => __('Código de Moneda')
			));

			
			?>


			<h3><?php echo __("Genérico")?></h3>

			<?php
		echo $this->Form->input('Mesa.tituloMozo', array(
			'type' => 'text',
			'label' => __('Título o nombre de la entidad Vendedora')
			));

		echo $this->Form->input('Mesa.tituloMesa', array(
			'type' => 'text',
			'label' => __('Título o nombre del objeto de Venta')
			));
	
		echo $this->Form->input('Mesa.tituloCubierto', array(
			'type' => 'text',
			'label' => __('Título o nombre del número aplicado al Objeto de Venta')
			));

		echo $this->Form->input('Mesa.tituloCliente', array(
			'type' => 'text',
			'label' => __('Título o nombre del la entidad que compra al Objeto de Venta')
			));


		echo $this->Form->input('Mesa.usar_generica', array(
			'options'=> array( 0 => __('No'), 1 => __('Usar Apertura Veloz')) , 
			'label' => __('Apertura Veloz'),
			'after' => '<span class="text-info">'.__('Crea un boton en la adición para abir  %s rápidamente', Inflector::pluralize( Configure::read('Mesa.tituloMesa')) ).'</span>'
			));

		echo $this->Form->input('Mesa.generica_mozo_id', array(
			'options' => $mozos,
			'label' => __('Seleccionar %s por defecto al abrir %s generica', Configure::read('Mesa.tituloMozo'), Configure::read('Mesa.tituloMesa')),
			));
		?>

	</div>

	<div class="col-md-4">
		<h3><?php echo __("Restaurante")?></h3>

		<?php
		
		echo $this->Form->input('Restaurante.valorCubierto', array(
			'type' => 'text',
			'label' => __('Valor %s', Configure::read('Mesa.tituloCubierto')),
			'after' => 'Dejar vacío si no se desea mostrar como ítem en la factura. Si se deja un 0, se mostrará en la factura con valor cero.'
			));

		
		echo $this->Form->input('Restaurante.precision', array(
			'type' => 'number',
			'after' => __('Cantidad de centavos a redondear al sumar productos. Por ejemplo: si se coloca cero, entonces los totales siempre serán redondeados (para arriba) con el objetivo de que nunca nos de un resultado con centavos. Esto mas que nada sirve en los descuentos.')
			));

		
		echo $this->Form->input('Restaurante.mail', array(
			'type' => 'email',
			'empty' => true
			));

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
			
			<h3><?php echo __('Impresora Fiscal')?></h3>
			<?php

		echo $this->Form->input('Printers.server', array(
			'type'=>'text', 
			'label' => __('Server'),
			'after' => '<span class="text-info">' . __('Dejar "auto". Sino deberá especificar la IP donde se encuentra el servidor de impresión') . '</span>',
			));


		echo $this->Form->input('Printers.receipt_id', array(
			'options'=> $printers, 
			'label' => __('Impresora de Comandas por Defecto')
			));

		echo $this->Form->input('Printers.fiscal_id', array(
			'options'=> $printers, 
			'label' => __('Impresora Fiscal por Defecto')
			));

			?>

			
			<h3>Afip</h3>
			<?php
			echo $this->Form->input('Afip.default_iva_porcentaje', array(
			'type' => 'number',
			'min' => 0,
			'max'=> 100,
			'step' => 1,
			'label' => __('Porcentaje de IVA'),
			'after' => __('EJ: 0, 21, 10.5')
			));


			echo $this->Form->input('Afip.punto_de_venta', array(
				'type' => 'number',
				'min' => 1,
				'max'=> 100,
				'step' => 1,
				'label' => __('Punto de Venta'),
			));



			echo $this->Form->input('Afip.tipofactura_id', array(
				'options' => $tipoFacturas,
				'label' => __('Tipo de Factura por Defecto'),
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