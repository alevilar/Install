<?php echo $this->Form->create('Configuration'); ?>


<div class="row bg-white">
	<div class="col-md-4">

		<h3>Adición</h3>
			<?php


		echo $this->Form->hidden('Site.configurado', array(
			'value' => 1
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
			'label' => __('Al cerrar, o facturar mesa, sacar un remito o imprimir directo en la fiscal'),
			'empty' => __("No hacer nada"),
			));



		echo $this->Form->input('Adicion.cobrada_hide_ms', array(
			'type'=>'number', 
			'label' => __('Ocultar %s al borrar. Indicar milisegundos que permanecerá mostrándose', Configure::read('Mesa.tituloMesa')),
			'after' => __('Si se coloca 0 o se deja vacio, no se va a ir nunca (por ejemplo es válido en un hotel, donde yo quiero seguir viendo %s aunque me hayan pagado). Si se coloca 1, se va inmediatamente',  Inflector::pluralize(Configure::read('Mesa.tituloMesa') ))
			));
			
			?>


	</div>

	<div class="col-md-4">
		<h3><?php echo __("Restaurante")?></h3>

		<?php
		
		

		
		echo $this->Form->input('Restaurante.precision', array(
			'type' => 'number',
			'after' => __('Cantidad de centavos a redondear al sumar productos. Por ejemplo: si se coloca cero, entonces los totales siempre serán redondeados (para arriba).')
			));

		


		echo $this->Form->input('Restaurante.ib', array(
			'type' => 'text',
			'label' => __('Ingresos Brutos'),
			'after' => __('Si se deja vacio no se mostrará nada')
			));

		echo $this->Form->input('Restaurante.iva_responsabilidad', array(
			'options' => $ivaResponsabilidades,
			'label' => __('Responsabilidad Ante el IVA'),			
			));

			?>

				
			<h3><?php echo __('Impresora Fiscal')?></h3>
			<?php

		echo $this->Form->input('Printers.server', array(
			'type'=>'text', 
			'label' => __('Server'),
			'after' => '<span class="text-info">' . __('Dejar "auto". Sino deberá especificar la IP donde se encuentra el servidor de impresión (IP actual: %s)', $this->request->clientIp()) . '</span>',
			));


		echo $this->Form->input('Printers.receipt_id', array(
			'options'=> $printers, 
			'label' => __('Impresora de Comandas por Defecto'),
			'empty' => __('Ninguna'),
			));

		echo $this->Form->input('Printers.fiscal_id', array(
			'options'=> $printers, 
			'label' => __('Impresora Fiscal por Defecto'),
			'empty' => __('Sin Impresora Fiscal'),
			));

		echo $this->Form->input('Printers.compras_id', array(
			'options'=> $printers, 
			'label' => __('Impresora de Compras Donde saldrán los Pedidos'),
			'empty' => __('Sin Impresora de Compras'),
			));

			?>

			<?php if ( $fiscal_printer['Printer']['driver'] == PRINTERS_AFIP ) { ?>
			<h3>Afip * Facturación Electrónica *</h3>
			<?php
			

			echo $this->Form->input('Afip.punto_de_venta', array(
				'type' => 'number',
				'min' => 1,
				'max'=> 100,
				'step' => 1,
				'label' => __('Punto de Venta'),
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
			<?php } ?>




	</div>

	<div class="col-md-4">
		

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

		echo $this->Form->input('Printer.fiscalberry-ip', array(
			'type' => 'text',
			'label' => __('Dirección del host de la paxaprinter')
			));
		?>

	</div>


	<div class="clearfix"></div><br>
	<?php echo $this->Form->button(__('Guardar'), array('type'=>'submit','class'=>'btn btn-success btn-lg btn-block')) ?>
</div>


<?php echo $this->Form->end() ?>