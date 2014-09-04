<?php
echo $this->Form->create(false, array(
	'url' => array(
		'plugin' => 'install',
		'controller' => 'install',
		'action' => 'database'
	),
), array(
	'class' => 'inline',
));
?>
<div class="install">
	<h2><?php echo $title_for_layout; ?></h2>

	<?php if ($currentConfiguration['exists']):  ?>
		<div class="alert alert-warning">
			<strong><?php echo __d('croogo', 'Advertencia.'); ?>:</strong>
			<?php echo __d('croogo', '`database.php` Ya existe.'); ?>
			<?php
			if ($currentConfiguration['valid']):
				$valid = __d('croogo', 'Valido');
				$class = 'text-success';
			else:
				$valid = __d('croogo', 'Invalido');
				$class = 'text-error';
			endif;
			echo __d('croogo', 'This file is %s.', $this->Html->tag('span', $valid, compact('class')));
			?>
			<?php if ($currentConfiguration['valid']): ?>
			<?php
				echo $this->Html->link(
					__d('croogo', 'Reuse este archivo y proceda.'),
					array('action' => 'data')
				);
			?>
			<?php else: ?>
				<?php echo __d('croogo', 'This file will be replaced.'); ?>
			<?php endif; ?>
		</div>
	<?php endif; ?>

	<?php
		$this->Form->inputDefaults(array(
			'label' => false,
			'class' => 'span10',
		));
		echo $this->Form->input('datasource', array(
			'placeholder' => __d('croogo', 'Database'),
			'default' => 'Database/Mysql',
			'empty' => false,
			'class' => false,
			'options' => array(
				'Database/Mysql' => 'mysql',
				'Database/Sqlite' => 'sqlite',
				'Database/Postgres' => 'postgres',
				'Database/Sqlserver' => 'mssql',
			),
		));
		echo $this->Form->input('host', array(
			'placeholder' => __d('croogo', 'Servidor'),
			'default' => 'localhost',
			'tooltip' => __d('croogo', 'Nombre de Ip de la maquina servidor'),
			'before' => '<span class="add-on"><i class="icon-home"></i></span>',
			'div' => 'input input-prepend',
		));
		echo $this->Form->input('login', array(
			'placeholder' => __d('croogo', 'Usuario'),
			'default' => 'root',
			'tooltip' => __d('croogo', 'Accesos a la base de datos'),
			'before' => '<span class="add-on"><i class="icon-user"></i></span>',
			'div' => 'input input-prepend',
		));
		echo $this->Form->input('password', array(
			'placeholder' => __d('croogo', 'Contraseña'),
			'tooltip' => __d('croogo', 'Database password'),
			'before' => '<span class="add-on"><i class="icon-key"></i></span>',
			'div' => 'input input-prepend',
		));
		echo $this->Form->input('database', array(
			'placeholder' => __d('croogo', 'Base de datos'),
			'default' => 'croogo',
			'tooltip' => __d('croogo', 'Base de datos'),
			'before' => '<span class="add-on"><i class="icon-briefcase"></i></span>',
			'div' => 'input input-prepend',
		));
		echo $this->Form->input('prefix', array(
			'placeholder' => __d('croogo', 'Prefijo de Tabla'),
			'tooltip' => __d('croogo', 'Table prefix (leave blank if unknown)'),
			'before' => '<span class="add-on"><i class="icon-minus"></i></span>',
			'div' => 'input input-prepend',
		));
		echo $this->Form->input('port', array(
			'placeholder' => __d('croogo', 'Puerto'),
			'tooltip' => __d('croogo', 'Nombre de puerto (dejelo en blanco si lo desconoce)'),
			'before' => '<span class="add-on"><i class="icon-asterisk"></i></span>',
			'div' => 'input input-prepend',
		));
	?>
</div>
<div class="form-actions">
	<?php echo $this->Form->submit('Submit', array('button' => 'success', 'div' => 'input submit')); ?>
</div>
<?php echo $this->Form->end(); ?>