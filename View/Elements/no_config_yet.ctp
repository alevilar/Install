<?php if ( !Configure::read('Site.configurado') ) { ?>
<div class="alert alert-warning">
	<?php echo __('Parece que aún no configuraste tu Sitio. Por favor, tómate un momento y completa los valores correctos.') ?>
</div>
<?php } ?>