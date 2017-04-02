<?php
App::uses('AppNoModelController', 'Controller');
App::uses('TenantSettings', 'MtSites.Utility');



class ConfigurationsController extends AppNoModelController
{
    public $viewVars = array('title_for_layout' => 'Configuración');
	

    
    public function beforeFilter () {
        parent::beforeFilter();
        $this->set('elementMenu', 'menu');
    }
    
    public $currencyCodes = array (
            'ALL' => 'Albania Lek',
            'AFN' => 'Afghanistan Afghani',
            'ARS' => 'Argentina Peso',
            'AWG' => 'Aruba Guilder',
            'AUD' => 'Australia Dollar',
            'AZN' => 'Azerbaijan New Manat',
            'BSD' => 'Bahamas Dollar',
            'BBD' => 'Barbados Dollar',
            'BDT' => 'Bangladeshi taka',
            'BYR' => 'Belarus Ruble',
            'BZD' => 'Belize Dollar',
            'BMD' => 'Bermuda Dollar',
            'BOB' => 'Bolivia Boliviano',
            'BAM' => 'Bosnia and Herzegovina Convertible Marka',
            'BWP' => 'Botswana Pula',
            'BGN' => 'Bulgaria Lev',
            'BRL' => 'Brazil Real',
            'BND' => 'Brunei Darussalam Dollar',
            'KHR' => 'Cambodia Riel',
            'CAD' => 'Canada Dollar',
            'KYD' => 'Cayman Islands Dollar',
            'CLP' => 'Chile Peso',
            'CNY' => 'China Yuan Renminbi',
            'COP' => 'Colombia Peso',
            'CRC' => 'Costa Rica Colon',
            'HRK' => 'Croatia Kuna',
            'CUP' => 'Cuba Peso',
            'CZK' => 'Czech Republic Koruna',
            'DKK' => 'Denmark Krone',
            'DOP' => 'Dominican Republic Peso',
            'XCD' => 'East Caribbean Dollar',
            'EGP' => 'Egypt Pound',
            'SVC' => 'El Salvador Colon',
            'EEK' => 'Estonia Kroon',
            'EUR' => 'Euro Member Countries',
            'FKP' => 'Falkland Islands (Malvinas) Pound',
            'FJD' => 'Fiji Dollar',
            'GHC' => 'Ghana Cedis',
            'GIP' => 'Gibraltar Pound',
            'GTQ' => 'Guatemala Quetzal',
            'GGP' => 'Guernsey Pound',
            'GYD' => 'Guyana Dollar',
            'HNL' => 'Honduras Lempira',
            'HKD' => 'Hong Kong Dollar',
            'HUF' => 'Hungary Forint',
            'ISK' => 'Iceland Krona',
            'INR' => 'India Rupee',
            'IDR' => 'Indonesia Rupiah',
            'IRR' => 'Iran Rial',
            'IMP' => 'Isle of Man Pound',
            'ILS' => 'Israel Shekel',
            'JMD' => 'Jamaica Dollar',
            'JPY' => 'Japan Yen',
            'JEP' => 'Jersey Pound',
            'KZT' => 'Kazakhstan Tenge',
            'KPW' => 'Korea (North) Won',
            'KRW' => 'Korea (South) Won',
            'KGS' => 'Kyrgyzstan Som',
            'LAK' => 'Laos Kip',
            'LVL' => 'Latvia Lat',
            'LBP' => 'Lebanon Pound',
            'LRD' => 'Liberia Dollar',
            'LTL' => 'Lithuania Litas',
            'MKD' => 'Macedonia Denar',
            'MYR' => 'Malaysia Ringgit',
            'MUR' => 'Mauritius Rupee',
            'MXN' => 'Mexico Peso',
            'MNT' => 'Mongolia Tughrik',
            'MZN' => 'Mozambique Metical',
            'NAD' => 'Namibia Dollar',
            'NPR' => 'Nepal Rupee',
            'ANG' => 'Netherlands Antilles Guilder',
            'NZD' => 'New Zealand Dollar',
            'NIO' => 'Nicaragua Cordoba',
            'NGN' => 'Nigeria Naira',
            'NOK' => 'Norway Krone',
            'OMR' => 'Oman Rial',
            'PKR' => 'Pakistan Rupee',
            'PAB' => 'Panama Balboa',
            'PYG' => 'Paraguay Guarani',
            'PEN' => 'Peru Nuevo Sol',
            'PHP' => 'Philippines Peso',
            'PLN' => 'Poland Zloty',
            'QAR' => 'Qatar Riyal',
            'RON' => 'Romania New Leu',
            'RUB' => 'Russia Ruble',
            'SHP' => 'Saint Helena Pound',
            'SAR' => 'Saudi Arabia Riyal',
            'RSD' => 'Serbia Dinar',
            'SCR' => 'Seychelles Rupee',
            'SGD' => 'Singapore Dollar',
            'SBD' => 'Solomon Islands Dollar',
            'SOS' => 'Somalia Shilling',
            'ZAR' => 'South Africa Rand',
            'LKR' => 'Sri Lanka Rupee',
            'SEK' => 'Sweden Krona',
            'CHF' => 'Switzerland Franc',
            'SRD' => 'Suriname Dollar',
            'SYP' => 'Syria Pound',
            'TWD' => 'Taiwan New Dollar',
            'THB' => 'Thailand Baht',
            'TTD' => 'Trinidad and Tobago Dollar',
            'TRY' => 'Turkey Lira',
            'TRL' => 'Turkey Lira',
            'TVD' => 'Tuvalu Dollar',
            'UAH' => 'Ukraine Hryvna',
            'GBP' => 'United Kingdom Pound',
            'UGX' => 'Uganda Shilling',
            'USD' => 'United States Dollar',
            'UYU' => 'Uruguay Peso',
            'UZS' => 'Uzbekistan Som',
            'VEF' => 'Venezuela Bolivar',
            'VND' => 'Viet Nam Dong',
            'YER' => 'Yemen Rial',
            'ZWD' => 'Zimbabwe Dollar'
        );

    public function index() {
    	$tenantSett = TenantSettings::read();

    	$this->set('configurations', $tenantSett);

    }


    public function first_configuration_wizard_end( ) {
        $this->set('elementMenu', false);
        $this->layout = 'Install.default';
    }

    public function first_configuration_wizard( $advanced = null) {
        $this->layout = 'Install.default';

        $this->set('elementMenu', false);
        $this->edit();

        if ( $this->request->is('put') || $this->request->is('post')) { 

            $this->redirect(array('plugin'=>'mesa', 'controller' => 'mozos', 'action' => 'add_first_time'));
        }
    }


    public function modulos() {
        $this->edit();

        if ( $this->request->is('put') || $this->request->is('post')) { 

            $this->redirect($this->referer());
        }
    }


    public function edit( $advanced = null) {

    	if ( $this->request->is('put') || $this->request->is('post')) {
            if (!empty($this->request->data['Afip']['tipo_factura_id'])) {
                $tipoFactId = $this->request->data['Afip']['tipo_factura_id'];
                $TipoFact = Classregistry::init('Risto.TipoFactura')->find('first', array(
                    'conditions' => array('TipoFactura.id' => $tipoFactId ),
                    'recursive' => -1,
                    )
                );

                $this->request->data['Restaurante']['tipofactura_name'] = $TipoFact['TipoFactura']['name'];
                $this->request->data['Printers']['default_tipo_factura_codename'] = $TipoFact['TipoFactura']['codename'];
            }

            // cam bio de nombre del sitio
            if ( !empty($this->data['Site']['name'])) {
                $Site = ClassRegistry::init("MtSites.Site");
                $Site->recursive = -1;
                $s = $Site->findByAlias(MtSites::getSiteName());
                if ( $s && ( $s['Site']['name'] != $this->data['Site']['name'] ) ) {
                    $s['Site']['name'] = $this->data['Site']['name'];
                    $Site->id = $s['Site']['id'];
                    if ( !$Site->saveField('name', $this->data['Site']['name']) )  {
                        throw new Exception(__("No se pudo guardar el nombre del sitio") );
                        
                    }
                }
            }


    		if ( TenantSettings::write($this->data) ) {
	    		MtSites::loadConfigFiles();
	    		$this->Session->setFlash(__('Se han guardado los cambios de configuración'));
    		} else {
    			$this->Session->setFlash(__('Error al guardar los cambios de configuración'), 'Risto.flash_error');
    		}
    	}

    	$this->request->data = TenantSettings::read();
        if (empty($this->request->data['Geo']['currency_code']) && !empty($this->request->data['Config']['currency_code'])) {
            $this->request->data['Geo']['currency_code'] = $this->request->data['Config']['currency_code'];
        }

    	$printers = Classregistry::init('Printers.Printer')->find('list');
        $fiscal_printer = Classregistry::init('Printers.Printer')->read(null, Configure::read('Printers.fiscal_id'));
    	$ivaResponsabilidades = Classregistry::init('Risto.IvaResponsabilidad')->find('list');
    	$tipoFacturas = Classregistry::init('Risto.TipoFactura')->find('list');
    	$mozos = Classregistry::init('Mesa.Mozo')->find('list', array('fields'=> array('id', 'numero_y_nombre')));
        $currencyCodes = $this->currencyCodes;
    	$this->set(compact('printers', 'fiscal_printer','ivaResponsabilidades', 'tipoFacturas', 'mozos', 'currencyCodes'));

    	if ( $advanced ) {
    		$this->render('edit_'.$advanced);
    	}
    }

}
