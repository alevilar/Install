<?php

App::uses('CakeLog', 'Log');
App::uses('ClassRegistry', 'Utility');
App::uses('File', 'Utility');
App::uses('GeoPlugin', 'Install.Lib/Utility');
App::uses('Folder', 'Utility');


/**
 *  Funciones de instalacion Installer
 *
 * @package Install.Lib.Utility
 */
class Installer {

	protected static $papa = 'asas';

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
            $result = copy(APP  . 'Config' . DS . 'settings.ini.install', APP . 'Tenants' . DS . $site_slug . DS . 'settings.ini');
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

    // Paso final, copia del resumen
    public static function createResumeFile()
    {
        $result = copy(App::pluginPath('Install') . DS . 'Config' . DS . 'resume.php.install', APP . 'Config' . DS . 'resume.php');
        return $result;
    }

    public static function createDumpTenantDB($slug = null, $data = null)
    {

        $tenantDB = "";

        $tenantontheFlyConfig = array(
        'name' => 'default',
        'datasource' => 'Database/Mysql',
        'persistent' => false,

    );

        App::uses('ConnectionManager', 'Model');

        $db = ConnectionManager::getDataSource('default');

        $db->cacheSources = false;

        $tenantDB = $db->config['database']."_".$slug;

        $tenantontheFlyConfig = array(
            'datasource' => 'Database/Mysql',
            'persistent' => false,
            'host' => $db->config['host'],
            'login' => $db->config['login'],
            'password' => $db->config['password'],
            'database' => $tenantDB,
            'prefix' => $db->config['prefix'],
            'encoding' => 'UTF8',
            'port' => $db->config['port'],
        );


        $createTenantDatabase = $db->query("CREATE DATABASE ".$tenantDB);

        try {
            $tenantInstance = ConnectionManager::create('tenantInstance',$tenantontheFlyConfig);
            $tenantConnection = ConnectionManager::getDataSource('tenantInstance');
        }
        catch (MissingConnectionException $e) {
            return __d('croogo', 'No se pudo conectar a la base de datos del tenant: ') . $e->getMessage();
        }

        $dumpsSqls = array(
            APP . 'Config' . DS . 'Schema' . DS . 'schema_tenant_struct.sql',
            APP . 'Config' . DS . 'Schema' . DS . 'schema_tenant_base_data.sql'
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

        // Una ves que coloque todo, devolver el control a la conexion principal

        try {
            $defaultConnection = ConnectionManager::getDataSource('default');
            $db->cacheSources = false;

        }
        catch (MissingConnectionException $e) {
            return __d('croogo', 'No se pudo reconectar a la base de datos del core.: ') . $e->getMessage();
        }


    }


    public static function getCountryData( $ip )
    {


        $geoplugin = new GeoPlugin();


//locate the IP
        $geoplugin->locate( $ip );

        return $geoplugin->countryCode;


    }

}