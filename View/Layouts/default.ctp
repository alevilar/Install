<?php $this->extend('Risto.base'); ?>


<?php $this->append('paxapos-main-menu');?>
 	<?php echo $this->element("Risto.paxapos_main_menu/home_btn");?>
	<br>
	<h3 class="center blue-8"><?php echo Configure::read("Site.name");?></h3>
    <?php echo $this->element("Risto.paxapos_main_menu/tenant_config");?>
<?php $this->end();?>





<?php echo $this->fetch('content');?>