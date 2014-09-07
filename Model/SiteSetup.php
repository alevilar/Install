<?php

App::uses('CakeTime', 'Utility');
App::uses('CroogoPlugin', 'Install.Lib');
App::uses('DataMigration', 'Install.Lib/Utility');
App::uses('File', 'Utility');
App::uses('InstallAppModel', 'Install.Model');
App::uses('Security', 'Utility');
App::uses('Folder', 'Utility');
App::uses('SiteManager', 'Install.Lib');



class SiteSetup extends InstallAppModel {

    /**
     * name
     *
     * @var string
     */
    public $name = 'SiteSetup';

    /**
     * useTable
     *
     * @var string
     */
    public $useTable = false;

    /**
     *
     * @var CroogoPlugin
     */
    protected $_CroogoPlugin = null;

    /**
     * Create admin user
     *
     * @var array $user User datas
     * @return If user is created
     */


    public function createTenantsDir($site_slug = null)
    {
        $dir = new Folder(APP . DS . 'Tenants' . DS . $site_slug, true);

        if(!$dir)
        {
            return __d('croogo', 'No se pudo crear el sitio: '.$site_slug. ' verifique que tenga permisos de escritura.');
        }

        return $dir;

    }

    public function copySettingFile($site_slug = null,$data = null)
    {
        $SiteManager = new SiteManager();

        $copy_1 = $SiteManager->createSiteFile($site_slug,$data);

        return $copy_1;

    }

    // Paso final, copia del resumen
    public function createResumeFile()
    {
        $result = copy(App::pluginPath('Install') . DS . 'Config' . DS . 'resume.php.install', APP . 'Config' . DS . 'resume.php');
        return $result;
    }

}
