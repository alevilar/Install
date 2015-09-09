<?php

App::uses('CakeLog', 'Log');
App::uses('ClassRegistry', 'Utility');
App::uses('File', 'Utility');
App::uses('GeoPlugin', 'Install.Lib/Utility');
App::uses('TenantSettings', 'MtSites.Utility');
App::uses('IniReader', 'Configure');




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

        $config = $defaultConfig;

        $database_file = copy(App::pluginPath('Install') . 'Config' . DS . 'CoreInstallFiles' . DS . 'database.php.default', APP . 'Config' . DS . 'database.php');

        $email_file = copy(App::pluginPath('Install') . 'Config' . DS . 'CoreInstallFiles' . DS . 'email.php.default', APP . 'Config' . DS . 'email.php');

        if (!$database_file) {
            return __d('croogo', 'No se puede copiar el database.php para iniciar la instalación.');
        }

        if (!$database_file) {
            return __d('croogo', 'No se puede copiar el email.php para iniciar la instalación.');
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

        App::uses('ConnectionManager', 'Model');

        $db = ConnectionManager::getDataSource('default');

        $dumpsSqls = array(
            App::pluginPath('Install') . 'Config' . DS . 'CoreInstallFiles' . DS . 'schema_core_drop_tables.sql',
            App::pluginPath('Install') . 'Config' . DS . 'CoreInstallFiles' . DS . 'schema_core_struct.sql',
            App::pluginPath('Install') . 'Config' . DS . 'CoreInstallFiles' . DS . 'schema_core_base_data.sql'
        );

        $migrationsSucceed = true;


        foreach($dumpsSqls as $dumpsSql)
        {

            $File =& new File($dumpsSql);
            $contents = $File->read();
            $migrateNow = $db->query($contents);

            if(!$migrateNow)
            {
                if(is_array($migrateNow))
                {
                    if(!empty($migrateNow))
                    {
                        throw new CakeException("Ha ocurrido un error con el sql del sistema principal. Favor verificarlo.");
                    }

                }
                if(!is_array($migrateNow))
                {
                    throw new CakeException("Ha ocurrido un error con el sql del sistema principal. Favor verificarlo.");
                }

            }


            if($migrateNow==false)
            {

            }

        }

        return $migrationsSucceed;
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
            'datasource' => 'Database/Mysql',
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
        $tenantontheFlyConfig = array(
        'name' => 'default',
        'datasource' => 'Database/Mysql',
        'persistent' => false,
        );

        $slug = $data['Site']['alias'];

       $tenantDB = "";

       $defaultSettingsConfig = array(
        'name' => 'default',
        'datasource' => 'Database/Mysql',
        'persistent' => false,

        );

        App::uses('ConnectionManager', 'Model');

        if(ConnectionManager::getDataSource('default')->connected)
        {

            $tenantDB = ConnectionManager::getDataSource('default')->config['database']."_".$slug;

            $tenantontheFlyConfig = ConnectionManager::getDataSource('default')->config;
            $tenantontheFlyConfig['database'] = $tenantDB;


            // 1) Primero se corrobora si se puede crear la base de datos, sino se puede promover la desinstalacion del site
           $create_tenant = ConnectionManager::getDataSource('default')->query("CREATE DATABASE ".$tenantDB);

            if(!empty($create_tenant))
            {
                throw new CakeException('No se pudo crear la base de datos del tenant: '.$tenantDB.'. Verifique que su usuario de conexión tenga los permisos suficientes. Tal vez la base de datos ya exista.');
            }

            if(ConnectionManager::create('tenantInstance',$tenantontheFlyConfig))
            {
                $tenantConnection = ConnectionManager::getDataSource('tenantInstance');
            }
            else
            {
                throw new CakeException('No fue posible crear una instancia de conexión a la base de datos del tenant. Favor revisar el Estado del Servidor Mysql y usuarios/privilegios.');
            }

            // El schema struct es comuna a todos, el data es diferente
            $dumpsSqls = array(
                App::pluginPath('Install') . 'Config' . DS . 'TenantInstallFiles' . DS . 'schema_tenant_struct.sql',
                App::pluginPath('Install') . 'Config' . DS . 'TenantInstallFiles'. DS . $data['Site']['type'] . DS . 'schema_tenant_base_data.sql',
            );

          //  debug(ConnectionManager::getDataSource('tenantInstance')->config);
          //  debug(ConnectionManager::getDataSource('tenantInstance')->connected);
            foreach($dumpsSqls as $dumpsSql)
            {
            //    debug($dumpsSql);
                $File =& new File($dumpsSql);
                $contents = $File->read();
             //   debug($contents);
                // El sql puede fallar, entonces ponemos una excepcion
                $execute_query_tenant = $tenantConnection->query($contents);
              //  debug($execute_query_tenant);
                if(!$execute_query_tenant)
                {
                    // Si es false hay que corroborar que si es un array
                    if(is_array($execute_query_tenant))
                    {
                        // Si es un array y no esta vacio algo malo paso en la consulta query sql
                        if(!empty($execute_query_tenant))
                        {
                            throw new CakeException("Se ha producido un error en el volcado de datos en la generación de la base de datos para el tenant.");
                        }
                    }
                    if(!is_array($execute_query_tenant))
                    {
                        // Si no es un array fue una ejecucion en falso, entonces deberia de mostrar la excepcion
                        throw new CakeException("Se ha producido un error en el volcado de datos en el tenant.");
                    }

                }


                    $File->close();
                    continue;

            }
            // Una ves que coloque todo, devolver el control a la conexion principal
        }
        else
        {
            throw new CakeException("No fue posible establecer la conexión con la base de datos principal, es probable que se haya producido un corte de conexión o que los datos de ingresos hayan cambiados.");

        }

        if(ConnectionManager::getDataSource('default'))
        {
            ConnectionManager::getDataSource('default')->cacheSources = false;
        }
        else
        {
            throw new CakeException("No fue posible retomar la conexión con la base de datos principal, es probable se haya producido un corte de conexión o que los datos de ingresos hayan cambiados.");
        }

    }



    public static function createCoresFile()
    {
        $ristoConfigFile = App::pluginPath('Install') . 'Config' . DS . 'CoreInstallFiles' . DS .  'risto.php.install';
        if(copy($ristoConfigFile, APP . 'Config' . DS . 'risto.php'))
        {
            return true;
        }
        else
        {
            throw new CakeException('No se puede escribir el archivo risto.php.');
        }
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

    public static function checkAppInstalled()
    {
        $res = false;
        if( file_exists(APP . 'Config' . DS . 'database.php') && file_exists(APP . 'Config' . DS . 'core.php') ) {

            // Si exxiste los dos hacemos un checkeo si existen por lo menos una tabla
            $checkUserAdmin = Installer::check_table_exists();
            if ( $checkUserAdmin ) {
                $res = true;
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