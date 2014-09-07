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
        if (Configure::read('Risto.installed')) {
            $this->Session->setFlash('Already Installed');
            return $this->redirect('/');
        }
    }


    public function index() {
        $this->_check();
        $this->set('title_for_layout', __d('croogo', 'Bienvenido a la Instalación Ristorantino Mágico.'));
    }


    public function database() {
        $this->_check();
        $this->set('title_for_layout', __d('croogo', 'Paso 1: Base de Datos'));

        if (Configure::read('Croogo.installed')) {
            return $this->redirect(array('action' => 'adminuser'));
        }

        if (!empty($this->request->data)) {
            $InstallManager = new InstallManager();
            $result = $InstallManager->createDatabaseFile(array(
                'Install' => $this->request->data,
            ));
            if ($result !== true) {
                $this->Session->setFlash($result, 'default', array('class' => 'error'));
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
                __d('croogo', 'Warning: Database "%s" is not empty.', $ds->config['database']),
                'default', array('class' => 'error')
            );
        }

        if ($this->request->query('run')) {

            set_time_limit(10 * MINUTE);

            $sqlMigration = $this->Install->setupDatabase();

            $InstallManager = new InstallManager();

            if($sqlMigration)
            {
                $result = $InstallManager->createCoresFile();

                if ($result == false) {
                    return $this->Session->setFlash($result, 'default', array('class' => 'error'));
                }
                else if ($result == true) {
                    return $this->redirect(array('action' => 'adminuser'));
                }

            }
            else
            {
                return $this->Session->setFlash($sqlMigration, 'default', array('class' => 'error'));
            }



        }
    }


    public function adminuser() {
        if (!file_exists(APP . 'Config' . DS . 'database.php')) {
            return $this->redirect('/');
        }

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


    public function finish($token = null) {
        $this->set('title_for_layout', __d('croogo', 'La instalación ha culminado de manera exitosa'));
        $this->_check();

        $InstallManager = new InstallManager();
     //   $installed = $InstallManager->createSettingsFile();
        $installed = true;
        if ($installed === true) {
            $InstallManager->installCompleted();
        } else {
            $this->set('title_for_layout', __d('croogo', 'La Installacion fallo'));
            $msg = __d('croogo', 'Instalación fallo: No se pudo crear los archivos de configuración.');
            $this->Session->setFlash($msg, 'default', array('class' => 'error'));
        }

        $urlBlogAdd = Router::url(array(
            'plugin' => 'nodes',
            'admin' => true,
            'controller' => 'nodes',
            'action' => 'add',
            'blog',
        ));
        $urlSettings = Router::url(array(
            'plugin' => 'settings',
            'admin' => true,
            'controller' => 'settings',
            'action' => 'prefix',
            'Site',
        ));

        $this->set('user', $this->Session->read('Install.user'));
        if ($installed) {
            $this->Session->destroy();
        }
        $this->set(compact('urlBlogAdd', 'urlSettings', 'installed'));
    }




}