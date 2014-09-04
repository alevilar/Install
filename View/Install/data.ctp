<div class="install">
	<h2><?php echo $title_for_layout; ?></h2>

	<p>
	<?php
	echo __d('croogo', 'Cree las tablas y continue.');
	?>
	</p>
</div>
<div class="form-actions">
<?php
echo $this->Html->link(__d('croogo', 'Construir Base de Datos'), array(
	'plugin' => 'install',
	'controller' => 'install',
	'action' => 'data',
	'?' => array('run' => 1),
), array(
	'tooltip' => array(
		'data-title' => __d('croogo', 'Click aqui para volcar estrucutura y datos.'),
		'data-placement' => 'left',
	),
	'button' => 'success',
	'icon' => 'none',
	'onclick' => '$(this).find(\'i\').addClass(\'icon-spin icon-spinner\');',
));
?>
</div>