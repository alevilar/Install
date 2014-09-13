<?php

App::uses('CakeLog', 'Log');
App::uses('ClassRegistry', 'Utility');
App::uses('File', 'Utility');



/**
 *  Funciones de instalacion Installer
 *
 * @package Install.Lib.Utility
 */
class Installer {


	public static function createTenantsDir($site_slug = null)
    {
        $dir = new Folder(APP . DS . 'Tenants' . DS . $site_slug, true);

        if(!$dir)
        {
            return __d('croogo', 'No se pudo crear el sitio: '.$site_slug. ' verifique que tenga permisos de escritura.');
        }

        return $dir;

    }

    public static function copySettingFile($site_slug = null,$data = null)
    {
        $SiteManager = new SiteManager();

        $copy_1 = $SiteManager->createSiteFile($site_slug,$data);

        return $copy_1;

    }

    // Paso final, copia del resumen
    public static function createResumeFile()
    {
        $result = copy(App::pluginPath('Install') . DS . 'Config' . DS . 'resume.php.install', APP . 'Config' . DS . 'resume.php');
        return $result;
    }

    public static function createDumpTenantDB($slug = null, $data = null)
    {
        $SiteManager = new SiteManager();

        $dumptentant = $SiteManager->createDumpTenantDB($slug,$data);

        return $dumptentant;

    }


    public static function getCountryData( $ip )
    {
        $SiteManager = new SiteManager();

        $country_code = $SiteManager->getCountryData( $ip );

        return $country_code;

    }

}