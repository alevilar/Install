<?

App::uses('Controller', 'Controller');
App::uses('File', 'Utility');
App::uses('InstallManager', 'Install.Lib');


class InstallController extends AppController {

    /**
     * Components
     *
     * @var array
     * @access public
     */
    public $components = array('Session');

    /**
     * Helpers
     *
     * @var array
     * @access public
     */
    public $layout = 'default';

    public $helpers = array(
        'Html' => array(
            'className' => 'Bs3Html'
        ),
        'Form' => array(
            'className' => 'PxForm'
            // 'className' => 'Bs3Form'
        ),
        'Session',
        'Paginator',
        'Number',
    );

    protected function _check() {
        $InstallManager = new InstallManager();
        // Si esta instalado no habra necesidad de checkear permisos
        if ($InstallManager->checkAppInstalled()) {
            $this->Session->setFlash('La Aplicación Ristorantino ya esta instalada.', 'Risto.flash_success');
            return $this->redirect('/users/login');
        }
        // Si no esta instalado y no se puede escribir en las pcarpetas volvera al inicio
        if (!$InstallManager->checkAppInstalled()&&!$InstallManager->checkPerms())
        {

            return $this->redirect('/install');
        }

    }


    public function index() {

        $this->set('title_for_layout', __d('croogo', 'Bienvenido a la Instalación Ristorantino Mágico.'));
    }


    public function database() {
        $this->set('title_for_layout', __d('croogo', 'Paso 1: Base de datos.'));
        $this->_check();

        if (Configure::read('Croogo.installed')) {
            return $this->redirect(array('action' => 'adminuser'));
        }

        if (!empty($this->request->data)) {
            $InstallManager = new InstallManager();
            $result = $InstallManager->createDatabaseFile(array(
                'Install' => $this->request->data,
            ));
            if ($result !== true) {
               return $this->Session->setFlash($result, 'Risto.flash_success');
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

            $sqlMigration = $this->Install->setupDatabase();

            $InstallManager = new InstallManager();

            if($sqlMigration)
            {
                $result = $InstallManager->createCoresFile();

                if ($result == false) {
                    return $this->Session->setFlash($result, 'default', 'Risto.flash_error');
                }
                else if ($result == true) {
                    return $this->redirect(array('action' => 'adminuser'));
                }

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
            $this->loadModel('Install.User');
            $this->User->set($this->request->data);
            if ($this->User->validates()) {
                require_once(APP . 'Config' . DS . 'risto.php');

                $this->request->data['User']['rol_id'] = ADMIN_ROLE_ID;

                if($this->User->save($this->request->data))
                {

                    $user = $this->User->findById($this->User->id);

                   $result = true;

                    if ($result == true) {
                        return $this->redirect(array('plugin'=>'install','admin'=>false,'controller'=>'siteSetup','action' => 'installsite'));
                    }

                }

            }
        }
    }


}