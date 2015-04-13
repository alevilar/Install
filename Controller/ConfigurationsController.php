<?php
App::uses('AppNoModelController', 'Controller');
App::uses('TenantSettings', 'MtSites.Utility');



class ConfigurationsController extends AppNoModelController
{
	

    public function index() {
    	$tenantSett = TenantSettings::read();

    	$this->set('configurations', $tenantSett);

    }



    public function edit( $advanced = null) {

    	if ( $this->request->is('put') || $this->request->is('post')) {
    		if ( TenantSettings::write($this->data) ) {

    			$tipoFactId = $this->data['Afip']['tipofactura_id'];
    			$TipoFact = Classregistry::init('Risto.TipoFactura')->find('first', array(
    				'conditions' => array('TipoFactura.id' => $tipoFactId ),
    				'recursive' => -1,
    				)
    			);

    			$this->request->data['Restaurante']['tipofactura_name'] = $TipoFact['TipoFactura']['name'];
    			$this->request->data['Printers']['default_tipo_factura_codename'] = $TipoFact['TipoFactura']['codename'];

	    		MtSites::loadConfigFiles();
	    		$this->Session->setFlash(__('Se han guardado los cambios de configuración'));
    		} else {
    			$this->Session->setFlash(__('Error al guardar los cambios de configuración'), 'Risto.flash_error');
    		}
    	}

    	$this->request->data = TenantSettings::read();

    	$printers = Classregistry::init('Printers.Printer')->find('list');
    	$ivaResponsabilidades = Classregistry::init('Risto.IvaResponsabilidad')->find('list');
    	$tipoFacturas = Classregistry::init('Risto.TipoFactura')->find('list');
    	$mozos = Classregistry::init('Mesa.Mozo')->find('list', array('fields'=> array('id', 'numero_y_nombre')));
    	$this->set(compact('printers', 'ivaResponsabilidades', 'tipoFacturas', 'mozos'));

    	if ( $advanced ) {
    		$this->render('edit_'.$advanced);
    	}
    }

}