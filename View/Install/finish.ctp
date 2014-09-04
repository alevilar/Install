<div class="install">
	<h2><?php echo $title_for_layout; ?></h2>

<?php if ($installed): ?>
	<p class="success">
	<?php echo __d('croogo', '
		El usuario %s ha sido creado y tiene provilegios administrativos.',
		sprintf('<strong>%s</strong>', $user['User']['username']));
	?>
	</p>

	<p>
		<?php echo __d('croogo', 'Panel de Administración: %s', $this->Html->link(Router::url('/admin', true), Router::url('/admin', true))); ?>
	</p>

	<p>
	<?php
	echo __d('croogo', 'Puedes iniciar con %s o ir a o a %s.',
		$this->Html->link(__d('croogo', 'Configure el sitio'), $urlSettings),
		$this->Html->link(__d('croogo', 'Crear un blog'), $urlBlogAdd)
		);
	?>
	</p>
<?php endif; ?>

	<blockquote>
		<h3><?php echo __d('croogo', 'Recursos'); ?></h3>
		<ul class="bullet">
			<li><?php echo $this->Html->link('http://croogo.org'); ?></li>
			<li><?php echo $this->Html->link('http://wiki.croogo.org/'); ?></li>
			<li><?php echo $this->Html->link('http://github.com/croogo/croogo'); ?></li>
			<li><?php echo $this->Html->link('Alejandor Vilar', 'https://alevilar.com'); ?></li>
		</ul>
	</blockquote>
	&nbsp;
</div>