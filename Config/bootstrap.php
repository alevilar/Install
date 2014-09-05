<?php
// Copia estos dos files para poder arrancar el instalador sin depender del arranque del plugin risto
copy(App::pluginPath('Install') . 'Config' . DS . 'Docs' . DS . 'AppController.php', APP . 'Controller' . DS . 'AppController.php');
copy(App::pluginPath('Install') . 'Config' . DS . 'Docs' . DS . 'AppModel.php', APP . 'Model' . DS . 'AppModel.php');

?>