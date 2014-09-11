<?php

class SiteManager {

/**
 * Default configuration
 *
 * @var array
 * @access public
 */

    var $tenantDB = "";

	public $defaultSettingsConfig = array(
		'name' => 'default',
		'datasource' => 'Database/Mysql',
		'persistent' => false,

	);

    public $tenantontheFlyConfig = array(
        'name' => 'default',
        'datasource' => 'Database/Mysql',
        'persistent' => false,

    );
	public function createSiteFile($site_slug,$data) {
		App::uses('File', 'Utility');
		$config = $this->defaultSettingsConfig;

		foreach ($data['Site'] as $key => $value) {
			if (isset($data['Site'][$key])) {
				$config[$key] = $value;
			}
		}

        if(!file_exists(APP . 'Tenants' . DS . $site_slug . DS . 'settings.ini'))
        {
            $result = copy(App::pluginPath('Install')  . 'Config' . DS . 'settings.ini.install', APP . 'Tenants' . DS . $site_slug . DS . 'settings.ini');
            if (!$result) {
                return __d('croogo', 'No se puede copiar el archivo settings.');
            }
            $file = new File(APP . 'Tenants' . DS . $site_slug . DS . 'settings.ini', true);
            $content = $file->read();

            foreach ($config as $configKey => $configValue) {
                $content = str_replace('{default_' . $configKey . '}', $configValue, $content);
            }

            if (!$file->write($content)) {
                return __d('croogo', 'No se puede escribir por el archivo settings.');
            }
        }
        else
        {
            return __d('croogo', 'El archivo settings de este sitio ya existe, favor eliminelo para continuar.');
        }

		return true;
	}


    public function createDumpTenantDB($slug = null, $data = null)
    {
        App::uses('ConnectionManager', 'Model');

        $db = ConnectionManager::getDataSource('default');

        $this->tenantDB = $db->config['database']."_".$slug;

        $this->tenantontheFlyConfig = array(
            'datasource' => 'Database/Mysql',
            'persistent' => false,
            'host' => $db->config['host'],
            'login' => $db->config['login'],
            'password' => $db->config['password'],
            'database' => $this->tenantDB,
            'prefix' => $db->config['prefix'],
            'encoding' => 'UTF8',
            'port' => $db->config['port'],
        );


        $createTenantDatabase = $db->query("CREATE DATABASE ".$this->tenantDB);

        try {
        $tenantInstance = ConnectionManager::create('tenantInstance',$this->tenantontheFlyConfig);
        $tenantConnection = ConnectionManager::getDataSource('tenantInstance');
        }
        catch (MissingConnectionException $e) {
            return __d('croogo', 'No se pudo conectar a la base de datos del tenant: ') . $e->getMessage();
        }

        $dumpsSqls = array(
            APP . 'Config' . DS . 'Schema' . DS . 'schema_tenant_struct.sql'
        );


        foreach($dumpsSqls as $dumpsSql)
        {

            $File =& new File($dumpsSql);
            $contents = $File->read();
            $migrateNow = $tenantConnection->query($contents);
            if($migrateNow==false)
            {
                return _("Fallo la ejecucion del sql del tenant.");
            }
            else
            {
                return true;
            }

        }

    }

}