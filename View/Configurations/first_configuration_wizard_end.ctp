
<?php echo $this->element('MtSites.pasos', array('current'=> 4, 'backLink' => array(
		'plugin' => 'product',
		'controller' => 'productos',
		'action' => 'producto_first_time',
)))?>


<div class="content-white">
	
	<h1 class="blue center">¡Ya podés empezar a usar tu comercio!</h1>

<div class="row">
	<div class="col-sm-6 col-sm-offset-1">
		<div class="alert alert-info ">
			<div class="pull-right">
			<?php
			$img = $this->Html->image('/paxapos/img/isologo_rojo.png', array()); 
		                    	echo $this->Html->link($img, '#', array(
		                    			'escape' => false, 
		                    			'class'=>'',
		                    			'data-toggle' => "modal",
		                    			// 'data-target' => "#paxapos-main-menu",
		                    			));

			?>
			</div>
		Y recuerda que siempre podrás configurar tu comercio, instalar nuevas aplicaciones y muchas cosas más desde el menú contextual que aparecerá si precionas sobre el logo de PaxaPos ubicado siempre arriba de todo.
		</div>
	</div>


	<div class="col-sm-5">
	<br><br>
		<?php
		echo $this->Html->link('Ir la Página Principal de '.Configure::read('Site.name'), array(
			'plugin' => 'risto',
			'controller' => 'pages',
			'action' => 'display',
			'dashboard'
		), array(
			'class' => 'btn btn-success btn-lg btn-block'
		));
		?>
	</div>
</div>
</div>