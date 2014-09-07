<?php

class SiteManager {

/**
 * Default configuration
 *
 * @var array
 * @access public
 */
	public $defaultSettingsConfig = array(
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

		return true;
	}


}