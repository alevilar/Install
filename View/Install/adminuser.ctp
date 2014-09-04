<?php
if(empty($this->request->data))
{


echo $this->Form->create(null, array(
	'url' => array('controller' => 'install', 'action' => 'adminuser'),
	));
?>
<div class="install">

    <?php echo __d('croogo', 'Nota: Por defecto se creo el usuario admin con contraseña admin, sin embargo usted puede crear otro usuario personalizado.'); ?>

	<h2><?php echo __d('croogo', 'Paso 3: Crear un Usuario Admin.'); ?></h2>
	<?php
		$this->Form->inputDefaults(array(
			'label' => false,
			'class' => 'span10',
		));
		echo $this->Form->input('User.username', array(
			'placeholder' => __d('croogo', 'Nombre de Usuario'),
			'before' => '<span class="add-on"><i class="icon-user"></i></span>',
			'div' => 'input text input-prepend',
		));
		echo $this->Form->input('User.password', array(
			'placeholder' => __d('croogo', 'Nueva Contraseña'),
			'value' => '',
			'before' => '<span class="add-on"><i class="icon-key"></i></span>',
			'div' => 'input password input-prepend',
		));
		echo $this->Form->input('User.verify_password', array(
			'placeholder' => __d('croogo', 'Verificar Contraseña'),
			'type' => 'password',
			'value' => '',
			'before' => '<span class="add-on"><i class="icon-key"></i></span>',
			'div' => 'input password input-prepend',
		));
	?>
</div>
<div class="form-actions">
	<?php echo $this->Form->submit(__d('croogo', 'Guardar'), array('class' => 'btn btn-success', 'div' => false)); ?>
	<?php echo $this->Html->link(__d('croogo', 'Cancelar'), array('action' => 'index'), array( 'class' => 'btn cancel')); ?>
</div>
<?php
	echo $this->Form->end();

}
else
{
 ?>
    <?php echo $this->Html->link(__d('croogo', 'Ingresar'), array('admin'=>false,'plugin'=>false,'controller'=>'users','action' => 'login'), array( 'class' => 'success')); ?>
<?php
}
    ?>