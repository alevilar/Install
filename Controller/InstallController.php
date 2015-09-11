<?php
App::uses('Controller', 'Controller');
App::uses('Installer', 'Install.Utility');

class InstallController extends AppController {

   // public $layout = 'Risto.default';

    public function beforeFilter () {
        parent::beforeFilter();
        $this->Auth->allow(array('index', 'database', 'adminuser', 'data', 'cancel'));        
    }
 
    protected function _check() {
        // Si esta instalado no habra necesidad de checkear permisos
        if ( Installer::checkAppInstalled() == 2) {
            $this->Session->setFlash('La Aplicación Ristorantino ya esta instalada.', 'Risto.flash_success');
            return $this->redirect('/');
        }
        // Si no esta instalado y no se puede escribir en las pcarpetas volvera al inicio
        if (Installer::checkAppInstalled() < 2 &&!Installer::checkPerms()) {
            return $this->redirect( array('action' => 'install') );
        }
    }


    public function index() {

        $this->set('title_for_layout', __d('croogo', 'Bienvenido a la Instalación de Ristorantino Magíco.'));
        Installer::createCoresFile();
    }



    public function database() {
        $this->set('title_for_layout', __d('croogo', 'Paso 1: Base de datos.'));
        $this->_check();

        if ( Installer::checkAppInstalled() == 2 ) {
            return $this->redirect(array('action' => 'adminuser'));
        }

        if (!empty($this->request->data)) {

            $this->Install->set($this->request->data);
            if ($this->Install->validates()) {
                $result = Installer::createDatabaseFile( $this->request->data );
                if ($result !== true) {
                    $this->Session->setFlash($result, 'Risto.flash_error');
                } else {
                    $this->redirect(array('action' => 'data'));
                }
            }
        }

        $currentConfiguration = array(
            'exists' => false,
            'valid' => false,
        );
        if (file_exists(APP . 'Config' . DS . 'database.php')) {
            $currentConfiguration['exists'] = true;

            $ds = $this->Install->getDataSource();
            $ds->cacheSources = false;
            $sources = $ds->listSources();
            $currentConfiguration['valid'] = true;
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

            //set_time_limit(10 * MINUTE);

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
       // $this->_check();
        $this->set('title_for_layout', __d('croogo', 'Paso 3: Crear un usuario admin.'));
        if ($this->request->is('post')) {

            $this->loadModel('Users.User');
            //$this->Components->load('Auth');
            // El nuevo plugin pide mail como un dato a validar, por de pronto on the ly lo desactivamos

            $this->request->data['User']['username'] = $this->request->data['User']['email'];
            $this->request->data['User']['rol_id'] = ADMIN_ROLE_ID;

            $regOk = $this->User->register($this->request->data, array(
                'emailVerification' => false,
                ));
           
            if( $regOk ) {
                $this->Session->setFlash("Se ha instalado todo correctamente, puede ingresar con su nuevo usuario");
                $this->redirect('/');
            } else {
                $this->Session->setFlash("No se ha podido crear el usuario, revise los datos, o intentelo mas tarde.", 'Risto.flash_error');
            }
        }
    }


    public function cancel()
    {
        if( !Installer::cancelInstall() ) {
            $this->log('No se pudo cancelar la instalacion correctamente', 'error');
        }
        $this->Session->setFlash(_("Se cancelo la instalación. Puede recomenzar si asi lo desea."));
        $this->redirect('/');

    }

}
