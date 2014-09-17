<?php
App::uses('Controller', 'Controller');
App::uses('File', 'Utility');
App::uses('Installer', 'Install.Utility');


class InstallController extends Controller {

    public $layout = 'Risto.default';
 
    protected function _check() {
        // Si esta instalado no habra necesidad de checkear permisos
        if (Installer::checkAppInstalled()) {
            $this->Session->setFlash('La Aplicación Ristorantino ya esta instalada.', 'Risto.flash_success');
            return $this->redirect('/users/login');
        }
        // Si no esta instalado y no se puede escribir en las pcarpetas volvera al inicio
        if (!Installer::checkAppInstalled()&&!Installer::checkPerms())
        {

            return $this->redirect('/install');
        }

    }


    public function index() {

        $this->set('title_for_layout', __d('croogo', 'Bienvenido a la Instalación de Ristorantino Magíco.'));
    }


    public function database() {
        $this->set('title_for_layout', __d('croogo', 'Paso 1: Base de datos.'));
        $this->_check();

        if (Configure::read('Croogo.installed')) {
            return $this->redirect(array('action' => 'adminuser'));
        }

        if (!empty($this->request->data)) {

                $result = Installer::createDatabaseFile(array(
                    'Install' => $this->request->data,
                ));


            if ($result !== true) {
               return $this->Session->setFlash($result, 'Risto.flash_error');
            } else {
                return $this->redirect(array('action' => 'data'));
            }
        }

        $currentConfiguration = array(
            'exists' => false,
            'valid' => false,
        );
        if (file_exists(APP . 'Config' . DS . 'database.php')) {
            $currentConfiguration['exists'] = true;
        }
        if ($currentConfiguration['exists']) {
            try {
                $this->loadModel('Install.Install');
                $ds = $this->Install->getDataSource();
                $ds->cacheSources = false;
                $sources = $ds->listSources();
                $currentConfiguration['valid'] = true;
            } catch (Exception $e) {
            }
        }
        $this->set(compact('currentConfiguration'));
    }


    public function data() {
        $this->_check();
        $this->set('title_for_layout', __d('croogo', 'Paso 2: Construir Base de Datos.'));

        $this->loadModel('Install.Install');
        $ds = $this->Install->getDataSource();
        $ds->cacheSources = false;
        $sources = $ds->listSources();
        if (!empty($sources)) {
            $this->Session->setFlash(
                __d('croogo', 'Advertencia: La base de datos "%s" no esta vacia.', $ds->config['database'])
                , 'Risto.flash_error');
        }

        if ($this->request->query('run')) {

            set_time_limit(10 * MINUTE);

            $sqlMigration = Installer::setupDatabase();

            if($sqlMigration)
            {
                    return $this->redirect(array('action' => 'adminuser'));

            }
            else
            {
                return $this->Session->setFlash($sqlMigration, 'default', 'Risto.flash_error');
            }
        }
    }


    public function adminuser() {
        $this->_check();
        $this->set('title_for_layout', __d('croogo', 'Paso 3: Crear un usuario admin.'));
        if ($this->request->is('post')) {

            $this->loadModel('Users.User');
            $this->Components->load('Auth');
            // El nuevo plugin pide mail como un dato a validar, por de pronto on the ly lo desactivamos

            $this->User->validate = array(
                        'email' => array(
                            'allowEmpty' => true,
                            'required'   => false,
                        )
                );

            $this->request->data['User']['password'] = Security::hash($this->request->data['User']['password'], null, true);

            $this->User->set($this->request->data);
            if ($this->User->validates())
            {

                $this->request->data['User']['rol_id'] = ADMIN_ROLE_ID;

                if($this->User->save($this->request->data))
                {
                    $risto_file = Installer::createCoresFile();
                    $user = $this->User->findById($this->User->id);
                    $result = true;
                    if ($risto_file == true) {
                        return $this->redirect(array('plugin'=>'install','admin'=>false,'controller'=>'siteSetup','action' => 'installsite'));
                    }
                    else{
                        echo $this->Session->setFlash("Ha ocurrido un error copiando el archivo: ".$risto_file, 'default', 'Risto.flash_error');
                    }

                }
                else
                {
                    echo $this->Session->setFlash("No se ha podido crear el usuario, revise los datos, o intentelo mas tarde.", 'default', 'Risto.flash_error');
                }

            }
            else
            {
                echo $this->Session->setFlash("No se ha podido crear el usuario, se ha encontrado errores en la validación: ".print_r($this->User->invalidFields()), 'default', 'Risto.flash_error');

            }
        }
    }


    public function cancel()
    {
        if(Installer::cancelInstall())
        {
            $this->Session->setFlash(_("Se cancelo la instalación. Puede recomenzar si asi lo desea."));

            $this->redirect("/install");

        }

    }

}