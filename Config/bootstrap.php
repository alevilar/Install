<?php
if(
    file_exists(APP . 'Config' . DS . 'database.php')==false
    ||file_exists(APP . 'Config' . DS . 'core.php')==false
    ||file_exists(APP . 'Config' . DS . 'risto.php')==false
    ||file_exists(APP . 'Config' . DS . 'resume.php')==false
)
{

    $result = copy(APP . 'Config' . DS . 'database.php.default', APP . 'Config' . DS . 'database.php');
    if (!$result) {
        return __d('croogo', 'No se puede copiar el database.php para iniciar la instalación.');
    }
// Al vuelo se reemplaza los Ristos Model y Controller para poder arrancar
App::uses('Controller', 'Controller');
App::uses('Model', 'Model');

class AppController extends Controller {

}

class AppModel extends Model {


}


}