<ul class="nav nav-tabs  nav-justified">

  <?php $class = $this->request->action == 'edit' && !count($this->request->params['pass']) ? 'active':'';?>
  <li role="presentation" class="<?php echo $class?>">
  	<?php echo $this->Html->link('Configuración Básica', array('plugin'=>'install', 'controller'=>'configurations', 'action'=>'edit'));?>
  </li>

   <?php $class = $this->request->action == 'edit' && count($this->request->params['pass']) && $this->request->params['pass'][0] == 'advanced' ? 'active':'';?>
  <li role="presentation" class="<?php echo $class?>">
  	<?php echo $this->Html->link('Configuración Avanzada', array('plugin'=>'install', 'controller'=>'configurations', 'action'=>'edit', 'advanced'));?>
  </li>


   <?php $class = $this->request->action == 'modulos' ? 'active':'';?>
  <li role="presentation" class="<?php echo $class?>">
  	<?php echo $this->Html->link('Instalar/Desinstalar App´s', array('plugin'=>'install', 'controller'=>'configurations', 'action'=>'modulos'));?>
  </li>


</ul>
        
