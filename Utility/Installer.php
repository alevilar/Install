<?php

App::uses('CakeLog', 'Log');
App::uses('ClassRegistry', 'Utility');
App::uses('File', 'Utility');
App::uses('GeoPlugin', 'Install.Lib/Utility');





/**
 *  Funciones de instalacion Installer
 *
 * @package Install.Lib.Utility
 */
class Installer {


    public static $_countries = array(
        'Europa'=>array(
            "AL"=>"Albania",
            "DE"=>"Alemania",
            "AD"=>"Andorra",
            "AM"=>"Armenia",
            "AT"=>"Austria",
            "AZ"=>"Azerbaiyán",
            "BE"=>"Bélgica",
            "BY"=>"Bielorrusia",
            "BA"=>"Bosnia y Herzegovina",
            "BG"=>"Bulgaria",
            "CY"=>"Chipre",
            "VA"=>"Ciudad del Vaticano (Santa Sede)",
            "HR"=>"Croacia",
            "DK"=>"Dinamarca",
            "SK"=>"Eslovaquia",
            "SI"=>"Eslovenia",
            "ES"=>"España",
            "EE"=>"Estonia",
            "FI"=>"Finlandia",
            "FR"=>"Francia",
            "GE"=>"Georgia",
            "GR"=>"Grecia",
            "HU"=>"Hungría",
            "IE"=>"Irlanda",
            "IS"=>"Islandia",
            "IT"=>"Italia",
            "XK"=>"Kosovo",
            "LV"=>"Letonia",
            "LI"=>"Liechtenstein",
            "LT"=>"Lituania",
            "LU"=>"Luxemburgo",
            "MK"=>"Macedonia, República de",
            "MT"=>"Malta",
            "MD"=>"Moldavia",
            "MC"=>"Mónaco",
            "ME"=>"Montenegro",
            "NO"=>"Noruega",
            "NL"=>"Países Bajos",
            "PL"=>"Polonia",
            "PT"=>"Portugal",
            "UK"=>"Reino Unido",
            "CZ"=>"República Checa",
            "RO"=>"Rumanía",
            "RU"=>"Rusia",
            "SM"=>"San Marino",
            "SE"=>"Suecia",
            "CH"=>"Suiza",
            "TR"=>"Turquía",
            "UA"=>"Ucrania",
            "YU"=>"Yugoslavia",
        ),

        "África"=>array(
            "AO"=>"Angola",
            "DZ"=>"Argelia",
            "BJ"=>"Benín",
            "BW"=>"Botswana",
            "BF"=>"Burkina Faso",
            "BI"=>"Burundi",
            "CM"=>"Camerún",
            "CV"=>"Cabo Verde",
            "TD"=>"Chad",
            "KM"=>"Comores",
            "CG"=>"Congo",
            "CD"=>"Congo, República Democrática del",
            "CI"=>"Costa de Marfil",
            "EG"=>"Egipto",
            "ER"=>"Eritrea",
            "ET"=>"Etiopía",
            "GA"=>"Gabón",
            "GM"=>"Gambia",
            "GH"=>"Ghana",
            "GN"=>"Guinea",
            "GW"=>"Guinea Bissau",
            "GQ"=>"Guinea Ecuatorial",
            "KE"=>"Kenia",
            "LS"=>"Lesoto",
            "LR"=>"Liberia",
            "LY"=>"Libia",
            "MG"=>"Madagascar",
            "MW"=>"Malawi",
            "ML"=>"Malí",
            "MA"=>"Marruecos",
            "MU"=>"Mauricio",
            "MR"=>"Mauritania",
            "MZ"=>"Mozambique",
            "NA"=>"Namibia",
            "NE"=>"Níger",
            "NG"=>"Nigeria",
            "CF"=>"República Centroafricana",
            "ZA"=>"República de Sudáfrica",
            "RW"=>"Ruanda",
            "EH"=>"Sahara Occidental",
            "ST"=>"Santo Tomé y Príncipe",
            "SN"=>"Senegal",
            "SC"=>"Seychelles",
            "SL"=>"Sierra Leona",
            "SO"=>"Somalia",
            "SD"=>"Sudán",
            "SS"=>"Sudán del Sur",
            "SZ"=>"Suazilandia",
            "TZ"=>"Tanzania",
            "TG"=>"Togo",
            "TN"=>"Túnez",
            "UG"=>"Uganda",
            "DJ"=>"Yibuti",
            "ZM"=>"Zambia",
            "ZW"=>"Zimbabue",
        ),

        "Oceanía"=>array(
            "AU"=>"Australia",
            "FM"=>"Micronesia, Estados Federados de",
            "FJ"=>"Fiji",
            "KI"=>"Kiribati",
            "MH"=>"Islas Marshall",
            "SB"=>"Islas Salomón",
            "NR"=>"Nauru",
            "NZ"=>"Nueva Zelanda",
            "PW"=>"Palaos",
            "PG"=>"Papúa Nueva Guinea",
            "WS"=>"Samoa",
            "TO"=>"Tonga",
            "TV"=>"Tuvalu",
            "VU"=>"Vanuatu",
        ),

        "Sudamérica"=>array(
            "AR"=>"Argentina",
            "BO"=>"Bolivia",
            "BR"=>"Brasil",
            "CL"=>"Chile",
            "CO"=>"Colombia",
            "EC"=>"Ecuador",
            "GY"=>"Guayana",
            "PY"=>"Paraguay",
            "PE"=>"Perú",
            "SR"=>"Surinam",
            "TT"=>"Trinidad y Tobago",
            "UY"=>"Uruguay",
            "VE"=>"Venezuela",
        ),

        "Norteamérica y Centroamérica"=>array(
            "AG"=>"Antigua y Barbuda",
            "BS"=>"Bahamas",
            "BB"=>"Barbados",
            "BZ"=>"Belice",
            "CA"=>"Canadá",
            "CR"=>"Costa Rica",
            "CU"=>"Cuba",
            "DM"=>"Dominica",
            "SV"=>"El Salvador",
            "US"=>"Estados Unidos",
            "GD"=>"Granada",
            "GT"=>"Guatemala",
            "HT"=>"Haití",
            "HN"=>"Honduras",
            "JM"=>"Jamaica",
            "MX"=>"México",
            "NI"=>"Nicaragua",
            "PA"=>"Panamá",
            "PR"=>"Puerto Rico",
            "DO"=>"República Dominicana",
            "KN"=>"San Cristóbal y Nieves",
            "VC"=>"San Vicente y Granadinas",
            "LC"=>"Santa Lucía",
        ),

        "Asia"=>array(
            "AF"=>"Afganistán",
            "SA"=>"Arabia Saudí",
            "BH"=>"Baréin",
            "BD"=>"Bangladesh",
            "MM"=>"Birmania",
            "BT"=>"Bután",
            "BN"=>"Brunéi",
            "KH"=>"Camboya",
            "CN"=>"China",
            "KP"=>"Corea, República Popular Democrática de",
            "KR"=>"Corea, República de",
            "AE"=>"Emiratos Árabes Unidos",
            "PH"=>"Filipinas",
            "IN"=>"India",
            "ID"=>"Indonesia",
            "IQ"=>"Iraq",
            "IR"=>"Irán",
            "IL"=>"Israel",
            "JP"=>"Japón",
            "JO"=>"Jordania",
            "KZ"=>"Kazajistán",
            "KG"=>"Kirguizistán",
            "KW"=>"Kuwait",
            "LA"=>"Laos",
            "LB"=>"Líbano",
            "MY"=>"Malasia",
            "MV"=>"Maldivas",
            "MN"=>"Mongolia",
            "NP"=>"Nepal",
            "OM"=>"Omán",
            "PK"=>"Paquistán",
            "QA"=>"Qatar",
            "SG"=>"Singapur",
            "SY"=>"Siria",
            "LK"=>"Sri Lanka",
            "TJ"=>"Tayikistán",
            "TH"=>"Tailandia",
            "TP"=>"Timor Oriental",
            "TM"=>"Turkmenistán",
            "UZ"=>"Uzbekistán",
            "VN"=>"Vietnam",
            "YE"=>"Yemen",
        ),
    );



    public static function countries() {
        return self::$_countries;
    }

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

        $database_file = copy(App::pluginPath('Install') . DS . 'Config' . DS . 'CoreInstallFiles' . DS . 'database.php.default', APP . 'Config' . DS . 'database.php');

        $email_file = copy(App::pluginPath('Install') . DS . 'Config' . DS . 'CoreInstallFiles' . DS . 'email.php.default', APP . 'Config' . DS . 'email.php');

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
            App::pluginPath('Install') . DS . 'Config' . DS . 'CoreInstallFiles' . DS . 'schema_core_drop_tables.sql',
            App::pluginPath('Install') . DS . 'Config' . DS . 'CoreInstallFiles' . DS . 'schema_core_struct.sql',
            App::pluginPath('Install') . DS . 'Config' . DS . 'CoreInstallFiles' . DS . 'schema_core_base_data.sql'
        );

        $migrationsSucceed = true;


        foreach($dumpsSqls as $dumpsSql)
        {

            $File =& new File($dumpsSql);
            $contents = $File->read();
            $migrateNow = $db->query($contents);
            if($migrateNow==false)
            {

            }

        }

        return $migrationsSucceed;
    }

    public static function createTenantsDir($site_slug = null)
    {
        $dir = new Folder(APP . 'Tenants' . DS . $site_slug, true);

        if($dir)
        {

        }
        else
        {
            throw new CakeException('No se pudo crear el sitio: '.$site_slug. ' verifique que tenga permisos de escritura.');
        }

        return $dir;

    }

    public static function copySettingFile($site_slug = null,$data = null)
    {

        App::uses('File', 'Utility');
        $defaultSettingsConfig = array(
        'name' => 'default',
        'datasource' => 'Database/Mysql',
        'persistent' => false,
          );

        $config = $defaultSettingsConfig;

        foreach ($data['Site'] as $key => $value) {
            if (isset($data['Site'][$key])) {
                $config[$key] = $value;
            }
        }

        if(!file_exists(APP . 'Tenants' . DS . $site_slug . DS . 'settings.ini'))
        {

            $type_site = copy(App::pluginPath('Install') . DS . 'Config' . DS . 'TenantInstallFiles' . DS . $data['Site']['type'] . DS .'settings.ini.install', APP . 'Tenants' . DS . $site_slug . DS . $data['Site']['type'].'.ini');

          if (!$type_site) {
              throw new CakeException('No se puede copiar el archivo tipo de sitio.');
            }
            $file = new File(APP . 'Tenants' . DS . $site_slug . DS . 'settings.ini', true);
            if (!$file) {
                throw new CakeException('No se puede leer el settings del archivo copiado.');
            }
            $content = $file->read();

            foreach ($config as $configKey => $configValue) {
                $content = str_replace('{default_' . $configKey . '}', $configValue, $content);
            }

            if (!$file->write($content)) {
                throw new CakeException('No se puede escribir por el archivo settings.');

            }
        }
        else
        {
            throw new CakeException('El archivo settings de este sitio ya existe, favor eliminelo para continuar.');
        }

        return true;


    }


    public static function createDumpTenantDB($slug = null, $data = null)
    {
        $tenantontheFlyConfig = array(
        'name' => 'default',
        'datasource' => 'Database/Mysql',
        'persistent' => false,

    );

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

            $tenantontheFlyConfig = array(
                'datasource' => 'Database/Mysql',
                'persistent' => false,
                'host' => ConnectionManager::getDataSource('default')->config['host'],
                'login' => ConnectionManager::getDataSource('default')->config['login'],
                'password' => ConnectionManager::getDataSource('default')->config['password'],
                'database' => $tenantDB,
                'prefix' => ConnectionManager::getDataSource('default')->config['prefix'],
                'encoding' => 'UTF8',
                'port' => ConnectionManager::getDataSource('default')->config['port'],
            );

            // 1) Primero se corrobora si se puede crear la base de datos, sino se puede promover la desinstalacion del site
            if(ConnectionManager::getDataSource('default')->query("create database ".$tenantDB.";"))
            {

            }
            else
            {
                throw new CakeException('No se pudo crear la base de datos del tenant: '.$tenantDB.'. Verifique que su usuario de conexión tenga los permisos suficientes.');
            }

            if(ConnectionManager::create('tenantInstance',$tenantontheFlyConfig))
            {
                $tenantConnection = ConnectionManager::getDataSource('tenantInstance');
            }
            else
            {
                throw new CakeException('No fue posible crear una instancia de conexión a la base de datos del tenant. Favor revisar el Estado del Servidor Mysql y usuarios/privilegios.');
            }


            $dumpsSqls = array(
                App::pluginPath('Install') . DS . 'Config' . DS . 'TenantInstallFiles'. DS . $data['Site']['type'] . DS . 'schema_tenant_struct.sql',
                App::pluginPath('Install') . DS . 'Config' . DS . 'TenantInstallFiles'. DS . $data['Site']['type'] . DS . 'schema_tenant_base_data.sql',
            );


            foreach($dumpsSqls as $dumpsSql)
            {
                $File =& new File($dumpsSql);
                $contents = $File->read();
                // El sql puede fallar, entonces ponemos una excepcion

                if($tenantConnection->query($contents))
                {
                    $File->close();
                    continue;
                }
                else
                {
                    throw new CakeException("Se ha producido un error en el volcado de datos en el tenant.");
                }
            }

            // Una ves que coloque todo, devolver el control a la conexion principal

        }
        else
        {
            throw new CakeException("No fue establecer la conexión con la base de datos principal, es probable que se halla producido un corte de conexión o que los datos de ingresos hayan cambiados.");

        }

        if(ConnectionManager::getDataSource('default'))
        {
            ConnectionManager::getDataSource('default')->cacheSources = false;
        }
        else
        {
            throw new CakeException("No fue posible retomar la conexión con la base de datos principal, es probable que se halla producido un corte de conexión o que los datos de ingresos hayan cambiados.");
        }

    }



    public static function getCountryData( $ip )
    {

        return GeoPlugin::locate($ip);

    }



    public static function createCoresFile()
    {
        $ristoConfigFile = App::pluginPath('Install') . DS . 'Config' . DS . 'CoreInstallFiles' . DS .  'risto.php.install';
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
        $res = true;
        if(
            file_exists(APP . 'Config' . DS . 'database.php')==false
            ||file_exists(APP . 'Config' . DS . 'core.php')==false

        )
        {

            $res = false;

        }

        if(
            file_exists(APP . 'Config' . DS . 'database.php')==true
            &&file_exists(APP . 'Config' . DS . 'core.php')==true

        )
        {
            // Si exxiste los dos hacemos un checkeo si existen por lo menos una tabla
            $checkUserAdmin = Installer::check_table_exists();
            if(!$checkUserAdmin)
            {
                $res = false;

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
        App::uses('ConnectionManager', 'Model');

        if(ConnectionManager::getDataSource('default'))
        {
            $db = ConnectionManager::getDataSource('default');
            $tenantDB = $db->config['database']."_".$site_alias;

            if($db->query("DROP DATABASE ".$tenantDB))
            {


            }
            else
            {
                throw new CakeException("Ocurrio un error eliminando la base de datos del Tenant.");
            }

            App::import('model','MtSites.Site');
            $site = new Site();
            $site_data = $site->findByAlias($site_alias);
            App::uses('MtSites','MtSites.Utility');
            // Se usaria un after delete para eliminar la carpeta
            if($site->delete($site_data['Site']['id']))
            {
                MtSites::loadSessionData();
                return true;
            }
            else
            {

                throw new CakeException('No se pudo borrar el sitio. Es probable que la base de datos no haya sido encontrada. ');

            }

        }
        else
        {
            throw new MissingDatasourceException("No se ha podido establecer la conexion con la base de datos principal.");
        }


        if(ConnectionManager::getDataSource('default'))
        {

        }
        else
        {
            throw new CakeException('No se pude reestabecer conexión a la base de datos principal');
        }


    }

}