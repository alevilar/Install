<?php

App::uses('CakeLog', 'Log');
App::uses('ClassRegistry', 'Utility');
App::uses('File', 'Utility');
App::uses('GeoPlugin', 'Install.Lib/Utility');
App::uses('TenantSettings', 'MtSites.Utility');
App::uses('IniReader', 'Configure');
App::uses('SchemaShell', 'Console/Command');




/**
 *  Funciones de instalacion Installer
 *
 * @package Install.Lib.Utility
 */
class Installer {


    public static function createDatabaseFile($data) {
        App::uses('File', 'Utility');
        App::uses('ConnectionManager', 'Model');

        $defaultConfig = array(
            'name' => 'default',
            'datasource' => Configure::read('Risto.dataSourceType'),
            'persistent' => false,
            'host' => 'localhost',
            'login' => 'root',
            'password' => '',
            'database' => 'risto',
            'schema' => null,
            'prefix' => null,
            'encoding' => 'UTF8',
            'port' => null,
        );

        $config = $defaultConfig;

        $database_file = copy(App::pluginPath('Install') . 'Config' . DS . 'CoreInstallFiles' . DS . 'database.php.default', APP . 'Config' . DS . 'database.php');


        if (!$database_file) {
            return __d('croogo', 'No se puede copiar el database.php para iniciar la instalación.');
        }
    
        foreach ($data['Install'] as $key => $value) {
            if (isset($data['Install'][$key])) {
                $config[$key] = $value;
            }
        }

        $file = new File(APP . 'Config' . DS . 'database.php', true);
        $content = $file->read();

        foreach ($config as $configKey => $configValue) {
            $content = str_replace('{default_' . $configKey . '}', $configValue, $content);
        }

        $write_to_file = $file->write($content);

        if (!$write_to_file) {
            return __d('croogo', 'No se puede escribir por el archivo database.php.');
        }

        $file->close();

        try {
            ConnectionManager::create('default', $config);
            $db = ConnectionManager::getDataSource('default');
        }
        catch (MissingConnectionException $e) {
            return __d('croogo', 'No se pude conectar al abase de datos: ') . $e->getMessage();
        }
        if (!$db->isConnected()) {
            return __d('croogo', 'No se puede conectar a la base de datos.');
        }

        return true;
    }

    public static function setupDatabase() {    
        return self::loadFileSchema('Risto', 'default');
    }



    /**
    *
    *
    *   @param $file string FIle name
    *   @param $connection database connection 
    *   @param $mode 'string' cant be "create" or "update". create is the default value
    **/
    public static function loadFileSchema( $name, $connection, $mode = 'create' ) {
        $archs = array(
            'generic'    => 'GenericTenant',
            'hotel'      => 'HotelTenant',
            'restaurant' => 'RestaurantTenant',
            );
        $m = new SchemaShell();
        $m->params = array(
            'force' => 1, 
            'name' => $archs[$name],
            'plugin' => 'Risto',
            'connection' => $connection,
            'yes' => true,
            );
        $m->startup();
        $m->create();
        return true;
    }

    public static function createTenantsDir($site_slug = null)
    {
        $dir = new Folder(APP . 'Tenants' . DS . $site_slug, true);

        if( !$dir) {
            throw new CakeException('No se pudo crear el sitio: '.$site_slug. ' verifique que tenga permisos de escritura.');
        }

        return $dir;
    }

    public static function copyTenantSettingFile( $data = array() )
    {
        $site_slug = $data['Site']['alias'];
        $defaultSettingsConfig = array(
            'name' => 'default',
            'datasource' => Configure::read('Risto.dataSourceType'),
            'persistent' => false,
          );
        $installSettingsIniPath = App::pluginPath('Install') . 'Config' . DS . 'TenantInstallFiles' . DS . $data['Site']['type'] . DS;

        $IniSetting = new IniReader($installSettingsIniPath);
        $settings = $IniSetting->read( 'settings.ini' );
        $settings['Config']['timezone'] = $data['Site']['timezone'];
        $settings['Site']['ip'] = $data['Site']['ip'];
        $settings['Site']['name'] = $data['Site']['name'];
        $settings['Site']['alias'] = $data['Site']['alias'];
            
        $settings['Geo'] = GeoPlugin::locate($data['Site']['ip']);
        unset( $settings['Geo']['currency_symbol'] ); // el simbolo me rompe el settings.ini file
        TenantSettings::write( $settings, $site_slug);       

        return true;
    }


    public static function dumpTenantDB( $data = null)
    {        
        App::uses('ConnectionManager', 'Model');

        $slug = $data['Site']['alias'];

        $tenantDB = MtSites::getTenantDbName( $slug );

        // 1) Primero se corrobora si se puede crear la base de datos, sino se puede promover la desinstalacion del site
        $create_tenant = ConnectionManager::getDataSource('default')->query("CREATE DATABASE ".$tenantDB);

        if(!empty($create_tenant)) {
            throw new CakeException('No se pudo crear la base de datos del tenant: '.$tenantDB.'. Verifique que su usuario de conexión tenga los permisos suficientes. Tal vez la base de datos ya exista.');
        }

        MtSites::connectDatasourceWithCurrentTenant( $slug );
        $datasource = MtSites::getTenantDataSourceName( $slug );
        
        $tenantType = $data['Site']['type'];
        
        return self::loadFileSchema($tenantType, $datasource);

    }



    public static function createCoresFile () {
        $emailFilePath = APP . 'Config' . DS . 'email.php';
        $newEmailFilePath = App::pluginPath('Install') . 'Config' . DS . 'CoreInstallFiles' . DS . 'email.php.default';
        if ( !file_exists($emailFilePath) && !copy($newEmailFilePath, $emailFilePath) ) {
            throw new CakeException(__d('install', 'No se puede escribir el archivo email.php.'));
        }

        $newRistoConfigFilePath = App::pluginPath('Install') . 'Config' . DS . 'CoreInstallFiles' . DS .  'risto.php.install';
        $ristoFilePath =  APP . 'Config' . DS . 'risto.php';
        if( !file_exists($ristoFilePath) && !copy($newRistoConfigFilePath,$ristoFilePath)) {
            throw new CakeException(__d('install', 'No se puede escribir el archivo risto.php.'));
        }
        return true;
    }



    public static function checkPerms()
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

    /**
    *
    *
    *   @return integer 0 si no esta instalada, 1 si estan los archivos pero no hay Bases de Datos instaladas y 2 si esta completamente instalada
    **/
    public static function checkAppInstalled()
    {
        $res = 0;
        if( file_exists(APP . 'Config' . DS . 'database.php') && file_exists(APP . 'Config' . DS . 'risto.php') ) {
            // Si exxiste los dos hacemos un checkeo si existen por lo menos una tabla
            $res++;
            $checkUserAdmin = Installer::check_table_exists();
            if ( $checkUserAdmin ) {
                $res++;
            }
        }
        return $res;
    }

    public static function check_table_exists()
    {
        $db = ConnectionManager::getDataSource('default');
        $tables = $db->listSources();
        // De existir tabla, suponemos paso el apso dos en donde se crea la estructura y se coloca los dos primeros users, aun asi debe pasar al metodo adminuser para añadir un ter usuario antes de comnzar con la carga de los tenants
        if(count($tables))
        {
            App::import('model','Users.User');
            $user = new User();
            $geUserCount = $user->find("count");
            if($geUserCount<3)
            {
                return false;
            }
            else if($geUserCount>=3)
            {
                return true;
            }
        }

        return count($tables);
    }
    public static function cancelInstall()
    {

        $database = new File(APP . 'Config' . DS . 'database.php');
        if($database->exists())
        {
            // Si existe la base de datos, entoncs debemos de elimanr todas las tablas
            try {
                $db = ConnectionManager::getDataSource('default');
                $tables = $db->listSources();
                if(!empty($tables))
                {
                    foreach($tables as $index => $tablename)
                    {
                        $db->query("DROP TABLE IF EXISTS ".$tablename.";");
                    }
                }
            }
            catch (MissingConnectionException $e) {
                return __d('croogo', 'No se pude conectar al abase de datos: ') . $e->getMessage();
            }
            if($database->delete())
            {
                return true;
            }
            else
            {
                return __d('croogo','No se puede borrar el database.php, corrobore los permisos de escritura sobre este archivo.');
            }
        }
        else
        {
            return true;
        }
    }


    public static function deleteSite( $site_alias = null )
    {
        self::_removeDatabase( $site_alias );
        self::_deleteTenantFolder( $site_alias );
        return true;
    }


    public static function _removeDatabase($site_alias) {
        App::uses('ConnectionManager', 'Model');

        $db = ConnectionManager::getDataSource('default');
        $tenantDB = $db->config['database']."_".$site_alias;
        $delete_db = $db->query("DROP DATABASE IF EXISTS ".$tenantDB);

        return true;
    }


    public static function _deleteTenantFolder($site_alias) {
        App::uses('Folder', 'Utility');

        $folder = new Folder( APP . 'Tenants' . DS . $site_alias);
        $folder->delete();

        return true;
    }
}