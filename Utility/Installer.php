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
            "Europe/Tirane_AL"=>"Albania",
            "Europe/Berlin_DE"=>"Alemania",
            "Europe/Andorra_AD"=>"Andorra",
            "UTC_AM"=>"Armenia",
            "Europe/Vienna_AT"=>"Austria",
            "UTC_AZ"=>"Azerbaiyán",
            "Europe/Brussels_BE"=>"Bélgica",
            "Europe/Minsk_BY"=>"Bielorrusia",
            "Europe/Sarajevo_BA"=>"Bosnia y Herzegovina",
            "Europe/Sofia_BG"=>"Bulgaria",
            "Europe/Nicosia_CY"=>"Chipre",
            "Europe/Vatican_VA"=>"Ciudad del Vaticano (Santa Sede)",
            "Europe/Zagreb_HR"=>"Croacia",
            "Europe/Copenhagen_DK"=>"Dinamarca",
            "Europe/Bratislava_SK"=>"Eslovaquia",
            "Europe/Ljubljana_SI"=>"Eslovenia",
            "Europe/Madrid_ES"=>"España",
            "Europe/Tallinn_EE"=>"Estonia",
            "Europe/Helsinki_FI"=>"Finlandia",
            "Europe/Paris_FR"=>"Francia",
            "UTC_GE"=>"Georgia",
            "Europe/Athens_GR"=>"Grecia",
            "Europe/Budapest_HU"=>"Hungría",
            "Europe/Dublin_IE"=>"Irlanda",
            "UTC_IS"=>"Islandia",
            "Europe/Rome_IT"=>"Italia",
            "UTC_XK"=>"Kosovo",
            "Europe/Riga_LV"=>"Letonia",
            "Europe/Vaduz_LI"=>"Liechtenstein",
            "Europe/Vilnius_LT"=>"Lituania",
            "Europe/Luxembourg_LU"=>"Luxemburgo",
            "Europe/Skopje_MK"=>"Macedonia, República de",
            "Europe/Malta_MT"=>"Malta",
            "Europe/Chisinau_MD"=>"Moldavia",
            "Europe/Monaco_MC"=>"Mónaco",
            "Europe/Podgorica_ME"=>"Montenegro",
            "Europe/Oslo_NO"=>"Noruega",
            "Europe/Amsterdam_NL"=>"Países Bajos",
            "Europe/Warsaw_PL"=>"Polonia",
            "Europe/Lisbon_PT"=>"Portugal",
            "Europe/London_UK"=>"Reino Unido",
            "Europe/Prague_CZ"=>"República Checa",
            "Europe/Bucharest_RO"=>"Rumanía",
            "Europe/Moscow_RU"=>"Rusia",
            "Europe/San_Marino_SM"=>"San Marino",
            "UTC_SE"=>"Suecia",
            "Europe/Zurich_CH"=>"Suiza",
            "Asia/Istanbul_TR"=>"Turquía",
            "Europe/Kiev_UA"=>"Ucrania",
            "UTC_YU"=>"Yugoslavia",
        ),

        "África"=>array(
            "Africa/Luanda_AO"=>"Angola",
            "UTC_DZ"=>"Argelia",
            "Africa/Porto-Novo_BJ"=>"Benín",
            "Africa/Gaborone_BW"=>"Botswana",
            "Africa/Ouagadougou_BF"=>"Burkina Faso",
            "Africa/Bujumbura_BI"=>"Burundi",
            "UTC_CM"=>"Camerún",
            "UTC_CV"=>"Cabo Verde",
            "UTC_TD"=>"Chad",
            "UTC_KM"=>"Comores",
            "Africa/Brazzaville"=>"Congo",
            "Africa/Kinshasa_CG_CD"=>"Congo, República Democrática del",
            "UTC_CI"=>"Costa de Marfil",
            "Africa/Cairo_EG"=>"Egipto",
            "Africa/Asmera_ER"=>"Eritrea",
            "Africa/Addis_Ababa_ET"=>"Etiopía",
            "Africa/Libreville_GA"=>"Gabón",
            "Africa/Banjul_GM"=>"Gambia",
            "Africa/Accra_GH"=>"Ghana",
            "Africa/Conakry_GN"=>"Guinea",
            "Africa/Bissau_GW"=>"Guinea Bissau",
            "Africa/Malabo_GQ"=>"Guinea Ecuatorial",
            "Africa/Nairobi_KE"=>"Kenia",
            "Africa/Maseru_LS"=>"Lesoto",
            "Africa/Monrovia_LR"=>"Liberia",
            "Africa/Tripoli_LY"=>"Libia",
            "UTC_MG"=>"Madagascar",
            "UTC_MW"=>"Malawi",
            "Africa/Bamako_ML"=>"Malí",
            "UTC_MA"=>"Marruecos",
            "UTC_MU"=>"Mauricio",
            "Africa/Nouakchott_MR"=>"Mauritania",
            "Africa/Maputo_MZ"=>"Mozambique",
            "Africa/Windhoek_NA"=>"Namibia",
            "Africa/Niamey_NE"=>"Níger",
            "Africa/Abidjan_NG"=>"Nigeria",
            "Africa/Bangui_CF"=>"República Centroafricana",
            "UTC_ZA"=>"República de Sudáfrica",
            "Africa/Kigali_RW"=>"Ruanda",
            "UTC_EH"=>"Sahara Occidental",
            "UTC_ST"=>"Santo Tomé y Príncipe",
            "Africa/Dakar_SN"=>"Senegal",
            "UTC_SC"=>"Seychelles",
            "Africa/Freetown_SL"=>"Sierra Leona",
            "Africa/Mogadishu_SO"=>"Somalia",
            "Africa/Khartoum_SD"=>"Sudán",
            "UTC_SS"=>"Sudán del Sur",
            "Africa/Luanda_SZ"=>"Suazilandia",
            "UTC_TZ"=>"Tanzania",
            "Africa/Lome_TG"=>"Togo",
            "Africa/Tunis_TN"=>"Túnez",
            "Africa/Kampala_UG"=>"Uganda",
            "UTC_DJ"=>"Yibuti",
            "Africa/Lusaka_ZM"=>"Zambia",
            "Africa/Harare_ZW"=>"Zimbabue",
        ),

        "Oceanía"=>array(
            "Australia/Canberra-AU"=>"Australia",
            "UTC_FM"=>"Micronesia, Estados Federados de",
            "UTC_FJ"=>"Fiji",
            "Pacific/TarawaKI"=>"Kiribati",
            "Pacific/Majuro_MH"=>"Islas Marshall",
            "UTC_SB"=>"Islas Salomón",
            "Pacific/Nauru_NR"=>"Nauru",
            "UTC_NZ"=>"Nueva Zelanda",
            "UTC_PW"=>"Palaos",
            "UTC_PG"=>"Papúa Nueva Guinea",
            "UTC_WS"=>"Samoa",
            "UTC_TO"=>"Tonga",
            "UTC_TV"=>"Tuvalu",
            "UTC_VU"=>"Vanuatu",
        ),

        "Sudamérica"=>array(
            "America/Buenos_Aires_AR"=>"Argentina",
            "America/La_Paz_BO"=>"Bolivia",
            "America/Sao_Paulo_BR"=>"Brasil",
            "America/Santiago_CL"=>"Chile",
            "America/Bogota_CO"=>"Colombia",
            "America/Guayaquil_EC"=>"Ecuador",
            "America/Guyana_GY"=>"Guayana",
            "America/Asuncion_PY"=>"Paraguay",
            "America/Lima_PE"=>"Perú",
            "America/Paramaribo_SR"=>"Surinam",
            "America/Port_of_Spain_TT"=>"Trinidad y Tobago",
            "America/Montevideo_UY"=>"Uruguay",
            "America/CaracasVE"=>"Venezuela",
        ),

        "Norteamérica y Centroamérica"=>array(
            "America/St_Johns_AG"=>"Antigua y Barbuda",
            "America/Nassau_BS"=>"Bahamas",
            "UTC_BB"=>"Barbados",
            "America/Belize_BZ"=>"Belice",
            "America/Toronto_CA"=>"Canadá",
            "America/Costa_Rica_CR"=>"Costa Rica",
            "UTC_CU"=>"Cuba",
            "UTC_DM"=>"Dominica",
            "UTC_SV"=>"El Salvador",
            "America/New_York_US"=>"Estados Unidos",
            "UTC_GD"=>"Granada",
            "America/Guatemala_GT"=>"Guatemala",
            "America/Port-au-Prince_HT"=>"Haití",
            "UTC_HN"=>"Honduras",
            "America/Jamaica_JM"=>"Jamaica",
            "America/Mexico_City_MX"=>"México",
            "America/Managua_NI"=>"Nicaragua",
            "America/Panama_PA"=>"Panamá",
            "America/St_Johns_PR"=>"Puerto Rico",
            "UTC_DO"=>"República Dominicana",
            "UTC_KN"=>"San Cristóbal y Nieves",
            "UTC_VC"=>"San Vicente y Granadinas",
            "UTC_LC"=>"Santa Lucía",
        ),

        "Asia"=>array(
            "Asia/Kabul_AF"=>"Afganistán",
            "Asia/Riyadh_SA"=>"Arabia Saudí",
            "UTC_BH"=>"Baréin",
            "Asia/Dacca_BD"=>"Bangladesh",
            "UTC_MM"=>"Birmania",
            "Asia/Thimbu_BT"=>"Bután",
            "UTC_BN"=>"Brunéi",
            "Asia/Phnom_Penh_KH"=>"Camboya",
            "Asia/Shanghai_CN"=>"China",
            "Asia/Pyongyang_KP"=>"Corea, República Popular Democrática de",
            "Asia/Seoul_KR"=>"Corea, República de",
            "UTC_AE"=>"Emiratos Árabes Unidos",
            "Asia/Manila_PH"=>"Filipinas",
            "Asia/Calcutta_IN"=>"India",
            "Asia/Yakutsk_ID"=>"Indonesia",
            "Asia/Baghdad_IQ"=>"Iraq",
            "Asia/Tehran_IR"=>"Irán",
            "Asia/Jerusalem_IL"=>"Israel",
            "Asia/Tokyo_JP"=>"Japón",
            "Asia/Amman_JO"=>"Jordania",
            "Asia/Ashgabat_KZ"=>"Kazajistán",
            "Asia/Bishkek_KG"=>"Kirguizistán",
            "Asia/Kuwait_KW"=>"Kuwait",
            "Asia/Vientiane_LA"=>"Laos",
            "Asia/Beirut_LB"=>"Líbano",
            "Asia/Kuala_Lumpur_MY"=>"Malasia",
            "UTC_MV"=>"Maldivas",
            "Asia/Ulan_Bator_MN"=>"Mongolia",
            "Asia/Kathmandu_NP"=>"Nepal",
            "UTC_OM"=>"Omán",
            "PK"=>"Paquistán",
            "Asia/Qatar_QA"=>"Qatar",
            "Asia/Singapore_SG"=>"Singapur",
            "Asia/Damascus_SY"=>"Siria",
            "Asia/Colombo_LK"=>"Sri Lanka",
            "Asia/Dushanbe_TJ"=>"Tayikistán",
            "Asia/Bangkok_TH"=>"Tailandia",
            "UTC_TP"=>"Timor Oriental",
            "Asia/Ashgabat_TM"=>"Turkmenistán",
            "Asia/Tashkent_UZ"=>"Uzbekistán",
            "Asia/Vientiane_LAVN"=>"Vietnam",
            "UTC_YE"=>"Yemen",

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

            $type_site = copy(App::pluginPath('Install') . 'Config' . DS . 'TenantInstallFiles' . DS . $data['Site']['type'] . DS .'settings.ini.install', APP . 'Tenants' . DS . $site_slug . DS . 'settings.ini');

          if (!$type_site) {
              throw new CakeException('No se puede copiar el archivo de configuración del comercio.');
            }
            $file = new File(APP . 'Tenants' . DS . $site_slug . DS . 'settings.ini', true);
            if (!$file) {
                throw new CakeException('No se puede leer el archivo de configuración del archivo copiado.');
            }
            $content = $file->read();

            if ($content=='') {
                throw new CakeException('No se puede leer ningún contenido del archivo de configuración copiado.');
            }

          foreach ($config as $configKey => $configValue) {
                $content = str_replace('{default_' . $configKey . '}', $configValue, $content);
            }
            if (!$file->write($content)) {
                throw new CakeException('No se puede escribir en el archivo de configuración del comercio.');

            }
        }
        else
        {
            throw new CakeException('El archivo deconfiguración de este sitio ya existe, favor elimínelo para continuar.');
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



    public static function getCountryData( $ip )
    {

        return GeoPlugin::locate($ip);

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

        if(ConnectionManager::getDataSource('default')->connected)
        {
            $db = ConnectionManager::getDataSource('default');
            $tenantDB = $db->config['database']."_".$site_alias;
            $delete_db = $db->query("DROP DATABASE IF EXISTS ".$tenantDB);
            if(!empty($delete_db))
            {
                throw new CakeException("Ocurrió un error eliminando la base de datos del Comercio.");
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
                throw new CakeException('No se pudo borrar el tenant. Es probable que la base de datos no haya sido encontrada.');
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