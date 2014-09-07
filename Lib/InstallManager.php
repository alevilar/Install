<?php

class InstallManager {

/**
 * Default configuration
 *
 * @var array
 * @access public
 */
	public $defaultConfig = array(
		'name' => 'default',
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => 'localhost',
		'login' => 'root',
		'password' => '',
		'database' => 'croogo',
		'schema' => null,
		'prefix' => null,
		'encoding' => 'UTF8',
		'port' => null,
	);

	public function createDatabaseFile($data) {
		App::uses('File', 'Utility');
		App::uses('ConnectionManager', 'Model');
		$config = $this->defaultConfig;

		foreach ($data['Install'] as $key => $value) {
			if (isset($data['Install'][$key])) {
				$config[$key] = $value;
			}
		}

		$result = copy(App::pluginPath('Install') . DS . 'Config' . DS . 'database.php.install', APP . 'Config' . DS . 'database.php');
		if (!$result) {
			return __d('croogo', 'Could not copy database.php file.');
		}
		$file = new File(APP . 'Config' . DS . 'database.php', true);
		$content = $file->read();

		foreach ($config as $configKey => $configValue) {
			$content = str_replace('{default_' . $configKey . '}', $configValue, $content);
		}

		if (!$file->write($content)) {
			return __d('croogo', 'No se puede escribir por el archivo database.php.');
		}

		try {
			ConnectionManager::create('default', $config);
			$db = ConnectionManager::getDataSource('default');
		}
		catch (MissingConnectionException $e) {
			return __d('croogo', 'Could not connect to database: ') . $e->getMessage();
		}
		if (!$db->isConnected()) {
			return __d('croogo', 'Could not connect to database.');
		}

		return true;
	}

    public function createCoresFile() {
        $resumeConfigFile = App::pluginPath('Install') . DS . 'Config' . DS . 'risto.php.install';
        if(copy($resumeConfigFile, APP . 'Config' . DS . 'risto.php'))
        {
            return true;
        }
        else
        {
            return __d('croogo', 'No se puede escribir el archivo risto.php.');
        }
    }


/**
 * Create settings.json from default file
 *
 * @return bool true when successful
 */
	public function createSettingsFile() {

        $appControllerRistoConfigFile = App::pluginPath('Install') . DS . 'Config' . DS . 'AppController.php.install';
        $appModelRistoConfigFile = App::pluginPath('Install') . DS . 'Config' . DS . 'AppModel.php.install';

        $result = array(
            copy($appControllerRistoConfigFile, APP . 'Controller' . DS . 'AppController.php') &&
            copy($appModelRistoConfigFile, APP . 'Model' . DS . 'AppModel.php')
        );


        if (!$result) {
            $msg = 'No se puede copiar los archivos de configuración Risto.';
            CakeLog::critical($msg);
            return $msg;
        }


        return true;


	}


/**
 * Mark installation as complete
 *
 * @return bool true when successful
 */
	public function installCompleted() {
		$Setting = ClassRegistry::init('Settings.Setting');
		$Setting->Behaviors->disable('Cached');
		return $Setting->write('Croogo.installed', 1);
	}

    public function checkPerms()
    {
        $res = true;

        if (!is_writable(TMP)) {
            $res = false;
        }

        if (!is_writable(APP . 'Config')) {
            $res = false;
        }

        if (!is_writable(APP . 'Controller')) {
            $res = false;
        }

        if (!is_writable(APP . 'Model')) {
            $res = false;
        }

        if (!is_writable(APP . 'Tenants')) {
            $res = false;
        }

    return $res;

    }

    public function checkAppInstalled()
    {
        $res = true;
        if(
            file_exists(APP . 'Config' . DS . 'database.php')==false
            ||file_exists(APP . 'Config' . DS . 'core.php')==false
            ||file_exists(APP . 'Config' . DS . 'risto.php')==false
            ||file_exists(APP . 'Config' . DS . 'resume.php')==false
        )
        {
            $res = false;

        }

        return $res;
    }


}